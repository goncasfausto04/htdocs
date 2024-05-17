<?php

//connnect to database
$link = mysqli_connect( "localhost" , "root" , "" , "caroilchangedb" );

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}