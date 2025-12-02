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
<title>About Us</title>
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
    background-color: var(--dark-background);
    color: var(--light-text);
}
.navbar {
    background-color: #111;
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
    transition: color 0.3s;
}
.navbar a:hover,
.navbar a.active {
    color: var(--accent-color);
}
h1 {
    color: var(--light-text);
    font-size: 2em;
    margin: 20px 0 10px 0;
    text-align: center;
}
h2 {
    margin-top: 40px;
    color: var(--light-text);
    font-size: 1.5em;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    padding-bottom: 5px;
    text-align: center;
}
p {
    margin-top: 10px;
    font-size: 1em;
}
.team-description {
  max-width: 800px;
  margin: 20px auto;
  padding: 0 20px;
  font-size: 1.1em;
  color: #ccc;
  line-height: 1.5;
  text-align: center;
}
.team-member {
    margin-top: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    justify-content: center;
}
.team-member img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--accent-color);
}
.team-member h3 {
    color: var(--light-text);
    font-size: 1.2em;
    margin: 0;
}
.team-member p {
    color: #ccc;
    font-size: 0.95em;
    margin: 5px 0 0 0;
}
.vouches {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
    align-items: center;
}
.vouch {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #222;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    max-width: 600px;
    width: 90%;
    text-align: center;
}
.vouch img {
    width: 100%;
    max-width: 600px;
    height: auto;
    border-radius: 10px;
    object-fit: cover;
    border: 2px solid var(--accent-color);
    margin-bottom: 10px;
}
.vouch p.description {
    font-size: 1em;
    color: #ccc;
    margin: 0;
}
@media(max-width: 600px) {
    .team-member {
        flex-direction: column;
        align-items: center;
    }
    .team-member img {
        width: 60px;
        height: 60px;
    }
}
</style>
</head>
<body>
<nav class="navbar">
    <ul>
        <li><a href="homepage.php" class="active">Home</a></li>
        <li><a href="aboutus.php" class="active">About Us</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</nav>
<h1>About Us</h1>
<h2>Our Team</h2>
<p class="team-description">
  This is a mother and son owned business where we provide clothing to our fellow Grenadians, this website's purpose is to make ordering clothes online much easier without having to pay external shipping companies or the port a large sum of money to clear your items. With D'Glamz, any item you order is great quality, on hand and can be delivered to you within 48 hours.
</p>
<div class="team-member">
  <img src="images/founder1.jpeg" alt="Team Member 1"/>
  <div>
    <h3>Atacha Thomas</h3>
    <p>Founder & CEO</p>
  </div>
</div>
<div class="team-member">
  <img src="images/founder2.jpeg" alt="Team Member 2"/>
  <div>
    <h3>Ethan Blackman</h3>
    <p>Chief Developer, Co-Owner</p>
  </div>
</div>
<h2>What People Say</h2>
<div class="vouches">
  <div class="vouch">
    <img src="images/vouch1.jpeg" alt="Happy Customer"/>
    <p class="description">"This shirt is good quality, bang for your buck!"</p>
    <p>- Happy Customer</p>
  </div>
  <div class="vouch">
    <img src="https://via.placeholder.com/600x400" alt="Satisfied Client"/>
    <p class="description">"Exceptional quality and support."</p>
    <p>- Satisfied Client</p>
  </div>
</div>
</body>
</html>