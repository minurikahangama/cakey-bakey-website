<?php
session_start();
require 'connection.php';

$response = array(); // Initialize response array

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_order'])) {
    // Retrieve data from the form
    $cakeName = $_POST['cake_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // You might want to perform some validation on the data before inserting it into the database

    // Insert data into the ordered_items table
    $userId = $_SESSION['user_id']; // Assuming you have user authentication implemented
    $sqlOrderedItems = "INSERT INTO ordered_iems (user_id, item_name, price, quantity) VALUES ('$userId', '$cakeName', '$price', '$quantity')";

    // Execute the SQL query
    if ($conn->query($sqlOrderedItems) === TRUE ) {
        // Successfully saved order for this item
        $response['success'] = true;
        $response['message'] = "Order for $cakeName saved successfully!";
    } else {
        // Error saving order for this item
        $response['success'] = false;
        $response['message'] = "Error: " . $conn->error;
    }
} else {
    // Invalid request method or form wasn't submitted properly
    $response['success'] = false;
    $response['message'] = "Invalid request!";
}

// Close the database connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
