<?php
require __DIR__ . '/../../src/utils/autoloader.php';

use Tasks\TasksManager;
use Tasks\Task;

$tasksManager = new TasksManager();
$errors = [];

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID de tâche manquant ou invalide.");
}

$id = (int) $_GET["id"];
$task = $tasksManager->getTaskById($id);

if (!$task) {
    die("Tâche introuvable.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $status = $_POST["status"];
    $priority = $_POST["priority"];
    $endDate = $_POST["end_date"];
    $category = $_POST["category"];

    if (empty($name)) {
        $errors[] = "Le nom est obligatoire.";
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
            $errors[] = "Erreur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une tâche | TaskBoard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body>
    <main class="container">
        <h1>Modifier une tâche</h1>

        <p><a href="index.php">← Retour à la liste</a></p>

        <?php if (!empty($errors)) { ?>
            <article style="color: red;">
                <strong>Le formulaire contient des erreurs :</strong>
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php } ?>
                </ul>
            </article>
        <?php } ?>

        <form action="edit.php?id=<?= $id ?>" method="POST">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name"
                   value="<?= htmlspecialchars($_POST['name'] ?? $task->getName()) ?>"
                   required minlength="2">

            <label for="description">Description</label>
            <textarea id="description" name="description"><?= htmlspecialchars($_POST['description'] ?? $task->getDescription()) ?></textarea>

            <label for="status">Statut</label>
            <select id="status" name="status" required>
                <?php foreach (Task::STATUS as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (($task->getStatus() === $key) ? "selected" : "") ?>>
                        <?= htmlspecialchars($value) ?>
                    </option>
                <?php } ?>
            </select>

            <label for="priority">Priorité</label>
            <select id="priority" name="priority" required>
                <?php foreach (Task::PRIORITIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (($task->getPriority() === $key) ? "selected" : "") ?>>
                        <?= htmlspecialchars($value) ?>
                    </option>
                <?php } ?>
            </select>

            <label for="end_date">Date limite</label>
            <input type="date" id="end_date" name="end_date"
                   value="<?= htmlspecialchars(($task->getEndDate())->format('Y-m-d')) ?>" required>

            <label for="category">Catégorie</label>
            <select id="category" name="category" required>
                <?php foreach (Task::CATEGORIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?= (($task->getCategory() === $key) ? "selected" : "") ?>>
                        <?= htmlspecialchars($value) ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Modifier</button>
        </form>
    </main>
</body>
</html>
