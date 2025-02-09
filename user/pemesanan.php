<?php
  
  include '../config/koneksi.php';
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
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reza Foto | Pemesanan</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/vendor/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/skins/_all-skins.min.css">
    <link href="../assets/fm.selectator.jquery.css" rel="stylesheet"/>
    <style>
        /* .container{
            width: 600px;
            margin: 30px auto;
        } */
        select{
            width: 100%;
        }
    </style>
  </head>
  <body style="background: #e3f2fd;">
    <div class="wrapper">
      <div class="wrapper">
        <section class="content-header">
          <h1 class="text-center">
          Halaman Pemesanan
          </h1>
        </section>
        <div class="container">
          <!-- Main content -->
          <section class="content">
            <div class="row">
              
              <!-- left column -->
              <div class="col-md-12">
                <h2>
                <?php  $idts =  autonumber("orders", "code", 4, "TRN");?>
                <a><small>No Order : <?php echo $idts;?></small></a>
                <input type="hidden" name="nota" value="<?= autonumber("penjualan", "notapen", 4, "PN")?>">
                </h2>
                <!-- general form elements -->
                <div class="box">
                  <div class="box-header">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah">
                    Tambah Order
                    </button>
                    <a href="userpage.php" type="button" class="btn btn-info fa fa-home pull-right">
                      
                    </a>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>NAMA BARANG</th>
                          <th>AWAL</th>
                          <th>AKHIR</th>
                          <th>JAM MULAI</th>
                          <th>JAM AKHIR</th>
                          <!-- <th>JUMLAH</th> -->
                          <th>TOTAL</th>
                          <th>  </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT * FROM sementara"; // Query untuk menampilkan semua data siswa
                        $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                        echo "<tr>";
                          echo "<td align='center'>".$no++."</td>";
                          $idx = $data['id'];
                          $idb = $data['product_id'];
                          $query2 = "SELECT * FROM products where code='$idb' ";
                          $sql2 = mysqli_query($conn,$query2);
                          while($data2= mysqli_fetch_array($sql2)){
                            echo "<td align='center'>".$data2['name']." - " .$data2['brand']."</td>";
                          
                          }
                          // echo "<td>".$data['type_barang']."</td>";
                          
                          echo "<td>".$data['dari']."</td>";
                          echo "<td>".$data['sampai']."</td>";
                          echo "<td>".$data['jam_mulai']."</td>";
                          echo "<td>".$data['jam_akhir']."</td>";
                          // echo "<td>".$data['jumlah']."</td>";
                          echo "<td>".$data['total_harga']."</td>";
                          $j = $data['jumlah'];
                 
                          // echo "<td>Rp.".number_format($data['total'],2,',','.')."</td>";
                          echo "<td><a href='deletepesanan.php?id=$idx' class='btn btn-danger btn-sm'>X</a></td>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    

                    <!-- /.box-body -->
                  </div>
                  <div class="box box-danger">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-10">
                          <?php $total=mysqli_fetch_array(mysqli_query($conn,"select sum(total_harga) as total from sementara"));?>
                          <h4 class="box-title">Total : <?php echo "Rp.".number_format($total['total'],2,',','.') ?></h4>
                          <input type="hidden" name="total_harga" value="<?= $total['total']; ?>">
                        </div>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-bayar">Booking</button>
                      </form>
                      
                    </div>
                  </div>
                  <!-- /.box-body -->

                </div>
              </section>
              <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tambah Order</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="proses_pemesanan.php" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="id_mobil">Produk</label><br>
                          <?php
                          $result = mysqli_query($conn, "select * from products WHERE status='Y'");
                          $jsArray = "var harga1 = new Array();\n";
                          
                          echo '<select id="selectbox1" class="form-control selectpicker" name="kode" onchange="document.getElementById(\'tharga\').value = harga1[this.value]">';
                            echo '<option>-----</option>';
                            while ($row = mysqli_fetch_array($result)) {
                              echo '<option value="' . $row['code'] . '">' . $row['name'] ." - ". $row['brand'].'</option>';
                              $jsArray .= "harga1['" . $row['code'] . "'] = '" . addslashes($row['price']) . "';\n";
                            }
                          echo '</select>';
                          ?>
                        </div>
                        <div class="form-group">
                          <label for="pabrik">Harga Sewa /Hari</label>
                          <input type="text" readonly="" class="form-control" placeholder="Harga" name="harga" id="tharga" >
                        </div>
                        <div class="form-group">
                            <label for="">Awal</label>
                            <input type="date" class="form-control" name="awal">
                        </div>
                        <div class="form-group">
                            <label for="">Akhir</label>
                            <input type="date" class="form-control" name="akhir">
                        </div>
                        <div class="form-group">
                            <label for="">Jam Mulai</label>
                            <select name="jam_mulai" id="" class="form-control">
                            <option value="08:00:00">08:00</option>
                            <option value="09:00:00">09:00</option>
                            <option value="10:00:00">10:00</option>
                            <option value="11:00:00">11:00</option>
                            <option value="12:00:00">12:00</option>
                            <option value="13:00:00">08:00</option>
                            <option value="14:00:00">14:00</option>
                            <option value="15:00:00">15:00</option>
                            <option value="16:00:00">16:00</option>



                            </select>
                            <!-- <input type="time" class="form-control" name="jam_mulai"> -->
                        </div>
                        <!-- <div class="form-group">
                            <label for="">Jam Akhir</label>
                            <input type="time" class="form-control" name="jam_akhir">
                        </div> -->
                        <!-- <div class="form-group">
                          <label for="type">Jumlah</label>
                          <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" onkeyup="sumharga();" id="jumlah" onkeypress="return hanyaAngka(event)">
                          <script>
                          function hanyaAngka(evt) {
                          var charCode = (evt.which) ? evt.which : event.keyCode
                          if (charCode > 31 && (charCode < 48 || charCode > 57))
                          
                          return false;
                          return true;
                          }
                          </script>
                        </div> -->
                        <!-- <div class="form-group">
                          <label for="type">Total</label>
                          <input type="text" readonly class="form-control" required name="total" id="total">
                        </div> -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              </div>
              <!-- /.row -->
            </section>
            <!-- /.content -->
            
          </div>
          <div class="modal fade" id="modal-bayar">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                  <form method="post" action="transaksi.php" enctype="multipart/form-data">
                   
                    <div class="alert alert-warning">Apakah anda yakin ingin melanjutkan ?</div>
                
                <div class="form-group">
                    
                    <div class="col-lg-5">
                    <input type="hidden" class="form-control" name="idtrans" value="<?= autonumber("orders", "code", 4, "TRN")?>">
                    <?php $total=mysqli_fetch_array(mysqli_query($conn ,"select sum(total_harga) as total from sementara"));?>
                        <?php $total2=mysqli_fetch_array(mysqli_query($conn ,"select sum(jumlah) as total from sementara"));
                          ?>
                        <input type="hidden" name="ttotal" value="<?=$total['total']; ?>">
                        <input type="hidden" name="jml_barang" value="<?=$total2['total']; ?>">
                      
                    </div>
                </div>
                  
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ya</button>
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Keluar</button>
                </div>
                  </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- ./wrapper -->
              <!-- jQuery 3 -->
              <!-- Bootstrap 3.3.7 -->
              <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
              <script src="../assets/vendor/jquery-ui/jquery-ui.min.js"></script>
              <script>
              $.widget.bridge('uibutton', $.ui.button);
              </script>
              <script src="../assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
              <script src="../assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
              <script src="../assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
              <script src="../assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
              <script src="../assets/js/adminlte.min.js"></script>
              <script src="../assets/js/pages/dashboard.js"></script>
              <script src="../assets/js/ckeditor/ckeditor.js"></script>
              <script src="../assets/js/demo.js"></script>
              <script src="../assets/jquery.js"></script>
              <script src="../assets/fm.selectator.jquery.js"></script>
              <script>
                  $('#selectbox1').selectator();
                  $('#selectbox2').selectator();
              </script>
              <!--  -->
              <script type="text/javascript">
              <?php echo $jsArray; ?>
              function changeValue(id){
              document.getElementById('id').value = prdName[id].cau;
              document.getElementById('nama').value = prdName[id].miez;
              document.getElementById('type').value = prdName[id].de;
              document.getElementById('harga_jual').value = prdName[id].hard;
              };
              
              function sumharga() {
              var hg = document.getElementById('tharga').value;
              var by = document.getElementById('jumlah').value;
              var result = hg * by;
              if (!isNaN(result)) {
              document.getElementById('total').value = result;
              }
              }
              function sumtrans() {
              var tt = document.getElementById('ttotal').value;
              var bayar = document.getElementById('bayar').value;
              var result = bayar - tt;
              if (!isNaN(result)) {
              document.getElementById('kembali').value = result;
              }
              }
              </script>
            </body>
          </html>