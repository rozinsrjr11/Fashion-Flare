<?php
$host = "localhost";
$username ="root";
$password = "";
$dbname = "user_data";
$conn = new mysqli($host,$username,$password,$dbname);
if($conn->connect_error){
    echo "Failed to connect to db".$conn->connect_error;
}
?>