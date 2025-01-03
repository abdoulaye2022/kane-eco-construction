<?php
include '../includes/header.php';
?>

<div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb_shape_1_1.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Contactez-nous</h1>
            <ul class="breadcumb-menu">
                <li><a href="accueil">Accueil</a></li>
                <li>Contactez-nous</li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
Contact Area  
==============================-->
<div class="contact-area-2 space-top" id="contact-sec">
    <div class="container">
        <div class="title-area text-center">
            <h2 class="sec-title">Nos coordonnées</h2>
        </div>
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-6">
                <div class="contact-feature">
                    <div class="contact-feature-icon">
                        <i class="fal fa-location-dot"></i>
                    </div>
                    <div class="media-body">
                        <p class="contact-feature_label">Notre adress</p>
                        <a href="https://www.google.com/maps" class="contact-feature_link">2690 Hiltona Street Victoria
                            Road, New York, Canada</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="contact-feature">
                    <div class="contact-feature-icon">
                        <i class="fal fa-phone"></i>
                    </div>
                    <div class="media-body">
                        <p class="contact-feature_label">Contact Number</p>
                        <a href="tel:256214203215" class="contact-feature_link">Téléphone: +227 93 33 34 35 /
                            +227 82 33 34 33</a>
                        <a href="mailto:info@konta.com" class="contact-feature_link">E-mail:
                            contact@kane-eco-construction.com</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="contact-feature">
                    <div class="contact-feature-icon">
                        <i class="fal fa-clock"></i>
                    </div>
                    <div class="media-body">
                        <p class="contact-feature_label">heures d'ouverture</p>
                        <span class="contact-feature_link">Lundi - Vendredi: 8:00 - 16:00</span>
                        <span class="contact-feature_link">Samedi : Fermé</span>
                        <span class="contact-feature_link">Dimanche : Fermé</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="contact-wrap2">
                    <div class="contact-form-wrap">
                        <h2 class="title h3 text-center mt-n1">Entrer en contact</h2>
                        <form action="mail.php" method="POST" class="contact-form ajax-contact">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Votre nom*">
                                        <i class="fal fa-user"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Adresse email*">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="subject" id="subject"
                                            class="single-select nice-select form-select">
                                            <option value="" disabled selected hidden>Select Subject*</option>
                                            <option value="Construction">Construction</option>
                                            <option value="Real Estate">Real Estate</option>
                                            <option value="Industry">Industry</option>
                                            <option value="Architect">Architect</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="tel" class="form-control" name="number" id="number"
                                            placeholder="Numéro de téléphone*">
                                        <i class="fal fa-phone"></i>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group ">
                                        <textarea name="message" id="message" cols="30" rows="3" class="form-control"
                                            placeholder="Écrivez votre message*"></textarea>
                                        <i class="fal fa-pen"></i>
                                    </div>
                                </div>
                                <div class="form-btn col-12">
                                    <button class="th-btn w-100">Envoyer un message<i
                                            class="fas fa-long-arrow-right ms-2"></i></button>
                                </div>
                            </div>
                            <p class="form-messages mb-0 mt-3"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--==============================
Map Area  
==============================-->
<div class="contact-map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sth!5e0!3m2!1sen!2sbd!4v1651028958211!5m2!1sen!2sbd"
        allowfullscreen="" loading="lazy"></iframe>
</div>
<!--==============================
	Footer Area
==============================-->

<?php
include __DIR__ . '/../includes/footer.php';
?>