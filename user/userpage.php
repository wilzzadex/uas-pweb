<?php

include '../config/koneksi.php';
date_default_timezone_set('ASIA/JAKARTA'); 
$tanggal = date('Y-m-d');
$costumer = "SELECT * FROM expired where exp='$tanggal'"; 
$sql = mysqli_query($conn, $costumer); 
while($row = mysqli_fetch_array($sql)){
  $idm = $row['order_id'];

  // echo $row['exp'];die;
  // if($row['exp'] == $tanggal){
  //   $idm = $row['order_id'];
  //   $transaksi = mysqli_fetch_array(mysqli_query($conn, "select * from orders where code='$idm'"));
  //   $total = $transaksi['total'];
    $sql=mysqli_query($conn,"delete from orders where code='$idm'");
    $sql2=mysqli_query($conn,"delete from orderdetails where order_id='$idm'");
    $sql3=mysqli_query($conn,"delete from expired where order_id='$idm'");


  // }else{
  //   echo $row['order_id'];
  //   echo "masih ada";
  // }
  
}

function autonumber($tabel, $kolom, $lebar = 0, $awalan = '')
      {
        // $conn1 = mysqli_connect("localhost", "dhayouru_dhayoru", "dhayouru123", "dhayouru_rafaesta");
        $conn1 = mysqli_connect("localhost", "root", "", "rezafoto");
      $query = "select $kolom from $tabel order by $kolom desc limit 1";
      $hasil = mysqli_query($conn1, $query);
      $jumlahrecord = mysqli_num_rows($hasil);
      if ($jumlahrecord == 0) {
      $nomor = 1;
      } else {
      $row = mysqli_fetch_array($hasil);
      $nomor = intval(substr($row[0], strlen($awalan))) + 1;
      }
      if ($lebar > 0) {
      $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
      } else {
      $angka = $awalan . $nomor;
      }
      return $angka;
      }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#333">
    <title>Reza Foto</title>
    <meta name="description" content="Material Style Theme">
    <link rel="icon" href="../favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../assets/css/preload.min.css">
    <link rel="stylesheet" href="../assets/css/plugins.min.css">
    <link rel="stylesheet" href="../assets/css/style.light-blue-500.min.css">
    <link rel="stylesheet" href="../assets/css/width-boxed.min.css" id="ms-boxed" disabled="">
    <script>
    function sumharga() {
    var harga = document.getElementById('harga').value;
    var jh = document.getElementById('jh').value;
    var result = harga * jh;
    if (!isNaN(result)) {
    document.getElementById('total').value = result;
    }
    }
    </script>
  </head>
  <body>
    <?php
        include '../config/koneksi.php';

    session_start();

    if (!isset($_SESSION["id_member"])) {
    echo "<script>alert('Error Log');javascript:history.go(-1);</script>";
    } else {
    $id = $_SESSION['id_member'];
    $sql = "SELECT * FROM users where code = '$id'";
    $result = $conn->query($sql);
    $sql2 = "SELECT orders.code,orders.status,orders.jumlah,orders.total,expired.exp FROM orders INNER JOIN expired ON expired.order_id = orders.code where user_id = '$id'";
    $result2 = $conn->query($sql2);
    }
    ?>
    <div class="ms-site-container">
      <br>
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="row">
              <div class="col-lg-12 col-md-6 order-md-1">
                <div class="card animated fadeInUp animation-delay-7">
                  <div class="ms-hero-bg-primary ms-hero-img-coffee">
                    <?php
                    if ($result->num_rows > 0) {
                    $n = 1;
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <h3 class="color-white index-1 text-center no-m pt-4"><?php echo $row["name"]; ?></h3>
                    <div class="color-medium index-1 text-center np-m"></div>
                  <img src="foto_member/<?php echo $row["photo"]; ?>" class="img-avatar-circle"> </div>
                  <div class="card-block pt-4 text-center">
                   
                  </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 order-md-3 order-lg-2">
                <a href="editprofil.php" class="btn btn-info btn-raised btn-block animated fadeInUp animation-delay-12">
                Edit Profil</a>
                <?php
                if ($row["status"] == "Y") {
                echo ' <a href="pemesanan.php" class="btn btn-success btn-raised btn-block animated fadeInUp animation-delay-12">Tambah Pesanan</a>';
                } else {
                echo '<button type="button" class="btn btn-warning btn-raised btn-block animated fadeInUp animation-delay-12" data-toggle="modal">Akun Tidak Aktif</button>';
                }
                ?>
                <a href="editpass.php" class="btn btn-warning btn-raised btn-block animated fadeInUp animation-delay-12">
                UBAH PASSWORD</a>
                <a href="logout.php" class="btn btn-danger btn-raised btn-block animated fadeInUp animation-delay-12" onclick="return confirm('Yakin akan Logout ?');">
                Log Out</a>
              </div>
            </div>
          </div>
          <?php
          $n = $n + 1;
          }
          }
          ?>
          <div class="col-lg-9">
            <div class="card card-primary animated fadeInUp animation-delay-12">
              <div class="card-header">
                <h3 class="card-title" style="text-align: center;">
                Informasi Transaksi</h3>
              </div>
              <table class="table table-no-border table-striped">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>STATUS</th>
                    <th>JUMLAH BARANG</th>
                    <th>TOTAL</th>
                    <th>BATAS PEMBAYARAN</th>
                    <th>Aksi</th>
                  </tr>
                  <tbody>
                    <?php
                    $no = 1;
                    while ($row2 = $result2->fetch_assoc()) {
                    ?>
                    <tr>
                      <td><?php echo $row2['code']; ?></td>
                      <td><?php echo $row2['status']; ?></td>
                      
                      <td><?php echo $row2['jumlah']; ?></td>
                      <td><?php echo "Rp." . number_format($row2['total'], 0, ',', '.'); ?></td>
                      <td><?php echo $row2['exp']; ?></td>
                      <td>
                        <a href="nota.php?id=<?php echo $row2['code']; ?>" style="padding:5px; margin:0px;" target="_blank" class="btn btn-success  btn-sm">Print</a>
                        <a href='#edit_modal' class='btn btn-info btn-sm' style="padding:5px; margin:0px;" data-toggle='modal' data-id="<?=$row2['code'];?>">Upload Bukti</a>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </thead>
              </table>
            </div>
          </div>
          <div class="modal fade" id="edit_modal" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Upload Bukti Pembayaran</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="hasil-data"></div>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
            <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
            <script src="../assets/vendor/jquery-ui/jquery-ui.min.js"></script>
            <script>
            $.widget.bridge('uibutton', $.ui.button);
            </script>
            <!-- container -->
            <script src="../assetsdepan/js/plugins.min.js"></script>
            <script src="../assetsdepan/js/app.min.js"></script>
            <script src="../assetsdepan/js/configurator.min.js"></script>
            <script type="text/javascript">
            <?php echo $jsArray; ?>
            </script>
            <script type="text/javascript">
            $(document).ready(function(){
            $('#edit_modal').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
            type : 'post',
            url : 'modal_upload.php',
            data :  'idx='+ idx,
            success : function(data){
            $('.hasil-data').html(data);//menampilkan data ke dalam modal
            }
            });
            });
            });
            </script>
          </body>
          <!-- Mirrored from agmstudio.io/themes/material-style/2.0.4/page-profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Jan 2018 02:06:38 GMT -->
        </html>
        ?>