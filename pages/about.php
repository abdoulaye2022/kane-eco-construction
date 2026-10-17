<?php
$page_title = 'À propos de nous';
$page_description = "Kané Eco-Construction, société nigérienne de construction écologique : briques de terre compressée fabriquées à Niamey, bâtiments économiques et durables.";
include '../includes/header.php';
?>

<div class="breadcumb-wrapper">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">À propos de nous</h1>
            <ul class="breadcumb-menu">
                <li><a href="accueil">Accueil</a></li>
                <li>À propos de nous</li>
            </ul>
        </div>
    </div>
</div>

<div class="space bg-smoke overflow-hidden" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="img-box1">
                    <div class="img1">
                        <img class="tilt-active" src="assets/img/realisations/batiment-r2-03.jpeg"
                            style="width: 331px; height: 621px;" alt="Immeuble R+2 en briques de terre compressée réalisé par Kané Eco-Construction">
                    </div>
                    <div class="about-grid">
                        <h3 class="about-grid_year"><i class="fas fa-industry"></i></h3>
                        <p class="about-grid_text">Briques fabriquées sur notre site de Niamey</p>
                    </div>
                    <div class="img2">
                        <img class="tilt-active" src="assets/img/realisations/production-presse-01.jpeg"
                            style="width: 333px; height: 288px;" alt="Presse à briques de terre compressée sur le site de production">
                    </div>
                    <div class="shape-mockup about-shape1 jump" data-left="-67px" data-bottom="0">
                        <img src="assets/img/realisations/production-briques-02.jpeg" style="width: 183px; height: 93px;" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="title-area mb-30">
                    <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt="">À propos de nous</span>
                    <h2 class="sec-title">Une entreprise nigérienne qui construit autrement</h2>
                </div>
                <p class="mt-n2 mb-25">Kané Eco-Construction est une société immobilière et de construction basée à Niamey,
                    spécialisée dans la brique de terre compressée (BTC). Notre objectif : révolutionner le secteur immobilier
                    au Niger grâce à une méthode de construction écologique, économique et adaptée à notre climat.</p>
                <p class="mb-35">Nous fabriquons nous-mêmes nos briques avec des presses Hydraform, à partir de terre
                    sélectionnée et stabilisée. Cette maîtrise complète de la chaîne nous permet de garantir la qualité
                    de chaque bâtiment, de la fondation aux finitions.</p>
                <div class="about-grid2">
                    <div class="icon"><img src="assets/img/icon/about-grid-icon1.svg" alt=""></div>
                    <div class="about-grid-details">
                        <h3 class="about-grid_title h6">Construction écologique</h3>
                        <p>Une brique en terre locale, peu de ciment, aucune cuisson : une empreinte carbone minimale et un
                            confort thermique naturel.</p>
                    </div>
                </div>
                <div class="about-grid2">
                    <div class="icon"><img src="assets/img/icon/about-grid-icon2.svg" alt=""></div>
                    <div class="about-grid-details">
                        <h3 class="about-grid_title h6">Économique et durable</h3>
                        <p>Une matière première locale et peu de ciment : un coût de construction réduit, pour des bâtiments solides et durables.</p>
                    </div>
                </div>
                <div class="btn-group mt-40">
                    <a href="contact" class="th-btn">Contactez-nous<i class="fa-regular fa-arrow-right ms-2"></i></a>
                    <a href="nos-realisations" class="th-btn style2">Nos réalisations<i class="fa-regular fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="atouts-band">
    <div class="container">
        <div class="row gy-4">
            <div class="col-sm-6 col-xl-3">
                <div class="atout">
                    <div class="atout_icone"><i class="fas fa-industry"></i></div>
                    <div><h3 class="atout_titre">Production locale</h3><p class="atout_texte">Nos briques sont fabriquées sur notre propre site, à Niamey.</p></div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="atout">
                    <div class="atout_icone"><i class="fas fa-helmet-safety"></i></div>
                    <div><h3 class="atout_titre">Équipe qualifiée</h3><p class="atout_texte">Maçons et techniciens formés à la construction en terre compressée.</p></div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="atout">
                    <div class="atout_icone"><i class="fas fa-handshake"></i></div>
                    <div><h3 class="atout_titre">Accompagnement complet</h3><p class="atout_texte">Du devis à la remise des clés, un seul interlocuteur.</p></div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="atout">
                    <div class="atout_icone"><i class="fas fa-leaf"></i></div>
                    <div><h3 class="atout_titre">Construction durable</h3><p class="atout_texte">Des bâtiments sains, frais et respectueux de l'environnement.</p></div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="space overflow-hidden">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt=""> Notre méthode</span>
            <h2 class="sec-title">Le processus de production de la BTC</h2>
            <p class="sec-text mt-20">La réalisation des briques de terre compressée passe par cinq étapes clés que nous
                menons entièrement sur notre site de Niamey.</p>
        </div>
        <div class="row gy-40 justify-content-between">
            <?php
            $etapes = [
                ['fa-file-lines', "L'extraction et le choix de la terre, validés par des tests de qualité."],
                ['fa-pen-ruler', "La préparation : mélange et broyage de la terre, stabilisée avec 8 % de ciment."],
                ['fa-cubes', "Le moulage et la compression, qui donnent à la brique sa forme et sa résistance."],
                ['fa-sun', "La cure et le séchage des briques, à l'abri, pendant plusieurs jours."],
                ['fa-building', "La construction de votre projet immobilier par nos équipes."],
            ];
            foreach ($etapes as $n => $etape): ?>
                <div class="col-sm-6 col-lg-auto process-card2-wrap">
                    <div class="process-card2">
                        <div class="process-card2_icon"><i class="fal <?= $etape[0] ?>"></i></div>
                        <p class="process-card2_text"><strong class="d-block mb-1 text-theme">Étape <?= $n + 1 ?></strong><?= $etape[1] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../includes/footer.php';
