<?php
$page_title = 'Accueil';
$page_description = "Kané Eco-Construction fabrique des briques de terre compressée (BTC) à Niamey et construit logements, écoles et bâtiments écologiques, économiques et durables, partout au Niger.";
require_once __DIR__ . '/../includes/galerie.php';
include '../includes/header.php';

$slides = [
    [
        'image'  => 'assets/img/realisations/batiment-r2-01.jpeg',
        'sur'    => 'Construction écologique au Niger',
        'titre'  => "Construire l'avenir,",
        'accent' => 'innover autrement.',
        'texte'  => "Des bâtiments solides, sains et économiques grâce à la brique de terre compressée fabriquée à Niamey.",
    ],
    [
        'image'  => 'assets/img/realisations/production-presse-01.jpeg',
        'sur'    => 'Notre propre unité de production',
        'titre'  => 'Des briques de terre compressée',
        'accent' => 'fabriquées sur place.',
        'texte'  => "Nous maîtrisons toute la chaîne : extraction de la terre, pressage, séchage et pose. Qualité constante, délais tenus.",
    ],
    [
        'image'  => 'assets/img/realisations/batiment-villa-01.jpeg',
        'sur'    => 'Logements, écoles, centres de santé',
        'titre'  => 'Des bâtiments économiques,',
        'accent' => 'faits pour durer.',
        'texte'  => "Une construction qui respire, reste fraîche la journée et réduit la facture, sans compromis sur la solidité.",
    ],
];
?>
<div class="th-hero-wrapper hero-1" id="hero">
    <div class="hero-slider-1 th-carousel" data-fade="true" data-slide-show="1" data-md-slide-show="1" data-dots="true"
        data-adaptive-height="true">
        <?php foreach ($slides as $i => $slide): ?>
        <div class="th-hero-slide">
            <div class="th-hero-bg" data-bg-src="<?= $slide['image'] ?>"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-9">
                        <div class="hero-style1">
                            <span class="hero-subtitle" data-ani="slideinleft" data-ani-delay="0.1s"><img
                                    src="assets/img/icon/subtitle-img1-1.svg" alt=""> <?= $slide['sur'] ?></span>
                            <<?= $i === 0 ? 'h1' : 'h2' ?> class="hero-title text-white" data-ani="slideinleft" data-ani-delay="0.4s"><?= $slide['titre'] ?>
                                <span class="text-theme fw-normal"><?= $slide['accent'] ?></span>
                            </<?= $i === 0 ? 'h1' : 'h2' ?>>
                            <p class="hero-text" data-ani="slideinleft" data-ani-delay="0.6s"><?= $slide['texte'] ?></p>
                            <div class="btn-group" data-ani="slideinleft" data-ani-delay="0.8s">
                                <a href="contact" class="th-btn style3">Demander un devis<i class="fas fa-arrow-right ms-2"></i></a>
                                <a href="nos-realisations" class="th-btn style2">Voir nos réalisations <i class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                            <ul class="hero-points" data-ani="slideinleft" data-ani-delay="1s">
                                <li><i class="fas fa-check-circle"></i>Écologique</li>
                                <li><i class="fas fa-check-circle"></i>Économique</li>
                                <li><i class="fas fa-check-circle"></i>Durable</li>
                                <li><i class="fas fa-check-circle"></i>Fabriqué au Niger</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3 d-none d-lg-block">
                        <div class="hero-side-card">
                            <span class="hero-side-card_icone"><i class="fas fa-award"></i></span>
                            <h3>Une expérience reconnue au Niger</h3>
                            <p>Logements sociaux, cités, écoles et centres de santé : des projets livrés dans tout le pays, en briques de terre compressée.</p>
                            <a href="a-propos-de-nous" class="th-btn style2">Qui sommes-nous ? <i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="hero-shape"></div>
