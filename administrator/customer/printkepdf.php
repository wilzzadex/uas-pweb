<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF

$pdf = new FPDF('L','mm','A4');


$title = 'Reza Foto | Laporan Data Customer';
$pdf->SetTitle($title);


// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(270,9,'Reza Foto',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(270,7,'LAPORAN DATA CUSTOMER',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(20,6,'ID',1,0);
$pdf->Cell(25,6,'Nik',1,0);
$pdf->Cell(50,6,'Nama',1,0);
$pdf->Cell(50,6,'Alamat',1,0);
$pdf->Cell(60,6,'Email',1,0);
$pdf->Cell(30,6,'Jenis Kelamin',1,0);
$pdf->Cell(30,6,'No Hp',1,1);
// $pdf->Cell(50,6,'Harga/hari',1,1);


$pdf->SetFont('Arial','',10);
$no=1;
include '../../config/koneksi.php';
$mahasiswa = mysqli_query($conn, "select * from users where role='customer'");
while ($row = mysqli_fetch_array($mahasiswa)){
	$pdf->Cell(10,6,$no++,1,0);
	$pdf->Cell(20,6,$row['code'],1,0);
	$pdf->Cell(25,6,$row['nik'],1,0);
	$pdf->Cell(50,6,$row['name'],1,0);
	$pdf->Cell(50,6,$row['address'],1,0);
	$pdf->Cell(60,6,$row['email'],1,0);
	$pdf->Cell(30,6,$row['gender'],1,0);
	$pdf->Cell(30,6,$row['phone'],1,1);

	// $pdf->Cell(40,6,$row['brand'],1,0);
	// $pdf->Cell(50,6,"Rp.".number_format($row['price'],2,',','.'),1,1);
	
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(270,7,'Dicetak tanggal : ' . date( 'd-m-Y'),0,1,'R');

$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(270,7,'ADMIN',0,1,'R');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(270,7,'TTD',0,1,'R');




$pdf->Output();
?>
