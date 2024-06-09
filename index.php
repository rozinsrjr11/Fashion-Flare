<?php


include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');

}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' ") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 
 }
 



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Fashion Flare - Home</title>
</head>

<body>
<?php  

if (isset($message)) {
        foreach ($message as $message) {
            echo "<script>
                    
                        alert('Your $message');
                    
                    </script>";
        }
        ;
    }
    ; ?>

    <?php include 'components/user_header.php'; ?>



    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off!</p>
        <button>Shop Now</button>
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

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <?php 
            $select_products = mysqli_query($conn, "SELECT * FROM product LIMIT 8") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetech_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                    <!-- Product -->
                    <div class="pro" >
                        <form action="" method="post">
                            <img src="uploaded_img/<?php echo $fetech_products['image']; ?>" alt="">
                            <div class="des">
                                <span><?php echo $fetech_products['brand']; ?></span>
                                <h5><?php echo $fetech_products['name']; ?></h5>

                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4>$<?php echo $fetech_products['price']; ?></h4>
                                <input type="hidden" name="product_name" value="<?php echo $fetech_products['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetech_products['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetech_products['image']; ?>">
                                <input type="hidden" min="1" name="product_quantity" value="1" class="qty">
                            </div>
                                <input type="submit" name="add_to_cart" class="normal" value="Add to Cart">
                        </form>
                    </div>
                    <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Repair Services </h4>
        <h2>Up to <span>70% off </span> - All t0shirts & Accessories</h2>
        <button class="normal">Explore More</button>
    </section>



    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Crazy Deals</h4>
            <h2>Buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at Fashion Flare </span>
            <button class="white">Learn More</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Spring/Summer</h4>
            <h2>Upcoming Season</h2>
            <span>The best classic dress is on sale at Fashion Flare </span>
            <button class="white">Collection</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection - 50% OFF</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring / Summer 2024</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>T-SHIRTS</h2>
            <h3>New Trendy Prints</h3>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For NewsLetters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span> </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal"> <a href="registration.php">Sign Up</a></button>
        </div>
    </section>

    <?php include 'components/user_footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>