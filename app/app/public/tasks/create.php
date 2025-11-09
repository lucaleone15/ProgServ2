<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';
require __DIR__ . '/../../src/auth/auth-middleware.php';

// Protéger la page
requireAuth('../auth/login.php');

use Tasks\TasksManager;
use Tasks\Task;

$tasksManager = new TasksManager();
$userId = getCurrentUserId();
$username = getCurrentUsername();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    $priority = $_POST["priority"];
    $endDate = $_POST["end-date"];
    $category = $_POST["category"];

    $errors = [];

    try {
        $task = new Task(
            null,
            $userId,
            $name,
            $description,
            $status,
            $priority,
            new \DateTime($endDate),
            $category
        );
    } catch (InvalidArgumentException $e) {
        $errors[] = $e->getMessage();
    }

    if (empty($errors)) {
        try {
            $taskId = $tasksManager->addTask($task);

            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() === "23000") {
                $errors[] = __t('create.existing_task');
            } else {
                $errors[] = __t('create.db_error') . $e->getMessage();
            }
        } catch (Exception $e) {
            $errors[] = __t('create.unexpected_error') . $e->getMessage();
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

    <title><?= __t('create.title') ?></title>

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
            <?= __t('home.logged_in_as') ?> <strong><?= htmlspecialchars($username) ?></strong> —
            <a href="../auth/logout.php"><?= __t('logout.connect') ?></a>
        </div>

        <h1><?= __t('create.h1') ?></h1>

        <p>
            <a href="../index.php"><?= __t('index.breadcrumb.home') ?></a> >
            <a href="index.php"><?= __t('index.breadcrumb.current') ?></a> >
            <?= __t('create.breadcrumb') ?>
        </p>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST") { ?>
            <?php if (empty($errors)) { ?>
                <p style="color: green;"><?= __t('create.success') ?></p>
            <?php } else { ?>
                <p style="color: red;"><?= __t('create.failed') ?></p>
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>

        <form action="create.php" method="POST">
            <label for="name"><?= __t('global.name') ?></label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? ''); ?>" required minlength="2">

            <label for="description"><?= __t('global.description') ?></label>
            <input type="text" id="description" name="description" value="<?= htmlspecialchars($description ?? ''); ?>">

            <label for="status"><?= __t('global.status') ?></label>
            <select id="status" name="status" required>
                <?php foreach (Task::getTranslatedStatuses() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (isset($status) && $status === $key) ? 'selected' : '' ?>><?= htmlspecialchars($value) ?></option>
                <?php } ?>
            </select>

            <label for="priority"><?= __t('global.priority') ?></label>
            <select id="priority" name="priority" required>
                <?php foreach (Task::getTranslatedPriorities() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (isset($priority) && $priority === $key) ? 'selected' : '' ?>><?= htmlspecialchars($value) ?></option>
                <?php } ?>
            </select>

            <label for="end-date"><?= __t('global.date') ?></label>
            <input type="date" id="end-date" name="end-date" value="<?= htmlspecialchars($endDate ?? ''); ?>" required>

            <label for="category"><?= __t('global.category') ?></label>
            <select id="category" name="category" required>
                <?php foreach (Task::getTranslatedCategories() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (isset($category) && $category === $key) ? 'selected' : '' ?>><?= htmlspecialchars($value) ?></option>
                <?php } ?>
            </select>

            <button type="submit"><?= __t('create.submit') ?></button>
        </form>
    </main>
</body>

</html>