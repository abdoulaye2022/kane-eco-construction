<?php
include '../includes/header.php';

// Galerie des réalisations.
// Pour ajouter une photo : déposer le fichier dans public/assets/img/realisations/
// puis ajouter une ligne ici avec la catégorie voulue ('production', 'chantier' ou 'batiment').
$galerie = [
    // --- Production de briques de terre compressée ---
    ['production-presse-01.jpeg',  'production', "Presse Hydraform en action sur le site de production Kané Eco-Construction"],
    ['production-presse-03.jpeg',  'production', "Remplissage de la presse M7MI Super avec la terre tamisée"],
    ['production-presse-02.jpeg',  'production', "Fabrication de briques de terre compressée à Niamey"],
    ['production-briques-01.jpeg', 'production', "Briques de terre compressée en cours de séchage"],
    ['production-briques-02.jpeg', 'production', "Rangées de briques de terre compressée prêtes à la livraison"],
    ['production-briques-03.jpeg', 'production', "Stock de briques de terre compressée Kané Eco-Construction"],
    ['production-equipe-01.jpeg',  'production', "L'équipe Kané Eco-Construction sur la chaîne de production"],
    ['production-equipe-02.jpeg',  'production', "Équipe technique Kané autour de la presse à briques"],
    ['realisation_5.jpg',          'production', "Briques de terre compressée stockées sous hangar"],
    ['realisation_7.jpg',          'production', "Approvisionnement en briques sur le site de production"],
    ['realisation_11.jpg',         'production', "Ouvriers Kané Eco-Construction équipés sur le site"],
    ['realisation_12.jpg',         'production', "Aire de séchage des briques de terre compressée"],

    // --- Chantiers : gros œuvre ---
    ['realisation_2.jpg',  'chantier', "Terrassement et fondations d'un chantier Kané Eco-Construction"],
    ['realisation_4.jpg',  'chantier', "Ferraillage des semelles de fondation"],
    ['realisation_6.jpg',  'chantier', "Mise en place des poteaux d'un chantier à Niamey"],
    ['realisation_8.jpg',  'chantier', "Coulage des longrines en béton armé"],
    ['realisation_9.jpg',  'chantier', "Coulage du béton par l'équipe Kané Eco-Construction"],
    ['realisation_1.jpg',  'chantier', "Maçonnerie en briques de terre compressée"],
    ['realisation_10.jpg', 'chantier', "Montage d'un mur de clôture en briques de terre compressée"],

    // --- Bâtiments réalisés ---
    ['batiment-r2-01.jpeg',          'batiment', "Immeuble R+2 en briques de terre compressée apparentes"],
    ['batiment-r2-03.jpeg',          'batiment', "Immeuble R+2 réalisé par Kané Eco-Construction"],
    ['batiment-r2-02.jpeg',          'batiment', "Façade latérale d'un immeuble R+2 et son mur de clôture en BTC"],
    ['batiment-r2-05.jpeg',          'batiment', "Bâtiment en briques de terre compressée en cours de finition"],
    ['batiment-r2-04.jpeg',          'batiment', "Élévation d'un immeuble en briques de terre compressée"],
    ['batiment-villa-01.jpeg',       'batiment', "Villa R+1 en briques de terre compressée apparentes"],
    ['finition-menuiserie-01.jpeg',  'batiment', "Menuiseries et persiennes posées sur une façade en BTC"],
    ['finition-mur-01.jpeg',         'batiment', "Détail d'un mur en briques de terre compressée avec chaînage"],
];

$categories = [
    '*'          => 'Tout voir',
    'production' => 'Production de briques',
    'chantier'   => 'Chantiers en cours',
    'batiment'   => 'Bâtiments réalisés',
];
?>

<div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb_shape_1_1.png">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">NOS RÉALISATIONS</h1>
            <ul class="breadcumb-menu">
                <li><a href="accueil">Accueil</a></li>
                <li>Nos Réalisations</li>
            </ul>
        </div>
    </div>
</div>

