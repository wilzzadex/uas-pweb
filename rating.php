<?php

require_once "config/koneksi.php";
require_once "utils/helper.php";
require_once "utils/jsonformatter.php";

$userId = $_SESSION['id'];
$recipeId = $_POST["recipeId"];
$rating = $_POST["rating"];

$sql = "SELECT * FROM recipe_comment WHERE user_id = $userId AND recipe_id = $recipeId";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sql = "UPDATE recipe_comment SET rating = $rating WHERE user_id = $userId AND recipe_id = $recipeId";
} else {
    $sql = "INSERT INTO recipe_comment (user_id, recipe_id, rating,comment) VALUES ($userId, $recipeId, $rating,'Mengirim rating')";
}

if ($conn->query($sql) === TRUE) {
    $data['message'] = "Rating berhasil disimpan";
    return json_response($data, 200);
} else {
    $data['message'] = "Rating gagal disimpan";
    return json_response($data, 500);
}