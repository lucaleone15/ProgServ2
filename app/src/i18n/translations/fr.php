<?php

return [

    // GLOBAL
    'global' => [
        'name' => 'Nom',
        'description' => 'Description',
        'status' => 'Statut',
        'priority' => 'Priorité',
        'date' => 'Date limite',
        'category' => 'Catégorie',

        'view_task' => 'Voir',
        'modify_task' => 'Modifier',
        'delete_task' => 'Supprimer',
        'confirm_delete' => 'Supprimer cette tâche ?',
    ],

    // HOME PAGE
    'home' => [
        'title' => 'Page d\'accueil | TaskBoard',
        'h1' => 'Page d\'accueil',
        'welcome' => 'Bienvenue sur la page d\'accueil de TaskBoard.',
        'index_btn' => 'Aller à la gestion des tâches',
    ],

    // TASK LIST PAGE (INDEX)
    'index' => [
        'title' => 'Gestion des tâches | TaskBoard',
        'h1' => 'Gestion des tâches',
        'breadcrumb' => [
            'home' => 'Accueil',
            'current' => 'Gestion des tâches',
        ],
        'h2' => 'Liste des tâches',
        'create_btn' => 'Créer une nouvelle tâche',
    ],

    // CREATE PAGE
    'create' => [
        'title' => 'Créer une nouvelle tâche | TaskBoard',
        'h1' => 'Créer une nouvelle tâche',
        'nav' => 'Gestion des tâches',
        'breadcrumb' => 'Création d\'une nouvelle tâche',
        'success' => 'Le formulaire a été soumis avec succès !',
        'failed' => 'Le formulaire contient des erreurs :',
        'submit' => 'Créer',
        'existing_task' => 'La tâche existe déjà.',
        'db_error' => 'Erreur lors de l\'interaction avec la base de données : ',
        'unexpected_error' => 'Erreur inattendue : ',
    ],

    // EDIT PAGE
    'edit' => [
        'title' => 'Modifier une tâche | TaskBoard',
        'h1' => 'Modifier une tâche',
        'breadcrumb' => '← Retour à la liste',
        'submit' => 'Modifier',
        'form_error' => 'Le formulaire contient des erreurs :',
        'empty_name' => 'Le nom est obligatoire.',
        'error' => 'Erreur : ',
        'missing_id' => 'ID de tâche manquant ou invalide.',
        'missing_task' => 'Tâche introuvable.',
    ],

    // VIEW PAGE
    'view' => [
        'title' => 'Afficher la tâche | TaskBoard',
        'h1' => 'Détails de la tâche',
        'nav' => 'Gestion des tâches',
        'breadcrumb' => 'Détails',
        'back_to_list' => 'Retour à la liste',
        'missing_id' => 'ID de tâche manquant ou invalide.',
        'missing_task' => 'Tâche introuvable.',
    ],

    // LANGUAGES
    'language' => [
        'choose' => 'Choisissez votre langue préférée:',
        'languages' => [
            'en' => 'Anglais (English)',
            'fr' => 'Français',
        ],
        'submit' => 'Changer la langue',
    ],

    // TASK STATUS
    'task_status' => [
        'todo' => 'À faire',
        'inprogress' => 'En cours',
        'completed' => 'Terminé',
    ],

    // TASK PRIORITIES
    'task_priority' => [
        'low' => 'Faible',
        'normal' => 'Normal',
        'high' => 'Élevé',
    ],

    // TASK CATEGORIES
    'task_category' => [
        'work' => 'Travail',
        'school' => 'Études',
        'hobby' => 'Loisir',
        'personal' => 'Personnel',
    ],

    // TASK CONSTRUCT ERRORS
    'task_construct' => [
        'empty_name' => 'Le nom de la tâche est requis.',
        'invalid_name' => 'Le nom de la tâche doit contenir au moins 2 caractères.',
        'empty_status' => 'Le statut de la tâche est requis.',
        'invalid_status' => 'Le statut de la tâche est invalide.',
        'empty_priority' => 'La priorité de la tâche est requise.',
        'invalid_priority' => 'La priorité de la tâche est invalide.',
        'empty_date' => 'La date limite est requise.',
        'invalid_date' => 'La date limite doit être au format AAAA-MM-JJ.',
        'empty_category' => 'La catégorie de la tâche est requise.',
        'invalid_category' => 'La catégorie de la tâche est invalide.',
    ],

    // DATABASE ERRORS
    'database' => [
        'error' => 'Erreur lors de la lecture du fichier de configuration : ',
    ],

];
