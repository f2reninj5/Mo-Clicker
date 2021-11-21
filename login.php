
<?php

    require 'templates/mysql.php';

    $errors = ['username' => '', 'password' => ''];
    $username = $password = '';

    if(isset($_COOKIE['username'])) {

        $username = $_COOKIE['username'];
    }

    if (isset($_POST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($_POST['username'])) {

            $errors['username'] = 'A username is required.';
        }

        if (empty($_POST['password'])) {

            $errors['password'] = 'A password is required.';
        }

        $conn = connectDatabase();
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        if (!$result) {

            echo 'Database error: ' . mysqli_error($conn);
        }

        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);
        mysqli_close($conn);

        if (empty($rows)) {

            $errors['username'] = 'Account not found.';

        } else {

            if ($rows[0]['password'] != $password) {

                $errors['password'] = 'Incorrect password.';
            }
        }

        if (!array_filter($errors)) {

            $session = uniqid('', true);

            $conn = connectDatabase();
            $result = mysqli_query($conn, "UPDATE users SET session = '$session' WHERE username = '$username'");

            if (!$result) {

                echo 'Database error: ' . mysqli_error($conn);
            }

            mysqli_close($conn);

            setcookie('session', $session, time() + (60 * 60 * 24 * 30), '/');
            header('Location: /');
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

        <h>Mo Clicker</h>

        <div>
            <form method="POST" action="login.php">

                Login<br>
                <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>" placeholder="Username"><br>
                <p><?php echo $errors['username']; ?></p>
                <input type="password" name="password" placeholder="Password"><br>
                <p><?php echo $errors['password']; ?></p>
                <input type="submit" name="login"><br>
            </form>
            
            <p>Not got an account?</p>
            <a href="register.php">Register</a>
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
    </body>
</html>