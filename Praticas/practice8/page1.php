<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected color from the form
    $selectedColor = $_POST['color'];

    // Set the cookie with the selected color
    setcookie('color', $selectedColor, time() + (86400 * 30), '/'); // Cookie expires in 30 days
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Color Selection</title>
</head>
<body>
    <h1>Color Selection</h1>
    <form method="POST">
        <label for="color">Select a color:</label>
        <select name="color" id="color">
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>
            <option value="yellow">Yellow</option>
        </select>
        <button type="submit">Submit</button>
    </form>
    <a href="page2.php">Go to page 2</a>
</body>
</html>