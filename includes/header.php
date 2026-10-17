<?php
// Métadonnées par page (définies avant l'inclusion du header ; valeurs par défaut sinon).
$page_title = isset($page_title) ? $page_title . ' | Kané Eco-Construction' : 'Kané Eco-Construction - Briques de terre compressée et construction écologique au Niger';
$page_description = isset($page_description) ? $page_description : "Kané Eco-Construction fabrique des briques de terre compressée (BTC) à Niamey et construit des logements, écoles et bâtiments écologiques, économiques et durables au Niger.";
$page_path = isset($pathAfterPublic) ? $pathAfterPublic : '';
$page_canonical = 'https://www.kane-eco-construction.com/' . ($page_path === 'accueil' ? '' : $page_path);
$page_active = $page_path === '' ? 'accueil' : $page_path;
if ($page_active === 'realisations') {
    $page_active = 'nos-realisations';
}
$nav = [
    'accueil'          => 'Accueil',
    'nos-services'     => 'Nos Services',
    'nos-realisations' => 'Nos Réalisations',
    'a-propos-de-nous' => 'À Propos de Nous',
    'contact'          => 'Contact',
];
$telephones = [
    ['+227 93 33 34 35', '+22793333435'],
    ['+227 82 33 34 33', '+22782333433'],
];
$whatsapp = 'https://wa.me/22793333435?text=' . rawurlencode("Bonjour Kané Eco-Construction, je souhaite un devis.");
?>
<!doctype html>
<html class="no-js" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= htmlspecialchars($page_title, ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($page_description, ENT_QUOTES) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($page_title, ENT_QUOTES) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($page_description, ENT_QUOTES) ?>">
    <meta property="og:image" content="https://www.kane-eco-construction.com/assets/img/realisations/batiment-r2-01.jpeg">
    <meta property="og:url" content="<?= htmlspecialchars($page_canonical, ENT_QUOTES) ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="fr_FR">
    <link rel="canonical" href="<?= htmlspecialchars($page_canonical, ENT_QUOTES) ?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpeg" href="assets/img/kane.jpeg">
    <meta name="theme-color" content="#FF5E14">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600;700;800;900&family=Public+Sans:wght@100;200;300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>
    <div class="preloader"></div>

    <!-- Menu mobile -->
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="accueil"><img src="assets/img/kane.jpeg" alt="Kané Eco-Construction"></a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    <?php foreach ($nav as $slug => $libelle): ?>
                        <li class="<?= $page_active === $slug ? 'active' : '' ?>"><a href="<?= $slug ?>"><?= $libelle ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="mobile-contact">
                <a href="contact" class="th-btn w-100">Obtenir un devis <i class="fas fa-arrow-right ms-1"></i></a>
                <?php foreach ($telephones as $tel): ?>
                    <a href="tel:<?= $tel[1] ?>" class="mobile-contact_link"><i class="fas fa-phone"></i> <?= $tel[0] ?></a>
                <?php endforeach; ?>
                <a href="mailto:contact@kane-eco-construction.com" class="mobile-contact_link"><i class="fas fa-envelope"></i> contact@kane-eco-construction.com</a>
                <a href="<?= htmlspecialchars($whatsapp, ENT_QUOTES) ?>" class="mobile-contact_link" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> Écrire sur WhatsApp</a>
            </div>
        </div>
    </div>

    <header class="th-header header-layout1">
        <div class="header-top">
            <div class="container th-container2">
                <div class="row justify-content-center justify-content-lg-between align-items-center gy-2">
                    <div class="col-auto d-none d-lg-block">
                        <div class="header-links">
                            <ul>
                                <li><i class="fas fa-leaf"></i> Briques de terre compressée fabriquées à Niamey</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="header-links header-right">
                            <ul>
                                <li><i class="fas fa-location-dot"></i> BP 10727 Niamey, Niger</li>
                                <li class="d-none d-md-inline-block"><i class="fas fa-clock"></i> Lundi - Vendredi : 8h - 16h</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="menu-area">
                <div class="container th-container2">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="accueil"><img src="assets/img/kane.jpeg" alt="Kané Eco-Construction"></a>
                            </div>
                        </div>
                        <div class="col-auto d-none d-lg-block sticy-d-none">
                            <div class="header-middle">
                                <div class="header-link">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <p>Appelez-nous</p>
                                        <?php foreach ($telephones as $tel): ?>
                                            <a class="header-single-link" href="tel:<?= $tel[1] ?>"><?= $tel[0] ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="header-link">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <p>Écrivez-nous</p>
                                        <a class="header-single-link" href="mailto:contact@kane-eco-construction.com">contact@kane-eco-construction.com</a>
                                    </div>
                                </div>
                                <div class="header-link d-xl-inline-flex d-none">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <p>Horaires</p>
                                        <span class="header-single-link">Lundi - Vendredi : 8h - 16h</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto sticy-d-block">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <?php foreach ($nav as $slug => $libelle): ?>
                                        <li class="<?= $page_active === $slug ? 'active' : '' ?>"><a href="<?= $slug ?>"><?= $libelle ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-auto d-lg-none">
                            <button type="button" class="th-menu-toggle d-block d-lg-none" aria-label="Ouvrir le menu"><i class="far fa-bars"></i></button>
                        </div>
                    </div>
                    <div class="main-menu-area">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <nav class="main-menu d-none d-lg-inline-block">
                                    <ul>
                                        <?php foreach ($nav as $slug => $libelle): ?>
                                            <li class="<?= $page_active === $slug ? 'active' : '' ?>"><a href="<?= $slug ?>"><?= $libelle ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <div class="header-button">
                                    <a href="<?= htmlspecialchars($whatsapp, ENT_QUOTES) ?>" class="icon-btn style2 header-whatsapp" target="_blank" rel="noopener" title="Écrire sur WhatsApp"><i class="fab fa-whatsapp"></i></a>
                                    <a href="contact" class="th-btn style8 ml-25">OBTENIR UN DEVIS <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="logo-bg"></div>
            </div>
        </div>
    </header>
