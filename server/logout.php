<?php
session_start();
if(!isset($_REQUEST['access'])){
    // removes all session variables
    session_unset();
    // destroys the session
    session_destroy();
}
// Redirects back to homepage
header("Location: index.php");
?>