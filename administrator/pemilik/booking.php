
<div class="d-sm-flex align-items-right justify-content-between mb-4">
    
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-download fa-sm text-white-50"></i>
        Cetak Laporan
    </button>
    <!-- <a href="booking/printkepdf.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i>Cetak Laporan</a> -->
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Penyewaan</h6>
    
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <!-- Content Header (Page header) -->
    <thead>
                <tr>
                  <th>NO</th> 
                  <th>KODE BOOKING</th>
                  
                  <th>NAMA</th>
                  <th>STATUS</th>
                  <th>TOTAL</th>
                 
                </tr>
                </thead>
                <tbody>
                  <?php
                       $no = 1;
                       $query = "SELECT * FROM orders WHERE status != 'BOOKING' and status != 'SEDANG DISEWA' and status != 'BARANG SUDAH DI KEMBALIKAN'"; // Query untuk menampilkan semua data siswa
                       $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                       while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        echo "<td align='center'>".$data['code']."</td>";
                        $id_user = $data['user_id'];
                        $query2 = "SELECT * FROM users where code='$id_user'";
                        $sql2 = mysqli_query($conn, $query2); // Eksekusi/Jalankan query dari variabel $query
                        while($data2 = mysqli_fetch_array($sql2)){
                        echo "<td align='center'>".$data2['name']."</td>";
                        }
                       
                        echo "<td align='center'>".$data['status']."</td>";
                        echo "<td align='center'>".$data['total']."</td>";
                    
                        ?>
                        
                        
                       </tr>
                       <?php 
                     }
                     ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>

    
    <!-- /.content -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <form method="post" action="booking/printkepdf.php" enctype="multipart/form-data" >
            <!-- Contents -->
            <div class="form-group">
              <label for="">Status</label>
                <select name="filter" requuired class="form-control" id="">
                  <option value="">-----</option>
                  <option value="ORDER DISIAPKAN">ORDER DISIAPKAN</option>
                  <option value="BARANG SIAP DIAMBIL">BARANG SIAP DIAMBIL</option>
                  <option value="SEDANG DISEWA">SEDANG DISEWA</option>
                </select>
            </div>        
            <button class="btn btn-info btn-sm btn-block">Cetak</button> 
            </form>
            <hr>
            <div class="form-group">
                <a href="booking/printkepdf2.php" target="_blank" class="btn btn-success btn-sm btn-block">Cetak Keseluruhan</a>
            </div>  
            
        </div>
        
    
    </div>
    </div>
</div>

<div id="List" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div id="EditBok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div id="DeleteBok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>