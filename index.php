<?php  session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="css/styles.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    	<!-- Font Awesome -->
	<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>DigSpace</title>

    <style>
        /* Style the navbar menu items */
        .menu {
            float: right;
        }

        /* Add some space between the menu items */
        .menu a {
            margin-left: 1px; /* Reduce margin */
        }

        .property-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .property {
            width: calc(20% - 15px); /* Adjust the width as needed */
            margin: 10px;
            margin-bottom: 100px; 
            height: 200px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            flex-direction: column;
        }

        /* Navigation buttons */
        .property-nav {
            text-align: center;
            margin-top: 20px;
        }

        .prev-btn, .next-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4169E1;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .background-section {
        background-image: url(images/etienne-beauregard-riverin-B0aCvAVSX8E-unsplash.jpg); /* Replace with the URL of your background image */
        background-size: cover; /* Adjust as needed */
        background-repeat: no-repeat;
        background-position: center center;
        padding: 50px 0; /* Adjust top and bottom padding as needed */
        }

        .property img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .caption {
            background-color: #4169E1;
            color: white;
            padding: 10px;
        }

        .text-border {
            /* 1 pixel black shadow to left, top, right and bottom */
            text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
            color: white;
        }

        .btn-view {
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            background-color:  #fff;
            color: #333;
            border: none;
            cursor: pointer; 
        }
        
        .btn-view:hover {
        background-color: #333; /* Change the background color on hover */
        color: #fff; /* Change the text color on hover */
    }
    </style>
</head>
<body style="background-color:#C7C7C7 ;">

<?php 
    include('components/header.php'); 
  ?>
  
    <header id="tobecovered" class="background-section">
            <div class="container" style="background-color: transparent;">
                <h1 class="text-border" style="color: aliceblue;">Welcome to DigsSpace</h1>
                <h4  class="text-border" style="color: aliceblue;">Browse and find your next home here.</h4>
                <button  style="color: rgb(3, 11, 19); background-color: whitesmoke" class="btn">
                    <a href="faqs.php">Learn more</a>
                </button>
            </div>
    </header>

    <div class="property-grid">
    <?php
        include('server/config.php');
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

       

        // Check if the search form is submitted
        if(isset($_POST['submit']) && !empty($_POST['search'])) {
            $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM properties WHERE 
            (property_name LIKE '%$searchTerm%' OR 
            property_description LIKE '%$searchTerm%' OR 
            property_location LIKE '%$searchTerm%' OR 
            property_price LIKE '%$searchTerm%' OR 
            property_category LIKE '%$searchTerm%') AND 
            availability_status = 'available' AND deleted = 0";
            $result = mysqli_query($conn, $sql);
           

           

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <div class="property">
                        <img src="<?php echo $row['image_url']; ?>" alt="Property Image">
                        <div style="background-color: #4169E1;" class="caption">
                            <p><?php echo $row['property_name']; ?></p>
                            <p><?php echo $row['property_location']; ?></p>
                            <p>ZAR <?php echo $row['property_price']; ?></p>
                            <a class="btn-view" href="HomePagePropertyDetails.php?id=<?php echo $row['property_id']; ?>">View</a>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "No properties found matching your search criteria.";
            }
        } else {
            // Fetch property data from the database
            $sql = "SELECT * FROM properties WHERE availability_status = 'available' AND deleted = 0";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="property">
                            <img src="<?php echo $row['image_url']; ?>" alt="Property Image">
                            <div style="background-color: #4169E1;" class="caption">
                                <p><?php echo $row['property_name']; ?></p>
                                <p><?php echo $row['property_location']; ?></p>
                                <p>ZAR <?php echo $row['property_price']; ?></p>
                                <a class="btn-view" href="HomePagePropertyDetails.php?id=<?php echo $row['property_id']; ?>">View</a>
                            </div>
                    </div>
                    <?php
                }
            } else {
                echo "No properties available.";
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

    </div>
    <br><br><br><br>
    <!-- Rest of your HTML content -->
    <div class="property-nav mb-3">
        <button style="background-color: #4169E1;" class="btn btn-primary btn-lg" onclick="scrollProperties(-1)">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </button>
        <button style="background-color: #4169E1;" class="btn btn-primary btn-lg" onclick="scrollProperties(1)">
        Next
        <i class="fa-solid fa-arrow-right"></i>
    </button>
    </div>
    <script>
        // JavaScript function to scroll properties
        let propertyIndex = 0;

        function scrollProperties(direction) {
            const properties = document.querySelectorAll('.property');
            propertyIndex += direction * 4; // Scroll 4 properties at a time

            // Ensure propertyIndex stays within a valid range
            if (propertyIndex < 0) {
                propertyIndex = 0;
            } else if (propertyIndex >= properties.length) {
                propertyIndex = properties.length - 4;
            }

            // Hide all properties
            properties.forEach(property => {
                property.style.display = 'none';
            });

            // Display the next set of properties
            for (let i = propertyIndex; i < propertyIndex + 4 && i < properties.length; i++) {
                properties[i].style.display = 'block';
            }
        }

        // Initial display of properties
        scrollProperties(0);
    </script>

    <?php include("components/footer.inc.php"); ?>

</body>
</html>
