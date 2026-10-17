<?php
/**
 * Traitement du formulaire de contact (appelé en AJAX par main.js sur contact/envoyer).
 * Répond en texte brut : HTTP 200 = message affiché en vert, 4xx/5xx = en rouge.
 */
require_once __DIR__ . '/mailer.php';
header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Méthode non autorisée.";
    exit;
}

$champ = function ($nom, $max = 500) {
    $v = isset($_POST[$nom]) ? trim((string) $_POST[$nom]) : '';
    $v = str_replace(["\r", "\n"], ' ', $v);
    return mb_substr($v, 0, $max);
};

// Champ piège anti-robots : un humain ne le voit pas, un robot le remplit.
if (!empty($_POST['site_web'])) {
    echo "Merci, votre message a bien été envoyé.";
    exit;
}

$nom = $champ('name', 100);
$email = $champ('email', 150);
$sujet = $champ('subject', 100);
$telephone = $champ('number', 40);
$message = isset($_POST['message']) ? mb_substr(trim((string) $_POST['message']), 0, 3000) : '';

$erreurs = [];
if ($nom === '') {
    $erreurs[] = "votre nom";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erreurs[] = "une adresse e-mail valide";
}
if ($telephone === '') {
    $erreurs[] = "votre numéro de téléphone";
}
if ($message === '') {
    $erreurs[] = "votre message";
}
if ($erreurs) {
    http_response_code(422);
    echo "Merci d'indiquer " . implode(', ', $erreurs) . ".";
    exit;
}

$objet = '[Site web] ' . ($sujet !== '' ? $sujet : 'Nouveau message') . ' - ' . $nom;
$gabarit = mail_template_contact([
    'nom' => $nom,
    'email' => $email,
    'telephone' => $telephone,
    'sujet' => $sujet,
    'message' => strip_tags($message),
    'date' => date('d/m/Y à H:i'),
]);

$resultat = mailer_envoyer($objet, $gabarit['texte'], $email, $nom, $gabarit['html']);

// Journal local : aucune demande n'est perdue, même si l'envoi échoue.
$journal = dirname(__DIR__) . '/data/messages.log';
@file_put_contents($journal, '[' . date('Y-m-d H:i:s') . '] ' . ($resultat['ok'] ? 'OK-' . $resultat['mode'] : 'ECHEC-' . $resultat['mode'] . ' (' . $resultat['erreur'] . ')') . ' ' . json_encode(
    ['nom' => $nom, 'email' => $email, 'tel' => $telephone, 'sujet' => $sujet, 'message' => $message],
    JSON_UNESCAPED_UNICODE
) . "\n", FILE_APPEND | LOCK_EX);

if ($resultat['ok']) {
    echo "Merci $nom, votre message a bien été envoyé. Nous vous répondons sous 24 à 48 h ouvrées.";
} else {
    http_response_code(500);
    echo "L'envoi n'a pas abouti. Appelez-nous au +227 93 33 34 35 ou écrivez à contact@kane-eco-construction.com.";
}
