<?php

//connnect to database
$link = mysqli_connect( "localhost" , "root" , "" , "caroilchangedb" );

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

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
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}