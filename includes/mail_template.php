<?php
/**
 * Gabarits HTML des e-mails envoyés par le site (couleurs Kané, compatibles Gmail/Outlook : tableaux + CSS en ligne).
 * Chaque fonction retourne ['html' => ..., 'texte' => ...].
 */

function mail_template_echapper($t)
{
    return htmlspecialchars((string) $t, ENT_QUOTES, 'UTF-8');
}

/** Enveloppe commune : en-tête orange, carte blanche, pied de page. */
function mail_template_enveloppe($titre, $contenuHtml, $preEntete = '')
{
    $e = 'mail_template_echapper';
    $annee = date('Y');
    return <<<HTML
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$e($titre)}</title>
</head>
<body style="margin:0;padding:0;background:#f1f3f6;font-family:Arial,Helvetica,sans-serif;color:#2b3240;">
<div style="display:none;max-height:0;overflow:hidden;opacity:0;">{$e($preEntete)}</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f1f3f6;padding:28px 12px;">
  <tr><td align="center">
    <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">
      <tr>
        <td style="background:#0E121D;border-radius:12px 12px 0 0;padding:22px 28px;">
          <table role="presentation" width="100%" cellpadding="0" cellspacing="0"><tr>
            <td style="font-size:20px;font-weight:bold;color:#ffffff;letter-spacing:.3px;">
              <span style="display:inline-block;width:12px;height:12px;background:#FF5E14;border-radius:3px;margin-right:10px;vertical-align:middle;"></span>Kané Eco-Construction
            </td>
            <td align="right" style="font-size:12px;color:#9aa3b2;text-transform:uppercase;letter-spacing:1px;">Site web</td>
          </tr></table>
        </td>
      </tr>
      <tr><td style="height:5px;background:#FF5E14;"></td></tr>
      <tr>
        <td style="background:#ffffff;padding:30px 28px 26px;">
          {$contenuHtml}
        </td>
      </tr>
      <tr>
        <td style="background:#ffffff;border-radius:0 0 12px 12px;border-top:1px solid #e9ecf0;padding:16px 28px;font-size:12px;color:#8a93a3;line-height:1.6;">
          Kané Eco-Construction · BP 10727 Niamey, Niger · +227 93 33 34 35<br>
          © {$annee} kane-eco-construction.com — e-mail généré automatiquement par le site.
        </td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
HTML;
}

function mail_template_ligne($libelle, $valeurHtml)
{
    return '<tr>'
        . '<td style="padding:10px 12px;border-bottom:1px solid #eef1f4;font-size:13px;color:#6b7280;width:120px;vertical-align:top;white-space:nowrap;">' . mail_template_echapper($libelle) . '</td>'
        . '<td style="padding:10px 12px;border-bottom:1px solid #eef1f4;font-size:15px;color:#0E121D;font-weight:bold;vertical-align:top;">' . $valeurHtml . '</td>'
        . '</tr>';
}

/**
 * E-mail reçu par l'entreprise lors d'une demande via le formulaire.
 * @param array $d nom, email, telephone, sujet, message, date
 */
