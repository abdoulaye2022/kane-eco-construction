<?php
/**
 * Couche de données de la galerie « Nos réalisations ».
 *
 * Les images sont décrites dans data/galerie.json (fichier vivant, modifié par le
 * portail d'administration, jamais versionné). À la première utilisation il est
 * créé à partir de data/galerie.seed.json (versionné).
 *
 * Chaque entrée : id, src (chemin relatif au dossier public), categorie, legende, ajoute_le.
 */

define('GALERIE_DATA_DIR', dirname(__DIR__) . '/data');
define('GALERIE_FICHIER', GALERIE_DATA_DIR . '/galerie.json');
define('GALERIE_SEED', GALERIE_DATA_DIR . '/galerie.seed.json');
define('GALERIE_UPLOAD_DIR', dirname(__DIR__) . '/public/uploads/realisations');
define('GALERIE_UPLOAD_URL', 'uploads/realisations');

/** Catégories disponibles (slug => libellé). */
function galerie_categories()
{
    return [
        'production' => 'Production de briques',
        'chantier'   => 'Chantiers en cours',
        'batiment'   => 'Bâtiments réalisés',
    ];
}

function galerie_categorie_libelle($slug)
{
    $cats = galerie_categories();
    return isset($cats[$slug]) ? $cats[$slug] : ucfirst($slug);
}

/** Lit le JSON ; retourne un tableau normalisé (jamais d'exception). */
function galerie_charger()
{
    $fichier = file_exists(GALERIE_FICHIER) ? GALERIE_FICHIER : GALERIE_SEED;
    $contenu = @file_get_contents($fichier);
    $donnees = $contenu ? json_decode($contenu, true) : null;
    if (!is_array($donnees) || !isset($donnees['images']) || !is_array($donnees['images'])) {
        $donnees = ['images' => []];
    }

    $images = [];
    foreach ($donnees['images'] as $img) {
        if (empty($img['src'])) {
            continue;
        }
        $images[] = [
            'id'        => isset($img['id']) ? (string) $img['id'] : galerie_nouvel_id(),
            'src'       => (string) $img['src'],
            'categorie' => isset($img['categorie']) ? (string) $img['categorie'] : 'chantier',
            'legende'   => isset($img['legende']) ? (string) $img['legende'] : '',
            'ajoute_le' => isset($img['ajoute_le']) ? (string) $img['ajoute_le'] : '',
        ];
    }
    return $images;
}

/** Écrit le JSON de façon atomique. Retourne true/false. */
function galerie_sauver(array $images)
{
    if (!is_dir(GALERIE_DATA_DIR) && !@mkdir(GALERIE_DATA_DIR, 0755, true)) {
        return false;
    }
    $json = json_encode(['images' => array_values($images)], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        return false;
    }
    $tmp = GALERIE_FICHIER . '.tmp';
    if (@file_put_contents($tmp, $json, LOCK_EX) === false) {
        return false;
    }
    return @rename($tmp, GALERIE_FICHIER);
}

/** Le dossier de données est-il utilisable en écriture ? */
function galerie_ecriture_possible()
{
    if (file_exists(GALERIE_FICHIER)) {
        return is_writable(GALERIE_FICHIER) && is_writable(GALERIE_DATA_DIR);
    }
    return is_writable(GALERIE_DATA_DIR);
}

function galerie_nouvel_id()
{
    return bin2hex(random_bytes(6));
}

/** Retourne l'image dont l'id correspond, ou null. */
function galerie_trouver(array $images, $id)
{
    foreach ($images as $img) {
        if ($img['id'] === $id) {
            return $img;
        }
    }
    return null;
}

/** Les N dernières images ajoutées (pour la page d'accueil). */
function galerie_dernieres(array $images, $n = 8)
{
    $tri = $images;
    usort($tri, function ($a, $b) {
        return strcmp($b['ajoute_le'], $a['ajoute_le']);
    });
    return array_slice($tri, 0, $n);
}

/** Un fichier est-il géré par le portail (donc supprimable du disque) ? */
function galerie_est_upload($src)
{
    return strpos($src, GALERIE_UPLOAD_URL . '/') === 0;
}

/** Chemin absolu sur le disque d'un src relatif au dossier public. */
function galerie_chemin_disque($src)
{
    return dirname(__DIR__) . '/public/' . $src;
}

/** URL encodée (les anciens fichiers contiennent parfois des espaces). */
function galerie_url($src)
{
    return implode('/', array_map('rawurlencode', explode('/', $src)));
}
