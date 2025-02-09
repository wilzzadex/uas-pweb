<?php 

include '../config/koneksi.php';


$id = $_POST['id'];
$c_pass = $_POST['c_password'];
$n_pass = $_POST['n_password'];
$n_pass2 = $_POST['n_password2'];



  $query = "SELECT * FROM users WHERE code='$id'";
  $exect = mysqli_query($conn,$query);

  while ($row = mysqli_fetch_array($exect)) {
  	if(md5($c_pass) != $row['password']){
  		?>
			<script language="javascript">
				alert('Password Lama Salah !');
				// 
				javascript:history.go(-1);
			</script>
  		<?php
  	}else{
  		if($n_pass != $n_pass2){
  			?>
			<script language="javascript">
				alert('Password Tidak Sama !');
				// 
				javascript:history.go(-1);
			</script>
  		<?php
  		}else{
  			$query = "UPDATE users SET password='".md5($n_pass)."' WHERE code = '$id' ";
  			$ext = mysqli_query($conn,$query);
  			if($ext){
  				?>
			<script language="javascript">
				alert('Password Berhasil Diubah');
				// 
				document.location.href='userpage.php';
			</script>
  		<?php
  			}else{
  				?>
			<script language="javascript">
				alert('gagal!');
				// 
				document.location.href('userpage.php');
			</script>
  		<?php
  			}
  		}

  	}
  }



 ?>