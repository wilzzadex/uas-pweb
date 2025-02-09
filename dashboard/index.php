<!DOCTYPE html>
<html lang="en">

<?php
session_start();
// get data from category 
include "../config/koneksi.php";
include "../utils/helper.php";

is_logged_in();

$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

$dataCategory = mysqli_fetch_all($result, MYSQLI_ASSOC);

$queryResep = "SELECT * FROM recipes WHERE user_id = " . $_SESSION['id'];
$resultResep = mysqli_query($conn, $queryResep);

$dataResep = mysqli_fetch_all($resultResep, MYSQLI_ASSOC);


?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Rasa Bersama</title>
    <link rel="icon" type="image/x-icon" href="../assets-fe/logo.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../assets-fe/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
                <img src="<?= base_url() ?>assets-fe/logo.png" alt="Logo" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <?php foreach ($dataCategory as $category): ?>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="../list.php?category=<?= $category['slug'] ?>"><?= $category['name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php if (!isset($_SESSION['id'])): ?>
                    <button class="btn btn-custom-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#modalLogin">
                        <span class="d-flex align-items-center">
                            <i class="bi-person-fill me-2"></i>
                            <span class="small">Login</span>
                        </span>
                    </button>
                <?php else: ?>
                    <a href="" class="btn btn-custom-primary rounded-pill px-3 mb-2 mb-lg-0">
                        <span class="d-flex align-items-center">
                            <i class="bi-person-fill me-2"></i>
                            <span class="small">Dashboard Saya</span>
                        </span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- Mashead header-->
    <header class="masthead bg-gradient-custom">
        <div class="container px-5">
            <div class="row ">
                <div class="col-xl-8">
                    <div class="h2 fs-1 text-white">Dashboard Saya</div>
                </div>
            </div>
        </div>
    </header>
    <!-- Quote/testimonial aside-->

    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-md-12">
                    <a href="logout.php" class="btn btn-danger mb-5"><i class="bi-box-arrow-right"></i> Logout</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Resep Saya</h4>

                            <a href="../add" class="btn btn-primary">Tambah Resep</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="min-width: 150px;">Nama Resep</th>
                                            <th>Kategori</th>
                                            <th style="min-width: 150px;">Deskripsi</th>
                                            <th style="min-width: 150px;">Jumlah Bahan Baku</th>
                                            <th style="min-width: 150px;">Jumlah Komentar</th>
                                            <th style="min-width: 150px;">Rating</th>
                                            <th>Jumlah Like</th>
                                            <th>Status</th>
                                            <th style="min-width: 100px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataResep as $key => $resep): ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= $resep['title'] ?></td>
                                                <td><?= get_category($resep['category_id'])['name'] ?></td>
                                                <td><?= limit_description($resep['description']) ?></td>
                                                <td>
                                                    <?php
                                                    $queryLangkah = "SELECT * FROM recipe_ingredients WHERE recipe_id = " . $resep['id'];
                                                    $resultLangkah = mysqli_query($conn, $queryLangkah);
                                                    echo mysqli_num_rows($resultLangkah);
                                                    ?>
                                                </td>
                                                <td><?= calculate_comment($resep['id']) ?></td>
                                                <td><?= calculate_rating($resep['id']) ?></td>
                                                <td><?= calculate_like($resep['id']) ?></td>
                                                <td><?php

                                                    if ($resep['status'] == 'publish') {
                                                        echo "<span class='badge bg-success'>Publish</span>";
                                                    } else {
                                                        echo "<span class='badge bg-danger'>Draft</span>";
                                                    }
                                                    ?></td>
                                                <td>
                                                    <a href="edit.php?id=<?= $resep['id'] ?>" class="btn btn-icon btn-warning btn-sm">
                                                        <i class="bi-pencil"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="deleteResep(this)" id="<?= $resep['id'] ?>" class="btn btn-icon btn-danger btn-sm">
                                                        <i class="bi-trash"></i>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="bg-black text-center py-5">
        <div class="container px-5">
            <div class="text-white-50 small">
                <div class="mb-2">2025&copy; Rasa Bersama . By Kelompok 6</div>

            </div>
        </div>
    </footer>
    <!-- Feedback Modal-->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets-fe/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });

        function deleteResep(e) {
            const id = e.id;
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Resep yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete.php?id=${id}`;
                }
            })
        }

        <?php if (isset($_SESSION['error'])): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '<?= $_SESSION['error'] ?>',
            });

        <?php endif; ?>

        //check session success
        <?php if (isset($_SESSION['success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $_SESSION['success'] ?>',
            });
        <?php endif; ?>

        <?php unset($_SESSION['success']); ?>
        <?php unset($_SESSION['error']); ?>
    </script>


</body>

</html>