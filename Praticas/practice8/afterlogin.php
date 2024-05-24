<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

echo "Welcome " . htmlspecialchars($_SESSION['user']) . " <a href=\"autentica.php?logout=1\">Logout</a>";
?>
