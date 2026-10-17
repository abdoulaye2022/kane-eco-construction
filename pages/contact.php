<?php
$page_title = 'Contact';
$page_description = "Contactez Kané Eco-Construction à Niamey pour un devis de construction en briques de terre compressée : téléphone, WhatsApp, e-mail et formulaire en ligne.";
include '../includes/header.php';
?>

<div class="breadcumb-wrapper">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Contactez-nous</h1>
            <ul class="breadcumb-menu">
                <li><a href="accueil">Accueil</a></li>
                <li>Contact</li>
            </ul>
        </div>
    </div>
</div>
<div class="contact-area-2 space-top" id="contact-sec">
    <div class="container">
        <div class="title-area text-center">
            <span class="sub-title"><img src="assets/img/icon/subtitle-img1-1.svg" alt=""> Nous joindre</span>
            <h2 class="sec-title">Nos coordonnées</h2>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-6">
                <div class="contact-feature">
                    <div class="contact-feature-icon"><i class="fal fa-location-dot"></i></div>
                    <div class="media-body">
                        <p class="contact-feature_label">Notre adresse</p>
                        <span class="contact-feature_link">BP 10727 Niamey, Niger</span>
                        <a href="https://www.google.com/maps/search/?api=1&query=Niamey%2C+Niger" target="_blank" rel="noopener" class="contact-feature_link">Voir sur la carte</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="contact-feature">
                    <div class="contact-feature-icon"><i class="fal fa-phone"></i></div>
                    <div class="media-body">
                        <p class="contact-feature_label">Téléphone et e-mail</p>
                        <?php foreach ($telephones as $tel): ?>
                            <a href="tel:<?= $tel[1] ?>" class="contact-feature_link"><?= $tel[0] ?></a>
                        <?php endforeach; ?>
                        <a href="mailto:contact@kane-eco-construction.com" class="contact-feature_link">contact@kane-eco-construction.com</a>
                        <a href="<?= htmlspecialchars($whatsapp, ENT_QUOTES) ?>" target="_blank" rel="noopener" class="contact-feature_link"><i class="fab fa-whatsapp me-1"></i> WhatsApp</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="contact-feature">
                    <div class="contact-feature-icon"><i class="fal fa-clock"></i></div>
                    <div class="media-body">
                        <p class="contact-feature_label">Horaires d'ouverture</p>
                        <span class="contact-feature_link">Lundi - Vendredi : 8h - 16h</span>
                        <span class="contact-feature_link">Samedi : fermé</span>
                        <span class="contact-feature_link">Dimanche : fermé</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="contact-wrap2">
                    <div class="contact-form-wrap">
                        <h2 class="title h3 text-center mt-n1">Écrivez-nous</h2>
                        <p class="text-center mb-4">Décrivez votre projet, nous vous répondons sous 24 à 48 h ouvrées.</p>
                        <?php include __DIR__ . '/../includes/formulaire_contact.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carte -->
<div class="contact-map">
    <iframe title="Carte de Niamey, Niger" src="https://www.google.com/maps?q=Niamey%2C+Niger&z=12&output=embed"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<?php
include __DIR__ . '/../includes/footer.php';
