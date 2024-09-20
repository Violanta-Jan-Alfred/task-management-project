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

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Task Management - DB Management</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Task Management - Database Operations</h1>

        <h2>Tasks List</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['title']) . "</td>
                        <td>" . htmlspecialchars($row['description']) . "</td>
                        <td>" . htmlspecialchars($row['due_date']) . "</td>
                        <td>
                            <a href='?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this task?\");'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </table>

        <h2>Add New Task</h2>
        <form action="" method="POST">
            <label for="task_name">Task Title:</label>
            <input type="text" name="task_name" id="task_name" required>
            
            <label for="task_description">Task Description:</label>
            <textarea name="task_description" id="task_description" required></textarea>
            
            <label for="due_date">Due Date:</label>
            <input type="date" name="due_date" id="due_date" required>
            
            <button type="submit" name="save">Save Task</button>
        </form>

        <?php
        // Close the connection
        mysqli_close($connection);
        ?>
    </body>
    </html>
