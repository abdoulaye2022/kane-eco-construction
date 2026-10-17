<?php
/**
 * Portail d'administration des images : /admin
 *
 * Variables attendues depuis le routeur :
 *   $adminRoute : chemin après « admin » ('' , 'connexion', 'ajouter', ...)
 *   $siteBase   : préfixe d'URL du site ('/' en production)
 */

require_once __DIR__ . '/../galerie.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/images.php';
require_once __DIR__ . '/../mailer.php';

$adminBase = rtrim($siteBase, '/') . '/admin';
auth_demarrer_session();

/* ---------- Utilitaires locaux ---------- */

function admin_rediriger($url)
{
    header('Location: ' . $url, true, 303);
    exit;
}

function admin_flash($type, $message)
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function admin_flashs()
{
    $f = isset($_SESSION['flash']) ? $_SESSION['flash'] : [];
    unset($_SESSION['flash']);
    return $f;
}

function admin_vue($nom, array $vars = [])
{
    extract($vars);
    require __DIR__ . '/vues/' . $nom . '.php';
    exit;
}

function e($texte)
{
    return htmlspecialchars((string) $texte, ENT_QUOTES, 'UTF-8');
}

$estPost = ($_SERVER['REQUEST_METHOD'] === 'POST');
if ($estPost && !csrf_valide()) {
    admin_flash('erreur', "Session expirée ou formulaire invalide, merci de recommencer.");
    admin_rediriger($adminBase);
}

/* ---------- Première installation : création du compte ---------- */

if (!auth_compte_existe()) {
    if ($adminRoute !== 'installation') {
        admin_rediriger($adminBase . '/installation');
    }
    $erreur = null;
    if ($estPost) {
        $identifiant = trim(isset($_POST['identifiant']) ? $_POST['identifiant'] : '');
        $mdp = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : '';
        $conf = isset($_POST['confirmation']) ? $_POST['confirmation'] : '';
        if ($identifiant === '' || strlen($identifiant) < 3) {
            $erreur = "Choisissez un identifiant d'au moins 3 caractères.";
        } else {
            $erreur = auth_valider_mot_de_passe($mdp, $conf);
        }
        if ($erreur === null) {
            if (auth_enregistrer_compte($identifiant, $mdp)) {
                auth_connecter();
                admin_flash('succes', "Compte administrateur créé. Bienvenue !");
                admin_rediriger($adminBase);
            }
            $erreur = "Impossible d'écrire le fichier de compte : vérifiez que le dossier « data » est accessible en écriture.";
        }
    }
    admin_vue('installation', ['erreur' => $erreur, 'adminBase' => $adminBase, 'siteBase' => $siteBase]);
}

/* ---------- Connexion / déconnexion ---------- */

if ($adminRoute === 'installation') {
    admin_rediriger($adminBase);
}

if ($adminRoute === 'deconnexion') {
    auth_deconnecter();
    admin_rediriger($adminBase . '/connexion');
}

if (!auth_est_connecte()) {
    $erreur = null;
    if ($estPost && $adminRoute === 'connexion') {
        $erreur = auth_tenter_connexion(
            trim(isset($_POST['identifiant']) ? $_POST['identifiant'] : ''),
            isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : ''
        );
        if ($erreur === null) {
            admin_rediriger($adminBase);
        }
    } elseif ($adminRoute !== 'connexion') {
        admin_rediriger($adminBase . '/connexion');
    }
    admin_vue('connexion', ['erreur' => $erreur, 'adminBase' => $adminBase, 'siteBase' => $siteBase]);
}

/* ---------- Actions sur la galerie (utilisateur connecté) ---------- */

$images = galerie_charger();

