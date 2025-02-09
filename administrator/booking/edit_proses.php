<?php
    include '../../config/koneksi.php';
    $id = $_POST['id'];
    $status    = $_POST['status'];
    
    $anggota=  mysqli_query($conn, "update orders set status='$status'  where code='$id'");
    // header('location:../home.php?menu=4');
?>
<script>
	
	javascript:history.go(-1);
</script>