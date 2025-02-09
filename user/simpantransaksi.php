<?php 
// koneksi database
include '../config/koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan=''){
	$host = "localhost";
	$usr = "root";
	$pwd = "";
	$dbname = "rentalmobil";
	$conn = mysqli_connect($host, $usr, $pwd, $dbname);
	if(mysqli_connect_error()){
		echo 'database gagal dikoneksikan!'.mysqli_connect_error();
	}
	$auto = mysqli_query($conn, "select $kolom from $tabel order by $kolom desc limit 1") or die(mysqli_error());
	$jumlah_record = mysqli_num_rows($auto);
	if($jumlah_record == 0)
		$nomor = 1;

	else{
		$row = mysqli_fetch_array($auto);
		$nomor = intval(substr($row[0], strlen($awalan)))+1;
	}
	if($lebar>0)
		$angka = $awalan.str_pad ($nomor, $lebar, "0", STR_PAD_LEFT);
	else
		$angka=$awalan.$nomor;
	return $angka;
}
date_default_timezone_set('ASIA/JAKARTA');
$id = autonumber("transaksi", "no_transaksi", 4, "TRS");
$id_member = $_POST['id_member'];
$id_mobil = $_POST['id_mobil'];
$tgl_pesan = $_POST['tgl_pesan'];
$jam_pesan = $_POST['jam_pesan'];
$sopir = $_POST['sopir'];
$antar = $_POST['antar'];
$alamatanter = $_POST['alamatanter'];
$jumlah_hari = $_POST['jh'];

$tambah_tanggal = date('Y-m-d', strtotime("+".$jumlah_hari."days", strtotime($tgl_pesan))); // angka 2,7,1 yang dicetak tebal bisa dirubah rubah
//$harga = $_POST['harga'];
$total = $_POST['total'];

$query = mysqli_fetch_array(mysqli_query($koneksi, "select * from mobil where id_mobil='$id_mobil'"));
$harga = $query['harga'];

$member = mysqli_fetch_array(mysqli_query($koneksi, "select * from member where id_member='$id_member'"));
$nama = $member['nama'];

$atur = mysqli_fetch_array(mysqli_query($koneksi, "select * from pengaturan where id=1"));
$tsopir = $atur['sopir'];

if ($sopir == 'TIDAK') {
	$total = $total ;

} elseif ($sopir == 'YA') {
	$total = ($tsopir*$jumlah_hari) + $total;

} 

$hasil = $total;

$query2 = "INSERT INTO transaksi (no_transaksi,id_member,nama,id_mobil,tgl_pesan,jam_pesan,tgl_exp,jam_exp,status,sopir,antar,alamatantar,total_harga) VALUES ('$id', '$id_member','$nama', '$id_mobil', '$tgl_pesan', '$jam_pesan', '$tambah_tanggal', '$jam_pesan','BELUM BAYAR','$sopir','$antar','$alamatanter','$hasil')";

$mobilstatus=  mysqli_query($koneksi, "update mobil set statusmobil='TIDAK TERSEDIA' where id_mobil='$id_mobil'");
$sql = mysqli_query($koneksi, $query2);

if($sql){
	?>
	<script language="javascript">
		alert('Berhasil Disimpan');
		document.location.href="profil.php";
	</script>
	<?php		
}else{
	?>
	<script language="javascript">
		alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');
		document.location.href="profil.php";
	</script>
<?php
}

?>