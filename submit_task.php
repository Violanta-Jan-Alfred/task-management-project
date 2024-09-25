<?php
include 'database.php';

$taskTitle = $_POST['task_title'];
$taskDescription = $_POST['task_description'];
$taskDueDate = $_POST['task_due_date'];
$isEdit = $_POST['is_edit'] === 'true' ? true : false; 

if ($isEdit && $taskId) {
    $sql = "UPDATE tasks_information SET 
            task_title = ?, task_description = ?, due_date = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssi', $taskTitle, $taskDescription, $taskDueDate, $taskId);
    }
} else {
    $sql = "INSERT INTO tasks_information (task_title, task_description, due_date, status) 
            VALUES (?, ?, ?, 0)"; 
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $taskTitle, $taskDescription, $taskDueDate);
    }
}

if ($stmt && mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => true, 'message' => 'Task saved successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Task saving failed: ' . mysqli_error($conn)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>
