<?php

// App Timezone
date_default_timezone_set('Africa/Cairo');

// DB Credentials
    // For Localhost
    define('DB_HOSTNAME', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'academia_db');
    // For Cpanel
    define('DB_HOSTNAME_CP', '');
    define('DB_USERNAME_CP', '');
    define('DB_PASSWORD_CP', '');
    define('DB_NAME_CP', '');
// -----------

// Start Session IF Not.
!isset($_SESSION) ? session_start() : '';

// Require Core Files
    require_once "classes/db.php";
    require_once "classes/model.php";
    require_once "classes/tables.php";
    
    require_once "classes/user.php";
    require_once "classes/student.php";
    require_once "classes/result.php";
    require_once 'classes/departments.php';
    require_once 'classes/subjects.php';
    require_once 'classes/specializations.php';
    require_once 'classes/qualifications.php';
    require_once 'classes/pay_for.php';
    require_once 'classes/expense_for.php';
    require_once 'classes/training.php';
// -----------
    
require_once 'print_temp/registration_form/index.php';