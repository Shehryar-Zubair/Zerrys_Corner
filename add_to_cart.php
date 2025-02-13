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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $m_id = $_POST['m_id'];
    $price = $_POST['price'];
    $quantity = 1; // Default quantity

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        // Get customer ID from email
        $query = "SELECT c_id FROM customers WHERE c_email = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $c_id = $row['c_id'];

        //Checks for Active Users "PENDEING"
        $checkOrderQuery = "SELECT o.o_id FROM orders o WHERE o.c_id = '$c_id' AND o.status = 'pending'";
        $orderResult = mysqli_query($conn, $checkOrderQuery);

        if (mysqli_num_rows($orderResult) > 0) {
            // Order exists, fetch the o_id
            $orderRow = mysqli_fetch_assoc($orderResult);
            $o_id = $orderRow['o_id'];
        } else {
            // No order exists, create a new one
            $orderDate = date(format: "Y-m-d H:i:s");
            $insertOrderQuery = "INSERT INTO orders (c_id, order_date, status) VALUES ('$c_id', '$orderDate', 'pending')";
            if (mysqli_query($conn, $insertOrderQuery)) {
                $o_id = mysqli_insert_id($conn); // Get the last inserted order ID
            } else {
                die("Error creating order: " . mysqli_error($conn));
            }
        }

        // Insert item into the order_items table
        $insertItemQuery = "INSERT INTO order_items (o_id, m_id, quantity, price) 
                            VALUES ('$o_id', '$m_id', '$quantity', '$price')";
        if (mysqli_query($conn, $insertItemQuery)) {
            echo "Item added to cart successfully!";
        } else {
            die("Error adding item to cart: " . mysqli_error($conn));
        }
    } else {
        // If user is not logged in, store cart items in session
        $session_id = session_id();
        $_SESSION['cart'][$m_id] = ['quantity' => $quantity, 'price' => $price];
    }
}

mysqli_close($conn);
header('Location: menu.php');
?>