<section class="space" id="project-sec">
    <div class="container">
        <div class="title-area text-center mb-40">
            <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt="img"> Portfolio</span>
            <h2 class="sec-title">Découvrez nos projets réalisés</h2>
            <p class="sec-text mt-20">De la fabrication de nos briques de terre compressée jusqu'à la livraison du
                bâtiment, nous maîtrisons toute la chaîne. Voici nos réalisations.</p>
        </div>

        <!-- Filtres -->
        <div class="galerie-filtres text-center mb-50">
            <?php $premier = true; foreach ($categories as $slug => $libelle): ?>
                <button type="button" class="galerie-filtre<?= $premier ? ' active' : '' ?>"
                    data-filtre="<?= $slug ?>"><?= $libelle ?></button>
            <?php $premier = false; endforeach; ?>
        </div>

        <!-- Galerie -->
        <div class="row gy-4 gx-4" id="galerie-grid">
            <?php foreach ($galerie as [$fichier, $categorie, $legende]): ?>
                <div class="col-md-6 col-lg-4 galerie-item" data-categorie="<?= $categorie ?>">
                    <div class="gallery-card">
                        <a href="assets/img/realisations/<?= rawurlencode($fichier) ?>" class="galerie-photo"
                            title="<?= htmlspecialchars($legende, ENT_QUOTES) ?>">
                            <img src="assets/img/realisations/<?= rawurlencode($fichier) ?>"
                                alt="<?= htmlspecialchars($legende, ENT_QUOTES) ?>" class="w-100" loading="lazy">
                            <div class="gallery-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Vidéos -->
        <div class="title-area text-center mt-80 mb-50">
            <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt="img"> Vidéos</span>
            <h2 class="sec-title">Nos réalisations en vidéo</h2>
        </div>

        <div class="row gy-4 gx-4">
            <div class="col-md-6">
                <div class="gallery-card">
                    <video width="100%" height="auto" controls preload="metadata" style="border-radius: 10px;">
                        <source src="assets/img/realisations/realisation_video_1.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
            </div>

            <div class="col-md-6">
                <div class="gallery-card">
                    <video width="100%" height="auto" controls preload="metadata" style="border-radius: 10px;">
                        <source src="assets/img/realisations/realisation_video_2.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-60">
            <p class="mb-3 fs-5">Vous avez un projet en tête ?</p>
            <a href="contact" class="th-btn">Contactez-nous pour un devis <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<style>
.galerie-filtres {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}

.galerie-filtre {
    background: transparent;
    border: 1px solid #e3e3e3;
    border-radius: 30px;
    padding: 10px 26px;
    font-family: var(--title-font);
    font-size: 15px;
    font-weight: 600;
    color: var(--title-color);
    transition: all 0.3s ease;
}

.galerie-filtre:hover {
    border-color: var(--theme-color);
    color: var(--theme-color);
}

.galerie-filtre.active {
    background: var(--theme-color);
    border-color: var(--theme-color);
    color: #fff;
}

.galerie-item.is-hidden {
    display: none;
}

.gallery-card {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.gallery-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.gallery-card img {
    display: block;
    border-radius: 10px;
    transition: transform 0.4s ease;
    height: 280px;
    object-fit: cover;
}

.gallery-card:hover img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 94, 20, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 10px;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    color: #fff;
    font-size: 2.5rem;
}
</style>

<script>
// jQuery et Magnific Popup sont chargés en bas de page (footer.php),
// on attend donc le chargement complet avant d'initialiser la lightbox.
window.addEventListener('load', function () {
    var boutons = document.querySelectorAll('.galerie-filtre'),
        items = document.querySelectorAll('#galerie-grid .galerie-item');

    // La lightbox n'affiche que les photos de la catégorie active.
    function initLightbox() {
        jQuery('#galerie-grid').magnificPopup({
            delegate: '.galerie-item:not(.is-hidden) .galerie-photo',
            type: 'image',
            gallery: { enabled: true },
            image: {
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            }
        });
    }

    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            var filtre = bouton.dataset.filtre;

            boutons.forEach(function (b) { b.classList.remove('active'); });
            bouton.classList.add('active');

            items.forEach(function (item) {
                var visible = (filtre === '*' || item.dataset.categorie === filtre);
                item.classList.toggle('is-hidden', !visible);
            });

            initLightbox();
        });
    });

    initLightbox();
});
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
