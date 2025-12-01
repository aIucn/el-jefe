<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
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
<html>
<head>
    <title>Welcome to Your Account</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
    <p>Your email: <?php echo htmlspecialchars($user['email']); ?></p>


    <a href="update_account.php">Update Your Account</a>


    <form action="logout.php" method="post" style="margin-top:20px;">
        <button type="submit">Log Out</button>
    </form>
</body>
</html>