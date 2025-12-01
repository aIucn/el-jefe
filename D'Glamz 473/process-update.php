<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'mywebsite');

    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }

    $user_id = $_SESSION['user_id'];

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email)) {
        die('Username and email are required.');
    }

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param('ssi', $username, $email, $user_id);

    if ($stmt->execute()) {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt_pass = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt_pass->bind_param('si', $hashed_password, $user_id);
            $stmt_pass->execute();
            $stmt_pass->close();
        }
        echo "Account updated successfully.";
    } else {
        echo "Error updating account.";
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: update_account.html');
    exit();
}
?>