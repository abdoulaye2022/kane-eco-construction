<?php
/**
 * Chiffrement des secrets stockés sur le serveur (mot de passe SMTP).
 *
 * La clé est générée une fois dans data/.cle (droits 600) et n'est jamais versionnée.
 * Valeurs stockées sous la forme « enc:v1:<base64> » ; une valeur sans préfixe est
 * considérée en clair (compatibilité) et sera chiffrée à la prochaine sauvegarde.
 *
 * Utilise libsodium (XSalsa20-Poly1305) si disponible, sinon OpenSSL AES-256-GCM.
 */

define('SECRET_CLE_FICHIER', dirname(__DIR__) . '/data/.cle');
define('SECRET_PREFIXE', 'enc:v1:');

function secret_cle()
{
    static $cle = null;
    if ($cle !== null) {
        return $cle;
    }
    if (is_readable(SECRET_CLE_FICHIER)) {
        $lue = base64_decode(trim((string) file_get_contents(SECRET_CLE_FICHIER)), true);
        if ($lue !== false && strlen($lue) === 32) {
            return $cle = $lue;
        }
    }
    $dir = dirname(SECRET_CLE_FICHIER);
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    $cle = random_bytes(32);
    if (@file_put_contents(SECRET_CLE_FICHIER, base64_encode($cle) . "\n", LOCK_EX) === false) {
        return $cle = false;
    }
    @chmod(SECRET_CLE_FICHIER, 0600);
    return $cle;
}

function secret_est_chiffre($valeur)
{
    return is_string($valeur) && strpos($valeur, SECRET_PREFIXE) === 0;
}

/** Retourne la valeur chiffrée, ou la valeur en clair si aucun moteur n'est disponible. */
function secret_chiffrer($clair)
{
    $clair = (string) $clair;
    if ($clair === '' || secret_est_chiffre($clair)) {
        return $clair;
    }
    $cle = secret_cle();
    if ($cle === false) {
        return $clair;
    }
    if (function_exists('sodium_crypto_secretbox')) {
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $chiffre = sodium_crypto_secretbox($clair, $nonce, $cle);
        return SECRET_PREFIXE . 's:' . base64_encode($nonce . $chiffre);
    }
    if (function_exists('openssl_encrypt')) {
        $iv = random_bytes(12);
        $tag = '';
        $chiffre = openssl_encrypt($clair, 'aes-256-gcm', $cle, OPENSSL_RAW_DATA, $iv, $tag);
        if ($chiffre !== false) {
            return SECRET_PREFIXE . 'o:' . base64_encode($iv . $tag . $chiffre);
        }
    }
    return $clair;
}

/** Retourne la valeur en clair ; chaîne vide si le déchiffrement échoue. */
function secret_dechiffrer($stocke)
{
    $stocke = (string) $stocke;
    if (!secret_est_chiffre($stocke)) {
        return $stocke;
    }
    $cle = secret_cle();
    if ($cle === false) {
        return '';
    }
    $reste = substr($stocke, strlen(SECRET_PREFIXE));
    $moteur = substr($reste, 0, 2);
    $brut = base64_decode(substr($reste, 2), true);
    if ($brut === false) {
        return '';
    }
    if ($moteur === 's:' && function_exists('sodium_crypto_secretbox_open')) {
        $n = SODIUM_CRYPTO_SECRETBOX_NONCEBYTES;
        $clair = sodium_crypto_secretbox_open(substr($brut, $n), substr($brut, 0, $n), $cle);
        return $clair === false ? '' : $clair;
    }
    if ($moteur === 'o:' && function_exists('openssl_decrypt')) {
        $clair = openssl_decrypt(substr($brut, 28), 'aes-256-gcm', $cle, OPENSSL_RAW_DATA, substr($brut, 0, 12), substr($brut, 12, 16));
        return $clair === false ? '' : $clair;
    }
    return '';
}
