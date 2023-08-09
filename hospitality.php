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

// Check if the 'type' parameter is set in the URL
if (isset($_GET['type'])) {
    // Retrieve the 'type' parameter from the URL
    $type = $_GET['type'];

    // Perform a search query based on the 'type' parameter
    $sql = "SELECT * FROM clist WHERE company_type = '$type'";
    $result = $conn->query($sql);

    // Process the search results here
    // ...
} else {
    // If the 'type' parameter is not set, display all companies
    $sql = "SELECT * FROM clist";
    $result = $conn->query($sql);

    // Display all companies here
    // ...
}
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

        .service-box {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s;
        }

        .service-box:hover {
            transform: translateY(-10px);
        }

        .service-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .service-box img{
            width:100px;
            height: 100px;
            border-radius:50%;
        }

        .service-icon {
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
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
 // Function to open the cart page
 function openCart() {
        window.location.href = "cart.php";
    }
        </script>
</head>
<body onload="getCartCount()">
<div class="header">
    <div class="profile-icon">
        <i class="fas fa-user-circle fa-2x"></i>
    </div>

    <!-- Add the back button link here -->
    <a href="#" class="btn btn-primary cart-icon" onclick="openCart()">Cart(<span id="ecart">0</span>)</a>
    <a href="javascript:history.back()" class="btn btn-secondary">Back</a>


    <a href="logout.php" class="btn btn-danger">Log Out</a>
</div>

    <div class="main-content">
        <h1 style="color:white">Hello,
            <?php echo $_SESSION['username']; ?>
        </h1 style="color:white">
        <p style="color:white">Welcome to the All in one service Management Page!</p>

        <!-- Services Section -->
        <h2 class="display-4 text-center" style="color:#000; background-color:#EAEAEA">Visit Our Listed Companies</h2>
        <section id="services" class="py-5">
            <div class="container">
                <div class="row">
                    <?php
                    // Loop through the result set and display company details
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-4">
                            <div class="card mb-4 service-box">
                                <!-- Display company logo using the logo_path from the database -->
                                <img class="align-item-center mx-auto" src="<?php echo $row['logo_path']; ?>" width="150px">
                                <div class="card-body">
                                    <!-- Display company name and description from the database -->
                                    <h5 class="card-title service-name"><?php echo $row['company_name']; ?></h5>
                                    <p class="card-text"><?php echo $row['company_description']; ?></p>
                                   <!-- Inside the while loop that displays companies -->
                              <a href="package_details.php?company_id=<?php echo $row['id']; ?>" class="btn btn-primary">Check Packages</a>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</body>
</html>

<?php

?>
