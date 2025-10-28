<?php
require __DIR__ . '/../../src/utils/autoloader.php';

use Tasks\TasksManager;

$tasksManager = new TasksManager();

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID de tâche manquant ou invalide.");
}

$id = (int) $_GET["id"];
$task = $tasksManager->getTaskById($id);

if (!$task) {
    die("Tâche introuvable.");
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

    <title>Afficher la tâche | TaskBoard</title>
</head>

<body>
    <main class="container">
        <h1>Détails de la tâche</h1>

        <p><a href="../index.php">Accueil</a> > <a href="index.php">Gestion des tâches</a> > Détails</p>

        <article>
            <h2><?= htmlspecialchars($task->getName()); ?></h2>

            <p><strong>Description :</strong><br>
                <?= nl2br(htmlspecialchars($task->getDescription())); ?>
            </p>

            <p><strong>Statut :</strong> <?= htmlspecialchars(\Tasks\Task::STATUS[$task->getStatus()] ?? $task->getStatus()); ?></p>
            <p><strong>Priorité :</strong> <?= htmlspecialchars(\Tasks\Task::PRIORITIES[$task->getPriority()] ?? $task->getPriority()); ?></p>
            <p><strong>Date limite :</strong> <?= htmlspecialchars($task->getEndDate()->format('d/m/Y')); ?></p>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars(\Tasks\Task::CATEGORIES[$task->getCategory()] ?? $task->getCategory()); ?></p>
        </article>

        <footer style="margin-top: 2em;">
            <a href="update.php?id=<?= $task->getId(); ?>" role="button">Modifier</a>
            <a href="delete.php?id=<?= $task->getId(); ?>" role="button" class="secondary" onclick="return confirm('Supprimer cette tâche ?');">Supprimer</a>
            <a href="index.php" role="button" class="contrast">Retour à la liste</a>
