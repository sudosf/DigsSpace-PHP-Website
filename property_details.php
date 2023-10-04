<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details</title>
</head>
<body>
<?php
session_start();

// Include your database connection
require_once("server/config.php");

// Connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

// Get the property ID from the query string or another source
$propertyId = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if ($propertyId) {
    // Query to retrieve property details
    $query = "SELECT * FROM properties WHERE property_id = $propertyId";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $property = mysqli_fetch_array($result);

        // Display property details
        echo "<h1>{$property['property_name']}</h1>";
        echo "<p>Location: {$property['property_location']}</p>";
        echo "<p>Price: {$property['property_price']}</p>";
        echo "<p>Status: {$property['availability_status']}</p>";
        echo "<p>Category: {$property['property_category']}</p>";
        echo "<p>Description: {$property['property_description']}</p>";
        echo "<a href='Star_rating_system.php?id=" . $property['property_id'] . "'><button>Rate Property</button></a><br><br>";
        
        // Retrieve property images
        $imageQuery = "SELECT * FROM images WHERE property_id = $propertyId";
        $imageResult = mysqli_query($conn, $imageQuery);

        if ($imageResult && mysqli_num_rows($imageResult) > 0) {
            // Display property images
            echo "<div class='property-images'>";
            while ($image = mysqli_fetch_array($imageResult)) {
                echo "<img src='{$image['image_url']}' alt='Property Image'>";
            }
            echo "</div>";
        } else {
            echo "No images available for this property.";
        }
    } else {
        echo "Property not found.";
    }
} else {
    echo "Invalid property ID.";
}

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>
