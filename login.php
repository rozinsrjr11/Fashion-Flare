<?php
include 'connect.php';

session_start();

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND pass = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {

        $row = mysqli_fetch_array($select);

        if ($row['user_type'] == 'admin') {

            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['fullname'];
            $_SESSION['admin_email'] = $row['email'];
            header('location:admin_page.php');

        } else if ($row['user_type'] == 'user') {

            
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullname'];
            $_SESSION['user_email'] = $row['email'];
            header('location:index.php');

        }
    } else {
        $error[] = 'email or password! is incorrect';
    }

}
;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login Page</title>
</head>

<body>

    <?php

    if (isset($error)) {
        foreach ($error as $error) {
            echo "<script>
                    
                        alert('Your $error');
                    
                    </script>";
        }
        ;
    }
    ;
    ?>


<?php  include 'components/user_header.php'; ?>




    <div class="dock">
        <div class="wrapping">
            <form action="login.php" method="POST">
                <h1>Login </h1>
                <div class="input_box">
                    <i class='bx bxs-user'></i>
                    <input type="text" name="email" placeholder="Email" autocomplete="off" required>
                </div>

                <div class="input_box">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" name="pass" placeholder="Password" autocomplete="off" required>
                </div>

                <button type="submit" name="submit" class="btn001">Login</button>
                <div class="register-link">
                    <para id="regi_link">Don't have an account? </para>
                    <a href="registration.php">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="script.js">
    function message() {
        alert("Try to remember your password!");
    }
</script>

</html>