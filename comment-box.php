<?php 

$recipeId = $_GET["recipeId"];
$sql = "SELECT * FROM recipe_comment WHERE recipe_id = $recipeId";
$result = $conn->query($sql);
$comments = $result->fetch_all(MYSQLI_ASSOC);

var_dump($comments);