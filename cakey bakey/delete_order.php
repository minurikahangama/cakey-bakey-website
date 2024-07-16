<?php
session_start();
require 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order'])) {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit();
    }

    // Get the cake name to be deleted
    $cakeNameToDelete = $_POST['cake_name'];

    // Prepare and execute SQL query to delete the row from the cart table
    $userId = $_SESSION['user_id'];
    $sqlCart = "DELETE FROM cart WHERE user_id = '$userId' AND cake_name = '$cakeNameToDelete'";
    $resultCart = $conn->query($sqlCart);

    // Prepare and execute SQL query to delete the row from the ordered_items table
    $sqlOrderedItems = "DELETE FROM ordered_iems WHERE user_id = '$userId' AND item_name = '$cakeNameToDelete'";
    $resultOrderedItems = $conn->query($sqlOrderedItems);

    if ($resultCart === TRUE && $resultOrderedItems === TRUE) {
        // Both rows deleted successfully
        echo json_encode(array("success" => true)); // Send JSON response
        exit();
    } else {
        // Error deleting rows
        echo json_encode(array("success" => false, "error" => $conn->error)); // Send JSON response
        exit();
    }
} else {
    // Redirect to the cart page if accessed directly without form submission
    header("Location: your_cart_page.php");
    exit();
}
?>
