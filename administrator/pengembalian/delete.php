<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $sql=mysqli_query($conn,"delete from orders where code='$id'");
    $sql1=mysqli_query($conn,"delete from orderdetails where order_id='$id'");
    $sql2=mysqli_query($conn,"delete from damages where order_id='$id'");
    header('location:../home.php?menu=4');
?>



