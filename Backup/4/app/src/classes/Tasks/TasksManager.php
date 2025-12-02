<?php

namespace Tasks;

use DateTime;
use PDO;

class TasksManager {
    private PDO $pdo;

    public function __construct() {
        $database = new \Database();
        $this->pdo = $database->getPdo();
    }

    //Récupère toutes les tâches d'un utilisateur spécifique
    public function getTasksByUserId(int $userId): array {
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY end_date ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);

        $tasks = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $this->hydrate($data);
        }

        return $tasks;
    }

    // Récupère une tâche par son ID et vérifie qu'elle appartient à l'utilisateur
    public function getTaskByIdAndUserId(int $taskId, int $userId): ?Task {
        $sql = "SELECT * FROM tasks WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $taskId,
            'user_id' => $userId
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->hydrate($data);
    }

    // Ajoute une nouvelle tâche pour un utilisateur
    public function addTask(Task $task): int {
        $sql = "INSERT INTO tasks (user_id, name, description, status, priority, end_date, category) 
                VALUES (:user_id, :name, :description, :status, :priority, :end_date, :category)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $task->getUserId(),
            'name' => $task->getName(),
            'description' => $task->getDescription(),
            'status' => $task->getStatus(),
            'priority' => $task->getPriority(),
            'end_date' => $task->getEndDate()->format('Y-m-d'),
            'category' => $task->getCategory()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    // Met à jour une tâche si elle appartient à l'utilisateur
    public function updateTask(int $taskId, Task $task, int $userId): bool {
        // Vérifier que la tâche appartient à l'utilisateur
        if ($task->getUserId() !== $userId) {
            return false;
        }

        $sql = "UPDATE tasks 
                SET name = :name, 
                    description = :description, 
                    status = :status, 
                    priority = :priority, 
                    end_date = :end_date, 
                    category = :category
                WHERE id = :id AND user_id = :user_id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $taskId,
            'user_id' => $userId,
            'name' => $task->getName(),
            'description' => $task->getDescription(),
            'status' => $task->getStatus(),
            'priority' => $task->getPriority(),
            'end_date' => $task->getEndDate()->format('Y-m-d'),
            'category' => $task->getCategory()
        ]);
    }

    // Supprime une tâche si elle appartient à l'utilisateur
    public function removeTask(int $taskId, int $userId): bool {
        $sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $taskId,
            'user_id' => $userId
        ]);
    }

    // Compte le nombre de tâches d'un utilisateur
    public function countTasksByUserId(int $userId): int {
        $sql = "SELECT COUNT(*) FROM tasks WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }

    //Récupère les tâches d'un utilisateur par statut
    public function getTasksByUserIdAndStatus(int $userId, string $status): array {
        $sql = "SELECT * FROM tasks WHERE user_id = :user_id AND status = :status ORDER BY end_date ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'status' => $status
        ]);

        $tasks = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tasks[] = $this->hydrate($data);
        }

        return $tasks;
    }

    // Hydrate un tableau de données en objet Task
    private function hydrate(array $data): Task {
        return new Task(
            (int) $data['id'],
            (int) $data['user_id'],
            $data['name'],
            $data['description'],
            $data['status'],
            $data['priority'],
            new DateTime($data['end_date']),
            $data['category']
        );
    }
}