<?php
session_start();
include_once('server.php');

// Check if the user is not logged in (session is not defined)
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Redirect the user to index.html or any other appropriate page
    header("Location: index.html");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve data from the AJAX request using $_GET
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Escape special characters to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);

    // Fetch the total count of cart rows for the current user
    $totalCountSql = "SELECT COUNT(*) AS total_count FROM cart WHERE user_id = '$username'";
    $totalCountResult = mysqli_query($conn, $totalCountSql);
    $totalCountRow = mysqli_fetch_assoc($totalCountResult);
    $totalCount = $totalCountRow['total_count'];

    // Success response for AJAX call
    echo $totalCount;
}
?>
