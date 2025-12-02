<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';

use Auth\UserManager;

// Démarre la session
session_start();

// Si l'utilisateur est déjà connecté, le rediriger vers l'accueil
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

// Initialise les variables
$error = '';

// Traite le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['identifier'] ?? ''); // Peut être username ou email
    $password = $_POST['password'] ?? '';

    // Validation des données
    if (empty($identifier) || empty($password)) {
        $error = __t('login.error_mandatory');
    } else {
        try {
            $userManager = new UserManager();

            // Tente l'authentification par username ou email
            $user = null;

            // Si l'identifiant contient un @, c'est probablement un email
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $user = $userManager->authenticateByEmail($identifier, $password);
            } else {
                $user = $userManager->authenticate($identifier, $password);
            }

            if ($user) {
                // Authentification réussie
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['role'] = $user->getRole();

                // Redirection vers la page d'origine ou l'accueil
                $redirect = $_GET['redirect'] ?? '../index.php';
                header('Location: ' . $redirect);
                exit();
            } else {
                $error = __t('login.error_incorrect');
            }
        } catch (Exception $e) {
            $error = __t('login.error_connect') . ' ' . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/digitallytailored/classless.css/classless.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <title><?= __t('login.title') ?></title>

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

        <h1><?= __t('login.h1') ?></h1>

        <?php if ($error): ?>
            <article style="background-color: var(--pico-del-color);">
                <p><strong><?= __t('login.error') ?></strong> <?= htmlspecialchars($error) ?></p>
            </article>
        <?php endif; ?>

        <form method="post">
            <label for="identifier">
                <?= __t('login.identifier') ?>
                <input type="text" id="identifier" name="identifier"
                    value="<?= htmlspecialchars($identifier ?? '') ?>"
                    placeholder="<?= __t('login.identifier_placeholder') ?>"
                    required autofocus>
            </label>

            <label for="password">
                <?= __t('login.password') ?>
                <input type="password" id="password" name="password" required>
            </label>

            <button type="submit"><?= __t('login.submit') ?></button>
        </form>

        <p><?= __t('login.not_connected') ?> <a href="register.php"><?= __t('login.create_account') ?></a></p>
        <p><a href="../index.php"><?= __t('login.return_home') ?></a></p>
    </main>
</body>

</html>