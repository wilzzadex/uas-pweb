<?php
    include 'config/koneksi.php';
    
    function autonumber($tabel, $kolom, $lebar=0, $awalan=''){
        $conn1 = mysqli_connect("localhost" , "root" , "" , "rezafoto");
        $query="select $kolom from $tabel order by $kolom desc limit 1";
        $hasil= mysqli_query($conn1, $query);
        $jumlahrecord = mysqli_num_rows($hasil);
        if($jumlahrecord == 0)
            $nomor=1;
        else{
        $row=mysqli_fetch_array($hasil);
            $nomor=intval(substr($row[0],strlen($awalan)))+1;
        }
        if($lebar>0)
            $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        else
            $angka = $awalan.$nomor;
        return $angka;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="html 5 template">
  <meta name="author" content="tonytemplates.com">
  <link rel="icon" href="favicon.ico">
  <title>Reza Foto | Daftar Member</title>
  <!-- Bootstrap core CSS -->
  <link href="assets/css/plugins/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/plugins/jquery.smartmenus.bootstrap.css" rel="stylesheet">
  <link href="assets/css/main-style.css" rel="stylesheet">
  <link href="iconfont/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
</head>

<body class="page__about">
<!-- Loader -->
<!-- <div class="plash">
  <div id="scene">
    <span></span>
    <div id="road">
      <div id="stripes"></div>
    </div>
  </div>
  <div class="loading">Loading<span>...</span></div>
</div> -->
<!-- //Loader --> 
  <!-- Header -->
  <header class="site-header">
    <div class="mobile-top-panel"></div>
    <div class="mobile-top-panel__fixed">
      <div class="container">
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
        </div>
        <div class="social-list">
          <span class="social-list__text">Find us here:</span>
          <ul class="social-list__icons">
            <li><a href="#"><i class="icon-facebook-logo"></i></a></li>
            <li><a href="#"><i class="icon-twitter-letter-logo"></i></a></li>
            <li><a href="#"><i class="icon-google-plus"></i></a></li>
            <li><a href="#"><i class="icon-linkedin-logo"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="header-container_wrap container">
      <div class="header-container__flex">
        <div class="logo">
        <a href="index.php">
            <img src="assets/images/logo.png" alt="" width="100px">
            <span>Reza</span>Foto
          </a>
        </div>
        <div class="social-list">
          <span class="social-list__text">Pesan Sekarang :</span>
          <ul class="social-list__icons">
            <li><a href="user/index.php">MASUK</a></li>
          </ul>
        </div>
       
      </div>
    </div>
    <div class="header-navigation-wrap stickUp"> 
      <!-- Navbar fixed top -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="menu-navigation navbar-collapse collapse">

          <!-- Left nav -->
          
          </div><!--/.nav-collapse -->
        </div><!--/.container -->
      </div>
    </div>

  </header>
  <!-- // Header -->

  <!-- Content  -->
  <main id="page-content">
    <div class="container">
  <br>
  <h2 align="center">Daftar Member Baru</h2>
  <form method="post" action="user/simpan.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" class="form-control" required name="nik">
          <input type="hidden" class="form-control" required name="code" value="<?= autonumber("users", "code", 4, "MBR")?>">
        </div>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" required name="nama" onkeyup="this.value = this.value.toUpperCase()">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" required name="email" >
        </div>
       
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" required name="password" >
        </div>  
        <div class="form-group">
          <label for="jenis_kelamin">Jenis Kelamin</label><br>
          <select class="form-control" required name="jk">
            <option name="jk" value="" selected="selected">---</option>
            <option name="jk" value="LAKI - LAKI">LAKI - LAKI</option>
            <option name="jk" value="PEREMPUAN">PEREMPUAN</option>
          </select>
        </div>
        <div class="form-group">
          <label for="telp">Alamat</label>
          <input type="text" class="form-control" required name="alamat">
        </div>
        <div class="form-group">
          <label for="Telp">No HP</label>
          <input type="text" class="form-control" required name="tlp" >
        </div>  
        <div class="form-group">
          <label for="fotomember">Foto Member</label>
          <input type="file" required class="form-control" name="fotomember">        
        </div> 
        <div class="form-group">
          <label for="fotoktp">Foto KTP</label>
          <input type="file" required class="form-control" name="fotoktp">        
        </div> 
        <div class="form-group">
          <label for="fotoktp">Foto KK</label>
          <input type="file" required class="form-control" name="fotokk">        
        </div> 
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
</div>
  </main>
  <!-- // Content  -->

  <!-- Footer -->
 

  <!-- //Footer -->

  <script src="assets/js/jquery.1.12.4.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
  <script src="assets/js/plugins/jquery.smartmenus.min.js"></script>
  <script src="assets/js/plugins/jquery.smartmenus.bootstrap.js"></script>
  <script src="assets/js/plugins/stickup.min.js"></script>
  <script src="assets/js/plugins/tool.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>

