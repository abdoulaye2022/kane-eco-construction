<?php $titre = 'Connexion'; require __DIR__ . '/_entete.php'; ?>
<div class="connexion">
    <div>
        <div class="carte">
            <div class="logo"><img src="<?= e($siteBase) ?>assets/img/kane.jpeg" alt="Kané Eco-Construction"></div>
            <h1>Espace administration</h1>
            <p class="sous-titre">Connectez-vous pour gérer les images du site.</p>
            <?php if ($erreur): ?><div class="flash erreur">⚠ <span><?= e($erreur) ?></span></div><?php endif; ?>
            <form method="post" action="<?= e($adminBase) ?>/connexion">
                <?= csrf_champ() ?>
                <div class="groupe">
                    <label for="identifiant">Identifiant</label>
                    <input class="champ" type="text" id="identifiant" name="identifiant" required autocapitalize="off" autocomplete="username" autofocus>
                </div>
                <div class="groupe">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input class="champ" type="password" id="mot_de_passe" name="mot_de_passe" required autocomplete="current-password">
                </div>
                <button class="btn" type="submit" style="width:100%">Se connecter</button>
            </form>
        </div>
        <p class="pied"><a href="<?= e($siteBase) ?>">← Retour au site</a></p>
    </div>
</div>
<?php require __DIR__ . '/_pied.php'; ?>
