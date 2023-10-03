<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    

    <title>DigSpace</title>

    <style>
       /* Add this CSS code for navigation bar styles */
       /* Add this CSS code for navigation bar styles */
        .navbar {
            background-color: #333; /* Navbar background color */
            overflow: hidden;
            height: 80px; /* Set a fixed height for the navbar */
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
        }
        .background-section {
        background-image: url(etienne-beauregard-riverin-B0aCvAVSX8E-unsplash.jpg); /* Replace with the URL of your background image */
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
    </style>
</head>
<body style="background-color: #C7C7C7;">
    <header>
        

    <nav class="navbar" >
    <div class="menu">
       <p><img src="logo_transparent.png" alt="Logo" style="height: 75px; width: 60px;"></p>
            
        
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="faqs.php"><i class="fas fa-question-circle"></i> FAQ</a>
        <a href="login.html"><i class="fas fa-user"></i> Profile</a>
        <a href="Contact.php"><i class="fas fa-phone"></i> Contact Us</a>

        <form method="POST" action="index.php">
            <input type="text" name="search" placeholder="Enter Property type">
            <button type="submit" class="search-btn" name="submit">Search</button>
        </form>
    </div>

    <div class="auth">
        <a href="login.html">
            <button style="background-color: #4169E1;" class="btn">Login</button>
        </a>
    </div>
</nav>


    </header>

    <header id="tobecovered" class="background-section">
            <div class="container" style="background-color: transparent;">
                <h1 class="text-border" style="color: aliceblue;">Welcome to DigsSpace</h1>
                <h4  class="text-border" style="color: aliceblue;">Browse and find your next home here.</h4>
                <button  style="color: rgb(3, 11, 19); background-color: whitesmoke" class="btn"><a href="faqs.html">Learn more</a></button>
            </div>
    </header>

    <div class="property-grid">
    <?php
        include('config.php');
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

       

        // Check if the search form is submitted
        if(isset($_POST['submit']) && !empty($_POST['search'])) {
            $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM properties WHERE property_category LIKE '%$searchTerm%'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="property">
                        <a href="propertydetails.php?id=<?php echo $row['property_id']; ?>">
                            <img src="<?php echo $row['image_url']; ?>" alt="Property Image">
                            <div style="background-color: #4169E1;" class="caption">
                                <p><?php echo $row['property_name']; ?></p>
                                <p><?php echo $row['property_location']; ?></p>
                                <p>ZAR <?php echo $row['property_price']; ?></p>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo "No properties found matching your search criteria.";
            }
        } else {
            // Fetch property data from the database
            $sql = "SELECT * FROM properties";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="property">
                        <a href="propertydetails.php?id=<?php echo $row['property_id']; ?>">
                            <img src="<?php echo $row['image_url']; ?>" alt="Property Image">
                            <div style="background-color: #4169E1;" class="caption">
                                <p><?php echo $row['property_name']; ?></p>
                                <p><?php echo $row['property_location']; ?></p>
                                <p>ZAR <?php echo $row['property_price']; ?></p>
                            </div>
                        </a>
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
    <div class="property-nav">
        <button style="background-color: #4169E1;" class="prev-btn" onclick="scrollProperties(-1)">Previous</button>
        <button style="background-color: #4169E1;" class="next-btn" onclick="scrollProperties(1)">Next</button>
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
    <footer style="background-color: #4169E1;"  >
        <p>&copy; 2023 Working Wizards. All rights reserved.</p>
        <a href="https://www.instagram.com/harrachi.the_fisherman_/#" style="text-decoration: none; color: purple; padding: 10px;"><img src ="insta.jpg" width ="40px"></a>
        <a href="https://www.youtube.com/@RhodesUniversity1" style="text-decoration: none; color: purple; padding: 10px;"><img src ="youtube.jpg" width ="50px"></a>
    
    </footer>

</body>
</html>
