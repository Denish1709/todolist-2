<?php 

  session_start();

  $tasks = [];

  $host = 'devkinsta_db';
  $dbname = 'Todolist_2';
  $dbuser = 'root';
  $dbpassword = 'aqvEwR9D41FvwC6l';
  $database = new PDO (
      "mysql:host=$host;dbname=$dbname",
      $dbuser,
      $dbpassword
  );

  $task_name = $_POST['task_name'];

  if (empty($task_name)) {
    $error = "Please Add Task";
  } else {
    $sql = 'INSERT INTO todo (`task`, `completed`) VALUES (:task, :completed)';
    $query = $database->prepare($sql);
    $query->execute([
        'task' => $task_name,
        'completed' => 0
    ]);

    header("Location: /");
    exit;
  }

  if ( isset( $error ) ) {
    // store the error message in session
    $_SESSION['error'] = $error;
    // redirect the user back to /login
    header("Location: /");
    exit;
  }
?>