<?php 	

include "../config/koneksi.php";


$id = $_GET['id'];


 $query = "DELETE FROM sementara WHERE id='$id'";
 $hasil2 = mysqli_query($conn,$query);
if($hasil2){ // Cek jika proses simpan ke database sukses atau tidak

		header('location:pemesanan.php');
	}else{
		// Jika Gagal, Lakukan :
		echo "	GAGAL";
		
	}


 ?>