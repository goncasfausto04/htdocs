<?php
print("<h1>Olá calor!</h1>");
$t = date("H");
if ($t < "10") {
echo "Have a good morning!";
} elseif ($t < "20") {
echo "Have a good day!";
} else {
echo "Have a good night!";
}

?>
<br>
<?php

$favcolor = "blue";
switch ($favcolor) {
case "red":
echo "Your favorite color is red!";
break;
case "blue":
echo "Your favorite color is blue!";
break;
default:
echo "Your favorite color is neither red, blue,
or green!";
}

?>
