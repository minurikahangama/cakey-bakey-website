<?php
session_start(); // Start the session

// Check if user ID is stored in the session
if(isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $userId = $_SESSION['user_id'];

    // Proceed with updating the address in the database
    // Make sure to sanitize and validate the input
    $newAddress = $_POST['address']; // Assuming you're receiving the new address from the client-side
    
    // Your database update code here
    require 'connection.php'; // Include your database connection file
    
    // Update the address in the register table
    $sql = "UPDATE register SET address = '$newAddress' WHERE user_id = $userId";
    
    if (mysqli_query($conn, $sql)) {
        // Address updated successfully
        echo $newAddress; // Echo the new address
    } else {
        // Error occurred while updating address
        http_response_code(500);
        echo "Error occurred while updating address: " . mysqli_error($conn);
    }
    
    // Close the database connection
    mysqli_close($conn);
} else {
    // User ID not found in the session, handle the error accordingly
    http_response_code(403); // Forbidden
    echo "User ID not found in session";
}
?>
