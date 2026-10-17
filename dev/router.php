<?php
/**
 * Routeur pour le serveur PHP intégré (développement local uniquement).
 *
 *   php -S localhost:8000 dev/router.php
 *
 * Sert les fichiers statiques de public/ directement, et envoie tout le reste à public/index.php
 * (comme le fait le .htaccess en production).
 */
$racine = dirname(__DIR__) . '/public';
$chemin = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($chemin !== '/' && is_file($racine . $chemin) && !preg_match('/\.php$/', $chemin)) {
    return false;
}
$_SERVER['SERVER_NAME'] = 'localhost';
chdir($racine);
require $racine . '/index.php';
