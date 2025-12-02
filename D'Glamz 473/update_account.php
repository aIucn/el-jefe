<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'mywebsite');

    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];

    $result = $conn->query("SELECT * FROM users WHERE id = $user_id");
    if ($result->num_rows === 0) {
        $conn->close();
        die('Account does not exist.');
    }
    $current_user = $result->fetch_assoc();

    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_password = trim($_POST['password']);

    $changes = [];

    if ($new_username !== $current_user['username']) {
        $changes[] = "Username";
    }

    if ($new_email !== $current_user['email']) {
        $changes[] = "Email";
    }

    if (!empty($new_password)) {
        $changes[] = "Password";
    }

    if (empty($changes)) {
        $conn->close();
        echo "No changes detected.";
        exit();
    }

    if (empty($new_username) || empty($new_email)) {
        $conn->close();
        die('Username and email are required.');
    }

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param('ssi', $new_username, $new_email, $user_id);

    if ($stmt->execute()) {
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt_pass = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt_pass->bind_param('si', $hashed_password, $user_id);
            $stmt_pass->execute();
            $stmt_pass->close();
        }
        $_SESSION['username'] = $new_username;
        $_SESSION['email'] = $new_email;

        $stmt->close();
        $conn->close();

        header('Location: homepage.php');
        exit();
    } else {
        $stmt->close();
        $conn->close();
        echo "Error updating account.";
    }
} else {
    header('Location: update_account.php');
    exit();
}
?>