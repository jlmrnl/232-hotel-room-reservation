<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (empty)
$dbname = "hotel_reservation";

// Create connection (without specifying database)
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it does not exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Check if the users table exists
$tableCheck = $conn->query("SHOW TABLES LIKE 'users'");
if ($tableCheck->num_rows == 0) {
    // Create users table if it does not exist
    $sql = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    if ($conn->query($sql) !== TRUE) {
        die("Error creating users table: " . $conn->error);
    }
}

// Check if the bookings table exists
$tableCheck = $conn->query("SHOW TABLES LIKE 'bookings'");
if ($tableCheck->num_rows == 0) {
    // Create bookings table if it does not exist
    $sql = "CREATE TABLE bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_email VARCHAR(255) NOT NULL,
        room_type VARCHAR(50) NOT NULL,
        check_in DATE NOT NULL,
        check_out DATE NOT NULL,
        FOREIGN KEY (user_email) REFERENCES users(email) ON DELETE CASCADE
    )";
    if ($conn->query($sql) !== TRUE) {
        die("Error creating bookings table: " . $conn->error);
    }
}

?>