<?php 



    include '../config/koneksi.php';

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    if(isset($_POST['ubah_foto'])){


        $foto_profil = $_FILES['foto_profil']['name'];
        $tmp_profil = $_FILES['foto_profil']['tmp_name'];
        $foto_ktp = $_FILES['foto_ktp']['name'];
        $tmp_ktp = $_FILES['foto_ktp']['tmp_name'];
        $foto_kk = $_FILES['foto_kk']['name'];
        $tmp_kk = $_FILES['foto_kk']['tmp_name'];

        $fotobarumember = date('dmYHis').$foto_profil;
        $fotobaruktp = date('dmYHis').$foto_ktp;
        $fotobarukk = date('dmYHis').$foto_kk;

        $path1 = "foto_member/".$fotobarumember;
        $path2 = "foto_kk/".$fotobarukk;
        $path3 = "foto_ktp/".$fotobaruktp;

        // $eksvalid = ['jpg','png','jpeg','JPG','PNG','jpeg'];
        // $ekstensi = explode(".", $foto);
        // $ekstensival = strtolower(end($ekstensi));


        // if ( !in_array($ekstensival, $eksvalid) ){
        //     echo "<script>alert('Format tidak didukung !');javascript:history.go(-1);</script>";
        //     return false;
        // }else{

            if(move_uploaded_file($tmp_profil, $path1) && move_uploaded_file($tmp_ktp, $path3)&& move_uploaded_file($tmp_kk, $path2)){

                    $query = "UPDATE users SET name='".$nama."', gender='".$jk."', address='".$alamat."', phone='".$no_hp."', email='".$email."', photo='".$fotobarumember."',ktp='".$fotobaruktp."',kk='".$fotobarukk."' WHERE code='".$id."'";
                    $sql = mysqli_query($conn, $query); 
                        if($sql){ 
                            ?>
                            <script language="javascript">
                                alert('Data Berhasil Diubah');
                                document.location.href="userpage.php";
                            </script>
                            <?php
                        }else{
                            ?>
                            <script language="javascript">
                                alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');<?php die; ?>
                                document.location.href="userpage.php";
                            </script>
                            <?php
                        }
            }else{
                    ?>
                    <script language="javascript">
                        alert('Maaf, Format gambar tidak mendukung!.');<?php die(); ?>
                        document.location.href="userpage.php";
                    </script>
                    <?php

            }
            
    }else{

                     $query = "UPDATE users SET name='".$nama."', gender='".$jk."', address='".$alamat."', phone='".$no_hp."', email='".$email."' WHERE code='".$id."'";
                    $sql = mysqli_query($conn, $query); 



                         if($sql){ 
                            ?>
                            <script language="javascript">
                                alert('Data Berhasil Diubah');
                                document.location.href="userpage.php";
                            </script>
                            <?php
                        }else{
                            ?>
                            <script language="javascript">
                                alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');<?php die; ?>
                                document.location.href="userpage.php";
                            </script>
                            <?php
            
                        }



        }
    


 ?>