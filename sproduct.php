<?php


include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');

}

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE image = `$product_image` && name = `$product_name` && price = `$product_price` && quantity = `$product_quantity` ") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO cart(image,name, price, quantity ) VALUES('$product_image',  '$product_name', '$product_price', '$product_quantity')") or die('query failed');
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
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>
    <title>Fashion Flare - Shop Item</title>
</head>

<body>
<?php include 'components/user_header.php'; ?>


    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="product/f1.jpg" width="100%" id="MainImg" alt="">
            <div class="small-image-group">
                <div class="small-image-col">
                    <img src="product/f1.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-image-col">
                    <img src="product/f2.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-image-col">
                    <img src="product/f3.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-image-col">
                    <img src="product/f4.jpg" width="100%" class="small-img" alt="">
                </div>
            </div>
        </div>
        <div class="single-pro-details">
            <h6>Home / T-Shirt</h6>
            <h4>Men's Fashion T Shirt</h4>
            <h2>$140.00</h2>
            <select>
                <option>Select Size</option>
                <option>XL</option>
                <option>XXL</option>
                <option>Small</option>
                <option>Large</option>
            </select>
            <input type="number" value="1">
            <button class="normal">Add To Cart</button>
            <h4>Product Details</h4>
            <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quaerat alias qui, reiciendis earum aliquid saepe ipsa obcaecati porro fugit officiis, delectus enim adipisci molestias, ullam et eum? Pariatur, unde dolorem quos labore soluta, quis impedit incidunt nobis, qui consequatur voluptatibus!</span>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <!-- Product-1 -->
            <div class="pro">
                <img src="product/n1.jpg" alt="">
                <div class="des">
                    <span>addidas</span>
                    <h5>Cartoon Astronaut T-shirt</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$40</h4>
                </div>
                <a href="#"><i class="ri-shopping-cart-fill cart"></i></a>
            </div>
            <!-- Product-2 -->
            <div class="pro">
                <img src="product/n2.jpg" alt="">
                <div class="des">
                    <span>addidas</span>
                    <h5>Cartoon Astronaut T-shirt</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$40</h4>
                </div>
                <a href="#"><i class="ri-shopping-cart-fill cart"></i></a>
            </div>
            <!-- Product-3 -->
            <div class="pro">
                <img src="product/n3.jpg" alt="">
                <div class="des">
                    <span>addidas</span>
                    <h5>Cartoon Astronaut T-shirt</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$40</h4>
                </div>
                <a href="#"><i class="ri-shopping-cart-fill cart"></i></a>
            </div>
            <!-- Product-4 -->
            <div class="pro">
                <img src="product/n4.jpg" alt="">
                <div class="des">
                    <span>addidas</span>
                    <h5>Cartoon Astronaut T-shirt</h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$40</h4>
                </div>
                <a href="#"><i class="ri-shopping-cart-fill cart"></i></a>
            </div>
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

    <footer class="section-p1">
        <div class="col">
            <span class="logo">Fashion Flare</span>
            <h4>Contact</h4>
            <p><strong>Address: </strong>Chabahil,Street 21,Kathmandu Nepal</p>
            <p><strong>Phone: </strong>+977 98236276313 / (+01) 01 2345 6789
            </p>
            <p><strong>Hours: </strong>10:00 - 18:00, Sun - Fri</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fab da-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fab fa-instagram"></i>
                    <i class="fab fab fab fa-pinterest-p"></i>
                    <i class="fab fab fa-youtube"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>
        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="pay/app.jpg" alt="">
                <img src="pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateaways</p>
            <img src="pay/pay.png" alt="">
        </div>

        <div class="copyright">
            <p>@2081, Fashion Flare </p>
        </div>
    </footer>

    
    <script src="script.js"></script>
</body>

</html>