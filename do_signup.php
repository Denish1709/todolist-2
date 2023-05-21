<?php 

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

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 1. make sure all fields are not empty
    if ( empty( $name ) || empty ( $email ) || empty ( $password ) || empty ( $confirm_password ) ) {
        echo 'All fields are required';
    } else if ( $password !== $confirm_password ){
        // 2. make sure password is match
        echo 'The password is not match';
    } else if ( strlen( $password ) < 8 ) {
         // 3. make sure password is atleast 8 chars
        echo "Your password must be at least 8 character";
    } else {
        // recipe
        $sql = "INSERT INTO users ( `name`, `email`, `password` )
        VALUES (:name, :email, :password)";
        // prepare
        $query = $database->prepare( $sql );
        // execute
        $query->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash( $password, PASSWORD_DEFAULT ) //convert user's password to random string
        ]);

        // redirent user back to index.php
        header("Location: login.php");
        exit; 
    }
?>