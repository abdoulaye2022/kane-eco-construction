<?php
$telephones = isset($telephones) ? $telephones : [['+227 93 33 34 35', '+22793333435'], ['+227 82 33 34 33', '+22782333433']];
$whatsapp = isset($whatsapp) ? $whatsapp : 'https://wa.me/22793333435';
?>
<footer class="footer-wrapper footer-layout1" data-bg-src="assets/img/bg/footer1-bg.png" data-overlay="title" data-opacity="9">
    <div class="widget-area space-top z-index-common">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-md-6 col-xl-4">
                    <div class="widget footer-widget">
                        <div class="th-widget-about">
                            <div class="about-logo">
                                <a href="accueil"><img src="assets/img/kane.jpeg" alt="Kané Eco-Construction"></a>
                            </div>
                            <p class="about-text mb-4">Kané Eco-Construction fabrique des briques de terre compressée à Niamey et
                                construit des bâtiments écologiques, économiques et durables partout au Niger.</p>
                            <div class="th-widget-contact">
                                <h6 class="info-box-title text-white mb-1">Téléphone</h6>
                                <div class="info-box-wrap">
                                    <div class="info-box_icon"><i class="fas fa-phone"></i></div>
                                    <div>
                                        <?php foreach ($telephones as $tel): ?>
                                            <a href="tel:<?= $tel[1] ?>" class="info-box_link d-block"><?= $tel[0] ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <h6 class="info-box-title text-white mb-1">E-mail</h6>
                                <div class="info-box-wrap">
                                    <div class="info-box_icon"><i class="fas fa-envelope"></i></div>
                                    <a class="info-box_link" href="mailto:contact@kane-eco-construction.com">contact@kane-eco-construction.com</a>
                                </div>
                                <h6 class="info-box-title text-white mb-1">Adresse</h6>
                                <div class="info-box-wrap">
                                    <div class="info-box_icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <span class="info-box_link">BP 10727 Niamey, Niger</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Navigation</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="accueil">Accueil</a></li>
                                <li><a href="nos-services">Nos services</a></li>
                                <li><a href="nos-realisations">Nos réalisations</a></li>
                                <li><a href="a-propos-de-nous">À propos de nous</a></li>
                                <li><a href="contact">Contactez-nous</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Nos domaines</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu">
                                <li><a href="nos-services">Logements sociaux</a></li>
                                <li><a href="nos-services">Cités modernes</a></li>
                                <li><a href="nos-services">Classes scolaires</a></li>
                                <li><a href="nos-services">Centres de santé</a></li>
                                <li><a href="nos-services">Habitats modernes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">Un projet ?</h3>
                        <p class="footer-text">Parlons-en. Nous étudions gratuitement votre projet et vous proposons un devis
                            adapté à votre budget.</p>
                        <div class="footer-cta">
                            <a href="contact" class="th-btn w-100">Demander un devis <i class="fas fa-arrow-right ms-1"></i></a>
                            <a href="<?= htmlspecialchars($whatsapp, ENT_QUOTES) ?>" class="th-btn style-whatsapp w-100" target="_blank" rel="noopener"><i class="fab fa-whatsapp me-2"></i>Écrire sur WhatsApp</a>
                        </div>
                        <p class="footer-text mb-0 mt-3"><i class="fas fa-clock me-2 text-theme"></i>Lundi - Vendredi : 8h - 16h</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-7">
                    <p class="copyright-text">© <?= date('Y') ?> <a href="accueil">Kané Eco-Construction</a>. Tous droits réservés.
                        Créé par <a target="_blank" rel="noopener" href="https://m2atech.com">M2atech</a></p>
                </div>
                <div class="col-md-5 text-md-end">
                    <div class="footer-links">
                        <ul>
                            <li><a href="contact">Contact</a></li>
                            <li><a href="admin" rel="nofollow">Administration</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll To Top -->
<div class="scroll-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
            style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;">
        </path>
    </svg>
</div>

<!-- Scripts -->
<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/jquery.counterup.min.js"></script>
<script src="assets/js/circle-progress.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/tilt.jquery.min.js"></script>
<script src="assets/js/tweenmax.min.js"></script>
<script src="assets/js/nice-select.min.js"></script>
<script src="assets/js/main.js"></script>
<?php if (!empty($page_scripts)) { echo $page_scripts; } ?>

</body>

</html>
