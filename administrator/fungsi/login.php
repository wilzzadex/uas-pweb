<?php


// http://phpdanmysql.com - memulai session
session_start();
include "../../config/koneksi.php";

$email = $_POST['email'];
$password = md5($_POST['password']);


// query untuk mendapatkan record dari username
$query = "SELECT * FROM users WHERE email = '$email'";
$hasil = mysqli_query($conn,$query);
$data = mysqli_fetch_array($hasil);

// cek kesesuaian password
if ($password == $data['password'])
{
      echo "<script> document.location.href='../home.php'; </script>";
 
    // menyimpan username dan level ke dalam session
    $_SESSION['role'] = $data['role'];
    $_SESSION['nik'] = $data['nik'];
    $_SESSION['name'] = $data['name'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['photo'] = $data['photo'];
    $_SESSION['ktp'] = $data['ktp'];
    $_SESSION['kk'] = $data['kk'];
}
echo "<script>alert('Username atau password salah, ulangi kembali!');javascript:history.go(-1);</script>";


?>