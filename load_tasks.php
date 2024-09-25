<?php
include 'database.php';

$sql = "SELECT * FROM tasks_information";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $tasks = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }

    echo json_encode($tasks);
} else {
    echo json_encode(['message' => 'No tasks found']);
}

mysqli_close($conn);
?>
