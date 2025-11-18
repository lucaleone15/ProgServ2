<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';
require __DIR__ . '/../../src/auth/auth-middleware.php';

// Protéger la page - nécessite d'être connecté
requireAuth('../auth/login.php');

use Tasks\TasksManager;
use Tasks\Task;

$tasksManager = new TasksManager();

// Récupérer les infos de l'utilisateur connecté
$userId = getCurrentUserId();
$username = getCurrentUsername();
$userRole = getCurrentUserRole();

// Récupérer uniquement les tâches de l'utilisateur connecté
$tasks = $tasksManager->getTasksByUserId($userId);
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

    <title><?= __t('index.title') ?></title>

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

        <!-- Logo -->
        <div class="logo-container">
            <a href="index.php">
                <img src="../assets/img/taskboard.png" alt="Taskboard Logo">
            </a>
        </div>

        <!-- Informations utilisateur -->
        <div class="user-info">
            <?= __t('home.logged_in_as') ?> <strong><?= htmlspecialchars($username) ?></strong>
            <?php if ($userRole === 'admin'): ?>
                <span style="color: var(--pico-primary);">(Admin)</span>
            <?php endif; ?>
            —
            <a href="../auth/logout.php"><?= __t('logout.logout') ?></a>
        </div>

        <h1><?= __t('index.h1') ?></h1>

        <p>
            <a href="../index.php"><?= __t('index.breadcrumb.home') ?></a> >
            <?= __t('index.breadcrumb.current') ?>
        </p>

        <h2><?= __t('index.h2') ?></h2>

        <p>
            <a href="create.php">
                <button type="button"><?= __t('index.create_btn') ?></button>
            </a>
        </p>

        <table>
            <thead>
                <tr>
                    <th><?= __t('global.name') ?></th>
                    <th><?= __t('global.description') ?></th>
                    <th><?= __t('global.status') ?></th>
                    <th><?= __t('global.priority') ?></th>
                    <th><?= __t('global.date') ?></th>
                    <th><?= __t('global.category') ?></th>
                    <th><?= __t('global.actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?= htmlspecialchars($task->getName()) ?></td>
                        <td><?= htmlspecialchars($task->getDescription()) ?></td>
                        <td><?= htmlspecialchars($task->getTranslatedStatus()) ?></td>
                        <td><?= htmlspecialchars($task->getTranslatedPriority()) ?></td>
                        <td><?= htmlspecialchars($task->getEndDate()->format('Y-m-d')) ?></td>
                        <td><?= htmlspecialchars($task->getTranslatedCategory()) ?></td>
                        <td>
                            <a href="view.php?id=<?= $task->getId(); ?>" role="button"><?= __t('global.view_task') ?></a>
                            <a href="edit.php?id=<?= $task->getId(); ?>" role="button"><?= __t('global.modify_task') ?></a>
                            <a href="delete.php?id=<?= $task->getId(); ?>" role="button" class="secondary"
                                onclick="return confirm('<?= __t('global.confirm_delete') ?>');">
                                <?= __t('global.delete_task') ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>