<?php
    include '../../config/koneksi.php';
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "select * from users where code='$id'");
    
    while($row= mysqli_fetch_array($sql)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="customer/edit_proses.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
                
                <div class="form-group">
                    <label class="control-label">CODE</label>
                    <input class="form-control" type="hidden" name="id" value="<?php echo $row['id']; ?>" readonly/>
                    <input class="form-control" type="text" name="code" value="<?php echo $row['code']; ?>" readonly/>
                </div>
                <div class="form-group">
                    <label class="control-label">Nik</label>
                    <input class="form-control" type="text" name="nik" value="<?php echo $row['nik']; ?>" />
                </div>
                <div class="form-group">
                    <label class="control-label">NAMA</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $row['name']; ?>" />
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" required name="email" value="<?php echo $row['email']; ?>" >
                </div>
                <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label><br>
                <select class="form-control" required name="jk">
                    <option name="jk" value="" selected="selected"><?php echo $row['gender']; ?></option>
                    <option name="jk" value="LAKI - LAKI">LAKI - LAKI</option>
                    <option name="jk" value="PEREMPUAN">PEREMPUAN</option>
                </select>
                </div>
                <div class="form-group">
                <label for="telp">Alamat</label>
                <input type="text" class="form-control" required name="alamat" value="<?php echo $row['address']; ?>">
                </div>
                <div class="form-group">
                <label for="Telp">No HP</label>
                <input type="text" class="form-control" required name="tlp" value="<?php echo $row['phone']; ?>">
                </div>  
                <div class="form-group">
                <label for="fotomember">Foto Member</label>
                <img  src="../user/foto_member/<?php echo $row['photo']; ?>" class="img-thumbnail" alt="">
                <input type="file" class="form-control" name="fotomember">        
                </div> 
                <div class="form-group">
                <label for="fotoktp">Foto KTP</label>
                <img  src="../user/foto_ktp/<?php echo $row['ktp']; ?>" class="img-thumbnail" alt="">

                <input type="file" class="form-control" name="fotoktp">        
                </div> 
                <div class="form-group">
                <label for="fotoktp">Foto KK</label>
                <img  src="../user/foto_kk/<?php echo $row['kk']; ?>" class="img-thumbnail" alt="">

                <input type="file" class="form-control" name="fotokk">        
                </div> 
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Rubah</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>