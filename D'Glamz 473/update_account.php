<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Update Account</title>
<style>
:root {
  --dark-background: #0f2027;
  --light-text: #ffffff;
  --accent-color: #7b2ff7;
}
body {
  font-family: 'Arial', sans-serif;
  background-color: var(--dark-background);
  color: var(--light-text);
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
.navbar {
  background: linear-gradient(135deg, #0f2027, #203a43);
  padding: 15px 20px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.5);
  position: sticky;
  top: 0;
  z-index: 999;
}
.navbar ul {
  list-style: none;
  display: flex;
  justify-content: center;
  margin: 0;
  padding: 0;
}
.navbar li {
  margin: 0 20px;
}
.navbar a {
  text-decoration: none;
  color: var(--light-text);
  font-weight: bold;
  transition: color 0.3s, transform 0.3s;
}
.navbar a:hover,
.navbar a.active {
  color: var(--accent-color);
  transform: scale(1.1);
}
.hero {
  background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://i.pinimg.com/originals/ca/92/06/ca92068e40ef52cadf49ea1d0a98bf6c') no-repeat center/cover;
  height: 30vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
}
.hero h1 {
  font-size: 2.5rem;
  color: var(--light-text);
  margin: 0;
}
.container {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: start;
  padding: 40px 20px;
  background-color: #111;
  max-width: 600px;
  margin: auto;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.5);
}
form {
  width: 100%;
  display: flex;
  flex-direction: column;
}
h2 {
  text-align: center;
  margin-bottom: 20px;
  color: var(--light-text);
}
label {
  margin-top: 10px;
  margin-bottom: 5px;
  font-weight: bold;
}
input[type="text"],
input[type="email"],
input[type="password"] {
  padding: 10px;
  border: 1px solid #555;
  border-radius: 5px;
  background-color: #222;
  color: var(--light-text);
  transition: border-color 0.3s, box-shadow 0.3s;
}
input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
  border-color: var(--accent-color);
  outline: none;
  box-shadow: 0 0 8px rgba(123, 47, 247, 0.7);
}
button {
  margin-top: 20px;
  padding: 12px;
  background: linear-gradient(135deg, #7b2ff7, #f107a3);
  color: #fff;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s, transform 0.3s;
}
button:hover {
  background: linear-gradient(135deg, #f107a3, #7b2ff7);
  transform: scale(1.05);
}
footer {
  background: linear-gradient(135deg, #0f2027, #203a43);
  text-align: center;
  padding: 15px;
  font-size: 0.9rem;
  color: var(--light-text);
}
</style>
</head>
<body>
<div class="navbar">
  <ul>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="shop.php">Shop</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="update_account.php" class="active">Update Account</a></li>
  </ul>
</div>
<div class="hero">
  <h1>Update Your Account</h1>
</div>
<div class="container">
  <form action="process_update.php" method="POST">
    <h2>Update Your Information</h2>
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required />
    <label for="email">Email</label>
    <input type="email" id="email" name="email" required />
    <label for="password">New Password</label>
    <input type="password" id="password" name="password" placeholder="Leave blank to keep current" />
    <button type="submit">Update Account</button>
  </form>
</div>
<footer>
  &copy; 2025 D'Glamz 473. All rights reserved.
</footer>
</body>
</html>