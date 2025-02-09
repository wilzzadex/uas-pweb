<?php 
session_start();
include "../config/koneksi.php";
//session login di php
if (isset($_SESSION['role']) && isset($_SESSION['nik']) && isset($_SESSION['name'])&& isset($_SESSION['email']))
{
   if (($_SESSION['role'] == "pemilik")||($_SESSION['role'] == "administrator")||($_SESSION['role'] == "customer"))
   {
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Reza Foto | <?= $_SESSION['role']; ?></title>
  <link rel="icon" type="image/png" href="../assets/images/logo.png"/>
  <!-- Custom fonts for this template-->
  <link href="../Backend/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../Backend/assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../Backend/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
        <img src="../assets/images/logo.png" width="70px" alt="">
    </div>
        <div class="sidebar-brand-text mx-3">Reza <sup>Foto</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <?php include "menu_sidebar.php"; ?>
      <!-- Nav Item - Tables -->
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
         
          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            
          </form>

         

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            
            <div class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><label class="text-bold" for=""><?= $_SESSION['role'] ?></label>
              </a>
              
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </div>
           

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <?php
        if(!empty($_GET['menu'])){
            $menu = $_GET['menu'];
            if($menu==1){
                include('produk/produk.php');  
            }elseif($menu==2){
                include('kategori/kategori.php');
            }elseif($menu==3){
                include('customer/customer.php');
            }elseif($menu==4){
                include('booking/booking.php');
            }elseif($menu==5){
                include('penyewaan_langsung/penyewaan.php');
            }elseif($menu==6){
                include('penyewaan/penyewaan.php');
            }elseif($menu==7){
                include('pengembalian/pengembalian.php');
            }elseif($menu==8){
                include('kerusakan/kerusakan.php');
            }elseif($menu==9){
                include('pemilik/produk.php');
            }elseif($menu==10){
                include('pemilik/kategori.php');
            }elseif($menu==11){
                include('pemilik/customer.php');
            }elseif($menu==12){
                include('pemilik/booking.php');
            }elseif($menu==13){
                include('pemilik/penyewaan.php');
            }elseif($menu==14){
                include('pemilik/pengembalian.php');
            }elseif($menu==15){
                include('pemilik/kerusakan.php');
            }
        }else{
            include('dashboard.php');
        }
        ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-gray-200">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="fungsi/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../Backend/assets/vendor/jquery/jquery.min.js"></script>
  <script src="../Backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../Backend/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../Backend/assets/js/sb-admin-2.min.js"></script>
  <script src="../Backend/assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../Backend/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../Backend/assets/js/demo/datatables-demo.js"></script>
<script type="text/javascript">
            <?php echo $jsArray; ?>
            function changeValue(id){
            document.getElementById('id').value = prdName[id].cau;
            document.getElementById('nama').value = prdName[id].miez;
            document.getElementById('type').value = prdName[id].de;
            document.getElementById('harga_jual').value = prdName[id].hard;
            };
            
            function sumharga() {
            var hg = document.getElementById('tharga').value;
            var by = document.getElementById('jumlah').value;
            var result = hg * by;
            if (!isNaN(result)) {
            document.getElementById('total').value = result;
            }
            }
            function sumtrans() {
            var tt = document.getElementById('ttotal').value;
            var bayar = document.getElementById('bayar').value;
            var result = bayar - tt;
            if (!isNaN(result)) {
            document.getElementById('kembali').value = result;
            }
            }
            <?php echo $jsArray2; ?>
            function changeValue(id){
          
            document.getElementById('name').value = prdName[id].miez;
           
            };

          
</script>

<script type="text/javascript">
    function hitungHari(){
        var jawal = $('#jawal').val();
        var jakhir = $('#jakhir').val();
        var jawal_pisah = jawal.str_split('-');
        var jakhir_pisah = jakhir.str_split('-');
        var objek_tgl = new Date();
        var jawal_leave = objek_tgl.setFullYear(jawal_pisah[0],jawal_pisah[1],jawal_pisah[2]);
        var jakhir_leave = objek_tgl.setFullYear(jakhir_pisah[0],jakhir_pisah[1],jakhir_pisah[2]);
        var hasil =(jawal_leave - jakhir_leave)/(60*60*24*1000);
        $('#jhari').val(hasil);
    }

</script>

<script>
    function getUpdate(id){
    var id = id;
    $.ajax({
        url: "produk/editview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#ProEdit").html(ajaxData);
        $("#ProEdit").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getDelete(id){
    var id = id;
    $.ajax({
        url: "produk/deleteview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#ProDelete").html(ajaxData);
        $("#ProDelete").modal('show',{backdrop: 'true'});
        }
    });
    }
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".proedit").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "produk/editview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#ProEdit").html(ajaxData);
                    $("#ProEdit").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".prodel").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "produk/deleteview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#ProEdit").html(ajaxData);
                    $("#ProEdit").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>

