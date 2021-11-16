<?php

    require 'templates/mysql.php';

    // print_r(queryDatabase('SELECT * FROM users;'));
?>

<script>let rows = <?php echo json_encode($rows); ?>;</script>

<html>
    
    <head>
		
		<link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width">
		<meta charset="utf-8">

		<title>Mo Clicker</title>

        <link rel="icon" href="images/mo stache.svg">
	</head>

    <body>

        <h>Mo Clicker</h>

        <div>

            <input id="moustache" type="image" src="images/mo stache.svg" onclick="moustacheClick()">
        </div>

        <a href="https://movember.com/m/14690481?mc=1" style="font-size: 2em;">Click Here to Donate</a><br><br>

        <img src="images/mo code.png">

        <script src="script.js"></script>
    </body>
</html>