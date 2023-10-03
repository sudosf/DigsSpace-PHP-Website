<?php
session_start();

// Check if the user is logged in 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to the login page 
    exit();
}

// Check if the property ID is provided in the URL
if (isset($_REQUEST['id'])) {
    $propertyId = $_REQUEST['id'];

    // Add database credentials
    require_once('config.php');

    // Connect to the database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("There was a problem connecting to the database!");

    // Query to fetch the property details based on the provided ID
    $query = "SELECT * FROM properties WHERE property_id = $propertyId";

    // Execute the query
    $result = mysqli_query($conn, $query) or die('There was a problem fetching property details!');

    // Check if a property with the provided ID exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Retrieve existing image URLs associated with the property from the images table
        $imageQuery = "SELECT * FROM images WHERE property_id = $propertyId";
        $imageResult = mysqli_query($conn, $imageQuery);

        // An array to store the image URLs
        $imageUrls = array();
        while ($imageRow = mysqli_fetch_array($imageResult)) {
            $imageUrls[] = $imageRow['image_url'];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Property</title>
    <link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
<div class="container">
    <h2>Edit Property</h2>
    <form action="update_property.php" method="POST" enctype="multipart/form-data">
        <!-- Hidden input field to store property_id -->
        <input type="hidden" name="property_id" value="<?php echo $row['property_id']; ?>">

        <div class="form-group">
            <label for="propertyname">Property name:</label>
            <input type="text" name="propertyname" id="propertyname" value="<?php echo $row['property_name']; ?>">
        </div>

        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" value="<?php echo $row['property_location']; ?>">
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" placeholder="xxxx.xx" value="<?php echo $row['property_price']; ?>">
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="Available" <?php if ($row['availability_status'] === 'Available') echo 'selected'; ?>>Available</option>
                <option value="Occupied" <?php if ($row['availability_status'] === 'Occupied') echo 'selected'; ?>>Occupied</option>
                <option value="Not Available" <?php if ($row['availability_status'] === 'Not Available') echo 'selected'; ?>>Not Available</option>
            </select>
        </div>

        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="House" <?php if ($row['property_category'] === 'House') echo 'selected'; ?>>House</option>
                <option value="Apartment" <?php if ($row['property_category'] === 'Apartment') echo 'selected'; ?>>Apartment</option>
                <option value="Bachelor Unit" <?php if ($row['property_category'] === 'Bachelor Unit') echo 'selected'; ?>>Bachelor Unit</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" cols="40"><?php echo $row['property_description']; ?></textarea>
        </div>

        <div class="form-group" id="image-upload-container">
    <label for="images">Image 1:</label>
    <input type="file" name="images[]" id="images" accept="image/*">
</div>
        <!-- Display existing images associated with the property -->
        <?php foreach ($imageUrls as $imageUrl) { ?>
            <div class="image-preview">
                <img src="<?php echo $imageUrl; ?>" alt="Property Image">
            </div>
        <?php } ?>

        <button type="button" id="add-image-button">Add Another Image</button><br><br>
        
        <div class="form-group">
            <input type="submit" name="submit" value="Update" class="submit-btn">
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
<?php
    } else {
        echo "Property not found.";
    }

    // Disconnect from the database
    mysqli_close($conn);
} else {
    echo "Property ID not provided.";
}
?>
