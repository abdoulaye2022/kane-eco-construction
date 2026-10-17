<?php
date_default_timezone_set('Africa/Niamey');

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    // Environnement de développement
    define('BASE_URL', 'http://localhost/kane-eco-construction/public/');
    define('ROOT_PATH', __DIR__ . '/../');
    // En local, les messages du formulaire de contact arrivent chez le développeur.
    define('CONTACT_EMAIL', 'm2atodev@gmail.com');
} else {
    // Environnement de production
    define('BASE_URL', 'https://kane-eco-construction.com/');
    define('ROOT_PATH', __DIR__ . '/../');
    define('CONTACT_EMAIL', 'contact@kane-eco-construction.com');
}
