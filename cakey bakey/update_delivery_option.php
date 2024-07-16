<?php
// Assuming you have the database connection established already

session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve user ID from session
    $userId = $_SESSION['user_id'];

    // Check if the delivery option data is sent via POST
    if (isset($_POST['deliveryOption'])) {
        // Sanitize the input to prevent SQL injection
        $deliveryOption = mysqli_real_escape_string($conn, $_POST['deliveryOption']);

        // Prepare and execute the SQL query to update the delivery option for the user
        $sql = "UPDATE ordered_items SET delivery_option = '$deliveryOption' WHERE user_id = $userId";

        if (mysqli_query($conn, $sql)) {
            // Delivery option updated successfully
            echo "Delivery option updated successfully";
        } else {
            // Error occurred while updating delivery option
            echo "Error occurred while updating delivery option: " . mysqli_error($conn);
        }
    } else {
        // If delivery option data is not sent
        echo "Delivery option data not received";
    }
} else {
    // If the user is not logged in
    echo "User not logged in";
}

// Close the database connection
mysqli_close($conn);
?>
