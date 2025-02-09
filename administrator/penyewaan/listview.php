<?php
    include '../../config/koneksi.php';
    $id = $_GET['id'];
   
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        </div>
        <div class="modal-body">
        <p>Kode Transaksi : <?= $id; ?></h5>
            <table class='table table-hover'>
                <tr>
                    <td>No</td> 
                    <td>Nama </td>
                    <td>Tanggal Mulai</td>
                    <td>Tanggal Akhir</td>
                   
                </tr>
                <tr>
                <?php
                $no = 1;
                $sql = mysqli_query($conn, "select * from orderdetails where order_id='$id'");
                while($row= mysqli_fetch_array($sql)){
                ?>

                    <td><?= $no++; ?></td>
                   
                <?php
                $idp= $row['product_id'];
                $sql2 = mysqli_query($conn, "select * from products where code='$idp'");
                while($row2= mysqli_fetch_array($sql2)){ ?>
                    <td><?= $row2['name'] ?></td>
                <?php }?>
                    <td><?= $row['dari'] ?></td>
                    <td><?= $row['sampai'] ?></td>
                  
               
                </tr>
                <?php }?>
            </table>
        </div>
    </div>
</div>