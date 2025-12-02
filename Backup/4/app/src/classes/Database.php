<?php

class Database implements DatabaseInterface {
    const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../config/database.ini';

    private $pdo;

    public function __construct() {
        $config = parse_ini_file(self::DATABASE_CONFIGURATION_FILE, true);

        if (!$config) {
            throw new Exception(__t('database.error') . self::DATABASE_CONFIGURATION_FILE);
        }

        $host = $config['host'];
        $port = $config['port'];
        $database = $config['database'];
        $username = $config['username'];
        $password = $config['password'];

        $this->pdo = new PDO("mysql:host=$host;port=$port;charset=utf8mb4", $username, $password);

        $sql = "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $sql = "USE `$database`;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Table users (créée en premier pour la contrainte de clé étrangère)
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role VARCHAR(20) NOT NULL DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Table tasks
        $sql = "CREATE TABLE IF NOT EXISTS tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            name VARCHAR(100) NOT NULL,
            description VARCHAR(200),
            status TEXT NOT NULL,
            priority TEXT NOT NULL,
            end_date DATE NOT NULL,
            category TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            UNIQUE KEY unique_user_task (user_id, name)
        );";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }
}