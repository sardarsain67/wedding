

<?php

// Start the session
session_start();

// Check if the user is logged in (session is defined)
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Redirect the user to index.html or any other appropriate page
    header("Location: index.html");
    exit();
}

include_once('server.php');

// Fetch the username from the session
$username = $_SESSION['username'];

// Delete all cart items for the logged-in user
$sql = "DELETE FROM cart WHERE user_id = '$username'";
if ($conn->query($sql) === TRUE) {
    // Cart items successfully deleted
    //echo "Cart items deleted successfully.";
} else {
    // Error deleting cart items
    echo "Error deleting cart items: " . $conn->error;
}

// Close the database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
 body {
            background: url('./images/payment.jpg') no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #EAEAEA;
        }

        .table tr td{
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        a{
            padding:0.1rem;
            color:#000;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        </style>
</head>
<body>
<div class="header">
    <div class="profile-icon">
        <i class="fas fa-user-circle fa-2x"></i>
    </div>
    <!--<a href="#" class="btn btn-primary cart-icon" onclick="openCart()">Cart(<span id="ecart">0</span>)</a>-->
    <a href="logout.php" class="btn btn-danger">Log Out</a>
</div>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Thank You, <?php echo $username; ?>!</h3>
        </div>
        <div class="card-body">
            <p>Thank you for your payment. We appreciate your business!</p>
            <a href="home.php" class="btn btn-primary">Back to Home</a>
            <!-- Add more buttons for other pages if needed -->
        </div>
    </div>
</div>
</body>
</html>
