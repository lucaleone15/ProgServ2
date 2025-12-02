<?php
require __DIR__ . '/../src/i18n/load-translation.php';

// Démarre la session pour savoir si l'utilisateur est connecté
session_start();
$userId = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? null;
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/digitallytailored/classless.css/classless.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <title><?= __t('home.title') ?></title>

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
    </style>

</head>

<body>
    <main class="container">

        <!-- Logo -->
        <div class="logo-container">
            <a href="index.php">
                <img src="assets/img/taskboard.png" alt="Taskboard Logo">
            </a>
        </div>

        <h1><?= __t('home.h1') ?></h1>

        <form method="get" style="margin-bottom:1rem;">
            <label for="lang"><?= __t('language.choose') ?></label>
            <select name="lang" id="lang" onchange="this.form.submit()">
                <?php foreach ($translations['language']['languages'] as $code => $label): ?>
                    <option value="<?= $code ?>" <?= __lang() === $code ? 'selected' : '' ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <section style="margin-top:1.5rem;">
            <h2><?= __t('home.description_title') ?></h2>
            <p><?= __t('home.description') ?></p>
        </section>


        <p>
            <a href="tasks/index.php">
                <button type="button"><?= __t('home.index_btn') ?></button>
            </a>
        </p>

        <p>
            <?php if ($userId): ?>
        <p>
            <?= __t('home.logged_in_as') ?> <strong><?= htmlspecialchars($username) ?></strong> –
            <a href="auth/logout.php"><?= __t('home.user_logout') ?></a>
        </p>
    <?php else: ?>
        <p>
            <a href="auth/login.php"><?= __t('login.submit') ?></a> |
            <a href="auth/register.php"><?= __t('register.submit') ?></a>
        </p>
    <?php endif; ?>

    </p>
    </main>
</body>

</html>