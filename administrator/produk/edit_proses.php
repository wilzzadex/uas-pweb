<?php
    include '../../config/koneksi.php';
    $id = $_POST['code'];
    $nama    = $_POST['nama'];
    $kategori   = $_POST['kategori'];
    $brand   = $_POST['brand'];
    $price   = $_POST['price'];
    
    $anggota=  mysqli_query($conn, "update products set name='$nama' , category_id='$kategori', brand='$brand', price='$price' where code='$id'");
    header('location:../home.php?menu=1');
?>