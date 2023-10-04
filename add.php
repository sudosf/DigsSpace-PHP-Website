<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new property</title>
    <link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
    
<?php
session_start();
require_once("config.php");

$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

if (isset($_REQUEST['submit'])) {
    $propertyname = mysqli_real_escape_string($conn, $_REQUEST['propertyname']);
    $location = mysqli_real_escape_string($conn, $_REQUEST['location']);
    $price = mysqli_real_escape_string($conn, $_REQUEST['price']);
    $status = mysqli_real_escape_string($conn, $_REQUEST['status']);
    $category = mysqli_real_escape_string($conn, $_REQUEST['category']);
    $description = mysqli_real_escape_string($conn, $_REQUEST['description']);
    $user_id = mysqli_real_escape_string($conn, $_REQUEST['agent_id']); // Retrieve agent_id from the form input

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = time() . '_' . $_FILES['image']['name'];
        $imageTemp = $_FILES['image']['tmp_name'];
        $imageDestination = "imagefolder/" . $imageName;

        if (move_uploaded_file($imageTemp, $imageDestination)) {
            $imageDestination = mysqli_real_escape_string($conn, $imageDestination);
            $query = "INSERT INTO properties (property_name, property_description, property_location, property_price, availability_status, property_category, agent_id, image_url)
                      VALUES ('$propertyname', '$description', '$location', '$price', '$status', '$category', '$user_id', '$imageDestination')";

            if (mysqli_query($conn, $query)) {
                echo "<p><strong style=\"color:blue; text-align:center;\">The new property was added!</strong></p>";
            } else {
                echo "<strong style=\"color:red; text-align:center;\">Error: Unable to add the property " . mysqli_error($conn) . ".</strong>";
            }
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "No image selected or upload error.";
    }

    mysqli_close($conn);
}
?>

<div class="container">
<h2>Add a new property</h2>
<form action="add.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    <div class="form-group">
        <label for="propertyname">Property name:</label>
        <input type="text" name="propertyname" id="propertyname" required>
    </div>

    <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required>
    </div>

    <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" name="price" id="price">
    </div>

    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="Available">Available</option>
            <option value="Occupied">Occupied</option>
            <option value="Not Available">Not Available</option>
        </select>
    </div>

    <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="House">House</option>
            <option value="Apartment">Apartment</option>
            <option value="Bachelor Unit">Bachelor Unit</option>
        </select>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="40"></textarea>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
    </div>

    <div class="form-group">
        <abel for="agent_id">Agent ID:</label>
        <input type="text" name="agent_id" id="agent_id" required>
    </div>

    <div class="form-group">
        <input type="submit" name="submit" value="Add" class="submit-btn">
    </div>
</form>
</div>

</body>
</html>
