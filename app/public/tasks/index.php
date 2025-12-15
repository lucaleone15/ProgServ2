<?php
require __DIR__ . '/../../src/utils/autoloader.php';
require __DIR__ . '/../../src/i18n/load-translation.php';
require __DIR__ . '/../../src/auth/auth-middleware.php';

// Protéger la page - nécessite d'être connecté
requireAuth('../auth/login.php');

use Tasks\TasksManager;
use Tasks\Task;

$tasksManager = new TasksManager();

// Récupérer les infos de l'utilisateur connecté
$userId = getCurrentUserId();
$username = getCurrentUsername();
$userRole = getCurrentUserRole();

// Traiter le changement de statut via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['new_status'])) {
    header('Content-Type: application/json');

    $taskId = (int) $_POST['task_id'];
    $newStatus = $_POST['new_status'];

    try {
        $task = $tasksManager->getTaskByIdAndUserId($taskId, $userId);

        if ($task) {
            $task->setStatus($newStatus);
            $success = $tasksManager->updateTask($taskId, $task, $userId);

            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Task not found']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit();
}

// Récupérer uniquement les tâches de l'utilisateur connecté
$allTasks = $tasksManager->getTasksByUserId($userId);

// Organiser les tâches par statut
$tasksByStatus = [
    'todo' => [],
    'in_progress' => [],
    'done' => []
];

foreach ($allTasks as $task) {
    $status = $task->getStatus();
    if (isset($tasksByStatus[$status])) {
        $tasksByStatus[$status][] = $task;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/digitallytailored/classless.css/classless.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <title><?= __t('index.title') ?></title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .user-info a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            transition: background 0.3s;
        }

        .user-info a:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .view-toggle {
            display: flex;
            gap: 0.5rem;
            background: var(--pico-background-color);
            padding: 0.25rem;
            border-radius: 8px;
        }

        .view-toggle button {
            margin: 0;
            padding: 0.5rem 1rem;
            border: none;
            background: transparent;
            cursor: pointer;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .view-toggle button.active {
            background: var(--pico-primary);
            color: white;
        }

        /* Vue Kanban */
        .kanban-board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .kanban-column {
            background: var(--pico-background-color);
            border-radius: 12px;
            padding: 1rem;
            min-height: 500px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .kanban-column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--pico-muted-border-color);
        }

        .kanban-column-title {
            font-size: 1.25rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .kanban-column-count {
            background: var(--pico-primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .column-todo .kanban-column-title {
            color: #3b82f6;
        }

        .column-in-progress .kanban-column-title {
            color: #f59e0b;
        }

        .column-done .kanban-column-title {
            color: #10b981;
        }

        .kanban-cards {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .task-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            cursor: pointer;
            border-left: 4px solid var(--pico-primary);
        }

        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .task-card.priority-high {
            border-left-color: #ef4444;
        }

        .task-card.priority-medium {
            border-left-color: #f59e0b;
        }

        .task-card.priority-low {
            border-left-color: #10b981;
        }

        .task-card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 0.5rem;
        }

        .task-card-title {
            font-weight: bold;
            color: #1f2937;
            margin: 0;
            font-size: 1rem;
        }

        .task-card-description {
            color: #6b7280;
            font-size: 0.875rem;
            margin: 0.5rem 0;
            line-height: 1.4;
        }

        .task-card-meta {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 0.75rem;
        }

        .task-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-priority {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-priority.medium {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-priority.low {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-category {
            background: #e0e7ff;
            color: #3730a3;
        }

        .badge-date {
            background: #f3f4f6;
            color: #374151;
        }

        .task-card-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e5e7eb;
        }

        .task-card-actions select {
            flex: 1;
            margin: 0;
            padding: 0.5rem;
            font-size: 0.875rem;
            border-radius: 6px;
        }

        .task-card-actions a {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
        }

        /* Vue liste */
        .list-view {
            display: none;
        }

        .list-view.active {
            display: block;
        }

        @media (max-width: 1024px) {
            .kanban-board {
                grid-template-columns: 1fr;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .task-card {
                background: #1f2937;
            }

            .task-card-title {
                color: #f9fafb;
            }

            .task-card-description {
                color: #9ca3af;
            }
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--pico-muted-color);
            font-style: italic;
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
            <div>
                <strong><?= htmlspecialchars($username) ?></strong>
                <?php if ($userRole === 'admin'): ?>
                    <span>(<?= __t('kanban.admin') ?>)</span>
                <?php endif; ?>
            </div>
            <div style="display: flex; gap: 1rem;">
                <?php if ($userRole === 'admin'): ?>
                    <a href="../admin/users.php">🛡️ <?= __t('kanban.manage_users') ?></a>
                <?php endif; ?>
                <a href="../auth/logout.php"><?= __t('logout.logout') ?></a>
            </div>
        </div>

        <!-- En-tête avec actions -->
        <div class="header-actions">
            <div>
                <h1 style="margin: 0;"><?= __t('index.h1') ?></h1>
                <p style="margin: 0.5rem 0 0 0; color: var(--pico-muted-color);">
                    <?= count($allTasks) ?> <?= __t('kanban.tasks_total') ?>
                </p>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <div class="view-toggle">
                    <button class="active" onclick="switchView('kanban')" id="btn-kanban">
                        📊 <?= __t('kanban.view_kanban') ?>
                    </button>
                    <button onclick="switchView('list')" id="btn-list">
                        📋 <?= __t('kanban.view_list') ?>
                    </button>
                </div>
                <a href="create.php">
                    <button type="button">➕ <?= __t('kanban.new_task') ?></button>
                </a>
            </div>
        </div>

        <!-- Vue Kanban -->
        <div class="kanban-view" id="kanban-view">
            <div class="kanban-board">
                <!-- Colonne À faire -->
                <div class="kanban-column column-todo">
                    <div class="kanban-column-header">
                        <div class="kanban-column-title">
                            📝 <?= __t('tasks.status.todo') ?>
                        </div>
                        <div class="kanban-column-count"><?= count($tasksByStatus['todo']) ?></div>
                    </div>
                    <div class="kanban-cards">
                        <?php if (empty($tasksByStatus['todo'])): ?>
                            <div class="empty-state"><?= __t('kanban.no_tasks') ?></div>
                        <?php else: ?>
                            <?php foreach ($tasksByStatus['todo'] as $task): ?>
                                <?php include 'task-card.php'; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Colonne En cours -->
                <div class="kanban-column column-in-progress">
                    <div class="kanban-column-header">
                        <div class="kanban-column-title">
                            ⚡ <?= __t('tasks.status.in_progress') ?>
                        </div>
                        <div class="kanban-column-count"><?= count($tasksByStatus['in_progress']) ?></div>
                    </div>
                    <div class="kanban-cards">
                        <?php if (empty($tasksByStatus['in_progress'])): ?>
                            <div class="empty-state"><?= __t('kanban.no_tasks') ?></div>
                        <?php else: ?>
                            <?php foreach ($tasksByStatus['in_progress'] as $task): ?>
                                <?php include 'task-card.php'; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Colonne Terminé -->
                <div class="kanban-column column-done">
                    <div class="kanban-column-header">
                        <div class="kanban-column-title">
                            ✅ <?= __t('tasks.status.done') ?>
                        </div>
                        <div class="kanban-column-count"><?= count($tasksByStatus['done']) ?></div>
                    </div>
                    <div class="kanban-cards">
                        <?php if (empty($tasksByStatus['done'])): ?>
                            <div class="empty-state"><?= __t('kanban.no_tasks') ?></div>
                        <?php else: ?>
                            <?php foreach ($tasksByStatus['done'] as $task): ?>
                                <?php include 'task-card.php'; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vue Liste -->
        <div class="list-view" id="list-view">
            <table>
                <thead>
                    <tr>
                        <th><?= __t('global.name') ?></th>
                        <th><?= __t('global.description') ?></th>
                        <th><?= __t('global.status') ?></th>
                        <th><?= __t('global.priority') ?></th>
                        <th><?= __t('global.date') ?></th>
                        <th><?= __t('global.category') ?></th>
                        <th><?= __t('global.actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allTasks as $task): ?>
                        <tr>
                            <td><?= htmlspecialchars($task->getName()) ?></td>
                            <td><?= htmlspecialchars($task->getDescription()) ?></td>
                            <td><?= htmlspecialchars($task->getTranslatedStatus()) ?></td>
                            <td><?= htmlspecialchars($task->getTranslatedPriority()) ?></td>
                            <td><?= htmlspecialchars($task->getEndDate()->format('Y-m-d')) ?></td>
                            <td><?= htmlspecialchars($task->getTranslatedCategory()) ?></td>
                            <td>
                                <a href="view.php?id=<?= $task->getId(); ?>" role="button"><?= __t('global.view_task') ?></a>
                                <a href="edit.php?id=<?= $task->getId(); ?>" role="button"><?= __t('global.modify_task') ?></a>
                                <a href="delete.php?id=<?= $task->getId(); ?>" role="button" class="secondary"
                                    onclick="return confirm('<?= __t('global.confirm_delete') ?>');">
                                    <?= __t('global.delete_task') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function switchView(view) {
            const kanbanView = document.getElementById('kanban-view');
            const listView = document.getElementById('list-view');
            const btnKanban = document.getElementById('btn-kanban');
            const btnList = document.getElementById('btn-list');

            if (view === 'kanban') {
                kanbanView.style.display = 'block';
                listView.classList.remove('active');
                btnKanban.classList.add('active');
                btnList.classList.remove('active');
                localStorage.setItem('taskView', 'kanban');
            } else {
                kanbanView.style.display = 'none';
                listView.classList.add('active');
                btnKanban.classList.remove('active');
                btnList.classList.add('active');
                localStorage.setItem('taskView', 'list');
            }
        }

        // Restaurer la vue préférée
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('taskView') || 'kanban';
            switchView(savedView);
        });

        // Changer le statut d'une tâche
        function changeStatus(taskId, selectElement) {
            const newStatus = selectElement.value;

            fetch('index.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `task_id=${taskId}&new_status=${newStatus}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('<?= __t('kanban.error_status_change') ?>');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('<?= __t('kanban.error_connection') ?>');
                });
        }
    </script>
</body>

</html>