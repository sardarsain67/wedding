<?php
include_once('server.php');
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $username = $_POST['username'];
    $security_answer = $_POST['security_answer'];

    // Prepare the SQL query to check the username and security answer
    $sql = "SELECT * FROM userlogin WHERE username = '$username' AND sec_answer = '$security_answer'";
    $result = mysqli_query($conn, $sql);

    // Check if a matching row was found
    if (mysqli_num_rows($result) > 0) {
        // Valid security answer, fetch the password
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];

        // Redirect to signin.html with the password as a query parameter
        header("Location: signin.html?password=$password");
        exit();
    } else {
        // Invalid security answer, redirect to forgot.html with an error flag
        header("Location: forgot.html?error=1");
        exit();
    }
}
?>
