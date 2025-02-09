<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reza Foto | Ubah Password</title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png"/>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body style="background: #e3f2fd;">
<div class="wrapper">

  <div class="wrapper">
    <section class="content-header">
      <h1 class="text-center">
        UBAH PASSWORD

      </h1>

    </section>
<div class="container">
    <!-- Main content -->
    <section class="content">

      <div class="row">

      	<div class="col-md-3"></div>
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary mt-10">
            <div class="box-header with-border">
              <h3 class="box-title">Form Ubah Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="prosesubahpass.php" enctype="multipart/form-data" method="POST">
              <?php
                include "../config/koneksi.php";
                session_start();
                $id = $_SESSION['id_member'];

                $costumer = "SELECT * FROM users where code='$id'"; 
                $sql = mysqli_query($conn, $costumer); 
                while($row = mysqli_fetch_array($sql)){
              ?>

              <div class="box-body">
                <div class="form-group">
                	<input type="hidden" value="<?= $row['code']; ?>" name="id">
                  <label>Password Lama</label>
                  <input type="password" class="form-control"  name="c_password" value="" required="" placeholder="Masukan Password Lama ..">
                </div>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input type="password" class="form-control" id="n_password" name="n_password" value="" required="" placeholder="Masukan Password Baru ..">
                </div>
                
                 <div class="form-group">
                  <label>Ulangi Pasword</label>
                  <input type="password" class="form-control" value="" id="n_password2" name="n_password2" required="" placeholder="Ulangi Password Baru ..">
                </div>
                
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="userpage.php"> <button type="button" class="btn btn-secondary">Kembali</button>
              </a>
              </div>
              <?php
                }
                ?>
            </form>
          </div>
          </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script src="../assetsdepan/js/vendor/jquery-1.11.1.min.js"></script>
<script src="../assetsdepan/js/bootstrap.min.js"></script>


<script type="text/javascript">
  
  $(document).ready(function(){
    $('#n_password2').keyup(function(){

    var pass1 = $('#n_password').val();
    var pass2 = $('#n_password2').val();
        if(pass2!=pass1){
          $('#n_password2').css('border-color','red');
          return false;
        }else{
          $('#n_password2').css('border-color','green');
          return true;
        }
    });
    
  });

</script>


</body>
</html>
