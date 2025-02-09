
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    
    <!-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-download fa-sm text-white-50"></i>
        Tambah Data
    </button> -->
    <a href="penyewaan/printkepdf.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Booking</h6>
    
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
                  <th>BUKTI PEMBAYARAN</th>
                  <th>STATUS</th>
                  <th>TOTAL</th>
                 
                  <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                       $no = 1;
                       $query = "SELECT * FROM orders where status='BOOKING'"; // Query untuk menampilkan semua data siswa
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
                        if($data['proof_of_payment'] == 'NULL'){
                          echo "<td align='center' style='color:red;'>Belum ada Pembayaran</td>";
                        }else{
                        ?>
                          <td><img width="150px" src="../user/bukti_foto/<?php echo $data['proof_of_payment'];?>" alt=""></td>
                        <?php
                        }
                        echo "<td align='center'>".$data['status']."</td>";
                        echo "<td align='center'>".$data['total']."</td>";
                    
                        ?>
                        
                        <td class="table-row" colspan="2" align="center">
                          <a href="#" class='btn btn-primary list' id='<?php echo $data['code']; ?>'><i class="fas fa-list"></i></i></a>
                          <a href="#" class='btn btn-info editbok' id='<?php echo $data['code']; ?>'><i class="fa fa-edit"></i></a>
                          <a href="#" class='btn btn-danger deletebok' id='<?php echo $data['code']; ?>'><i class="fa fa-trash"></i></a>
                          <?php if($data['status'] == 'BARANG SIAP DIAMBIL') { ?>
                            <a href="booking/nota.php?id=<?= $data['code']; ?>" target="_blank" class='btn btn-info' id='<?php echo $data['code']; ?>'><i class="fa fa-print"></i></a>
                          <?php } ?>
                       </td>
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
            <form method="post" action="kategori/simpan.php" enctype="multipart/form-data" >
            <!-- Contents -->
            <div class="form-group">
                <label for="jumlah_hari">Nama</label><br>
                <input type="text" class="form-control" required name="name">
            </div>
            <div class="form-group">
                <label for="jumlah_hari">Informasi</label><br>
                <input type="text" class="form-control" required name="informasi">
            </div>  
            <!--  -->
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
    </div>
    </div>
</div>

<div id="List" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>
<div id="EditBok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div id="DeleteBok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>