<?php
// Start the session
session_start();

// Check if the user is not logged in (session is not defined)
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    // Redirect the user to index.html or any other appropriate page
    header("Location: index.html");
    exit();
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
            background: url('./images/pexels-james-ranieri-2064505.jpg') no-repeat center center fixed;
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
        <a href="#" class="btn btn-primary cart-icon" onclick="openCart()">Cart(<span id="ecart">0</span>)</a>
        <a href="logout.php" class="btn btn-danger">Log Out</a>
    </div>
    <div class="main-content">
        <h1 style="color:white">Hello,
            <?php echo $_SESSION['username']; ?>
        </h1 style="color:white">
        <p style="color:white">Welcome to the Home Page!</p>

        <!-- Services Section -->
        <h2 class="display-4 text-center" style="color:#000; background-color:#EAEAEA">Our Services</h2>
        <section id="services" class="py-5">

            <div class="container">

                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4 service-box">
                            <i class="fas fa-hotel fa-4x text-primary p-4"></i>
                            <div class="card-body">
                                <h5 class="card-title service-name">Hospitality Management</h5>
                                <p class="card-text">We provide comprehensive hospitality management services to make
                                    your event a success.</p>

                                <a href="hospitality.php?type=hospitality" class="btn btn-primary">Visit More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 service-box">
                            <i class="fas fa-truck fa-4x text-primary p-4"></i>
                            <div class="card-body">
                                <h5 class="card-title service-name">Logistic Management</h5>
                                <p class="card-text">We provide comprehensive logistic management services to make your
                                    event a success.</p>
                                <a href="hospitality.php?type=logistic" class="btn btn-primary">Visit More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 service-box">
                            <i class="fas fa-utensils fa-4x text-primary p-4"></i>
                            <div class="card-body">
                                <h5 class="card-title service-name">Food & Beverage (F&B) Management</h5>
                                <p class="card-text">We provide comprehensive food and beverage management services to
                                    make your event a success.</p>
                                <a href="hospitality.php?type=fb" class="btn btn-primary">Visit More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 service-box">
                            <i class="fas fa-university fa-4x text-primary p-4"></i>
                            <div class="card-body">
                                <h5 class="card-title service-name">Venue Management</h5>
                                <p class="card-text">We provide comprehensive venue management services to make your
                                    event a success.</p>
                                <a href="hospitality.php?type=venue" class="btn btn-primary">Visit More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 service-box">
                            <i class="fas fa-user-tie fa-4x text-primary p-4"></i>
                            <div class="card-body">
                                <h5 class="card-title service-name">Artist Management</h5>
                                <p class="card-text">We provide comprehensive artist management services to make your
                                    event a success.</p>
                                <a href="hospitality.php?type=artist" class="btn btn-primary">Visit More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 service-box">
                            <i class="fas fa-calendar-alt fa-4x text-primary p-4"></i>
                            <div class="card-body">
                                <h5 class="card-title service-name">Event Management</h5>
                                <p class="card-text">We help you find the perfect venue for your event based on your
                                    preferences.</p>
                                <a href="hospitality.php?type=event" class="btn btn-primary">Visit More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 service-box">
                            <i class="fas fa-paint-roller fa-4x text-primary p-4"></i>
                            <div class="card-body">
                                <h5 class="card-title service-name">Decor Management</h5>
                                <p class="card-text">Our expert decorators will transform the venue into a magical space
                                    for your event.</p>
                                <a href="hospitality.php?type=decor" class="btn btn-primary">Visit More</a>
                            </div>
                        </div>
                    </div>
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