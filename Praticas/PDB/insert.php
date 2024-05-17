<?php
include 'config.php';
//GET VAR FROM FORM
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$date = $_REQUEST['date'];
$registration_plate = $_REQUEST['registration_plate'];

//SQL
$sql = "INSERT INTO caroilchange (name, email, date, registration_plate)
VALUES ('$name', '$email', '$date', '$registration_plate')";

//run sql
$ret = mysqli_query($link, $sql);

if($ret){
    $last_id = mysqli_insert_id($link);
    echo "Thank you. the following query data is: 
    $name, $email, $date, $registration_plate. <br>
    You have the number $last_id, that you should use as a reference.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}