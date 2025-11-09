<?php
require __DIR__ . '/../../src/utils/autoloader.php';

use Tasks\TasksManager;

$tasksManager = new TasksManager();

if (isset($_GET["id"])) {
    $taskId = $_GET["id"];

    $tasksManager->removeTask($taskId);

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}