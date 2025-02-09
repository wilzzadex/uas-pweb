<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $foto = $_POST['foto'];
    $kk = $_POST['kk'];
    $ktp = $_POST['ktp'];
    $code = $_POST['code'];
    unlink("../../user/foto_member/".$foto."");
    unlink("../../user/foto_ktp/".$ktp."");
    unlink("../../user/foto_kk/".$kk."");
    $sql2=mysqli_query($conn,"delete from orderdetails where customer_id='$code'");
    $sql=mysqli_query($conn,"delete from users where id='$id'");
    $sql3=mysqli_query($conn,"delete from orders where user_id='$code'");

   
    header('location:../home.php?menu=3');
?>
