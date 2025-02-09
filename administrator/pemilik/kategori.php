
<div class="d-sm-flex justify-content-between align-right mb-4">
    
    <!-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-download fa-sm text-white-50"></i>
        Tambah Data
    </button> -->
    <a href="kategori/printkepdf.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
    
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <!-- Content Header (Page header) -->
                <thead>
                    <tr>
                    <th>NO</th> 
                    <th>NAMA KATEGORI</th>
                    <th>INFORMASI</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no = 1;
                        $query = "SELECT * FROM categories"; // Query untuk menampilkan semua data siswa
                        $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                            echo "<tr>";
                            echo "<td align='center'>".$no++."</td>";
                            echo "<td align='center'>".$data['name']."</td>";
                            echo "<td align='center'>".$data['information']."</td>";
                            ?>
                           
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


<div id="EditKat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div id="DeleteKat" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>