<?php
    include '../../config/koneksi.php';
    $id = $_GET['id'];
    $password = md5(123456);
    $sql=mysqli_query($conn,"UPDATE users set password = '$password' where id='$id'");
   
?>
    <script>
    alert('Password Berhasil Di Reset');
    document.location.href="../home.php?menu=3";
    </script>
