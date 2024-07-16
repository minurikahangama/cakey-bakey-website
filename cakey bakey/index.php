<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakey Bakey</title>
    <link rel="stylesheet" href="style.css">

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
            <a href="#home">Home</a>
            <a href="#cakes">Cakes</a>
            <a href="#cheese-cakes">Cheesecakes</a>
            <a href="#new-arrivals">New Arrivals</a>
            <a href="#receipe">Receipes</a>
            <a href="cart_items.php">Cart Items</a>
            <a href="#about">About</a>
            <a href="#review">Review</a>
            <a href="#contact">Contact</a>
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

    <section class="home" id="home">

        <div class="hero">
            <h3>Indulge in heavenly sweet delights.</h3>
            <p>
               TASTE OF HEAVEN
            </p>
            <a class="btn" href="#cakes">Get yours now</a>
        </div>
    </section>
    <section class="section-cakes" id="cakes">
        <h3 class="title">our <span>cakes</span></h3>
        <div class="wrapper">
            <!-- item one -->
            <div class="cake-card">
                <img src="cake-images/wedding-cake.jpg">
                <h3>wedding Cake </h3>
                <div class="price">Rs.15000/-</div>
                <!-- <a href="#" class="btn">Add to cart</a> -->
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="Wedding Cake">
                    <input type="hidden" name="cake_price" value="15000">
                    <input type="hidden" name="cake_image" value="cake-images/wedding-cake.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>

            </div>



            <!-- item two -->
            <div class="cake-card">
                <img src="cake-images/chocalate-cake.jpg">
                <h3>chocalate Cake </h3>
                <div class="price">Rs.2000/-<span> 3500</span></div>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="Chocalate Cake">
                    <input type="hidden" name="cake_price" value="3500">
                    <input type="hidden" name="cake_image" value="cake-images/chocalate-cake.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>

            <!-- item three -->
            <div class="cake-card">
                <img src="cake-images/butter-cake.jpg">
                <h3> Macha Butter Cake </h3>
                <div class="price">Rs.1500/-<span> 4500</span></div>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="Butter Cake">
                    <input type="hidden" name="cake_price" value="4500">
                    <input type="hidden" name="cake_image" value="cake-images/butter-cake.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>

            <!-- item  four -->
            <div class="cake-card">
                <img src="cake-images/fruit-cake.jpg">
                <h3> fruit Cake </h3>
                <div class="price">Rs.1700/-<span> 5500</span></div>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="Fruit Cake">
                    <input type="hidden" name="cake_price" value="1700">
                    <input type="hidden" name="cake_image" value="cake-images/fruit-cake.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>

            <!-- item five -->
            <div class="cake-card">
                <img src="cake-images/pastry-cake.jpg">
                <h3>Pastry Cake </h3>
                <div class="price">Rs.700/-<span> 3200</span></div>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="Pastry Cake">
                    <input type="hidden" name="cake_price" value="3200">
                    <input type="hidden" name="cake_image" value="cake-images/pastry-cake.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>

            <!-- item six -->
            <div class="cake-card">
                <img src="cake-images/cupcake.jpg">
                <h3>cup Cake </h3>
                <div class="price">Rs.500/-<span> 2500</span></div>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="Cup Cake">
                    <input type="hidden" name="cake_price" value="2500">
                    <input type="hidden" name="cake_image" value="cake-images/cupcake.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
            <!-- item seven -->
            <div class="cake-card">
                <img src="cake-images/icecream-cake.jpg">
                <h3>ice cream Cake </h3>
                <div class="price">Rs.1500/-</div>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="ice cream Cake">
                    <input type="hidden" name="cake_price" value="1500">
                    <input type="hidden" name="cake_image" value="cake-images/icecream-cake.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
            <!-- item eight -->
            <div class="cake-card">
                <img src="cake-images/ice-brownie.jpg">
                <h3>ice cream with hot brownie Cake </h3>
                <div class="price">Rs.5000/-<span> 9500</span></div>
                <div></div>
                <form action="add_to_cart.php" method="post">
                    <input type="hidden" name="cake_name" value="brownie with ice cream">
                    <input type="hidden" name="cake_price" value="5000">
                    <input type="hidden" name="cake_image" value="cake-images/ice-brownie.jpg">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>

    </section>

    <!-- Cheesecakes -->
    <section class="cheese-cakes" id="cheese-cakes">
        <h1 class="title">our <span> cheese cakes</span> </h1>
        <div class="wrapper">
            <div class="cheese-card">
                <a href="" class="fas fa-shopping-cart"></a>
                <a href="" class="fas fa-heart"></a>
                <a href="" class="fas fa-eye"> </a>
                <div class="img">
                    <img src="cake-images/cheese-1.jpg">
                </div>
                <div class="content">
                    <h3>caramel cheese cake</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">Rs.1200/-<span> 1500</span></div>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="Mango Cheese Cake">
                        <input type="hidden" name="cake_price" value="1200">
                        <input type="hidden" name="cake_image" value="cake-images/cheese-1.jpg">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <!-- Repeat the above structure for each cheese cake item -->
            <div class="cheese-card">
                <a href="" class="fas fa-shopping-cart"></a>
                <a href="" class="fas fa-heart"></a>
                <a href="" class="fas fa-eye"> </a>
                <div class="img">
                    <img src="cake-images/cheese-4.jpg">
                </div>
                <div class="content">
                    <h3>orange cheese cake</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">Rs.500/-<span> 6500</span></div>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="orange cheese Cake">
                        <input type="hidden" name="cake_price" value="6500">
                        <input type="hidden" name="cake_image" value="cake-images/cheese-4">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="cheese-card">
                <a href="" class="fas fa-shopping-cart"></a>
                <a href="" class="fas fa-heart"></a>
                <a href="" class="fas fa-eye"> </a>
                <div class="img">
                    <img src="cake-images/cheese-3.jpg">
                </div>
                <div class="content">
                    <h3>vanilla cheese cake</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">Rs.2200/-<span> 2500</span></div>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="pineapple cheese Cake">
                        <input type="hidden" name="cake_price" value="2500">
                        <input type="hidden" name="cake_image" value="cake-images/cheese-3">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <div class="cheese-card">
                <a href="" class="fas fa-shopping-cart"></a>
                <a href="" class="fas fa-heart"></a>
                <a href="" class="fas fa-eye"> </a>
                <div class="img">
                    <img src="cake-images/cheese-2.jpg">
                </div>
                <div class="content">
                    <h3>blue berry cheese cake</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="price">Rs.1800/-<span> 1500</span></div>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="fruit cheese Cake">
                        <input type="hidden" name="cake_price" value="1500">
                        <input type="hidden" name="cake_image" value="cake-images/cheese-2.jpg">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>

        </div>
    </section>


    <!-- new Arrivals -->
    <section class="new-arrivals" id="new-arrivals">
        <h1 class="title">new <span>arrivals</span></h1>
        <div class="wrapper">
            <div class="card">
                <div class="img">
                    <img src="cake-images/blue-berry.PNG">
                </div>
                <div class="content">
                    <a class="cake">Blue berry cupcakes</a>
                    <div class="price">Rs.100/-</div>
                    <p>Soft cupcakes made with cocoa powder and blueberry  that is moist and delicious!.</p>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="blue cup cake">
                        <input type="hidden" name="cake_price" value="100">
                        <input type="hidden" name="cake_image" value="cake-images/bg.jpg">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <!-- 1 new arrivals -->
            <div class="card">
                <div class="img">
                    <img src="cake-images/macroons.jpg">
                </div>
                <div class="content">
                    <a class="cake">Rainbow macroons</a>
                    <div class="price">Rs.1500/-</div>
                    <p> Rainbow Macarons are the most fun and delicious cookies!.</p>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="rainbow macroons">
                        <input type="hidden" name="cake_price" value="1500">
                        <input type="hidden" name="cake_image" value="cake-images/macroons.jpg">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <!-- 2 new arrivals -->
            <div class="card">
                <div class="img">
                    <img src="cake-images/cookies.jpg">
                </div>
                <div class="content">
                    <a class="cake">Chocalate chip cookies</a>
                    <div class="price">Rs.3000/-</div>
                    <p>These super soft and chewy chocolate chip cookies are one of the most popular cookie now.</p>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="Cookies">
                        <input type="hidden" name="cake_price" value="3000">
                        <input type="hidden" name="cake_image" value="cake-images/cookies.jpg">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <!-- 3 new arrivals -->
            <div class="card">
                <div class="img">
                    <img src="cake-images/waffles.jpg">
                </div>
                <div class="content">
                    <a class="cake"> Waffles</a>
                    <div class="price">Rs.1800/-</div>
                    <p>Waffles are a type of pancake that is cooked in a waffle iron and toppings are added as per your wish.</p>
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="cake_name" value="waffles">
                        <input type="hidden" name="cake_price" value="1800">
                        <input type="hidden" name="cake_image" value="cake-images/waffles.jpg">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="receipe" id="receipe">
        <h1 class="title">our <span> receipe</span></h1>
        <div class="wrapper">
            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/blue-berry.PNG">
                </div>
                <div class="content">
                    <h3>Blue berry cup cake receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="blue-berry.html" class="btn">exlpore</a>
                </div>
            </div>

            <!-- 2 receipe -->
            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/macroons.jpg">
                </div>
                <div class="content">
                    <h3>Rainbow macroons receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="macroons-receipe.html" class="btn">exlpore</a>
                </div>
            </div>

            <!-- third receipe -->
            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/cheese-2.jpg">
                </div>
                <div class="content">
                    <h3>Blue berry cheesecake receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="blue_cheesecake.html" class="btn">exlpore</a>
                </div>
            </div>

            <!-- forth receipe -->

            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/chocalate-cake.jpg">
                </div>
                <div class="content">
                    <h3>Mosit chocalate cake receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="chocalte_receipe.html" class="btn">exlpore</a>
                </div>
            </div>

            <!-- firth receipe -->

            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/fruit-cake.jpg">
                </div>
                <div class="content">
                    <h3>Fresh fruit cake receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="" class="btn">exlpore</a>
                </div>
            </div>

            <!-- 5th receipe -->
            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/butter-cake.jpg">
                </div>
                <div class="content">
                    <h3>Macha butter cake receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="" class="btn">exlpore</a>
                </div>
            </div>


            <!-- 6th receipe -->
            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/cheese-3.jpg">
                </div>
                <div class="content">
                    <h3>Cheese cake receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="" class="btn">exlpore</a>
                </div>
            </div>
            <!-- 7th cake -->
            <div class="receipe-card">
                <div class="img">
                    <img src="cake-images/brownie.jpg">
                </div>
                <div class="content">
                    <h3>Fudgy brownie receipe</h3>
                    <p>Try out the receipe and share you idea with us.</p>
                    <a href="" class="btn">exlpore</a>
                </div>
            </div>

        </div>
        <div class="see-more">
            <a href="cart_items.php" class="btn">See your cart items</a>
        </div>


    </section>
    <!-- about us -->
    <section class="about" id="about">
        <h1 class="title">about<span> us</span></h1>
        <div class="wrapper">
            <div class="container">
                <div class="img">
                    <img src="cake-images/about-us.jpg">
                </div>
                <div class="content">
                    <h3>what makes us different</h3>
                    <p>
                     The Cakey Bakey Shop, was chosen as one of the best brunch spots on the list. The bakery has a 4.8 star ranking and over 4,050 reviews. "We expected the desserts to be delicious but we’re delighted that all the food was excellent. The decorations for the holidays were exquisite," The review also ranked the bakery with five stars for food, five for service, five for ambience and five stars overall.
                    </p>
                    <p>
                       We give you the most best taste of cakes for the reasonable price.
                    </p>
                    <p>
                        We started with a small busniess and now cakey bakey is has three outlets around Srilanka.
                    </p>
                    <a href="#home" class="btn">learn more</a>
                </div>
            </div>
        </div>
    </section>

    <!-- review section -->
    <section class="review" id="review">
        <h1 class="title">our<span> reviews</span></h1>
        <div class="wrapper">
            <div class="review-card">

                <div class="review-content">
                    <div class="reviewer-info">
                        <span class="name">Abhi</span><br>
                        <span class="email">abhi@gmail.com</span>
                    </div>
                    <p>The cake and cupcakes were a huge success – not one cupcake left behind.

