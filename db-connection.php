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
                    echo "New task created successfully";
                } else {
                    echo "Error creating task: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error preparing the SQL statement: " . $connection->error;
            }
        } else {
            echo "Required POST data is missing.";
        }
    }

    
    if (isset($_POST['save'])) {
        saveTask($connection);
    }


    mysqli_close($connection);
?>
