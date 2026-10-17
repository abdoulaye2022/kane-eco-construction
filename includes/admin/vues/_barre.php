<header class="barre">
    <div class="barre-int">
        <a class="logo" href="<?= e($adminBase) ?>">
            <img src="<?= e($siteBase) ?>assets/img/kane.jpeg" alt="">
            <span>Kané Eco-Construction<small>Administration des images</small></span>
        </a>
        <nav>
            <a href="<?= e($adminBase) ?>" class="<?= $titre === 'Galerie' ? 'actif' : '' ?>">Galerie</a>
            <a href="<?= e($adminBase) ?>/email" class="<?= $titre === 'E-mail' ? 'actif' : '' ?>">E-mail</a>
            <a href="<?= e($adminBase) ?>/mot-de-passe" class="<?= $titre === 'Mot de passe' ? 'actif' : '' ?>">Mot de passe</a>
            <a href="<?= e($siteBase) ?>nos-realisations" target="_blank" rel="noopener">Voir le site ↗</a>
            <form method="post" action="<?= e($adminBase) ?>/deconnexion" style="margin:0"><?= csrf_champ() ?><button type="submit">Déconnexion</button></form>
        </nav>
    </div>
</header>
