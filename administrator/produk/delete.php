<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $sql=mysqli_query($conn,"delete from products where id='$id'");
    header('location:../home.php?menu=1');
?>

