
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>

<?php include('components/header.php'); ?>

    <div class="login-container">
        <div class="login-header">
            <h2>User Login</h2>
        </div>
        <form class="mb-5" action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required><br><br>
            </div>
            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>
            </div>
            <div class="form-group">
                <input type="submit" class="login-btn" value="Login">
            </div>
        </form>
    </div>

</body>
</html>



<?php
// // Start a session
// session_start();

// // fetch database credentials
// require_once("config.php");

// // connect to the databse
// $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or 
// die("<strong style=\"color: red;\">ERROR:There was a problem connecting to the database!!!</strong>");

// // Get values from form and prevent SQL injection
// $username = mysqli_escape_string($conn, $_REQUEST['username']);
// $password = mysqli_escape_string($conn, $_REQUEST['password']);

// // Query the database to verify the username and password
// $query = "SELECT * FROM users WHERE username = '$username' and password_hash= '$password'";
// $result = mysqli_query($conn, $query) or
//  die("<strong style=\"color: red;\">ERROR:There was a problem executing the query!!!</strong>");
 
// while( $row = mysqli_fetch_array($result)){
//  // check if user exists in the database
//  if (mysqli_num_rows($result) == 1) {
//         // user exists
//         //set sessions variale to allow access to webpages
//         $_SESSION['access'] = "yes";
//         $_SESSION['user_role'] = $row['user_role'];
//         $_SESSION['user_id'] = $row['user_id'];

//         // Redirect to the appropriate dashboard based on user role
//         if ($_SESSION['user_role'] === 'admin') {
//             header("Location: admin_panel.php");
//         } elseif ($_SESSION['user_role'] === 'agent') {
//             header("Location: agent_panel.php");
//         } elseif ($_SESSION['user_role'] === 'tenant') {
//             header("Location: tenant_panel.php");
//         } 
//     } else {
//         // User not found
//     $_SESSION['login_error'] = "User not found.";
//     header("Location: login.php");
// }
// }

// // Close the database connection
// mysqli_close($conn);
?>