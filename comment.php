<?php
date_default_timezone_set('Asia/Jakarta');

require_once "config/koneksi.php";
require_once "utils/jsonformatter.php";

session_start();

$userId = $_SESSION['id'];
$recipeId = $_POST["recipeId"];
$comment = $_POST["comment"];
$rating = $_POST["rating"];

$sql = "INSERT INTO recipe_comment (user_id, recipe_id, comment, rating, created_at) VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisi", $userId, $recipeId, $comment, $rating);
$stmt->execute();

$data['message'] = "Comment added successfully";
return json_response($data, 200);
