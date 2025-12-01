<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        $success = "Registration successful! <a href='login.php'>Click here to login</a>";
    } else {
        if ($conn->errno == 1062) {
            $error = "Username or email already exists.";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Register</title>
<style>
:root {
  --dark-background: #0f2027;
  --light-text: #ffffff;
  --accent-color: #7b2ff7;
}
body {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
  background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)),
              url('https://i.pinimg.com/originals/ca/92/06/ca92068e40ef52cadf49ea1d0a98bf6c') no-repeat center/cover;
  height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.navbar {
  width: 100%;
}
.container {
  background-color: rgba(15, 32, 39, 0.8);
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.3);
  max-width: 400px;
  width: 90%;
  margin-top: 20px;
  text-align: center;
}
h2 {
  margin-bottom: 20px;
  font-size: 2rem;
  color: var(--light-text);
}
form {
  display: flex;
  flex-direction: column;
}
label {
  margin-bottom: 8px;
  font-weight: bold;
}
input[type="text"],
input[type="email"],
input[type="password"] {
  padding: 12px;
  margin-bottom: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
  background-color: #222;
  color: var(--light-text);
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
.error {
  color: #f00;
  margin-top: 15px;
}
.success {
  color: #0f0;
  margin-top: 15px;
}
</style>
</head>
<body>
<nav class="navbar">
  <ul>
    <li><a href="homepage.php">Home</a></li>
    <li><a href="aboutus.php">About Us</a></li>
    <li><a href="shop.php">Shop</a></li>
    <li><a href="contact.php">Contact</a></li>
  </ul>
</nav>
<div class="container">
<h2>Register</h2>
<?php
if (isset($error)) { echo "<div class='error'>$error</div>"; }
if (isset($success)) { echo "<div class='success'>$success</div>"; }
?>
<form action="register.php" method="POST">
<label for="username">Username:</label>
<input type="text" id="username" name="username" required />
<label for="email">Email:</label>
<input type="email" id="email" name="email" required />
<label for="password">Password:</label>
<input type="password" id="password" name="password" required />
<button type="submit">Register</button>
</form>
</div>
</body>
</html>