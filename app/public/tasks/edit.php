<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';

use Tasks\TasksManager;
use Tasks\Task;

$tasksManager = new TasksManager();
$errors = [];

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die(__t('edit.missing_id'));
}

$id = (int) $_GET["id"];
$task = $tasksManager->getTaskById($id);

if (!$task) {
    die(__t('edit.missing_task'));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $status = $_POST["status"];
    $priority = $_POST["priority"];
    $endDate = $_POST["end_date"];
    $category = $_POST["category"];

    if (empty($name)) {
        $errors[] = __t('edit.empty_name');
    }

    if (empty($errors)) {
        try {
            $updatedTask = new Task(
                $id,
                $name,
                $description,
                $status,
                $priority,
                new \DateTime($endDate),
                $category
            );

            $tasksManager->updateTask($id, $updatedTask);

            header("Location: view.php?id=" . $id);
            exit();
        } catch (Exception $e) {
            $errors[] = __t('edit.error') . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars(__lang()) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __t('edit.title') ?></title>
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

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
                <img src="../assets/img/taskboard.png" alt="Taskboard Logo">
            </a>
        </div>

        <h1><?= __t('edit.h1') ?></h1>

        <p><a href="index.php"><?= __t('edit.breadcrumb') ?></a></p>

        <?php if (!empty($errors)) { ?>
            <article style="color: red;">
                <strong><?= __t('edit.form_error') ?></strong>
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php } ?>
                </ul>
            </article>
        <?php } ?>


        <form action="edit.php?id=<?= $id ?>" method="POST">
            <label for="name"><?= __t('global.name') ?></label>
            <input type="text" id="name" name="name"
                value="<?= htmlspecialchars($_POST['name'] ?? $task->getName()) ?>"
                required minlength="2">

            <label for="description"><?= __t('global.description') ?></label>
            <textarea id="description" name="description"><?= htmlspecialchars($_POST['description'] ?? $task->getDescription()) ?></textarea>

            <label for="status"><?= __t('global.status') ?></label>
            <select id="status" name="status" required>
                <?php foreach (Task::getTranslatedStatuses() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (($task->getStatus() === $key) ? "selected" : "") ?>>
                        <?= htmlspecialchars($value) ?>
                    </option>
                <?php } ?>
            </select>

            <label for="priority"><?= __t('global.priority') ?></label>
            <select id="priority" name="priority" required>
                <?php foreach (Task::getTranslatedPriorities() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (($task->getPriority() === $key) ? "selected" : "") ?>>
                        <?= htmlspecialchars($value) ?>
                    </option>
                <?php } ?>
            </select>

            <label for="end_date"><?= __t('global.date') ?></label>
            <input type="date" id="end_date" name="end_date"
                value="<?= htmlspecialchars(($task->getEndDate())->format('Y-m-d')) ?>" required>

            <label for="category"><?= __t('global.category') ?></label>
            <select id="category" name="category" required>
                <?php foreach (Task::getTranslatedCategories() as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (($task->getCategory() === $key) ? "selected" : "") ?>>
                        <?= htmlspecialchars($value) ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit"><?= __t('edit.submit') ?></button>
        </form>
    </main>
</body>

</html>