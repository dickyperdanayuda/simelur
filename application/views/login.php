<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login | Simelur</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url("assets"); ?>/dist/css/adminlte.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?= base_url("assets"); ?>/plugins/toastr/toastr.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>
	body {
		display: flex;
		align-items: center;
	}

	.logg {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
</style>

<body class="hold-transition login-page" style="background-color:grey;">
	<input type="hidden" id="base_link" value="<?= base_url(); ?>">
	<div class="container">
		<div class="login-box logg">
			<div class="card" style="border-radius: 10px;">
				<div class="login-logo card-header" style="font-weight: bold; font-family:calibri; padding-top:15px;">
					<a href="<?= base_url(); ?>"><img src="<?= base_url('assets/files/1.png') ?>" width="250px;">
					</a>
				</div>
				<div class="card-body">
					<p class="login-box-msg">Assalamualaikum, Silahkan Login</p>

					<form action="<?= base_url("Login/proses"); ?>" method="post" id="frm_login">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-user"></span>
								</div>
							</div>
							<input type="text" class="form-control" name="username" placeholder="Username" required>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<input type="password" class="form-control" name="password" placeholder="Password" required>
						</div>
						<div class="row" style="margin-bottom: 30px;">
							<div class="col-lg-12">
								<button type="submit" class="btn btn-dark btn-block" style="border-radius: 30px;">Masuk</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src=" <?= base_url("assets"); ?>/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url("assets"); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url("assets"); ?>/dist/js/adminlte.min.js"></script>
	<!-- Toastr -->
	<script src="<?= base_url("assets"); ?>/plugins/toastr/toastr.min.js"></script>
	<!-- Custom -->
	<script>
		var base_link = $("#base_link").val();
		$(function() {
			$('.list-inline li > a').click(function() {
				var activeForm = $(this).attr('href') + ' > form';
				//console.log(activeForm);
				$(activeForm).addClass('magictime swap');
				//set timer to 1 seconds, after that, unload the magic animation
				setTimeout(function() {
					$(activeForm).removeClass('magictime swap');
				}, 1000);
			});

		});

		$("#frm_login").submit(function(e) {
			e.preventDefault();
			$(".btn").attr("disabled", true);
			$.ajax({
				type: "POST",
				url: base_link + "Login/proses",
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(d) {
					var res = JSON.parse(d);
					if (res.status == 1) {
						toastr.success('Login Berhasil!<br/>' + res.desc);
						setTimeout(function() {
							document.location.href = "";
						}, 1000);
					} else {
						$(".btn").attr("disabled", false);
						toastr.error('Login Gagal!<br/>' + res.desc);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$(".btn").attr("disabled", false);
					toastr.error('Error! ' + errorThrown);
				}
			});
		});
	</script>

</body>

</html>