<?php

namespace Tasks;

require_once __DIR__ . '/../../utils/autoloader.php';

use Database;

class TasksManager implements TasksManagerInterface {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getTasks(): array {
        $sql = "SELECT * FROM tasks";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->execute();

        $tasks = $stmt->fetchAll();

        $tasks = array_map(function ($taskData) {
            return new Task(
                $taskData['id'],
                $taskData['name'],
                $taskData['description'],
                $taskData['status'],
                $taskData['priority'],
                new \DateTime($taskData['end_date']),
                $taskData['category']
            );
        }, $tasks);

        return $tasks;
    }

    public function addTask(Task $task): int {
        $sql = "INSERT INTO tasks (name, description, status, priority, end_date, category) VALUES (:name, :description, :status, :priority, :end_date, :category)";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindValue(':name', $task->getName());
        $stmt->bindValue(':description', $task->getDescription());
        $stmt->bindValue(':status', $task->getStatus());
        $stmt->bindValue(':priority', $task->getPriority());
        $stmt->bindValue(':end_date', $task->getEndDate()->format('Y-m-d'));
        $stmt->bindValue(':category', $task->getCategory());

        $stmt->execute();

        $taskId = $this->database->getPdo()->lastInsertId();

        return $taskId;
    }

    public function removeTask(int $id): bool {
        $sql = "DELETE FROM tasks WHERE id = :id";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function getTaskById(int $id): ?Task {
        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $this->database->getPdo()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $task = $stmt->fetch();

        if (!$task) {
            return null;
        }

        return new Task(
            $task['id'],
            $task['name'],
            $task['description'],
            $task['status'],
            $task['priority'],
            new \DateTime($task['end_date']),
            $task['category']
        );
    }

    public function updateTask(int $id, Task $task): bool {
        $sql = "UPDATE tasks
                SET name = :name,
                    description = :description,
                    status = :status,
                    priority = :priority,
                    end_date = :end_date,
                    category = :category
                WHERE id = :id";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $task->getName());
        $stmt->bindValue(':description', $task->getDescription());
        $stmt->bindValue(':status', $task->getStatus());
        $stmt->bindValue(':priority', $task->getPriority());
        $stmt->bindValue(':end_date', $task->getEndDate()->format('Y-m-d'));
        $stmt->bindValue(':category', $task->getCategory());

        return $stmt->execute();
    }
}