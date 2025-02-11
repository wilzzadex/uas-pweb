<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(0);
// if (session_status() == PHP_SESSION_NONE) {
session_start();
// }


// get data from category 
include "config/koneksi.php";
include "utils/helper.php";

$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

$dataCategory = mysqli_fetch_all($result, MYSQLI_ASSOC);

$queryMostPopular = "SELECT r.*, SUM(rc.rating) as total_rating 
                     FROM recipes r 
                     LEFT JOIN recipe_comment rc ON r.id = rc.recipe_id 
                     GROUP BY r.id 
                     ORDER BY total_rating DESC 
                     LIMIT 6";
$resultMostPopular = mysqli_query($conn, $queryMostPopular);
$dataMostPopular = mysqli_fetch_all($resultMostPopular, MYSQLI_ASSOC);


$queryMostLiked = "SELECT r.*, COUNT(rl.recipe_id) as total_likes 
                   FROM recipes r 
                   LEFT JOIN recipe_likes rl ON r.id = rl.recipe_id 
                   GROUP BY r.id 
                   ORDER BY total_likes DESC 
                   LIMIT 6";
$resultMostLiked = mysqli_query($conn, $queryMostLiked);
$dataMostLiked = mysqli_fetch_all($resultMostLiked, MYSQLI_ASSOC);

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
			<a class="navbar-brand fw-bold" href="#page-top">
				<img src="assets-fe/logo.png" alt="Logo" style="height: 50px;">
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
	<header class="masthead">
		<div class="container px-5">
			<div class="row gx-5 align-items-center">
				<div class="col-lg-6">
					<!-- Mashead text and app badges-->
					<div class="mb-5 mb-lg-0 text-center text-lg-start">
						<h4 class="display-1 lh-1 mb-3">Rasa Bersama</h4>
						<p class="lead fw-normal text-muted mb-5">Selamat datang di RasaBersama, tempat di mana rasa bertemu dengan kebersamaan! Temukan berbagai resep unik dan autentik dari seluruh penjuru nusantara hingga mancanegara, atau bagikan kreasi kuliner favorit Anda kepada dunia. Bergabunglah dengan komunitas pecinta kuliner, beri inspirasi, dan nikmati perjalanan mengeksplorasi kekayaan cita rasa bersama. Di sini, setiap masakan adalah cerita, dan setiap rasa adalah pengalaman untuk dibagikan.</p>

					</div>
				</div>
				<div class="col-lg-6">
					<!-- Masthead device mockup feature-->
					<div class="masthead-device-mockup">
						<img src="<?= base_url() ?>assets-fe/bg-header.png" class="img-fluid" alt="..." />
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Quote/testimonial aside-->
	<aside class="text-center bg-gradient-custom">
		<div class="container px-5">
			<div class="row gx-5 justify-content-center">
				<div class="col-xl-8">
					<div class="h2 fs-1 text-white">Resep Paling Populer</div>
				</div>
			</div>
		</div>
	</aside>
	<!-- App features section-->
	<section id="features">
		<div class="container px-5">
			<div class="row gx-5 align-items-center">
				<div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
					<div class="container-fluid px-5">
						<div class="row gx-5">
							<?php foreach ($dataMostPopular as $recipe): ?>
								<div class="col-md-4 mb-5">
									<div class="card">
										<img src="<?= base_url() ?>uploads/<?= $recipe['image'] ?>" class="card-img-top" style="max-height: 200px;object-fit: cover;" alt="...">
										<div class="card-body">
											<table style="width: 100%;">
												<tr>
													<td>
                                                        <h5 class="card-title"><a href="detail.php?id=<?= $recipe['id'] ?>" style="text-decoration: none;"><?= $recipe['title'] ?></a></h5>
                                                    </td>
													<td rowspan="2" class="text-right">
														<?php if (is_like($recipe['id'])): ?>
															<i class="bi-heart-fill text-danger" onclick="like(this,'unlike')" id="<?= $recipe['id'] ?>" style="cursor: pointer;"></i> <?= calculate_like($recipe['id']) ?>
														<?php else: ?>
															<i class="bi-heart text-danger" onclick="like(this,'like')" id="<?= $recipe['id'] ?>" style="cursor: pointer;"></i> <?= calculate_like($recipe['id']) ?>
														<?php endif; ?>
													</td>
												</tr>
												<tr>
													<td colspan="2">

														<?php if (isset($_SESSION['id'])): ?>
															<?= your_rating($recipe['id']) ?>
														<?php else : ?>
															<?= calculate_rating($recipe['id']) ?>
														<?php endif; ?>

													</td>

												</tr>
											</table>
										</div>
									</div>

								</div>
							<?php endforeach; ?>


						</div>

					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Basic features section-->
	<aside class="text-center bg-gradient-custom">
		<div class="container px-5">
			<div class="row gx-5 justify-content-center">
				<div class="col-xl-8">
					<div class="h2 fs-1 text-white">Resep Paling Disukai</div>
				</div>
			</div>
		</div>
	</aside>
	<!-- App features section-->
	<section id="features">
		<div class="container px-5">
			<div class="row gx-5 align-items-center">
				<div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
					<div class="container-fluid px-5">
						<div class="row gx-5">
							<?php foreach ($dataMostLiked as $recipe): ?>
								<div class="col-md-4 mb-5">
									<div class="card">
										<img src="<?= base_url() ?>uploads/<?= $recipe['image'] ?>" class="card-img-top" style="max-height: 200px;object-fit: cover;" alt="...">
										<div class="card-body">
											<table style="width: 100%;">
												<tr>
													<td>
                                                        <h5 class="card-title"><a href="detail.php?id=<?= $recipe['id'] ?>" style="text-decoration: none;"><?= $recipe['title'] ?></a></h5>
                                                    </td>
													<td rowspan="2" class="text-right">
														<?php if (is_like($recipe['id'])): ?>
															<i class="bi-heart-fill text-danger" onclick="like(this,'unlike')" id="<?= $recipe['id'] ?>" style="cursor: pointer;"></i> <?= calculate_like($recipe['id']) ?>
														<?php else: ?>
															<i class="bi-heart text-danger" onclick="like(this,'like')" id="<?= $recipe['id'] ?>" style="cursor: pointer;"></i> <?= calculate_like($recipe['id']) ?>
														<?php endif; ?>
													</td>
												</tr>
												<tr>

													<td colspan="2">

														<?= calculate_rating($recipe['id']) ?>


													</td>

												</tr>
											</table>
										</div>
									</div>

								</div>
							<?php endforeach; ?>

						</div>

					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- Basic features section-->


	<footer class="bg-black text-center py-5">
		<div class="container px-5">
			<div class="text-white-50 small">
				<div class="mb-2">2025&copy; Rasa Bersama . By Kelompok 6</div>

			</div>
		</div>
	</footer>
	<!-- Feedback Modal-->
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


		// check session error
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