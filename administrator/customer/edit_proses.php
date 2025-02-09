<?php
include "../../config/koneksi.php";
// include "sendEmail-v156.php";

$code = $_POST['code'];
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = 123456;
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$telp = $_POST['tlp'];
$tgl_daftar = date("Y-m-d H:i:s");	
$fotomember = $_FILES['fotomember']['name'];
$tmpmember = $_FILES['fotomember']['tmp_name'];
$fotoktp = $_FILES['fotoktp']['name'];
$tmpktp = $_FILES['fotoktp']['tmp_name'];
$fotokk = $_FILES['fotokk']['name'];
$tmpkk = $_FILES['fotokk']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobarumember = date('dmYHis').$fotomember;
$fotobaruktp = date('dmYHis').$fotoktp;
$fotobarukk = date('dmYHis').$fotokk;

// Set path folder tempat menyimpan fotonya
$path1 = "../../user/foto_member/".$fotobarumember;
$path2 = "../../user/foto_ktp/".$fotobaruktp;
$path3 = "../../user/foto_kk/".$fotobarukk;

// if(empty($fotomember)){


// }


// Proses upload
if(move_uploaded_file($tmpmember, $path1) && move_uploaded_file($tmpktp, $path2)&& move_uploaded_file($tmpkk, $path3)){ // Cek apakah gambar berhasil diupload atau tidak
	// Proses simpan ke Database
	$query = "UPDATE users set nik='$nik,name='$nama',email='$email',gender='$jk',address='$alamat',phone='$telp',photo='$fotobarumember',kk='$fotobarukk',ktp='$fotobaruktp' where code = '$code'";
	$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		
		?>
		<script language="javascript">
			alert('Data Berhasil Diubah');
			document.location.href="../home.php?menu=3";
		</script>
		<?php
	    
	}else{
		// Jika Gagal, Lakukan :
		?>
		<script language="javascript">
			alert('Database Gagal');
			javascript:history.go(-1);
		</script>
		<?php
	}
}else{
	// Jika gambar gagal diupload, Lakukan :
	?>
	<script language="javascript">
		alert('Upload Gagal');
		javascript:history.go(-1);
	</script>
	<?php
}

?>
