<?php

return [
    //src

    //global
    'name' => 'Nom',
    'description' => 'Description',
    'status' => 'Statut',
    'priority' => 'Priorité',
    'date' => 'Date limite',
    'category' => 'Catégorie',

    'view_task' => 'Voir',
    'modify_task' => 'Modifier',
    'delete_task' => 'Supprimer',

    'missing_id' => 'ID de tâche manquant ou invalide.',
    'missing_task' => 'Tâche introuvable.',

    'home' => 'Accueil',

    'delete_verifiy' => 'Supprimer cette tâche ?',

    //home
    'home_title' => 'Page d\'accueil | TaskBoard',
    'home_h1' => 'Page d\'accueil',
    'home_p' => 'Bienvenue sur la page d\'accueil de TaskBoard.',
    'home_index' => 'Aller à la gestion des tâches',
    
    //index
    'index_title' => 'Gestion des tâches | TaskBoard',
    'index_h1' => 'Gestion des tâches',
    'index_p' => ' > Gestion des tâches',
    'index_create' => 'Créer une nouvelle tâche',

    //create
    'existing_task' => 'La tâche existe déjà.',
    'db_error' => 'Erreur lors de l\'interaction avec la base de données : ',
    'unexpected_error' => 'Erreur inattendue : ',
    'create_title' => 'Créer une nouvelle tâche | TaskBoard',
    'create_h1' => 'Page d\'accueil',
    'create_nav' => 'Gestion des tâches',
    'create_p' => ' > Création d\'une nouvelle tâche',
    'create_succes' => 'Le formulaire a été soumis avec succès !',
    'create_failed' => 'Le formulaire contient des erreurs :',
    'create_submit' => 'Créer',

    //edit
    'empty_name' => 'Le nom est obligatoire.',
    'error' => 'Erreur : ',
    'edit_title' => 'Modifier une tâche | TaskBoard',
    'edit_h1' => 'Modifier une tâche',
    'edit_p' => '← Retour à la liste',
    'form_error' => 'Le formulaire contient des erreurs :',
    'edit_submit' => 'Modifier',

    //view
    'view_title' => 'Afficher la tâche | TaskBoard',
    'view_h1' => 'Détails de la tâche',
    'view_nav' => 'Gestion des tâches',
    'view_p' => ' > Détails',
    'view_back_to_list' => 'Retour à la liste',

    //langues
    'choose_language' => 'Choisissez votre langue préférée:',
    'languages' => [
        'en' => 'Anglais (English)',
        'fr' => 'Français'
    ],
    'submit' => 'Changer la langue',
    
    //src/classes/Tasks/Task
 
    //const STATUS
    'task_status_todo' => 'À faire',
    'task_status_inprogress' => 'En cours',
    'task_status_completed' => 'Terminé',
 
    //const PRIORITIES
    'task_priorities_low' => 'Faible',
    'task_priorities_normal' => 'Normal',
    'task_priorities_high' => 'Élevé',
 
    //const CATEGORIES
    'task_categories_work' => 'Travail',
    'task_categories_school' => 'Études',
    'task_categories_hobby' => 'Loisir',
    'task_categories_personnal' => 'Personnel',
 
    //construct
    'task_construct_emptyname' => 'Le nom de la tâche est requis.',
    'task_construct_invalidname' => 'Le nom de la tâche doit contenir au moins 2 caractères.',
 
    'task_construct_emptystatus' => 'Le statut de la tâche est requis.',
    'task_construct_invalidstatus' => 'Le statut de la tâche est invalide.',
 
    'task_construct_emptypriority' => 'La priorité de la tâche est requise.',
    'task_construct_invalidpriority' => 'La priorité de la tâche est invalide.',
 
    'task_construct_emptydate' => 'La date limite est requise.',
    'task_construct_invaliddate' => 'La date limite doit être au format AAAA-MM-JJ.',
 
    'task_construct_emptycategory' => 'La catégorie de la tâche est requise.',
    'task_construct_invalidcategory' => 'La catégorie de la tâche est invalide.',
 
    //set functions
    'task_setname_emptyname' => 'Le nom de la tâche est requis.',
    'task_setname_invalidname' => 'Le nom de la tâche doit contenir au moins 2 caractères.',
 
    'task_setstatus_emptystatus' => 'Le statut de la tâche est requis.',
    'task_setstatus_invalidstatus' => 'Le statut de la tâche est invalide.',
 
    'task_setpriority_emptypriority' => 'La priorité de la tâche est requise.',
    'task_setpriority_invalidpriority' => 'La priorité de la tâche est invalide.',
 
    'task_setdate_emptydate' => 'La date limite est requise.',
    'task_setdate_invaliddate' => 'La date limite doit être au format AAAA-MM-JJ.',
 
    'task_setcategory_emptycategory' => 'La catégorie de la tâche est requise.',
    'task_setcategory_invalidcategory' => 'La catégorie de la tâche est invalide.',
 
    
    //src/classes/Database
 
    'database_error' => 'Erreur lors de la lecture du fichier de configuration : ',
 
];