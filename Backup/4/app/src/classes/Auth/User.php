<?php

namespace Auth;

class User {
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(?int $id, string $username, string $email, string $password, string $role = 'user') {
        $this->id = $id;
        $this->setUsername($username);
        $this->setEmail($email);
        $this->password = $password;
        $this->setRole($role);
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRole(): string {
        return $this->role;
    }

    // Setters avec validation
    public function setUsername(string $username): void {
        if (empty(trim($username))) {
            throw new \InvalidArgumentException(__t('user.error_empty_username'));
        }
        if (strlen($username) < 3 || strlen($username) > 50) {
            throw new \InvalidArgumentException(__t('user.error_username_length'));
        }
        $this->username = trim($username);
    }

    public function setEmail(string $email): void {
        $email = trim($email);
        if (empty($email)) {
            throw new \InvalidArgumentException(__t('user.error_empty_email'));
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(__t('user.error_invalid_email'));
        }
        if (strlen($email) > 255) {
            throw new \InvalidArgumentException(__t('user.error_email_length'));
        }
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        if (strlen($password) < 8) {
            throw new \InvalidArgumentException(__t('user.error_password_length'));
        }
        $this->password = $password;
    }

    public function setRole(string $role): void {
        $validRoles = ['user', 'admin'];
        if (!in_array($role, $validRoles)) {
            throw new \InvalidArgumentException(__t('user.error_invalid_role'));
        }
        $this->role = $role;
    }

    public function hashPassword(string $plainPassword): string {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $plainPassword): bool {
        return password_verify($plainPassword, $this->password);
    }
}