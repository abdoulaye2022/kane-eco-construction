# Kané Eco-Construction

Site vitrine de Kané Eco-Construction (briques de terre compressée, Niamey, Niger).
PHP sans framework, hébergé chez OVH, déployé automatiquement par FTP.

## Lancer en local

```bash
php -S localhost:8000 dev/router.php
```

Puis ouvrir http://localhost:8000. Le routeur de dev sert les fichiers statiques et délègue
le reste à `public/index.php`, comme le `.htaccess` en production.

## Structure

| Dossier | Rôle |
|---|---|
| `public/` | Racine web : `index.php`, assets, `uploads/` (photos envoyées depuis le portail) |
| `includes/` | Header, footer, routeur, galerie, formulaire de contact, portail admin |
| `pages/` | Une page par route (accueil, services, réalisations, à propos, contact, 404) |
| `data/` | Données vivantes : `galerie.json`, `admin.json`, `messages.log` (non versionnées) |
| `data/galerie.seed.json` | Galerie initiale, utilisée tant que `galerie.json` n'existe pas |
| `config/config.php` | Configuration (fuseau horaire, URLs) |
| `dev/router.php` | Routeur du serveur PHP intégré |

Routes publiques : `/`, `/nos-services`, `/nos-realisations`, `/a-propos-de-nous`, `/contact`,
`/contact/envoyer` (POST du formulaire). Portail : `/admin`.

## Portail d'administration des images (`/admin`)

Permet au client d'ajouter, remplacer, supprimer, légender, classer et ordonner les photos de
la galerie « Nos réalisations ». Les 7 photos les plus récentes s'affichent aussi sur l'accueil.

- **Première utilisation** : `/admin` propose de créer le compte administrateur (identifiant +
  mot de passe d'au moins 10 caractères). À faire **immédiatement après le premier déploiement**.
- Le compte est stocké dans `data/admin.json` (hash bcrypt). Pour réinitialiser le mot de passe
  en cas d'oubli : supprimer ce fichier par FTP, puis refaire l'installation.
- Protection : jeton CSRF, 5 échecs de connexion = blocage 15 min par IP, session 8 h,
  cookies HttpOnly/SameSite, dossier `uploads/` sans exécution de scripts.
- Les images envoyées sont vérifiées (JPEG/PNG/WebP, 15 Mo max), redimensionnées à 1600 px
  de large et ré-encodées, puis stockées dans `public/uploads/realisations/`.
- Les photos d'origine (dans `assets/img/realisations/`) peuvent être retirées de la galerie,
  mais le fichier reste sur le disque car il est versionné.

### Pré-requis serveur

Les dossiers `data/` et `public/uploads/` doivent être accessibles en écriture par PHP
(droits 755 chez OVH suffisent en général). Le portail affiche un avertissement sinon.

## Déploiement

Chaque `git push` sur `master` déclenche `.github/workflows/ci.yml` : déploiement FTP de tout
le dépôt vers `/www/` chez OVH. **Un push = une mise en production.**

Les fichiers gérés en production (`data/galerie.json`, `data/admin.json`, `public/uploads/*`)
sont ignorés par Git : ils ne sont ni écrasés ni supprimés par le déploiement.

## Formulaire de contact

Les messages partent vers `contact@kane-eco-construction.com` (adresse modifiable dans le portail,
page **E-mail**). Deux modes d'envoi :

- **SMTP authentifié** (recommandé) via PHPMailer : à configurer dans `/admin/email` avec la boîte
  Zoho Mail du domaine (`smtppro.zoho.com`, port 465, SSL, identifiant `contact@kane-eco-construction.com`,
  mot de passe de la boîte).
  Un bouton « Envoyer un e-mail de test » vérifie la configuration. Réglages dans `data/mail.json`.
- **Repli** sur la fonction `mail()` du serveur si le SMTP n'est pas activé (délivrabilité médiocre).

Les e-mails utilisent un gabarit HTML aux couleurs du site (`includes/mail_template.php`) avec une
version texte en alternative. Le mot de passe SMTP est chiffré au repos (`includes/secret.php`, libsodium
ou OpenSSL) avec une clé générée dans `data/.cle` : si ce fichier est perdu, il suffit de ressaisir le mot
de passe dans le portail. Chaque demande est journalisée dans `data/messages.log` (visible dans le portail), même si l'envoi
échoue. Le « Répondre » du destinataire répond directement au visiteur. Un champ piège filtre les robots.

Dépendance : `phpmailer/phpmailer` (installée par `composer install` dans le workflow de déploiement).
