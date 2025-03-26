<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart - HaveIt.com</title>
  <link rel="stylesheet" href="../styles/cartStyles.css">
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
      <a href="products.php" class="btn-outline">Continue Shopping</a>
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
    <div class="container">
      <p>© 2025 Future Design. All rights reserved.</p>
    </div>
  </footer>

  <script>
    let cart = [];

    function calculateTax(subtotal) {
      return +(subtotal * 0.2).toFixed(2); // 20% simulated VAT
    }

    function loadCart() {
      const container = document.getElementById('cart-items');
      container.innerHTML = '<p>Loading your cart...</p>';

      fetch('api/cart.php')
        .then(res => res.json())
        .then(data => {
          cart = data;
          renderCart();
        });
    }

    function renderCart() {
      const container = document.getElementById('cart-items');
      container.innerHTML = '';

      if (cart.length === 0) {
        container.innerHTML = '<p>Your cart is currently empty.</p>';
        document.getElementById('checkout-btn').disabled = true;
        document.getElementById('subtotal').textContent = '0.00';
        document.getElementById('shipping').textContent = '5.00';
        document.getElementById('taxes').textContent = '0.00';
        document.getElementById('total').textContent = '0.00';
        return;
      }

      let subtotal = 0;

      cart.forEach(item => {
        subtotal += item.price * item.quantity;

        container.innerHTML += `
          <div class="cart-item">
            <img src="${item.image}" alt="${item.name}">
            <div class="item-details">
              <h3>${item.name}</h3>
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

      const taxes = calculateTax(subtotal);
      const shipping = 5;
      const total = subtotal + shipping + taxes;

      document.getElementById('subtotal').textContent = subtotal.toFixed(2);
      document.getElementById('shipping').textContent = shipping.toFixed(2);
      document.getElementById('taxes').textContent = taxes.toFixed(2);
      document.getElementById('total').textContent = total.toFixed(2);
      document.getElementById('checkout-btn').disabled = false;
    }

    function updateQuantity(id, qty) {
      fetch('api/update.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ id: id, quantity: qty })
      }).then(() => loadCart());
    }

    function removeItem(id) {
      fetch('api/remove.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ id: id })
      }).then(() => loadCart());
    }

    document.getElementById('checkout-btn').addEventListener('click', () => {
      fetch('api/checkout.php', {
        method: 'POST'
      })
        .then(res => res.json())
        .then(data => {
          alert(data.message);
          loadCart(); // Reset cart after placing order
        });
    });

    // Load cart on page load
    loadCart();
  </script>
</body>
</html>
