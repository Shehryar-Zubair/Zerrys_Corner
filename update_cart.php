<?php
session_start();

// Database connection
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
    $row = mysqli_fetch_assoc($result);
    $c_id = $row['c_id'];

    // Check if the update button was pressed
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantity'] as $m_id => $quantity) {
            if ($quantity >= 1) {
                // Update the quantity in order_items
                $updateQuery = "UPDATE order_items SET quantity = $quantity WHERE m_id = '$m_id' AND o_id IN (SELECT o_id FROM orders WHERE c_id = '$c_id' AND status = 'pending')";
                mysqli_query($conn, $updateQuery);
            }
        }
    }

    // Check if the remove button was pressed
    if (isset($_POST['remove_item'])) {
        foreach ($_POST['remove_item'] as $m_id => $value) {
            // Remove the item from order_items
            $removeQuery = "DELETE FROM order_items WHERE m_id = '$m_id' AND o_id IN (SELECT o_id FROM orders WHERE c_id = '$c_id' AND status = 'pending')";
            mysqli_query($conn, $removeQuery);
        }
    }
}

// Redirect back to the cart page after the update or removal
header('Location: view_cart.php');
exit();

mysqli_close($conn);
?>
