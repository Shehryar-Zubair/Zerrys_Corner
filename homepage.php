<?php
session_start();
include('db_connection.php');

// Initialize error message
$error = "";
//cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; 
}

// Handle login submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT * FROM customers WHERE c_Email ='$email' AND c_Password='$password'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['email'] = $email;
            header("Location: homepage1.php");
            exit;
        } else {
            $error = "Invalid credentials.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zerry's Corner</title>
    <link href="homepage.css" rel="stylesheet"> 
</head>

<body>
    <!-- Login Popup -->
    <div class="popup-overlay" id="loginPopup" style="display: none;">
        <div class="popup-content">
            <h2>Login/Signup</h2>
            <?php if (!empty($error)) {
                echo "<p class='error' style='color: red;'>$error</p>";
            } ?>
            <form method="post" action="">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required />
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required />
                <button type="submit">Login</button>
            </form>
            <button class="close-btn" onclick="closeLoginPopup()">Close</button>
            <p class="signup-prompt">Don't have an account? </pc><a class="signup-form" href="Signup.php">Signup</a>
        </div>
    </div>
    <!-- Order Popup -->
    <div class="popup-overlay" id="orderPopup" style="display: none;">
        <div class="popup-content">
            <h2>Place Your Order</h2>
            <form method="post" action="">
                <!-- Order Type Dropdown -->
                <label for="orderType">Order Type:</label>
                <select name="order_type" id="orderType" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="pickup">Pick-up</option>
                    <option value="delivery">Delivery</option>
                </select>
                <!-- Branch Selection Dropdown -->
                <label for="branch">Select Branch:</label>
                <select name="branch" id="branch" required>
                    <option value="" disabled selected>Select a branch</option>
                    <option value="branch1">Zerry's Corner (PAK)</option>
                    <option value="branch2">Zerry's Corner (USA)</option>
                </select>

                <!-- Submit Button -->
                <button type="submit">Submit</button>
                <button class="close-btn" onclick="closePopup()">Close</button>
            </form>
        </div>
    </div>

    <!-- Header Section -->
    <header style="text-align: center; padding: 0px; background-color: #f8f8f8;">
        <!-- Logo -->
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo"
            style="width: 300px; height: auto; margin: 0 auto ;position: display: block;">
        <!-- Title and Tagline 
        <h1>Welcome to Zerry's Corner</h1>
        <p>Where Every Bite Tells a Story</p>-->
        </div>
    </header>

    <!-- Navigation Bar -->
    <nav>
        <a href="homepage1.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About Us</a>
        <a href="#contact">Contact Us</a>
        <a href="view_cart.php">View Cart</a>
        <a onclick="openLoginPopup()">Log In/SignUp</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="content">
            <h2>Food that Speaks to Your Soul</h2>
            <button onclick="openPopup()">Order Now!</button>
        </div>
    </section>

    <!-- Featured Section -->
    <section class="featured" id="menu">
        <h2>Our Featured Menu</h2>
        <div class="menu-items">
            <div class="menu-item">
                <img src="pictures/cheeze.jpg" alt="Burger">
                <h3>Cheesy Delight Burger</h3>
                <p>Succulent grilled patty with a generous layer of melted cheese, served fresh off the grill.</p>
                <button onclick="openLoginPopup()">Order Now</button>
            </div>
            <div class="menu-item">
                <img src="pictures/burrito.jpg" alt="Burrito">
                <h3>Wrap It Like Its Hot</h3>
                <p>Tortilla wrap filled with juicy meats, crisp veggies, and drizzled with creamy sour cream, smooth
                    guac, hot sauce.</p>
                <button onclick="openLoginPopup()">Order Now</button>
            </div>
            <div class="menu-item">
                <img src="pictures/brownie.jpg" alt="Salad">
                <h3>Fudged Up</h3>
                <p>Fudgy brownies served Hot with ice cream.</p>
                <button onclick="openLoginPopup()">Order Now</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <h3>Contact Us</h3>
        <p>Have questions or feedback? <a href="feedback.php"
                style="color: #ff7e5f; text-decoration: none; font-weight: bold;">Click here</a> to leave feedback.</p>
        <p>Email: <a href="mailto:contact@zerryscorner.com" style="color: #ff7e5f;">contact@zerryscorner.com</a></p>
        <p>Phone: <a href="tel:1234567890" style="color: #ff7e5f;">(123) 456-7890</a></p>
        <p>Address: 123 Flavor Street, Foodie City, FC 45678</p>
        <p>&copy; 2024 Zerry's Corner. All rights reserved.</p>
        <p>Made By </p>
        <p>22k-4736 Shehryar Zubair</p>
        <p>22k-4781 Zehra Mirza</p>
        <p>Follow us on <a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Twitter</a>.</p>
    </footer>

    <script>
        // Function to get URL parameters
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        // Show the login popup if 'popup=login' is in the URL
        document.addEventListener('DOMContentLoaded', () => {
            const popupParam = getQueryParam('popup');
            if (popupParam === 'login') {
                openLoginPopup(); // Trigger the login popup
            }
        }
        );
        function openPopup() {
            document.getElementById('orderPopup').style.display = 'flex'; // Corrected ID
        }

        function closePopup() {
            document.getElementById('orderPopup').style.display = 'none'; // Corrected ID
        }

        function openLoginPopup() {
            document.getElementById('loginPopup').style.display = 'flex';
        }

        function closeLoginPopup() {
            document.getElementById('loginPopup').style.display = 'none';
        }
        document.addEventListener("DOMContentLoaded", function () {
    // Navbar Toggle for Mobile View
    const menuToggle = document.getElementById("menu-toggle");
    const navLinks = document.getElementById("nav-links");

    menuToggle.addEventListener("click", function () {
        navLinks.classList.toggle("active");
    });

    // Smooth Scrolling
    document.querySelectorAll("nav a").forEach(anchor => {
        anchor.addEventListener("click", function (event) {
            event.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            target.scrollIntoView({ behavior: "smooth" });
        });
    });

    // Sticky Navbar
    window.addEventListener("scroll", function () {
        const navbar = document.querySelector("nav");
        navbar.classList.toggle("sticky", window.scrollY > 50);
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navMenu = document.querySelector("nav ul");

    menuToggle.addEventListener("click", function () {
        navMenu.classList.toggle("active");
    });
});

    </script>
</body>
</html>