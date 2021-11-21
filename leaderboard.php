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

            <button id="refresh" style="font-size: 1em; position: absolute; right: 0; margin: 0 1em 0 1em;">Refresh</button>

            <table id="leaderboard">

                <?php require 'templates/leaderboard-rows.php'; ?>
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
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="mute.js"></script>
        <script>

            $(document).ready(() => {

                $('#refresh').click(() => {

                    $('#leaderboard').load('templates/leaderboard-rows.php')
                })
            })
        </script>
    </body>
</html>