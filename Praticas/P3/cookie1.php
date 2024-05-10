<?php

$name = "name";
$value = "nigga";

setcookie($name, $value, time() + (86400 * 30), "/");

?>

<form action="cookie2.php">
    <input type="submit">
</form>