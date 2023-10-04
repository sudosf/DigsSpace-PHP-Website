<?php
// Add database credentials
require_once("config.php");

// Start a session
session_start();



// Extract the "id" parameter from the URL and sanitize it
if (isset($_GET['id'])) {
    $propertyID = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
} else {
    
    $propertyID = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Font Awesome Icon Library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .checked {
      color: orange;
    }
  </style>
</head>
<body>

<div class="card"> 
  <form action="star_rating_system.php?id=<?php echo $propertyID; ?>" method="post">
    <h1>Rate The Property</h1>

    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>

    <label class="container">One
      <input type="radio" name="rating" value="1">
      <span class="checkmark"></span>
    </label>
    <label class="container">Two
      <input type="radio" name="rating" value="2">
      <span class="checkmark"></span>
    </label>
    <label class="container">Three
      <input type="radio" name="rating" value="3">
      <span class="checkmark"></span>
    </label>
    <label class="container">Four
      <input type="radio" name="rating" value="4">
      <span class="checkmark"></span>
    </label>
    <label class="container">Five
      <input type="radio" name="rating" value="5">
      <span class="checkmark"></span>
    </label>

    <!-- Hidden input fields for user_id and property_id -->
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
    <input type="hidden" name="property_id" value="<?php echo $propertyID; ?>">

    <input type="submit" name="submit" value="Rate">
  </form>
</div>

<?php
// Connect to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("<strong style= \"color:red;\">Could not connect to the database!</strong>");

// Collect rating and add it to the database
if (isset($_POST['submit'])) {
    // Get the selected rating
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    
    // Get user_id and property_id from session
    $userID = $_SESSION['user_id'];
    
    // Insert rating into the database using the extracted propertyID
    $query = "INSERT INTO tenant_ratings (rating_id, property_id, rating, user_id) VALUES ('$propertyID', '$propertyID', '$rating', '$userID')";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo "<p style= \"color:green;\"> You rated this property $rating stars! </p>";
    } else {
        echo "<strong style= \"color:red;\"> Property already rated</strong>";
    }
}

// Close the database connection
mysqli_close($conn);
?>
<style>
  /* The container */
  .container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* Hide the browser's default radio button */
  .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }

  /* Create a custom radio button */
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
  }

  /* On mouse-over, add a grey background color */
  .container:hover input ~ .checkmark {
    background-color: #ccc;
  }

  /* When the radio button is checked, add a blue background */
  .container input:checked ~ .checkmark {
    background-color: #2196F3;
  }

  /* Create the indicator (the dot/circle
/* Style the body */
body {
  background-color: darkgray;
  padding-left: 500px;
}
</style>

<style>
  /*Style the card*/
  .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 40%;
    border-style: solid; 
    border-radius: 5px;
  }
</style>

</body>
</html>
