<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Property</title>
</head>
<body>
<?php
session_start();

// Check if the user is logged in (modify this as per your authentication logic)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to the login page or appropriate authentication page
    exit();
}

if (isset($_REQUEST['id'])) {
    $propertyId = $_REQUEST['id'];

    // Include your database connection (modify the path if necessary)
    require_once("config.php");

    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE);

    // Check if the connection was established successfully
    if (!$conn) {
        die("Can't connect to the database");
    }

    // Prepare and execute the query to soft delete the property by setting the 'deleted' flag to 1
    $deleteQuery = "UPDATE properties SET deleted = 1 WHERE property_id = $propertyId";
    $result = mysqli_query($conn, $deleteQuery);

    // Check if the query was successful
    if ($result) {
        echo "<p><strong style=\"color:blue; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">The property was marked as deleted!</strong></p>";
    } else {
        echo "<strong style=\"color:red; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">Error: Unable to mark the property as deleted. " . mysqli_error($conn) . "</strong>";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Property ID not provided.";
}
?>


</body>
</html>
<?php
