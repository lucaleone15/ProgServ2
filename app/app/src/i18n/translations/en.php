<?php

return [

    // GLOBAL
    'global' => [
        'name' => 'Name',
        'description' => 'Description',
        'status' => 'Status',
        'priority' => 'Priority',
        'date' => 'Deadline',
        'category' => 'Category',

        'view_task' => 'View',
        'modify_task' => 'Edit',
        'delete_task' => 'Delete',
        'confirm_delete' => 'Delete this task?',
        'actions' => 'Actions',
    ],

    // HOME PAGE
    'home' => [
        'title' => 'Home Page | TaskBoard',
        'h1' => 'Home Page',
        'welcome' => 'Welcome to the TaskBoard home page.',
        'index_btn' => 'Go to task management',
        'logged_in_as' => 'Logged in as',
        'user_logout' => 'Logout',
    ],

    // TASK LIST PAGE (INDEX)
    'index' => [
        'title' => 'Task Management | TaskBoard',
        'h1' => 'Task Management',
        'breadcrumb' => [
            'home' => 'Home',
            'current' => 'Task Management',
        ],
        'h2' => 'Task List',
        'create_btn' => 'Create a new task',
    ],

    // CREATE PAGE
    'create' => [
        'title' => 'Create a new task | TaskBoard',
        'h1' => 'Create a new task',
        'nav' => 'Task Management',
        'breadcrumb' => 'Create a new task',
        'success' => 'The form was successfully submitted!',
        'failed' => 'The form contains errors:',
        'submit' => 'Create',
        'existing_task' => 'You already have a task with this name.',
        'db_error' => 'Database interaction error: ',
        'unexpected_error' => 'Unexpected error: ',
    ],

    // EDIT PAGE
    'edit' => [
        'title' => 'Edit a task | TaskBoard',
        'h1' => 'Edit a task',
        'breadcrumb' => '← Back to list',
        'submit' => 'Update',
        'form_error' => 'The form contains errors:',
        'empty_name' => 'Name is required.',
        'error' => 'Error: ',
        'error_unauthorized' => 'You are not authorized to modify this task.',
        'missing_id' => 'Task ID missing or invalid.',
        'missing_task' => 'Task not found or you don\'t have access.',
    ],

    // VIEW PAGE
    'view' => [
        'title' => 'View task | TaskBoard',
        'h1' => 'Task Details',
        'nav' => 'Task Management',
        'breadcrumb' => 'Details',
        'back_to_list' => 'Back to list',
        'missing_id' => 'Task ID missing or invalid.',
        'missing_task' => 'Task not found or you don\'t have access.',
    ],

    // LANGUAGES
    'language' => [
        'choose' => 'Choose your preferred language:',
        'languages' => [
            'en' => 'English',
            'fr' => 'French (Français)',
        ],
        'submit' => 'Change language',
    ],

    // TASKS - Status, Priority, Category with new keys
    'tasks' => [
        'status' => [
            'todo' => 'To do',
            'in_progress' => 'In progress',
            'done' => 'Done',
        ],
        'priority' => [
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
        ],
        'category' => [
            'work' => 'Work',
            'personal' => 'Personal',
            'shopping' => 'Shopping',
            'other' => 'Other',
        ],
        'error' => [
            'empty_name' => 'Task name cannot be empty',
            'name_too_short' => 'Task name must be at least 2 characters',
            'invalid_status' => 'Invalid status',
            'invalid_priority' => 'Invalid priority',
            'invalid_category' => 'Invalid category',
        ],
    ],

    // TASK STATUS (old structure - kept for compatibility)
    'task_status' => [
        'to_do' => 'To do',
        'in_progress' => 'In progress',
        'completed' => 'Completed',
    ],

    // TASK PRIORITIES (old structure - kept for compatibility)
    'task_priority' => [
        'low' => 'Low',
        'normal' => 'Normal',
        'high' => 'High',
    ],

    // TASK CATEGORIES (old structure - kept for compatibility)
    'task_category' => [
        'work' => 'Work',
        'school' => 'School',
        'hobby' => 'Hobby',
        'personal' => 'Personal',
    ],

    // TASK CONSTRUCT ERRORS
    'task_construct' => [
        'empty_name' => 'Task name is required.',
        'invalid_name' => 'Task name must be at least 2 characters.',
        'empty_status' => 'Task status is required.',
        'invalid_status' => 'Task status is invalid.',
        'empty_priority' => 'Task priority is required.',
        'invalid_priority' => 'Task priority is invalid.',
        'empty_date' => 'Deadline is required.',
        'invalid_date' => 'Deadline must be in YYYY-MM-DD format.',
        'empty_category' => 'Task category is required.',
        'invalid_category' => 'Task category is invalid.',
    ],

    // LOGIN
    'login' => [
        'error_mandatory' => 'All fields are required.',
        'error_incorrect' => 'Incorrect username or password.',
        'error_connect' => 'Connection error: ',
        'title' => 'Login | TaskBoard',
        'h1' => 'Login',
        'error' => 'Error',
        'username' => 'Username',
        'password' => 'Password',
        'submit' => 'Login',
        'not_connected' => 'Don\'t have an account yet? ',
        'create_account' => 'Create an account',
        'return_home' => 'Back to home',
    ],

    // LOGOUT
    'logout' => [
        'title' => 'Logout | TaskBoard',
        'h1' => 'Successfully logged out',
        'p' => 'You have been successfully logged out.',
        'return_home' => 'Back to home',
        'connect' => 'Login',
        'logout' => 'Log out',
    ],

    // REGISTER
    'register' => [
        'error_mandatory' => 'All fields are required.',
        'error_incorrect' => 'Passwords do not match.',
        'error_password_length' => 'Password must be at least 8 characters.',
        'error_taken' => 'This username is already taken.',
        'success_creation' => 'Account created successfully! You can now login.',
        'error_creation' => 'Error creating account:',
        'title' => 'Create an account | TaskBoard',
        'h1' => 'Create an account',
        'error' => 'Error',
        'success' => 'Success',
        'connect' => 'Login',
        'username' => 'Username',
        'password' => 'Password (min. 8 characters)',
        'confirm_password' => 'Confirm password',
        'submit' => 'Create my account',
        'to_login' => 'Already have an account? ',
        'return_home' => 'Back to home',
    ],

    // DATABASE ERRORS
    'database' => [
        'error' => 'Error reading configuration file: ',
    ],

    // USERS
    'user' => [
        'error_empty_username' => 'Username cannot be empty',
        'error_username_length' => 'Username must be between 3 and 50 characters',
        'error_password_length' => 'Password must be at least 8 characters',
        'error_invalid_role' => 'Invalid role',
    ],
];