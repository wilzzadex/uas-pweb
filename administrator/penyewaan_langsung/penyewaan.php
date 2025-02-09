<?php
    include '../config/koneksi.php';
    
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
<div class="d-sm-flex align-right mb-4">
    
    <!-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-download fa-sm text-white-50"></i>
        Tambah Data
    </button> -->
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>
<div class="row">
    <div class="col-xl-5 col-lg-4">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Penyewaan Langsung</h6>
        
    </div>
        <div class="card-body">
        <form action="penyewaan_langsung/pemesanan.php" method="post">
            <div class="form-group">
                <label for="jumlah_hari">Nama Penyewa</label><br>
                <?php
                $result = mysqli_query($conn, "select * from users where role = 'customer'");
                $jsArray2 = "var harga2 = new Array();\n";
                echo '<select id="selectbox111" class="form-control selectpicker" onchange="document.getElementById(\'tmember\').value = harga2[this.value]">';
                    echo '<option>-----</option>';
                    while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['code'] . '">'.$row['code'] .' - '. $row['name'] . '</option>';
                    $jsArray2 .= "harga2['" . $row['code'] . "'] = '" . addslashes($row['code']) . "';\n";
                    }
                echo '</select>';
                ?>
            </div>
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
            <!-- <div class="form-group">
                <label for="pabrik">Jumlah Hari</label>
                <input type="text" readonly="" class="form-control" placeholder="Jumlah Hari" name="jhari" id="jhari" >
            </div>
            <div class="form-group">
                <label for="pabrik">Total Harga</label>
                <input type="text" readonly="" class="form-control" placeholder="Harga" name="harga_sewa" id="tharga_sewa" >
            </div> -->
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
            <button type="submit" class="btn btn-primary btn-sm btn-block">Tambah Ke Daftar Order</button>
            </form>
        </div>
    </div>
    </div>


    <div class="col-xl-7 col-lg-7">
        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Sewaan</h6>
            
        </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <!-- Content Header (Page header) -->
            <table class="table table-bordered table-striped">
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
                                echo "<td><a href='penyewaan_langsung/deletepesanan.php?id=$idx' class='btn btn-danger btn-sm'>X</a></td>";
                                }
                                ?>
                                </tbody>
                    </table>
                    
                          <?php $total=mysqli_fetch_array(mysqli_query($conn,"select sum(total_harga) as total from sementara"));?>
                          <p style="color:green;" class="box-title">Total : <?php echo "Rp.".number_format($total['total'],2,',','.') ?></p>
                          <input type="hidden" name="total_harga" value="<?= $total['total']; ?>">
                       
                        <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modal-bayar">Sewa</button>
                </div>
            </div>
        </div>
    </div>                            
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
                  <form method="post" action="penyewaan_langsung/transaksi.php" enctype="multipart/form-data">
                   
                    <div class="alert alert-warning">Apakah anda yakin ingin melanjutkan ?</div>
                
                <div class="form-group">
                    
                    <div class="col-lg-5">
                    <input type="hidden" class="form-control" name="idtrans" value="<?= autonumber("orders", "code", 4, "TRN")?>">
                    <?php $total=mysqli_fetch_array(mysqli_query($conn ,"select sum(total_harga) as total from sementara"));?>
                        <?php $total2=mysqli_fetch_array(mysqli_query($conn ,"select sum(jumlah) as total from sementara"));
                          ?>
                        <input type="hidden" name="ttotal" value="<?=$total['total']; ?>">
                        <input type="hidden" name="jml_barang" value="<?=$total2['total']; ?>">
                        <input type="text" name="idmember" id="tmember">

                        
                      
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
</div>
</div>