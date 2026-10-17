<?php $titre = 'Galerie'; require __DIR__ . '/_entete.php'; require __DIR__ . '/_barre.php'; ?>
<style>
.entete-page{display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:12px;margin-bottom:20px}
.stats{display:flex;flex-wrap:wrap;gap:8px}
.stat{background:#fff;border:1px solid var(--bord);border-radius:999px;padding:6px 12px;font-size:13px;color:var(--gris)}
.stat b{color:var(--nuit)}
.zone-depot{border:2px dashed #d9dde3;border-radius:var(--rayon);padding:28px 20px;text-align:center;background:#fff;transition:border-color .15s,background .15s;cursor:pointer}
.zone-depot.survol{border-color:var(--orange);background:#fff7f2}
.zone-depot input[type=file]{display:none}
.zone-depot .ico{font-size:34px;line-height:1;margin-bottom:8px}
.zone-depot p{margin:0;color:var(--gris);font-size:14px}
.zone-depot strong{color:var(--nuit);font-size:15px;display:block;margin-bottom:4px}
.apercus{display:flex;flex-wrap:wrap;gap:8px;margin-top:14px;justify-content:center}
.apercus img{width:72px;height:72px;object-fit:cover;border-radius:8px;border:1px solid var(--bord)}
.ligne-envoi{display:grid;grid-template-columns:200px 1fr auto;gap:12px;align-items:end;margin-top:16px}
@media (max-width:760px){.ligne-envoi{grid-template-columns:1fr}}
.filtres{display:flex;flex-wrap:wrap;gap:8px;margin:28px 0 16px}
.filtres a{padding:8px 14px;border-radius:999px;border:1px solid var(--bord);background:#fff;color:var(--texte);font-size:14px;font-weight:500}
.filtres a:hover{text-decoration:none;border-color:#c9ced6}
.filtres a.actif{background:var(--nuit);color:#fff;border-color:var(--nuit)}
.grille{display:grid;grid-template-columns:repeat(auto-fill,minmax(270px,1fr));gap:16px}
.photo{background:#fff;border:1px solid var(--bord);border-radius:var(--rayon);overflow:hidden;display:flex;flex-direction:column}
.photo .visuel{position:relative;aspect-ratio:4/3;background:#eee}
.photo .visuel img{width:100%;height:100%;object-fit:cover;display:block}
.photo .num{position:absolute;top:8px;left:8px;background:rgba(14,18,29,.8);color:#fff;font-size:12px;font-weight:600;padding:3px 8px;border-radius:999px}
.photo .ordre{position:absolute;top:8px;right:8px;display:flex;gap:4px}
.photo .ordre button{background:rgba(255,255,255,.92);border:0;border-radius:7px;width:30px;height:30px;cursor:pointer;font-size:14px;color:var(--nuit)}
.photo .ordre button:hover{background:#fff}
.photo .corps{padding:12px;display:flex;flex-direction:column;gap:10px}
.photo .corps .champ{padding:8px 10px;font-size:14px}
.photo .actions{display:flex;flex-wrap:wrap;gap:6px;align-items:center}
.photo .actions form{margin:0}
.photo .meta{font-size:12px;color:var(--gris)}
.photo input[type=file]{display:none}
.vide{text-align:center;padding:48px 20px;color:var(--gris)}
.alerte{background:#fff8e6;border:1px solid #f6dd9a;color:#6b4b00;padding:12px 14px;border-radius:10px;margin-bottom:16px;font-size:14px}
</style>
<main class="contenu">
    <div class="entete-page">
        <div>
            <h1>Galerie « Nos réalisations »</h1>
            <p class="sous-titre" style="margin:0">Les photos ci-dessous apparaissent sur la page Réalisations ; les plus récentes s'affichent aussi sur la page d'accueil.</p>
        </div>
        <div class="stats">
            <span class="stat"><b><?= (int) $total ?></b> photo<?= $total > 1 ? 's' : '' ?></span>
            <?php foreach ($categories as $slug => $libelle): ?>
                <span class="stat"><b><?= (int) $compteurs[$slug] ?></b> <?= e($libelle) ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <?php require __DIR__ . '/_flashs.php'; ?>

    <?php if (!$ecriturePossible || !$uploadPossible): ?>
        <div class="alerte">⚠ Le serveur n'autorise pas l'écriture dans
            <?= !$ecriturePossible ? '<code>data/</code>' : '' ?><?= (!$ecriturePossible && !$uploadPossible) ? ' et ' : '' ?><?= !$uploadPossible ? '<code>public/uploads/</code>' : '' ?>.
            Les modifications ne pourront pas être enregistrées tant que les droits d'écriture ne sont pas accordés (via FTP : droits 755 sur ces dossiers).</div>
    <?php endif; ?>

    <section class="carte" id="ajout">
        <h2>Ajouter des photos</h2>
        <form method="post" action="<?= e($adminBase) ?>/ajouter" enctype="multipart/form-data" id="form-ajout">
            <?= csrf_champ() ?>
            <input type="hidden" name="filtre" value="<?= e($filtre) ?>">
            <label class="zone-depot" id="zone-depot" for="images">
                <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/webp" multiple required>
                <div class="ico">📷</div>
                <strong>Cliquez pour choisir des photos</strong>
                <p>ou glissez-les ici. JPEG, PNG ou WebP, plusieurs à la fois. Elles sont automatiquement redimensionnées pour le web.</p>
                <div class="apercus" id="apercus"></div>
            </label>
            <div class="ligne-envoi">
                <div>
                    <label for="categorie">Catégorie</label>
                    <select class="champ" id="categorie" name="categorie" required>
                        <?php foreach ($categories as $slug => $libelle): ?>
                            <option value="<?= e($slug) ?>" <?= $filtre === $slug ? 'selected' : '' ?>><?= e($libelle) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="legende">Légende (facultatif, appliquée à toutes les photos envoyées)</label>
                    <input class="champ" type="text" id="legende" name="legende" maxlength="200" placeholder="Ex. : Villa R+1 en briques de terre compressée, Niamey">
                </div>
                <button class="btn" type="submit" id="btn-envoyer">Envoyer</button>
            </div>
            <p class="aide">Limite du serveur : <?= e($tailleMaxServeur) ?> par fichier. Vous pourrez modifier la légende et la catégorie de chaque photo ensuite.</p>
        </form>
    </section>

    <div class="filtres">
        <a href="<?= e($adminBase) ?>" class="<?= $filtre === '' ? 'actif' : '' ?>">Toutes (<?= (int) $total ?>)</a>
        <?php foreach ($categories as $slug => $libelle): ?>
            <a href="<?= e($adminBase) ?>?categorie=<?= e($slug) ?>" class="<?= $filtre === $slug ? 'actif' : '' ?>"><?= e($libelle) ?> (<?= (int) $compteurs[$slug] ?>)</a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($images)): ?>
        <div class="carte vide">Aucune photo dans cette catégorie pour le moment.</div>
    <?php else: ?>
        <div class="grille">
            <?php foreach ($images as $position => $img): ?>
                <article class="photo" id="photo-<?= e($img['id']) ?>">
                    <div class="visuel">
                        <a href="<?= e($siteBase . galerie_url($img['src'])) ?>" target="_blank" rel="noopener" title="Ouvrir l'image en taille réelle">
                            <img src="<?= e($siteBase . galerie_url($img['src'])) ?>" alt="" loading="lazy">
                        </a>
                        <span class="num">#<?= $position + 1 ?></span>
                        <?php if ($filtre === ''): ?>
                        <div class="ordre">
                            <form method="post" action="<?= e($adminBase) ?>/deplacer"><?= csrf_champ() ?><input type="hidden" name="id" value="<?= e($img['id']) ?>"><input type="hidden" name="direction" value="premier"><button type="submit" title="Mettre en première position">⤒</button></form>
                            <form method="post" action="<?= e($adminBase) ?>/deplacer"><?= csrf_champ() ?><input type="hidden" name="id" value="<?= e($img['id']) ?>"><input type="hidden" name="direction" value="haut"><button type="submit" title="Monter">↑</button></form>
                            <form method="post" action="<?= e($adminBase) ?>/deplacer"><?= csrf_champ() ?><input type="hidden" name="id" value="<?= e($img['id']) ?>"><input type="hidden" name="direction" value="bas"><button type="submit" title="Descendre">↓</button></form>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="corps">
                        <form method="post" action="<?= e($adminBase) ?>/modifier" class="form-modif">
                            <?= csrf_champ() ?>
                            <input type="hidden" name="id" value="<?= e($img['id']) ?>">
                            <input type="hidden" name="filtre" value="<?= e($filtre) ?>">
                            <div style="display:flex;flex-direction:column;gap:8px">
                                <input class="champ" type="text" name="legende" value="<?= e($img['legende']) ?>" maxlength="200" placeholder="Légende de la photo" aria-label="Légende">
                                <div style="display:flex;gap:8px">
                                    <select class="champ" name="categorie" aria-label="Catégorie">
                                        <?php foreach ($categories as $slug => $libelle): ?>
                                            <option value="<?= e($slug) ?>" <?= $img['categorie'] === $slug ? 'selected' : '' ?>><?= e($libelle) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button class="btn petit second" type="submit">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                        <div class="actions">
                            <form method="post" action="<?= e($adminBase) ?>/remplacer" enctype="multipart/form-data" class="form-remplacer">
                                <?= csrf_champ() ?>
                                <input type="hidden" name="id" value="<?= e($img['id']) ?>">
                                <input type="hidden" name="filtre" value="<?= e($filtre) ?>">
                                <input type="file" name="image" accept="image/jpeg,image/png,image/webp">
                                <button class="btn petit second" type="button" onclick="this.previousElementSibling.click()">↻ Remplacer</button>
                            </form>
                            <form method="post" action="<?= e($adminBase) ?>/supprimer" onsubmit="return confirm('Retirer définitivement cette photo du site ?')">
                                <?= csrf_champ() ?>
                                <input type="hidden" name="id" value="<?= e($img['id']) ?>">
                                <input type="hidden" name="filtre" value="<?= e($filtre) ?>">
                                <button class="btn petit danger" type="submit">🗑 Supprimer</button>
                            </form>
                        </div>
                        <div class="meta"><?= $img['ajoute_le'] ? 'Ajoutée le ' . e(substr($img['ajoute_le'], 0, 10)) : '' ?><?= galerie_est_upload($img['src']) ? '' : ' · photo d\'origine du site' ?></div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<script>
(function () {
    var zone = document.getElementById('zone-depot'),
        input = document.getElementById('images'),
        apercus = document.getElementById('apercus'),
        form = document.getElementById('form-ajout'),
        bouton = document.getElementById('btn-envoyer');

    function montrerApercus(fichiers) {
        apercus.innerHTML = '';
        Array.prototype.slice.call(fichiers, 0, 24).forEach(function (f) {
            if (!f.type.match(/^image\//)) { return; }
            var img = document.createElement('img');
            img.src = URL.createObjectURL(f);
            img.onload = function () { URL.revokeObjectURL(img.src); };
            apercus.appendChild(img);
        });
        bouton.textContent = fichiers.length ? 'Envoyer ' + fichiers.length + ' photo' + (fichiers.length > 1 ? 's' : '') : 'Envoyer';
    }

    input.addEventListener('change', function () { montrerApercus(input.files); });
    ['dragenter', 'dragover'].forEach(function (ev) {
        zone.addEventListener(ev, function (e) { e.preventDefault(); zone.classList.add('survol'); });
    });
    ['dragleave', 'drop'].forEach(function (ev) {
        zone.addEventListener(ev, function (e) { e.preventDefault(); zone.classList.remove('survol'); });
    });
    zone.addEventListener('drop', function (e) {
        if (e.dataTransfer && e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            montrerApercus(input.files);
        }
    });
    form.addEventListener('submit', function () {
        bouton.disabled = true;
        bouton.textContent = 'Envoi en cours…';
    });

    // Remplacement : l'envoi part dès qu'un fichier est choisi.
    document.querySelectorAll('.form-remplacer input[type=file]').forEach(function (champ) {
        champ.addEventListener('change', function () {
            if (champ.files.length && confirm('Remplacer cette photo par « ' + champ.files[0].name + ' » ?')) {
                champ.form.submit();
            } else {
                champ.value = '';
            }
        });
    });
})();
</script>
<?php require __DIR__ . '/_pied.php'; ?>
