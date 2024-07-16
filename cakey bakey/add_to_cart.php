<?php
session_start();

require 'connection.php';



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        // Retrieve form data
        $cakeName = $_POST['cake_name'];
        $cakePrice = $_POST['cake_price'];
        $cakeImage = $_POST['cake_image'];
        $userId = $_SESSION['user_id'];

        $sql = "INSERT INTO cart (user_id, cake_name, price, picture) VALUES ('$userId', '$cakeName', '$cakePrice', '$cakeImage')";

        if ($conn->query($sql) === TRUE) {
            // Display success message
            echo '<script>alert("Item added to cart successfully!");';
        } else {
            // Display error message
            echo '<script>alert("Error occurred while adding item to cart: ' . $conn->error . '");';
        }
        // Redirect to index.php after showing the alert
        echo 'window.location.href = "index.php";</script>';

        // Close the database connection
        $conn->close();
    } else {
        // If user ID is not set, you might want to handle this case
        echo "User ID is not set in the session.";
    }
}
?>

