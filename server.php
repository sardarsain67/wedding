<?php
$host = 'localhost';          // MySQL server hostname
$username = 'root';  // MySQL username
$password = '';  // MySQL password
$database = 'event';  // MySQL database name

// Create a new MySQLi object and establish the connection
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
} 

?>
