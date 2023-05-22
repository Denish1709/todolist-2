<?php 

    // enable at one place only
    session_start();

    // your website path
    // parse_url will remove all the query string starting from the ?
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    // remove / using trim()
    $path = trim( $path, '/');


    if ( $path == 'login' ){
        // load login.php
        require "login.php";
    } else if ( $path == 'signup') {
        //load signup.php
        require "signup.php";
    } else if ( $path == 'logout') {
        // load logout.php
        require "logout.php";
    } else {
        // load home.php
        require "home.php";
    }