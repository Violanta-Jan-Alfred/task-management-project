<?php
include 'database.php';

if (isset($_POST['old_task_title']) && isset($_POST['task_title']) && isset($_POST['task_description']) && isset($_POST['task_due_date'])) {
    $oldTitle = $_POST['old_task_title']; 
    $newTitle = $_POST['task_title']; 
    $newDescription = $_POST['task_description']; 
    $newDueDate = $_POST['task_due_date']; 

   
    $sql = "UPDATE tasks_information SET task_title = ?, task_description = ?, due_date = ? WHERE task_title = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $newTitle, $newDescription, $newDueDate, $oldTitle);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>