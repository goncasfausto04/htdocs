<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Recipes List</title>
 <link rel="stylesheet" href="styles.css">
</head>
<body>
 <h1>Recipes List</h1>
 <ul>
 <?php
 include 'recipes_data.php';
 foreach ($recipes as $recipe) {
 echo '<li><a href="recipe_details.php?id=' . $recipe['id'] . '">' .
$recipe['title'] . '</a></li>';
 }
 ?>
 </ul>
</body>
</html>