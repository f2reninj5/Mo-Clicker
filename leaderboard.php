<?php

    require 'templates/mysql.php';

    if(isset($_COOKIE['session'])) {

        $session = $_COOKIE['session'];

        $conn = connectDatabase();
        $result = mysqli_query($conn, "SELECT username, clicks FROM users WHERE session = '$session'");

        if (!$result) {

            echo 'Databse error: ' . mysqli_error($conn);
        }

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        if (count($rows) > 0) {

            $username = htmlspecialchars($rows[0]['username']);
            $clicks = intval($rows[0]['clicks']);

        } else {

            header('Location: register.php');
        }

    } else {

        header('Location: register.php');
    }
?>

<html>
    
    <head>
		
		<link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width">
		<meta charset="utf-8">

		<title>Mo Clicker</title>

        <link rel="icon" href="images/mo stache.svg">
	</head>

    <body>

        <audio id="music" loop src="audio/music.mp3"></audio>

        <input id="mute_music" class="mute" type="image" style="left: 0; width: 5em; position: absolute;" src="images/sound/music_mute.svg" onclick="mute('mute_music', 'music')">

        <?php echo "Welcome, $username <br />"; ?>

        <a href="/" style="font-size: 2em; position: absolute; right: 0;">Back</a>

        <h>Mo Clicker Leaderboard</h>

        <div>

            <table>

                <?php
                
                    $conn = connectDatabase();
                    $result = mysqli_query($conn, "SELECT username, clicks FROM users ORDER BY clicks DESC");

                    if (!$result) {

                        echo 'Database error: ' . mysql_error($conn);
                    }

                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    mysqli_free_result($result);
                    mysqli_close($conn);

                    foreach ($rows as $user) {
                ?>

                    <tr>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['clicks'] ?></td>
                    </tr>

                <?php } ?>
            </table>
        </div>

        <footer>

            <h style="font-size: 2em;">Credits</h>

            <table>

                <tr>

                    <td>Computer Stuff</td>
                    <td>Maks Nowak</td>
                </tr>
                <tr>

                    <td>Music</td>
                    <td>Sam Katz</td>
                </tr>
            </table>
        </footer>

        <script src="script.js"></script>
    </body>
</html>