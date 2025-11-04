<?php

const COOKIE_LIFETIME = 30*24*60*60; // 30 jours
const COOKIE_NAME = 'lang';
const DEFAULT_LANG = 'fr';
$availableLangs = ['fr', 'en'];

// Changement de langue via GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET[COOKIE_NAME])) {
    $lang = $_GET[COOKIE_NAME];

    if (in_array($lang, $availableLangs)) {
        setcookie(COOKIE_NAME, $lang, time() + COOKIE_LIFETIME, '/');

        $url = strtok($_SERVER['REQUEST_URI'], '?');
        header("Location: $url");
        exit;
    }
}

// Déterminer la langue actuelle
$lang = $_COOKIE[COOKIE_NAME] ?? DEFAULT_LANG;
if (!in_array($lang, $availableLangs)) {
    $lang = DEFAULT_LANG;
}

// Charger le fichier de traduction
$langFile = __DIR__ . "/translations/{$lang}.php";
if (!file_exists($langFile)) {
    $langFile = __DIR__ . "/translations/" . DEFAULT_LANG . ".php";
}

$translations = require $langFile;

// Charger également les traductions par défaut pour fallback
$fallbackFile = __DIR__ . "/translations/" . DEFAULT_LANG . ".php";
$fallbackTranslations = require $fallbackFile;

// Fusion avec fallback
$translations = array_replace_recursive($fallbackTranslations, $translations);

// Fonction helper pour traduire une clé imbriquée
if (!function_exists('__t')) {
    function __t(string $key): string {
        global $translations;
        $keys = explode('.', $key);
        $value = $translations;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key;
            }
        }

        return $value;
    }
}

// Helper pour obtenir la langue actuelle
if (!function_exists('__lang')) {
    function __lang(): string {
        return $_COOKIE[COOKIE_NAME] ?? DEFAULT_LANG;
    }
}
