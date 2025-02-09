<?php 


include '../config/koneksi.php';

$id = $_POST['id'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$namavalid = str_replace(" ", "_", $foto);

$fotoren = date('dmYHis') . $namavalid;

$path = "bukti_foto/" . $fotoren;

$eksvalid = ['jpg', 'png', 'jpeg', 'JPG', 'PNG', 'jpeg'];
$ekstensi = explode(".", $foto);
$ekstensival = strtolower(end($ekstensi));






if (!in_array($ekstensival, $eksvalid)) {
    echo "<script>alert('Format tidak didukung !');
    javascript:history.go(-1);</script>";
    

    } else {

        if (move_uploaded_file($tmp, $path)) {

            $query = "UPDATE orders set proof_of_payment = '$fotoren' WHERE code='$id'";
            $sql = mysqli_query($conn, $query);

            if ($sql) {
                
                $query=mysqli_query($conn,"select * from orderdetails WHERE order_id ='$id'");
                while($r=mysqli_fetch_row($query)){
                    mysqli_query($conn,"UPDATE products set status = 'N' WHERE code = '".$r['2']."'");
                    }
            
                
                ?>



    				<script language="javascript">
    					alert("Bukti Berhasil di Upload");
    					document.location.href="userpage.php";
                       
    				</script>

    				<?php

            } else {

                echo "gagal";
            }

        }

    }




 ?>