I loved the frosting.

Thank you for the wonderful work you do..</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <!-- More review cards can be added here -->

            <div class="review-card">

                <div class="review-content">
                    <div class="reviewer-info">
                        <span class="name">Sandaru dilshan</span>
                        <span class="email">sandaru@gmail.com</span>
                    </div>
                    <p>I wanted to say Thank you for the delicious birthday cake you made for my wife’s birthday last Saturday. The cake was a huge hit and everyone loved that it was in the shape of the number 50. I also wanted to say that the chocolate covered strawberries went over just as well. Everyone commented on how large and sweet they were..</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>


            <div class="review-card">

                <div class="review-content">
                    <div class="reviewer-info">
                        <span class="name">Nisha</span>
                        <span class="email">nisha@gmail.com</span>
                    </div>
                    <p> I wanted to send you a quick note to let you now how much WE LOVED the cake. I cannot put into word how amazing it was. You totally WOWed me. The cake looked breathtaking and it was so yummy! Everyone at the shower could not stop talking about it.
Thank you so much!.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>



            <div class="review-card">

                <div class="review-content">
                    <div class="reviewer-info">
                        <span class="name">Gayani Nilusha</span>
                        <span class="email">gayani@gmail.com</span>
                    </div>
                    <p>Hi guys,
I just wanted to let you know that I gave you a 5 star yelp review! We were very very happy with our wedding cake. Thank you so much for making our vision real and wonderful! I loved the cake! It tasted great!
Cathy.</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- contact section -->

    <section class="contact" id="contact">
        <h1 class="title"><span>contact</span> us</h1>
        <div class="content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.9842425121583!2d80.69511467395753!3d6.648874221695838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3f34cb942b56d%3A0x58ac8a1d078d4155!2sCake%20%26%20Bake!5e0!3m2!1sen!2slk!4v1708849750072!5m2!1sen!2slk" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <form action="">
                <h3>get in touch</h3>
                <div class="input-box">
                    <span class="fas fa-user"></span>
                    <input type="text" name="name" placeholder="Your name">
                </div>

                <div class="input-box">
                    <span class="fas fa-envelope"></span>
                    <input type="text" name="email" placeholder="Your email">
                </div>

                <div class="input-box">
                    <span class="fas fa-phone"></span>
                    <input type="text" name="phone" placeholder="Your contact">
                </div>
                <a href="" class="btn">contact now</a>
            </form>
        </div>
    </section>

    <!-- footer -->
    <footer class="footer">
        <div class="social-media">
            <a href="" class="fab fa-facebook-f"></a>
            <a href="" class="fab fa-twitter"></a>
            <a href="" class="fab fa-instagram"></a>
            <a href="" class="fab fa-linkedin"></a>
            <a href="" class="fab fa-pinterest"></a>
        </div>
        <div class="links">

            <a href="#home">Home</a>
            <a href="#cakes">Cakes</a>
            <a href="#cheese-cakes">Cheesecakes</a>
            <a href="#new-arrivals">New Arrivals</a>
            <a href="#receipe">Receipe</a>
            <a href="cart_items.php">Cart items</a>
            <a href="#review">Review</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>

        </div>
        <div class="credits">
            created by <span>Minuri Dahara</span> all rights reserved.
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>