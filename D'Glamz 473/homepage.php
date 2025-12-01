<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'db.php';
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Welcome to Your Account</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Arial&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="homepage.css" />
<style>
:root {
    --primary-gradient: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    --accent-color: #7b2ff7;
    --light-text: #ffffff;
    --dark-background: #0f2027;
}
body {
    font-family: 'Arial', sans-serif;
    background-color: var(--dark-background);
    color: var(--light-text);
    line-height: 1.6;
    margin: 0;
    padding: 0;
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
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
        url('https://i.pinimg.com/originals/ca/92/06/ca92068e40ef52cadf49ea1d0a98bf6c.gif') no-repeat center/cover;
    height: 80vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.hero h1 {
    font-size: 3rem;
    color: var(--light-text);
    margin-bottom: 20px;
}
.hero p {
    font-size: 1.2rem;
    color: var(--light-text);
    margin-bottom: 30px;
}
.btn {
    background: linear-gradient(135deg, #7b2ff7, #f107a3);
    color: #fff;
    padding: 12px 25px;
    text-decoration: none;
    border-radius: 25px;
    font-weight: bold;
    transition: background 0.3s, transform 0.3s;
}
.btn:hover {
    background: linear-gradient(135deg, #f107a3, #7b2ff7);
    transform: scale(1.05);
}
.categories {
    padding: 50px 20px;
    background-color: #111;
    text-align: center;
}
.categories h2 {
    margin-bottom: 30px;
    font-size: 2rem;
    color: var(--light-text);
}
.category-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
}
.category-card {
    background-color: #222;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.7);
    width: 250px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
}
.category-card:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0,0,0,0.9);
}
.category-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    transition: opacity 0.5s;
}
.category-card h3 {
    padding: 15px;
    text-align: center;
    font-size: 1.2rem;
    color: var(--light-text);
}
footer {
    background: linear-gradient(135deg, #0f2027, #203a43);
    text-align: center;
    padding: 20px;
    margin-top: 40px;
    font-size: 0.9rem;
    color: var(--light-text);
}
</style>
</head>
<body>
<div style="position: fixed; top: 10px; left: 10px; z-index: 1000; display: flex; flex-direction: column; align-items: flex-start;">
    <a href="update_account.php" style="text-decoration:none; color: inherit;">
        <button style="background: none; border: none; cursor: pointer; font-size: 24px; color: #333;">
            <i class="fas fa-user-circle"></i>
        </button>
    </a>
<?php if (isset($user)): ?>
    <span style="margin-top: 8px; font-weight: bold; font-size: 1.2em; color: #333;"><?php echo htmlspecialchars($user['username']); ?></span>
    <form action="logout.php" method="POST" style="margin-top: 8px;">
        <button type="submit" style="background: none; border: 1px solid #333; padding: 4px 8px; cursor: pointer; font-size: 1em;">Log Out</button>
    </form>
<?php endif; ?>
</div>
<nav class="navbar">
    <ul>
        <li><a href="homepage.php" class="active">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>
<header class="hero">
    <h1>Welcome to D'Glamz 473</h1>
    <p>Stylish clothing for every occasion</p>
    <a href="shop.php" class="btn">Shop Now</a>
</header>
<section class="categories">
    <h2>Shop by Category</h2>
    <div class="category-container">
        <a href="shop.php" style="text-decoration: none; color: inherit;">
            <div class="category-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/069/317/401/small/a-black-silhouette-of-a-man-standing-in-front-of-a-white-background-free-vector.jpg" alt="Men Fashion" />
                <h3>Men</h3>
            </div>
        </a>
        <a href="shop.php" style="text-decoration: none; color: inherit;">
            <div class="category-card animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
                <img src="https://previews.123rf.com/images/anartelman/anartelman1803/anartelman180300835/98519499-woman-silhouette-icon-on-white-background.jpg" alt="Women Fashion" />
                <h3>Women</h3>
            </div>
        </a>
        <a href="shop.php" style="text-decoration: none; color: inherit;">
            <div class="category-card animate__animated animate__fadeInUp" style="animation-delay: 0.6s;">
                <img src="https://static.vecteezy.com/system/resources/previews/008/956/590/non_2x/creative-abstract-black-silhouette-running-shoe-design-logo-design-template-free-vector.jpg" alt="Shoes" />
                <h3>Shoes</h3>
            </div>
        </a>
    </div>
</section>
<footer>
    <p>&copy; 2025 D'Glamz 473. All rights reserved.</p>
</footer>
</body>
</html>