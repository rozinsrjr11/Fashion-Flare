<?php

include 'connect.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['update_cart'])){
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
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
    <title>Fashion Flare - Cart </title>
</head>

<body>
    <?php include 'components/user_header.php'; ?>
    <section id="page-header" class="about-header">

        <h2>#cartpage</h2>

        <p>This is a Cart Page</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
      ?>
                    <tbody>
                        <!-- First Product -->
                        <tr>

                            <td><a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="ri-delete-bin-6-line"
                                    onclick="return confirm('delete this from cart?');"></a></td>

                            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt=""></td>

                            <td><?php echo $fetch_cart['name']; ?></td>
                            <td>$<?php echo $fetch_cart['price']; ?>/-</td>

                            <td ><form action="" method="post" id="cart-btn">
                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                    <input type="number" id="quantity" name="cart_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input type="submit" name="update_cart" value="update" class="normal">
                            </form>

                            </td>


                            <td>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</td>
                        </tr>
                        <?php
                        $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty">your cart is empty</p>';
            }
            ?>
            </tbody>
        </table>
    </section>



    <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter your Coupon">
                <button class="normal">
                    Apply
                </button>
            </div>
        </div>


        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotals</td>
                    <td>$<?php echo $grand_total; ?>/-</span></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <td><strong>Total</strong></td>
                <td><strong>$<?php echo $grand_total; ?>/-</span></strong></td>
            </table>
            <button class="normal">Proceed to checkout</button>
        </div>
    </section>
    <?php include 'components/user_footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>