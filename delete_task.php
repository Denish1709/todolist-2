<?php

    // connect to database (PDO - PHP database Object)
    $host = 'devkinsta_db';
    $dbname = 'Todolist_2';
    $dbuser = 'root';
    $dbpassword = 'aqvEwR9D41FvwC6l';
    $database = new PDO (
        "mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword
    );

    $task_id = $_POST['task_id'];

    if ( empty( $task_id ) ) {
        echo "Missing student ID";
    } else {
        // recipe
        $sql = "DELETE FROM todo WHERE id = :id";

        // prepare
        $query = $database->prepare($sql);

        // execute (cook)
        $query->execute([
            'id' => $task_id
        ]);

        // redirect to the index.php
        header("Location: index.php");
        exit;

    }