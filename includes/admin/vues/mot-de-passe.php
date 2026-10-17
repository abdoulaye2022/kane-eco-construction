<?php $titre = 'Mot de passe'; require __DIR__ . '/_entete.php'; require __DIR__ . '/_barre.php'; ?>
<main class="contenu">
    <h1>Changer le mot de passe</h1>
    <p class="sous-titre">Compte connecté : <strong><?= e($identifiant) ?></strong></p>
    <?php require __DIR__ . '/_flashs.php'; ?>
    <div class="carte" style="max-width:520px">
        <form method="post" action="<?= e($adminBase) ?>/mot-de-passe">
            <?= csrf_champ() ?>
            <div class="groupe">
                <label for="actuel">Mot de passe actuel</label>
                <input class="champ" type="password" id="actuel" name="actuel" required autocomplete="current-password">
            </div>
            <div class="groupe">
                <label for="nouveau">Nouveau mot de passe</label>
                <input class="champ" type="password" id="nouveau" name="nouveau" required minlength="10" autocomplete="new-password">
                <p class="aide">10 caractères minimum.</p>
            </div>
            <div class="groupe">
                <label for="confirmation">Confirmer le nouveau mot de passe</label>
                <input class="champ" type="password" id="confirmation" name="confirmation" required minlength="10" autocomplete="new-password">
            </div>
            <button class="btn" type="submit">Enregistrer</button>
        </form>
    </div>
</main>
<?php require __DIR__ . '/_pied.php'; ?>
