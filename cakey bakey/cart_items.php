
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakey Bakey</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cart_items.css">


    <script src="https://kit.fontawesome.com/cb516eddc9.js" crossorigin="anonymous"></script>

    <script>
        function redirectToProfile() {
            // Redirect to the profile page
            window.location.href = "profile.php";
        }
    </script>
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
            <div class="cart-icon"><i class="fa-solid fa-cart-shopping"></i> </div>
            <div class="menu-icon"><i class="fa-solid fa-bars"></i></div>

            <div class="profile">
                <a href="#" class="profile-link" onclick="redirectToProfile()">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>

        </div>

        </div>

        <div class="search-form">
            <input type="search" name="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fa-solid fa-magnifying-glass"></label>
        </div>

        <div class="cart-items-container-wrapper">
            <div class="cart-items-container">
                <?php
                // Start session
                session_start();

                // Include the database connection file
                require 'connection.php';

                // Check if user is logged in
                if (isset($_SESSION['user_id'])) {
                    // Sanitize user input
                    $userId = $conn->real_escape_string($_SESSION['user_id']);

                    // Prepare SQL statement with parameterized query
                    $sql = "SELECT cake_name, price, picture FROM cart WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);

                    // Bind the user ID parameter
                    $stmt->bind_param("i", $userId);

                    // Execute the prepared statement
                    $stmt->execute();

                    // Get the result set
                    $result = $stmt->get_result();

                    // Check if there are any cart items
                    if ($result->num_rows > 0) {
                        // Output each cart item
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="cart-item">';
                            echo '<span class="fas fa-times"></span>';

                            // Set the image source to the URL stored in the database
                            echo '<img src="' . $row['picture'] . '" alt="' . $row['cake_name'] . '">';

                            echo '<div class="content">';
                            echo '<h3>' . $row['cake_name'] . '</h3>';
                            echo '<div class="price">' . $row['price'] . '</div>';
                            echo '</div>'; // Close content
                            echo '</div>'; // Close cart-item
                        }
                        echo '<a href="order.php" class="btn">Order Now</a>';
                    } else {
                        echo '<p>No items in the cart</p>';
                    }

                    // Close the prepared statement
                    $stmt->close();
                } else {
                    echo '<p>Please log in to view your cart items</p>';
                }

                $conn->close();
                ?>


            </div>

        </div>
    </header>

    
<h2>Items in your Cart</h>
<?php
                // Start session
               

                // Include the database connection file
                require 'connection.php';

                // Check if user is logged in
                if (isset($_SESSION['user_id'])) {
                    // Sanitize user input
                    $userId = $conn->real_escape_string($_SESSION['user_id']);

                    // Prepare SQL statement with parameterized query
                    $sql = "SELECT cake_name, price, picture FROM cart WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);

                    // Bind the user ID parameter
                    $stmt->bind_param("i", $userId);

                    // Execute the prepared statement
                    $stmt->execute();

                    // Get the result set
                    $result = $stmt->get_result();

                    // Check if there are any cart items
                    if ($result->num_rows > 0) {
                        // Output each cart item
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="cart-item">';
                            echo '<span class="fas fa-times"></span>';

                            // Set the image source to the URL stored in the database
                            echo '<img src="' . $row['picture'] . '" alt="' . $row['cake_name'] . '">';

                            echo '<div class="content">';
                            echo '<h3>' . $row['cake_name'] . '</h3>';
                            echo '<div class="price">' . $row['price'] . '</div>';
                            echo '</div>'; // Close content
                            echo '</div>'; // Close cart-item
                        }
                        echo '<a href="order.php" class="btn">Order Now</a>';
                    } else {
                        echo '<p>No items in the cart</p>';
                    }

                    // Close the prepared statement
                    $stmt->close();
                } else {
                    echo '<p>Please log in to view your cart items</p>';
                }

                $conn->close();
                ?>

</body>
</html>
