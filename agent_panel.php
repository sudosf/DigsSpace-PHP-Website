<?php
// Inserting credentials from another PHP file
require_once("config.php");

// Start a session
session_start();

// Connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

// Check if a user ID is stored in the session
if (isset($_SESSION['user_id'])) {
    // Retrieve the user ID
    $user_id = $_SESSION['user_id'];

    // Query to fetch user data from the database
    $query = "SELECT firstName FROM users WHERE user_id = $user_id";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query was successful and fetch the user data
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
    } 
}

// Fetch latest three properties from the database for the specific agent
$latestPropertiesQuery = "SELECT * FROM properties WHERE agent_id = $user_id ORDER BY property_id DESC LIMIT 3";
$latestPropertiesResult = mysqli_query($conn, $latestPropertiesQuery);

// Fetch available properties from the database for the specific agent
$availablePropertiesQuery = "SELECT * FROM properties WHERE agent_id = $user_id AND availability_status = 'available'";
$availablePropertiesResult = mysqli_query($conn, $availablePropertiesQuery);

// Fetch not available properties from the database for the specific agent
$notAvailablePropertiesQuery = "SELECT * FROM properties WHERE agent_id = $user_id AND availability_status = 'not available'";
$notAvailablePropertiesResult = mysqli_query($conn, $notAvailablePropertiesQuery);

// Fetch occupied properties from the database for the specific agent
$occupiedPropertiesQuery = "SELECT * FROM properties WHERE agent_id = $user_id AND availability_status = 'occupied'";
$occupiedPropertiesResult = mysqli_query($conn, $occupiedPropertiesQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Add your CSS styles here */
        .property-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .property {
            width: 30%;
            margin: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .property img {
            width: 100%;
            height: auto;
        }

        .property-info h2 {
            margin-top: 10px;
        }

        .property-info button {
            margin-top: 10px;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>


<header class="admin-header">
        <div class="logo">
        <img src="images/logo.png" alt="DigsSpace Logo">
        </div>

        <form method="POST" action="search_results.php">
        <div class="search-bar">
            <input type="text" placeholder="Enter location to search...">
            <button class="search-button" type="submit" name="search"><i class="fas fa-search"></i> Search</button>
        </div>
        </form>

        <div class="filter-button">
        <button type="submit" name="filter"><i class="fas fa-filter"></i> Filter</button>
        </div>

        <nav>
            <div class="admin-nav">
            <ul>
            <li><a href="agent_panel.php">Home</a></li>
                <li><a href="addtenant.php">Add Tenant</a></li>
                <li><a href="addproperty.php">Add Property</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        </nav>
    </header>
    <main   class="admin-main">
        <h1 class="admin-heading">Agent Dashboard</h1>
        <p>Welcome to the agent panel <?php echo "<strong>" .$row['firstName']. "</strong>"?>.</p>

        <!-- Latest Properties -->
        <div class="latest-updates">
            <h2>Latest Properties</h2>
            <div class="property-listings">
                <?php
                while ($row = mysqli_fetch_array($latestPropertiesResult)) {
                    echo '<div class="property-listing">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['property_name'] . '">';
                    echo '<div class="listing-info">';
                    echo '<h4>' . $row['property_name'] . '</h4>';
                    echo '<p>Description: ' . $row['property_description'] . '</p>';
                    echo '<p>Location: ' . $row['property_location'] . '</p>';
                    echo '<p>Price: R' . $row['property_price'] . '</p>';
                    echo '<a <button type="submit" name="View Property">View Property</button>';
                    echo '</div></div>';
                }
                ?>
            </div>
        </div>

        <!-- Available Properties -->
        <div class="admin-content">
            <h1>Available Properties</h1>
            <div class="property-container">
                <?php
                while ($row = mysqli_fetch_assoc($availablePropertiesResult)) {
                    echo '<div class="property">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['property_name'] . '">';
                    echo '<div class="property-info">';
                    echo '<h2>' . $row['property_name'] . '</h2>';
                    echo '<p>Description: ' . $row['property_description'] . '</p>';
                    echo '<p>Location: ' . $row['property_location'] . '</p>';
                    echo '<p>Price: $' . $row['property_price'] . '</p>';
                    echo "<td><a href='property_details.php?id=" . $row['property_id'] . "'><button>View Property</button></a></td>";
                    echo '</div></div>';
                }
                ?>
            </div>
        </div>

        <!-- Not Available Properties -->
        <div class="admin-content">
            <h1>Not Available Properties</h1>
            <div class="property-container">
                <?php
                while ($row = mysqli_fetch_assoc($notAvailablePropertiesResult)) {
                    echo '<div class="property">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['property_name'] . '">';
                    echo '<div class="property-info">';
                    echo '<h2>' . $row['property_name'] . '</h2>';
                    echo '<p>Description: ' . $row['property_description'] . '</p>';
                    echo '<p>Location: ' . $row['property_location'] . '</p>';
                    echo '<p>Price: $' . $row['property_price'] . '</p>';
                    echo '<button type="submit" name="View Property">View Property</button>';
                    echo '</div></div>';
                }
                ?>
            </div>
        </div>

        <!-- Occupied Properties -->
        <div class="admin-content">
            <h1>Occupied Properties</h1>
            <div class="property-container">
                <?php
                while ($row = mysqli_fetch_assoc($occupiedPropertiesResult)) {
                    echo '<div class="property">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['property_name'] . '">';
                    echo '<div class="property-info">';
                    echo '<h2>' . $row['property_name'] . '</h2>';
                    echo '<p>Description: ' . $row['property_description'] . '</p>';
                    echo '<p>Location: ' . $row['property_location'] . '</p>';
                    echo '<p>Price: $' . $row['property_price'] . '</p>';
                    echo '<button type="submit" name="View Property">View Property</button>';
                    echo '</div></div>';
                }
                ?>
            </div>
        </div>
    </main>

   

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
