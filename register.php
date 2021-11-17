
<?php

    require 'templates/mysql.php';

    $errors = ['username' => '', 'password' => ''];
    $username = $password = '';

    if (isset($_POST['register'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($_POST['username'])) {

            $errors['username'] = 'A username is required.';

        } elseif (!preg_match('/^[a-zA-Z0-9]{3,16}$/', $_POST['username'])) {

            $errors['username'] = 'Username must be alphanumeric from 3 to 16 characters long.';

        } else {

            $conn = connectDatabase();
            $result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM users WHERE username = '$username'");

            if (!$result) {

                echo 'Database error: ' . mysqli_error($conn);
            }

            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if ($rows[0]['count']) {

                $errors['username'] = 'This username is taken.';
            }
        }

        if (empty($_POST['password'])) {

            $errors['password'] = 'A password is required.';

        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $_POST['password'])) {

            $errors['password'] = 'Password must be at least 8 characters long with one uppercase, lowercase letter and digit.';
        }

        if (!array_filter($errors)) {

            $conn = connectDatabase();
            $result = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
            
            if (!$result) {

                echo 'Database error: ' . mysqli_error($conn);
            }

            mysqli_close($conn);

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
            <a href="login.php">Login</a>
        </div>
    </body>
</html>