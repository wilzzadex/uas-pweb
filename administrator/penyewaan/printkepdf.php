<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF

$pdf = new FPDF('L','mm','A4');


$title = 'Reza Foto | Laporan Data Order (Booking)';
$pdf->SetTitle($title);


// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(270,9,'Reza Foto',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(270,7,'LAPORAN DATA ORDER (BOOKING)',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(20,6,'ID Order',1,0);
$pdf->Cell(60,6,'Nama',1,0);
$pdf->Cell(60,6,'Bukti Pembayaran',1,0);
$pdf->Cell(70,6,'Status',1,0);
$pdf->Cell(30,6,'Jumlah',1,0);
$pdf->Cell(30,6,'Total',1,1);
// $pdf->Cell(50,6,'Harga/hari',1,1);


$pdf->SetFont('Arial','',10);
$no=1;
include '../../config/koneksi.php';
$mahasiswa = mysqli_query($conn, "select * from orders where status='BOOKING'");
while ($row = mysqli_fetch_array($mahasiswa)){
	$pdf->Cell(10,6,$no++,1,0);
	$pdf->Cell(20,6,$row['code'],1,0);
	$id_user = $row['user_id'];
    $query2 = "SELECT * FROM users where code='$id_user'";
    $sql2 = mysqli_query($conn, $query2); // Eksekusi/Jalankan query dari variabel $query
    while($data2 = mysqli_fetch_array($sql2)){
	$pdf->Cell(60,6,$data2['name'],1,0);
}
	if($row['proof_of_payment']=='NULL'){
		$pdf->Cell(60,6,"Belum Ada Bukti Pembayaran",1,0);
	}else{
		$pdf->Cell(60,6,"Ada (Lunas)",1,0);
	}
	$pdf->Cell(70,6,$row['status'],1,0);
	$pdf->Cell(30,6,$row['jumlah'],1,0);
	$pdf->Cell(30,6,$row['total'],1,1);

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
