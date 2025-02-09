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
<div class="d-sm-flex justify-content-between align-right mb-4">
    
    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-download fa-sm text-white-50"></i>
        Tambah Data
    </button>
    <a href="produk/printkepdf.php" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Produk</h6>
    
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <!-- Content Header (Page header) -->
            <thead>
                <tr>
                    <th width="10px">NO</th> 
                    <th>KODE PRODUK</th>
                    <th>FOTO</th>
                    <th>NAMA</th>
                    <th>KATEGORI</th>
                    <th>BRAND</th>
                    <th>HARGA/Hari</th>
                    <th>AKSI</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        $query = "SELECT * FROM products"; // Query untuk menampilkan semua data siswa
                        $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                        while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                        echo "<tr>";
                        echo "<td align='center'>".$no++."."."</td>";
                        echo "<td align='center'>".$data['code']."</td>";
                        ?>
                        <td><img width="150px" src="produk/foto/<?= $data['photo']; ?>" alt=""></td>
                        <?php
                        // echo "<td align='center'>".$data['photo']."</td>";
                        echo "<td align='center'>".$data['name']."</td>";
                        $idcat=$data['category_id'];
                        $query1 = "SELECT * FROM categories where id='$idcat'";
                        $sql1 = mysqli_query($conn, $query1); // Eksekusi/Jalankan query dari variabel $query
                        while($data2 = mysqli_fetch_array($sql1)){
                        echo "<td align='center'>".$data2['name']."</td>";
                        }
                        echo "<td align='center'>".$data['brand']."</td>";
                        echo "<td align='center'>Rp".number_format($data['price'],2,',','.')."</td>";
                        ?>
                        <td class="table-row" colspan="2" align="center">
                            <a href="#" class='btn btn-info proedit' id='<?php echo $data['id']; ?>'><i class="fa fa-edit"></i></a>
                            <a href="#" class='btn btn-danger prodel' id='<?php echo $data['id']; ?>'><i class="fa fa-trash"></i></a>
                        </td>
                        <?php 
                        }
                        ?> 
                        </tr>
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
            <form method="post" action="produk/simpan.php" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="jumlah_hari">CODE</label><br>
                <input type="text" class="form-control" required name="kode" value="<?= autonumber("products", "code", 4, "P")?>" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah_hari">PHOTO</label><br>
                <input type="file" class="form-control" name="photo">
                <small style="color:red;">Format Harus PNG !!</small>
            </div>
            <div class="form-group">
                <label for="jumlah_hari">NAME</label><br>
                <input type="text" class="form-control" required name="name" id="name">
            </div>
            <div class="form-group">
                <label for="jumlah_hari">CATEGORY</label><br>
                <?php
                $result = mysqli_query($conn, "select * from categories");
                $jsArray = "var harga1 = new Array();\n";
                
                echo '<select id="selectbox1" class="form-control selectpicker" name="kategori">';
                    echo '<option>-----</option>';
                    while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                echo '</select>';
                ?>
            </div>
            <div class="form-group">
                <label for="jumlah_hari">BRAND</label><br>
                <input type="text" class="form-control" required name="brand" id="">
            </div>
            <div class="form-group">
                <label for="jumlah_hari">PRICE</label><br>
                <input type="text" class="form-control" required name="price" id="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
    </div>
    </div>
</div>


<div id="ProEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>

<div id="ProDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
</div>