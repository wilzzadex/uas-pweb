<!DOCTYPE html>
<html lang="en">

<?php
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
error_reporting(0);

// get data from category 
include "config/koneksi.php";
require_once "utils/helper.php";

$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

$dataCategory = mysqli_fetch_all($result, MYSQLI_ASSOC);

$recipeId = $_GET['id'];
$query = "SELECT * FROM recipes WHERE id = $recipeId";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

$sqlComment = "SELECT * FROM recipe_comment WHERE recipe_id = $recipeId";
$resultComment = mysqli_query($conn, $sqlComment);
$comments = mysqli_fetch_all($resultComment, MYSQLI_ASSOC);
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Rasa Bersama</title>
    <link rel="icon" type="image/x-icon" href="assets-fe/logo.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets-fe/css/styles.css" rel="stylesheet" />
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
                        <li class="nav-item"><a class="nav-link me-lg-3" href="list.php?category=<?= $category['slug'] ?>"><?= $category['name'] ?></a></li>
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
                    <a href="dashboard" class="btn btn-custom-primary rounded-pill px-3 mb-2 mb-lg-0">
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
    <header class="masthead">
        <div class="container px-5">
            <div class="row">
                <div class="col-lg-12">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <div class="text-lg-start">
                                    <h4 class="display-5 lh-1"><?= $data['title'] ?></h4>
                                </div>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-custom-primary rounded-pill px-3 mb-2 mb-lg-0" disabled>
                                    <span class="d-flex align-items-center">
                                        <span class="small"><?= get_category($data['category_id'])['name'] ?></span>
                                    </span>
                                </button>
                            </td>
                        </tr>
                    </table>
                    <!-- Mashead text and app badges-->

                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= calculate_rating($recipeId) ?>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3"></div>
                    <table style="width: 100%;">
                        <tr>
                            <td><i class="bi-person-fill me-2"></i>
                                Dipublikasikan oleh <strong><?= get_user_submitted_recipe($recipeId)['name'] ?> </strong> (<?= get_since_ago($data['created_at']) ?>)</td>
                            <td class="text-end">
                                <?php if (is_like($data['id'])): ?>
                                    <i class="bi-heart-fill text-danger" onclick="like(this,'unlike')" id="<?= $data['id'] ?>" style="cursor: pointer;"></i> <?= calculate_like($data['id']) ?>
                                <?php else: ?>
                                    <i class="bi-heart text-danger" onclick="like(this,'like')" id="<?= $data['id'] ?>" style="cursor: pointer;"></i> <?= calculate_like($data['id']) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                </div>

            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <img src="<?= base_url() ?>uploads/<?= $data['image'] ?>" style="width: 100%;" alt="..." class="img-fluid rounded" />
                </div>
                <div class="col-md-12">
                    <div class="mt-3"></div>
                    <p class="lead fw-normal text-muted mb-5">
                        <?= $data['description'] ?>
                    </p>
                </div>

            </div>

            <div class="row mb-3">
                <hr>

                <div class="col-md-6 col-xs-12">
                    <span><i class="bi-box-seam me-2"></i> Bahan baku : <?= count(get_bahan($recipeId)) ?></span>

                    <table class="">

                        <tbody>
                            <?php $no = 1;
                            foreach (get_bahan($recipeId) as $bahan): ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td><?= $bahan['item'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-xs-12">
                    <span><i class="bi-arrow-right-circle me-2"></i> Cara Memasak : </span>
                    <table class="">
                        <tbody>
                            <?php $no = 1;
                            foreach (get_direction($recipeId) as $bahan): ?>
                                <tr>
                                    <td valign="top"><?= $no++ ?>.</td>
                                    <td valign="top"><?= $bahan['step'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="col-md-6 col-xs-12">
                    <span class="fs-4">Komentar & Rating</span>

                    <div class="mt-3"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" id="commentForm">
                                <?php if ($_SESSION['id']): ?>
                                    <div class="mb-3">
                                        <span class="d-flex align-items-center">
                                            <span class="small">Rating : </span>
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="bi-star text-warning load_rating" data-rating="<?= $i ?>" style="cursor: pointer;"></i>
                                            <?php endfor; ?>
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="recipeId" value="<?= $recipeId ?>">
                                        <input type="hidden" name="rating" id="rating">
                                        <textarea class="form-control" id="comment" name="comment" rows="3" required placeholder="Tulis komentar..."></textarea>
                                    </div>
                                    <button class="btn btn-custom-primary rounded-pill px-3 mb-2 mb-lg-0" id="commentButton" type="submit">Kirim Komentar</button>
                                <?php else: ?>
                                    <button class="btn btn-custom-primary rounded-pill px-3 mb-2 mb-lg-0" type="button" data-bs-toggle="modal" data-bs-target="#modalLogin">
                                        <span class="d-flex align-items-center">
                                            <i class="bi-person-fill me-2"></i>
                                            <span class="small">Login untuk memberikan komentar</span>
                                        </span>
                                    </button>
                                <?php endif; ?>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="col-md-6 col-xs-12">
                    <span class="fs-4">Komentar Terakhir</span>
                    <div id="box-comment">
                        <table style="width: 100%;">
                            <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <td><i class="bi-person-circle me-2"></i> <?= get_user_submit_comment($comment['id'])['name'] ?> (<?= get_since_ago($comment['created_at']) ?>)</td>
                                    </td>
                                    <td class="text-end">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $comment['rating']): ?>
                                                <i class="bi-star-fill text-warning"></i>
                                            <?php else: ?>
                                                <i class="bi-star text-warning"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">"<?= $comment['comment'] ?>"</td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (count($comments) == 0): ?>
                                <tr>
                                    <td colspan="2">Belum ada komentar</td>
                                </tr>
                            <?php endif; ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                    <div class="container-fluid px-5">

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-custom p-4">
                    <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Login</h5>
                    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 p-4">
                    <form id="loginForm">
                        <!-- Name input-->

                        <!-- Email address input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" type="email" name="email" placeholder="Email..." />
                            <label for="email">Email</label>
                            <div class="invalid-feedback">Email Harus Diisi !</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="password" name="password" placeholder="Password..." />
                            <label for="password">Password</label>
                            <div class="invalid-feedback">Password Harus Diisi !</div>
                        </div>

                        <!-- Phone number input-->



                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-custom-primary rounded-pill btn-lg" id="loginButton" type="submit">Login</button></div>
                    </form>

                    <span>
                        Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#modalDaftar">Daftar</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDaftar" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-custom p-4">
                    <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Daftar</h5>
                    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 p-4">
                    <form id="registerForm">
                        <!-- Name input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" name="nama" placeholder="Nama Lengkap..." />
                            <label for="name">Nama Lengkap</label>
                            <div class="invalid-feedback">Nama Harus Diisi !</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email..." />
                            <label for="email">Email</label>
                            <div class="invalid-feedback">Email Harus Diisi !</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" type="password" name="password" placeholder="Password..." />
                            <label for="password">Password</label>
                            <div class="invalid-feedback">Password Harus Diisi !</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control" id="konfirmasi_password" name="konfirmasi_password" type="password" placeholder="Password..." />
                            <label for="password">Konfirmasi Password</label>
                            <div class="invalid-feedback">Password Harus Diisi !</div>
                        </div>


                        <!-- Submit Button-->
                        <div class="d-grid"><button class="btn btn-custom-primary rounded-pill btn-lg" id="registerButton" type="submit">Daftar</button></div>
                    </form>

                    <span>
                        Sudah punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#modalLogin">Login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>


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
    <script src="assets-fe/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->

    <script>
        $('#registerForm').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: 'register.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Registrasi berhasil, silahkan login'
                    });
                    $('#modalDaftar').modal('hide');
                    $('#registerForm')[0].reset();
                },
                error: function(response) {
                    if (response.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.data
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan, silahkan coba lagi'
                        });
                    }
                }
            });
        });

        $('#loginForm').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Login berhasil'
                    });
                    $('#modalLogin').modal('hide');
                    $('#loginForm')[0].reset();
                    window.location.reload();
                },
                error: function(response) {
                    if (response.status == 400) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.data
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan, silahkan coba lagi'
                        });
                    }
                }
            });
        });

        function like(e, type) {
            // check if user is logged in
            <?php if (!isset($_SESSION['id'])): ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Silahkan login terlebih dahulu untuk memberikan like'
                });
                return;
            <?php endif; ?>

            var id = e.id;
            $.ajax({
                url: 'like.php',
                type: 'POST',
                data: {
                    id: id,
                    type: type
                },
                success: function(response) {
                    if (type == 'like') {
                        e.classList.remove('bi-heart');
                        e.classList.add('bi-heart-fill');
                    } else {
                        e.classList.remove('bi-heart-fill');
                        e.classList.add('bi-heart');
                    }
                    e.nextSibling.textContent = response.data.current_like;
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan, silahkan coba lagi'
                    });
                }
            });
        }

        // find class send_rating
        $(document).on('click', '.send_rating', function() {
            // check if user is logged in
            return;
            <?php if (!isset($_SESSION['id'])): ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Silahkan login terlebih dahulu untuk memberikan rating'
                });
                return;
            <?php endif; ?>

            var rating = $(this).data('rating');
            var recipeId = $(this).data('recipeid');


            $.ajax({
                url: 'rating.php',
                type: 'POST',
                data: {
                    rating: rating,
                    recipeId: recipeId
                },
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan, silahkan coba lagi'
                    });
                }
            });
        });

        // find class load_rating
        $(document).on('click', '.load_rating', function() {
            var rating = $(this).data('rating');
            $('#rating').val(rating);
            $('.load_rating').each(function() {
                if ($(this).data('rating') <= rating) {
                    $(this).removeClass('bi-star');
                    $(this).addClass('bi-star-fill');
                } else {
                    $(this).removeClass('bi-star-fill');
                    $(this).addClass('bi-star');
                }
            });
        });

        $('#commentForm').submit(function(e) {
            e.preventDefault();
            // check rating
            if ($('#rating').val() == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Silahkan berikan rating terlebih dahulu'
                });
                return;
            }

            var data = $(this).serialize();
            $.ajax({
                url: 'comment.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Komentar berhasil dikirim'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                    $('#commentForm')[0].reset();
                    // window.location.reload();
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan, silahkan coba lagi'
                    });
                }
            });
        });



        <?php if (isset($_SESSION['error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= $_SESSION['error'] ?>'
            });
        <?php endif; ?>
        <?php unset($_SESSION['error']); ?>
    </script>


</body>

</html>