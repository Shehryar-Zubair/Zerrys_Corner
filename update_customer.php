<?php
session_start();
include('db_connection.php'); // Include your database connection file

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    echo "Session email not set. Redirecting...";
    header('Location: homepage.php?popup=login');
    exit();
}

// Get the logged-in user's email
$email = $_SESSION['email'];

// Fetch customer details from the database
$query = "SELECT c_name, phone_no, Address FROM customers WHERE c_email = '$email'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Query failed: " . mysqli_error($conn);
    exit();
}

$customer = mysqli_fetch_assoc($result);
if (!$customer) {
    echo "No customer data found for email: " . htmlspecialchars($email);
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch submitted data
    $c_name = $_POST['c_name'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];

    // Update the customer's details
    $updateQuery = "UPDATE customers SET c_name = '$c_name', Address = '$address', phone_no = '$phone_no' WHERE c_email = '$email'";
    if (mysqli_query($conn, $updateQuery)) {
        // Trigger the modal with a custom message
        echo "<script>
                window.onload = function() {
                    showModal('Your profile has been updated successfully! Would you like to stay on this page or go to the home page?');
                };
              </script>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update_customer.css">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        /* Modal styles */
        .modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    padding-top: 60px;
}

/* Modal content styles */
.modal-content {
    background-color: #020202;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    color: white;
    max-width: 500px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            float: right;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        /* Modal Buttons */
        .modal-buttons {
            display: flex;
            justify-content: space-between;
        }

        .modal-buttons button {
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .ok-button {
            background-color: #4CAF50;
            color: white;
        }

        .cancel-button {
            background-color: #f44336;
            color: white;
        }
        
    </style>
</head>
<header style="text-align: center; padding: 0px; background-color: #0000;">
        <!-- Logo -->
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo"
            style="width: 500px ; height: auto; margin: 0 auto ;position: display: block;">
        <!-- Title and Tagline 
        <h1>Welcome to Zerry's Corner</h1>
        <p>Where Every Bite Tells a Story</p>-->
        </div>
    </header>
<body>

<div class="form-container"> 
    <form method="POST" action="">
        <h3>Edit Your Profile</h3>
        <label for="c_name">Name:</label>
        <input type="text" id="c_name" name="c_name" value="<?php echo htmlspecialchars($customer['c_name']); ?>" required><br>

        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" value="<?php echo htmlspecialchars($customer['phone_no']); ?>" required><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required><?php echo htmlspecialchars($customer['Address']); ?></textarea><br>

        <button type="submit">Update Profile</button>
    </form>
</div>
    <!-- Modal for Custom Prompt -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modal-message"></p>
            <div class="modal-buttons">
                <button class="ok-button" id="okButton">Keep Updating</button>
                <button class="cancel-button" id="cancelButton">Leave Page</button>
            </div>
        </div>
    </div>

    <script>
        function showModal(message) {
            var modal = document.getElementById("myModal");
            var modalMessage = document.getElementById("modal-message");
            var okButton = document.getElementById("okButton");
            var cancelButton = document.getElementById("cancelButton");

            modalMessage.textContent = message; 
            modal.style.display = "block"; // Show modal

            // Handle the OK button click
            okButton.onclick = function() {
                window.location.href = 'update_customer.php'; // Stay on the current page
            };

            // Handle the Cancel button click
            cancelButton.onclick = function() {
                window.location.href = 'homepage1.php'; 
            };

            // Close the modal when the user clicks on <span> (x)
            var closeBtn = document.getElementsByClassName("close")[0];
            closeBtn.onclick = function() {
                modal.style.display = "none";
            };

            // Close the modal if the user clicks anywhere outside of it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        }
    </script>
</body>
<footer>
        <p>&copy; 2024 Zerry's Corner. All rights reserved.</p>
        <p>Follow us on <a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Twitter</a>.</p>
        <p><a href="homepage1.php">Back to Home</a></p>
    </footer>
</html>
    