<?php
// Définir le dossier public (préfixe présent uniquement en développement local sous Apache)
$publicDir = '/kane-eco-construction/public';

// Récupérer l'URL complète après le nom de domaine
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Préfixe d'URL du site : '/kane-eco-construction/public/' en local, '/' en production.
$siteBase = (strpos($requestUri, $publicDir) === 0) ? $publicDir . '/' : '/';

// Vérifier si l'URL contient une extension .php
if (preg_match('/\.php$/', $requestUri)) {
    // Rediriger vers la page 404
    header("Location: " . $siteBase . "not-found");
    exit;
}

// Supprimer le chemin vers le dossier public pour obtenir le path après
$pathAfterPublic = str_replace($publicDir, '', $requestUri);

// Nettoyer le path (supprimer les slashs initiaux et les extensions .php)
$pathAfterPublic = trim($pathAfterPublic, '/');
$pathAfterPublic = str_replace('.php', '', $pathAfterPublic);

// Portail d'administration : /admin et /admin/<action>
if ($pathAfterPublic === 'admin' || strpos($pathAfterPublic, 'admin/') === 0) {
    $adminRoute = trim(substr($pathAfterPublic, 5), '/');
    require __DIR__ . '/admin/controleur.php';
    exit;
}

// Routage des pages
switch ($pathAfterPublic) {
    case '':
    case 'accueil':
        require_once(__DIR__ . '/../pages/home.php');
        break;
    case 'contact':
        require_once(__DIR__ . '/../pages/contact.php');
        break;
    case 'contact/envoyer':
        require_once(__DIR__ . '/contact_envoyer.php');
        break;
    case 'a-propos-de-nous':
        require_once(__DIR__ . '/../pages/about.php');
        break;
    case 'nos-services':
        require_once(__DIR__ . '/../pages/nos-services.php');
        break;
    case 'nos-realisations':
    case 'realisations':
        require_once(__DIR__ . '/../pages/realisations.php');
        break;
    default:
        http_response_code(404);
        require_once(__DIR__ . '/../pages/404.php');
        break;
}
