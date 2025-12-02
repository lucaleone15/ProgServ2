<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';

use Auth\UserManager;
use Auth\User;

// Démarre la session
session_start();

// Si l'utilisateur est déjà connecté, le rediriger vers l'accueil
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

// Initialise les variables
$error = '';
$success = '';

// Traiter le formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validation des données
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        $error = __t('register.error_mandatory');
    } elseif ($password !== $confirmPassword) {
        $error = __t('register.error_incorrect');
    } elseif (strlen($password) < 8) {
        $error = __t('register.error_password_length');
    } else {
        try {
            $userManager = new UserManager();

            // Vérifier si l'utilisateur existe déjà
            if ($userManager->usernameExists($username)) {
                $error = __t('register.error_taken');
            } else {
                // Créer le nouvel utilisateur
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new User(null, $username, $hashedPassword, 'user');
                
                $userId = $userManager->createUser($user);

                if ($userId) {
                    $success = __t('register.success_creation');
                } else {
                    $error = __t('register.error_creation');
                }
            }
        } catch (\InvalidArgumentException $e) {
            $error = $e->getMessage();
        } catch (Exception $e) {
            $error = __t('register.error_creation') . ' ' . htmlspecialchars($e->getMessage());
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <title><?= __t('register.title') ?></title>
</head>

<body>
    <main class="container">
        <h1><?= __t('register.h1') ?></h1>

        <?php if ($error): ?>
            <article style="background-color: var(--pico-del-color);">
                <p><strong><?= __t('register.error') ?></strong> <?= htmlspecialchars($error) ?></p>
            </article>
        <?php endif; ?>

        <?php if ($success): ?>
            <article style="background-color: var(--pico-ins-color);">
                <p><strong><?= __t('register.success') ?></strong> <?= htmlspecialchars($success) ?></p>
                <p><a href="login.php"><?= __t('register.connect') ?></a></p>
            </article>
        <?php else: ?>
            <form method="post">
                <label for="username">
                    <?= __t('register.username') ?>
                    <input type="text" id="username" name="username" 
                           value="<?= htmlspecialchars($username ?? '') ?>" 
                           required autofocus minlength="3" maxlength="50">
                </label>

                <label for="password">
                    <?= __t('register.password') ?>
                    <input type="password" id="password" name="password" 
                           required minlength="8">
                </label>

                <label for="confirm_password">
                    <?= __t('register.confirm_password') ?>
                    <input type="password" id="confirm_password" name="confirm_password" 
                           required minlength="8">
                </label>

                <button type="submit"><?= __t('register.submit') ?></button>
            </form>
        <?php endif; ?>

        <p><?= __t('register.to_login') ?> <a href="login.php"><?= __t('register.connect') ?></a></p>
        <p><a href="../index.php"><?= __t('register.return_home') ?></a></p>
    </main>
</body>

</html>