<?php
// Récupère l'URL demandée
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$request = str_replace('kane-eco-construction/public/', '', $request); // Enlevez le dossier du projet si nécessaire

// Routage des pages
switch ($request) {
    case '':
        require __DIR__ . '/../pages/home.php';
        break;
    case 'accueil':
        require __DIR__ . '/../pages/home.php';
        break;
    case 'contact':
        require __DIR__ . '/../pages/contact.php';
        break;
    default:
        require __DIR__ . '/../pages/404.php';
        break;
}
