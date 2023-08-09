<?php
session_start();
include_once('server.php');

// Check if the user is not logged in (session is not defined)
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Redirect the user to index.html or any other appropriate page
    header("Location: index.html");
    exit();
}

// Check if cart_id is provided in the POST data
if (isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];

    // Escape special characters to prevent SQL injection
    $cartId = mysqli_real_escape_string($conn, $cartId);

    // Delete the cart item from the database
    $sql = "DELETE FROM cart WHERE cart_id = '$cartId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Success response for AJAX call
        echo "Item deleted from cart successfully!";
    } else {
        // Error response for AJAX call
        echo "Error deleting item from cart: " . mysqli_error($conn);
    }
}
?>
