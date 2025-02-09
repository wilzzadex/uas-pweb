<?php
include "../config/koneksi.php";

$sqlCommand = "SELECT  COUNT(*) FROM users";
$query = mysqli_query($conn, $sqlCommand) or die (mysqli_error());
$cus = mysqli_fetch_row($query);

$sqlCommand = "SELECT  COUNT(*) FROM products";
$query = mysqli_query($conn, $sqlCommand) or die (mysqli_error());
$pro = mysqli_fetch_row($query);

$sqlCommand = "SELECT  COUNT(*) FROM orders where status='BOOKING'";
$query = mysqli_query($conn, $sqlCommand) or die (mysqli_error());
$booking = mysqli_fetch_row($query);

$sqlCommand = "SELECT  COUNT(*) FROM orders where status!='BOOKING'";
$query = mysqli_query($conn, $sqlCommand) or die (mysqli_error());
$sewa = mysqli_fetch_row($query);
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Customer</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $cus[0]; ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Produk</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pro[0]; ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-camera fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example --><div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Data Booking</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $booking[0]; ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data Order</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sewa[0]; ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
    </div>
</div>
</div>