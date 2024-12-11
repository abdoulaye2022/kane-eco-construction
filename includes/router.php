<?php
// Définir le dossier public
$publicDir = '/kane-eco-construction/public';

// Récupérer l'URL complète après le nom de domaine
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Vérifier si l'URL contient une extension .php
if (preg_match('/\.php$/', $requestUri)) {
    // Rediriger vers la page 404
    header("Location: /kane-eco-construction/public/not-found");
    exit;
}

// Supprimer le chemin vers le dossier public pour obtenir le path après
$pathAfterPublic = str_replace($publicDir, '', $requestUri);

// Nettoyer le path (supprimer les slashs initiaux et les extensions .php)
$pathAfterPublic = trim($pathAfterPublic, '/');
$pathAfterPublic = str_replace('.php', '', $pathAfterPublic);

// Fonction pour sécuriser les includes
function secureInclude($filePath) {
    if (file_exists($filePath)) {
        require $filePath;
    } else {
        require __DIR__ . '/../pages/404.php';
    }
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
    case 'a-propos-de-nous':
        require_once(__DIR__ . '/../pages/about.php');
        break;
    case 'nos-services':
        require_once(__DIR__ . '/../pages/nos-services.php');
        break;
    default:
        require_once(__DIR__ . '/../pages/404.php');
        break;
}