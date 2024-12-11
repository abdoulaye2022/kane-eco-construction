<?php
include '../includes/header.php';
?>

<div class="breadcumb-wrapper " data-bg-src="assets/img/bg/breadcumb_shape_1_1.jpg">
    <div class="container">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title">404 ERROR</h1>
            <ul class="breadcumb-menu">
                <li><a href="accueil">Home</a></li>
                <li>404 ERROR</li>
            </ul>
        </div>
    </div>
</div>
<!--==============================
Error Area 
==============================-->
<section class="space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="error-page text-center">
                    <div class="error-content">
                        <div class="error-img mb-50">
                            <img src="assets/img/normal/404.png" alt="404 image">
                        </div>
                        <h2 class="error-title mb-20"><span class="text-theme">OooPs!</span> Page Not Found</h2>
                        <p class="error-text mb-30">Oops! The page you are looking for does not exist. It might have
                            been moved or deleted.</p>
                        <a href="accueil" class="th-btn"><i class="fa-solid fa-home me-2"></i> Back To Home </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include __DIR__ . '/../includes/footer.php';
?>