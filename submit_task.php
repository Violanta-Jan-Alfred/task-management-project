<?php
include 'database.php';

$taskTitle = $_POST['task_title'];
$taskDescription = $_POST['task_description'];
$taskDueDate = $_POST['task_due_date'];
$isEdit = $_POST['is_edit'] === 'true' ? true : false; 

if ($isEdit) {
    $sql = "UPDATE tasks_information SET 
            task_title = ?, task_description = ?, due_date = ?
            WHERE task_title = ? AND task_description = ? AND due_date = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssss', $taskTitle, $taskDescription, $taskDueDate, $taskTitle, $taskDescription, $taskDueDate);
        mysqli_stmt_execute($stmt);
    }
} else {
    $sql = "INSERT INTO tasks_information (task_title, task_description, due_date, status) 
            VALUES (?, ?, ?, 0)"; 
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $taskTitle, $taskDescription, $taskDueDate);
    }
}
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);

?>