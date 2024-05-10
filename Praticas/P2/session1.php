<?php

session_start(); // Start the session

$_SESSION["name"] = "John";


?>

<form action="session2.php">
    <input type="submit">
</form>