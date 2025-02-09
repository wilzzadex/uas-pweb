<!DOCTYPE html>
<html lang="en">

<?php
session_start();
// get data from category 
include "../config/koneksi.php";
include "../utils/helper.php";
$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

$dataCategory = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
                    <a href="<?= base_url() ?>dashboard" class="btn btn-custom-primary rounded-pill px-3 mb-2 mb-lg-0">
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

    <!-- Quote/testimonial aside-->

    <!-- App features section-->
    <section id="features" class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Tambah Resep</h4>

                            <a href="../dashboard/" class="btn btn-dark"><i class="bi-arrow-left"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="simpan.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Resep</label>
                                            <input type="text" class="form-control" required id="name" name="name" placeholder="Masukkan Nama Resep">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Kategori Resep</label>
                                            <select class="form-select" required name="category_id">
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach ($dataCategory as $category): ?>
                                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" required name="description" id="description" rows="3" minlength="10" placeholder="Masukkan Deskripsi Resep"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Status</label>
                                            <select class="form-select" required name="status">
                                                <option selected>Pilih Status</option>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Foto Resep</label>
                                            <input type="file" class="form-control" required id="image" name="image" placeholder="Masukkan Nama Resep" onchange="previewImage(event)" accept=".png, .jpg, .jpeg">
                                        </div>
                                        <div class="mb-3">
                                            <img id="imagePreview" src="https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg" alt="Image Preview" style="width: 100%; height: auto;">
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Bahan</label>

                                            <div class="row" id="bahan">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" required name="nama_bahan[]" placeholder="Masukkan Nama Bahan">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary" id="btnAddIngredients" type="button">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Petunjuk Pembuatan</label>

                                            <div class="row" id="petunjuk">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" required name="petunjuk[]" placeholder="Masukkan Petunjuk Pembuatan">
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary" id="btnAddInstructions" type="button">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-custom-primary float-end"><i class="bi-save"></i> Simpan</button>
                                    </div>
                                </div>



                            </form>
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

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->

    <script>
        $('#btnAddIngredients').click(function() {
            $('#bahan').append('<div class="col-md-10 mt-2"><input type="text" class="form-control" required name="nama_bahan[]" placeholder="Masukkan Nama Bahan"></div><div class="col-md-2 mt-2"><button class="btn btn-danger btnDeleteIngredients" type="button">-</button></div>');
        });

        $('#btnAddInstructions').click(function() {
            $('#petunjuk').append('<div class="col-md-10 mt-2"><input type="text" class="form-control" required name="petunjuk[]" placeholder="Masukkan Petunjuk Pembuatan"></div><div class="col-md-2 mt-2"><button class="btn btn-danger btnDeleteIngredients" type="button">-</button></div>');
        });

        $(document).on('click', '.btnDeleteIngredients', function() {
            $(this).parent().prev().remove();
            $(this).parent().remove();
        });

        $(document).on('click', '.btnDeleteInstructions', function() {
            $(this).parent().prev().remove();
            $(this).parent().remove();
        });

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // check session error
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