<?php
// Database configuration
$host = "localhost"; // MySQL server host (usually "localhost")
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "aastumarket"; // MySQL database name




// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    imagepath VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// if($conn->query($sql)){
//     echo "secess";
// }

// $sql = "CREATE TABLE admins (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) UNIQUE NOT NULL,
//     password VARCHAR(255) NOT NULL
// )";

$password = password_hash('adminpassword', PASSWORD_DEFAULT);
$sql = "INSERT INTO admins (name, email, password) VALUES ('Admin', 'admin@example.com', '$password')";




// Optionally, you can set charset and other configurations here

?>

