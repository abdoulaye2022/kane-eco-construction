<?php
/**
 * Réception et traitement des images envoyées depuis le portail.
 * - vérifie qu'il s'agit bien d'une image (JPEG, PNG, WebP), taille max 15 Mo ;
 * - redimensionne à 1600 px de large maximum et ré-encode (GD) pour alléger le site ;
 * - enregistre sous un nom sûr dans public/uploads/realisations/.
 *
 * Retourne ['ok' => true, 'src' => 'uploads/realisations/xxx.jpg'] ou ['ok' => false, 'erreur' => '...'].
 */

define('IMAGES_TAILLE_MAX', 15 * 1024 * 1024);
define('IMAGES_LARGEUR_MAX', 1600);
define('IMAGES_QUALITE_JPEG', 84);

function images_message_erreur_upload($code)
{
    switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return "Le fichier dépasse la taille maximale autorisée par le serveur.";
        case UPLOAD_ERR_PARTIAL:
            return "Le fichier n'a été envoyé que partiellement, réessayez.";
        case UPLOAD_ERR_NO_FILE:
            return "Aucun fichier reçu.";
        default:
            return "Erreur technique lors de l'envoi (code $code).";
    }
}

/**
 * @param array $fichier Une entrée de $_FILES (déjà « aplatie » : name, tmp_name, error, size).
 */
function images_traiter_upload(array $fichier)
{
    if (!isset($fichier['error']) || $fichier['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'erreur' => images_message_erreur_upload(isset($fichier['error']) ? $fichier['error'] : -1)];
    }
    if (!is_uploaded_file($fichier['tmp_name'])) {
        return ['ok' => false, 'erreur' => "Fichier invalide."];
    }
    if ($fichier['size'] > IMAGES_TAILLE_MAX) {
        return ['ok' => false, 'erreur' => "Le fichier dépasse 15 Mo."];
    }

    $info = @getimagesize($fichier['tmp_name']);
    if ($info === false) {
        return ['ok' => false, 'erreur' => "Ce fichier n'est pas une image lisible."];
    }
    $types = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_WEBP => 'webp'];
    if (!isset($types[$info[2]])) {
        return ['ok' => false, 'erreur' => "Format non accepté : utilisez JPEG, PNG ou WebP."];
    }
    $extension = $types[$info[2]];

    if (!is_dir(GALERIE_UPLOAD_DIR) && !@mkdir(GALERIE_UPLOAD_DIR, 0755, true)) {
        return ['ok' => false, 'erreur' => "Impossible de créer le dossier des images sur le serveur."];
    }
    if (!is_writable(GALERIE_UPLOAD_DIR)) {
        return ['ok' => false, 'erreur' => "Le dossier des images n'est pas accessible en écriture."];
    }

    // Les photos sont toujours ré-encodées en JPEG (sauf PNG avec transparence) : poids réduit, métadonnées EXIF retirées.
    $nom = 'realisation-' . date('Ymd') . '-' . bin2hex(random_bytes(4));
    $resultat = images_redimensionner($fichier['tmp_name'], $info, $extension, GALERIE_UPLOAD_DIR . '/' . $nom);

    if ($resultat === null) {
        // GD indisponible ou image non décodable : on garde l'original tel quel.
        $destination = GALERIE_UPLOAD_DIR . '/' . $nom . '.' . $extension;
        if (!@move_uploaded_file($fichier['tmp_name'], $destination)) {
            return ['ok' => false, 'erreur' => "Impossible d'enregistrer le fichier."];
        }
        $resultat = $destination;
    }

    @chmod($resultat, 0644);
    return ['ok' => true, 'src' => GALERIE_UPLOAD_URL . '/' . basename($resultat)];
}

/**
 * Redimensionne et ré-encode l'image. Retourne le chemin écrit, ou null si GD ne peut pas traiter.
 */
function images_redimensionner($chemin, array $info, $extension, $destinationSansExt)
{
    if (!function_exists('imagecreatetruecolor')) {
        return null;
    }
    switch ($extension) {
        case 'jpg':
            $source = @imagecreatefromjpeg($chemin);
            break;
        case 'png':
            $source = @imagecreatefrompng($chemin);
            break;
        case 'webp':
            $source = function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($chemin) : false;
            break;
        default:
            $source = false;
    }
    if (!$source) {
        return null;
    }

    // Respecter l'orientation EXIF des photos de téléphone.
    if ($extension === 'jpg' && function_exists('exif_read_data')) {
        $exif = @exif_read_data($chemin);
        if (!empty($exif['Orientation'])) {
            switch ((int) $exif['Orientation']) {
                case 3:
                    $source = imagerotate($source, 180, 0);
                    break;
                case 6:
                    $source = imagerotate($source, -90, 0);
                    break;
                case 8:
                    $source = imagerotate($source, 90, 0);
                    break;
            }
        }
    }

    $largeur = imagesx($source);
    $hauteur = imagesy($source);
    $ratio = min(1, IMAGES_LARGEUR_MAX / max(1, $largeur));
    $nl = (int) round($largeur * $ratio);
    $nh = (int) round($hauteur * $ratio);

    $transparent = ($extension === 'png');
    $cible = imagecreatetruecolor($nl, $nh);
    if ($transparent) {
        imagealphablending($cible, false);
        imagesavealpha($cible, true);
    } else {
        $blanc = imagecolorallocate($cible, 255, 255, 255);
        imagefill($cible, 0, 0, $blanc);
    }
    imagecopyresampled($cible, $source, 0, 0, 0, 0, $nl, $nh, $largeur, $hauteur);
    imagedestroy($source);

    if ($transparent) {
        $destination = $destinationSansExt . '.png';
        $ok = imagepng($cible, $destination, 7);
    } else {
        $destination = $destinationSansExt . '.jpg';
        $ok = imagejpeg($cible, $destination, IMAGES_QUALITE_JPEG);
    }
    imagedestroy($cible);

    return $ok ? $destination : null;
}

/** Supprime physiquement une image si (et seulement si) elle vient du portail. */
function images_supprimer_fichier($src)
{
    if (!galerie_est_upload($src)) {
        return true; // image historique versionnée : on la laisse sur le disque
    }
    $chemin = realpath(galerie_chemin_disque($src));
    $racine = realpath(GALERIE_UPLOAD_DIR);
    if ($chemin === false || $racine === false || strpos($chemin, $racine . DIRECTORY_SEPARATOR) !== 0) {
        return false;
    }
    return @unlink($chemin);
}
