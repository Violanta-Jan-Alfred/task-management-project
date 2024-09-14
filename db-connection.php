<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $db_name = "task_management_db";

    $connection = mysqli_connect($server_name, $username, $password, $db_name);

    

    $connection->close();
?>
