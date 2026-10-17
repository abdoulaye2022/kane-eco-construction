<?php $titre = 'Première installation'; require __DIR__ . '/_entete.php'; ?>
<div class="connexion">
    <div>
        <div class="carte">
            <div class="logo"><img src="<?= e($siteBase) ?>assets/img/kane.jpeg" alt="Kané Eco-Construction"></div>
            <h1>Créer le compte administrateur</h1>
            <p class="sous-titre">Ce compte servira à gérer les images du site. Cette étape n'apparaît qu'une seule fois.</p>
            <?php if ($erreur): ?><div class="flash erreur">⚠ <span><?= e($erreur) ?></span></div><?php endif; ?>
            <form method="post" action="<?= e($adminBase) ?>/installation" autocomplete="off">
                <?= csrf_champ() ?>
                <div class="groupe">
                    <label for="identifiant">Identifiant</label>
                    <input class="champ" type="text" id="identifiant" name="identifiant" required minlength="3" autocapitalize="off" autofocus>
                </div>
                <div class="groupe">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input class="champ" type="password" id="mot_de_passe" name="mot_de_passe" required minlength="10" autocomplete="new-password">
                    <p class="aide">10 caractères minimum. Conservez-le précieusement : il n'y a pas de récupération automatique.</p>
                </div>
                <div class="groupe">
                    <label for="confirmation">Confirmer le mot de passe</label>
                    <input class="champ" type="password" id="confirmation" name="confirmation" required minlength="10" autocomplete="new-password">
                </div>
                <button class="btn" type="submit" style="width:100%">Créer le compte et accéder au portail</button>
            </form>
        </div>
        <p class="pied"><a href="<?= e($siteBase) ?>">← Retour au site</a></p>
    </div>
</div>
<?php require __DIR__ . '/_pied.php'; ?>
