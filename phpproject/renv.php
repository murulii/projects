<?php
// Database connection details
$host = 'localhost'; // getenv('readhost');
$username = 'root';
$password = '';
$database = 'muruli';
$table = 'data';
$column = 'first';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
