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

    $user = ['username' => $username, 'clicks' => $clicks]
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
        
        <a href="leaderboard.php" style="font-size: 2em; position: absolute; right: 0;">Leaderboard</a>

        <h>Mo Clicker</h>

        <div>

            <p id="clicks"> <?php echo $clicks; ?> </p><br>
            <script> let user = <?php echo json_encode($user); ?> </script>

            <input id="moustache" type="image" src="images/mo stache.svg" onclick="moustacheClick()">
        </div>

        <a href="https://movember.com/m/14690481?mc=1" style="font-size: 2em;">Click Here to Donate</a><br><br>

        <img src="images/mo code.png" style="width: 25%;">

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

        <script src="page-lifecycle/dist/lifecycle.es5.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="mute.js"></script>
        <script src="script.js"></script>
    </body>
</html>