<?php
   session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
         header("Location: login.php"); // Redirect to the login page
      //  exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Assignment</title>
    <link rel="stylesheet" type="text/css" href="forms.css">
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
    <div class="container">
        <h2>Tenant Assignment</h2>
        <form action="tenant_assignment.php" method="post">
            <!-- Hidden input field to store user_id (agent_id) -->
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

            <div class="form-group">
                <label for="tenant">Select Tenant:</label><br>
                <select name="tenant" id="tenant">
                    <?php
                    // database connection
                    require_once("config.php");
         
                    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Can't connect to the database");

                    // Fetch and display a list of tenants associated with the agent
                    $tenantQuery = "SELECT * FROM users WHERE agent_id = {$_SESSION['user_id']}";
                    $tenantResult = mysqli_query($conn, $tenantQuery);

                    while ($tenantRow = mysqli_fetch_array($tenantResult)) {
                        echo "<option value='{$tenantRow['user_id']}'>{$tenantRow['firstName']} {$tenantRow['lastName']}</option>";
                    }
                    ?>
                </select><br>
            </div>

            <div class="form-group">
                <label for="property">Select Property:</label><br>
                <select name="property" id="property">
                    <?php
                    // Include your database connection
                    require_once("config.php");
                    
                    // Fetch and display a list of properties associated with the user (agent)
                    $propertyQuery = "SELECT * FROM properties WHERE agent_id = '{$_SESSION['user_id']}'";
                    $propertyResult = mysqli_query($conn, $propertyQuery);

                    while ($propertyRow = mysqli_fetch_assoc($propertyResult)) {
                        echo "<option value='{$propertyRow['property_id']}'>{$propertyRow['property_name']}</option>";
                    }
                    ?>
                </select><br>
            </div>

            <div class="form-group">
                <label for="assignment_date">Assignment Date:</label><br>
                <input type="date" name="assignment_date" id="assignment_date" required><br>
            </div>

            <div class="form-group">
                <label for="status">Status:</label><br>
                <select name="status" id="status">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select><br>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Assign Tenant" class="submit-btn">
            </div>
        </form>
    </div>

    <?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $user_id = $_POST['user_id'];
        $tenant_id = $_POST['tenant'];
        $property_id = $_POST['property']; // Add property ID field
        $assignment_date = $_POST['assignment_date'];
        $status = $_POST['status'];

        // Include your database connection
        require_once("config.php");

        // Perform the database insert operation
        $insertQuery = "INSERT INTO tenant_assignment (user_id, tenant_id, property_id, assignment_date, status) VALUES ('$user_id', '$tenant_id', '$property_id', '$assignment_date', '$status')";

        // Execute the insert query
        $insertResult = mysqli_query($conn, $insertQuery);

        // Check if the insertion was successful
        if ($insertResult) {
            echo "<p style='color: green; text-align: center;'>Tenant assigned successfully!</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>Error: Unable to assign tenant. (</p>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

</body>
</html>
