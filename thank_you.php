<?php
session_start();

include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: homepage1.php");
    exit();
}

$email = $_SESSION['email'];

// Get the customer ID
$query = "SELECT c_id, c_name,phone_no, address FROM customers WHERE c_email = '$email'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Error: No customer found with the email $email.");
}

$row = mysqli_fetch_assoc($result);
$c_id = $row['c_id'];
$c_name = $row['c_name'];
$c_address = $row['address'];
$phone_no = $row['phone_no'];

// Get the active order for the user
$orderQuery = "SELECT o.o_id, o.order_date, o.total_price 
               FROM orders o WHERE o.c_id = '$c_id' AND o.status = 'completed'";
$orderResult = mysqli_query($conn, $orderQuery);

if (!$orderResult || mysqli_num_rows($orderResult) == 0) {
    die("No recent orders found for customer ID $c_id.");
}

$order = mysqli_fetch_assoc($orderResult);
$o_id = $order['o_id'];
$order_date = $order['order_date'];
$total_price = $order['total_price'];

// Get the order items
$orderItemsQuery = "SELECT oi.m_id, m.item_name, oi.quantity, oi.price 
    FROM order_items oi 
    JOIN menu m ON oi.m_id = m.m_id 
    WHERE oi.o_id = (SELECT o.o_id 
                      FROM orders o 
                      WHERE o.c_id = '$c_id' AND o.status = 'completed' 
                      ORDER BY o.order_date DESC LIMIT 1)";
$orderItemsResult = mysqli_query($conn, $orderItemsQuery);

if (!$orderItemsResult || mysqli_num_rows($orderItemsResult) == 0) {
    die("No items found for order ID $o_id.");
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Thank You</title>
    <link href="thank_you.css" rel="stylesheet"> 
</head>
<body>
    <!-- Header -->
    <header style="text-align: center; padding: 0px; background-color: #f8f8f8;">
        <!-- Logo -->
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo"
            style="width: 400px; height: auto; margin: 0 auto ;position: display: block;">
       <nav>
            <a href="homepage1.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <div class="receipt-container">
            <h2>Thank You for Your Order!</h2>
            <p>Your order has been received and is being processed.</p>

            <!-- Restaurant and Customer Info -->
            <div class="restaurant-info">
                <p><strong>Zerry's Corner</strong></p>
                <p><strong>Name: </strong><?php echo $c_name; ?></p>
                <p><strong>Address:</strong> <?php echo $c_address; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $phone_no; ?></p>
            </div>

            <div class="order-details">
                <h3>Order Details</h3>
                <p><strong>Order Date:</strong> <?php echo $order_date; ?></p>
                <p><strong>Order Number:</strong> <?php echo $o_id; ?></p>
                <h4>Items in Your Order:</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($item = mysqli_fetch_assoc($orderItemsResult)) {
                            $item_name = $item['item_name'];
                            $quantity = $item['quantity'];
                            $price = $item['price'];
                            $total_item_price = $quantity * $price;

                            echo "<tr>
                                    <td>$item_name</td>
                                    <td>$quantity</td>
                                    <td>$$price</td>
                                    <td>$$total_item_price</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <p><strong>Total Price:</strong> $<?php echo number_format($total_price, 2); ?></p>

            </div>

            <p>Glad to have your order, Visit again!</p>
        </div>
    </main>

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
</body>
</html>
