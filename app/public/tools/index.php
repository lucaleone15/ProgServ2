<?php
require __DIR__ . '/../../src/utils/autoloader.php';

use Tasks\TasksManager;
use Tasks\Task;

$tasksManager = new TasksManager();

$tasks = $tasksManager->getTasks();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <title>Gestion des tâches | TaskBoard</title>
</head>

<body>
    <main class="container">
        <h1>Gestion des tâches</h1>

        <p><a href="../index.php">Accueil</a> > Gestion des tâches</p>

        <h2>Liste des tâches</h2>

        <p><a href="create.php"><button>Créer une nouvelle tâche</button></a></p>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Priorité</th>
                    <th>Date limite</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) { ?>
                    <tr>
                        <td><?= htmlspecialchars($task->getName()) ?></td>
                        <td><?= htmlspecialchars($task->getDescription()) ?></td>
                        <td><?= htmlspecialchars(Task::STATUS[$task->getStatus()]) ?></td>
                        <td><?= htmlspecialchars(Task::PRIORITIES[$task->getPriority()]) ?></td>
                        <td><?= htmlspecialchars($task->getEndDate()->format('Y-m-d')) ?></td>
                        <td><?= htmlspecialchars(Task::CATEGORIES[$task->getCategory()]) ?></td>
                        <td>
                            <a href="delete.php?id=<?= htmlspecialchars($task->getId()) ?>"><button>Supprimer</button></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>