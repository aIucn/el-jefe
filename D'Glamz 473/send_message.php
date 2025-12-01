<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Message Sent</title>
        <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            --accent-color: #7b2ff7;
            --light-text: #ffffff;
            --dark-background: #0f2027;
        }
        body {
            font-family: "Arial", sans-serif;
            background-color: var(--dark-background);
            color: var(--light-text);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }
        .message-box {
            background-color: #222;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.7);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }
        a {
            text-decoration: none;
            margin-top: 30px;
            display: inline-block;
        }
        .btn {
            padding: 12px 25px;
            background: linear-gradient(135deg, #7b2ff7, #f107a3);
            color: #fff;
            border-radius: 25px;
            font-weight: bold;
            transition: background 0.3s, transform 0.3s;
        }
        .btn:hover {
            background: linear-gradient(135deg, #f107a3, #7b2ff7);
            transform: scale(1.05);
        }
        </style>
        </head>
        <body>
            <div class="message-box">
                <h2>Thank you for your message! An admin will email you addressing your requirements.</h2>
                <a href="homepage.php" class="btn">Back to Home</a>
            </div>
        </body>
        </html>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: contact.php");
    exit();
}
?>