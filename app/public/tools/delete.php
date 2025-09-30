<?php
require __DIR__ . '/../../src/utils/autoloader.php';

use Tools\ToolsManager;

$toolsManager = new ToolsManager();

if (isset($_GET["id"])) {
    $toolId = $_GET["id"];

    $toolsManager->removeTool($toolId);

    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}