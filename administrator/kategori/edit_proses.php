<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $nama    = $_POST['nama'];
    $informasi   = $_POST['informasi'];
    $anggota=  mysqli_query($conn, "update categories set name='$nama' , information='$informasi' where id='$id'");
    header('location:../home.php?menu=2');
?>