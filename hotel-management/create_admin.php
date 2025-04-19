<?php
include('includes/db.php'); // uses your existing DB connection

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT); // encrypt password

$stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

echo "Admin user created successfully!";
?>
