<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>star rating system</title>
</head>
<body>
    <?php
//add database credentials
require_once("config.php");
//connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
or die("<strong style= \"color:red;\">Could not connect to the database!</strong>");
//get values from form
$userID=mysqli_real_escape_string($conn, $_REQUEST('user_id'));
$propertyID=mysqli_real_escape_string($conn, $_REQUEST('property_id'));
$ratingID=$userID;
//start session
session_start();
//Collect rating and add it to the database
if(isset($_REQUEST['submit'])){
    
    if(isset($_REQUEST['one'])){
        $rating= 1;
    }
    elseif(isset($_REQUEST['two'])){
        $rating= 2;
    }
    elseif(isset($_REQUEST['three'])){
        $rating= 3;
    }
    elseif(isset($_REQUEST['four'])){
        $rating= 4;
    }
    else{
        $rating= 5;
    }
    echo "<p style= \"color:green;\"> You rated this property $rating stars! </p>";
}


//issue query instructions
$query= "SELECT* FROM tenant_ratings
INSERT INTO tenant_ratings(rating_id,property_id,rating, user_id)
VALUE('$ratingID','$propertyID','$rating','$userID')";
$result= mysqli_query($conn, $query)
or die("<strong style= \"color:red;\"> Could not execute query!</strong>");
//give access to users that exist in database


//close connection
mysqli_close($conn);
?>
    <?php
    //add database credentials
require_once("config.php");
//connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
or die("<strong style= \"color:red;\">Could not connect to the database!</strong>");
//issue query instructions
$query= "SELECT AVG(rating) WHERE property_id=$propertID AS  AS 'Average rating' FROM tenant_ratings";
$result= mysqli_query($conn, $query)
or die("<strong style= \"color:red;\"> Could not execute query!</strong>");
//close connection
mysqli_close($conn);
    ?>
</body>
</html>