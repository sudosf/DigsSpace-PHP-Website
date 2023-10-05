<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenants Report</title>
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

        $query = ""; // Initialize the $query variable

        // query executed for each button pressed
        if (isset($_REQUEST['submit'])) {
            $clickedButton = $_REQUEST['submit'];

        if($_REQUEST['submit'] == "Tenant List"){
            $query = "SELECT * FROM users WHERE user_role = 'Tenant' AND deleted = 0";
        }elseif($clickedButton === 'Property Popularity'){

            header('Location: http://is3-dev.ict.ru.ac.za/Sysdev/WorkingWizards/Final/bargraph.php');

        }
    }
        //execute query
        $result = mysqli_query($conn, $query) or die('There was a problem displaying table!');

        // heading for pressed button
        echo "<br><br>";
        echo "<h3>" . $_REQUEST['submit'] . "</h3>";

        //start users table
        echo "<table>";
        echo "<tr style=\"background-color: lightblue;\">";
        echo "<th>Firstname</th>";
        echo "<th>Lastname</th>";
        echo "<th>Email</th>";
        echo "<th>Status</th>";
        echo "<th>Contact</th>";
        echo "<th></th>"; // Add Edit column
        echo "<th></th>"; // Add Delete column
        echo "</tr>";

        //fetching data for table from database
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['user_status'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "<td><a href='edit_tenant.php?id=" . $row['user_id'] . "'><button>Edit</button></a></td>";
        echo "<td><a href=\"delete_tenant.php?id={$row['user_id']}\"". "onClick=\"return confirm('Are you sure you want to delete: "
        . strtoupper($row['firstName']) . "" . strtoupper($row['lastName']) . "');\"><button>Delete</button></a></td>";
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