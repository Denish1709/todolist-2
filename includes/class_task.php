<?php
class Task
{
    public function add()
    {
        // init DB class
        $db = new DB();
        $task_name = $_POST['task_name'];
        // 1. check whether the $_POST['student_name'] is not empty. If is empty, show display error
        if (empty($task_name)){
            // store the error message in session
            $_SESSION['error'] = "Please insert a task";
            header("Location: /");
            exit;
        }
        // 2. add $_POST['student_name'] to database
        // recipe
        $sql = 'INSERT INTO todo (`task`, `completed`) VALUES (:task,:completed)';
        // OOP method
        $db->insert( $sql, [
            'task' => $task_name,
            'completed' => 0
        ] );
        // 3. redirect the user back to /
        header("Location: /");
        exit;
    }
    public function update()
    {
        // init DB class
        $db = new DB();
        $update_completed = $_POST["update_completed"];
        $update_id = $_POST["update_id"];
        if($update_completed == 1){
            $update_completed = 0;
        } else if ($update_completed == 0){
            $update_completed = 1;
        }
        if (empty($update_id)){
            echo "error";
        } else {
            $sql = 'UPDATE todo set completed = :completed WHERE id  = :id';
            $db->update(
                $sql,
                [
                    'id' => $update_id,
                    'completed' => $update_completed
                ]);
            // 3. redirect the user back to index.php
            header("Location: /");
            exit;
        }
    }
    public function delete()
    {
        // init DB class
        $db = new DB();
        $task_id = $_POST["task_id"];
        if ( empty( $task_id ) ) {
            echo "Missing ID";
        } else {
            // recipe
            $sql = "DELETE FROM todo WHERE id = :id";
            $db->delete( $sql,[
                'id' => $task_id
            ]);
            // redirect to the /
            header("Location: /");
            exit;
        }
    }
}










