<?php

require_once "../config/koneksi.php";
require_once "../utils/jsonformatter.php";
include "../utils/helper.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['id'];
    $id = $_POST["id"];
    $title = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $categoryId = trim($_POST["category_id"]);
    $status = trim($_POST["status"]);
    $bahan = $_POST["nama_bahan"];
    $langkah = $_POST["petunjuk"];

    if (count($bahan) == 0) {
        $_SESSION['error'] = "Bahan tidak boleh kosong";
        header("Location: index.php");
        exit();
    }

    if (count($langkah) == 0) {
        $_SESSION['error'] = "Langkah tidak boleh kosong";
        header("Location: index.php");
        exit();
    }

    $uploadOk = 1;
    $filename = "";

    if (!empty($_FILES['image']['name'])) {
        // save image
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $filename = md5(basename($_FILES["image"]["name"]) . time()) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
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
            header("Location: index.php");
            exit();
        } else {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $_SESSION['error'] = "File gagal diupload";
                header("Location: index.php");
                exit();
            }
        }
    }

    if ($uploadOk == 1) {
        if (!empty($filename)) {
            $sql = "UPDATE recipes SET category_id='$categoryId', image='$filename', title='$title', description='$description', status='$status', updated_at=now() WHERE id='$id' AND user_id='$userId'";
        } else {
            $sql = "UPDATE recipes SET category_id='$categoryId', title='$title', description='$description', status='$status', updated_at=now() WHERE id='$id' AND user_id='$userId'";
        }
        $result = $conn->query($sql);

        if ($result) {
            // Delete old ingredients and directions
            $conn->query("DELETE FROM recipe_ingredients WHERE recipe_id='$id'");
            $conn->query("DELETE FROM recipe_directions WHERE recipe_id='$id'");

            // Insert new ingredients and directions
            foreach ($bahan as $key => $value) {
                $sql = "INSERT INTO recipe_ingredients (recipe_id, item) VALUES ('$id', '$value')";
                $conn->query($sql);
            }

            foreach ($langkah as $key => $value) {
                $sql = "INSERT INTO recipe_directions (recipe_id, step) VALUES ('$id', '$value')";
                $conn->query($sql);
            }

            $_SESSION['success'] = "Resep berhasil diperbarui";
        } else {
            $_SESSION['error'] = "Resep gagal diperbarui";
        }
    }

    header("Location: ../dashboard/index.php");
    exit();
}