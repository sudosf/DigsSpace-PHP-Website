<?php
// Start a session
session_start();

// fetch database credentials
require_once("config.php");

// connect to the databse
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or 
die("<strong style=\"color: red;\">ERROR:There was a problem connecting to the database!!!</strong>");

// Get values from form and prevent SQL injection
$username = mysqli_escape_string($conn, $_REQUEST['username']);
$password = mysqli_escape_string($conn, $_REQUEST['password']);

// Query the database to verify the username and password
$query = "SELECT * FROM users WHERE username = '$username' and password_hash= '$password'";
$result = mysqli_query($conn, $query) or
 die("<strong style=\"color: red;\">ERROR:There was a problem executing the query!!!</strong>");
 
while( $row = mysqli_fetch_array($result)){
 // check if user exists in the database
 if (mysqli_num_rows($result) == 1) {
        // user exists
        //set sessions variale to allow access to webpages
        $_SESSION['access'] = "yes";
        $_SESSION['user_role'] = $row['user_role'];
        $_SESSION['user_id'] = $row['user_id'];

        // Redirect to the appropriate dashboard based on user role
        if ($_SESSION['user_role'] === 'admin') {
            header("Location: admin_panel.php");
        } elseif ($_SESSION['user_role'] === 'agent') {
            header("Location: agent_panel.php");
        } elseif ($_SESSION['user_role'] === 'tenant') {
            header("Location: tenant_panel.php");
        } 
    } else {
        // User not found
    $_SESSION['login_error'] = "User not found.";
    header("Location: login.php");
}
}

// Close the database connection
mysqli_close($conn);
?>

