<?php
// Start session
session_start();

// Include the database connection file
require 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM register WHERE user_name=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if the query returned any rows
    if ($result) {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Username and password matched, retrieve the user's ID
            $row = $result->fetch_assoc();
            $userId = $row['user_id']; // Assuming 'user_id' is the column name for the user's ID
    
            // Store the user's ID in a session variable
            $_SESSION['user_id'] = $userId;
    
            // Echo the user ID for verification
    
            // Redirect to index.html
            header("Location: index.php");
            exit();
        } else {
            // No matching user found
            echo '<script>alert("Username or password incorrect");</script>';
        }
    } else {
        // Error occurred during the query execution
        error_log("Error executing query: " . $stmt->error);
        echo "Error: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
