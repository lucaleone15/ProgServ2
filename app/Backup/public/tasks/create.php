<?php
require __DIR__ . '/../../src/utils/autoloader.php';

use Tasks\TasksManager;
use Tasks\Task;

$tasksManager = new TasksManager();

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
                $errors[] = "La tâche existe déjà.";
            } else {
                $errors[] = "Erreur lors de l'interaction avec la base de données : " . $e->getMessage();
            }
        } catch (Exception $e) {
            $errors[] = "Erreur inattendue : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <title>Créer une nouvelle tâche | TaskBoard</title>
</head>

<body>
    <main class="container">
        <h1>Créer une nouvelle tâche</h1>

        <p><a href="../index.php">Accueil</a> > <a href="index.php">Gestion des tâches</a> > Création d'une nouvelle tâche</p>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST") { ?>
            <?php if (empty($errors)) { ?>
                <p style="color: green;">Le formulaire a été soumis avec succès !</p>
            <?php } else { ?>
                <p style="color: red;">Le formulaire contient des erreurs :</p>
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>

        <form action="create.php" method="POST">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? ''); ?>" required minlength="2">

            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?= htmlspecialchars($description ?? ''); ?>">

            <label for="status">Statut</label>
            <select id="status" name="status" required>
                <?php foreach (Task::STATUS as $key => $value) { ?>
                    <option value="<?= $key ?>" <?php if (isset($status) && $type === $key) echo "selected"; ?>><?= $value ?></option>
                <?php } ?>
            </select>

            <label for="priority">Priorité</label>
            <select id="priority" name="priority" required>
                <?php foreach (Task::PRIORITIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?php if (isset($priority) && $type === $key) echo "selected"; ?>><?= $value ?></option>
                <?php } ?>
            </select>

            <label for="end-date">Date limite</label>
            <input type="date" id="end-date" name="end-date" value="<?= htmlspecialchars($endDate ?? ''); ?>" required>

            <label for="category">Catégorie</label>
            <select id="category" name="category" required>
                <?php foreach (Task::CATEGORIES as $key => $value) { ?>
                    <option value="<?= $key ?>" <?php if (isset($category) && $type === $key) echo "selected"; ?>><?= $value ?></option>
                <?php } ?>
            </select>

            <button type="submit">Créer</button>
        </form>
    </main>
</body>

</html>