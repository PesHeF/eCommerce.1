<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="navbar">
    
    <nav>
        <ul class="nav-menu">
            <li><a href="index.php" class="nav-link">Home</a></li>
            <li><a href="Catalogue/index.php" class="nav-link">Products</a></li>
            <li><a href="cart.html" class="nav-link">Cart</a></li>
            <li><a href="login.html" class="nav-link">Login</a></li>
        </ul>
    </nav>
</header>

<section class="hero">
    <div class="hero-content welcome">
        <h1>Welcome to Our Store</h1>
        <a href="Catalogue/index.php" class="btn1">Shop Now</a>
    </div>
    <div class="hero-content register">
        <h1>New? </h1>
        <a href="Register/index.php" class="btn2">Register Here</a>

</section>



<section>
    <h2>Featured Products</h2>
    <div id="featured-container"></div>
</section>

<div class="container">
    
    <div id="data-container" class="product-grid">
    </div>

<footer>
    <div class="footer-container">
        <!-- Navigation Links -->
        <ul class="footer-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="catalogue/index.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>

        <!-- Contact Us -->
        <a href="mailto:support@example.com?subject=Customer%20Inquiry&body=Hello,%20I%20have%20a%20question%20about...">Contact Us</a>
   
        <!-- Chat Bot -->
        <?php include 'chatbot.html'; ?>

        <!-- Social Links -->
        <div class="social-links">
            <a href="#"><img src="images/faceB-icon.png" alt="Facebook"></a>
            <a href="#"><img src="images/twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="images/insta-icon.png" alt="Instagram"></a>
        </div>
    </div>
</footer>



<script src="script.js"></script>

</body>
</html>
