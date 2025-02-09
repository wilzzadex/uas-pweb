<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    // $id_order = $_POST['id_order'];
    $status    = $_POST['status'];
    
    $anggota=  mysqli_query($conn, "update orders set status='$status'  where code='$id'");

    $query=mysqli_query($conn,"select * from orderdetails WHERE order_id ='$id'");
                while($r=mysqli_fetch_row($query)){
                    mysqli_query($conn,"UPDATE products set status = 'Y' WHERE code = '".$r['2']."'");
                    // var_dump($r[2]);
                    }

    $transaksi = mysqli_fetch_array(mysqli_query($conn, "select * from orderdetails where order_id='$id'"));
    $kembali = $transaksi['sampai'];
    $tanggal = new DateTime($kembali); 
    $sekarang = new DateTime();
    $perbedaan = $tanggal->diff($sekarang);
    echo $perbedaan->d.' selisih hari.';

    $transaksi1 = mysqli_fetch_array(mysqli_query($conn, "select * from orders where code='$id'"));
    $total = $transaksi1['total'];

   

    if($perbedaan->d > 0){
       $denda = $perbedaan->d * $total;
       echo $denda;
    }else{
        $denda = '0';
    }

    $anggota=  mysqli_query($conn, "update orders set denda='$denda'  where code='$id'");
    header('location:../home.php?menu=7');

?>