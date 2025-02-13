<?php
session_start();
include('db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <link rel="stylesheet" type="text/css" href="view_cart.css">
</head>
<body>
    <!-- Header -->
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

    <!-- Main Content -->
    <main>
        <?php
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];

            // Get customer ID from email
            $query = "SELECT c_id FROM customers WHERE c_email = '$email'";
            $result = mysqli_query($conn, $query);
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

            if (mysqli_num_rows($cartResult) > 0) {
                echo "<div class='receipt-container'>";
                echo "<h1>My Cart</h1>";
                echo "<form action='update_cart.php' method='POST'>";
                echo "<table>";
                echo "<thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                      </thead>";
                echo "<tbody>";

                $total_price = 0;

                while ($row = mysqli_fetch_assoc($cartResult)) {
                    $item_total = $row['price'] * $row['quantity'];
                    $total_price += $item_total;

                    echo "<tr>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>
                            <input type='number' name='quantity[" . $row['m_id'] . "]' value='" . $row['quantity'] . "' min='1'>
                          </td>";
                    echo "<td>$" . $row['price'] . "</td>";
                    echo "<td>$" . $item_total . "</td>";
                    echo "<td>
                            <input type='hidden' name='o_id[" . $row['m_id'] . "]' value='" . $row['o_id'] . "'>
                            <input type='submit' name='update_cart[" . $row['m_id'] . "]' value='Update'>
                            <input type='submit' name='remove_item[" . $row['m_id'] . "]' value='Remove'>
                          </td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "<tfoot>
                        <tr>
                            <td colspan='3'>Total</td>
                            <td colspan='2'>$$total_price</td>
                        </tr>
                      </tfoot>";
                echo "</table>";

                echo "</form>";
                echo "<a href='checkout.php'><button type='button'>Proceed to Checkout</button></a>";
                echo "</div>";
            } else {
                echo "<p>Your cart is empty.</p>";
            }
        } else {
            echo "<p>Please log in to view your cart.</p>";
        }

        mysqli_close($conn);
        ?>
    </main>

    <!-- Footer -->
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
</body>
</html>