<script>
    function getUpdate(id){
    var id = id;
    $.ajax({
        url: "kategori/editview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#EditKat").html(ajaxData);
        $("#EditKat").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getDelete(id){
    var id = id;
    $.ajax({
        url: "kategori/deleteview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#DeleteKat").html(ajaxData);
        $("#DeleteKat").modal('show',{backdrop: 'true'});
        }
    });
    }
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".editkat").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "kategori/editview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#EditKat").html(ajaxData);
                    $("#EditKat").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".deletekat").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "kategori/deleteview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#DeleteKat").html(ajaxData);
                    $("#DeleteKat").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>

<script>
  function getUpdate(id){
    var id = id;
    $.ajax({
        url: "booking/listview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#List").html(ajaxData);
        $("#List").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getUpdate(id){
    var id = id;
    $.ajax({
        url: "customer/editview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#EditCus").html(ajaxData);
        $("#EditCus").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getDelete(id){
    var id = id;
    $.ajax({
        url: "customer/deleteview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#DeleteCus").html(ajaxData);
        $("#DeleteCus").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getUpdate(id){
    var id = id;
    $.ajax({
        url: "booking/editview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#EditBok").html(ajaxData);
        $("#EditBok").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getDelete(id){
    var id = id;
    $.ajax({
        url: "booking/deleteview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#DeleteBok").html(ajaxData);
        $("#DeleteBok").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getDelete(id){
    var id = id;
    $.ajax({
        url: "pengembalian/editview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#EditKem").html(ajaxData);
        $("#EditKem").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getDelete(id){
    var id = id;
    $.ajax({
        url: "kerusakan/editview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#EditKer").html(ajaxData);
        $("#EditKer").modal('show',{backdrop: 'true'});
        }
    });
    }

    function getDelete(id){
    var id = id;
    $.ajax({
        url: "kerusakan/deleteview.php",
        type: "GET",
        data : {id: id,},
        success: function (ajaxData){
        $("#DeleteKer").html(ajaxData);
        $("#DeleteKer").modal('show',{backdrop: 'true'});
        }
    });
    }

</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".deleteker").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "kerusakan/deleteview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#DeleteKer").html(ajaxData);
                    $("#DeleteKer").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".editker").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "kerusakan/editview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#EditKer").html(ajaxData);
                    $("#EditKer").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".editkem").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "pengembalian/editview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#EditKem").html(ajaxData);
                    $("#EditKem").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".list").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "booking/listview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#List").html(ajaxData);
                    $("#List").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".editcus").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "customer/editview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#EditCus").html(ajaxData);
                    $("#EditCus").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".deletecus").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "customer/deleteview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#DeleteCus").html(ajaxData);
                    $("#DeleteCus").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".editbok").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "booking/editview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#EditBok").html(ajaxData);
                    $("#EditBok").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $(".deletebok").click(function (e){
            var m = $(this).attr("id");
            $.ajax({
                url: "booking/deleteview.php",
                type: "GET",
                data : {id: m,},
                success: function (ajaxData){
                    $("#DeleteBok").html(ajaxData);
                    $("#DeleteBok").modal('show',{backdrop: 'true'});
                }
            });
        });
    });
</script>


</body>

</html>

<?php
}
   else
   {
       // jika divisinya bukan admin, tampilkan pesan
       echo "<script>alert('Maaf.. Anda Tidak Berhak Mengakses Halaman Ini!');javascript:history.go(-1);</script>";
   }
}
else
{
   echo "<script>alert('Maaf.. Anda Tidak Berhak Mengakses Halaman Ini!');javascript:history.go(-1);</script>";
}

?>