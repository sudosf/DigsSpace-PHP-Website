<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rating.css">
    <!-- Include other CSS and external libraries -->

    <title>Property Details</title>
    <style>
        /* Your existing CSS styles here */

        /* Add CSS for the carousel indicators */
        .carousel-indicators {
            position: static;
        }

        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .carousel-indicators button.active {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <?php 
        include('components/header.php'); 
    ?>

    <header class='header-custom py-4'>
        <h1>Property Details</h1>
    </header>

    <section class="container-fluid my-5 w-100 m-auto d-flex align-items-center text-center">
        <div class="container text-center">
            <!-- Property Details -->
            <div>
                <?php
                // Include your database connection
                require_once("server/config.php");

                // Connect to the database with error handling
                $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE);

                // Check if the connection was successful
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Get the property ID from the query string or another source
                if (isset($_GET['id'])) {
                    $propertyId = $_GET['id'];

                    // Query to retrieve property details
                    $query = "SELECT * FROM properties WHERE property_id = $propertyId";

                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $property = mysqli_fetch_assoc($result);

                        echo "<h1>{$property['property_name']}</h1>";
                        echo "<p>Location: {$property['property_location']}</p>";
                        echo "<p>Price: R {$property['property_price']}</p>";
                        echo "<p>Status: {$property['availability_status']}</p>";
                        echo "<p>Category: {$property['property_category']}</p>";
                        echo "<div>
                                <p class='h6 fw-bold'>Description:</p>
                                <p>{$property['property_description']}</p>
                            </div>";

                        // Fetch and display agent information
                        $agent_id = $property['agent_id'];
                        $agentQuery = "SELECT * FROM users WHERE user_id = $agent_id";
                        $agentResult = mysqli_query($conn, $agentQuery);

                        if ($agentResult && mysqli_num_rows($agentResult) > 0) {
                            echo "<h2>Agent Information</h2>";
                            $agent = mysqli_fetch_assoc($agentResult);
                            echo "<p>Agent Name: ";
                            echo isset($agent['first_name']) ? $agent['first_name'] : 'N/A';
                            echo " ";
                            echo isset($agent['last_name']) ? $agent['last_name'] : 'N/A';
                            echo "</p>";
                            echo "<p>Email: {$agent['email']}</p>";
                            echo "<p>Phone: ";
                            echo isset($agent['phone_number']) ? $agent['phone_number'] : 'N/A';
                            echo "</p>";
                        } else {
                            echo "<h2>Agent Information</h2>";
                            echo "<p>Agent information not available.</p>";
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
            </div>
        </div>
    </section>

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

                    // Connect to the database again for image retrieval
                    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE);

                    if ($conn) {
                        $imageQuery = "SELECT * FROM images WHERE property_id = $propertyId";
                        $imageResult = mysqli_query($conn, $imageQuery);

                        if ($imageResult && mysqli_num_rows($imageResult) > 0) {
                            while ($image = mysqli_fetch_array($imageResult)) {
                                $imageUrl = $image['image_url'];
                                echo "<div class='carousel-item'>
                                        <img src='$imageUrl' class='img-fluid w-100' alt='img.jpg'>
                                    </div>";
                             }
                        }
                        mysqli_close($conn); // Close the database connection for images
                    }
                    ?>
                </div>
                <button class='carousel-control-prev' type='button' data-bs-target='#myCarousel' data-bs-slide='prev'>
                  <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                  <span class='visually-hidden'>Previous</span>
                </button>
                <button class='carousel-control-next' type='button' data-bs-target='#myCarousel' data-bs-slide='next'>
                  <span class='carousel-control-next-icon' aria-hidden='true'></span>
                  <span class='visually-hidden'>Next</span>
                </button>
            </div>
        </div>
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
