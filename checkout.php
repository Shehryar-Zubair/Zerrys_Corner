<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "Zerrys_corner";
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Get customer ID from email
    $query = "SELECT c_id FROM customers WHERE c_email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $c_id = $row['c_id'];

        // Select cart items from order_items where status is 'pending'
        $cartQuery = "
            SELECT oi.m_id, oi.quantity, oi.price, m.item_name, oi.o_id 
            FROM order_items oi
            JOIN orders o ON oi.o_id = o.o_id
            JOIN menu m ON oi.m_id = m.m_id
            WHERE o.c_id = '$c_id' AND o.status = 'pending'";

        $cartResult = mysqli_query($conn, $cartQuery);
    } else {
        echo "<p>Error: Could not retrieve customer ID.</p>";
        exit();
    }
} else {
    echo "<p>Please log in to checkout.</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Zerry's Corner</title>
    <link rel="stylesheet" href="checkout.css"> 
</head>
<body>

<header style="text-align: center; padding: 0px; background-color: #f8f8f8;">
        <!-- Logo -->
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo"
            style="width: 300px; height: auto; margin: 0 auto ;position: display: block;">
       
        <nav>
            <a href="homepage1.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="checkout-container">
            <?php
            if (isset($cartResult) && mysqli_num_rows($cartResult) > 0) {
                // If cart items exist show 
                $total_price = 0;

                echo "<h2>Checkout</h2>";
                echo "<ul class='cart-items'>";

                while ($row = mysqli_fetch_assoc($cartResult)) {
                    echo "<li class='cart-item'>";
                    echo "<strong>" . $row['item_name'] . "</strong><br>";
                    echo "Quantity: " . $row['quantity'] . "<br>";
                    echo "Price: $" . number_format($row['price'], 2) . "<br>";
                    $total_price += $row['price'] * $row['quantity'];
                    echo "</li>";
                }

                echo "</ul>";
                echo "<p class='total-price'><strong>Total Price: $" . number_format($total_price, 2) . "</strong></p>";

                // Update order status to 'completed'
                $updateOrderStatusQuery = "UPDATE orders SET status = 'completed', total_price = '$total_price' WHERE c_id = '$c_id' AND status = 'pending'";
                mysqli_query($conn, $updateOrderStatusQuery);

                // Confirmation message
                echo "<p class='confirmation-message'>Thank you for your order! Your order has been confirmed.</p>";
                echo "<a href='thank_you.php' class='button'>Click here to view your Receipt</a>";
            } else {
                // If no items are in the cart, 
                echo "<div class='empty-cart-message'>
                        <h2>Your cart is empty</h2>
                        <p>Please add items to your cart before proceeding to checkout.</p>
                      </div>";
            }
            ?>
        </div>
    </main>

    <footer id="contact">
        <h3>Contact Us</h3>
        <p>Have questions or feedback? We'd love to hear from you!</p>
        <p>Email: <a href="mailto:contact@zerryscorner.com" style="color: #ff7e5f;">contact@zerryscorner.com</a></p>
        <p>Phone: <a href="tel:1234567890" style="color: #ff7e5f;">(123) 456-7890</a></p>
        <p>Address: 123 Flavor Street, Foodie City, FC 45678</p>
        <p>&copy; 2024 Zerry's Corner. All rights reserved.</p>
        <p>Made By </p>
        <p>22k-4736 Shehryar Zubair</p>
        <p>22k-4781 Zehra Mirza</p>
        <p>Follow us on <a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Twitter</a>.</p>
    </footer>

    <?php
    mysqli_close($conn);
    ?>

</body>
</html>
