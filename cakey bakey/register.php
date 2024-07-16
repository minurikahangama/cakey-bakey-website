<?php
// Include the database connection file
require 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    
    // Check if passwords match
    if ($pass !== $cpass) {
        echo '<script>alert("Passwords do not match");</script>';
    } else {
        // Passwords match, proceed with database insertion
        
        // SQL query to insert user details into the database
        $sql = "INSERT INTO register (user_name, email, password, confirm_password, address, contact) 
                VALUES ('$username', '$email', '$pass', '$cpass', '$address', '$contact')";
        
        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Redirect to login.html
            echo '<script>window.location.href = "login.html";</script>';
        } else {
            echo '<script>alert("Error: ' . $sql . '<br>' . $conn->error . '");</script>';
        }
    }
}

// Close the database connection
$conn->close();
?>
