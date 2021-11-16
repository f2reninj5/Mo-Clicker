
<?php

    $errors = ['username' => '', 'password' => ''];
    $username = '';

    if (isset($_POST['register'])) {

        $username = $_POST['username'];

        if (empty($_POST['username'])) {

            $errors['username'] = 'A username is required.';

        } else {

            if (!preg_match('/^[a-zA-Z0-9]{3,16}$/', $_POST['username'])) {

                $errors['username'] = 'Username must be alphanumeric from 3 to 16 characters long.';
            }
        }

        if (empty($_POST['password'])) {

            $errors['password'] = 'A password is required.';

        } else {

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $_POST['password'])) {

                $errors['password'] = 'Password must be at least 8 characters long with one uppercase, lowercase letter and digit.';
            }
        }

        if (!array_filter($errors)) {

            setcookie('username', $username, time() + (60 * 60 * 24 * 30), '/');
            header('Location: login.php');
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
            <form method="POST" action="register.php">

                Register<br>
                <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" placeholder="Username"><br>
                <p><?php echo $errors['username']; ?></p>
                <input type="password" name="password" placeholder="Password"><br>
                <p><?php echo $errors['password']; ?></p>
                <input type="submit" name="register"><br>
            </form>
            
            <p>WARNING: This site is not secure. Do NOT reuse any of your personal passwords here.</p><br>

            <p>Already have an account?</p>
            <a href="?login=True">Login</a>
        </div>
    </body>
</html>