<?php
/** En-tête commun du portail. Variables : $titre, $adminBase, $siteBase, $identifiant (optionnel), $flashs (optionnel). */
header('X-Robots-Tag: noindex, nofollow');
header('X-Frame-Options: DENY');
header('Referrer-Policy: same-origin');
header('Cache-Control: no-store');
?><!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title><?= e($titre) ?> · Administration Kané Eco-Construction</title>
<link rel="icon" href="<?= e($siteBase) ?>assets/img/kane.jpeg">
<style>
:root{--orange:#FF5E14;--orange-fonce:#d94c0b;--nuit:#0E121D;--texte:#2b3240;--gris:#6b7280;--fond:#f4f5f7;--blanc:#fff;--bord:#e3e6ea;--vert:#1f9d55;--rouge:#d23c3c;--rayon:12px}
*{box-sizing:border-box}
html,body{margin:0;padding:0}
body{font-family:system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;background:var(--fond);color:var(--texte);line-height:1.5;-webkit-font-smoothing:antialiased}
a{color:var(--orange);text-decoration:none}
a:hover{text-decoration:underline}
button,input,select,textarea{font:inherit}
.barre{background:var(--nuit);color:#fff;position:sticky;top:0;z-index:20}
.barre-int{max-width:1200px;margin:0 auto;padding:0 16px;height:60px;display:flex;align-items:center;gap:16px}
.barre .logo{display:flex;align-items:center;gap:10px;color:#fff;font-weight:700;letter-spacing:.2px}
.barre .logo img{height:36px;width:auto;border-radius:6px;background:#fff;padding:2px}
.barre .logo span{font-size:15px}
.barre .logo small{display:block;font-weight:500;font-size:11px;color:#9aa3b2;letter-spacing:.6px;text-transform:uppercase}
.barre nav{margin-left:auto;display:flex;align-items:center;gap:6px}
.barre nav a,.barre nav button{color:#d7dbe3;background:transparent;border:0;padding:8px 12px;border-radius:8px;font-size:14px;cursor:pointer}
.barre nav a:hover,.barre nav button:hover{background:rgba(255,255,255,.08);text-decoration:none;color:#fff}
.barre nav .actif{color:#fff;background:rgba(255,255,255,.12)}
.contenu{max-width:1200px;margin:0 auto;padding:24px 16px 64px}
h1{font-size:24px;margin:0 0 4px;color:var(--nuit)}
h2{font-size:17px;margin:0 0 12px;color:var(--nuit)}
.sous-titre{color:var(--gris);margin:0 0 20px;font-size:14px}
.carte{background:var(--blanc);border:1px solid var(--bord);border-radius:var(--rayon);padding:20px}
.flash{padding:12px 14px;border-radius:10px;margin-bottom:12px;font-size:14px;display:flex;gap:10px;align-items:flex-start;border:1px solid transparent}
.flash.succes{background:#e8f7ee;color:#135c33;border-color:#bfe6cf}
.flash.erreur{background:#fdecec;color:#7f1d1d;border-color:#f5c2c2}
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;background:var(--orange);color:#fff;border:0;border-radius:9px;padding:10px 16px;font-weight:600;font-size:14px;cursor:pointer;transition:background .15s;text-decoration:none;white-space:nowrap}
.btn:hover{background:var(--orange-fonce);text-decoration:none;color:#fff}
.btn.second{background:#fff;color:var(--texte);border:1px solid var(--bord)}
.btn.second:hover{background:#f7f7f8}
.btn.danger{background:#fff;color:var(--rouge);border:1px solid #f1caca}
.btn.danger:hover{background:#fdf1f1}
.btn.petit{padding:6px 10px;font-size:13px;border-radius:8px}
.btn.icone{padding:6px 8px;min-width:32px}
.btn[disabled]{opacity:.5;cursor:not-allowed}
label{display:block;font-size:13px;font-weight:600;color:var(--nuit);margin-bottom:6px}
.champ{width:100%;border:1px solid var(--bord);border-radius:9px;padding:10px 12px;background:#fff;color:var(--texte);outline:none;transition:border-color .15s,box-shadow .15s}
.champ:focus{border-color:var(--orange);box-shadow:0 0 0 3px rgba(255,94,20,.15)}
.groupe{margin-bottom:16px}
.aide{font-size:12px;color:var(--gris);margin-top:6px}
.grille-form{display:grid;grid-template-columns:1fr 1fr;gap:16px}
@media (max-width:640px){.grille-form{grid-template-columns:1fr}}
.connexion{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px 16px;background:radial-gradient(1200px 500px at 50% -10%,rgba(255,94,20,.25),transparent),var(--nuit)}
.connexion .carte{width:100%;max-width:420px;padding:32px}
.connexion .logo{text-align:center;margin-bottom:20px}
.connexion .logo img{height:56px;border-radius:8px}
.connexion h1{text-align:center;font-size:20px}
.connexion .sous-titre{text-align:center}
.pied{color:#9aa3b2;font-size:12px;text-align:center;margin-top:24px}
.pied a{color:#c9ceda}
@media (max-width:720px){.barre-int{height:auto;flex-wrap:wrap;padding:8px 12px;gap:8px}.barre .logo span{display:none}.barre nav{margin-left:auto;gap:2px}.barre nav a,.barre nav button{padding:6px 8px;font-size:13px;white-space:nowrap}}
</style>
</head>
<body>
