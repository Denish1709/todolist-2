<?php 

    // enable at one place only
    session_start();

    // require all the functions files
    require "includes/class-auth.php";
    require "includes/class_db.php";
    require "includes/class_task.php";

    // your website path
    // parse_url will remove all the query string starting from the ?
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    // remove / using trim()
    $path = trim( $path, '/');


    $auth = new Auth();
    $task = new Task();

    switch ($path) {
        case 'auth/login':
            $auth->login();
            break;
        case 'auth/signup':
            $auth->signup();
            break;
        case 'tasks/add':
            $task->add();
            break;
        case 'tasks/delete':
            $task->delete();
            break;
        case 'tasks/update':
            $task->update();
            break;
        case 'login': //condition
            require "pages/login.php";
            break;
        case 'signup':
            require "pages/signup.php";
            break;
        case 'logout':
            $auth->logout();
            break;
        default:
            require "pages/home.php";
            break;
    }