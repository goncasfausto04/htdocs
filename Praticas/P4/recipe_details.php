<?php
include 'recipes_data.php';
$recipeId = $_REQUEST['id'];
$recipe = $recipes[$recipeId - 1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Recipe Details</title>
 <link rel="stylesheet" href="styles.css">
</head>
<body>
 <h1>Recipe Details</h1>
 <?php if ($recipe): ?>
 <div>
 <h2><?php echo $recipe['title']; ?></h2>
 <p>Ingredients: <?php echo implode(', ', $recipe['ingredients']);
?></p>
 <p>Instructions: <?php echo $recipe['instructions']; ?></p>
 </div>
 <?php else: ?>
 <p>Recipe not found</p>
 <?php endif; ?>
</body>
</html>
