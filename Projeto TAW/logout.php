<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header("Location: register.html"); // Redirect to login page after logout
exit();
?>