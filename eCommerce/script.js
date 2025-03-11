async function fetchFeaturedProducts() {
    const apiUrl = 'https://fakestoreapi.com/products';
    try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const apiData = await response.json();
        displayFeaturedProducts(apiData.slice(0, 4)); // Show only 4 featured products
    } catch (error) {
        console.error('Error fetching data:', error);
        document.getElementById('featured-container').textContent = 'Error loading products';
    }
}

function displayFeaturedProducts(products) {
    const container = document.getElementById('featured-container');
    container.innerHTML = '';

    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.classList.add('featured-product');

        productCard.innerHTML = `
            <img src="${product.image}" alt="${product.title}">
            <h2>${product.title}</h2>
            <p class="price">&pound;${product.price.toFixed(2)}</p>
            <a href="Catalogue/index.php" class="featured-view-btn">View More</a>
            <a href="Catalogue/productDetails.php?product-id=${product.id} " class="featured-view-prod-btn">View Product</a>
        `;

        container.appendChild(productCard);
    });
}

window.onload = fetchFeaturedProducts;

