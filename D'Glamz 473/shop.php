<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Shop</title>
<style>
:root {
  --dark-background: #0b0b1f;
  --light-text: #ffffff;
  --accent-color: #7b2ff7;
  --product-bg: #222;
  --nav-bg: #111;
  --nav-text: #fff;
}
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  background-color: var(--dark-background);
  color: var(--light-text);
  padding: 0;
}
nav {
  background-color: var(--nav-bg);
  display: flex;
  align-items: center;
  padding: 15px 20px;
  position: sticky;
  top: 0;
  z-index: 999;
  box-shadow: 0 2px 5px rgba(0,0,0,0.5);
  justify-content: space-between;
}
.nav-links {
  display: flex;
  gap: 20px;
}
#cart-toggle {
  position: relative;
  font-size: 1.5em;
  background: none;
  border: none;
  cursor: pointer;
  color: var(--nav-text);
  padding: 0;
}
#cart-badge {
  position: absolute;
  top: -8px;
  right: -8px;
  background-color: red;
  color: white;
  width: 18px;
  height: 18px;
  font-size: 12px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  display: none;
}
nav a {
  color: var(--nav-text);
  text-decoration: none;
  font-size: 1.1em;
}
nav a:hover,
nav a.active {
  color: var(--accent-color);
}
h1 {
  text-align: center;
  font-size: 2em;
  margin: 20px 0;
  color: var(--light-text);
}
.products {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  max-width: 1000px;
  margin: 0 auto 40px auto;
}
.product {
  background-color: var(--product-bg);
  padding: 15px;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: transform 0.2s, box-shadow 0.2s;
}
.product:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 15px rgba(0,0,0,0.3);
}
.product img {
  width: 100%;
  max-width: 180px;
  height: auto;
  border-radius: 8px;
  margin-bottom: 10px;
}
.product h2 {
  font-size: 1.2em;
  margin: 10px 0 5px 0;
  text-align: center;
}
.price {
  color: #ccc;
  margin-bottom: 10px;
}
button {
  background-color: var(--accent-color);
  color: var(--light-text);
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
  transition: background-color 0.3s;
}
button:hover {
  background-color: #5e1fbf;
}
#cart {
  position: fixed;
  top: 50px;
  right: 20px;
  width: 300px;
  max-height: 80vh;
  overflow-y: auto;
  background-color: #111;
  border: 2px solid var(--accent-color);
  border-radius: 10px;
  padding: 10px;
  display: none;
  z-index: 9999;
}
#cart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
#cart h2 {
  margin: 0;
  font-size: 1.2em;
}
#close-cart {
  background: none;
  border: none;
  color: var(--light-text);
  font-size: 1.5em;
  cursor: pointer;
}
#cart-items {
  list-style: none;
  padding: 0;
  margin-top: 10px;
}
#cart-items li {
  background-color: #222;
  margin: 10px 0;
  padding: 10px;
  border-radius: 8px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
#checkout {
  width: 100%;
  padding: 10px;
  background-color: var(--accent-color);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
  margin-top: 10px;
}
#checkout:hover {
  background-color: #5e1fbf;
}
</style>
</head>
<body>
<nav>
  <div class="nav-links">
    <a href="homepage.php">Home</a>
    <a href="aboutus.php">About Us</a>
    <a href="shop.php" class="active">Shop</a>
    <a href="contact.php">Contact</a>
  </div>
  <button id="cart-toggle" aria-label="Shopping Cart">🛒</button>
</nav>
<h1 id="shop">Our Shop</h1>
<div class="products">
  <div class="product" data-name="Polo Ralph Lauren Chicago Shirt" data-price="300.00">
    <img src="https://media-assets.grailed.com/prd/listing/temp/abb7bfc23959496bb392b15cfa67b440?" alt="Polo Ralph Lauren Chicago Shirt"/>
    <h2>Polo Ralph Lauren "Chicago" Shirt</h2>
    <p class="price"> XCD $300.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
</div>
<div id="cart">
  <div id="cart-header">
    <h2>Your Cart</h2>
    <button id="close-cart">&times;</button>
  </div>
  <ul id="cart-items"></ul>
  <button id="checkout">Checkout</button>
</div>
<script>
  window.cart = [];

  function updateBadge() {
    const count = window.cart.length;
    const badge = document.getElementById('cart-badge');
    badge.textContent = count;
    badge.style.display = count > 0 ? 'flex' : 'none';
  }

  function addToCart(button) {
    const productDiv = button.parentElement;
    const name = productDiv.dataset.name;
    const price = productDiv.dataset.price;
    window.cart.push({name, price});
    updateCartUI();
    updateBadge();
  }

  function toggleCart() {
    const cartPanel = document.getElementById('cart');
    if (cartPanel.style.display === 'block') {
      cartPanel.style.display = 'none';
    } else {
      cartPanel.style.display = 'block';
    }
  }

  function updateCartUI() {
    const cartItemsContainer = document.getElementById('cart-items');
    if (!cartItemsContainer) return;
    cartItemsContainer.innerHTML = '';
    window.cart.forEach((item, index) => {
      const li = document.createElement('li');
      li.textContent = `${item.name} - $${item.price}`;
      const removeBtn = document.createElement('button');
      removeBtn.textContent = 'Remove';
      removeBtn.style.marginLeft = '10px';
      removeBtn.onclick = () => {
        window.cart.splice(index, 1);
        updateCartUI();
        updateBadge();
      };
      li.appendChild(removeBtn);
      cartItemsContainer.appendChild(li);
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('cart-toggle').onclick = toggleCart;
    document.getElementById('close-cart').onclick = () => {
      document.getElementById('cart').style.display = 'none';
    };
    document.getElementById('checkout').onclick = () => {
      if (window.cart.length === 0) {
        alert('Your cart is empty!');
      } else {
        const total = window.cart.reduce((sum, item) => sum + parseFloat(item.price), 0);
        alert(`Thank you for your purchase! Total: $${total.toFixed(2)}`);
        window.cart = [];
        updateCartUI();
        updateBadge();
        document.getElementById('cart').style.display = 'none';
      }
    };
    updateBadge();
  });
</script>
</body>
</html>