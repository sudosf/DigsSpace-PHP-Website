<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Agent</title>
    <link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
<div class="container">
    <h2>Add a new agent</h2>
    <form action="addagent.php" method="post">
        <!-- Hidden input field to store user_id -->
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <div class="form-group">
            <label for="firstname">First Name:</label><br>
            <input type="text" name="firstname" required><br>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name:</label><br>
            <input type="text" name="lastname" required><br>
        </div>

        <div class="form-group">
            <label for="email">Email:</label><br>
            <input type="email" name="email" required><br>
        </div>

        <div class="form-group">
            <label for="contact">Contact number:</label><br>
            <input type="text" name="contact" maxlength="10"  pattern="[0-9]{10}" title="Please enter a 10-digit contact number"
                   required><br><br>
        </div>

        <div class="form-group">
            <label for="userRole">User Role:</label>
            <select name="userRole" id="userRole">
                <option value="agent">agent</option>
            </select>
        </div><br><br>

        <!-- Hidden input fields for generated username and password -->
        <input type="hidden" name="generated_username" id="generated_username">
        <input type="hidden" name="generated_password" id="generated_password">

        <div class="form-group">
            <input type="submit" name="submit" value="Add" class="submit-btn">
        </div>
    </form>
</div>
<?php

if (isset($_REQUEST['submit'])) {
    // Fetching data from the form and storing it
    $firstname = $_REQUEST['firstname'];
    $lastname = $_REQUEST['lastname'];
    $email = $_REQUEST['email'];
    $contact = $_REQUEST['contact'];
    $user_id = $_SESSION['user_id']; // Retrieve user_id from the session
    $user_role = $_REQUEST['userRole'];

    // Generate a username (e.g., first initial of first name + last name)
    $generated_username = strtolower(substr($firstname, 0, 1) . $lastname);

    // Generate a random password (you can customize this as needed)
    $generated_password = generateRandomPassword();

    // Insert the user data into the database
    require_once("config.php");

    // Connect to the database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

    // Storing the query
    $query = "INSERT INTO users(firstName, lastName, email, phone_number, username, password_hash, admin_id, user_role)
             VALUES ('$firstname', '$lastname', '$email', '$contact', '$generated_username', '$generated_password', '$user_id', '$user_role')";

    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        echo "<p><strong style=\"color:blue; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">The new agent was added!</strong></p>";
        mysqli_close($conn);
    } else {
        echo "Error: " . mysqli_error($conn);
        echo "<strong style=\"color:red; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">Error: Unable to add the agent.</strong>";
       
    }
}

// Function to generate a random password
function generateRandomPassword($length = 4)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $characters_length = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $characters_length - 1)];
    }
    return $password;
}

?>
</body>
</html>
