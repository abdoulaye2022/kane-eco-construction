<?php
$page_title = 'Nos réalisations';
$page_description = "Photos et vidéos des chantiers de Kané Eco-Construction au Niger : production de briques de terre compressée, gros œuvre, immeubles R+2 et villas en BTC.";
require_once __DIR__ . '/../includes/galerie.php';
include '../includes/header.php';

// La galerie est gérée depuis le portail d'administration (/admin) : data/galerie.json.
$galerie = galerie_charger();
$categories = ['*' => 'Tout voir'] + galerie_categories();
$compteurs = ['*' => count($galerie)];
foreach ($galerie as $img) {
    $compteurs[$img['categorie']] = (isset($compteurs[$img['categorie']]) ? $compteurs[$img['categorie']] : 0) + 1;
}
?>

<div class="breadcumb-wrapper">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Nos réalisations</h1>
            <ul class="breadcumb-menu">
                <li><a href="accueil">Accueil</a></li>
                <li>Nos réalisations</li>
            </ul>
        </div>
    </div>
</div>

<section class="space" id="project-sec">
    <div class="container">
        <div class="title-area text-center mb-40">
            <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt=""> Portfolio</span>
            <h2 class="sec-title">Découvrez nos projets réalisés</h2>
            <p class="sec-text mt-20">De la fabrication de nos briques de terre compressée jusqu'à la livraison du
                bâtiment, nous maîtrisons toute la chaîne. Voici nos réalisations en images.</p>
        </div>

        <?php if (empty($galerie)): ?>
            <p class="text-center">La galerie est en cours de mise à jour, revenez bientôt.</p>
        <?php else: ?>
        <!-- Filtres -->
        <div class="galerie-filtres text-center mb-50">
            <?php $premier = true; foreach ($categories as $slug => $libelle): ?>
                <?php if ($slug !== '*' && empty($compteurs[$slug])) { continue; } ?>
                <button type="button" class="galerie-filtre<?= $premier ? ' active' : '' ?>" data-filtre="<?= $slug ?>">
                    <?= htmlspecialchars($libelle, ENT_QUOTES) ?><span class="nb"><?= (int) $compteurs[$slug] ?></span>
                </button>
            <?php $premier = false; endforeach; ?>
        </div>

        <!-- Galerie -->
        <div class="row gy-4 gx-4" id="galerie-grid">
            <?php foreach ($galerie as $img): ?>
                <div class="col-md-6 col-lg-4 galerie-item" data-categorie="<?= htmlspecialchars($img['categorie'], ENT_QUOTES) ?>">
                    <div class="gallery-card">
                        <span class="gallery-cat"><?= htmlspecialchars(galerie_categorie_libelle($img['categorie']), ENT_QUOTES) ?></span>
                        <a href="<?= galerie_url($img['src']) ?>" class="galerie-photo"
                            title="<?= htmlspecialchars($img['legende'], ENT_QUOTES) ?>">
                            <img src="<?= galerie_url($img['src']) ?>"
                                alt="<?= htmlspecialchars($img['legende'], ENT_QUOTES) ?>" loading="lazy">
                            <div class="gallery-overlay">
                                <p><?= htmlspecialchars($img['legende'], ENT_QUOTES) ?></p>
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Vidéos -->
        <div class="title-area text-center mt-80 mb-50">
            <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt=""> Vidéos</span>
            <h2 class="sec-title">Nos réalisations en vidéo</h2>
        </div>

        <div class="row gy-4 gx-4">
            <div class="col-md-6">
                <div class="gallery-video">
                    <video controls preload="metadata" playsinline poster="assets/img/realisations/production-equipe-01.jpeg">
                        <source src="assets/img/realisations/realisation_video_1.mp4" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
            </div>
            <div class="col-md-6">
                <div class="gallery-video">
                    <video controls preload="metadata" playsinline poster="assets/img/realisations/production-equipe-02.jpeg">
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

<?php
$page_scripts = <<<'JS'
<script>
// jQuery et Magnific Popup sont chargés juste au-dessus : on initialise la galerie filtrable.
(function () {
    var boutons = document.querySelectorAll('.galerie-filtre'),
        items = document.querySelectorAll('#galerie-grid .galerie-item');

    function initLightbox() {
        jQuery('#galerie-grid').magnificPopup({
            delegate: '.galerie-item:not(.is-hidden) .galerie-photo',
            type: 'image',
            gallery: { enabled: true, tPrev: 'Précédente', tNext: 'Suivante', tCounter: '%curr% / %total%' },
            tClose: 'Fermer',
            image: { titleSrc: function (item) { return item.el.attr('title'); } }
        });
    }

    boutons.forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            var filtre = bouton.dataset.filtre;
            boutons.forEach(function (b) { b.classList.remove('active'); });
            bouton.classList.add('active');
            items.forEach(function (item) {
                item.classList.toggle('is-hidden', !(filtre === '*' || item.dataset.categorie === filtre));
            });
            initLightbox();
        });
    });
    initLightbox();
})();
</script>
JS;
include __DIR__ . '/../includes/footer.php';
