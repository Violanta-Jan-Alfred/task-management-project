<?php
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "task_management_db";

    // Establish database connection
    $connection = mysqli_connect($server_name, $username, $password, $db_name);

    // Check for connection failure
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // TESTING
        echo "Connected successfully<br>";
    }

    // SAVE TASK API
    function saveTask($connection) {
        
        if (isset($_POST['taskTitleContent']) && isset($_POST['taskDescriptionContent']) && isset($_POST['taskDueDate'])) {
            $task_name = $_POST['taskTitleContent'];
            $task_description = $_POST['taskDescriptionContent'];
            $due_date = $_POST['taskDueDate'];

        $stmt = $connection->prepare("INSERT INTO tblTask (title, description, due_date) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $task_name, $task_description, $due_date);
            if ($stmt->execute()) {
                echo "<p>New task created successfully.</p>";
            } else {
                echo "<p>Error creating task: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Error preparing the SQL statement: " . $connection->error . "</p>";
        }
    } else {
        echo "<p>Required POST data is missing.</p>";
    }
}

//Handle saving a task
if ($_SERVER ['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    saveTask($connection);
}

//Deleting a Task
if (isset($_GET['delete id'])) {
    $task_id = $_GET ['delete id'];
    $delete_stmt = $connection -> prepare ("DELETE FROM tblTask WHERE id = ?");
    $delete_stmt -> bind_param("i", $task_id);
    if ($delete_stmt -> execute()) {
        echo "<p>Error deleting task: " . $delete_stmt -> error . "</p>" ;
    }
    $delete_stmt -> close();
}

    //Call all task for display

    $result = mysqli_query($connection, "SELECT * FROM tblTask");
    ?>