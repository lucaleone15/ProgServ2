<?php

namespace Tools;

require_once __DIR__ . '/../../utils/autoloader.php';

use Database;

class ToolsManager implements ToolsManagerInterface {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function getTools(): array {
        $sql = "SELECT * FROM tools";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->execute();

        $tools = $stmt->fetchAll();

        $tools = array_map(function ($toolData) {
            return new Tool(
                $toolData['id'],
                $toolData['name'],
                $toolData['type'],
                new \DateTime($toolData['purchase_date']),
                $toolData['price']
            );
        }, $tools);

        return $tools;
    }

    public function addTool(Tool $tool): int {
        $sql = "INSERT INTO tools (name, type, purchase_date, price) VALUES (:name, :type, :purchase_date, :price)";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindValue(':name', $tool->getName());
        $stmt->bindValue(':type', $tool->getType());
        $stmt->bindValue(':purchase_date', $tool->getPurchaseDate()->format('Y-m-d'));
        $stmt->bindValue(':price', $tool->getPrice());

        $stmt->execute();

        $toolId = $this->database->getPdo()->lastInsertId();

        return $toolId;
    }

    public function removeTool(int $id): bool {
        $sql = "DELETE FROM tools WHERE id = :id";

        $stmt = $this->database->getPdo()->prepare($sql);

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }
}