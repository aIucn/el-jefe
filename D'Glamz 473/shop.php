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
  margin: 0 auto;
  justify-content: center;
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
}
nav a {
  color: var(--nav-text);
  text-decoration: none;
  font-size: 1.1em;
}
nav a:hover {
  color: var(--accent-color);
}
h1 {
  text-align: center;
  font-size: 2em;
  margin-bottom: 30px;
  margin-top: 20px;
  color: var(--light-text);
}
.products {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  max-width: 1200px;
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
    <a href="aboutus.php" class="active">About Us</a>
    <a href="shop.php">Shop</a>
    <a href="contact.php">Contact</a>
  </div>
  <button id="cart-toggle" aria-label="Shopping Cart">
    🛒
    <div id="cart-badge">0</div>
  </button>
</nav>
<h1 id="shop">Our Shop</h1>
<div class="products">
  <div class="product" data-name="Polo Ralph Lauren Chicago Shirt" data-price="300.00">
    <img src="https://media-assets.grailed.com/prd/listing/temp/abb7bfc23959496bb392b15cfa67b440?" alt="Polo Ralph Lauren Chicago Shirt"/>
    <h2>Polo Ralph Lauren "Chicago" Shirt</h2>
    <p class="price"> XCD $300.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Hellstar Sports Tee" data-price="350.00">
    <img src="https://u-mercari-images.mercdn.net/photos/m32664313019_1.jpg" alt="Hellstar Sports Tee"/>
    <h2>Hellstar Sports Tee</h2>
    <p class="price"> XCD $350.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Classic Black Hellstar Tee" data-price="350.00">
    <img src="https://hellstar.com/cdn/shop/files/BLACK_FRT_1.jpg?v=1750458329" alt="Classic Black Hellstar Tee"/>
    <h2>Classic Black Hellstar Tee</h2>
    <p class="price">XCD $350.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Classic White Hellstar Tee" data-price="350.00">
    <img src="https://hellstar.com/cdn/shop/files/IMG_2085.jpg?v=1756506039" alt="Classic White Hellstar Tee"/>
    <h2>Classic White Hellstar Tee</h2>
    <p class="price">XCD $350.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Jordan 12 Retro French Blue (2025)" data-price="750.00">
    <img src="https://i7.momoshop.com.tw/1755577669/goodsimg/TP000/4485/0002/432/TP00044850002432_O_m.jpg" alt="Jordan 12 Retro French Blue (2025)"/>
    <h2>Jordan 12 Retro French Blue (2025)</h2>
    <p class="price">XCD $750.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Jordan 5 Soft Pink (2025)" data-price="750.00">
    <img src="https://i.ebayimg.com/images/g/Mv4AAeSwNQ5pEwT8/s-l300.jpg" alt="Jordan 5 Soft Pink (2025)"/>
    <h2>Jordan 5 Soft Pink (2025)</h2>
    <p class="price">XCD $750.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Jordan 5 Black Metallic Reimagined (2025)" data-price="750.00">
    <img src="https://sneakernews.com/wp-content/uploads/2024/10/jordan-5-black-metallic-reimagined-hf3975-001-release-date-4.jpg?w=1140" alt="Jordan 5 Black Metallic Reimagined (2025)"/>
    <h2>Jordan 5 Black Metallic Reimagined (2025)</h2>
    <p class="price">XCD $750.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Jordan 11 Gamma (2025)" data-price="800.00">
    <img src="https://crepprotect.com/cdn/shop/articles/Screenshot_1615.png?v=1734694577" alt="Jordan 11 Gamma"/>
    <h2>Jordan 11 Gamma</h2>
    <p class="price">XCD $800.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Purple Brand P001 Jeans Black" data-price="250.00">
    <img src="https://shopsizeusa.com/cdn/shop/products/f_5f0dc1b4-6feb-4212-b3ad-d799eb77f300.jpg?v=1592431320" alt="Purple Brand P001 Jeans Black"/>
    <h2>Purple Brand P001 Jeans Black</h2>
    <p class="price">XCD $250.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Purple Brand P002-BLB Black Wash Blowout Jeans" data-price="250.00">
    <img src="https://probus.nyc/cdn/shop/products/purple-p002-blb-black-wash-blowout-897583.jpg?v=1762533940" alt="Purple Brand P002-BLB Black Wash Blowout Jeans"/>
    <h2>Purple Brand P002-BLB Black Wash Blowout Jeans</h2>
    <p class="price">XCD $250.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Purple Brand Denim Point Shorts Splash Paint Jean Jorts" data-price="200.00">
    <img src="https://u-mercari-images.mercdn.net/photos/m15938083198_1.jpg" alt="Purple Brand Denim Point Shorts Splash Paint Jean Jorts"/>
    <h2>Purple Brand Denim Point Shorts Splash Paint Jean Jorts</h2>
    <p class="price">XCD $200.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
  <div class="product" data-name="Coach Bag" data-price="250.00">
    <img src="https://coach.scene7.com/is/image/Coach/ccc70_imyee_a0?$mobileProductTile$" alt="Coach Bag"/>
    <h2>Additional Product Example</h2>
    <p class="price">XCD $250.00</p>
    <button onclick="addToCart(this)">Add to Cart</button>
  </div>
</div>
<div id="cart">
  <div id="cart-header">
    <h2>Shopping Cart</h2>
    <button id="close-cart" aria-label="Close Cart">&times;</button>
  </div>
  <ul id="cart-items"></ul>
  <button id="checkout">Checkout</button>
</div>
<script>
  function addToCart(button) {
    const productDiv = button.parentElement;
    const name = productDiv.dataset.name;
    const price = productDiv.dataset.price;
    window.cart.push({name, price});
    updateCartUI();
    updateBadge();
  }
  document.addEventListener('DOMContentLoaded', () => {
    window.cart = [];
    const cartButton = document.getElementById('cart-toggle');
    const cartPanel = document.getElementById('cart');
    const closeBtn = document.getElementById('close-cart');
    const cartBadge = document.getElementById('cart-badge');
    function updateBadge() {
      const count = window.cart.length;
      cartBadge.textContent = count;
      cartBadge.style.display = count > 0 ? 'flex' : 'none';
    }
    cartButton.onclick = () => {
      if (cartPanel.style.display === 'block') {
        cartPanel.style.display = 'none';
      } else {
        updateCartUI();
        cartPanel.style.display = 'block';
      }
    };
    closeBtn.onclick = () => {
      cartPanel.style.display = 'none';
    };
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
    document.getElementById('checkout').onclick = () => {
      if (window.cart.length === 0) {
        alert('Your cart is empty!');
      } else {
        const total = window.cart.reduce((sum, item) => sum + parseFloat(item.price), 0);
        alert(`Thank you for your purchase! Total: $${total.toFixed(2)}`);
        window.cart.length = 0;
        updateCartUI();
        updateBadge();
        document.getElementById('cart').style.display = 'none';
      }
    };
    updateBadge();
  });
</script>
<script>
  function addToCart(button) {
    const productDiv = button.parentElement;
    const name = productDiv.dataset.name;
    const price = productDiv.dataset.price;
    window.cart.push({name, price});
    updateCartUI();
    updateBadge();
    showAddMessage();
  }

  function showAddMessage() {
    let messageDiv = document.getElementById('add-message');
    if (!messageDiv) {
      messageDiv = document.createElement('div');
      messageDiv.id = 'add-message';
      messageDiv.style.position = 'fixed';
      messageDiv.style.top = '20px';
      messageDiv.style.right = '20px';
      messageDiv.style.backgroundColor = 'rgba(0,0,0,0.8)';
      messageDiv.style.color = '#fff';
      messageDiv.style.padding = '10px 20px';
      messageDiv.style.borderRadius = '5px';
      messageDiv.style.fontSize = '1em';
      document.body.appendChild(messageDiv);
    }
    messageDiv.textContent = 'Added to cart';
    messageDiv.style.display = 'block';

    clearTimeout(window.addMsgTimeout);
    window.addMsgTimeout = setTimeout(() => {
      messageDiv.style.display = 'none';
    }, 1000);
  }
</script>
</body>
</html>