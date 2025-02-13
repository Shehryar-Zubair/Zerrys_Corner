<?php
session_start();
include('db_connection.php');

// if the user is logged in at the start
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Get customer ID from email
    $query = "SELECT c_id FROM customers WHERE c_email = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $c_id = $row['c_id'];

    // Feedback submission handling
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feedback_type'], $_POST['feedback'])) {
        // Clean the feedback inputs
        $feedback_type = mysqli_real_escape_string($conn, trim($_POST['feedback_type']));
        $feedback = mysqli_real_escape_string($conn, trim($_POST['feedback']));

        // Check if both feedback type and feedback text are provided
        if (!empty($feedback) && !empty($feedback_type)) {
            // Prepare the query to insert feedback
            $query = "INSERT INTO feedback (c_id, feedback_type, feedback_text, submitted_at) 
                      VALUES ('$c_id', '$feedback_type', '$feedback', NOW())";

            // Execute the query
            if (mysqli_query($conn, $query)) {
                $success = "Thank you for your $feedback_type! We appreciate your input.";
            } else {
                $error = "An error occurred while submitting your $feedback_type. Please try again.";
            }
        } else {
            $error = "All fields are required. Please provide your input.";
        }
    }
} else {
    // If the user is not logged in
    $error = "You must be logged in to submit feedback.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Zerry's Corner</title>
    <link rel="stylesheet" href="homepage.css">
    <style>/* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(75deg, #d10d3e, #bfba1a);
    overflow-x: hidden;
}

/* Header */
header {
    text-align: center;
    background-color: #f8f8f8;
    padding: 20px;
}

header img {
    width: 30%;
    max-width: 250px;
    display: block;
    margin: 0 auto;
}

header h1 {
    font-size: 2.2em;
    color: #333;
}

header p {
    color: #555;
    font-size: 1.1em;
}

/* Feedback Container */
.feedback-container {
    max-width: 600px;
    margin: 40px auto;
    background: black;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.8s ease-in-out;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: white;
}

/* Feedback Buttons */
.button-group {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.button-group button {
    flex: 1;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    font-weight: bold;
    transition: all 0.3s;
    margin: 0 5px;
    background-color: white;
    color: black;
}

.button-group button.selected {
    background-color: orange;
    color: white;
}

.button-group button:hover {
    background-color: #ff7e5f;
    color: white;
}

/* Feedback Textbox */
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    font-size: 1em;
    border: 1px solid #ccc;
}

/* Submit Button */
button[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: white;
    color: black;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    font-weight: bold;
    transition: all 0.3s;
    margin-top: 10px;
}

button[type="submit"]:hover {
    background-color: #d37c03;
    color: white;
}

/* Success & Error Messages */
.message {
    margin: 10px 0;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    font-size: 1em;
}

.message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Footer */
footer {
    text-align: center;
    padding: 15px;
    background-color: #333;
    color: white;
    font-size: 0.9em;
    margin-top: 20px;
}

footer a {
    color: #ff7e5f;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

footer a:hover {
    color: orange;
    text-decoration: underline;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    header img {
        width: 50%;
    }

    header h1 {
        font-size: 1.8em;
    }

    .feedback-container {
        width: 90%;
        padding: 15px;
    }

    .button-group {
        flex-direction: column;
    }

    .button-group button {
        margin-bottom: 10px;
    }

    button[type="submit"] {
        font-size: 0.9em;
        padding: 10px;
    }
}

    </style>
    <script>
        function selectFeedbackType(type) {
            document.getElementById('feedback_type').value = type;
            const buttons = document.querySelectorAll('.button-group button');
            buttons.forEach(button => button.classList.remove('selected'));
            document.getElementById(type).classList.add('selected');
        }
    </script>
</head>

<body>
    <header style="text-align: center; padding: 0px; background-color: #f8f8f8;">
        <!-- Logo -->
        <img src="pictures/zerrylogo.png" alt="Zerry's Corner Logo"
            style="width: 32%; height: auto; margin: 0 auto ;position: display: block;">
        <h1>We Value Your Feedback!</h1>
        <p>Help us improve by sharing your thoughts.</p>
    </header>

    <div class="feedback-container">
        <?php if (isset($success)) { ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php } ?>
        <?php if (isset($error)) { ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php } ?>

        <form method="post" action="feedback.php">
            <label>Select Type:</label>
            <div class="button-group">
                <button type="button" id="Feedback" onclick="selectFeedbackType('Feedback')">Feedback</button>
                <button type="button" id="Complaint" onclick="selectFeedbackType('Complaint')">Complaint</button>
            </div>
            <!-- Hidden input to store feedback type -->
            <input type="hidden" name="feedback_type" id="feedback_type" required>

            <label for="feedback">Your Message:</label>
            <textarea name="feedback" id="feedback" rows="6" placeholder="Write your feedback or complaint here..."
                required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <footer>
        <p><a href="homepage1.php">Back to Homepage</a></p>
        <p>&copy; 2024 Zerry's Corner. All rights reserved.</p>
    </footer>
</body>

</html>