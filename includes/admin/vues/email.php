<?php $titre = 'E-mail'; require __DIR__ . '/_entete.php'; require __DIR__ . '/_barre.php'; ?>
<style>
.deux-colonnes{display:grid;grid-template-columns:minmax(0,1.3fr) minmax(0,1fr);gap:20px;align-items:start}
@media (max-width:900px){.deux-colonnes{grid-template-columns:1fr}}
.interrupteur{display:flex;align-items:center;gap:10px;font-weight:600;color:var(--nuit);cursor:pointer;margin:0}
.interrupteur input{width:18px;height:18px;accent-color:var(--orange)}
.bloc-smtp{border-top:1px solid var(--bord);margin-top:18px;padding-top:18px}
.bloc-smtp.inactif{opacity:.55}
.journal{font-family:ui-monospace,SFMono-Regular,Menlo,monospace;font-size:12px;line-height:1.5;background:#0E121D;color:#d7dbe3;border-radius:10px;padding:14px;overflow:auto;max-height:360px;white-space:pre-wrap;word-break:break-word}
.journal .ok{color:#7ee2a8}.journal .ko{color:#ff9b9b}
.etat{display:inline-flex;align-items:center;gap:6px;font-size:13px;padding:4px 10px;border-radius:999px;background:#eef1f5;color:var(--gris)}
.etat.on{background:#e8f7ee;color:#135c33}
.etat.off{background:#fff3e8;color:#8a3d00}
.actions-ligne{display:flex;flex-wrap:wrap;gap:10px;align-items:center;margin-top:18px}
</style>
<main class="contenu">
    <h1>Formulaire de contact : envoi des e-mails</h1>
    <p class="sous-titre">Les messages envoyés depuis le site arrivent à l'adresse destinataire ci-dessous.
        L'envoi SMTP via la boîte mail Zoho du domaine est le mode le plus fiable ; sans SMTP, le serveur utilise sa fonction d'envoi basique, souvent classée en spam.</p>
    <?php require __DIR__ . '/_flashs.php'; ?>

    <?php if (!$config['smtp_actif'] && in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1'], true)): ?>
        <div class="alerte" style="background:#fff8e6;border:1px solid #f6dd9a;color:#6b4b00;padding:12px 14px;border-radius:10px;margin-bottom:16px;font-size:14px">
            ⚠ <strong>Environnement local :</strong> sans SMTP, les messages sont acceptés par votre ordinateur mais ne sont jamais délivrés
            (ils restent dans la file d'attente locale). Activez le SMTP ci-dessous pour recevoir réellement les e-mails.
        </div>
    <?php endif; ?>

    <div class="deux-colonnes">
        <section class="carte">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;margin-bottom:14px">
                <h2 style="margin:0">Paramètres</h2>
                <?php if ($config['smtp_actif']): ?>
                    <span class="etat on">● SMTP actif</span>
                <?php else: ?>
                    <span class="etat off">● Mode basique (mail du serveur)</span>
                <?php endif; ?>
            </div>
            <form method="post" action="<?= e($adminBase) ?>/email" autocomplete="off">
                <?= csrf_champ() ?>
                <input type="hidden" name="action" value="enregistrer">
                <div class="groupe">
                    <label for="destinataire">Adresse qui reçoit les messages du site</label>
                    <input class="champ" type="email" id="destinataire" name="destinataire" required value="<?= e($config['destinataire']) ?>">
                </div>
                <div class="grille-form">
                    <div class="groupe">
                        <label for="expediteur">Adresse expéditrice</label>
                        <input class="champ" type="email" id="expediteur" name="expediteur" required value="<?= e($config['expediteur']) ?>">
                        <p class="aide">Doit être une adresse de votre domaine (ex. contact@kane-eco-construction.com).</p>
                    </div>
                    <div class="groupe">
                        <label for="nom_expediteur">Nom affiché</label>
                        <input class="champ" type="text" id="nom_expediteur" name="nom_expediteur" maxlength="80" value="<?= e($config['nom_expediteur']) ?>">
                    </div>
                </div>

                <div class="bloc-smtp <?= $config['smtp_actif'] ? '' : 'inactif' ?>" id="bloc-smtp">
                    <label class="interrupteur" style="margin-bottom:14px">
                        <input type="checkbox" name="smtp_actif" id="smtp_actif" value="1" <?= $config['smtp_actif'] ? 'checked' : '' ?>>
                        Envoyer via SMTP (recommandé)
                    </label>
                    <?php if (!$phpmailer): ?>
                        <div class="alerte" style="background:#fff8e6;border:1px solid #f6dd9a;color:#6b4b00;padding:10px 12px;border-radius:10px;margin-bottom:14px;font-size:13px">⚠ La bibliothèque PHPMailer n'est pas installée sur ce serveur (dossier <code>vendor/</code> absent). Le mode SMTP ne fonctionnera pas tant que <code>composer install</code> n'a pas été exécuté.</div>
                    <?php endif; ?>
                    <div class="grille-form">
                        <div class="groupe">
                            <label for="smtp_hote">Serveur SMTP</label>
                            <input class="champ" type="text" id="smtp_hote" name="smtp_hote" value="<?= e($config['smtp_hote']) ?>" placeholder="smtppro.zoho.com">
                            <p class="aide">Zoho Mail : <code>smtppro.zoho.com</code>. OVH : <code>ssl0.ovh.net</code>. Gmail : <code>smtp.gmail.com</code> (mot de passe d'application).</p>
                        </div>
                        <div class="groupe">
                            <label for="smtp_port">Port et sécurité</label>
                            <div style="display:flex;gap:8px">
                                <input class="champ" type="number" id="smtp_port" name="smtp_port" min="1" max="65535" value="<?= (int) $config['smtp_port'] ?>" style="max-width:110px">
                                <select class="champ" name="smtp_securite" id="smtp_securite">
                                    <option value="ssl" <?= $config['smtp_securite'] === 'ssl' ? 'selected' : '' ?>>SSL (port 465)</option>
                                    <option value="tls" <?= $config['smtp_securite'] === 'tls' ? 'selected' : '' ?>>STARTTLS (port 587)</option>
                                    <option value="aucune" <?= $config['smtp_securite'] === 'aucune' ? 'selected' : '' ?>>Aucune (déconseillé)</option>
                                </select>
                            </div>
                        </div>
                        <div class="groupe">
                            <label for="smtp_utilisateur">Identifiant (adresse e-mail complète)</label>
                            <input class="champ" type="text" id="smtp_utilisateur" name="smtp_utilisateur" value="<?= e($config['smtp_utilisateur']) ?>" placeholder="contact@kane-eco-construction.com" autocapitalize="off">
                        </div>
                        <div class="groupe">
                            <label for="smtp_mot_de_passe">Mot de passe de la boîte mail</label>
                            <input class="champ" type="password" id="smtp_mot_de_passe" name="smtp_mot_de_passe" placeholder="<?= $config['smtp_mot_de_passe'] !== '' ? '•••••••• (inchangé si vide)' : '' ?>" autocomplete="new-password">
                            <p class="aide">Chiffré sur le serveur (clé séparée, hors du dossier web), jamais affiché ni réutilisé ailleurs.</p>
                        </div>
                    </div>
                </div>

                <div class="actions-ligne">
                    <button class="btn" type="submit">Enregistrer</button>
                </div>
            </form>
            <form method="post" action="<?= e($adminBase) ?>/email" class="actions-ligne" style="margin-top:10px">
                <?= csrf_champ() ?>
                <input type="hidden" name="action" value="tester">
                <button class="btn second" type="submit">✉ Envoyer un e-mail de test à <?= e($config['destinataire']) ?></button>
                <span class="aide" style="margin:0">Utilise les paramètres enregistrés.</span>
            </form>
        </section>

        <section class="carte">
            <h2>Derniers messages reçus</h2>
            <p class="aide" style="margin-top:-6px;margin-bottom:12px">Journal de secours : chaque demande est notée ici, même si l'e-mail n'est pas parti.</p>
            <?php if (empty($dernieres)): ?>
                <p style="color:var(--gris);font-size:14px;margin:0">Aucun message pour l'instant.</p>
            <?php else: ?>
                <div class="journal"><?php foreach ($dernieres as $ligne):
                    $classe = strpos($ligne, '] OK') !== false ? 'ok' : 'ko';
                    ?><span class="<?= $classe ?>"><?= e($ligne) ?></span>

<?php endforeach; ?></div>
            <?php endif; ?>
        </section>
    </div>
</main>
<script>
(function () {
    var c = document.getElementById('smtp_actif'), b = document.getElementById('bloc-smtp'),
        port = document.getElementById('smtp_port'), sec = document.getElementById('smtp_securite');
    c.addEventListener('change', function () { b.classList.toggle('inactif', !c.checked); });
    sec.addEventListener('change', function () {
        if (sec.value === 'ssl' && port.value == 587) port.value = 465;
        if (sec.value === 'tls' && port.value == 465) port.value = 587;
    });
})();
</script>
<?php require __DIR__ . '/_pied.php'; ?>
