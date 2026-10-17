<?php
/**
 * Authentification du portail d'administration.
 * - un seul compte, stocké (identifiant + hash bcrypt) dans data/admin.json ;
 * - tant que ce fichier n'existe pas, le portail propose de créer le compte ;
 * - 5 échecs de connexion par adresse IP => blocage 15 minutes ;
 * - jeton CSRF sur toutes les actions.
 */

define('ADMIN_COMPTE', GALERIE_DATA_DIR . '/admin.json');
define('ADMIN_TENTATIVES', GALERIE_DATA_DIR . '/tentatives.json');
define('ADMIN_MAX_ECHECS', 5);
define('ADMIN_BLOCAGE_SECONDES', 15 * 60);
define('ADMIN_SESSION_DUREE', 8 * 3600);

function auth_demarrer_session()
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_name('kane_admin');
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => $https,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();

    // Expiration par inactivité.
    if (isset($_SESSION['admin_vu_le']) && time() - $_SESSION['admin_vu_le'] > ADMIN_SESSION_DUREE) {
        auth_deconnecter();
        session_start();
    }
    $_SESSION['admin_vu_le'] = time();
}

function auth_compte_existe()
{
    return file_exists(ADMIN_COMPTE);
}

function auth_lire_compte()
{
    if (!auth_compte_existe()) {
        return null;
    }
    $compte = json_decode((string) @file_get_contents(ADMIN_COMPTE), true);
    return (is_array($compte) && !empty($compte['hash'])) ? $compte : null;
}

function auth_enregistrer_compte($identifiant, $motDePasse)
{
    if (!is_dir(GALERIE_DATA_DIR) && !@mkdir(GALERIE_DATA_DIR, 0755, true)) {
        return false;
    }
    $compte = [
        'identifiant' => $identifiant,
        'hash'        => password_hash($motDePasse, PASSWORD_DEFAULT),
        'modifie_le'  => date('Y-m-d H:i:s'),
    ];
    $ok = @file_put_contents(ADMIN_COMPTE, json_encode($compte, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
    if ($ok !== false) {
        @chmod(ADMIN_COMPTE, 0600);
    }
    return $ok !== false;
}

function auth_valider_mot_de_passe($mdp, $confirmation)
{
    if (strlen($mdp) < 10) {
        return "Le mot de passe doit contenir au moins 10 caractères.";
    }
    if ($mdp !== $confirmation) {
        return "Les deux mots de passe ne correspondent pas.";
    }
    return null;
}

function auth_est_connecte()
{
    return !empty($_SESSION['admin_connecte']);
}

function auth_connecter()
{
    session_regenerate_id(true);
    $_SESSION['admin_connecte'] = true;
    $_SESSION['admin_vu_le'] = time();
}

function auth_deconnecter()
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

/** Vérifie identifiant + mot de passe, en appliquant le blocage anti force brute. */
function auth_tenter_connexion($identifiant, $motDePasse)
{
    $ip = auth_ip();
    $tentatives = auth_lire_tentatives();
    $t = isset($tentatives[$ip]) ? $tentatives[$ip] : ['n' => 0, 'depuis' => 0];

    if ($t['n'] >= ADMIN_MAX_ECHECS && time() - $t['depuis'] < ADMIN_BLOCAGE_SECONDES) {
        $restant = (int) ceil((ADMIN_BLOCAGE_SECONDES - (time() - $t['depuis'])) / 60);
        return "Trop de tentatives. Réessayez dans $restant minute(s).";
    }

    $compte = auth_lire_compte();
    $ok = $compte
        && hash_equals($compte['identifiant'], $identifiant)
        && password_verify($motDePasse, $compte['hash']);

    if ($ok) {
        unset($tentatives[$ip]);
        auth_ecrire_tentatives($tentatives);
        auth_connecter();
        return null;
    }

    if ($t['n'] >= ADMIN_MAX_ECHECS) {
        $t = ['n' => 0, 'depuis' => 0]; // ancien blocage expiré
    }
    $t['n']++;
    $t['depuis'] = time();
    $tentatives[$ip] = $t;
    auth_ecrire_tentatives($tentatives);
    return "Identifiant ou mot de passe incorrect.";
}

function auth_ip()
{
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'inconnue';
}

function auth_lire_tentatives()
{
    $d = json_decode((string) @file_get_contents(ADMIN_TENTATIVES), true);
    if (!is_array($d)) {
        return [];
    }
    // Nettoyage des entrées anciennes.
    foreach ($d as $ip => $t) {
        if (!isset($t['depuis']) || time() - $t['depuis'] > ADMIN_BLOCAGE_SECONDES * 4) {
            unset($d[$ip]);
        }
    }
    return $d;
}

function auth_ecrire_tentatives(array $d)
{
    @file_put_contents(ADMIN_TENTATIVES, json_encode($d), LOCK_EX);
}

/* ---------- CSRF ---------- */

function csrf_jeton()
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf'];
}

function csrf_champ()
{
    return '<input type="hidden" name="csrf" value="' . htmlspecialchars(csrf_jeton(), ENT_QUOTES) . '">';
}

function csrf_valide()
{
    return !empty($_POST['csrf']) && !empty($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}
