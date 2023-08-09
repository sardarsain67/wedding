<?php
$host = 'sql6.freesqldatabase.com';  // MySQL server hostname
$username = 'sql6638506';            // MySQL username
$password = 'xZsxtUZWuv';            // MySQL password
$database = 'sql6638506';            // MySQL database name
$port = 3306;                        // Port number

// Create a new MySQLi object and establish the connection
$conn = mysqli_connect($host, $username, $password, $database, $port);

if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
} 
?>
