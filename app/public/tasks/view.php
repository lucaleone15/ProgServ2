<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';

use Tasks\TasksManager;

$tasksManager = new TasksManager();

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die(__t('view.missing_id'));
}

$id = (int) $_GET["id"];
$task = $tasksManager->getTaskById($id);

if (!$task) {
    die(__t('view.missing_task'));
}
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <title><?= __t('view.title') ?></title>
</head>

<body>
    <main class="container">
        <h1><?= __t('view.h1') ?></h1>

        <p>
            <a href="../index.php"><?= __t('index.breadcrumb.home') ?></a> >
            <a href="index.php"><?= __t('index.breadcrumb.current') ?></a> >
            <?= __t('view.breadcrumb') ?>
        </p>

        <article>
            <h2><?= htmlspecialchars($task->getName()); ?></h2>

            <p><strong><?= __t('global.description') ?> :</strong><br>
                <?= nl2br(htmlspecialchars($task->getDescription())); ?>
            </p>

            <p><strong><?= __t('global.status') ?> :</strong> <?= htmlspecialchars(\Tasks\Task::STATUS[$task->getStatus()] ?? $task->getStatus()); ?></p>
            <p><strong><?= __t('global.priority') ?> :</strong> <?= htmlspecialchars(\Tasks\Task::PRIORITIES[$task->getPriority()] ?? $task->getPriority()); ?></p>
            <p><strong><?= __t('global.date') ?> :</strong> <?= htmlspecialchars($task->getEndDate()->format('d/m/Y')); ?></p>
            <p><strong><?= __t('global.category') ?> :</strong> <?= htmlspecialchars(\Tasks\Task::CATEGORIES[$task->getCategory()] ?? $task->getCategory()); ?></p>
        </article>

        <footer style="margin-top: 2em;">
            <a href="edit.php?id=<?= $task->getId(); ?>" role="button"><?= __t('global.modify_task') ?></a>
            <a href="delete.php?id=<?= $task->getId(); ?>" role="button" class="secondary" onclick="return confirm('<?= __t('global.confirm_delete') ?>');">
                <?= __t('global.delete_task') ?>
            </a>
            <a href="index.php" role="button" class="contrast"><?= __t('view.back_to_list') ?></a>
        </footer>
    </main>
</body>
</html>
