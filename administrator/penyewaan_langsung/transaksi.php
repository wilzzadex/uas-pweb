<?php 	



// Load file koneksi.php
include "../../config/koneksi.php";
function autonumber($tabel, $kolom, $lebar = 0, $awalan = '')
      {
        // $conn1 = mysqli_connect("localhost", "dhayouru_dhayoru", "dhayouru123", "dhayouru_rafaesta");
        $conn1 = mysqli_connect("localhost", "root", "", "rezafoto");
      $query = "select $kolom from $tabel order by $kolom desc limit 1";
      $hasil = mysqli_query($conn1, $query);
      $jumlahrecord = mysqli_num_rows($hasil);
      if ($jumlahrecord == 0) {
      $nomor = 1;
      } else {
      $row = mysqli_fetch_array($hasil);
      $nomor = intval(substr($row[0], strlen($awalan))) + 1;
      }
      if ($lebar > 0) {
      $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
      } else {
      $angka = $awalan . $nomor;
      }
      return $angka;
      }


session_start();
$idmember = $_POST['idmember'];
$idtrans = $_POST['idtrans'];
$jml_barang	 = $_POST['jml_barang'];
$total_harga = $_POST['ttotal'];

date_default_timezone_set('ASIA/JAKARTA'); 
$tanggal = date('Y-m-d');





$tambah = "INSERT INTO orders values ('','$idtrans', '$idmember', 'PENYEWAAN LANGSUNG', 'BARANG SIAP DIAMBIL','NULL','$jml_barang','$total_harga') ";
$sql = mysqli_query($conn, $tambah); 

if($sql){
    $query=mysqli_query($conn,"select * from sementara");
    while($r=mysqli_fetch_row($query)){
        mysqli_query($conn,"insert into orderdetails values('','$idtrans','$r[1]','$idmember','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]','$r[7]')");
        mysqli_query($conn,"UPDATE products set status='N' where code = '$r[1]'");
        }

        


       
        mysqli_query($conn,"truncate table sementara");
      
        header('location:../home.php?menu=5');
        
    }
?>



 