<?php

session_start();


// Clear all session data
session_unset();


// Destroy session
session_destroy();


// Redirect to login page
header("Location: login.html");

exit();

?>