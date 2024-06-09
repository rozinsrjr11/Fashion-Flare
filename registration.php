<?php

include 'connect.php';
session_start();


if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pass = md5($_POST['pass']);
    $cpass = md5($_POST['cpass']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && pass = '$pass' ";



    $result = mysqli_query($conn, $select);


    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User Already Exist';

    } else {
        if ($pass != $cpass) {
            $error[] = 'Password not matched';
        } else {
            $insert = "INSERT INTO user_form(fullname,username,email,phone,pass,cpass,gender,user_type)  VALUES ('$name','$username','$email','$phone','$pass','$cpass','$gender','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login.php');
        }

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
    <title>Registration</title>
    <style>
        #login-link {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
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
    <div class="outer-cont">
        <div class="cont">
            <form action="" method="post">
                <div class="title">Registration Form
                    <span>
                        <button type="reset"> X </button>
                    </span>
                </div>
                
                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Full Name
                            <input type="text" name="name" placeholder="Enter your fullname" required>
                        </span>
                    </div>

                    <div class="input-box">
                        <span class="details">Username
                            <input type="text" name="username" placeholder="Enter your username" required>
                        </span>
                    </div>

                    <div class="input-box">
                        <span class="details">Email
                            <input type="email" name="email" placeholder="Enter your email" autocomplete="off" required>
                        </span>
                    </div>

                    <div class="input-box">
                        <span class="details">Phone Number
                            <input type="text" name="phone" placeholder="Enter your phone number" autocomplete="off" required>
                        </span>
                    </div>

                    <div class="input-box">
                        <span class="details">Password
                            <input type="text" name="pass" placeholder="Enter the Password" autocomplete="off" required>
                        </span>
                    </div>

                    <div class="input-box">
                        <span class="details">Confirm Password
                            <input type="text" name="cpass" placeholder="Confirm your Password" autocomplete="off" required>
                        </span>
                    </div>
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1" value="male">
                    <input type="radio" name="gender" id="dot-2" value="female">
                    <input type="radio" name="gender" id="dot-3" value="perfer not to say">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer Not to say</span>
                        </label>
                    </div>
                </div>
                <select name="user_type" class="opt">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="btn_reg">
                    <input type="submit" name="submit" value="Register Now">
                </div>
            </form>
            <div id="login-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</body>

</html>