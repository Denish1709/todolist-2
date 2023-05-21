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

  $sql = 'SELECT * FROM todo';
  $query = $database->prepare($sql);
  $query->execute();
  $todo = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #444;
      }
    </style>
  </head>
  <body>
  <div class="card rounded shadow-sm mx-auto my-4" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title mb-3">My Classroom</h3>
            <div class="d-flex gap-3">
                <?php if ( isset( $_SESSION["users"] ) ) { ?>
                    <a href="logout.php">Logout</a>
                <?php } else { ?>
                    <a href="login.php">Login</a>
                    <a href="signup.php">Sign Up</a>
                <?php } ?>
            </div>

  <?php if ( isset( $_SESSION["users"] ) ) { ?>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
          <?php foreach ($todo as $student) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <form method="POST" action="update_task.php">
                  <input 
                      type="hidden"
                      name="update_completed"
                      value="<?= $student["completed"]; ?>"
                      />
                      <input 
                        type="hidden"
                        name="update_id"
                        value="<?= $student["id"]; ?>"
                      />

                  <?php if($student['completed'] == 1) {
                      echo '<button class="btn btn-sm btn-success">'.'<i class="bi bi-check-square"></i>'.'</button>'.'<span class="ms-2 text-decoration-line-through">' . $student['task'] . '</span>';
                    } else {
                      echo '<button class="btn btn-sm btn-light">'.'<i class="bi bi-square"></i>'.'</button>'.'<span class="ms-2">' . $student['task'] . '</span>';                    
                      }
                    ?>
                </form>
                  </div>
                  <div>
                  <form method="POST" action="delete_task.php">
                      <input 
                          type="hidden"
                          name="task_id"
                          value="<?= $student["id"]; ?>"
                          />
                          <button class="btn btn-sm btn-danger">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                  </div>
                </li>
                <?php endforeach ?>
              </ul>
              <div class="mt-4">
                <form method="POST" action="add_task.php" class="d-flex justify-content-between align-items-center">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Add new item..."
                    name="task_name"
                    required
                  />
                  <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
                </form>
              </div>
            </div>
          </div>
          <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
