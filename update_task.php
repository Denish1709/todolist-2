<?php

    $host = 'devkinsta_db';
    $dbname = 'Todolist_2';
    $dbuser = 'root';
    $dbpassword = 'aqvEwR9D41FvwC6l';
    $database = new PDO (
        "mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword
    );

    $task_completed = $_POST["task_completed"];
    $task_id = $_POST["task_id"];

    if ( $task_completed == 1 ){
        $task_completed = 0;
    } else if ( $task_completed == 0 ){
        $task_completed = 1;
    }

    // 1. check whether the $_POST['student_name'] is not empty. If is empty, show display error
    if (empty( $task_id )){
        echo "Please insert a task";
    } else {
        // 2. add $_POST['student_name'] to database
        // recipe
        $sql = 'UPDATE todo set completed = :completed WHERE id = :id';
        // prepare
        $query = $database->prepare( $sql );
        // execute
        $query->execute([
            'completed' => $task_completed,
            'id' => $task_id
        ]);        
        
        // 3. redirect the user back to index.php
        header("Location: index.php");
        exit;

    }

