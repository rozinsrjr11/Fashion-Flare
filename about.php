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
    <title>Fashion Flare - About</title>
</head>

<body>
<?php include 'components/user_header.php';  ?>


    <section id="page-header"  class="about-header">
       
        <h2>#know us</h2>
        
    <p>Read all case studies about our products</p>
    </section>

 
    <section id="about-head" class="section-p1">
        <img src="about/a6.jpg" alt="">
        <div>
            <h2>Who We Are?</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quam animi in, quasi corrupti recusandae beatae facilis veritatis omnis illo laudantium, dolorum atque vel sit? Sit quibusdam unde pariatur saepe aliquid libero ducimus ex autem eaque tempore eveniet quisquam, expedita dolorem consectetur sequi quaerat quasi cumque amet! Nostrum quam dignissimos accusamus ad nihil, placeat ipsam, possimus, ipsum eum totam libero veritatis consequuntur voluptas! Magnam, veniam magni iusto aliquam deserunt nam officia.</p>
            <abbr title="">Create stunning images with as much or as little control as you like thanks to a choice of Basic and Creative modes</abbr>
            <br><br>
            <marquee style="background-color: #ccc;" loop="-1" scrollamount="5" width="100%">Create stunning images with as much or as little control as you like thanks to a choice of Basic and Creative modes</marquee>
        </div>
    </section>


    <section id="about-app" class="section-p1">
        <h1>Download Our <a href="#">App</a></h1>
        <div class="video">
            <video autoplay muted loop src="about/1.mp4"></video>
        </div>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="feature/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="feature/f2.png" alt="">
            <h6>Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="feature/f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="feature/f4.png" alt="">
            <h6>Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="feature/f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="feature/f6.png" alt="">
            <h6>F24/7 Support</h6>
        </div>

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