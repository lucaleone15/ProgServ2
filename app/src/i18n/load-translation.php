<?php
/**
 * Gestion des traductions avec cookie et fallback.
 */

const COOKIE_LIFETIME = 30*24*60*60; // 30 jours
const COOKIE_NAME = 'lang';
const DEFAULT_LANG = 'fr';
$availableLangs = ['fr', 'en'];

// 🔹 1. Changement de langue via GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET[COOKIE_NAME])) {
    $lang = $_GET[COOKIE_NAME];

    if (in_array($lang, $availableLangs)) {
        setcookie(COOKIE_NAME, $lang, time() + COOKIE_LIFETIME, '/');

        // redirection pour nettoyer l'URL
        $url = strtok($_SERVER['REQUEST_URI'], '?');
        header("Location: $url");
        exit;
    }
}

// 🔹 2. Déterminer la langue actuelle
$lang = $_COOKIE[COOKIE_NAME] ?? DEFAULT_LANG;
if (!in_array($lang, $availableLangs)) {
    $lang = DEFAULT_LANG;
}

// 🔹 3. Charger le fichier de traduction
$langFile = __DIR__ . "/translations/{$lang}.php";
if (!file_exists($langFile)) {
    $langFile = __DIR__ . "/translations/" . DEFAULT_LANG . ".php";
}

$translations = require $langFile;

// 🔹 4. Charger également les traductions par défaut pour fallback
$fallbackFile = __DIR__ . "/translations/" . DEFAULT_LANG . ".php";
$fallbackTranslations = require $fallbackFile;

// 🔹 5. Fusion avec fallback
$translations = array_replace_recursive($fallbackTranslations, $translations);

// 🔹 6. Fonction helper pour traduire une clé imbriquée
if (!function_exists('__t')) {
    function __t(string $key): string {
        global $translations;
        $keys = explode('.', $key);
        $value = $translations;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key; // si clé manquante, renvoie la clé brute
            }
        }

        return $value;
    }
}

// 🔹 7. Helper pour obtenir la langue actuelle
if (!function_exists('__lang')) {
    function __lang(): string {
        return $_COOKIE[COOKIE_NAME] ?? DEFAULT_LANG;
    }
}
