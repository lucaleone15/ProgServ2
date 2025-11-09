<?php
// Constantes
const DATABASE_FILE = __DIR__ . '/../../users.db';

// Démarre la session
session_start();

// Charge le système de traduction
require_once __DIR__ . '/../../src/i18n/load-translation.php';

// Initialise les variables
$error = '';
$success = '';

// Traiter le formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
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
            // Connexion à la base de données
            $pdo = new PDO('sqlite:' . DATABASE_FILE);

            // Vérifier si l'utilisateur existe déjà
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user) {
                $error = __t('register.error_taken');
            } else {
                // Hacher le mot de passe
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insérer le nouvel utilisateur
                $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (:username, :password, :role)');
                $stmt->execute([
                    'username' => $username,
                    'password' => $hashedPassword,
                    'role' => 'user'
                ]);

                $success = __t('register.success_creation');
            }
        } catch (PDOException $e) {
            $error = __t('register.error_creation') . ' ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= __t('register.title') ?></title>
</head>

<body>
    <main class="container">
        <h1><?= __t('register.h1') ?></h1>

        <?php if ($error) { ?>
            <p><strong><?= __t('register.error') ?> :</strong> <?= htmlspecialchars($error) ?></p>
        <?php } ?>

        <?php if ($success) { ?>
            <p><strong><?= __t('register.success') ?> :</strong> <?= htmlspecialchars($success) ?></p>
            <p><a href="login.php"><?= __t('register.connect') ?></a></p>
        <?php } ?>

        <form method="post">
            <label for="username">
                <?= __t('register.username') ?>
                <input type="text" id="username" name="username" required autofocus>
            </label>

            <label for="password">
                <?= __t('register.password') ?>
                <input type="password" id="password" name="password" required minlength="8">
            </label>

            <label for="confirm_password">
                <?= __t('register.confirm_password') ?>
                <input type="password" id="confirm_password" name="confirm_password" required minlength="8">
            </label>

            <button type="submit"><?= __t('register.submit') ?></button>
        </form>

        <p><?= __t('register.to_login') ?><a href="login.php"><?= __t('register.connect') ?></a></p>
        <p><a href="../index.php"><?= __t('register.return_home') ?></a></p>
    </main>
</body>

</html>
