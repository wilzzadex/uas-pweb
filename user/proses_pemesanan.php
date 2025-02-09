<?php 

include '../config/koneksi.php';


$id = $_POST['kode'];

$awal = $_POST['awal'];
$akhir = $_POST['akhir'];
$jam_mulai = $_POST['jam_mulai'];
// $jam_akhir = $_POST['jam_akhir'];

$jumlah = $_POST['jumlah'];
$total = $_POST['harga'];






$query = "INSERT INTO sementara VALUES('','".$id."','".$awal."','".$akhir."','$jam_mulai','$jam_mulai','1','$total')";
			$sql = mysqli_query($conn,$query);


	
    



			header('location:pemesanan.php');


 ?>