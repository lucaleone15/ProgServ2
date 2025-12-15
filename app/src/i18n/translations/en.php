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
        'title' => 'Home',
        'h1' => 'Welcome to TaskBoard',
        'description_title' => 'TaskBoard – Your simplified organization',
        'description' => 'TaskBoard is a task management web application designed to help you stay organized and collaborate easily with others. Create your projects, plan your activities, track your priorities, and work as a team from anywhere.',
        'index_btn' => 'Access my tasks',
        'logged_in_as' => 'Logged in as',
        'user_logout' => 'Log out',
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
        'create_btn' => 'Create new task',
    ],

    // CREATE PAGE
    'create' => [
        'title' => 'Create a new task | TaskBoard',
        'h1' => 'Create a new task',
        'nav' => 'Task Management',
        'breadcrumb' => 'New task creation',
        'success' => 'The form was successfully submitted!',
        'failed' => 'The form contains errors:',
        'submit' => 'Create',
        'existing_task' => 'You already have a task with this name.',
        'db_error' => 'Database error: ',
        'unexpected_error' => 'Unexpected error: ',
    ],

    // EDIT PAGE
    'edit' => [
        'title' => 'Edit a task | TaskBoard',
        'h1' => 'Edit a task',
        'breadcrumb' => '← Back to list',
        'submit' => 'Save changes',
        'form_error' => 'The form contains errors:',
        'empty_name' => 'The name is required.',
        'error' => 'Error: ',
        'error_unauthorized' => 'You are not authorized to modify this task.',
        'missing_id' => 'Missing or invalid task ID.',
        'missing_task' => 'Task not found or you do not have access to it.',
    ],

    // VIEW PAGE
    'view' => [
        'title' => 'View task | TaskBoard',
        'h1' => 'Task Details',
        'nav' => 'Task Management',
        'breadcrumb' => 'Details',
        'back_to_list' => 'Back to list',
        'missing_id' => 'Missing or invalid task ID.',
        'missing_task' => 'Task not found or you do not have access to it.',
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

    // TASKS
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
            'school' => 'School',
            'hobby' => 'Hobby',
            'personal' => 'Personal',
        ],
        'error' => [
            'empty_name' => 'Task name cannot be empty',
            'name_too_short' => 'Task name must contain at least 2 characters',
            'invalid_status' => 'Invalid status',
            'invalid_priority' => 'Invalid priority',
            'invalid_category' => 'Invalid category',
        ],
    ],

    // TASK CONSTRUCT ERRORS
    'task_construct' => [
        'empty_name' => 'Task name is required.',
        'invalid_name' => 'Task name must contain at least 2 characters.',
        'empty_status' => 'Task status is required.',
        'invalid_status' => 'Invalid task status.',
        'empty_priority' => 'Task priority is required.',
        'invalid_priority' => 'Invalid task priority.',
        'empty_date' => 'Deadline is required.',
        'invalid_date' => 'Deadline must be in YYYY-MM-DD format.',
        'empty_category' => 'Task category is required.',
        'invalid_category' => 'Invalid task category.',
    ],

    // LOGIN
    'login' => [
        'error_mandatory' => 'All fields are required.',
        'error_incorrect' => 'Incorrect username or password.',
        'error_connect' => 'Login error: ',
        'title' => 'Log in | TaskBoard',
        'h1' => 'Log in',
        'error' => 'Error',
        'username' => 'Username',
        'password' => 'Password',
        'submit' => 'Log in',
        'not_connected' => 'No account yet? ',
        'create_account' => 'Create an account',
        'return_home' => 'Return to homepage',
        'identifier' => 'Username or Email',
        'identifier_placeholder' => 'username / email@example.com',
    ],

    // LOGOUT
    'logout' => [
        'title' => 'Logout | TaskBoard',
        'h1' => 'Successfully logged out',
        'p' => 'You have been successfully logged out.',
        'return_home' => 'Return to homepage',
        'connect' => 'Log in',
        'logout' => 'Log out',
    ],

    // REGISTER
    'register' => [
        'error_mandatory' => 'All fields are required.',
        'error_incorrect' => 'Passwords do not match.',
        'error_password_length' => 'Password must contain at least 8 characters.',
        'error_taken' => 'This username is already taken.',
        'error_email_taken' => 'This email is already used.',
        'error_creation' => 'Account creation error:',
        'error_invalid_email' => 'Invalid email format.',
        'error_mail_config' => 'Error while reading email configuration file.',

        'success_creation' => 'Account successfully created! You can now log in.',
        'success_creation_with_email' => 'Account successfully created! A welcome email has been sent to you.',

        'title' => 'Create an account | TaskBoard',
        'h1' => 'Create an account',

        'error' => 'Error',
        'success' => 'Success',

        'username' => 'Username',
        'email' => 'Email',
        'password' => 'Password (min. 8 characters)',
        'confirm_password' => 'Confirm password',
        'submit' => 'Create my account',

        'placeholder_username' => 'Username',
        'placeholder_email' => 'email@example.com',
        'placeholder_password' => 'Minimum 8 characters',
        'placeholder_confirm' => 'Confirm your password',

        'to_login' => 'Already have an account? ',
        'connect' => 'Log in',
        'return_home' => 'Return to homepage',

        'email_subject' => 'Welcome to TaskBoard!',
        'email_body_html' => '<h1>Welcome %s!</h1><p>Your account has been successfully created. You can now log in.</p>',
        'email_body_text' => 'Welcome %s! Your account has been successfully created. You can now log in.',
    ],

    // DATABASE ERRORS
    'database' => [
        'error' => 'Error reading configuration file: ',
    ],

    // USERS
    'user' => [
        'error_empty_username' => 'Username cannot be empty',
        'error_username_length' => 'Username must contain between 3 and 50 characters',
        'error_password_length' => 'Password must contain at least 8 characters',
        'error_invalid_role' => 'Invalid role',
        'error_empty_email' => 'Please enter an email address.',
        'error_invalid_email' => 'The email address is not valid.',
        'error_email_length' => 'Email address exceeds allowed length.',
    ],

    'admin' => [
        'title' => 'User Administration | TaskBoard',
        'h1' => 'User Management',
        'breadcrumb' => 'Administration',
        'success' => 'Success',
        'error' => 'Error',

        'user_list' => 'User List',
        'username' => 'Username',
        'email' => 'Email',
        'role' => 'Role',
        'registration_date' => 'Registration Date',
        'actions' => 'Actions',

        'you' => 'You',
        'role_admin' => 'Admin',
        'role_user' => 'User',
        'change_role' => 'Change role',
        'delete' => 'Delete',
        'confirm_delete' => 'Are you sure you want to delete this user?',
        'cannot_edit_self_role' => 'You cannot modify your own role.',
        'cannot_delete_self' => 'You cannot delete your own account.',
        'cannot_modify_self' => 'Action not allowed on your own account.',
        'back_to_tasks' => 'Back to tasks',
        'role_updated' => 'Role updated successfully',
        'user_deleted' => 'User deleted successfully',
    ],

    // KANBAN
    'kanban' => [
        'admin' => 'Admin',
        'manage_users' => 'Manage users',
        'tasks_total' => 'task(s) total',
        'view_kanban' => 'Kanban',
        'view_list' => 'List',
        'new_task' => 'New task',
        'no_tasks' => 'No tasks',
        'change_status' => 'Change status...',
        'error_status_change' => 'Error changing status',
        'error_connection' => 'Connection error',
    ],
];
