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
// Start a session
session_start();

    // Include your database connection
    require_once("config.php");

    // Connect to the database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

if (isset($_REQUEST['submit'])) {
    // Retrieve and escape data from the form using mysqli_real_escape_string
    $propertyname = mysqli_real_escape_string($conn, $_REQUEST['propertyname']);
    $location = mysqli_real_escape_string($conn, $_REQUEST['location']);
    $price = mysqli_real_escape_string($conn, $_REQUEST['price']);
    $status = mysqli_real_escape_string($conn, $_REQUEST['status']);
    $category = mysqli_real_escape_string($conn, $_REQUEST['category']);
    $description = mysqli_real_escape_string($conn, $_REQUEST['description']);
    $user_id = $_SESSION['user_id']; // Retrieve user_id from the session


    // Prepare and execute the query to insert property information
    $query = "INSERT INTO properties (property_name, property_description, property_location, property_price, availability_status, property_category, agent_id)
              VALUES ('$propertyname', '$description', '$location', '$price', '$status', '$category', '$user_id')";

    // Check if the property insertion was successful
    if (mysqli_query($conn, $query)) {
        // Get the last inserted property ID
        $propertyId = mysqli_insert_id($conn);

        // Array to store image URLs
        $imageUrls = array();

        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $imageCount = count($_FILES['images']['name']);

            for ($i = 0; $i < $imageCount; $i++) {
                $imageName = time() . '_' . $_FILES['images']['name'][$i];
                $imageTemp = $_FILES['images']['tmp_name'][$i];
                $imageDestination = "imagefolder/" . $imageName;

                if (move_uploaded_file($imageTemp, $imageDestination)) {
                    $imageUrls[] = mysqli_real_escape_string($conn, $imageDestination);
                } else {
                    echo "Failed to upload one or more images.";
                }
            }
        }

        // Insert image URLs and property ID into the 'images' table
        foreach ($imageUrls as $imageUrl) {
            $insertImageQuery = "INSERT INTO images (property_id, user_id, image_url) VALUES ('$propertyId', '$user_id', '$imageUrl')";

            if (!mysqli_query($conn, $insertImageQuery)) {
                echo "<strong>Failed to insert one or more images into the database.</strong>";
            }
        }

        echo "<p><strong style=\"color:blue; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">The new property was added!</strong></p>";
    } else {
        echo "<strong style=\"color:red; text-align:center; position: absolute; top: 5%; left: 50%; transform: translate(-50%, -50%);\">Error: Unable to add the property " . mysqli_error($conn) . ".</strong>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<div class="container">
<h2>Add a new property</h2>
<form action="addproperty.php" method="post" enctype="multipart/form-data">
    <!-- Hidden input field to store user_id -->
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

    <!-- Rest of the form fields -->
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

<div id="image-upload-container">
            <!-- Initial image upload input -->
            <div class="image-upload">
                <label for="images">Image 1:</label>
                <input type="file" name="images[]" id="images" accept="image/*" required>
            </div>
        </div><br>
        <button type="button" id="add-image-button">Add Another Image</button><br><br>

<!-- Submit button -->
<div class="form-group">
    <input type="submit" name="submit" value="Add" class="submit-btn">
</div>

</form>
</div>

<script>
        // JavaScript to dynamically add more image upload inputs
        const addImageButton = document.getElementById('add-image-button');
        const imageUploadContainer = document.getElementById('image-upload-container');
        let imageCount = 1; // Initial image count

        addImageButton.addEventListener('click', () => {
            imageCount++; // Increment the image count
            const newImageUpload = document.createElement('div');
            newImageUpload.classList.add('image-upload');
            newImageUpload.innerHTML = `
                <label for="images">Image ${imageCount}:</label>
                <input type="file" name="images[]" id="images" accept="image/*">
            `;
            imageUploadContainer.appendChild(newImageUpload);
        });
    </script>
</body>
</html>
