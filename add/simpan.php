<?php


require_once "../config/koneksi.php";
require_once "../utils/jsonformatter.php";
include "../utils/helper.php";


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_SESSION['id'];
    $title = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $categoryId = trim($_POST["category_id"]);
    $status = trim($_POST["status"]);
    $image = $_FILES['image']['name'];
    $bahan = $_POST["nama_bahan"];
    $langkah = $_POST["petunjuk"];

    if (count($bahan) == 0) {
        $_SESSION['error'] = "Bahan tidak boleh kosong";
        header("Location: index.php");
    }

    if (count($langkah) == 0) {
        $_SESSION['error'] = "Langkah tidak boleh kosong";
        header("Location: index.php");
    }

    // save image
    $target_dir = "../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $filename = md5(basename($_FILES["image"]["name"]) . time()) . "." . pathinfo($image, PATHINFO_EXTENSION);
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['error'] = "File yang diupload bukan gambar";
        $uploadOk = 0;
    }

    // Check file size 2MB
    if ($_FILES["image"]["size"] > 2000000) {
        $_SESSION['error'] = "Ukuran file terlalu besar";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['error'] = "Hanya file JPG, JPEG, PNG yang diperbolehkan";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $_SESSION['error'] = "File gagal diupload";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO recipes (user_id,category_id,image,title,description,status,created_at,updated_at) VALUES ('$userId','$categoryId','$filename','$title','$description','$status',now(),now())";
            $result = $conn->query($sql);

            if ($result) {
                $recipeId = $conn->insert_id;

                foreach ($bahan as $key => $value) {
                    $sql = "INSERT INTO recipe_ingredients (recipe_id, item) VALUES ('$recipeId', '$value')";
                    $conn->query($sql);
                }

                foreach ($langkah as $key => $value) {
                    $sql = "INSERT INTO recipe_directions (recipe_id, step) VALUES ('$recipeId', '$value')";
                    $conn->query($sql);
                }

                $_SESSION['success'] = "Resep berhasil disimpan";
            } else {
                $_SESSION['error'] = "Resep gagal disimpan";
            }
        } else {
            $_SESSION['error'] = "File gagal diupload";
        }
    }

    header("Location: ../dashboard/index.php");
}