</div>
<section class="service-sec space" id="service-sec">
    <div class="shape-mockup service-bg-1-1" data-top="0" data-left="0"><img src="assets/img/bg/service_bg_11.png"
            alt="img"></div>
    <div class="container">
        <div class="mb-35">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="title-area mb-md-0">
                        <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt="img"> Nos
                            services</span>
                        <h2 class="sec-title">Domaines d’intervention</h2>
                    </div>
                </div>
                <div class="col-auto">
                    <a class="th-btn" href="nos-services">Voir tous les services <i
                            class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="service-tab-menu nav">
                    <button class="tab-btn active" data-bs-toggle="tab" data-bs-target="#service-tab-1">Logements
                        sociaux</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#service-tab-2">Cités modernes</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#service-tab-3">Classes
                        scolaires</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#service-tab-4">Centres de
                        santé</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#service-tab-5">Hôpitaux</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#service-tab-6">Habitats
                        modernes</button>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="service-slider1 tab-content">
                    <div class="tab-pane fade show active" id="service-tab-1" role="tabpanel">
                        <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2">
                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l1.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l3.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l4.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l5.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l6.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l7.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="service-tab-2" role="tabpanel">
                        <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2">
                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/cite.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l9.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l10.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/cite2.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/s11.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/s1.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="service-tab-3" role="tabpanel">
                        <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2">
                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l10.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l15.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l16.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l17.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l6.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l7.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="service-tab-4" role="tabpanel">
                        <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2">
                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l1.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l3.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l4.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l5.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l6.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l7.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="service-tab-5" role="tabpanel">
                        <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2">
                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l1.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l3.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l4.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l5.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l6.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l7.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="service-tab-6">
                        <div class="row th-carousel" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2">
                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l1.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l3.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/l4.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/l5.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-4">
                                <div class="service-card">
                                    <img src="assets/img/logements/f4 9.jpeg"
                                        style="height: 195px; width: 100%; margin-bottom: 10px;" alt="img">
                                    <img src="assets/img/logements/etage.jpeg" style="height: 195px; width: 100%;"
                                        alt="img">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
