<?php
// Database connection settings
$servername = "localhost";  // Replace with your database host (usually 'localhost')
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "shopbillingsystem";    // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>