<?php

    require 'templates/mysql.php';

    $username = $_POST['username'];
    $clicks = intval($_POST['clicks']);
    $points = intval($_POST['points']);
    $clicker = intval($_POST['clicker']);

    $conn = connectDatabase();
    $result = mysqli_query($conn, "UPDATE users SET clicks = $clicks, points = $points, clicker = $clicker WHERE username = '$username'");

    if (!$result) {

        echo 'Database error: ' . mysqli_error($conn);
    }

    mysqli_close($conn);

    echo number_format($points);
?>