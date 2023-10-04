<?php
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <h2>User Login</h2>
        </div>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required><br><br>
            </div>
            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="login-btn" value="Login">
            </div>
        </form>

    </div>

    

    <?php
    if (isset($_POST['submit'])) {
        // fetch database credentials
        require_once("config.php");

        // connect to the databse
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or 
        die("<strong style=\"color: red;\">ERROR: There was a problem connecting to the database!!!</strong>");

        // Get values from form and prevent SQL injection
        $username = mysqli_escape_string($conn, $_REQUEST['username']);
        $password = mysqli_escape_string($conn, $_REQUEST['password']);

        // Query the database to verify the username and password
        $query = "SELECT * FROM users WHERE username = '$username' AND password_hash = '$password'";
        $result = mysqli_query($conn, $query) or
        die("<strong style=\"color: red;\">ERROR: There was a problem executing the query!!!</strong>");

        // Check if user exists in the database
        if (mysqli_num_rows($result) == 1) {
            // User exists
            // Set session variables to allow access to webpages
            $row = mysqli_fetch_array($result);
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
        
            echo '<script>alert("Incorrect username or password.");</script>';

        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

</body>
</html>
