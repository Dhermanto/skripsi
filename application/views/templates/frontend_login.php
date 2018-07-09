<!DOCTYPE html>
<html lang="en" id="login-page">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>ILEARN for <?php echo @$customer_name; ?></title>

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

	<!-- Site -->
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/webfont/font.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>frontend/assets/css/main-site.css" rel="stylesheet">

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
								
								<div class="panel panel-default no-margin no-border">
									<div class="panel-heading text-center">
										<h3 class="panel-title"><strong>ILEARN for <?php echo @$customer_name; ?></strong></h3>
									</div>
									<div class="panel-body">
										<div class="logo text-center">
											<img src="<?php echo base_url(); ?>uploads/<?php echo @$data['customer_logo'];?>" alt="<?php echo $customer_name; ?>" class="img-responsive" />
										</div>
										<br/>
										<?php if ($this->session->flashdata('login_status') == 'wrong'): ?>
										<div class="alert alert-danger">Login failed. Invalid username or password.</div>
										<?php endif; ?>
										<form role="form" method="post" action="<?php echo @$login_url ?>">
											<div class="form-group">
												<input type="text" name="nama_login" class="form-control required" placeholder="User ID">
												<input type="hidden" name="slug" class="form-control input-lg" value="<?php echo @$data['customer_slug'] ?>" placeholder="customer">
												<input type="hidden" name="id" class="form-control input-lg" value="<?php echo @$data['id'] ?>" placeholder="customer">
												<input type="hidden" name="user_id" class="form-control input-lg" value="<?php echo @$user ?>" placeholder="customer">
											</div>
											<!-- <div class="form-group">
												<input type="email" name="nama_email" class="form-control input-lg" placeholder="Email">
											</div> -->
											<div class="form-group">
												<input type="password" name="password" class="form-control required" placeholder="Password">
											</div>
											<button type="submit" class="btn btn-blue btn-lg btn-block">Login Now</button>
										</form>

										<div class="row text-center">
											<div class="col-xs-12">
												<!-- <a href="<?php echo @$resetpwd_url; ?>" class="btn btn-default btn-block btn-lg">Forgot Password?</a> -->
												<?php echo date('Y'); ?> &copy; Indonesian Institute of Management
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
		<script src="<?php echo base_url(); ?>frontend/assets/js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo base_url(); ?>frontend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	</footer>
</body>
</html>
