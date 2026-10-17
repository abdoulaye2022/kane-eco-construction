<?php
$page_title = 'Page introuvable';
$page_description = "La page demandée n'existe pas ou a été déplacée.";
include '../includes/header.php';
?>

<div class="breadcumb-wrapper">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">Page introuvable</h1>
            <ul class="breadcumb-menu">
                <li><a href="accueil">Accueil</a></li>
                <li>Erreur 404</li>
            </ul>
        </div>
    </div>
</div>
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="error-page text-center">
                    <div class="error-content">
                        <div class="error-img mb-50">
                            <img src="assets/img/normal/404.png" alt="Erreur 404">
                        </div>
                        <h2 class="error-title mb-20"><span class="text-theme">Oups !</span> Cette page n'existe pas</h2>
                        <p class="error-text mb-30">La page que vous cherchez a peut-être été déplacée ou supprimée.
                            Retrouvez nos services et nos réalisations depuis l'accueil.</p>
                        <a href="accueil" class="th-btn"><i class="fa-solid fa-home me-2"></i> Retour à l'accueil</a>
                        <a href="nos-realisations" class="th-btn style2 ms-2">Nos réalisations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../includes/footer.php';
