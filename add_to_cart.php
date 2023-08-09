<?php
session_start();
include_once('server.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve data from the AJAX request using $_GET
if (isset($_GET['username']) && isset($_GET['cid']) && isset($_GET['pid']) && isset($_GET['price']) && isset($_GET['companyName'])) {
    $username = $_GET['username'];
    $companyID = $_GET['cid'];
    $plan = $_GET['pid'];
    $price = $_GET['price'];
    $companyName = $_GET['companyName'];

    // Escape special characters to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $companyID = mysqli_real_escape_string($conn, $companyID);
    $plan = mysqli_real_escape_string($conn, $plan);
    $price = mysqli_real_escape_string($conn, $price);
    $companyName = mysqli_real_escape_string($conn, $companyName);

    // Save the cart item to the database
    $sql = "INSERT INTO cart (user_id, company_id, cart_plan, plan_price, company_name) VALUES ('$username', $companyID, '$plan', '$price', '$companyName')";
    $result = mysqli_query($conn, $sql);

    // Debug information
    error_log("Received Data - Username: $username, Company ID: $companyID, Plan: $plan, Price: $price, Company Name: $companyName");
    error_log("SQL Query: $sql");

    if ($result) {
        // Fetch the total count of cart rows for the current user
        $totalCountSql = "SELECT COUNT(*) AS total_count FROM cart WHERE user_id = '$username'";
        $totalCountResult = mysqli_query($conn, $totalCountSql);
        $totalCountRow = mysqli_fetch_assoc($totalCountResult);
        $totalCount = $totalCountRow['total_count'];
    
        // Success response for AJAX call
        echo $totalCount;
    } else {
        // Error response for AJAX call
        echo "Error adding item to cart: " . mysqli_error($conn);
    }
}
?>
