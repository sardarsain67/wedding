<?php
// Start the session
session_start();
include_once('server.php');

// Check if the user is not logged in (session is not defined)
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Redirect the user to index.html or any other appropriate page
    header("Location: index.html");
    exit();
}

// Fetch cart items for the logged-in user
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch cart items based on the user_id
    $sql = "SELECT * FROM cart WHERE user_id = '$username'";
    $result = $conn->query($sql);

    // Create an array to store cart items
    $cartItems = array();

    if ($result->num_rows > 0) {
        // Fetch each cart item and add it to the $cartItems array
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }
    }
}

// Check if the cart is empty
$isEmptyCart = empty($cartItems);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
 body {
            background: url('./images/Hospitaility Management.jpg') no-repeat center center fixed;
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
     <!-- Add the back button link here -->
     <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
    <a href="logout.php" class="btn btn-danger">Log Out</a>
</div>
<div class="container">
    <h1>Cart Items</h1>
    <?php if ($isEmptyCart) { ?>
        <p>No plan and item in your cart. Please choose any item or plan.</p>
    <?php } else { ?>
          <table class="table">
            <thead>
                <tr>
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>Plan</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the cart items and display them in a table
                foreach ($cartItems as $item) {
                    echo "<tr>";
                    echo "<td>{$item['company_id']}</td>";
                    echo "<td>{$item['company_name']}</td>";
                    echo "<td>{$item['cart_plan']}</td>";
                    echo "<td>{$item['plan_price']}</td>";
                    echo "<td><button onclick=\"deleteCartItem('{$item['cart_id']}')\">Delete</button></td>";
                   
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary <?php echo $isEmptyCart ? 'disabled' : ''; ?>" onclick="makePayment()" <?php echo $isEmptyCart ? 'disabled' : ''; ?>>Make Payment</button>
        
    <?php } ?>
    <a href="package_details.php" class="btn btn-secondary">Back to Package Details</a>
</div>

<script>
        function deleteCartItem(cartId) {
            var confirmation = confirm("Are you sure you want to delete this item from the cart?");
            if (confirmation) {
                // Send data to the server using AJAX
                $.ajax({
                    type: "POST",
                    url: "delete_cart_item.php",
                    data: {
                        cart_id: cartId
                    },
                    success: function(response) {
                        // Reload the page after successful deletion
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here (if any)
                        console.log("Error deleting item from cart:", error);
                    }
                });
            }
        }



        function makePayment() {
            // Redirect to the payment page
            window.location.href = "payment.php";
        }
    </script>
</body>
</html>