if ($estPost) {
    switch ($adminRoute) {

        case 'ajouter':
            $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
            if (!array_key_exists($categorie, galerie_categories())) {
                admin_flash('erreur', "Choisissez une catégorie valide.");
                break;
            }
            $legende = trim(isset($_POST['legende']) ? $_POST['legende'] : '');
            $fichiers = isset($_FILES['images']) ? $_FILES['images'] : null;
            if (!$fichiers || !is_array($fichiers['name'])) {
                admin_flash('erreur', "Aucune image sélectionnée.");
                break;
            }
            $ajoutees = 0;
            $nouvelles = [];
            foreach ($fichiers['name'] as $i => $nom) {
                if ($fichiers['error'][$i] === UPLOAD_ERR_NO_FILE) {
                    continue;
                }
                $r = images_traiter_upload([
                    'name' => $nom,
                    'tmp_name' => $fichiers['tmp_name'][$i],
                    'error' => $fichiers['error'][$i],
                    'size' => $fichiers['size'][$i],
                ]);
                if (!$r['ok']) {
                    admin_flash('erreur', e($nom) . " : " . $r['erreur']);
                    continue;
                }
                $nouvelles[] = [
                    'id' => galerie_nouvel_id(),
                    'src' => $r['src'],
                    'categorie' => $categorie,
                    'legende' => $legende !== '' ? $legende : pathinfo($nom, PATHINFO_FILENAME),
                    'ajoute_le' => date('Y-m-d H:i:s'),
                ];
                $ajoutees++;
            }
            if ($ajoutees > 0) {
                // Les nouvelles photos passent en tête de la galerie.
                $images = array_merge($nouvelles, $images);
                if (galerie_sauver($images)) {
                    admin_flash('succes', $ajoutees . ($ajoutees > 1 ? " images ajoutées" : " image ajoutée") . " à la galerie.");
                } else {
                    foreach ($nouvelles as $n) {
                        images_supprimer_fichier($n['src']);
                    }
                    admin_flash('erreur', "Images reçues mais impossible d'enregistrer la galerie (dossier « data » non accessible en écriture).");
                }
            }
            break;

        case 'modifier':
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
            $legende = trim(isset($_POST['legende']) ? $_POST['legende'] : '');
            $trouvee = false;
            foreach ($images as &$img) {
                if ($img['id'] === $id) {
                    if (array_key_exists($categorie, galerie_categories())) {
                        $img['categorie'] = $categorie;
                    }
                    $img['legende'] = mb_substr($legende, 0, 200);
                    $trouvee = true;
                }
            }
            unset($img);
            if ($trouvee && galerie_sauver($images)) {
                admin_flash('succes', "Image mise à jour.");
            } else {
                admin_flash('erreur', "Impossible de mettre à jour cette image.");
            }
            break;

        case 'remplacer':
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $ancienne = galerie_trouver($images, $id);
            if (!$ancienne || empty($_FILES['image'])) {
                admin_flash('erreur', "Image à remplacer introuvable.");
                break;
            }
            $r = images_traiter_upload($_FILES['image']);
            if (!$r['ok']) {
                admin_flash('erreur', "Remplacement impossible : " . $r['erreur']);
                break;
            }
            foreach ($images as &$img) {
                if ($img['id'] === $id) {
                    $img['src'] = $r['src'];
                    $img['ajoute_le'] = date('Y-m-d H:i:s');
                }
            }
            unset($img);
            if (galerie_sauver($images)) {
                images_supprimer_fichier($ancienne['src']);
                admin_flash('succes', "Image remplacée.");
            } else {
                images_supprimer_fichier($r['src']);
                admin_flash('erreur', "Impossible d'enregistrer le remplacement.");
            }
            break;

        case 'supprimer':
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $cible = galerie_trouver($images, $id);
            if (!$cible) {
                admin_flash('erreur', "Image introuvable.");
                break;
            }
            $images = array_values(array_filter($images, function ($img) use ($id) {
                return $img['id'] !== $id;
            }));
            if (galerie_sauver($images)) {
                images_supprimer_fichier($cible['src']);
                admin_flash('succes', "Image retirée du site.");
            } else {
                admin_flash('erreur', "Impossible d'enregistrer la suppression.");
            }
            break;

        case 'deplacer':
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $direction = isset($_POST['direction']) ? $_POST['direction'] : '';
            $index = null;
            foreach ($images as $i => $img) {
                if ($img['id'] === $id) {
                    $index = $i;
                }
            }
            if ($index === null) {
                admin_flash('erreur', "Image introuvable.");
                break;
            }
            $element = $images[$index];
            array_splice($images, $index, 1);
            if ($direction === 'premier') {
                $nouveau = 0;
            } elseif ($direction === 'haut') {
                $nouveau = max(0, $index - 1);
            } else {
                $nouveau = min(count($images), $index + 1);
            }
            array_splice($images, $nouveau, 0, [$element]);
            if (!galerie_sauver($images)) {
                admin_flash('erreur', "Impossible d'enregistrer le nouvel ordre.");
            }
            break;

        case 'email':
            $config = mailer_config();
            $action = isset($_POST['action']) ? $_POST['action'] : 'enregistrer';
            $texte = function ($nom, $max = 200) {
                return mb_substr(trim(isset($_POST[$nom]) ? (string) $_POST[$nom] : ''), 0, $max);
            };
            if ($action === 'enregistrer') {
                $destinataire = $texte('destinataire');
                $expediteur = $texte('expediteur');
                if (!filter_var($destinataire, FILTER_VALIDATE_EMAIL) || !filter_var($expediteur, FILTER_VALIDATE_EMAIL)) {
                    admin_flash('erreur', "Les adresses destinataire et expéditeur doivent être des e-mails valides.");
                    admin_rediriger($adminBase . '/email');
                }
                $config['destinataire'] = $destinataire;
                $config['expediteur'] = $expediteur;
                $config['nom_expediteur'] = $texte('nom_expediteur', 80) ?: 'Site Kané Eco-Construction';
                $config['smtp_actif'] = !empty($_POST['smtp_actif']);
                $config['smtp_hote'] = $texte('smtp_hote');
                $config['smtp_port'] = max(1, min(65535, (int) $texte('smtp_port', 6)));
                $config['smtp_securite'] = in_array($texte('smtp_securite'), ['ssl', 'tls', 'aucune'], true) ? $texte('smtp_securite') : 'ssl';
                $config['smtp_utilisateur'] = $texte('smtp_utilisateur');
                $nouveauMdp = isset($_POST['smtp_mot_de_passe']) ? (string) $_POST['smtp_mot_de_passe'] : '';
                if ($nouveauMdp !== '') {
                    $config['smtp_mot_de_passe'] = $nouveauMdp; // vide = on garde l'ancien
                }
                if ($config['smtp_actif'] && ($config['smtp_hote'] === '' || $config['smtp_utilisateur'] === '' || $config['smtp_mot_de_passe'] === '')) {
                    admin_flash('erreur', "Pour activer le SMTP, renseignez le serveur, l'identifiant et le mot de passe.");
                    admin_rediriger($adminBase . '/email');
                }
                if (mailer_config_sauver($config)) {
                    admin_flash('succes', "Paramètres d'envoi enregistrés. Envoyez un e-mail de test pour vérifier.");
                } else {
                    admin_flash('erreur', "Impossible d'écrire data/mail.json (droits d'écriture).");
                }
            } elseif ($action === 'tester') {
                $modeTest = ($config['smtp_actif'] && $config['smtp_utilisateur'] !== '') ? 'smtp' : 'mail';
                $gabaritTest = mail_template_test($modeTest, $config['destinataire']);
                $r = mailer_envoyer(
                    'Test du formulaire de contact - ' . date('d/m/Y H:i'),
                    $gabaritTest['texte'],
                    null,
                    null,
                    $gabaritTest['html']
                );
                if ($r['ok']) {
                    admin_flash('succes', "E-mail de test envoyé à " . e($config['destinataire']) . " (mode " . ($r['mode'] === 'smtp' ? 'SMTP' : 'mail() du serveur') . "). Vérifiez la boîte de réception et les spams.");
                } else {
                    admin_flash('erreur', "Échec de l'envoi de test (mode " . ($r['mode'] === 'smtp' ? 'SMTP' : 'mail()') . ") : " . e($r['erreur']));
                }
            }
            admin_rediriger($adminBase . '/email');
            break;

        case 'mot-de-passe':
            $compte = auth_lire_compte();
            $actuel = isset($_POST['actuel']) ? $_POST['actuel'] : '';
            $nouveau = isset($_POST['nouveau']) ? $_POST['nouveau'] : '';
            $conf = isset($_POST['confirmation']) ? $_POST['confirmation'] : '';
            if (!$compte || !password_verify($actuel, $compte['hash'])) {
                admin_flash('erreur', "Le mot de passe actuel est incorrect.");
            } elseif (($err = auth_valider_mot_de_passe($nouveau, $conf)) !== null) {
                admin_flash('erreur', $err);
            } elseif (auth_enregistrer_compte($compte['identifiant'], $nouveau)) {
                admin_flash('succes', "Mot de passe modifié.");
            } else {
                admin_flash('erreur', "Impossible d'enregistrer le nouveau mot de passe.");
            }
            admin_rediriger($adminBase . '/mot-de-passe');
            break;

        default:
            admin_flash('erreur', "Action inconnue.");
    }
    admin_rediriger($adminBase . (isset($_POST['filtre']) && $_POST['filtre'] !== '' ? '?categorie=' . rawurlencode($_POST['filtre']) : ''));
}

