<?php

include 'config.php';

// get vars from form

$id = $_REQUEST['id'];
$date = $_REQUEST['date'];

if (isset($_REQUEST['approved'])) {
    $approved = 1;
} else {
    $approved = 0;
}

//sql to update

$sql = "UPDATE caroilchange SET date = '$date', approved = $approved WHERE id = $id";

//run sql

$ret = mysqli_query($link, $sql);

if($ret) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($link);
}