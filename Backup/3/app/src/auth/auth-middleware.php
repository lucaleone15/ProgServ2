<?php

// Démarre la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Vérifie si l'utilisateur est connecté
 */
function isAuthenticated(): bool {
    return isset($_SESSION['user_id']);
}

/**
 * Vérifie si l'utilisateur a un rôle spécifique
 */
function hasRole(string $role): bool {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

/**
 * Redirige vers la page de connexion si non authentifié
 */
function requireAuth(string $redirectUrl = '/public/auth/login.php'): void {
    if (!isAuthenticated()) {
        $currentUrl = urlencode($_SERVER['REQUEST_URI']);
        header("Location: $redirectUrl?redirect=$currentUrl");
        exit();
    }
}

/**
 * Redirige si l'utilisateur n'a pas le rôle requis
 */
function requireRole(string $role, string $redirectUrl = '/public/index.php'): void {
    requireAuth();
    
    if (!hasRole($role)) {
        header("Location: $redirectUrl");
        exit();
    }
}

/**
 * Récupère l'ID de l'utilisateur connecté
 */
function getCurrentUserId(): ?int {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Récupère le nom d'utilisateur connecté
 */
function getCurrentUsername(): ?string {
    return $_SESSION['username'] ?? null;
}

/**
 * Récupère le rôle de l'utilisateur connecté
 */
function getCurrentUserRole(): ?string {
    return $_SESSION['role'] ?? null;
}