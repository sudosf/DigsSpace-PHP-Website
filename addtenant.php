<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tenant</title>
    <link rel="stylesheet" type="text/css" href="forms.css">
    
</head>
<body>
    <div class="container">
  <h2>Add a new tenant</h2> 
    <form action="addtenant.php" method="post">
     <!-- Hidden input field to store user_id -->
     <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
     <div class="form-group">
    <label for="firstname">First Name:</label><br>
    <input type="text" name="firstname" required ><br>
     </div>

     <div class="form-group">
    <label for="lastname">Last Name:</label><br>
    <input type="text" name="lastname" required><br>
     </div>

     <div class="form-group">
    <label for="email">Email:</label><br>
    <input type="text" name="email" required><br>
     </div>

     <div class="form-group">
    <label for="contact">Contact number:</label><br>
    <input type="text" name="contact" maxlength="10" required><br><br>
     </div>

     <div class="form-group">
    <label for="username">Username:</label><br>
    <input type="text" name="username" required><br>
     </div>

     <div class="form-group">
    <label for="password">Password:</label><br>
    <input type="text" name="password" required><br>
     </div>

     <div class="form-group">
    <input type="submit" name="submit" value="Add" class="submit-btn">
     </div>

    </form>
    </div>
    <?php
    // Start the session
    session_start();

    if (isset($_REQUEST['submit']))
    {
        //fetching data from form and storing it
        $firstname = $_REQUEST['firstname'];
        $lastname = $_REQUEST['lastname'];
        $email = $_REQUEST['email'];
        $contact = $_REQUEST['contact'];
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $user_id = $_SESSION['user_id']; // Retrieve user_id from the session
        
        //inserting credential from another php file
        require_once("config.php");
        
        //connect to database
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
        or die("Can't connect to the database");
        
        //storing query
        $query = "INSERT INTO users(firstName, lastName, email, phone_number, username, password_hash, tenant_id)
         VALUE ('$firstname', '$lastname', '$email', '$contact', '$username', '$password', '$user_id')";
         
         $result = mysqli_query($conn, $query);
        
        // Check if the query was successful
    if ($result) {
        echo "<p><strong style=\"color:blue; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">The new tenant was added!</strong></p>";
    } else {
        echo "<strong style=\"color:red; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">Error: Unable to add the tenant.</strong>" . mysqli_error($conn);
    }

        mysqli_close($conn);
    }
    ?>


</body>
</html>