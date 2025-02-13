<?php
session_start();

include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in redirect to the homepage
    header("Location: homepage.php");
    exit;
}

// Get the logged-in user's details
$email = $_SESSION['email'];
$query = "SELECT * FROM customers WHERE c_Email = '$email'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userName = $row['c_Name'];
} else {
    $userName = 'User'; 
}

mysqli_close($conn);
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
    <!-- Header Section -->
    <header style="text-align: center; padding: 0px; background-color: #f8f8f8;">
        <!-- Logo -->
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo"
            style="width: 300px; height: auto; margin: 0 auto ;position: display: block;">
        <!-- Title and Tagline-->

        <h1>Welcome, <?php echo htmlspecialchars($userName); ?>!
            What are you Craving today?
        </h1>
    </header>

    <!-- Navigation Bar -->
    <nav>
        <a href="homepage1.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="aboutus.html">About Us</a>
        <a href="#contact">Contact Us</a>
        <a href="view_cart.php">View Cart</a>
        <a href="update_customer.php">Edit Profile</a>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="content">
            <h2>Food that Speaks to Your Soul</h2>
            <a href="menu.php" class="button1">Order Now</a>
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
                <form method="post" action="add_to_cart1.php">
                    <input type="hidden" name="m_id" value="6"> <!-- Dynamic ID -->
                    <input type="hidden" name="price" value="5.99"> <!-- Dynamic Price -->
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
            <div class="menu-item">
                <img src="pictures/burrito.jpg" alt="Burrito">
                <h3>Wrap It Like Its Hot</h3>
                <p>Tortilla wrap filled with juicy meats, crisp veggies, and drizzled with creamy sour cream, smooth
                    guac, hot sauce.</p>
                <form method="post" action="add_to_cart1.php">
                    <input type="hidden" name="m_id" value="11"> <!-- Dynamic ID -->
                    <input type="hidden" name="price" value="6.99"> <!-- Dynamic Price -->
                    <button type="submit" name="add_to_cart">Add to Cart</button>
            </div>
            <div class="menu-item">
                <img src="pictures/brownie.jpg" alt="Brownie">
                <h3>Fudged Up</h3>
                <p>Fudgy brownies served hot with ice cream.</p>
                <form method="post" action="add_to_cart1.php">
                    <input type="hidden" name="m_id" value="13"> <!-- Dynamic ID -->
                    <input type="hidden" name="price" value="4.99"> <!-- Dynamic Price -->
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
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
        function openPopup() {
            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function submitOrder() {
            const orderType = document.getElementById('order-type').value;
            const area = document.getElementById('area').value;
            alert(`Order submitted! Type: ${orderType}, Area: ${area}`);
            closePopup();
        }

        function openLoginPopup() {
            document.getElementById('loginPopup').style.display = 'flex';
        }

        function closeLoginPopup() {
            document.getElementById('loginPopup').style.display = 'none';
        }

        function submitLogin() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            if (email && password) {
                alert(`Logged in successfully! Welcome, ${email}`);
                closeLoginPopup();
            } else {
                alert('Please enter both email and password.');
            }
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