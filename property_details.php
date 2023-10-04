<?php  session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rating.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <!-- Font Awesome -->
	<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
	/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css"
    rel="stylesheet"
    />

    <title>Property Details</title>
</head>

    <style>
        /* Existing CSS styles */

        /* Header and Navigation */
        .navbar {
            background-color: #C7C7C7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px; 
        }


        /* Add this CSS code for navigation bar styles */
        /* Add this CSS code for navigation bar styles */
        .navbar {
            background-color: #333; /* Navbar background color */
            overflow: hidden;
            height: 90px; /* Set a fixed height for the navbar */
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px; /* Adjust vertical padding */
            text-decoration: none;
            font-size: 14px; /* Reduce font size */
        }

        /* Add a subtle transition effect for smoother hover animations */
        .navbar a:hover {
            background-color: #C7C7C7;
            transition: 0.3s;
        }

        /* Highlight the current tab */
        .navbar a.active {
            background-color: #4169E1;
        }

        /* Style the search input and button */
        .navbar input[type="text"] {
            padding: 10px;
            margin: 6px 8px;
            border: none;
            font-size: 14px; /* Reduce font size */
        }

        .navbar button.search-btn {
            padding: 10px 20px;
            background-color: #4169E1;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 14px; /* Reduce font size */
        }

        .logo img {
            width: 30px;
            height: 30px;
        }

        .menu {
            
            display: flex;
            align-items: center;
        }

        .menu-item {
            margin: 0 15px;
        }

        .menu-item a {
            text-decoration: none;
            color: #000000;
            font-weight: bold;
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #FFFFFF;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu li {
            padding: 10px;
        }

        .menu-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Search Bar */
        .search-bar {
            text-align: center;
            background-color: #F2F2F2;
            padding: 10px 0;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: none;
            border-radius: 4px;
            margin-right: 5px;
        }

        .search-btn {
            background-color: #4169E1;
            color: #FFFFFF;
            border: none;
            border-radius: 4px;
            padding: 8px 15px;
            cursor: pointer;
        }


        .header-custom {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
        }

        .property-images {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .property-images img {
            max-width: 100%;
            height: auto;
            margin: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .property-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .property-details p {
            margin: 0;
            line-height: 1.5;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: transparent;
        }

        .property-images {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .property-images img {
            max-width: 100%;
            height: auto;
            margin: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }

        .property-images img:hover {
            transform: scale(1.1); /* Enlarge the image on hover */
        }

        .property-images {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Create a responsive grid */
            gap: 20px; /* Add some space between images */
        }

        .property-images img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
            
        }

        .property-images img:hover {
            transform: scale(1.1); /* Enlarge the image on hover */
        }

                /* Footer */
        footer {
            background-color: #C7C7C7;
            text-align: center;
            padding: 20px;
        }

        .footer-selection {
            margin-bottom: 30px;
        }

        footer p {
            color: #000000;
        }

    </style>

<body>
    <?php 
        include('components/header.php'); 
    ?>


    <header class='header-custom py-4'>
        <h1>Property Details</h1>
    </header>

    <section class="container-fluid my-5 w-100 m-auto d-flex align-items-center text-center">

        <div class="container text-center">
            <!-- Details -->
            <div>
                <?php
                // Include your database connection
                require_once("server/config.php");

                // Connect to the database
                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

                // Get the property ID from the query string or another source
               if (isset($_REQUEST['id'])) $_SESSION['propertyId'] = $_REQUEST['id'];
               $agent_id = "";
               $propertyId = $_SESSION['propertyId'];

                if ($propertyId) {
                    // Query to retrieve property details
                    $query = "SELECT * FROM properties WHERE property_id = $propertyId";

                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $property = mysqli_fetch_array($result);
                        
                        $agent_id = $property['agent_id'];

                        // Display property details
                        echo "<h1>{$property['property_name']}</h1>";
                        echo "<p>Location: {$property['property_location']}</p>";
                        echo "<p>Price: R {$property['property_price']}</p>";
                        echo "<p>Status: {$property['availability_status']}</p>";
                        echo "<p>Category: {$property['property_category']}</p>";
                        echo "<div>
                                <p class='h6 fw-bold'>Description:</p>
                                <p> {$property['property_description']} </p>
                            </div>";
                   // echo "<a href='Star_rating_system.php?id=" . $property['property_id'] . "'><button>Rate Property</button></a><br><br>";
                    
                    } else {
                        echo "Property not found.";
                    }
                } else {
                    echo "Invalid property ID.";
                }

                ?>
            </div>

            <!-- Star Rating -->
            <form class='my-5' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <h1 class='display-5'> Rate This Property </h1>

                <div class="rating">
                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                </div>

                <button type='submit' name='submit' class='btn btn-success px-5 btn-lg'>Rate</button>

                <?php
                    if (isset($_POST['submit'])) {
                        
                        if (!isset($_POST['rating'])) {
                            echo "<div class='alert alert-danger my-3 p-2 text-center' role='alert'>
                                please select 1 of 5 stars to rate
                            </div>";
                        } else{

                            // Get the selected rating
                            $rating = mysqli_real_escape_string($conn, $_POST['rating']);
                            $propertyId = $_SESSION['propertyId'];
                            $userId =  $_SESSION['user_id'];
     
                            $query = "SELECT * FROM tenant_ratings 
                                        WHERE user_id='$userId' AND property_id='$propertyId'";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                echo "<div class='alert alert-danger my-3 p-2 text-center' role='alert'>
                                    Property already rated.
                            </div>";

                            } else {
                                // Insert rating into the database using the extracted propertyID
                                $query = "INSERT INTO tenant_ratings (property_id, rating, user_id) 
                                VALUES ('$propertyId', '$rating', '$userId')";
                                $result = mysqli_query($conn, $query);
                            
                                if ($result !== false) {
                                        echo "<div class='alert alert-warning my-3 p-2 text-center' role='alert'>
                                            You rated this property $rating stars!
                                        </div>";
                                } else {
                                    echo "<div class='alert alert-danger my-3 p-2 text-center' role='alert'>
                                        Error rating Property.
                                    </div>";  
                                }
                            }
                        }
                    }
                ?>
            </form>

        </div>


            <!-- Gallery -->
        <div class="container w-100">
            <div id='myCarousel' class='carousel carousel-fade slide' data-bs-ride='carousel'>
                <div class='carousel-indicators'>
                  <button type='button' data-bs-target='#myCarousel' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>
                  <button type='button' data-bs-target='#myCarousel' data-bs-slide-to='1' aria-label='Slide 2'></button>
                  <button type='button' data-bs-target='#myCarousel' data-bs-slide-to='2' aria-label='Slide 3'></button>
                </div>

                <div class='carousel-inner'>

                <?php
                $imageUrl = "";

                $imageQuery = "SELECT * FROM images WHERE property_id = $propertyId";
                $imageResult = mysqli_query($conn, $imageQuery);

                if ($imageResult && mysqli_num_rows($imageResult) > 0) {
                    while ($image = mysqli_fetch_array($imageResult)) {
                        $imageUrl = $image['image_url'];
                        echo "<div class='carousel-item active'>
                                <img src='$imageUrl' class='img-fluid w-100' alt='img.jpg'>";

                        echo "       
                        <div class='container'>
                          <div class='carousel-caption'>
                            <h1>{$property['property_name']}</h1>
                          </div>
                        </div>
                      </div>";
                     }
                echo"         
                </div>
                <button class='carousel-control-prev' type='button' data-bs-target='#myCarousel' data-bs-slide='prev'>
                  <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                  <span class='visually-hidden'>Previous</span>
                </button>
                <button class='carousel-control-next' type='button' data-bs-target='#myCarousel' data-bs-slide='next'>
                  <span class='carousel-control-next-icon' aria-hidden='true'></span>
                  <span class='visually-hidden'>Next</span>
                </button>
            </div>";
    
        } else {
            echo "<div class='container'>
                <div>

                    <img
                    src='images/not_found.jpg'
                    class='w-100 shadow-1-strong rounded mb-4'
                    alt='Boat on Calm Water'
                />";
        }

        mysqli_close($conn); // Close the database connection
        ?>
        </div>

        <!-- Gallery -->
    </section>

    <?php include("components/footer.inc.php"); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
        crossorigin="anonymous">
    </script>

    <!-- MDB -->
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js">
    </script>


</body>
</html>
