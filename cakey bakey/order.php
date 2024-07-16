<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="order.css">
    <script src="https://kit.fontawesome.com/cb516eddc9.js" crossorigin="anonymous"></script>
    
   
  
</head>



<body>
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
            <div class="cart-icon"><i class="fa-solid fa-cart-shopping"></i></div>
            <div class="menu-icon"><i class="fa-solid fa-bars"></i></div>
            <div class="profile"><i class="fa-solid fa-user"></i></div>
        </div>

        <div class="search-form">
            <input type="search" name="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fa-solid fa-magnifying-glass"></label>
        </div>

        <div class="cart-items-container">
        </div>
    </header>
   
    <div class="container">
        <div class="shopping-cart">
            <div class="cart-items-section">
                <h1>Shopping Cart</h1>
                <form   action="save_order.php" method="POST">
    <table class="cart-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Name</th>
                <th>Quantity</th>
                <th> Price</th>
                <th>Save Order</th>
                <th>Delete Order</th>
              
            </tr>
        </thead>
        <tbody>
        <?php
session_start();
require 'connection.php';

// Initialize variables to store total number of items and total price
$totalItems = 0;
$totalPrice = 0;

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $sql = "SELECT DISTINCT cart.cake_name, cart.price, cart.picture, ordered_iems.quantity 
            FROM cart 
            LEFT JOIN ordered_iems ON cart.cake_name = ordered_iems.item_name AND cart.user_id = ordered_iems.user_id
            WHERE cart.user_id = $userId
            GROUP BY cart.cake_name";
    $result = $conn->query($sql);

    if ($result === false) {
        // Handle query execution error
        echo "Error executing the query: " . $conn->error;
    } else {
        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch and display the data
            while ($row = $result->fetch_assoc()) {
                // Calculate total number of items
                $totalItems += $row['quantity'];
                // Calculate total price
                $totalPrice += ($row['price'] * $row['quantity']);

                // Display the item details in the table
                echo '<tr class="cart-item">';
                echo '<td><img src="' . $row['picture'] . '" alt="' . $row['cake_name'] . '"></td>';
                echo '<td>' . $row['cake_name'] . '</td>';
                echo '<td>';
                echo '<button type="button" class="quantity-btn" onclick="decrementQuantity(this.parentNode.parentNode, ' . $row['price'] . ')">-</button>';
                echo '<span class="quantity" data-price="' . $row['price'] . '">0</span>';
                echo '<button type="button" class="quantity-btn" onclick="incrementQuantity(this.parentNode.parentNode, ' . $row['price'] . ')">+</button>';
                echo '</td>';
                echo '<td class="total-price">' . $row['price'] * $row['quantity'] . '</td>';
                echo '<td>';
                echo '<form action="save_order.php" method="POST">';
                echo '<input type="hidden" name="cake_name" value="' . $row['cake_name'] . '">';
                echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
                echo '<input type="hidden" name="quantity" class="quantity-input" value="' . $row['quantity'] . '">'; // Fetch quantity from ordered_items
                echo '<button type="submit" name="save_order" class="btn" onclick="saveOrder()">Save Order</button>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo '<form action="delete_order.php" method="POST">';
                echo '<input type="hidden" name="cake_name" value="' . $row['cake_name'] . '">';
                echo '<button type="button" name="delete_order" class="btn" onclick="deleteOrder(\'' . $row['cake_name'] . '\')">Delete Order</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            // No items in the cart
            echo '<tr><td colspan="6">No items in the cart</td></tr>';
        }
    }
} else {
    echo '<tr><td colspan="6">Please log in to view your cart items</td></tr>';
}

$conn->close();
?>



</tbody>
</table>

</div>
</div>

<div class="checkout-section">
<div class="total-section">
    <p>Total Item: <?php echo $totalItems; ?></p>
    <p>Total Price: Rs.<?php echo number_format($totalPrice, 2); ?></p>
</div>
<p class="free-delivery">Free delivery are offered to you at seasonal occations</p>

<a href="checkout.php" class="btn">CHECKOUT</a>
</div>

    
    </div>

    <script>
    // Function to handle incrementing quantity
    function incrementQuantity(row, pricePerItem) {
        var quantityElement = row.querySelector('.quantity');
        var quantity = parseInt(quantityElement.innerText);
        quantity++;
        quantityElement.innerText = quantity;
        
        // Update the hidden input field for quantity
        var quantityInput = row.querySelector('.quantity-input');
        quantityInput.value = quantity;
        
        updateTotalPrice(row, quantity, pricePerItem);
    }

    // Function to handle decrementing quantity
    function decrementQuantity(row, pricePerItem) {
        var quantityElement = row.querySelector('.quantity');
        var quantity = parseInt(quantityElement.innerText);
        if (quantity > 0) {
            quantity--;
            quantityElement.innerText = quantity;
            
            // Update the hidden input field for quantity
            var quantityInput = row.querySelector('.quantity-input');
            quantityInput.value = quantity;
            
            updateTotalPrice(row, quantity, pricePerItem);
        }
    }

    // Function to update total price based on quantity and price per item
    function updateTotalPrice(row, quantity, pricePerItem) {
        var totalPriceElement = row.querySelector('.total-price');
        var totalPrice = quantity * pricePerItem;
        totalPriceElement.innerText = 'Rs' + totalPrice.toFixed(2);
        
        // Update the hidden input field for price
        var priceInput = row.querySelector('.price-input');
        priceInput.value = totalPrice;
    }


   
    function saveOrder(cakeName, price, quantity) {
    // Send AJAX request to save_order.php
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save_order.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Order successfully saved
                alert("Order" + " saved successfully!");
                // Reload the page or update the UI as needed
                location.reload(); // Reload the page
            } else {
                // Error saving order
                alert("Error saving order: " + response.error);
            }
        }
    };
    xhr.send("cake_name=" + cakeName + "&price=" + price + "&quantity=" + quantity + "&save_order=1");
}



    // Function to handle delete operation and show alert message

    function deleteOrder(cakeName) {
        if (confirm("Are you sure you want to delete this order?")) {
            // Send AJAX request to delete_order.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_order.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Order successfully deleted
                        alert("Order deleted successfully!");
                        // Reload the page or update the UI as needed
                        location.reload(); // Reload the page
                    } else {
                        // Error deleting order
                        alert("Error deleting order: " + response.error);
                    }
                }
            };
            xhr.send("cake_name=" + cakeName + "&delete_order=1");
        }
    }




</script>

</body>

</html>