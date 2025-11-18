<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/auth/auth-middleware.php';

// Protéger la page
requireAuth('../auth/login.php');

use Tasks\TasksManager;

$tasksManager = new TasksManager();
$userId = getCurrentUserId();

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $taskId = (int) $_GET["id"];

    // Vérifier que la tâche appartient à l'utilisateur avant de la supprimer
    $task = $tasksManager->getTaskByIdAndUserId($taskId, $userId);
    
    if ($task) {
        // La tâche existe et appartient à l'utilisateur, on peut la supprimer
        $tasksManager->removeTask($taskId, $userId);
    }
}

header("Location: index.php");
exit();