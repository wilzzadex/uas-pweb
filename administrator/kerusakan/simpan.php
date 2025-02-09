<?php
// Load file koneksi.php
include "../../config/koneksi.php";
// 
// $id = $_POST['idanggota'];
$id_order = $_POST['code'];
$id_produk = $_POST['produk'];
$informasi = $_POST['informasi'];

// Proses simpan ke Database
$query = "INSERT INTO damages values ('','$id_order','$id_produk','$informasi') ";
	$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		?>
		<script language="javascript">
			alert('Berhasil Disimpan');
			document.location.href="../home.php?menu=8";
		</script>
		<?php		
	}else{
		// Jika Gagal, Lakukan :
		?>
		<script language="javascript">
			alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');
			document.location.href="../home.php?menu=8";
		</script>
		<?php
	}
?>
s