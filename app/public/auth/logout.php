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
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/digitallytailored/classless.css/classless.min.css">
    <title><?= __t('logout.title') ?></title>

    <style>
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
            padding-top: 1rem;
        }

        .logo-container img {
            max-width: 200px;
            height: auto;
        }

        .user-info {
            text-align: right;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background-color: var(--pico-background-color);
            border-radius: 0.25rem;
        }
    </style>
</head>

<body>
    <main class="container">

        <div class="logo-container">
            <a href="../tasks/index.php">
                <img src="../assets/img/taskboard.png" alt="Taskboard Logo">
            </a>
        </div>

        <h1><?= __t('logout.h1') ?></h1>

        <p><?= __t('logout.p') ?></p>

        <p>
            <a href="../index.php"><?= __t('logout.return_home') ?></a> |
            <a href="login.php"><?= __t('logout.connect') ?></a>
        </p>
    </main>
</body>

</html>