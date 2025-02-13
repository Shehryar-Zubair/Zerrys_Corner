<?php
$servername = "localhost";
$user = "root";
$password = "";
$database = "Zerrys_corner";
$conn = mysqli_connect($servername, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $phone_no = trim($_POST['phone_no']);
    
    // Check if fields are empty
    if (empty($name) || empty($email) || empty($password) || empty($address) || empty($phone_no)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } elseif (!preg_match('/^\d{10,15}$/', $phone_no)) {
        $error = "Invalid Phone Number";
    } else {
        // Check if the email already exists
        $email = mysqli_real_escape_string($conn, $email);
        $query = "SELECT * FROM customers WHERE c_Email = '$email'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $error = "Email already registered!";
        } else {
            // Save password 
            $query = "INSERT INTO customers (c_Name, c_Email, c_Password, Address, phone_no) 
                      VALUES ('$name', '$email', '$password', '$address', '$phone_no')";
            if (mysqli_query($conn, $query)) {
               
                header("Location: homepage.php");
                exit;
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=-50%, initial-scale=0.5">
    <title>Signup - Zerry's Corner</title>
    <link href="signup.css" rel="stylesheet">
</head>
<header style="text-align: center; padding: 0px; background-color: #f8f8f8;">
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo" style="width: 500px; height: 250px;"
</header>   
<body>
    <!-- Signup Form -->
    <section class="signup-section">
        <h2>Sign Up</h2>
        <?php if ($error) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required>
            
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" placeholder="Enter your address" required>
            
            <label for="phone_no">Phone Number:</label>
            <input type="text" name="phone_no" id="phone_no" placeholder="Enter your phone number" required>
            
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="homepage1.php">Login here</a></p>
    </section>
</body>
<footer>
        <p>&copy; 2024 Zerry's Corner. All rights reserved.</p>
        <p>Follow us on <a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Twitter</a>.</p>
        <p><a href="homepage1.php">Back to Home</a></p>
    </footer>
</html>
