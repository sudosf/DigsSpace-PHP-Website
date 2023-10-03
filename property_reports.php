<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties Report</title>
    <link rel="stylesheet" type="text/css" href="reports.css">
</head>
<body>
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

//fetch user_id from url
$user_id = $_SESSION['user_id'];

// to check if form has been submitted

if(isset ($_REQUEST['submit'])){

    // add database credentials
    require_once('config.php');

    // connect to database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("There was a problem connecting to the database!");

    // Initialize the query
    $query = "";

    // query executed for each button pressed
    if ($_REQUEST['submit'] == "Property List"){
        $query = "SELECT properties.*, users.firstName AS agentFirstName, users.lastName AS agentLastName
        FROM properties
        LEFT JOIN users ON properties.agent_id = users.user_id
        WHERE properties.deleted = 0 AND user_id = $user_id ";
    // include a search filter
    if (isset($_REQUEST['submit']) && $_REQUEST['submit'] == "Search") {
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
    } else {
        $query = "SELECT properties.*, users.firstName AS agentFirstName, users.lastName 
        AS agentLastName FROM properties LEFT JOIN users ON properties.agent_id = users.user_id WHERE properties.deleted = 0";
    }
}
    //execute query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("SQL Error: " . mysqli_error($conn));
    }
}
    // heading for pressed button
    echo "<br><br>";
    echo "<h3>" . $_REQUEST['submit'] . "</h3>";

  //start properties table
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

    //fetching data for table from database
    while($row = mysqli_fetch_array($result)){
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

    // end the table
    echo "</table>";

    //disconnect from database
    mysqli_close($conn);
    ?>

</body>
</html>