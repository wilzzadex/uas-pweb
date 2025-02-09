<?php
    include '../../config/koneksi.php';
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "select * from products where id='$id'");
    
    while($row= mysqli_fetch_array($sql)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="produk/edit_proses.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
                <div class="form-group">
                    <label class="control-label">CODE</label>
                    <input class="form-control" type="hidden" name="id" value="<?php echo $row['id']; ?>" readonly/>
                    <input class="form-control" type="text" name="code" value="<?php echo $row['code']; ?>" readonly/>
                </div>
                <div class="form-group">
                    <label class="control-label">NAMA</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $row['name']; ?>" />
                </div>
                <div class="form-group">
                <label class="control-label">CATEGORY</label>
                <?php
                    $result = mysqli_query($conn, "select * from categories");
                    echo '<select id="selectbox1" class="form-control selectpicker" name="kategori">';
                    echo '<option>-----</option>';
                    while ($row1 = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row1['id'] . '">' . $row1['name'] . '</option>';
                    }
                    echo '</select>';
                    ?>
                </div>
                <div class="form-group">
                    <label class="control-label">BRAND</label>
                    <input class="form-control" type="text" name="brand" value="<?php echo $row['brand']; ?>"/>
                </div>
                <div class="form-group">
                    <label class="control-label">PRICE</label>
                    <input class="form-control" type="text" name="price" value="<?php echo $row['price']; ?>"/>
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