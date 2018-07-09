<!DOCTYPE html>
<html lang="en" id="login-page">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Login</title>

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>ilearn-frontend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>ilearn-frontend/assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

	<!-- Site -->
	<link href="<?php echo base_url(); ?>ilearn-frontend/assets/plugins/webfont/font.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>ilearn-frontend/assets/css/main-site.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body id="login-page">
	<main>
		<section id="login" class="login space-top-8 space-8">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 col-center">
						<div class="form">
							<div class="block">
								<div class="logo text-center">
									<img src="<?php echo base_url(); ?>ilearn-frontend/assets/images/logo.png" alt="Logo" class="img-responsive" />
								</div>

								<div class="panel panel-default no-margin no-border">
									<div class="panel-heading text-center">
										<h3 class="panel-title"><strong>Login ke Dashboard</strong></h3>
									</div>
									<div class="panel-body">
										<form role="form" action="dashboard-home.html">
											<div class="form-group">
												<input type="email" class="form-control input-lg" placeholder="Email">
											</div>
											<div class="form-group">
												<input type="password" class="form-control input-lg" placeholder="Password">
											</div>
											<button type="submit" class="btn btn-blue btn-lg btn-block">Masuk</button>
										</form>

										<div class="row text-center">
											<div class="col-xs-12">
												<a href="login-reset.html" class="btn btn-default btn-block btn-lg">Lupa password?</a>
											</div>
										</div> <!-- //row -->
									</div>
								</div>
							</div>
						</div>
					</div> <!-- //col -->
				</div> <!-- //row -->
			</div>
		</section>
	</main> <!-- //main -->

	<footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?php echo base_url(); ?>ilearn-frontend/assets/js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo base_url(); ?>ilearn-frontend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	</footer>
</body>
</html>
