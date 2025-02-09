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
            <form class="form-horizontal" action="booking/edit_proses.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
            <div class="form-group">
              <input class="form-control" type="hidden" name="id" value="<?php echo $row['code']; ?>" readonly/>
              <label class= control-label">STATUS</label>
                <select class="form-control" name="status">
                  <option  value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option>
                    <?php if($row['status'] == "BOOKING") {?>
                        <option  value="ORDER DISIAPKAN">ORDER DISIAPKAN</option>
                    <?php }elseif($row['status'] == "ORDER DISIAPKAN") { ?>
                        <option  value="BARANG SIAP DIAMBIL">BARANG SIAP DIAMBIL</option>
                    <?php }elseif($row['status'] == "BARANG SIAP DIAMBIL"){ ?>  
                        <option  value="SEDANG DISEWA">SEDANG DISEWA</option>
                    <?php }else{ ?> 
                        <option  value="BARANG DIKEMBALIKAN">BARANG DIKEMBALIKAN</option>
                    <?php } ?>               
                </select>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Keluar</button>
                </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>