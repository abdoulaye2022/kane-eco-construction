<?php
/**
 * Point d'entrée unique du site.
 */
$estLocal = in_array(isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '', ['localhost', '127.0.0.1'], true);
$estHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

// Erreurs : affichées en local seulement, journalisées en production.
error_reporting(E_ALL);
ini_set('display_errors', $estLocal ? '1' : '0');
ini_set('display_startup_errors', $estLocal ? '1' : '0');
ini_set('log_errors', '1');

// En production, tout passe en HTTPS (le portail d'administration en dépend).
if (!$estLocal && !$estHttps) {
    $hote = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'kane-eco-construction.com';
    header('Location: https://' . $hote . $_SERVER['REQUEST_URI'], true, 301);
    exit;
}

// En-têtes de sécurité communs à toutes les pages.
header_remove('X-Powered-By');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
if ($estHttps) {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
}

// Charger la configuration et les fonctions
require_once __DIR__ . '/../config/config.php';
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/router.php';
