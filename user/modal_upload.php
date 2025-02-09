<?php
include '../config/koneksi.php';
if ($_POST['idx']) {
$id = $_POST['idx'];
$sql = mysqli_query($conn, "select * from orders where code='$id'");
while ($row = mysqli_fetch_array($sql)) {
  // $nama = $row['id_member'];
?>
<form action="proses_upload.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?=$row['code'];?>">
   
  
  
  <div class="form-group">
    <label>Foto<p><button class="btn btn-success btn-sm btn-raised">Pilih Foto</button></p></label>
    <input type="file" name="foto" value="" required="">
  </div>
  <?php }?>
  <button class="btn btn-primary btn-block btn-raised" type="submit">Upload</button>
</form>
<?php }

?>