/* ---------- Pages ---------- */

$compte = auth_lire_compte();
$communs = [
    'adminBase' => $adminBase,
    'siteBase' => $siteBase,
    'flashs' => admin_flashs(),
    'identifiant' => $compte ? $compte['identifiant'] : '',
];

if ($adminRoute === 'mot-de-passe') {
    admin_vue('mot-de-passe', $communs);
}

if ($adminRoute === 'email') {
    $journal = GALERIE_DATA_DIR . '/messages.log';
    $dernieres = [];
    if (is_readable($journal)) {
        $lignes = file($journal, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $dernieres = array_reverse(array_slice($lignes, -10));
    }
    admin_vue('email', $communs + [
        'config' => mailer_config(),
        'phpmailer' => mailer_phpmailer_disponible(),
        'dernieres' => $dernieres,
    ]);
}

if ($adminRoute !== '' && $adminRoute !== 'connexion') {
    admin_rediriger($adminBase);
}

$filtre = isset($_GET['categorie']) && array_key_exists($_GET['categorie'], galerie_categories()) ? $_GET['categorie'] : '';
$compteurs = array_fill_keys(array_keys(galerie_categories()), 0);
foreach ($images as $img) {
    if (isset($compteurs[$img['categorie']])) {
        $compteurs[$img['categorie']]++;
    }
}
$affichees = $filtre === '' ? $images : array_values(array_filter($images, function ($img) use ($filtre) {
    return $img['categorie'] === $filtre;
}));

admin_vue('tableau', $communs + [
    'images' => $affichees,
    'total' => count($images),
    'compteurs' => $compteurs,
    'filtre' => $filtre,
    'categories' => galerie_categories(),
    'ecriturePossible' => galerie_ecriture_possible(),
    'uploadPossible' => is_dir(GALERIE_UPLOAD_DIR) ? is_writable(GALERIE_UPLOAD_DIR) : is_writable(dirname(GALERIE_UPLOAD_DIR)),
    'tailleMaxServeur' => ini_get('upload_max_filesize'),
]);
