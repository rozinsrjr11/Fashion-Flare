<?php

include 'connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}
;

if (isset($_POST['add_product'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $description = $_POST['description'];
   $brand = $_POST['brand'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `product` WHERE name = '$name'") or die('query failed');

   if (mysqli_num_rows($select_product_name) > 0) {
      $message[] = 'product name already added';
   } else {
      $add_product_query = mysqli_query($conn, "INSERT INTO `product`(name, price, image, description, brand) VALUES('$name', '$price', '$image','$description', '$brand')") or die('query failed');

      if ($add_product_query) {
         if ($image_size > 2000000000) {
            $message[] = 'image size is too large';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      } else {
         $message[] = 'product could not be added!';
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `product` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/' . $fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `product` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_product.php');
}

if (isset($_POST['update_product'])) {

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_description = $_POST['update_description'];

   mysqli_query($conn, "UPDATE `product` SET name = '$update_name', price = '$update_price', description = '$update_description' , brand = '$update_brand' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/' . $update_image;
   $update_old_image = $_POST['update_old_image'];

   if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
         $message[] = 'image file size is too large';
      } else {
         mysqli_query($conn, "UPDATE `product` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/' . $update_old_image);
      }
   }

   header('location:admin_product.php');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>

<body>

   <?php include 'admin_head.php'; ?>

   <!-- product CRUD section starts  -->

   <section class="add-product section-p1">

      <h1 class="title">shop product</h1>

      <form action="" method="post" enctype="multipart/form-data">
         <h3>add product</h3>
         <input type="text" name="name" class="box" placeholder="enter product name" required>
         <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
         <input type="text" name="brand" class="box" placeholder="enter brand name" required>
         <input type="text" name="description" id="desc" class="box" placeholder="Enter the description" required>
         <input type="submit" value="add product" name="add_product" class="btn">
      </form>

   </section>

   <!-- product CRUD section ends -->

   <!-- show product  -->

   <section class="show-product">

      <div class="box-container">

         <?php
         $select_product = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
         if (mysqli_num_rows($select_product) > 0) {
            while ($fetch_product = mysqli_fetch_assoc($select_product)) {
               ?>
               <div class="box">
                  <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                  <div class="name"><?php echo $fetch_product['name']; ?></div>
                  <div class="brand"><?php echo $fetch_product['brand']; ?></div>
                  <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                  <div class="description"><?php echo $fetch_product['description']; ?></div>
                  <div class="buttons">
                     <a href="admin_product.php?update=<?php echo $fetch_product['id']; ?>"
                        class="option2-btn jst1">update</a>
                     <a href="admin_product.php?delete=<?php echo $fetch_product['id']; ?>" class="delete2-btn jst2"
                        onclick="return confirm('delete this product?');">delete</a>
                  </div>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">no product added yet!</p>';
         }
         ?>
      </div>

   </section>

   <section class="edit-product-form">

      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `product` WHERE id = '$update_id'") or die('query failed');
         if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
               ?>
               <form action="" method="post" enctype="multipart/form-data">

                  <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">

                  <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">

                  <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">

                  <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required
                     placeholder="enter product name">

                  <input type="text" name="update_brand" value="<?php echo $fetch_update['brand']; ?>" class="box" required
                     placeholder="enter brand name">

                  <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box"
                     required placeholder="enter product price">

                  <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">

                  <input type="text" name="update_description" value="<?php echo $fetch_update['description']; ?>" class="box"
                     placeholder="enter product description">
                     <div class="buttons">
                     <form action="" method="post">
                        <input type="submit" value="update" name="update_product" class="option2-btn jst1">   
                        <input type="reset" value="cancel" id="close-update" class="option2-btn jst2">
                       
                     </form>
                  </div>

               </form>
               <?php
            }
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";
         
         </script>';
      }
      ?>

   </section>







   <!-- custom admin js file link  -->
   <script src="script.js"></script>

</body>

</html>