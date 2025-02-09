<?php

require_once "../config/koneksi.php";
require_once "../utils/jsonformatter.php";
include "../utils/helper.php";

session_start();
$user_id = $_SESSION['id'];
$id = $_GET['id'];
$sql = "SELECT * FROM recipes WHERE id = $id AND user_id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($result->num_rows == 0) {
    $_SESSION['error'] = "Resep tidak ditemukan";
    header("Location: index.php");
    exit();
}

// delete recipe_ingredients, recipe_directions, recipe_comments, recipe_likes
$conn->query("DELETE FROM recipe_ingredients WHERE recipe_id='$id'");
$conn->query("DELETE FROM recipe_directions WHERE recipe_id='$id'");
$conn->query("DELETE FROM recipe_comment WHERE recipe_id='$id'");
$conn->query("DELETE FROM recipe_likes WHERE recipe_id='$id'");

// delete recipe
$sql = "DELETE FROM recipes WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Resep berhasil dihapus";
} else {
    $_SESSION['error'] = "Resep gagal dihapus";
}

header("Location: index.php");


