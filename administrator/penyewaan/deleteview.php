<?php
    include '../../config/koneksi.php';
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "select * from orders where code='$id'");
    
    while($row= mysqli_fetch_array($sql)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="booking/delete.php" name="modal-popup" enctype="multipart/form-data" method="POST">
                <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ?</div>
                    <div class="form-group">
                    <input class="form-control" type="hidden" name="id" value="<?php echo $row['code']; ?>" readonly/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                    </div>
            </form>
            <?php } ?>
        </div>
    </div>
</div>