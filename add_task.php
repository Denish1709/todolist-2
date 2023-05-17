<?php 
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
    echo "error";
  } else {
    $sql = 'INSERT INTO todo(`task`, `completed`) VALUES (:task, :completed)';
    $query = $database->prepare($sql);
    $query->execute([
        'task' => $task_name,
        'completed' => 0,
    ]);

    header("Location: index.php");
    exit;
  }
?>