<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Reports</title>
    <link rel="stylesheet" type="text/css" href="reports.css">
</head>
<body>
    <?php
// to check if form has been submitted
    if(isset ($_REQUEST['submit'])){

        // add database credentials
        require_once('config.php');

        // connect to database
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("There was a problem connecting to the database!");

        // query executed for each button pressed
        if ($_REQUEST['submit'] == "Agent List"){
            $query = "SELECT * FROM users WHERE user_role = 'Agent' AND deleted = 0";
        }
        //execute query
        $result = mysqli_query($conn, $query) or die('There was a problem displaying table!');

        // heading for pressed button
        echo "<br><br>";
        echo "<h3>" . $_REQUEST['submit'] . "</h3>";

        //start users table
        echo "<table style=\"\">";
        echo "<tr style=\"background-color: lightblue;\">";
        echo "<th>Firstname</th>";
        echo "<th>Lastname</th>";
        echo "<th>Email</th>";
        echo "<th>Status</th>";
        echo "<th>Contact</th>";
        echo "</tr>";

        //fetching data for table from database
        while($row = mysqli_fetch_array($result)){
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

        //disconnect from database
        mysqli_close($conn);

    }
        ?>
</body>
</html>
<?php
    