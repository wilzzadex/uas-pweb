<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $sql=mysqli_query($conn,"delete from damages where id='$id'");
    header('location:../home.php?menu=8');
?>

