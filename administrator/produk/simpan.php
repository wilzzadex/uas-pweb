<?php
// Load file koneksi.php
include "../../config/koneksi.php";

$id = $_POST['kode'];
$nama = $_POST['name'];
$kategori = $_POST['kategori'];
$brand = $_POST['brand'];
$price = $_POST['price'];
$foto = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
$namavalid = str_replace(" ", "_", $foto);
$fotoren = date('dmYHis') . $namavalid;
$path = "foto/" . $fotoren;
$eksvalid = ['png', 'PNG'];
$ekstensi = explode(".", $foto);
$ekstensival = strtolower(end($ekstensi));
// Proses simpan ke Database
if (!in_array($ekstensival, $eksvalid)) {
	echo "<script>alert('Format Gambar tidak didukung !');javascript:history.go(-1);</script>";
	return false;
} else {
if (move_uploaded_file($tmp, $path)) {
	$query = "INSERT INTO products VALUES('','" . $id . "','" . $fotoren . "','" . $nama . "','" . $kategori . "','" . $brand . "','" . $price . "','Y')";
	$sql = mysqli_query($conn, $query);
	if ($sql) {
		
		?>
		<script language="javascript">
			alert('Produk Berhasil Di tambahkan !');
			document.location.href="../home.php?menu=1";
		</script>
		<?php
	} else {
		?>
		<script language="javascript">
			alert('Kesalahan Sistem!');javascript:history.go(-1);
		</script>
<?php 	}	

}
}
?>
