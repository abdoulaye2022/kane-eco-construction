<?php /* Formulaire de contact partagé (accueil + page contact). Envoi AJAX vers contact/envoyer. */ ?>
<form action="contact/envoyer" method="POST" class="contact-form ajax-contact" novalidate>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom*" required>
                <i class="fal fa-user"></i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Votre adresse e-mail*" required>
                <i class="fal fa-envelope"></i>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <select name="subject" id="subject" class="single-select nice-select form-select">
                    <option value="" disabled selected hidden>Objet de votre demande*</option>
                    <option value="Devis construction">Devis pour une construction</option>
                    <option value="Achat de briques">Achat de briques de terre compressée</option>
                    <option value="Logement social">Logement social (F2, F3, F4)</option>
                    <option value="Partenariat">Partenariat / collaboration</option>
                    <option value="Autre">Autre demande</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="tel" class="form-control" name="number" id="number" placeholder="Numéro de téléphone*" required>
                <i class="fal fa-phone"></i>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Décrivez votre projet*" required></textarea>
                <i class="fal fa-pen"></i>
            </div>
        </div>
        <div class="champ-piege" aria-hidden="true">
            <label for="site_web">Ne pas remplir</label>
            <input type="text" name="site_web" id="site_web" tabindex="-1" autocomplete="off">
        </div>
        <div class="form-btn col-12">
            <button class="th-btn w-100" type="submit">Envoyer ma demande<i class="fas fa-long-arrow-right ms-2"></i></button>
        </div>
    </div>
    <p class="form-messages mb-0 mt-3" aria-live="polite"></p>
</form>
<script>
// Après un envoi réussi, le thème vide les champs puis les marque à tort comme invalides : on nettoie.
window.addEventListener('load', function () {
    if (!window.jQuery) { return; }
    jQuery(document).ajaxSuccess(function (event, xhr, settings) {
        if (settings && settings.url && settings.url.indexOf('contact/envoyer') !== -1) {
            jQuery('.ajax-contact .is-invalid').removeClass('is-invalid');
            jQuery('.ajax-contact select').prop('selectedIndex', 0).trigger('change');
        }
    });
});
</script>
