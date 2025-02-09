<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF

$pdf = new FPDF('L','mm','A4');


$title = 'Reza Foto | Laporan Kerusakan';
$pdf->SetTitle($title);


// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(270,9,'Reza Foto',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(270,7,'LAPORAN DATA KERUSAKAN',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(25,6,'ID Transaksi',1,0);
$pdf->Cell(130,6,'Nama Produk',1,0);
$pdf->Cell(110,6,'informasi',1,1);



$pdf->SetFont('Arial','',10);
$no=1;
include '../../config/koneksi.php';
$mahasiswa = mysqli_query($conn, "SELECT damages.id,damages.order_id,damages.product_id,products.name,damages.information FROM damages INNER JOIN products ON products.code = damages.product_id");
while ($row = mysqli_fetch_array($mahasiswa)){
	$pdf->Cell(10,6,$no++,1,0);
	$pdf->Cell(25,6,$row['order_id'],1,0);
	$pdf->Cell(130,6,$row['product_id'] . " - " . $row['name'],1,0);
	$pdf->Cell(110,6,$row['information'],1,1);
	
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
