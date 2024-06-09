<?php


include 'connect.php';
$user_admin = $_SESSION['admin_id'];

if (!isset($user_admin)) {
    header('location:login.php');

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <title>Header</title>
</head>

<body>
    <section id="header">
        <a href="admin_page.php">
            <span id="logo">Admin Panel </span>
        </a>

        <div>
            <ul id="navbar">
                <li><a href="admin_page.php">Home</a></li>
                <li><a href="admin_product.php">Product</a></li>
                <li><a href="admin_order.php">Order</a></li>
                <li><a href="admin_user.php">User</a></li>
                <li><a href="admin_contact.php">Messages</a></li>
                <li><a href="admin_blog.php">Blog</a></li>
                <li class="login lgn1" id="user-btn"><a><i class="ri-user-line"></i></a></li>
                <div class="account-box">
                    <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                    <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                    <a href="admin_logout.php" class="normal">logout</a>
                    <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
                </div>
                <a href="#" id="close"><i class="ri-expand-right-line"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <li class="login lgn2" id="mbl-user" ><i class="ri-user-line"></i></></li>
            <div class="account-box1">
                    <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                    <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                    
                        <a href="admin_logout.php" class="normal">logout</a>
                
                    <div>new <a href="login.php">login</a> | <a href="../registration.php">register</a></div>
                </div>
            <i id="bar" class="ri-menu-line"></i>
        </div>

    </section>
    <script src="script.js"></script>
</body>

</html>