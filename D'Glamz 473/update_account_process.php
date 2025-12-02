<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'db.php';
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_password = trim($_POST['password']);
    if (empty($new_username) || empty($new_email)) {
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
        $stmt->close();
        $_SESSION['username'] = $new_username;
        $_SESSION['email'] = $new_email;
        $conn->close();
        header('Location: homepage.php');
        exit();
    } else {
        $conn->close();
        die('Error updating account.');
    }
} else {
    header('Location: homepage.php');
    exit();
}
?>