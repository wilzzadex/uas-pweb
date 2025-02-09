<?php 

// Include config file
require_once "config/koneksi.php";
require_once "utils/jsonformatter.php";

session_start();

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
   
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

    

    // save data to database
    try {
        // logic for login with md5 password
        $encrypted_password = md5($password);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$encrypted_password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $data['id'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['name'] = $data['name'];

            return json_response('', 200);
        } else {
            return json_response("Email atau password salah", 400);
        }
        return json_response("Login berhasil", 200);
    } catch (\Throwable $th) {
        return json_response($th->getMessage(), 400);
    }
}