function mail_template_contact(array $d)
{
    $e = 'mail_template_echapper';
    $sujet = $d['sujet'] !== '' ? $d['sujet'] : 'Nouveau message';
    $tel = preg_replace('/[^0-9+]/', '', $d['telephone']);
    $messageHtml = nl2br($e($d['message']));

    $lignes = mail_template_ligne('Nom', $e($d['nom']))
        . mail_template_ligne('E-mail', '<a href="mailto:' . $e($d['email']) . '" style="color:#FF5E14;text-decoration:none;">' . $e($d['email']) . '</a>')
        . mail_template_ligne('Téléphone', '<a href="tel:' . $e($tel) . '" style="color:#FF5E14;text-decoration:none;">' . $e($d['telephone']) . '</a>')
        . mail_template_ligne('Objet', $e($sujet))
        . mail_template_ligne('Reçu le', $e($d['date']));

    $wa = $tel !== '' ? 'https://wa.me/' . ltrim($tel, '+') : '';
    $boutons = '<a href="mailto:' . $e($d['email']) . '?subject=' . rawurlencode('Re: ' . $sujet) . '" style="display:inline-block;background:#FF5E14;color:#ffffff;text-decoration:none;font-weight:bold;font-size:14px;padding:12px 20px;border-radius:7px;margin:0 8px 8px 0;">Répondre par e-mail</a>'
        . ($wa ? '<a href="' . $e($wa) . '" style="display:inline-block;background:#25D366;color:#ffffff;text-decoration:none;font-weight:bold;font-size:14px;padding:12px 20px;border-radius:7px;margin:0 0 8px 0;">Écrire sur WhatsApp</a>' : '');

    $contenu = <<<HTML
<p style="margin:0 0 6px;font-size:12px;color:#FF5E14;text-transform:uppercase;letter-spacing:1px;font-weight:bold;">Nouvelle demande de contact</p>
<h1 style="margin:0 0 18px;font-size:22px;line-height:1.3;color:#0E121D;">{$e($sujet)}</h1>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #eef1f4;border-radius:8px;border-collapse:separate;overflow:hidden;margin-bottom:22px;">
{$lignes}
</table>
<p style="margin:0 0 8px;font-size:12px;color:#6b7280;text-transform:uppercase;letter-spacing:1px;font-weight:bold;">Message</p>
<div style="background:#f8f9fb;border-left:4px solid #FF5E14;border-radius:0 8px 8px 0;padding:16px 18px;font-size:15px;line-height:1.65;color:#2b3240;margin-bottom:24px;">{$messageHtml}</div>
<div>{$boutons}</div>
<p style="margin:18px 0 0;font-size:13px;color:#8a93a3;line-height:1.6;">Le bouton « Répondre » de votre messagerie fonctionne aussi : la réponse ira directement à {$e($d['email'])}.</p>
HTML;

    $texte = "Nouvelle demande de contact depuis kane-eco-construction.com\n\n"
        . "Nom       : {$d['nom']}\n"
        . "E-mail    : {$d['email']}\n"
        . "Téléphone : {$d['telephone']}\n"
        . "Objet     : $sujet\n"
        . "Reçu le   : {$d['date']}\n\n"
        . "Message :\n{$d['message']}\n\n"
        . "Pour répondre, utilisez « Répondre » : la réponse ira à {$d['email']}.\n";

    return [
        'html' => mail_template_enveloppe('[Site web] ' . $sujet . ' - ' . $d['nom'], $contenu, $d['nom'] . ' : ' . mb_substr($d['message'], 0, 90)),
        'texte' => $texte,
    ];
}

/** E-mail de test envoyé depuis le portail. */
function mail_template_test($mode, $destinataire)
{
    $e = 'mail_template_echapper';
    $modeLibelle = $mode === 'smtp' ? 'SMTP authentifié' : 'fonction mail() du serveur';
    $date = date('d/m/Y à H:i');
    $contenu = <<<HTML
<p style="margin:0 0 6px;font-size:12px;color:#FF5E14;text-transform:uppercase;letter-spacing:1px;font-weight:bold;">Test de configuration</p>
<h1 style="margin:0 0 14px;font-size:22px;color:#0E121D;">Le formulaire de contact fonctionne ✔</h1>
<p style="margin:0 0 16px;font-size:15px;line-height:1.65;">Cet e-mail a été envoyé depuis le portail d'administration du site le {$e($date)}, en mode <strong>{$e($modeLibelle)}</strong>, vers <strong>{$e($destinataire)}</strong>.</p>
<p style="margin:0;font-size:14px;line-height:1.65;color:#6b7280;">Si vous le lisez, les visiteurs qui remplissent le formulaire vous joindront bien à cette adresse.</p>
HTML;
    return [
        'html' => mail_template_enveloppe('Test du formulaire de contact', $contenu, 'Le formulaire de contact du site fonctionne.'),
        'texte' => "Test de configuration envoyé le $date en mode $modeLibelle vers $destinataire.\nSi vous lisez ceci, le formulaire de contact du site fonctionne.\n",
    ];
}
