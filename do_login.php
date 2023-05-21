<?php

    // connect to database (PDO - PHP database Object)
    session_start();

    $host = 'devkinsta_db';
    $dbname = 'Todolist_2';
    $dbuser = 'root';
    $dbpassword = 'aqvEwR9D41FvwC6l';
    $database = new PDO (
        "mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword
    );

    $email = $_POST["email"];
    $password = $_POST["password"];

    // 1. make sure all fields are not empty
    if ( empty($email) || empty($password) ) {
        echo 'All fields are required';
    } else {
        // retrieve the user based on the email provided
        // recipe
        $sql = "SELECT * FROM users where email = :email";
        // prepare
        $query = $database->prepare( $sql );
        // execute
        $query->execute([
            'email' => $email
        ]);
        // fetch (eat)
        $user = $query->fetch(); // fetch() will only return one row of data

        // make sure the email provided is in the database
        if ( empty( $user ) ) {
            echo "The email provided does not exists";
        } else {
            // make sure password is correct
            if ( password_verify( $password, $user["password"] ) ) {
                // if password is valid, set the user session
                $_SESSION["users"] = $user;

                header("Location: index.php");
                exit;
            } else {
                // if password is incorrect
                echo "The password provided is not match";
            }
        }

    }
    