<?php
// Ce fichier est inclus dans index.php, donc Task est déjà disponible
// Mais on peut le redéclarer pour éviter les erreurs IDE
use Tasks\Task;
?>
<div class="task-card priority-<?= htmlspecialchars($task->getPriority()) ?>" onclick="window.location.href='view.php?id=<?= $task->getId() ?>'">
    <div class="task-card-header">
        <h3 class="task-card-title"><?= htmlspecialchars($task->getName()) ?></h3>
    </div>

    <?php if (!empty($task->getDescription())): ?>
        <p class="task-card-description">
            <?= htmlspecialchars(mb_substr($task->getDescription(), 0, 100)) ?>
            <?= mb_strlen($task->getDescription()) > 100 ? '...' : '' ?>
        </p>
    <?php endif; ?>

    <div class="task-card-meta">
        <span class="task-badge badge-priority <?= htmlspecialchars($task->getPriority()) ?>">
            <?php
            $priorityIcons = ['high' => '🔴', 'medium' => '🟡', 'low' => '🟢'];
            echo $priorityIcons[$task->getPriority()] ?? '';
            ?>
            <?= htmlspecialchars($task->getTranslatedPriority()) ?>
        </span>

        <span class="task-badge badge-category">
            <?php
            $categoryIcons = ['work' => '💼', 'school' => '📚', 'hobby' => '🎨', 'personal' => '👤'];
            echo $categoryIcons[$task->getCategory()] ?? '';
            ?>
            <?= htmlspecialchars($task->getTranslatedCategory()) ?>
        </span>

        <span class="task-badge badge-date">
            📅 <?= htmlspecialchars($task->getEndDate()->format('d/m/Y')) ?>
        </span>
    </div>

    <div class="task-card-actions" onclick="event.stopPropagation()">
        <select onchange="changeStatus(<?= $task->getId() ?>, this)">
            <option value="">Changer statut...</option>
            <?php
            $statuses = [
                'todo' => __t('tasks.status.todo'),
                'in_progress' => __t('tasks.status.in_progress'),
                'done' => __t('tasks.status.done')
            ];
            foreach ($statuses as $key => $value):
            ?>
                <option value="<?= $key ?>" <?= $task->getStatus() === $key ? 'disabled' : '' ?>>
                    <?= htmlspecialchars($value) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <a href="edit.php?id=<?= $task->getId() ?>" title="Modifier">✏️</a>
        <a href="delete.php?id=<?= $task->getId() ?>"
            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')"
            title="Supprimer"
            style="color: #ef4444;">🗑️</a>
    </div>
</div>