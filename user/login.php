<?php
    session_start();
    include "../config/koneksi.php";

    $username = $_POST['email'];
    $password = md5($_POST['password']);

            $query = "SELECT * FROM users WHERE email = '$username'";
            $hasil = mysqli_query($conn, $query);
            $data = mysqli_fetch_array($hasil);
             
            if (($password) == $data['password'])
            {
                //echo "<script> document.location.href='viewp.php'; </script>";
                 echo "<script>
                alert('Anda Berhasil Login');
                 </script>
                 ";
                $_SESSION['id_member'] = $data['code'];
                $_SESSION['nik'] = $data['nik'];
                $_SESSION['name'] = $data['name'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['gender'] = $data['gender'];
                $_SESSION['password'] = $data['password'];
              
                echo "<script> document.location.href='userpage.php'; </script>";
            }
            else{
            echo "<script>alert('Username atau password salah, ulangi kembali!');javascript:history.go(-1);</script>";
            }
       
?>