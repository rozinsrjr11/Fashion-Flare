<?php
session_start();

include 'connect.php';
$user_admin = $_SESSION['admin_id'];

if (!isset($user_admin)) {
    header('location:login.php');

}
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_contact.php');
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css">
       <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Admin Contact</title>
</head>
<body>
    <?php include 'admin_head.php' ?>

    <section class="messages">

<h1 class="title"> messages </h1>

<div class="box-container">
<?php
   $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
   if(mysqli_num_rows($select_message) > 0){
      while($fetch_message = mysqli_fetch_assoc($select_message)){
   
?>
<div class="box">
   <p> user id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
   <p> name : <span><?php echo $fetch_message['name']; ?></span> </p>
   <p> email : <span><?php echo $fetch_message['email']; ?></span> </p>
   <p> Subject : <span><?php echo $fetch_message['subject']; ?></span> </p>
   <p> message : <span><?php echo $fetch_message['msg']; ?></span> </p>
   <div class="buttons">
      <a href="admin_contact.php?delete=<?php echo $fetch_message['user_id']; ?>" onclick="return confirm('delete this message?');" class="delete2-btn jst2">delete message</a>
   </div>
</div>
<?php
   };
}else{
   echo '<p class="empty">you have no messages!</p>';
}
?>
</div>

</section>




</body>
</html>