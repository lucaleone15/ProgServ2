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
        'actions' => 'Actions',
    ],

    // HOME PAGE
    'home' => [
        'title' => 'Accueil',
        'h1' => 'Bienvenue sur TaskBoard',
        'description_title' => 'TaskBoard – Votre organisation simplifiée',
        'description' => 'TaskBoard est une application web de gestion de tâches pensée pour vous aider à rester organisé et à collaborer facilement avec d’autres personnes. Créez vos projets, planifiez vos activités, suivez vos priorités et travaillez en équipe, où que vous soyez.',
        'index_btn' => 'Accéder à mes tâches',
        'logged_in_as' => 'Connecté en tant que',
        'user_logout' => 'Se déconnecter',
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
        'existing_task' => 'Vous avez déjà une tâche avec ce nom.',
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
        'error_unauthorized' => 'Vous n\'êtes pas autorisé à modifier cette tâche.',
        'missing_id' => 'ID de tâche manquant ou invalide.',
        'missing_task' => 'Tâche introuvable ou vous n\'y avez pas accès.',
    ],

    // VIEW PAGE
    'view' => [
        'title' => 'Afficher la tâche | TaskBoard',
        'h1' => 'Détails de la tâche',
        'nav' => 'Gestion des tâches',
        'breadcrumb' => 'Détails',
        'back_to_list' => 'Retour à la liste',
        'missing_id' => 'ID de tâche manquant ou invalide.',
        'missing_task' => 'Tâche introuvable ou vous n\'y avez pas accès.',
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

    // TASKS
    'tasks' => [
        'status' => [
            'todo' => 'À faire',
            'in_progress' => 'En cours',
            'done' => 'Terminé',
        ],
        'priority' => [
            'low' => 'Basse',
            'medium' => 'Moyenne',
            'high' => 'Haute',
        ],
        'category' => [
            'work' => 'Travail',
            'school' => 'Études',
            'hobby' => 'Loisir',
            'personal' => 'Personnel',
        ],
        'error' => [
            'empty_name' => 'Le nom de la tâche ne peut pas être vide',
            'name_too_short' => 'Le nom de la tâche doit contenir au moins 2 caractères',
            'invalid_status' => 'Statut invalide',
            'invalid_priority' => 'Priorité invalide',
            'invalid_category' => 'Catégorie invalide',
        ],
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

    // LOGIN
    'login' => [
        'error_mandatory' => 'Tous les champs sont obligatoires.',
        'error_incorrect' => 'Nom d\'utilisateur ou mot de passe incorrect.',
        'error_connect' => 'Erreur lors de la connexion : ',
        'title' => 'Se connecter | TaskBoard',
        'h1' => 'Se connecter',
        'error' => 'Erreur',
        'username' => 'Nom d\'utilisateur',
        'password' => 'Mot de passe',
        'submit' => 'Se connecter',
        'not_connected' => 'Pas encore de compte ? ',
        'create_account' => 'Créer un compte',
        'return_home' => 'Retour à l\'accueil',
        'identifier' => 'Nom d\'utilisateur ou Email',
        'identifier_placeholder' => 'nom d\'utilisateur / email@exemple.com',
    ],

    // LOGOUT
    'logout' => [
        'title' => 'Déconnexion | TaskBoard',
        'h1' => 'Déconnexion réussie',
        'p' => 'Vous avez été déconnecté(e) avec succès.',
        'return_home' => 'Retour à l\'accueil',
        'connect' => 'Se connecter',
        'logout' => 'Se déconnecter',
    ],

    // REGISTER
    'register' => [
        'error_mandatory' => 'Tous les champs sont obligatoires.',
        'error_incorrect' => 'Les mots de passe ne correspondent pas.',
        'error_password_length' => 'Le mot de passe doit contenir au moins 8 caractères.',
        'error_taken' => 'Ce nom d\'utilisateur est déjà pris.',
        'error_email_taken' => 'Cet email est déjà utilisé.',
        'error_creation' => 'Erreur lors de la création du compte :',
        'error_invalid_email' => 'Le format de l\'email est invalide.',
        'error_mail_config' => 'Erreur lors de la lecture du fichier de configuration.',

        'success_creation' => 'Compte créé avec succès ! Vous pouvez maintenant vous connecter.',
        'success_creation_with_email' => 'Compte créé avec succès ! Un email de bienvenue vous a été envoyé.',

        'title' => 'Créer un compte | TaskBoard',
        'h1' => 'Créer un compte',

        'error' => 'Erreur',
        'success' => 'Succès',

        'username' => 'Nom d\'utilisateur',
        'email' => 'Email',
        'password' => 'Mot de passe (min. 8 caractères)',
        'confirm_password' => 'Confirmer le mot de passe',
        'submit' => 'Créer mon compte',

        'placeholder_username' => 'Nom d\'utilisateur',
        'placeholder_email' => 'exemple@email.com',
        'placeholder_password' => 'Minimum 8 caractères',
        'placeholder_confirm' => 'Confirmez votre mot de passe',

        'to_login' => 'Vous avez déjà un compte ? ',
        'connect' => 'Se connecter',
        'return_home' => 'Retour à l\'accueil',

        'email_subject' => 'Bienvenue sur TaskBoard !',
        'email_body_html' => '<h1>Bienvenue %s !</h1><p>Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.</p>',
        'email_body_text' => 'Bienvenue %s ! Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.',
    ],

    // DATABASE ERRORS
    'database' => [
        'error' => 'Erreur lors de la lecture du fichier de configuration : ',
    ],

    // USERS
    'user' => [
        'error_empty_username' => 'Le nom d\'utilisateur ne peut pas être vide',
        'error_username_length' => 'Le nom d\'utilisateur doit contenir entre 3 et 50 caractères',
        'error_password_length' => 'Le mot de passe doit contenir au moins 8 caractères',
        'error_invalid_role' => 'Rôle invalide',
        'error_empty_email' => 'Veuillez saisir une adresse e-mail.',
        'error_invalid_email' => 'L’adresse e-mail saisie n’est pas valide.',
        'error_email_length' => 'L’adresse e-mail dépasse la longueur autorisée.',
    ],

    'admin' => [
        'title' => 'Administration des utilisateurs | TaskBoard',
        'h1' => 'Gestion des utilisateurs',
        'breadcrumb' => 'Administration',
        'success' => 'Succès',
        'error' => 'Erreur',

        'user_list' => 'Liste des utilisateurs',
        'username' => 'Nom d\'utilisateur',
        'email' => 'Email',
        'role' => 'Rôle',
        'registration_date' => 'Date d\'inscription',
        'actions' => 'Actions',

        'you' => 'Vous',
        'role_admin' => 'Administrateur',
        'role_user' => 'Utilisateur',
        'change_role' => 'Changer le rôle',
        'delete' => 'Supprimer',
        'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer cet utilisateur ?',
        'cannot_edit_self_role' => 'Vous ne pouvez pas modifier votre propre rôle.',
        'cannot_delete_self' => 'Vous ne pouvez pas supprimer votre propre compte.',
        'cannot_modify_self' => 'Action non autorisée sur votre propre compte.',
        'back_to_tasks' => 'Retour aux tâches',
        'role_updated' => 'Rôle mis à jour avec succès',
        'user_deleted' => 'Utilisateur supprimé avec succès',
    ],

];
