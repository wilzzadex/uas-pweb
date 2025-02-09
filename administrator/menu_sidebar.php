<?php

if ($_SESSION['role'] == "administrator") { ?>


<li class="nav-item active">
<a class="nav-link" href="home.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Data Master
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
    aria-controls="collapseTwo">
    <i class="fas fa-fw fa-table"></i>
    <span>Data Master</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <a class="collapse-item" href="home.php?menu=2">Kategori</a>
    <a class="collapse-item" href="home.php?menu=1">Produk</a>
    <a class="collapse-item" href="home.php?menu=3">Customer</a>
    </div>
</div>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
    aria-controls="collapseTwo">
    <i class="fas fa-cart-arrow-down"></i>
    <span>Data Pemesanan</span>
</a>
<div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <a class="collapse-item" href="home.php?menu=6">Booking</a>
    <a class="collapse-item" href="home.php?menu=4">Penyewaan</a>
    <a class="collapse-item" href="home.php?menu=7">Pengembalian</a>

    </div>
</div>
</li>

<hr class="sidebar-divider">
<li class="nav-item">
<a class="nav-link" href="home.php?menu=5">
    <i class="fas fa-fw fa-clipboard-list"></i>
    <span>Pendaftaran Penyewaan</span></a>
</li>


<!-- Nav Item - Charts -->
<li class="nav-item">
<a class="nav-link" href="home.php?menu=8">
    <i class="fas fa-fw fa-exclamation-circle"></i>
    <span>Kerusakan</span></a>
</li>

<?php }elseif($_SESSION['role'] == "pemilik") {?>
    <li class="nav-item active">
<a class="nav-link" href="home.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Data Master
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
    aria-controls="collapseTwo">
    <i class="fas fa-fw fa-table"></i>
    <span>Data Master</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <a class="collapse-item" href="home.php?menu=10">Laporan Kategori</a>
    <a class="collapse-item" href="home.php?menu=9">Laporan Produk</a>
    <a class="collapse-item" href="home.php?menu=11">Laporan Customer</a>
    </div>
</div>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse1" aria-expanded="true"
    aria-controls="collapseTwo">
    <i class="fas fa-cart-arrow-down"></i>
    <span>Data Pemesanan</span>
</a>
<div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <a class="collapse-item" href="home.php?menu=13">Laporan Booking</a>
    <a class="collapse-item" href="home.php?menu=12">Laporan Penyewaan</a>
    <a class="collapse-item" href="home.php?menu=14">Laporan Pengembalian</a>

    </div>
</div>
</li>

<!-- Nav Item - Charts -->
<li class="nav-item">
<a class="nav-link" href="home.php?menu=15">
    <i class="fas fa-fw fa-exclamation-circle"></i>
    <span>Laporan Kerusakan</span></a>
</li>
    </li>
<?php } ?>
