<?php
// Start the session
session_start();
// Check if the user is not logged in (session is not defined)
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Redirect the user to index.html or any other appropriate page
    header("Location: index.html");
    exit();
}
include_once('server.php');

// Include cart.php to use the calculateTotalPriceForUser function
//include_once('cart.php');



// Fetch the username from the session
$username = $_SESSION['username'];


// Function to calculate the total price of cart items for the logged-in user
function calculateTotalPriceForUser($conn, $username) {
    $totalPrice = 0;

    // Fetch cart items based on the user_id
    $sql = "SELECT SUM(plan_price) AS total_price FROM cart WHERE user_id = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalPrice = $row['total_price'];
    }

    return $totalPrice;
}


// Calculate the total price for the logged-in user
$totalPrice = calculateTotalPriceForUser($conn, $username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Dashboard</title>
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
     <!-- Add the back button link here -->
     <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
    <a href="logout.php" class="btn btn-danger">Log Out</a>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Payment Details</h3>
                </div>
                <div class="card-body">
                    <p class="mb-4">Total Price: <input type="text" value="<?php echo $totalPrice; ?>" class="form-control" readonly></p>
                    <h5>Select Payment Method:</h5>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="creditCard">
                        <label class="form-check-label" for="creditCard">Credit Card</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="debitCard" value="debitCard">
                        <label class="form-check-label" for="debitCard">Debit Card</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="upi" value="upi">
                        <label class="form-check-label" for="upi">UPI</label>
                    </div>
                    <button type="button" class="btn btn-primary">Proceed to Payment</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add event listener to the "Proceed to Payment" button
    document.querySelector('.btn-primary').addEventListener('click', function() {
        var selectedMethod = document.querySelector('input[name="paymentMethod"]:checked');
        if (!selectedMethod) {
            // Show alert if no payment method is selected
            alert("Please select a payment method.");
            return;
        }

        var confirmation = confirm("Are you sure you want to proceed with the payment using " + selectedMethod.value + "?");
        if (confirmation) {
            // Show thank you page or process the payment here
            // For demonstration purposes, we'll just show an alert
            alert("Thank you for your payment!");


////
 // Call a function to delete cart items after successful payment
 //deleteCartItems();
            // Redirect to thank.php after showing the alert
            window.location.href = "thank.php";
        }
    });


    ///////////
    /*
    function deleteCartItems() {
        // Send data to the server using AJAX to delete cart items
        $.ajax({
            type: "POST",
            url: "delete_cart_items.php",
            success: function(response) {
                // Cart items successfully deleted
                console.log("Cart items deleted successfully.");
            },
            error: function(xhr, status, error) {
                // Handle errors here (if any)
                console.log("Error deleting cart items:", error);
            }
        });
    }

*/
</script>


</body>
</html>
