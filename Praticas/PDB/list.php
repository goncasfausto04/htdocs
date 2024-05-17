<?php

// Inclui o arquivo de configuração
include 'config.php';

// sql to list

$sql = "SELECT * FROM caroilchange";

$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $name = $row["name"];
    $email = $row["email"];
    $date = $row["date"];
    $registration_plate = $row["registration_plate"];

        echo "<h4>ID: " . $id . "</h4>";
        echo "Name: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Date: " . $date . "<br>";
        echo "Registration Plate: " . $registration_plate . "<br>";
        echo '<a href="edit.php?id=' . $id . '">Edit</a>'; // Fixed the missing quotation mark and concatenated the $id variable properly
        echo "<br>";
    }

