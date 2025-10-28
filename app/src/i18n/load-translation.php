<?php
function loadTranslation($lang) {
    $lang_file = __DIR__ . "/translations/{$lang}.php";

    if (!file_exists($lang_file)) {
        $lang_file = __DIR__ . "/translations/fr.php";
    }

    return require_once $lang_file;
}