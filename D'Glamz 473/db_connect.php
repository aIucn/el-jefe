<?php
$database = "d'glamz 473";
$conn = new mysqli('localhost', 'root', '', $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>