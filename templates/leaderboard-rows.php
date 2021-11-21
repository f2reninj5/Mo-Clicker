<tr>
    <th>#</th>
    <th>Name</th>
    <th>Points</th>
</tr>

<?php

    if (!function_exists('connectDatabase')) {

        require 'mysql.php';
    }

    $conn = connectDatabase();
    $result = mysqli_query($conn, "SELECT username, points FROM users WHERE clicks > 0 ORDER BY points DESC");

    if (!$result) {

        echo 'Database error: ' . mysql_error($conn);
    }

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    mysqli_close($conn);

    $index = 0;

    foreach ($rows as $user) {

        $index ++;
?>

    <tr>
        <td><?php echo $index; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo number_format($user['points']); ?></td>
    </tr>

<?php } ?>