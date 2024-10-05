<?php
include 'database.php';

if (isset($_POST['task_title']) && isset($_POST['status'])) {
    $taskTitle = $_POST['task_title']; 
    $status = $_POST['status'];  

    $sql = "UPDATE tasks_information SET status = ? WHERE task_title = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("is", $status, $taskTitle);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();

?>