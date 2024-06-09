<?php
session_start();

include ('connect.php');

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
;

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);
 
    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' && email = '$email' && subject = '$subject' && msg = '$msg'") or die('query failed');
 
    if(mysqli_num_rows($select_message) > 0){
       $message[] = 'message sent already!';
    }else{
       mysqli_query($conn, "INSERT INTO `message` (name, email, subject, msg) VALUES('$name', '$email', '$subject', '$msg')") or die('query failed');
       $message[] = 'message sent successfully!';
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
    <title>Fashion Flare - Contact </title>
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
<?php include 'components/user_header.php';  ?>

    <section id="page-header" class="about-header">

        <h2>#let's talk</h2>

        <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>


    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>
                GET IN TOUCH
            </span>
            <h2>
                Visit one of our agency locations or contact us today
            </h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="ri-map-pin-fill"></i>
                    <p>Chabahil, Kathmandu Nepal, Kathmandu, Nepal</p>
                </li>
                <li>
                    <i class="ri-mail-fill"></i>
                    <p>fashionflareshop@example.com</p>
                </li>
                <li>
                    <i class="ri-phone-line"></i>
                    <p>+011 2345 234 | (+977) 981234567</p>
                </li>
                <li>
                    <i class="ri-time-fill"></i>
                    <p>Sunday to Friday: 9:00 AM to 8:00 PM</p>
                </li>
            </div>
        </div>
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56516.27776829645!2d85.2849327557947!3d27.70903024220541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb198a307baabf%3A0xb5137c1bf18db1ea!2sKathmandu%2044600!5e0!3m2!1sen!2snp!4v1713784784779!5m2!1sen!2snp"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="" method="POST">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            <input type="text" placeholder="Your Name" name="name">
            <input type="text" placeholder="Email" name="email">
            <input type="text" placeholder="Subject" name="subject">
            <textarea  cols="30" rows="10" placeholder="Your Message" name="msg" ></textarea>
            <button class="normal" name="submit">Submit</button>
        </form>
        <div class="people">
            <div>
                <img src="people/1.png" alt="">
                <p>
                    <span>
                        Ravan Bahadur
                    </span>
                    Senior Marketing Manager <br> Phone: + 977 982 345 567 <br>
                    Email: ravenbahadur@gmail.com
                </p>
            </div>
            <div>
                <img src="people/2.png" alt="">
                <p>
                    <span>
                        Ram Singh
                    </span>
                    Senior Developer Manager <br> Phone: + 977 987 536 673 <br>
                    Email: ramsingh@gmail.com
                </p>
            </div>
            <div>
                <img src="people/3.png" alt="">
                <p>
                    <span>
                        Sita Chaudhary
                    </span>
                    Senior Designing Manager <br> Phone: + 977 985 637 293 <br>
                    Email: sitachaudhary@gmail.com
                </p>
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

    <?php include 'components/user_footer.php';  ?>
    <script src="script.js"></script>
</body>

</html>