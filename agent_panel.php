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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Panel</title>
    <link rel="stylesheet" type="text/css" href="admin_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                <li><a href="admin_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        </nav>
    </header>

    <main class="admin-main">
        <h1 class="admin-heading">Agent Dashboard</h1>
        <p>Welcome to the agent panel <?php echo "<strong>" .$row['firstName']. "</strong>"?>.</p>
        <div class="latest-updates">
            <h2>Latest Updates</h2>
            <div class="update">
                <h3>New Property Listings</h3>
                <div class="property-listings">
                    <!-- Property 1 Listing -->
                    <div class="property-listing">
                        <img src="images/property_1.jpeg" alt="Property 4">
                        <div class="listing-info">
                            <h4>xxxx</h4>
                            <p>Description: xxxx</p>
                            <p>Agent Assigned: xxxx</p>
                            <button  type="submit" name="View Property"> View Property</button>
                        </div>
                    </div>
                    <!-- Property 2 Listing -->
                    <div class="property-listing">
                        <img src="images/property_2.jpeg" alt="Property 5">
                        <div class="listing-info">
                            <h4>xxxx</h4>
                            <p>Description: xxxxx.</p>
                            <p>Agent Assigned: xxxxx</p>
                            <button  type="submit" name="View Property"> View Property</button>
                        </div>
                    </div>
                    <!-- Property 3 Listing -->
                    <div class="property-listing">
                        <img src="images/property_3.jpeg" alt="Property 6">
                        <div class="listing-info">
                            <h4>xxxx</h4>
                            <p>Description: xxxx.</p>
                            <p>Agent Assigned: xxxxx</p>
                            <button  type="submit" name="View Property"> View Property</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="update">
                <h3>Tenant Notifications</h3>
                <div class="agent-notifications">
                    <p>3 new agents inquiries:</p>
                    <ul>
                        <li>Tenant no.1</li>
                        <li>Tenant no.2</li>
                        <li>Tenant no.3</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


        <div class="admin-content">
        <h1>Rental Properties</h1>
        <div class="property-container">
            <!-- Property 1 -->
            <div class="property">
                <img src="images/property_4.jpeg" alt="Property 1">
                <div class="property-info">
                    <h2>xxx</h2>
                    <p>xxxxxxxxx</p>
                    <p>Rating: 4.5 stars</p>
                    <p class="rented">RENTED</p>
                    <button  type="submit" name="View Property"> View Property</button>
                </div>
            </div>
            
            <!-- Property 2 -->
            <div class="property">
                <img src="images/property_5.jpeg" alt="Property 2">
                <div class="property-info">
                    <h2>xxxxx</h2>
                    <p>xxxxxx</p>
                    <p>Rating: 3.8 stars</p>
                    <p class="available">AVAILABLE</p>
                  <button  type="submit" name="View Property"> View Property</button>
                </div>
            </div>
            
            <!-- Property 3 -->
            <div class="property">
                <img src="images/property_6.jpeg" alt="Property 3">
                <div class="property-info">
                    <h2>xxxxx</h2>
                    <p>xxxxxx</p>
                    <p>Rating: 4.2 stars</p>
                    <p class="available">AVAILABLE</p>
                    <button  type="submit" name="View Property"> View Property</button>
                </div>
            </div>
        </div>
    </div>
    </main>
</body>
</html>