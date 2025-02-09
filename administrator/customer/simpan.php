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

$sqlCommand = "SELECT  COUNT(*) FROM users where nik='$nik'"; 
$query = mysqli_query($conn, $sqlCommand) or die (mysqli_error()); 
$cek = mysqli_fetch_row($query);
if($cek[0]>0){
	?>
	<script language="javascript">
			alert("Nik Telah Terdaftar");
			javascript:history.go(-1);
	</script>
	<?php
}else{

// Proses upload
if(move_uploaded_file($tmpmember, $path1) && move_uploaded_file($tmpktp, $path2)&& move_uploaded_file($tmpkk, $path3)){ // Cek apakah gambar berhasil diupload atau tidak
	// Proses simpan ke Database
	$query = "INSERT INTO users VALUES('','".$code."','".$nik."', '".$nama."', '".$email."','NULL', '".$jk."', '".$alamat."','".$telp."', '".$fotobarumember."', '".$fotobaruktp."', '".$fotobarukk."','".md5($password)."','customer','Y','NULL')";
	$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		
		?>
		<script language="javascript">
			alert('Pendaftaran Berhasil');
			document.location.href="../home.php?menu=3";
		</script>
		<?php
		include "../../classes/class.phpmailer.php";
		$body = 
		"<body style='margin: 10px;'>
		<div style='width: 640px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
		<br>
		<strong>Terima Kasih Telah Mendaftar</strong><br>
		<b>Nama Anda : </b>".$nama."<br>
		<b>Email : </b>".$email."<br>
		<b>Password Default : </b>123456<br><br>
		<b>Gunakan akun diatas untuk melakukan booking atau mengecek status pesanan anda dan</b><br>
		<b>Segera Ubah password untuk melindungi akun anda !</b>

		<br>
		</div>
		</body>";
		$mail = new PHPMailer; 
		$mail->IsSMTP();
		$mail->SMTPSecure = 'ssl'; 
		$mail->Host = "smtp.gmail.com"; //host masing2 provider email
		$mail->SMTPDebug = 2;
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->Username = 'waliyudinahmad1933@gmail.com';       
		$mail->Password= 'Zadexboys1933';   //password email 
		$mail->SetFrom("waliyudinahmad1933@gmail.com","REZA FOTO"); //set email pengirim
		$mail->Subject = "Pendaftaran Akun Reza Foto"; //subyek email
		$mail->addAddress($email,$nama);  //tujuan email
		$mail->MsgHTML($body);
		if($mail->Send()) echo "Message has been sent";
		else echo "Failed to sending message";
	    
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
}
?>
