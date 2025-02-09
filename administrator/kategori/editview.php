<?php
    include '../../config/koneksi.php';
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "select * from categories where id='$id'");
    
    while($row= mysqli_fetch_array($sql)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="kategori/edit_proses.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
                <div class="form-group">
                    
                    <input class="form-control" type="hidden" name="id" value="<?php echo $row['id']; ?>" readonly/>
                  
                </div>
                <div class="form-group">
                    <label class="control-label">NAMA KATEGORI</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $row['name']; ?>" />
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Informasi</label>
                    <textarea name="informasi" id="" class="form-control" cols="30" rows="10"><?php echo $row['information']; ?></textarea>
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