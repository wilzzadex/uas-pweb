<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reza Foto | Ubah Profil</title>
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
      <h1 class="text-title text-center">
        UBAH PROFIL
      </h1>
    </section>

    <!-- Main content -->
    <div class="container">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Ubah Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="prosesedit.php" enctype="multipart/form-data" method="POST">
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
               
                  <input type="hidden" class="form-control" readonly name="id" value="<?php echo $row['code']; ?>">
                </div>
                <div class="form-group">
                  <label>NAMA</label>
                  <input type="text" class="form-control"  name="nama" value="<?php echo $row['name']; ?>">
                </div>
                <div class="form-group">
                  <label>JENIS KELAMIN</label>
                  <select id="inputGen" class="form-control selectpicker" name="jk">
                      <option name="jk"><?php echo $row['gender']; ?></option>
                      <option name="jk">LAKI - LAKI</option>
                      <option name="jk">PEREMPUAN</option>
                    </select>
                </div>
                 <div class="form-group">
                  <label>ALAMAT</label>
                  <input type="text" class="form-control" value="<?php echo $row['address']; ?>"  name="alamat">
                </div>
                <div class="form-group">
                  <label>NO TELP/HP</label>
                  <input type="text" class="form-control" value="<?php echo $row['phone']; ?>"  name="no_hp">
                </div>
                <div class="form-group">
                  <label>EMAIL</label>
                  <input type="email" class="form-control"  name="email" value="<?php echo $row['email']; ?>">
                </div>
                
                <div class="form-group">
                  <label>Foto Profil</label>
                  <img class="thumbnail" src="foto_member/<?php echo $row['photo']; ?>" width="150px">
                  <input type="file" name="foto_profil">
                  <hr>
                  <label>Foto KK</label>
                  <img class="thumbnail" src="foto_kk/<?php echo $row['kk']; ?>" width="150px">
                  <input type="file" name="foto_kk">
                  <hr>
                  <label>Foto KTP</label>
                  <img class="thumbnail" src="foto_ktp/<?php echo $row['ktp']; ?>" width="150px">
                  <input type="file" name="foto_ktp">
                  <hr>
                  <input type="checkbox" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto
                  <div class="form-group">
                    
                      <p style="color:red;">Format Foto Harus JPG, PNG, JPEG !</p>
                   
                  </div>
                  <hr>
                          
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="userpage.php"> <button type="button" class="btn btn-secondary">Kembali</button>

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
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
