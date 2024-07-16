<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="checkout.css">

    <script src="https://kit.fontawesome.com/cb516eddc9.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    require 'connection.php'; // Assuming this file contains your database connection code

    session_start();

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id']; // Retrieve the user ID from the session
        $sql = "SELECT address,user_name,contact FROM register WHERE user_id = $userId";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $address = $row['address'];
            $user_name=$row['user_name'];
            $contact=$row['contact'];
        } else {
            $address = "Address not found";
        }
    } else {
        $address = "User ID not found in session";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
    <header class="header">
        <a href="#" class="logo"><img src="cake-images/Capture.PNG"></a>
        <nav class="navbar">
            <a href="index.php#home">Home</a>
            <a href="index.php#cakes">Cakes</a>
            <a href="index.php#cheese-cakes">Cheesecakes</a>
            <a href="index.php#new-arrivals">New Arrivals</a>
            <a href="index.php#receipe">Receipes</a>
            <a href="cart_items.php">Cart Items</a>
            <a href="index.php#about">About</a>
            <a href="index.php#review">Review</a>
            <a href="index.php#contact">Contact</a>
        </nav>

        <div class="icons">
            <div class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
           
            <div class="menu-icon"><i class="fa-solid fa-bars"></i></div>
            <div class="menu">
                <a href="order.php" class="cart-icon" onclick="redirectToProfile()">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <div class="profile"><i class="fa-solid fa-user"></i></div>
        </div>

        <div class="search-form">
            <input type="search" name="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fa-solid fa-magnifying-glass"></label>
        </div>
    </header>


                ?>

    <div class="container">
        <h1>Order your cake to your doorstep</h1>
        <div class="cart-items-container">
            <div class="buttons">
                <button type="submit" class="btn" id="delivery-btn">Delivery</button>
                <button type="submit" class="btn" id="pickup-btn">Pick-Up</button>
            </div>
            <div class="deliver-details" id="delivery-address">
                <div class="delivery-card">
                    <i class="fa-solid fa-location-pin"></i>
                    <h5><?php echo "<p>$address</p>"; ?> </h5>
                    <i class="fa-solid fa-user"></i>
                   <h5> <?php echo "<p>$user_name</p>"; ?></h5>
                   <i class="fa-solid fa-phone"></i>
                   <h5><?php echo "<p>$contact</p>"; ?></h5>
               
                    <button class="btn edit-address-btn" type="button">Edit Address</Address></Details></button>
                </div>
            </div>

            <div id="edit-address-form" style="display: none;">
                <form id="address-form">
                    <input type="text" id="new-address" placeholder="Enter new address">
                    <button class="btn" type="submit">Save</button>
                </form>
            </div>

            <div class="pickup-details" id="pickup-address" style="display: none;">
                <div class="pickup-card">
                    <i class="fa-solid fa-store"></i>
                    <h5 id="delivery-address-text">Cakey Bakey Store Balangoda</h5>
                </div>
            </div>

            <div class="options-container">
                <input type="radio" id="standard" name="delivery_option" value="standard" checked onclick="showStandardDetails()">
                <div class="standard card">
                    <i class="fa-solid fa-business-time"></i>
                    <span>Standard
                        <p>30-50 min(s)</p>

                    </span>

                </div>
                <input type="radio" id="schedule" name="delivery_option" value="schedule" onclick="showScheduleDetails()">
                <div class="schedule card">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>
                        <label for="datepicker">Schedule:</label>
                        <input type="text" id="datepicker" readonly>
                    </span><br>
                </div>
            </div>
            <div class="your-items">
                <h2>Your items</h2>
                <div class="ordered-items">
                <?php
// Assuming you have the database connection established already
require 'connection.php';


// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve the user ID from the session
    $sql = "SELECT item_name, quantity, price FROM ordered_iems WHERE user_id = $userId AND quantity > 0";


    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch and display each item
        while ($row = mysqli_fetch_assoc($result)) {
            $itemName = $row['item_name'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $totalPrice = $quantity * $price; // Calculate total price for the item

            // Output HTML for each item
            echo '<div class="item-card">';
            echo "<h3>$itemName</h3>";
            echo "<p>Quantity: $quantity</p>";
        echo "<p>Price: Rs." . number_format($totalPrice, 2) . "</p>"; // Format price to two decimal places
            echo '</div>';
        }
    }}

