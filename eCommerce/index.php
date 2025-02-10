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
    <div class="hero-content">
        <h1>Welcome to Our Store</h1>
        <p>Discover your new treasures and sell your old ones!</p>
        <a href="Catalogue/index.php" class="btn">Shop Now</a>
    </div>
</section>

<section>
    <h2>Featured Products</h2>
    <div id="featured-container"></div>
</section>

<div class="container">
    
    <div id="data-container" class="product-grid">
    </div>



<script src="script.js"></script>

</body>
</html>
