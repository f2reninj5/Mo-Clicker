<?php

    require 'templates/mysql.php';

    $username = $_POST['username'];
    $clicks = intval($_POST['clicks']);

    $conn = connectDatabase();
    $result = mysqli_query($conn, "UPDATE users SET clicks = $clicks WHERE username = '$username'");

    if (!$result) {

        echo 'Database error: ' . mysqli_error($conn);
    }

    mysqli_close($conn);

    echo $clicks;
?>