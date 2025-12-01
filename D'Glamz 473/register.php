<?php
session_start();
include 'db_connect.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prevent empty fields
if (empty($username) || empty($password)) {
    echo "All fields are required.";
    exit;
}

// Check if username already exists
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Username already taken.";
    exit;
}

// Hash password BEFORE saving
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("s", $username, $hashedPassword);

if ($stmt->execute()) {
    echo "Account created successfully.";
    // redirect if you want:
    // header("Location: login.html");
} else {
    echo "Error creating account.";
}

$stmt->close();
$conn->close();
?>