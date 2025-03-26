<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart - HaveIt.com</title>
  <link rel="stylesheet" href="../styles/cartStyles.css">
  <link rel="stylesheet" href="../styles/homestyles.css">
</head>
<body>
  <!-- HEADER -->
  <header>
    <div class="container">
      <h1>Your Cart</h1>
      <nav>
        <a href="../index.php">Home</a>
        <a href="../catalogue/index.php">Products</a>
        <a href="cart.php" class="active">Cart</a>
        <a href="../loginregister/index.php">Login/Register</a>
      </nav>
    </div>
  </header>

  <!-- MAIN CART CONTENT -->
  <main class="container">
    <section id="cart-items">
      <p>Loading your cart...</p>
    </section>

    <!-- CART ACTION BUTTONS -->
    <div class="cart-controls">
      <a href="../catalogue/index.php" class="btn-outline">Continue Shopping</a>
      <button onclick="loadCart()" class="btn-orange">Update Cart</button>
    </div>

    <!-- ORDER SUMMARY -->
    <section id="summary">
      <h2>Order Summary</h2>
      <p>Subtotal: £<span id="subtotal">0.00</span></p>
      <p>Shipping: £<span id="shipping">5.00</span></p>
      <p>Taxes: £<span id="taxes">0.00</span></p>
      <p><strong>Total: £<span id="total">0.00</span></strong></p>
      <button id="checkout-btn" class="btn-orange" disabled>Place Order</button>
    </section>
  </main>

  <!-- FOOTER -->
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

  <script>
    let cart = [];

    function calculateTax(subtotal) {
      return +(subtotal * 0.2).toFixed(2); // 20% simulated VAT
    }

    // Load the cart from sessionStorage
    function loadCart() {
      const container = document.getElementById('cart-items');
      container.innerHTML = '<p>Loading your cart...</p>';

      // Retrieve cart from sessionStorage
      cart = JSON.parse(sessionStorage.getItem("cart")) || [];

      if (cart.length === 0) {
        container.innerHTML = '<p>Your cart is currently empty.</p>';
        document.getElementById('checkout-btn').disabled = true;
        document.getElementById('subtotal').textContent = '0.00';
        document.getElementById('shipping').textContent = '5.00';
        document.getElementById('taxes').textContent = '0.00';
        document.getElementById('total').textContent = '0.00';
        return;
      }

      renderCart();
    }

    // Render cart items and update the order summary
    function renderCart() {
      const container = document.getElementById('cart-items');
      container.innerHTML = '';

      let subtotal = 0;
      cart.forEach(item => {
           console.log(cart);
           console.log(item); // Log the entire item to see its structure
           console.log(item.title); // Log the title specifically to verify it's being stored correctly
           console.log(item.name); // Check if 'name' is being used somewhere
           subtotal += item.price * item.quantity;

        container.innerHTML += `
          <div class="cart-item">
            <img src="${item.image}" alt="${item.title}">
            <div class="item-details">
              <h3>${item.title}</h3>
              <p>Price: £${item.price.toFixed(2)}</p>
              <div class="item-actions">
                <label>Qty: 
                  <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${item.id}, this.value)">
                </label>
                <button class="remove-btn" onclick="removeItem(${item.id})">Remove</button>
              </div>
            </div>
          </div>
        `;
      });

      // Calculate the taxes and total
      const taxes = calculateTax(subtotal);
      const shipping = 5;  // Fixed shipping rate
      const total = subtotal + shipping + taxes;

      // Update the order summary
      document.getElementById('subtotal').textContent = subtotal.toFixed(2);
      document.getElementById('shipping').textContent = shipping.toFixed(2);
      document.getElementById('taxes').textContent = taxes.toFixed(2);
      document.getElementById('total').textContent = total.toFixed(2);

      // Enable checkout button
      document.getElementById('checkout-btn').disabled = false;
    }

    // Update item quantity in the cart
    function updateQuantity(id, qty) {
      const cart = JSON.parse(sessionStorage.getItem("cart")) || [];
      const item = cart.find(product => product.id === id);
      if (item) {
        item.quantity = parseInt(qty);
      }
      sessionStorage.setItem("cart", JSON.stringify(cart));
      loadCart();
    }

    // Remove item from the cart
    function removeItem(id) {
      let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
      cart = cart.filter(item => item.id !== id);
      sessionStorage.setItem("cart", JSON.stringify(cart));
      loadCart();
    }

    // Handle checkout
    document.getElementById('checkout-btn').addEventListener('click', () => {
      alert("Order placed successfully!");
      sessionStorage.removeItem("cart");
      loadCart(); // Refresh the cart display after order placement
    });

    // Load cart on page load
    loadCart();
  </script>
</body>
</html>



