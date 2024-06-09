<?php
session_start();

include 'connect.php';
$user_admin = $_SESSION['admin_id'];

if (!isset($user_admin)) {
    header('location:login.php');

}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `user_form` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_user.php');
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="admin_style.css">
    <title>User Details</title>
</head>
<body>
    <?php include 'admin_head.php' ?>

    <section class="users">

    <h1 class="title"> user accounts </h1>

    <div class="box-container">
        <?php
            $select_users = mysqli_query($conn, "SELECT * FROM user_form") or die('query failed');
            while($fetch_users = mysqli_fetch_assoc($select_users)){
        ?>
        <div class="box">
            <p> user id : <span><?php echo $fetch_users['id']; ?></span> </p>
            <p> username : <span><?php echo $fetch_users['fullname']; ?></span> </p>
            <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
            <p> user type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
            <div class="buttons">
                <a href="admin_user.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete2-btn jst2">delete user</a>
            </div>
        </div>
        <?php
            };
        ?>
    </div>

    </section>









    <!-- custom admin js file link  -->
    <script src="script.js"></script>

    </body>
    </html>
