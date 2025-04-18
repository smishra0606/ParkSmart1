<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parking_system";


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);


$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating users table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS parking_spaces (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    space_number VARCHAR(10) NOT NULL UNIQUE,
    space_type ENUM('standard', 'premium', 'reserved') NOT NULL,
    status ENUM('available', 'occupied', 'maintenance') NOT NULL DEFAULT 'available',
    hourly_rate DECIMAL(5,2) NOT NULL DEFAULT 2.00
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating parking_spaces table: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED,
    space_id INT(6) UNSIGNED,
    vehicle_number VARCHAR(20) NOT NULL,
    entry_time DATETIME NOT NULL,
    exit_time DATETIME,
    amount_paid DECIMAL(8,2),
    payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (space_id) REFERENCES parking_spaces(id)
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating bookings table: " . $conn->error;
}


$checkAdmin = "SELECT * FROM users WHERE username = 'admin'";
$result = $conn->query($checkAdmin);

if ($result->num_rows == 0) {
    // Create admin user
    $adminPassword = password_hash("admin123", PASSWORD_DEFAULT);
    $createAdmin = "INSERT INTO users (username, password, email) VALUES ('admin', '$adminPassword', 'admin@parkingsystem.com')";
    
    if ($conn->query($createAdmin) !== TRUE) {
        echo "Error creating admin user: " . $conn->error;
    }
}


$checkSpaces = "SELECT * FROM parking_spaces";
$result = $conn->query($checkSpaces);

if ($result->num_rows == 0) {
    
    for ($i = 1; $i <= 20; $i++) {
        $spaceNumber = 'A' . sprintf("%02d", $i);
        $spaceType = ($i <= 10) ? 'standard' : (($i <= 18) ? 'premium' : 'reserved');
        $rate = ($spaceType == 'standard') ? 2.00 : (($spaceType == 'premium') ? 4.00 : 6.00);
        
        $sql = "INSERT INTO parking_spaces (space_number, space_type, hourly_rate) 
                VALUES ('$spaceNumber', '$spaceType', $rate)";
        
        if ($conn->query($sql) !== TRUE) {
            echo "Error creating sample spaces: " . $conn->error;
            break;
        }
    }
}

$sql = "CREATE TABLE IF NOT EXISTS password_resets (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NULL,
    INDEX (email),
    INDEX (token)
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating password_resets table: " . $conn->error;
}

?>
