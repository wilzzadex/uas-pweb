<?php
    include '../config/koneksi.php';
    
    function autonumber($tabel, $kolom, $lebar=0, $awalan=''){
        $conn = mysqli_connect("localhost" , "root" , "" , "rezafoto");
        $query="select $kolom from $tabel order by $kolom desc limit 1";
        $hasil= mysqli_query($conn, $query);
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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            
    <!-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-download fa-sm text-white-50"></i>
        Tambah Data
    </button> -->
    <a href="customer/printkepdf.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
    
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <!-- Content Header (Page header) -->
    <thead>
                <tr>
                  <th>NO</th> 
                  <th>NIK</th>
                  <th>NAMA</th>
                  <th>EMAIL</th>
                  <th>GENDER</th>
                  <th>ALAMAT</th>
                  <th>NO HP</th>
                  <th>KTP</th>
                  <th>KK</th>
                  <th>PHOTO</th>
                  
                </tr>
                </thead>
                <tbody>
                  <?php
                       $no = 1;
                       $query = "SELECT * FROM users where role='customer'"; // Query untuk menampilkan semua data siswa
                       $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                       while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                        echo "<tr>";
                        echo "<td align='center'>".$no++."</td>";
                        echo "<td align='center'>".$data['nik']."</td>";
                        echo "<td align='center'>".$data['name']."</td>";
                        echo "<td align='center'>".$data['email']."</td>";
                        echo "<td align='center'>".$data['gender']."</td>";
                        echo "<td align='center'>".$data['address']."</td>";
                        echo "<td align='center'>".$data['phone']."</td>";
                        ?>
                        <td align='center'>
                          <img width="100px" src="../user/foto_ktp/<?php echo $data['ktp'];?>" class="img-responsive" alt="Image">
                        </td>
                        <td align='center'>
                          <img width="100px" src="../user/foto_kk/<?php echo $data['kk'];?>" class="img-responsive" alt="Image">
                        </td>
                        <td align='center'>
                          <img width="100px" src="../user/foto_member/<?php echo $data['photo'];?>" class="img-responsive" alt="Image">
                        </td>
                       
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
            <form method="post" action="customer/simpan.php" enctype="multipart/form-data" >
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
            </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
    </div>
    </div>
</div>


<div id="EditCus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div id="DeleteCus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>