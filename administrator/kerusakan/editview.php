<?php
    include '../../config/koneksi.php';
    $id = $_GET['id'];
    $sql1 = mysqli_query($conn, "select * from damages where id='$id'");
    
    while($row1= mysqli_fetch_array($sql1)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="kerusakan/edit_proses.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
                 <div class="form-group">
                    <input type="hidden" value="<?= $row1['id']; ?>" name="id">
                    <label for="jumlah_hari">No Transaksi</label><br>
                        <?php
                        $result = mysqli_query($conn, "select * from orders");
                        echo '<select id="" name="code" class="form-control selectpicker">';
                            echo '<option>'.$row1['order_id'].'</option>';
                            while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['code'] . '">'.$row['code'] . '</option>';
                            }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_hari">Produk</label><br>
                        <?php
                        $result = mysqli_query($conn, "select * from products");
                        echo '<select id="" name="produk" class="form-control selectpicker">';
                            echo '<option>'.$row1['product_id'].'</option>';
                            while ($row = mysqli_fetch_array($result)) {
                            echo '<option value="' . $row['code'] . '">'.$row['code'] . " - " .$row['name'] . '</option>';
                            }
                        echo '</select>';
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_hari">Informasi</label><br>
                        <textarea name="informasi" class="form-control" id="" cols="30" rows="10"><?= $row1['information'] ?></textarea>
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