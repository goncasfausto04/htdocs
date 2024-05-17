<?php
include "config.php";

$id = $_REQUEST['id'];

$sql = "SELECT * FROM caroilchange WHERE id = $id";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

?>

<form action="update.php" method="POST">
    <input type="date" name="date" value="<?php echo $row['date']; ?>">
    <input type="checkbox" name="approved" value="1" <?php if($row['approved']) { echo "checked"; } ?>>
    <input type="hidden" name="id" value=<?php echo $id ?>>
    <input type="submit" value="update">
</form>
