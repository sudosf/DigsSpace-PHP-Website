<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties Report</title>
    <link rel="stylesheet" type="text/css" href="reports.css">
    <link rel="stylesheet" type="text/css" href="admin_panel.css">
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

        <nav>
            <div class="admin-nav">
            <ul>
            <li><a href="admin_panel.php">Home</a></li>
                <li><a href="addagent.php">Add Agent</a></li>
                <li><a href="reports.html">Reports</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        </nav>
    </header>
        <!-- Add a search form -->
        <div class="search-container">
        <form method="POST" action="">
        <label for="search" class="search-label">Search:</label>
        <input type="text" name="search" id="search" class="search-input" placeholder="Enter property name...">
        <input type="submit" name="submit" value="Search" class="search-button">
        <!-- Button wrapper for the "Property List" button -->
        <div class="button-wrapper">
            <input type="submit" name="submit" value="Property List" class="property-list-button">
        </div>
    </form>
        </div>
 <?php
session_start();

// Fetch user_id from the session
$user_id = $_SESSION['user_id'];

// Add database credentials
require_once('config.php');

// Connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("There was a problem connecting to the database!");

// Initialize the query
$query = "";

// Check which button is clicked
if (isset($_REQUEST['submit'])) {
    $clickedButton = $_REQUEST['submit'];

    // Handle "Property List" button
    if ($clickedButton == "Property List") {
        $query = "SELECT properties.*, users.firstName AS agentFirstName, users.lastName AS agentLastName
                  FROM properties
                  LEFT JOIN users ON properties.agent_id = users.user_id
                  WHERE properties.deleted = 0";
    } 
    // Handle "Search" button
    elseif ($clickedButton == "Search") {
        $searchTerm = mysqli_real_escape_string($conn, $_POST['search']);
        $query = "SELECT properties.*, users.firstName AS agentFirstName, users.lastName AS agentLastName 
                  FROM properties 
                  LEFT JOIN users ON properties.agent_id = users.user_id 
                  WHERE (property_name LIKE '%$searchTerm%' OR 
                         property_category LIKE '%$searchTerm%' OR 
                         property_price LIKE '%$searchTerm%' OR 
                         property_location LIKE '%$searchTerm%' OR 
                         users.firstName LIKE '%$searchTerm%' OR 
                         users.lastName LIKE '%$searchTerm%' OR 
                         CONCAT(users.firstName, ' ', users.lastName) LIKE '%$searchTerm%') 
                  AND properties.deleted = 0";
    } 
    // Handle "Property Popularity" button
    elseif ($clickedButton == "Property Status") {
        header('Location: http://is3-dev.ict.ru.ac.za/Sysdev/WorkingWizards/Final/availabilitystatusgraph1.php');
        exit;
    }
}

// Execute the query
$result = mysqli_query($conn, $query);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

// Heading for pressed button
echo "<br><br>";
echo "<h3>" . $clickedButton . "</h3>";

// Start properties table
echo "<table>";
echo "<tr style=\"background-color: lightblue;\">";
echo "<th>Name</th>";
echo "<th>Description</th>";
echo "<th>Location</th>";
echo "<th>Price</th>";
echo "<th>Status</th>";
echo "<th>Category</th>";
echo "<th>Agent First Name</th>"; 
echo "<th>Agent Last Name</th>";  
echo "<th></th>"; // Add Edit column
echo "<th></th>"; // Add Delete column
echo "</tr>";

// Fetching data for the table from the database
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['property_name'] . "</td>";
    echo "<td>" . $row['property_description'] . "</td>";
    echo "<td>" . $row['property_location'] . "</td>";
    echo "<td>" . $row['property_price'] . "</td>";
    echo "<td>" . $row['availability_status'] . "</td>";
    echo "<td>" . $row['property_category'] . "</td>";
    echo "<td>" . $row['agentFirstName'] . "</td>"; 
    echo "<td>" . $row['agentLastName'] . "</td>";  
    echo "<td><a href='edit_property.php?id=" . $row['property_id'] . "'><button>Edit</button></a></td>";
    echo "<td><a href=\"delete_property.php?id={$row['property_id']}\"". "onClick=\"return confirm('Are you sure you want to delete: "
        . strtoupper($row['property_name']) . "');\"><button>Delete</button></a></td>";
    echo "</tr>";
}

// End the table
echo "</table>";

// Disconnect from the database
mysqli_close($conn);
?>
