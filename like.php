<?php 

date_default_timezone_set('Asia/Jakarta');

require_once "config/koneksi.php";
require_once "utils/jsonformatter.php";

session_start();

$userId = $_SESSION['id'];
$id = $_POST["id"];
$type = $_POST["type"];

$currentLike = 0;
$sql = "SELECT * FROM recipe_likes WHERE recipe_id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $currentLike = $result->num_rows;
}

if ($type == "like") {
    $sql = "SELECT * FROM recipe_likes WHERE user_id = $userId AND recipe_id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $conn->query("DELETE FROM recipe_likes WHERE user_id = $userId AND recipe_id = $id");
        $data['current_like'] = $currentLike - 1;
        return json_response($data, 200);
    } else {
        $conn->query("INSERT INTO recipe_likes (user_id, recipe_id) VALUES ($userId, $id)");
        $data['current_like'] = $currentLike + 1;
        return json_response($data, 200);
    }
} else {
    $conn->query("DELETE FROM recipe_likes WHERE user_id = $userId AND recipe_id = $id");
    $data['current_like'] = $currentLike - 1;
    return json_response($data, 200);
}