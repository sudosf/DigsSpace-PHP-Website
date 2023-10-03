<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Property</title>
</head>
<body>
    <?php
// Start a session
session_start();

// Include your database connection
require_once("config.php");

// Connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

if (isset($_REQUEST['submit'])) {
    // Retrieve data from the form and escape them
    $property_id = mysqli_real_escape_string($conn, $_REQUEST['property_id']);
    $propertyname = mysqli_real_escape_string($conn, $_REQUEST['propertyname']);
    $location = mysqli_real_escape_string($conn, $_REQUEST['location']);
    $price = mysqli_real_escape_string($conn, $_REQUEST['price']);
    $status = mysqli_real_escape_string($conn, $_REQUEST['status']);
    $category = mysqli_real_escape_string($conn, $_REQUEST['category']);
    $description = mysqli_real_escape_string($conn, $_REQUEST['description']);
    $user_id = $_SESSION['user_id']; // Retrieve user_id from the session

    // Check if new images are uploaded
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $imageCount = count($_FILES['images']['name']);
        $imageUrls = array();

        for ($i = 0; $i < $imageCount; $i++) {
            $imageName = time() . '_' . $_FILES['images']['name'][$i];
            $imageTemp = $_FILES['images']['tmp_name'][$i];
            $imageDestination = "imagefolder/" . $imageName;

            if (move_uploaded_file($imageTemp, $imageDestination)) {
                $imageUrls[] = $imageDestination;
            } else {
                echo "Failed to upload one or more images.";
            }
        }

        // Update the 'images' table with new image URLs
        foreach ($imageUrls as $imageUrl) {
            $insertImageQuery = "INSERT INTO images (property_id, user_id, image_url) VALUES ('$property_id', '$user_id', '$imageUrl')";
            $insertImageResult = mysqli_query($conn, $insertImageQuery);

            if (!$insertImageResult) {
                echo "<strong>Failed to insert one or more images into the database.</strong>";
            }
        }
    }

    // Update the property information in the 'properties' table
    $updateQuery = "UPDATE properties SET property_name = '$propertyname', property_description = '$description', property_location = '$location', property_price = '$price', availability_status = '$status', property_category = '$category' WHERE property_id = '$property_id'";
    $updateResult = mysqli_query($conn, $updateQuery);

    // Check if the query was successful
    if ($updateResult) {
        echo "<p><strong style=\"color:blue; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">Property updated successfully!</strong></p>";
    } else {
        echo "<strong style=\"color:red; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">Error: Unable to update the property.</strong>";
    }
}
    // Close the database connection
    mysqli_close($conn);
?>

</body>
</html>
