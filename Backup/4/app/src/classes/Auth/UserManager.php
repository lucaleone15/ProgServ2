<?php

namespace Auth;

use Database;
use PDO;

class UserManager {
    private PDO $pdo;

    public function __construct() {
        $database = new Database();
        $this->pdo = $database->getPdo();
    }

    public function createUser(User $user): int {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function getUserByUsername(string $username): ?User {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role']
        );
    }

    public function getUserByEmail(string $email): ?User {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role']
        );
    }

    public function getUserById(int $id): ?User {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['username'],
            $data['email'],
            $data['password'],
            $data['role']
        );
    }

    public function usernameExists(string $username): bool {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        
        return $stmt->fetchColumn() > 0;
    }

    public function emailExists(string $email): bool {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        
        return $stmt->fetchColumn() > 0;
    }

    public function authenticate(string $username, string $password): ?User {
        $user = $this->getUserByUsername($username);
        
        if (!$user) {
            return null;
        }

        if ($user->verifyPassword($password)) {
            return $user;
        }

        return null;
    }

    public function authenticateByEmail(string $email, string $password): ?User {
        $user = $this->getUserByEmail($email);
        
        if (!$user) {
            return null;
        }

        if ($user->verifyPassword($password)) {
            return $user;
        }

        return null;
    }

    public function updateUser(int $id, User $user): bool {
        $sql = "UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            'id' => $id,
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ]);
    }

    public function deleteUser(int $id): bool {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute(['id' => $id]);
    }

    public function getAllUsers(): array {
        $sql = "SELECT * FROM users ORDER BY username";
        $stmt = $this->pdo->query($sql);
        
        $users = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
                $data['id'],
                $data['username'],
                $data['email'],
                $data['password'],
                $data['role']
            );
        }

        return $users;
    }
}