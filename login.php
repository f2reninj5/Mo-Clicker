
<?php

    $errors = ['username' => '', 'password' => ''];
    $username = $password = '';

    if(isset($_COOKIE['username'])) {

        $username = $_COOKIE['username'];
    }

    if (isset($_POST['login'])) {

        $username = $_POST['username'];

        if (empty($_POST['username'])) {

            $errors['username'] = 'A username is required.';
        }

        if (empty($_POST['password'])) {

            $errors['password'] = 'A password is required.';
        }

        if (!array_filter($errors)) {

        }
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

        <div>
            <form>

                Login<br>
                <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" placeholder="Username"><br>
                <p><?php echo $errors['username']; ?></p>
                <input type="password" name="password" placeholder="Password"><br>
                <p><?php echo $errors['password']; ?></p>
                <input type="submit" name="login"><br>
            </form>
        </div>
    </body>
</html>