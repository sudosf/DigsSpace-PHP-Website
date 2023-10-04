<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to the login page if not logged in
    exit();
}

// Include your database connection configuration
require_once("config.php");

// Connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

// Retrieve user's user_id from the session
$user_id = $_SESSION['user_id'];

// Query to fetch user information
$userQuery = "SELECT * FROM users WHERE user_id = $user_id";
$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_assoc($userResult);

// Check if the user submitted the updated information
if (isset($_POST['update'])) {
    // Get updated user data from the form
    $newFirstName = mysqli_real_escape_string($conn, $_POST['firstname']);
    $newLastName = mysqli_real_escape_string($conn, $_POST['lastname']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['email']);
    $newContact = mysqli_real_escape_string($conn, $_POST['contact']);

    // Update the user's information in the database
    $updateQuery = "UPDATE users SET
        firstName = '$newFirstName',
        lastName = '$newLastName',
        email = '$newEmail',
        phone_number = '$newContact'
        WHERE user_id = $user_id";

    if (mysqli_query($conn, $updateQuery)) {
        // User information updated successfully
        header("Location: profile.php"); // Redirect to the profile page
        exit();
    } else {
        $updateError = "Error updating user information: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="forms.css"> 
</head>
<body>
    <header>
        <!-- Navigation bar or header content goes here -->
    </header>

    <div class="container">
        <h2>Your Profile</h2>
        <?php if (!isset($_POST['edit'])) { ?>
            <!-- Display user information in a read-only form -->
            <form>
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" value="<?php echo $userData['firstName']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" value="<?php echo $userData['lastName']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="<?php echo $userData['email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="contact">Contact number:</label>
                    <input type="text" name="contact" value="<?php echo $userData['phone_number']; ?>" readonly>
                </div>
            </form>
            <!-- Add an "Edit" button to allow the user to edit their information -->
            <form method="POST">
                <input type="submit" name="edit" value="Edit" class="edit-btn">
            </form>
        <?php } else { ?>
            <!-- Display user information in an editable form -->
            <form method="POST" action="profile.php">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" value="<?php echo $userData['firstName']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" value="<?php echo $userData['lastName']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="<?php echo $userData['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact number:</label>
                    <input type="text" name="contact" value="<?php echo $userData['phone_number']; ?>" maxlength="10" required>
                </div>
                <div class="form-group">
                    <input type="submit" name="update" value="Update" class="submit-btn">
                </div>
            </form>
        <?php } ?>

        <?php
        if (isset($updateError)) {
            echo "<p style='color: red;'>$updateError</p>";
        }
        ?>
    </div>

    <footer>
        <!-- Footer content goes here -->
    </footer>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
