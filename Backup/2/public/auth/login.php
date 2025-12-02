<?php
require __DIR__ . '/../../src/i18n/load-translation.php';

const DATABASE_FILE = __DIR__ . '/../../users.db';

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
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validation des données
    if (empty($username) || empty($password)) {
        $error = __t('login.error_mandatory');
    } else {
        try {
            // Connexion à la base de données
            $pdo = new PDO('sqlite:' . DATABASE_FILE);

            // Récupérer l'utilisateur
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            // Vérifier le mot de passe
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header('Location: ../index.php');
                exit();
            } else {
                $error = __t('login.error_incorrect');
            }
        } catch (PDOException $e) {
            $error = __t('login.error_connect') . htmlspecialchars($e->getMessage());
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title><?= __t('login.title') ?></title>
</head>

<body>
    <main class="container">
        <h1><?= __t('login.h1') ?></h1>

        <?php if ($error): ?>
            <article style="background-color: var(--pico-del-color);">
                <p><strong><?= __t('login.error') ?></strong> <?= htmlspecialchars($error) ?></p>
            </article>
        <?php endif; ?>

        <form method="post">
            <label for="username">
                <?= __t('login.username') ?>
                <input type="text" id="username" name="username" required autofocus>
            </label>

            <label for="password">
                <?= __t('login.password') ?>
                <input type="password" id="password" name="password" required>
            </label>

            <button type="submit"><?= __t('login.submit') ?></button>
        </form>

        <p><?= __t('login.not_connected') ?><a href="register.php"><?= __t('login.create_account') ?></a></p>
        <p><a href="../index.php"><?= __t('login.return_home') ?></a></p>
    </main>
</body>
</html>
