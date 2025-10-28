<?php
require __DIR__ . '/../src/i18n/load-translation.php';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="css/custom.css">

    <title><?= __t('home.title') ?></title>
</head>

<body>
    <main class="container">
        <!-- H1 traduit -->
        <h1><?= __t('home.h1') ?></h1>

        <!-- Sélecteur de langue -->
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

        <!-- Texte de bienvenue traduit -->
        <p><?= __t('home.welcome') ?></p>

        <!-- Bouton vers la gestion des tâches -->
        <p>
            <a href="tasks/index.php">
                <button type="button"><?= __t('home.index_btn') ?></button>
            </a>
        </p>
    </main>
</body>
</html>