About Area  
==============================-->
<div class="space bg-smoke overflow-hidden" id="about-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="img-box1">
                    <div class="img1">
                        <img class="tilt-active" src="assets/img/products/brique 2.jpeg"
                            style="width: 331px; height: 621px;" alt="About">
                    </div>
                    <div class="about-grid">
                        <h3 class="about-grid_year"><i class="fas fa-industry"></i></h3>
                        <p class="about-grid_text">Briques fabriquées sur notre site de Niamey</p>
                    </div>
                    <div class="img2">
                        <img class="tilt-active" src="assets/img/products/maison 2.jpeg"
                            style="width: 333px; height: 288px;" alt="About">
                    </div>
                    <div class="shape-mockup about-shape1 jump" data-left="-67px" data-bottom="0">
                        <img src="assets/img/products/f4 10.jpeg" style="width: 183px; height: 93px;" alt="img">
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="title-area mb-30">
                    <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt="img">À propos de
                        nous</span>
                    <h6 class="sec-title">Kané Eco-Constructions est une société immobilière spécialisée dans les
                        briques de terre compressée au Niger.</h6>
                </div>
                <p class="mt-n2 mb-35">Notre objectif est de révolutionner le secteur immobilier au Niger à travers une
                    nouvelle méthode de construction écologique et économique par l’utilisation des briques de terre
                    compressée.</p>
                <div class="about-grid2">
                    <div class="icon">
                        <img src="assets/img/icon/about-grid-icon1.svg" alt="img">
                    </div>
                    <div class="about-grid-details">
                        <h3 class="about-grid_title h6">Construction Écologique</h3>
                        <p>Nous utilisons des briques de terre compressée pour une construction durable et respectueuse de l'environnement</p>
                    </div>
                </div>
                <div class="about-grid2">
                    <div class="icon">
                        <img src="assets/img/icon/about-grid-icon2.svg" alt="img">
                    </div>
                    <div class="about-grid-details">
                        <h3 class="about-grid_title h6">Économique et Durable</h3>
                        <p>Un coût de construction réduit grâce à une matière première locale, pour des bâtiments solides et durables</p>
                    </div>
                </div>
                <div class="btn-group mt-40">
                    <a href="a-propos-de-nous" class="th-btn">En savoir plus<i class="fa-regular fa-arrow-right ms-2"></i></a>
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
<div class="overflow-hidden space">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-xl-5">
                <div class="title-area mb-30">
                    <h2 class="h3 sec-title fw-semibold">Qu’est-ce qu’une brique de terre compressée (BTC) ?</h2>
                    <p class="sec-text mt-20">La brique de terre compressée ou brique de terre stabilisée est un
                        matériau de construction qui utilise
                        des matières premières disponibles localement. Il s’agit généralement de terre, sable, roches
                        latéritiques, roches pouzzolaniques,
                        graviers, argiles, etc.
                    </p>
                    <img src="assets/img/products/mur.jpeg" alt="img">
                </div>
            </div>
            <div class="col-xl-7">
                <div class="title-area mb-30">
                    <h5 style="text-align: center;">Avantages</h5>
                </div>

                <div class="accordion-area accordion mt-xl-0 mt-40" id="faqAccordion">


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-1">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">Inertie
                                Thermique</button>
                        </div>
                        <div id="collapse-1" class="accordion-collapse collapse " aria-labelledby="collapse-item-1"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">Par sa masse, la BTC employée contribue à la régulation de la
                                    température et du taux d’humidité à
                                    l’intérieur de votre construction. Pas de problème d'isolation et température
                                    optimale en tout temps !
                                    La brique emmagasine la chaleur le jour lorsqu'il fait chaud et relâche cette
                                    chaleur la nuit lorsqu'il fait frais.
                                    La forte inertie de ces briques, joue un rôle déterminant pour le confort thermique.
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 active">
                        <div class="accordion-header" id="collapse-item-2">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-2" aria-expanded="true"
                                aria-controls="collapse-2">Hygrométrie</button>
                        </div>
                        <div id="collapse-2" class="accordion-collapse collapse show" aria-labelledby="collapse-item-2"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">La terre a une bonne capacité à absorber l’humidité de la pièce ou à
                                    restituer lorsque l’air intérieur est trop sec.</p>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-3" aria-expanded="false"
                                aria-controls="collapse-3">Protection</button>
                        </div>
                        <div id="collapse-3" class="accordion-collapse collapse " aria-labelledby="collapse-item-3"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">Les BTCS sont une excellente protection contre les incendies.
                                    Elles offrent une bonne protection contre le feu. Elle est classée comme matériau
                                    incombustible. D’une manière générale, les dommages
                                    engendrés par un incendie ne sont pas relatifs au feu mais plutôt au gaz. Dans le
                                    cas d’un bâtiment construit avec des BTCS, ce problème
                                    ne se pose pas.</p>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">Confort
                                phonique</button>
                        </div>
                        <div id="collapse-4" class="accordion-collapse collapse " aria-labelledby="collapse-item-4"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">La masse contribue à diminuer la transmission des sons d’une pièce à
                                    l’autre.</p>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">Bilan
                                écologique remarquable</button>
                        </div>
                        <div id="collapse-5" class="accordion-collapse collapse " aria-labelledby="collapse-item-5"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">Peu d’énergie nécessaire à sa fabrication et recyclabilité totale.
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-6" aria-expanded="false"
                                aria-controls="collapse-6">Économique</button>
                        </div>
                        <div id="collapse-6" class="accordion-collapse collapse " aria-labelledby="collapse-item-6"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <div class="faq-text">
                                    <p>La construction en briques de terre compressée revient nettement moins cher
                                        qu'une construction classique en béton, pour plusieurs raisons :</p>
                                    <ul>
                                        <li>une consommation de ciment très réduite par rapport à une construction en béton ;</li>
                                        <li>une matière première, la terre, disponible partout au Niger et à moindre coût ;</li>
                                        <li>une mise en œuvre rapide, donc moins de jours de travail sur le chantier.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-7">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-7" aria-expanded="false"
                                aria-controls="collapse-7">Durabilité</button>
                        </div>
                        <div id="collapse-7" class="accordion-collapse collapse " aria-labelledby="collapse-item-7"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">La brique de terre compressée est un matériau solide et robuste,
                                    conçu pour durer sur plusieurs générations. Grâce à cette solidité, elle résiste aux
                                    intempéries et aux conditions climatiques sévères. De nombreuses constructions en terre
                                    de l'Antiquité sont d'ailleurs restées intactes au fil des siècles : la terre
                                    compressée a fait ses preuves en matière de durabilité.</p>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-8">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-8" aria-expanded="false"
                                aria-controls="collapse-8">Rapidité</button>
                        </div>
                        <div id="collapse-8" class="accordion-collapse collapse " aria-labelledby="collapse-item-8"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">Les briques que nous vous proposons sont autobloquantes donc
                                    s'interloquent l'une dans l'autre.
                                    Cette technique de construction vous permet de construire 1,5 fois plus rapidement
                                    en toute sécurité. De plus,
                                    vous pourrez insérer directement votre tuyauterie et vos câbles électriques à
                                    l'intérieur des briques. Vous pouvez
                                    aussi couler votre béton et insérer les barres de fer à l'intérieur des briques
                                    perforées. Cette technique fortifiera
                                    votre construction. Vous n'aurez pas à casser les briques et pourrez garder votre
                                    construction plus esthétique.</p>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-card style2 ">
                        <div class="accordion-header" id="collapse-item-9">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-9" aria-expanded="false"
                                aria-controls="collapse-9">Entretien</button>
                        </div>
                        <div id="collapse-9" class="accordion-collapse collapse " aria-labelledby="collapse-item-9"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="faq-text">Les BTCS offrent une excellente adaptabilité à l'usure du temps.
                                    Contrairement aux constructions classiques en ciment
                                    ou béton, les constructions en briques nécessitent peu d'entretien.
                                    Au contraire, le temps n'est qu'un allié pour rehausser la beauté des briques. Ces
                                    constructions ne nécessitent aucun entretien
                                    (peinture, nettoyage, renouvellement).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="space overflow-hidden">
    <div class="container">
        <div class="row align-items-center" style="margin-bottom: 40px;">
            <div class="col-md-12">
                <h3 style="text-align: center;">Processus de Production de BTC</h3>
                <p>La production de BTC Tout d'abord, il est important de noter que la réalisation des BTCS va passer
                    par 5 étapes-clés que nous nous chargerons de mener avec succès</p>
            </div>
        </div>
        <div class="row gy-40 justify-content-between">
            <div class="col-sm-3 col-lg-auto process-card2-wrap">
                <div class="process-card2">
                    <div class="process-card2_icon">
                        <i class="fal fa-file-lines"></i>
                    </div>
                    <p class="process-card2_text">L’extraction et le choix de la terre. Cette dernière est choisie sur
                        la base d’un test effectué suivie des tests de qualité.
                    </p>
                </div>
            </div>
            <div class="col-sm-3 col-lg-auto process-card2-wrap">
                <div class="process-card2">
                    <div class="process-card2_icon">
                        <i class="fal fa-pen-ruler"></i>
                    </div>
                    <p class="process-card2_text">La préparation, qui correspond au mélange et broyage de cette terre
                        additionnée à 8% de ciment.
                    </p>
                </div>
            </div>
            <div class="col-sm-3 col-lg-auto process-card2-wrap">
                <div class="process-card2">
                    <div class="process-card2_icon">
                        <i class="fal fa-sack-dollar"></i>
                    </div>
                    <p class="process-card2_text">Le moulage, durant lequel on va lui attribuer une forme spécifique
                        selon votre plan architectural.
                    </p>
                </div>
            </div>
            <div class="col-sm-3 col-lg-auto process-card2-wrap">
                <div class="process-card2">
                    <div class="process-card2_icon">
                        <i class="fal fa-sack-dollar"></i>
                    </div>
                    <p class="process-card2_text" style="min-width: 187px;">Le curage des briques.
                    </p>
                </div>
            </div>
            <div class="col-sm-3 col-lg-auto process-card2-wrap">
                <div class="process-card2">
                    <div class="process-card2_icon">
                        <i class="fal fa-sack-dollar"></i>
                    </div>
                    <p class="process-card2_text">La construction de votre projet immobilier
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==============================
Dernières réalisations (alimentées par le portail d'administration)
==============================-->
<?php
$galerie_accueil = galerie_dernieres(galerie_charger(), 7);
$galerie_total = count(galerie_charger());
?>
<section class="space overflow-hidden home-galerie" id="realisations-sec">
    <div class="container">
        <div class="mb-45">
            <div class="row justify-content-between align-items-center gy-3">
                <div class="col-auto">
                    <div class="title-area mb-md-0">
                        <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt=""> Photo galerie</span>
                        <h2 class="sec-title mb-0">Nos dernières réalisations</h2>
                    </div>
                </div>
                <div class="col-auto">
                    <a class="th-btn" href="nos-realisations">Toute la galerie <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
        <div class="row gy-4 gx-4">
            <?php foreach ($galerie_accueil as $img): ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <span class="gallery-cat"><?= htmlspecialchars(galerie_categorie_libelle($img['categorie']), ENT_QUOTES) ?></span>
                        <a href="<?= galerie_url($img['src']) ?>" class="galerie-photo" title="<?= htmlspecialchars($img['legende'], ENT_QUOTES) ?>">
                            <img src="<?= galerie_url($img['src']) ?>" alt="<?= htmlspecialchars($img['legende'], ENT_QUOTES) ?>" loading="lazy">
                            <div class="gallery-overlay">
                                <p><?= htmlspecialchars($img['legende'], ENT_QUOTES) ?></p>
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-sm-6 col-lg-3 col-plus">
                <a href="nos-realisations"><span>+<?= (int) $galerie_total ?></span>photos de nos chantiers, briques et bâtiments</a>
            </div>
        </div>
    </div>
</section>

<!--==============================
Appel à l'action + formulaire de devis
==============================-->
<div class="container" id="contact-sec">
    <div class="cta-area-1">
        <div class="row g-0 align-items-center">
            <div class="col-xl-7">
                <div class="cta-wrap title-area mb-0 bg-theme">
                    <span class="sub-title text-white"><img src="assets/img/icon/subtitle-img1-1.svg" alt=""> Parlons de votre projet</span>
                    <h2 class="sec-title text-white">Un projet de construction ? Demandez votre devis gratuit.</h2>
                    <p class="sec-text text-white">Logement, cité, école, centre de santé ou simple mur de clôture : nous étudions
                        votre projet et vous proposons une solution en briques de terre compressée adaptée à votre budget.</p>
                    <div class="cta-link-wrap mb-40">
                        <div class="cta-link">
                            <div class="cta-link-icon"><i class="fas fa-phone"></i></div>
                            <div>
                                <p>Appelez-nous</p>
                                <?php foreach ($telephones as $tel): ?>
                                    <a class="cta-single-link d-block" href="tel:<?= $tel[1] ?>"><?= $tel[0] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="cta-link">
                            <div class="cta-link-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <p>Écrivez-nous</p>
                                <a class="cta-single-link" href="mailto:contact@kane-eco-construction.com">contact@kane-eco-construction.com</a>
                            </div>
                        </div>
                    </div>
                    <a href="<?= htmlspecialchars($whatsapp, ENT_QUOTES) ?>" class="th-btn style6" target="_blank" rel="noopener"><i class="fab fa-whatsapp me-2"></i>Discuter sur WhatsApp</a>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="contact-form-wrap">
                    <h2 class="title h4 text-center">Demander un devis</h2>
                    <?php include __DIR__ . '/../includes/formulaire_contact.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
