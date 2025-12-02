<?php
require __DIR__ . '/../../src/i18n/load-translation.php';

// Démarrer la session
session_start();

// Vérifie si l'utilisateur est authentifié
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
    header('Location: login.php');
    exit();
}

// Détruit la session
session_destroy();
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= __t('logout.title') ?></title>
</head>

<body>
    <main class="container">
        <h1><?= __t('logout.h1') ?></h1>

        <p><?= __t('logout.p') ?></p>

        <p>
            <a href="../index.php"><?= __t('logout.return_home') ?></a> |
            <a href="../login.php"><?= __t('logout.connect') ?></a>
        </p>
    </main>
</body>

</html>
