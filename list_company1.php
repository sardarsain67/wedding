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
    <title>Company Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: url('./images/pexels-salah-alawadhi-382297.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #EAEAEA;
        }

        .col-md-4 {
            margin-right: auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
<div class="header">
        <div class="profile-icon">
            <i class="fas fa-user-circle fa-2x"></i>

        </div>
      
        <a href="logout.php" class="btn btn-danger">Log Out</a>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h1 class="text-center">Company Sign Up</h1>
                <form method="post" action="list_company2.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name:</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_logo" class="form-label">Company Logo:</label>
                        <input type="file" class="form-control" id="company_logo" name="company_logo" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_type" class="form-label">Company Type:</label>
                        <select class="form-control" id="company_type" name="company_type" required>
                            <option value="" disabled selected>Select Company Type</option>
                            <option value="hospitality">Hospitality Management</option>
                            <option value="logistic">Logistic Management</option>
                            <option value="fb">Food & Beverage (F&B) Management</option>
                            <option value="venue">Venue Management</option>
                            <option value="artist">Artist Management</option>
                            <option value="event">Event Management</option>
                            <option value="decor">Decor Management</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="company_description" class="form-label">Company Short Description:</label>
                        <textarea class="form-control" id="company_description" name="company_description"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="package_bronze" class="form-label">Package in Bronze Plan:</label>
                        <input type="text" class="form-control" id="package_bronze" name="package_bronze" required>
                    </div>
                    <div class="mb-3">
                        <label for="package_silver" class="form-label">Package in Silver Plan:</label>
                        <input type="text" class="form-control" id="package_silver" name="package_silver" required>
                    </div>
                    <div class="mb-3">
                        <label for="package_gold" class="form-label">Package in Gold Plan:</label>
                        <input type="text" class="form-control" id="package_gold" name="package_gold" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
                <div class="text-center mt-3 my-1">
                    <a href="index.html" class="btn btn-primary">Home Page</a>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript to show alert -->
    <script>
        // Function to get URL parameter by name
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Check for the 'success' parameter in the URL
        var successParam = getUrlParameter('success');
        if (successParam === 'true') {
            alert("Company listed successfully!");
        }
    </script>
</body>

</html>