// Close the database connection
mysqli_close($conn);
?>

                </div>

                <?php
// Assuming you have the database connection established already
require 'connection.php';

$totalAmount = 0; // Initialize total amount variable

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve the user ID from the session
    $sql = "SELECT quantity, price FROM ordered_iems WHERE user_id = $userId";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Calculate total amount based on quantity and price of each item
        while ($row = mysqli_fetch_assoc($result)) {
            $quantity = $row['quantity'];
            $price = $row['price'];
            $totalPrice = $quantity * $price; // Calculate total price for the item

            // Increment total amount by item's total price
            $totalAmount += $totalPrice;
        }
    } else {
        echo "No items found in the cart."; // If no items found in the cart
    }
} else {
    echo "User ID not found in session."; // If user ID not found in session
}

// Close the database connection
mysqli_close($conn);
?>


                <div class="order-summary">
    <div class="summary-card">
    <h3>Order Summary</h3>
        <!-- Dynamic subtotal -->
        <div class="summary-item">
            <span>Subtotal:</span>
            <span>Rs.<?php echo number_format($totalAmount, 2); ?></span>
        </div>
        <!-- Remaining HTML content for other summary items goes here -->
        <div class="summary-item">
            <span>Promotions:</span>
            <span>Rs.-500.00</span>
        </div>
        <div class="summary-item">
            <span>Delivery Fee:</span>
            <span>Rs.250.00</span>
        </div>
        <div class="summary-item">
            <span>Service Fee:</span>
            <span>Rs.250.00</span>
        </div>
        <div class="summary-total">
            <span>Total:</span>
            <!-- Assuming promotions, delivery fee, and service fee remain static -->
            <span>Rs.<?php echo number_format($totalAmount +  - 500 + 250 + 250, 2); ?></span>
        </div>
    </div>
</div>


                        <a href="payment.html" class="btn" type="submit">Order Now</a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src=script.js></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker();
    });

    // Function to show the edit address form
    document.querySelector('.edit-address-btn').addEventListener('click', function() {
        document.getElementById('edit-address-form').style.display = 'block';
    });

    // Function to handle form submission
    document.getElementById('address-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the new address value
        var newAddress = document.getElementById('new-address').value;

        // AJAX request to update the address in the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_address.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Address updated successfully
                    alert('Address updated successfully');
                    document.getElementById('edit-address-form').style.display = 'none'; // Hide the form
                    // You can optionally update the displayed address here
                    updateDisplayedAddress();
                } else {
                    // Error occurred while updating address
                    alert('Error occurred while updating address');
                }
            }
        };
        // Assuming you have a way to retrieve the user ID
        var userId = 123; // Replace with the actual user ID
        xhr.send('userId=' + userId + '&address=' + encodeURIComponent(newAddress));
    });

    // Fetch and update the address on page load
    window.addEventListener('DOMContentLoaded', function() {
        updateDisplayedAddress(); // Call the function to update the address on page load
    });

    // Function to handle form submission
    document.getElementById('address-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the new address value
        var newAddress = document.getElementById('new-address').value;

        // AJAX request to update the address in the database
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_address.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Address updated successfully
                    // alert('Address updated successfully');
                    // Update the displayed address
                    var displayedAddressElement = document.querySelector('.delivery-card h5');
                    displayedAddressElement.textContent = newAddress;

                    // Hide the form
                    document.getElementById('edit-address-form').style.display = 'none';
                } else {
                    // Error occurred while updating address
                    alert('Error occurred while updating address');
                }
            }
        };
        // Assuming you have a way to retrieve the user ID
        var userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;
        xhr.send('userId=' + userId + '&address=' + encodeURIComponent(newAddress));
    });

    // Function to handle radio button clicks
    document.querySelectorAll('input[name="delivery_option"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var selectedOption = this.value;
            // AJAX request to save the selected delivery option to the database
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_delivery_option.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Delivery option updated successfully
                        alert('Delivery option updated successfully');
                    } else {
                        // Error occurred while updating delivery option
                        alert('Error occurred while updating delivery option');
                    }
                }
            };
            // Assuming you have a way to retrieve the user ID
            var userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;
            xhr.send('userId=' + userId + '&deliveryOption=' + encodeURIComponent(selectedOption));
        });
    });
</script>
<script src="checkout.js"></script>

</html>