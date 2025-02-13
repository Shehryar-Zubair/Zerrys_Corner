<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Zerrys_corner";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>