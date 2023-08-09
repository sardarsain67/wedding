<?php

include('server.php');
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];

   

    // Prepare the SQL query to insert the user data into the loginuser table
    $sql = "INSERT INTO userlogin (username, password, sec_answer) VALUES ('$username', '$password', '$security_answer')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Signup successful, show an alert and redirect to login page
        echo "<script>alert('Signup successful! Please login with your new account.');</script>";
        header("Location: signin.html");
        exit();
    } else {
        // Error in inserting data
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    
}
?>
