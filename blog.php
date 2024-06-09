<?php
session_start();

include ('connect.php');

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>
    <title>Fashion Flare - Blog</title>
</head>

<body>
<?php include 'components/user_header.php';  ?>

    <section id="page-header"  class="blog-header">
       
        <h2>#readmore</h2>
        
    <p>Read all case studies about our products</p>
    </section>
<!-- blog-1 -->
    <section id="blog">
    <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM blog LIMIT 8") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetech_products = mysqli_fetch_assoc($select_products)) {
            ?>
        <div class="blog-box">
            <div class="blog-img">
                <img src="blog_img/<?php echo $fetech_products['image']; ?>" alt="">

            </div>
            <div class="blog-details">
                <h4><?php echo $fetech_products['name']; ?></h4>
                <p><?php  echo $fetech_products['content']; ?></p>
                </p>
                <a href="#">CONTINUE READING</a>
            </div>
            <h1><?php echo $fetech_products['number']; ?></h1>
        </div>
        <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
        </div>     
    </section>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="ri-arrow-right-line"></i></a>
    </section>



    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For NewsLetters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span> </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php include 'components/user_footer.php';  ?>
    <script src="script.js"></script>
</body>

</html>