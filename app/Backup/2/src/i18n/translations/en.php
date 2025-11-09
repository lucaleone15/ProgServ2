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
        'title' => 'Home | TaskBoard',
        'h1' => 'Home',
        'welcome' => 'Welcome to the TaskBoard home page.',
        'index_btn' => 'Go to task management',
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
        'title' => 'Create a New Task | TaskBoard',
        'h1' => 'Create a New Task',
        'nav' => 'Task Management',
        'breadcrumb' => 'Creating a new task',
        'success' => 'The form has been submitted successfully!',
        'failed' => 'The form contains errors:',
        'submit' => 'Create',
        'existing_task' => 'The task already exists.',
        'db_error' => 'Error interacting with the database: ',
        'unexpected_error' => 'Unexpected error: ',
    ],

    // EDIT PAGE
    'edit' => [
        'title' => 'Edit Task | TaskBoard',
        'h1' => 'Edit Task',
        'breadcrumb' => '← Back to list',
        'submit' => 'Edit',
        'form_error' => 'The form contains errors:',
        'empty_name' => 'Name is required.',
        'error' => 'Error: ',
        'missing_id' => 'Task ID is missing or invalid.',
        'missing_task' => 'Task not found.',
    ],

    // VIEW PAGE
    'view' => [
        'title' => 'View Task | TaskBoard',
        'h1' => 'Task Details',
        'nav' => 'Task Management',
        'breadcrumb' => 'Details',
        'back_to_list' => 'Back to list',
        'missing_id' => 'Task ID is missing or invalid.',
        'missing_task' => 'Task not found.',
    ],

    // LANGUAGES
    'language' => [
        'choose' => 'Choose your preferred language:',
        'languages' => [
            'en' => 'English',
            'fr' => 'French',
        ],
        'submit' => 'Change language',
    ],

    // TASK STATUS
    'task_status' => [
        'to_do' => 'To Do',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
    ],

    // TASK PRIORITIES
    'task_priority' => [
        'low' => 'Low',
        'normal' => 'Normal',
        'high' => 'High',
    ],

    // TASK CATEGORIES
    'task_category' => [
        'work' => 'Work',
        'school' => 'School',
        'hobby' => 'Hobby',
        'personal' => 'Personal',
    ],

    // TASK CONSTRUCT ERRORS
    'task_construct' => [
        'empty_name' => 'Task name is required.',
        'invalid_name' => 'Task name must be at least 2 characters long.',
        'empty_status' => 'Task status is required.',
        'invalid_status' => 'Task status is invalid.',
        'empty_priority' => 'Task priority is required.',
        'invalid_priority' => 'Task priority is invalid.',
        'empty_date' => 'Deadline is required.',
        'invalid_date' => 'Deadline must be in the format YYYY-MM-DD.',
        'empty_category' => 'Task category is required.',
        'invalid_category' => 'Task category is invalid.',
    ],

    // login.php
    'login' => [
        'error_mandatory' => 'All fields are required.',
        'error_incorrect' => 'Incorrect username or password.',
        'error_connect' => 'Connection error: ',
        'title' => 'Login | Session Management',
        'h1' => 'Login',
        'error' => 'Error:',
        'username' => 'Username',
        'password' => 'Password',
        'submit' => 'Log in',
        'not_connected' => 'Don’t have an account yet? ',
        'create_account' => 'Create an account',
        'return_home' => 'Back to home',
    ],

    // logout.php
    'logout' => [
        'title' => 'Logout | Session Management',
        'h1' => 'Logout Successful',
        'p' => 'You have been successfully logged out.',
        'return_home' => 'Back to home',
        'connect' => 'Log in again',
    ],

    // register.php
    'register' => [
        'error_mandatory' => 'All fields are required.',
        'error_incorrect' => 'Passwords do not match.',
        'error_password_length' => 'The password must be at least 8 characters long.',
        'error_taken' => 'This username is already taken.',
        'success_creation' => 'Account successfully created! You can now log in.',
        'error_creation' => 'Error creating account: ',
        'title' => 'Create an Account | Session Management',
        'h1' => 'Create an Account',
        'error' => 'Error:',
        'success' => 'Success:',
        'connect' => 'Log in now',
        'username' => 'Username',
        'password' => 'Password (min. 8 characters)',
        'confirm_password' => 'Confirm Password',
        'submit' => 'Create my account',
        'to_login' => 'Already have an account? ',
        'return_home' => 'Back to home',
    ],

    // DATABASE ERRORS
    'database' => [
        'error' => 'Error reading configuration file: ',
    ],

];
