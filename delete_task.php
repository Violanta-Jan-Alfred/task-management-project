<?php
include 'database.php';

    if (isset($_POST['task_title'])) {
    $taskTitle = $_POST['task_title'];

    $sql = "DELETE FROM tasks_information WHERE task_title = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $taskTitle);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();

?>