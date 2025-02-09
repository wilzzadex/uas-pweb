<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $code    = $_POST['code'];
    $produk    = $_POST['produk'];
    $informasi   = $_POST['informasi'];
    
    $anggota=  mysqli_query($conn, "update damages set order_id='$code',product_id='$produk',information='$informasi' where id='$id'");
    header('location:../home.php?menu=8');
?>