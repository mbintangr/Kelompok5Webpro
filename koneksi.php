<?php
    $db_hostname = "103.167.35.113";
    $db_username = "delatte";
    $db_password = "Everettt707123";
    $db_name = "webprobanting";
    $conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>