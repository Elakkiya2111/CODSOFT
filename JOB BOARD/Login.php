<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to check if the user exists in the database
    $sql = "SELECT * FROM your_table_name WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // If the user exists, set session variable and redirect to the employee page
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("location: employee_dashboard.php");
    } else {
        // Invalid credentials, redirect back to login page with error message
        header("location: employee_login.php?error=1");
    }

    $conn->close();
}
?>
