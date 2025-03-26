document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product-id');
    if (productId) {
        fetchProductDetails(productId);
    } else {
        document.getElementById('product-details-container').innerText = "Product not found.";
    }
});

async function fetchProductDetails(id) {
    const apiUrl = `https://fakestoreapi.com/products/${id}`;
    try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
            throw new Error('Product not found');
        }
        const product = await response.json();
        displayProductDetails(product);
    } catch (error) {
        document.getElementById('product-details-container').innerText = 'Error loading product details';
        console.error('Error fetching product:', error);
    }
}

function displayProductDetails(product) {
    const container = document.getElementById('product-details-container');
    container.innerHTML = `
        <div class="product-image-gallery">
            <img src="${product.image}" alt="${product.title}" id="main-product-image">
        </div>

        <div class="product-info">
            <h2>${product.title}</h2>
            <p class="price">&pound;${product.price.toFixed(2)}</p>
            <p class="product-description">${product.description}</p>
            <ul class="product-specifications">
                <li>Category: ${product.category}</li>
                <li>Rating: ${product.rating.rate} / 5 (Based on ${product.rating.count} reviews)</li>
            </ul>
        </div>
    `;

    // Add an event listener for the "Add to Cart" button
    const addToCartButton = document.getElementById('add-to-cart');
    addToCartButton.addEventListener('click', function () {
        addToCart(product); // Add product to cart
    });
}

function loadCart() {
    fetch('../cart/cart.php')
        .then(res => res.json())
        .then(data => {
            cart = data;
            renderCart();
        });
}

function addToCart(product) {
    let cart = JSON.parse(sessionStorage.getItem("cart")) || [];

    // Check if product is already in cart
    let existingItem = cart.find(item => item.id === product.id);
    if (existingItem) {
        existingItem.quantity += 1; // Increase quantity if already in the cart
    } else {
        cart.push({
            id: product.id,
            title: product.title,
            price: product.price,
            image: product.image,
            quantity: 1
        });
    }

    console.log(cart);
    // Store the updated cart back in sessionStorage
    sessionStorage.setItem("cart", JSON.stringify(cart));
    console.log(sessionStorage.getItem("cart"));

    alert(`${product.title} added to cart!`);
}



