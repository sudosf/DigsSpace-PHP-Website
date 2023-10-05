<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Reports</title>
    <link rel="stylesheet" type="text/css" href="reports.css">
    <link rel="stylesheet" type="text/css" href="admin_panel.css">
</head>
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
            <li><a href="admin_panel.php">Home</a></li>
                <li><a href="addagent.php">Add Agent</a></li>
                <li><a href="reports.html">Reports</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        </nav>
    </header>
<body>
<?php
// to check if form has been submitted
if (isset($_REQUEST['submit'])) {
    // add database credentials
    require_once('config.php');

    // connect to database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("There was a problem connecting to the database!");

    $query = ""; // Initialize the $query variable
    
    if (isset($_REQUEST['submit'])) {
        $clickedButton = $_REQUEST['submit'];
    
        if ($clickedButton === 'Agent List') {
            $query = "SELECT * FROM users WHERE user_role = 'Agent' AND deleted = 0";
        }elseif($clickedButton === 'Pie Chart'){

            header('Location: http://is3-dev.ict.ru.ac.za/Sysdev/WorkingWizards/Final/piechart.php');

        }
    }

    // execute query if it's not empty
    if (!empty($query)) {
        $result = mysqli_query($conn, $query) or die('There was a problem displaying table!');

        // heading for pressed button
        echo "<br><br>";
        echo "<h3>" . $_REQUEST['submit'] . "</h3>";

        // start users table
        echo "<table style=\"\">";
        echo "<tr style=\"background-color: lightblue;\">";
        echo "<th>Firstname</th>";
        echo "<th>Lastname</th>";
        echo "<th>Email</th>";
        echo "<th>Status</th>";
        echo "<th>Contact</th>";
        echo "</tr>";

        // fetching data for the table from the database
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['user_status'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "</tr>";
        }

        // end the table
        echo "</table>";
    }

    // disconnect from the database
    mysqli_close($conn);
}
?>
</body>
</html>

    