<?php

session_start(); // Start the session

if (isset($_SESSION["name"])) {
    echo "Your name is " . $_SESSION["name"];
} else {
    echo "Name not found in session.";
}