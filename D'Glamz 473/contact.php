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
<title>Contact</title>
<style>
:root {
  --dark-background: #0b0b1f;
  --light-text: #ffffff;
  --accent-color: #7b2ff7;
}
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  line-height: 1.6;
  background-image: url('https://i.pinimg.com/originals/ca/92/06/ca92068e40ef52cadf49ea1d0a98bf6c.gif');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: var(--light-text);
}
.navbar {
  background-color: rgba(17, 17, 17, 0.8);
  padding: 10px 20px;
}
.navbar ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}
.navbar li {
  margin-right: 20px;
}
.navbar a {
  color: var(--light-text);
  text-decoration: none;
  font-weight: bold;
  font-size: 1em;
}
.navbar a:hover,
.navbar a.active {
  color: var(--accent-color);
}
h1 {
  color: var(--light-text);
  font-size: 2em;
  margin: 20px 0;
  text-align: center;
  background-color: rgba(0, 0, 0, 0.5);
  padding: 10px;
  border-radius: 8px;
}
form {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  background: rgba(34, 34, 34, 0.8);
  border-radius: 8px;
}
label {
  display: block;
  margin-top: 10px;
  margin-bottom: 5px;
}
input, textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #555;
  border-radius: 4px;
  background-color: #222;
  color: var(--light-text);
}
button {
  margin-top: 15px;
  padding: 10px 20px;
  background: linear-gradient(135deg, #7b2ff7, #f107a3);
  color: #fff;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  font-weight: bold;
}
button:hover {
  background: linear-gradient(135deg, #f107a3, #7b2ff7);
}
</style>
</head>
<body>
<nav class="navbar">
  <ul>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="shop.php">Shop</a></li>
    <li><a href="contact.php" class="active">Contact</a></li>
  </ul>
</nav>
<h1>Contact Us</h1>
<form method="POST" action="send_message.php">
  <label for="name">Name</label>
  <input type="text" id="name" name="name" required />
  <label for="email">Email</label>
  <input type="email" id="email" name="email" required />
  <label for="message">Message</label>
  <textarea id="message" name="message" rows="5" required></textarea>
  <button type="submit">Send Message</button>
</form>
</body>
</html>