<?php
// Load file koneksi.php
include "../../config/koneksi.php";

$nama = $_POST['name'];
$informasi = $_POST['informasi'];
// Proses simpan ke Database
$query = "INSERT INTO categories(id,name,information) values ('','$nama','$informasi') ";
	$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		?>
		<script language="javascript">
			alert('Berhasil Disimpan');
			document.location.href="../home.php?menu=2";
		</script>
		<?php		
	}else{
		// Jika Gagal, Lakukan :
		?>
		<script language="javascript">
			alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');
			document.location.href="../home.php?menu=2";
		</script>
		<?php
	}
?>
