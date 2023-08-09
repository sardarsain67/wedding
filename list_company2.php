<?php
include_once('server.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $companyName = $_POST['company_name'];
    $companyType = $_POST['company_type'];
    $companyDescription = $_POST['company_description'];
    $packageBronze = $_POST['package_bronze'];
    $packageSilver = $_POST['package_silver'];
    $packageGold = $_POST['package_gold'];

    // File upload handling
    $uploadDir = 'logos/'; // Directory to store uploaded logos
    $uploadedFile = $_FILES['company_logo']['tmp_name'];
    $logoName = $_FILES['company_logo']['name'];
    $logoPath = $uploadDir . $logoName;

    // Create the "logos" directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($uploadedFile, $logoPath)) {
        // Prepare and execute the SQL query to insert data into the database using prepared statements
        $stmt = $conn->prepare("INSERT INTO clist (company_name, company_type, company_description, package_bronze, package_silver, package_gold, logo_path) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $companyName, $companyType, $companyDescription, $packageBronze, $packageSilver, $packageGold, $logoPath);

        if ($stmt->execute()) {
            // Redirect to list_company.html with a success flag in the URL
            header("Location: list_company1.php?success=true");
            exit(); // Ensure no further output is sent
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error uploading logo. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
