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

// Check if the company_id is provided in the URL
if (isset($_GET['company_id']) && !empty($_GET['company_id'])) {
    $companyID = $_GET['company_id'];

    // Fetch company details based on the company_id
    $sql = "SELECT * FROM clist WHERE id = '$companyID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $companyData = $result->fetch_assoc();
    } else {
        // Redirect to list_company.php if the company ID is not found
        header("Location: package_details.php");
        exit();
    }
} else {
    // Redirect to list_company.php if the company ID is not provided
    header("Location: home.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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

        .main-content {
            padding: 10px;
        }

        .package-box {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s;
            cursor: pointer;
        }

        .package-box:hover {
            transform: translateY(-10px);
        }

        .company-logo {
            width: 150px;
            height: 120px;
            border-radius: 50%;
            margin: 10px auto;
            display: block;
        }

    </style>





  
  <script language="JavaScript">
        function createobject()
	{
	var ob;
		try
		{
			//create the object

			ob=new XMLHttpRequest();
		}
		catch(e)
		{
			try
			{
				ob=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e)
			{

				try
				{
					ob=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch(e)
				{
					alert("Your broswer doesnot support javascript");
				}
			}
		}
		return ob;
    }   
      /////////////////////////////
      function getCartCount() {
        var ob = createobject();

        ob.onreadystatechange = function() {
            if (ob.readyState == 4 && ob.status == 200) {
                document.getElementById("ecart").innerHTML = ob.responseText;
            }
        };

        var username = "<?php echo addslashes($_SESSION['username']); ?>";

        ob.open("GET", "cart_number.php?username=" + username, true);
        ob.send();
    }
    //////////////////////////
    function addToCart(plan, price, companyName) {
        var confirmation = confirm("Add this plan to cart?");
        if (confirmation) {
            var ob = createobject();

            ob.onreadystatechange = function() {
                if (ob.readyState == 4) {
                    document.getElementById("ecart").innerHTML = ob.responseText;
                }
            };

            var companyID = document.myform.cid.value;
            var username = "<?php echo addslashes($_SESSION['username']); ?>";
            var planID = plan;

            ob.open("GET", "add_to_cart.php?pid=" + planID + "&cid=" + companyID + "&username=" + username + "&price=" + price + "&companyName=" + companyName, true);
            ob.send();
        }
    }


    // Function to open the cart page
    function openCart() {
        window.location.href = "cart.php";
    }

    /////////////////
  
</script>

</head>

<body onload="getCartCount()">
<div class="header">
    <div class="profile-icon">
        <i class="fas fa-user-circle fa-2x"></i>
    </div>
    <a href="#" class="btn btn-primary cart-icon" onclick="openCart()">Cart(<span id="ecart">0</span>)</a>
     <!-- Add the back button link here -->
     <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
    <a href="logout.php" class="btn btn-danger">Log Out</a>
</div>

<!--///////////////////-->

 <!-- Add the hidden input element for companyID -->
 <form name="myform">
 <input type="hidden" id="companyID" name="cid" value="<?php echo $companyID; ?>">
</form>
    
    <div class="main-content">
        <h1 style="color:white">Hello, <?php echo $_SESSION['username']; ?></h1>
        <p style="color:white">Welcome to the Hospitality Management Page!</p>

        <div class="container">
            <div class="row my-5">
             <!-- Display the company logo -->
             <?php if (!empty($companyData['logo_path'])) { ?>
                   <img class="company-logo" src="<?php echo $companyData['logo_path']; ?>" alt="Company Logo">
                 <?php } ?>
                <!-- Company Name and Description -->
                <div class="col-md-12 " style="background-color: rgba(255, 255, 255, 0.9);  border-radius: 10px;">
                    
                    <h2><?php echo $companyData['company_name']; ?></h2>
                    <p><?php echo $companyData['company_description']; ?></p>
                </div>
            </div>

            <!-- Packages Section -->
            <div class="row">
    <div class="col-md-4">
        <div class="package-box" onclick="addToCart('Bronze', '<?php echo $companyData['package_bronze']; ?>', '<?php echo $companyData['company_name']; ?>')">
            <h4>Bronze Plan</h4>
            <p>Price: <?php echo $companyData['package_bronze']; ?></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="package-box" onclick="addToCart('Silver', '<?php echo $companyData['package_silver']; ?>', '<?php echo $companyData['company_name']; ?>')">
            <h4>Silver Plan</h4>
            <p>Price: <?php echo $companyData['package_silver']; ?></p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="package-box" onclick="addToCart('Gold', '<?php echo $companyData['package_gold']; ?>', '<?php echo $companyData['company_name']; ?>')">
            <h4>Gold Plan</h4>
            <p>Price: <?php echo $companyData['package_gold']; ?></p>
        </div>
    </div>
</div>


        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>

</html>

<?php

?>
