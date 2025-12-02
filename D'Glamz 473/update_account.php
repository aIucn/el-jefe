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
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Update Your Account</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Arial&display=swap" rel="stylesheet" />
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
    background-image: url('https://i.pinimg.com/originals/ca/92/06/ca92068e40ef52cadf49ea1d0a98bf6c.gif');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
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
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.navbar ul {
    list-style: none;
    display: flex;
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
.user-info-container {
    display: flex;
    align-items: center;
}
.user-info-box {
    margin-left: 10px;
    font-weight: bold;
}
.logout-btn {
    margin-left: 10px;
    padding: 4px 8px;
    border: 1px solid var(--accent-color);
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    color: #fff;
    transition: background 0.3s;
}
.logout-btn:hover {
    background: var(--accent-color);
}
.page-title {
    text-align: center;
    padding: 40px 20px;
    font-size: 2.5rem;
    color: var(--light-text);
}
.form-container {
    max-width: 500px;
    margin: 0 auto 50px auto;
    background-color: #222;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.7);
}
.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 2rem;
}
form {
    display: flex;
    flex-direction: column;
}
label {
    margin-bottom: 5px;
    font-weight: bold;
}
input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #555;
    border-radius: 5px;
    background-color: #333;
    color: #fff;
}
button {
    padding: 12px;
    background: linear-gradient(135deg, #7b2ff7, #f107a3);
    color: #fff;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.3s, transform 0.3s;
}
button:hover {
    background: linear-gradient(135deg, #f107a3, #7b2ff7);
    transform: scale(1.05);
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
<nav class="navbar">
    <div class="user-info-container" style="display:flex; align-items:center;">
        <a href="update_account.php" style="text-decoration:none; color:inherit;">
            <button style="background:none; border:none; cursor:pointer; font-size:24px; color:#fff;">
                <i class="fas fa-user-circle"></i>
            </button>
        </a>
        <?php if (isset($user)): ?>
            <div class="user-info-box"><?php echo htmlspecialchars($user['username']); ?></div>
            <a href="logout.php" class="logout-btn">Log Out</a>
        <?php endif; ?>
    </div>
    <ul>
        <li><a href="homepage.php" class="active">Home</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</nav>
<div class="page-title">
    <h2>Update Your Account</h2>
</div>
<div class="form-container">
    <form action="update_account_process.php" method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required />

        <label for="password">New Password (leave blank to keep current)</label>
        <input type="password" id="password" name="password" />

        <button type="submit">Update</button>
    </form>
</div>
<footer>
    <p>&copy; 2025 D'Glamz 473. All rights reserved.</p>
</footer>
</body>
</html>