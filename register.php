<?php 

// Include config file
require_once "config/koneksi.php";
require_once "utils/jsonformatter.php";

// Define variables and initialize with empty values
$nama = $password = $konfirmasi_password = $email = "";
$nama_err = $password_err = $konfirmasi_password_err = $email_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // validate nama 
    if(empty(trim($_POST["nama"]))){
        $nama_err = "Nama tidak boleh kosong";
        return json_response($nama_err, 400);
    } else{
        $nama = trim($_POST["nama"]);
    }

    // validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Email tidak boleh kosong";
        return json_response($email_err, 400);
    } else{
        $email = trim($_POST["email"]);
    }

    // validate email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Format email tidak valid";
        return json_response($email_err, 400);
    }

    // validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Password tidak boleh kosong";
        return json_response($password_err, 400);
    } else{
        $password = trim($_POST["password"]);
    }

    // validate konfirmasi password
    if(empty(trim($_POST["konfirmasi_password"]))){
        $konfirmasi_password_err = "Konfirmasi password tidak boleh kosong";
        return json_response($konfirmasi_password_err, 400);
    } else{
        $konfirmasi_password = trim($_POST["konfirmasi_password"]);
        if(empty($password_err) && ($password != $konfirmasi_password)){
            $konfirmasi_password_err = "Password tidak sesuai";
            return json_response($konfirmasi_password_err, 400);
        }
    }

    // check if email already exists
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $email_err = "Email sudah terdaftar";
        return json_response($email_err, 400);
    }


    // save data to database
    try {
        $fixpassword = md5($password);
        $sql = "INSERT INTO users (name, email, password, created_at, updated_at) VALUES ('$nama', '$email', '$fixpassword', now(), now())";
        $result = mysqli_query($conn, $sql);
        return json_response("Registrasi berhasil", 200);
    } catch (\Throwable $th) {
        return json_response($th->getMessage(), 400);
    }
   

   




}

