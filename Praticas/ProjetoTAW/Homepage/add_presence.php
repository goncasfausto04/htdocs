<?php
session_start();
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $arrival_time = $_POST['arrival_time'];
    $attend = $_POST['attend'];

    // Insert data into database
    $sql = "INSERT INTO user_presence (name, company, email, contact, arrival_time, attend)
            VALUES ('$name', '$company', '$email', '$contact', '$arrival_time', '$attend')";
    if ($conn->query($sql) === TRUE) {
        echo "Presence added successfully <br>";
        echo "<a href=homepage.php>Go Back to Homepage</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<a href=homepage.php>Go Back to Homepage</a>";
    }
}
?>