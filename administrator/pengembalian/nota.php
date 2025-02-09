<?php 
require_once("../../config/koneksi.php");

$id = $_GET['id'];

?>

<html>
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../../assets/images/logo.png"/>

    <title>Reza Foto</title>
    
    <style>
    @media print {
      #printPageButton {
        display: none;
    }
}
.invoice-box {
    max-width: 900px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
    padding-top: 20px;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: #eee;
    border-bottom: 1px solid #ddd;
    font-weight: bold;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td{
    border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
    border-top: 2px solid #eee;
    font-weight: bold;
}

@media only screen and (max-width: 600px) {
    .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
    }

    .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
    }
}

/** RTL **/
.rtl {
    direction: rtl;
    font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
    text-align: right;
}

.rtl table tr td:nth-child(2) {
    text-align: left;
}
</style>
</head>
<body onload="window.print()">
<?php
     $transaksi = mysqli_fetch_array(mysqli_query($conn, "select * from orders where code='$id'"));
     $total = $transaksi['total'];
     $username = $transaksi['user_id'];
     $nama = mysqli_fetch_array(mysqli_query($conn, "select * from users where code='$username'"));
     $namee = $nama['name'];

?>
    <br>
    <br>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
            <center><img src="../../assets/images/logo1.PNG" width="150"></center> 
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                             <h6>Kwitansi Penyewaan</h6> 
                            </td>
                            <td>
                                <?php echo $_GET['id']; ?><br>
                                <?php echo date('d-m-Y');  ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <tr class="information">
                <td colspan="6">
                    <table>
                    <tr><b>
                         Nama : <?= $namee; ?> <br>
                        </tr></b>
                        <tr><b>
                                DETAIL PEMBAYARAN<br>
                        </tr></b>
                    </table>
                </td>
            </tr>
            <tr>
                <th>
                    NO
                </th>
                <th align="center">
                    BARANG
                </th>
                <th>
                    DARI
                </th>
                <th>
                    SAMPAI
                </th>
                <th>
                    JAM MULAI
                </th>
                <th>
                    JAM AKHIR
                </th>
                <th>
                    HARGA
                </th>
            </tr>
                <?php
                    $no = 1;
                    $query = "SELECT * FROM orderdetails where order_id='$id'"; // Query untuk menampilkan semua data siswa
                    $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                        echo "<tr>";
                        echo "<td>".$no++."</td>";
                        $idb=$data['product_id'];
                        $query2 = "SELECT * FROM products where code='$idb'"; // Query untuk menampilkan semua data siswa
                        $sql2 = mysqli_query($conn, $query2); // Eksekusi/Jalankan query dari variabel $query
                        while($data2 = mysqli_fetch_array($sql2)){
                        echo "<td align='center'>".$data2['name']." - ".$data2['brand']."</td>";
                    }
                        echo "<td>".$data['dari']."</td>";
                        echo "<td>".$data['sampai']."</td>";
                        echo "<td>".$data['jam_mulai']."</td>";
                        echo "<td>".$data['jam_akhir']."</td>";

                        echo "<td>Rp. ".number_format($data['total_harga'],2,',','.')."</td>";
                       
                         
                    }
                ?> 
                </tr>
                <tr class="total">
                <td></td>

                <td colspan="6" align="right">
                     <?php
                   


                 ?>
                  Total    : Rp. <?php echo number_format($total); ?> <hr>

                 
                  
               </td>
           </tr>
           </tr>
           <tr>
        </tr>       
    </table>
</div>


</body>
</html>