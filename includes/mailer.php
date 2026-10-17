<?php
/**
 * Envoi des e-mails du site (formulaire de contact).
 *
 * Deux modes :
 *  - SMTP authentifié (recommandé, configurable depuis /admin/email, stocké dans data/mail.json) ;
 *  - repli sur la fonction mail() de PHP si aucun SMTP n'est configuré.
 *
 * PHPMailer est chargé via vendor/autoload.php (composer install dans le workflow de déploiement).
 */

require_once __DIR__ . '/secret.php';
require_once __DIR__ . '/mail_template.php';

define('MAILER_CONFIG', dirname(__DIR__) . '/data/mail.json');
define('MAILER_DESTINATAIRE_DEFAUT', defined('CONTACT_EMAIL') ? CONTACT_EMAIL : 'contact@kane-eco-construction.com');

function mailer_config_defaut()
{
    return [
        'destinataire'  => MAILER_DESTINATAIRE_DEFAUT,
        'expediteur'    => 'contact@kane-eco-construction.com',
        'nom_expediteur' => 'Site Kané Eco-Construction',
        'smtp_actif'    => false,
        'smtp_hote'     => 'smtppro.zoho.com',
        'smtp_port'     => 465,
        'smtp_securite' => 'ssl',   // ssl | tls | aucune
        'smtp_utilisateur' => '',
        'smtp_mot_de_passe' => '',
        'modifie_le'    => '',
    ];
}

function mailer_config()
{
    $defaut = mailer_config_defaut();
    $lu = json_decode((string) @file_get_contents(MAILER_CONFIG), true);
    if (!is_array($lu)) {
        return $defaut;
    }
    $config = array_merge($defaut, array_intersect_key($lu, $defaut));
    $config['smtp_actif'] = !empty($config['smtp_actif']);
    $config['smtp_port'] = (int) $config['smtp_port'];
    $config['smtp_mot_de_passe'] = secret_dechiffrer($config['smtp_mot_de_passe']);
    return $config;
}

function mailer_config_sauver(array $config)
{
    $dir = dirname(MAILER_CONFIG);
    if (!is_dir($dir) && !@mkdir($dir, 0755, true)) {
        return false;
    }
    $config['modifie_le'] = date('Y-m-d H:i:s');
    $config['smtp_mot_de_passe'] = secret_chiffrer(isset($config['smtp_mot_de_passe']) ? $config['smtp_mot_de_passe'] : '');
    $json = json_encode(array_intersect_key($config, mailer_config_defaut()), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $ok = @file_put_contents(MAILER_CONFIG, $json, LOCK_EX) !== false;
    if ($ok) {
        @chmod(MAILER_CONFIG, 0600);
    }
    return $ok;
}

function mailer_phpmailer_disponible()
{
    $autoload = dirname(__DIR__) . '/vendor/autoload.php';
    if (file_exists($autoload)) {
        require_once $autoload;
    }
    return class_exists('PHPMailer\\PHPMailer\\PHPMailer');
}

/**
 * Envoie un e-mail au destinataire configuré.
 *
 * @param string      $sujet
 * @param string      $corps      Version texte brut (toujours fournie : lecteurs sans HTML, alternative).
 * @param string|null $replyEmail Adresse de réponse (celle du visiteur).
 * @param string|null $replyNom
 * @param string|null $html       Version HTML (gabarit de includes/mail_template.php) ; null = texte seul.
 * @return array ['ok' => bool, 'mode' => 'smtp'|'mail', 'erreur' => string]
 */
function mailer_envoyer($sujet, $corps, $replyEmail = null, $replyNom = null, $html = null)
{
    $config = mailer_config();

    if ($config['smtp_actif'] && $config['smtp_utilisateur'] !== '') {
        if (!mailer_phpmailer_disponible()) {
            return ['ok' => false, 'mode' => 'smtp', 'erreur' => "La bibliothèque d'envoi (PHPMailer) est absente : lancez « composer install »."];
        }
        try {
            $m = new PHPMailer\PHPMailer\PHPMailer(true);
            $m->CharSet = 'UTF-8';
            $m->isSMTP();
            $m->Host = $config['smtp_hote'];
            $m->Port = $config['smtp_port'];
            $m->SMTPAuth = true;
            $m->Username = $config['smtp_utilisateur'];
            $m->Password = $config['smtp_mot_de_passe'];
            if ($config['smtp_securite'] === 'ssl') {
                $m->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            } elseif ($config['smtp_securite'] === 'tls') {
                $m->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            } else {
                $m->SMTPSecure = false;
                $m->SMTPAutoTLS = false;
            }
            $m->Timeout = 15;
            $m->setFrom($config['expediteur'], $config['nom_expediteur']);
            $m->addAddress($config['destinataire']);
            if ($replyEmail && filter_var($replyEmail, FILTER_VALIDATE_EMAIL)) {
                $m->addReplyTo($replyEmail, (string) $replyNom);
            }
            $m->Subject = $sujet;
            if ($html !== null) {
                $m->isHTML(true);
                $m->Body = $html;
                $m->AltBody = $corps;
            } else {
                $m->isHTML(false);
                $m->Body = $corps;
            }
            $m->send();
            return ['ok' => true, 'mode' => 'smtp', 'erreur' => ''];
        } catch (Exception $e) {
            return ['ok' => false, 'mode' => 'smtp', 'erreur' => isset($m) && $m->ErrorInfo ? $m->ErrorInfo : $e->getMessage()];
        }
    }

    // Repli : mail() de PHP (multipart texte + HTML si un gabarit est fourni).
    $entetes = [
        'From: ' . mailer_encoder_entete($config['nom_expediteur']) . ' <' . $config['expediteur'] . '>',
        'MIME-Version: 1.0',
        'X-Mailer: PHP/' . phpversion(),
    ];
    if ($replyEmail && filter_var($replyEmail, FILTER_VALIDATE_EMAIL)) {
        $entetes[] = 'Reply-To: ' . mailer_encoder_entete((string) $replyNom) . ' <' . $replyEmail . '>';
    }
    if ($html !== null) {
        $frontiere = 'kane-' . bin2hex(random_bytes(12));
        $entetes[] = 'Content-Type: multipart/alternative; boundary="' . $frontiere . '"';
        $message = "--$frontiere\r\nContent-Type: text/plain; charset=utf-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\n" . $corps
            . "\r\n--$frontiere\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\n" . $html
            . "\r\n--$frontiere--\r\n";
    } else {
        $entetes[] = 'Content-Type: text/plain; charset=utf-8';
        $entetes[] = 'Content-Transfer-Encoding: 8bit';
        $message = $corps;
    }
    $ok = @mail($config['destinataire'], mailer_encoder_entete($sujet), $message, implode("\r\n", $entetes));
    return ['ok' => (bool) $ok, 'mode' => 'mail', 'erreur' => $ok ? '' : "La fonction mail() du serveur a refusé l'envoi."];
}

function mailer_encoder_entete($texte)
{
    $texte = str_replace(["\r", "\n"], ' ', (string) $texte);
    return preg_match('/[^\x20-\x7E]/', $texte) ? '=?UTF-8?B?' . base64_encode($texte) . '?=' : $texte;
}
