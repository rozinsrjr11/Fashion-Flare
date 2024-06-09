<?php
session_start();

include 'connect.php';

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' ") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
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
    <title>Fashion Flare - Search Page</title>
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


    <section id="search_form">
        <form action="" method="post" id="search_btn">
            <input type="text" name="search" placeholder="Search for products" class="ipt">
            <input type="submit" name="submit" value="search" class="normal"></input>
        </form>
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container empty">
            <?php
            if (isset($_POST['submit'])) {
                $search_item = $_POST['search'];
                $select_products = mysqli_query($conn, "SELECT * FROM `product` WHERE name LIKE '%{$search_item}%'") or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetech_products = mysqli_fetch_assoc($select_products)) {
                        ?>
                        <!-- Product -->
                        <div class="pro">
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
                } else {
                    echo '
                    <p class="txt">no result found!</p>
                    ';
                }
            } else {
                echo '
                <p class="txt">Search Something</p>
                ';
            }
            ?>
        </div>
    </section>

</body>

</html>