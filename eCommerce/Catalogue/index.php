<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="../styles/catalogueStyles.css">
    <link rel="stylesheet" href="../styles/homeStyles.css">
</head>

<header class="navbar">
    
    <nav>
        <ul class="nav-menu">
            <li><a href="../index.php" class="nav-link">Home</a></li>
            <li><a href="index.php" class="nav-link">Products</a></li>
            <li><a href="../cart/cart.php" class="nav-link">Cart</a></li>
            <li><a href="../loginregister/index.php" class="nav-link">Login</a></li>
        </ul>
    </nav>
</header>
<body>

<div class="container">
    <h1>Product List</h1>

    <!-- Search Bar with Button -->
    <div class="search-container">
        <input type="text" id="search-bar" placeholder="Search products...">
        <button id="search-btn">Search</button>
    </div>


    <div id="data-container" class="product-grid"></div>

    <!-- Pagination Controls -->
    <div class="pagination">
        <button id="prev-btn" disabled>Previous</button>
        <span id="page-info">Page 1</span>
        <button id="next-btn">Next</button>
    </div>
</div>

<footer>
    <div class="footer-container">
        <!-- Navigation Links -->
        <ul class="footer-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="index.php">Products</a></li>
            <li><a href="../cart/cart.php">Cart</a></li>
            <li><a href="../loginregister/index.php">Login</a></li>
        </ul>

        <!-- Contact Us -->
        <a href="mailto:support@example.com?subject=Customer%20Inquiry&body=Hello,%20I%20have%20a%20question%20about...">Contact Us</a>
   
        <!-- Chat Bot -->
        <?php include '../chatbot.html'; ?>

        <!-- Social Links -->
        <div class="social-links">
            <a href="#"><img src="../images/faceB-icon.png" alt="Facebook"></a>
            <a href="#"><img src="../images/twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="../images/insta-icon.png" alt="Instagram"></a>
        </div>
    </div>
</footer>

<script src="script.js"></script>

</body>
</html>
