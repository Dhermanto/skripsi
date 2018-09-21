<!DOCTYPE html>
<html lang="en" id="login-page">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>ILEARN | IIM Learning Center</title>

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
	<!-- Plugins -->
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/webfont/font.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>frontend/assets/plugins/iconfont/iconfont.css" rel="stylesheet">

	<!-- Site -->
	<link href="<?php echo base_url(); ?>frontend/assets/css/main-site.css" rel="stylesheet">

	<script src="<?php echo base_url(); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>frontend/assets/js/bootstrap-confirmation.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	<style media="screen">
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	    /* display: none; <- Crashes Chrome on hover */
	    -webkit-appearance: none;
	    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
	}

	.glyphicon.glyphicon-file {
	    font-size: 30px;
	}

	.modal {
		text-align: center;
		padding: 0!important;
	}

	.nopadding {
   		padding: 3px !important;
   		margin: 2px !important;
		left: 14px !important;
	}

	.spasi {
		width: 107% !important;
	}

	.modal:before {
		content: '';
		display: inline-block;
		height: 100%;
		vertical-align: middle;
		margin-right: -4px;
	}

	.modal-dialog {
		display: inline-block;
		text-align: left;
		vertical-align: middle;
	}

	.tab-active {
		display: block;
	}

	.tab-not-active {
		display: none;
	}
	</style>

</head>

<?php
	$this->load->model('customer/customer_model');
	$userData 	= $this->session->userdata('user');
    $id       	= $userData->id;
    $id_user  	= $userData->user_id;
    $nama       = $userData->user_name;
    $logo  	  	= $this->db->get_where('customers', array('id' => $id))->row()->customer_logo;
    $query_exp  = "SELECT * FROM customer_credits WHERE customer_id = $id ORDER BY id DESC";
    $exp 	    = $this->db->query($query_exp)->row()->credit_exp_date;

    if ($userData->user_group == 'admin_bank') {
        $credit = $this->customer_model->give_id($userData->id)->row()->credit_point;
    }
    else {
        $credit = $this->db->query("SELECT *, IFNULL(SUM(credit_point), 0) AS credit FROM user_journals WHERE user_id = $id_user")->row()->credit;
    }
    //total keranjang
    $this->db->select("*, count(*) AS total")->where(array('user_id' => $id_user));
    $keranjang = $this->db->get('user_course')->row()->total;
?>

<body id="dashboard">
    <nav id="nav-dashboard" class="navbar navbar-default no-margin navbar-fixed-top">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header fixed-brand">
			<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div><!-- navbar-header-->

		<ul id="welcome" class="nav navbar-nav navbar-left">
			<li>
				<a href="#">
					<div class="media">
						<div class="media-left">
							<div class="photo">
								<img src="<?php echo base_url(); ?>frontend/assets/images/avatar.jpeg" alt="Jokowi" />
							</div>
						</div> <!-- //photo -->

						<div class="media-body media-middle">
							<small class="block">Welcome</small>
							<div class="media-heading"><b><?php echo $nama; ?></b></div>
						</div> <!-- //name -->
					</div> <!-- //media -->
				</a>
			</li>

			<li class="hidden-xs">
				<div class="media deposite">
					<div class="media-body media-middle">
						<small id="credit" class="block">Credit Points</small>
						<div class="media-heading"><b id="credit-point"><?php echo $credit ?></b> Points</div>
					</div> <!-- //name -->
				</div> <!-- //media -->
			</li>
			<?php if ($credit > 0): ?>
				<li class="hidden-xs">
					<div class="media deposite">
						<div class="media-body media-middle">
							<small id="credit" class="block">Expired date point</small>
							<div class="media-heading"><b id="point"><?php echo $exp ?></b></div>
						</div> <!-- //name -->
					</div> <!-- //media -->
				</li>
			<?php endif ?>
		</ul> <!-- //welcome user -->

		<ul id="welcome" class="nav navbar-nav navbar-right">
			<a href="<?php echo site_url('apps/login_apps/logout') ?>" class="btn btn-warning btn-sm btn-icon logout">
				<i class="icon ic-launch"></i> Logout
			</a>
		</ul> <!-- //logut -->
    </nav>

    <main>
		<aside class="navmenu navmenu-default navmenu-fixed-left offcanvas-sm">
			<div class="logo">
				<img src="<?php echo base_url(); ?>uploads/<?php echo @$logo;?>" alt="Logo"/>
			</div>
			<ul class="nav navmenu-nav">
				<?php
			        $userDetail = $this->session->userdata('user');
			    ?>
			    <li <?php echo ($this->uri->segment(2) === "index") ? "class='active'" : ""; ?>><a href="<?php echo site_url('/apps/index'); ?>">Dashboard</a></li>
			    <?php if ($userDetail->user_group == 'admin_bank'): ?>
			    	<li <?php echo ($this->uri->segment(2) === "positionmanagement") ? "class='active'" : ""; ?>><a href="<?php echo site_url('/apps/positionmanagement'); ?>">Position Management</a></li>
			    	<li <?php echo ($this->uri->segment(2) === "usermanagement") ? "class='active'" : ""; ?>><a href="<?php echo site_url('/apps/usermanagement'); ?>">User Management</a></li>
			    	<li <?php echo ($this->uri->segment(2) === "result-admin") ? "class='active'" : ""; ?>><a href="<?php echo site_url('/apps/adminbankresult'); ?>">Course Result</a></li>
			    <?php else: ?>
			    	<li <?php echo ($this->uri->segment(2) === "katalog") ? "class='active'" : ""; ?>><a href="<?php echo site_url('/apps/katalog'); ?>">Course Catalog</a></li>
			    	<li <?php echo ($this->uri->segment(2) === "bookmarked") ? "class='active'" : ""; ?> ><a href="<?php echo site_url('/apps/bookmarked'); ?>">Bookmarked Course <span id="keranjang"><?php echo (!empty($keranjang)) ? "($keranjang)" : ""; ?></span></a></li>
			    	<li <?php echo ($this->uri->segment(2) === "result") ? "class='active'" : ""; ?>><a href="<?php echo site_url('/apps/result'); ?>">Course Result</a></li>
			    <?php endif ?>
				<li <?php echo ($this->uri->segment(2) === "pengaturan") ? "class='active'" : ""; ?>><a href="<?php echo site_url('/apps/pengaturan'); ?>">Change Password</a></li>
				<li <?php echo ($this->uri->segment(3) === "logout") ? "class='active'" : ""; ?>><a class='logout' href="<?php echo site_url('/apps/login_apps/logout'); ?>">Logout</a></li>
			</ul>
		</aside>

		<section id="wrapper">
			<!-- Page Content -->
			<?php $this->load->view($content); ?>
		</section> <!-- /#page-content-wrapper -->
	</main> <!-- //main -->

    <footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="<?php echo base_url(); ?>frontend/assets/js/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="<?php echo base_url(); ?>frontend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>frontend/assets/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
		<!-- Site function -->
		<script src="<?php echo base_url(); ?>frontend/assets/js/site.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.number.min.js"></script>
		<!-- <script src="<?php echo base_url(); ?>frontend/assets/js/confirm-simple.js"></script> -->
		<script src="<?php echo base_url(); ?>vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
		<script src="<?php echo base_url(); ?>vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
	</footer>

<script>
	$().ready(function(){
		$('li > a').click(function() {
			$('li').removeClass();
			$(this).parent().addClass('active');
		});

		var point 		= $('#point').text();
		var point_int   = parseInt(point);

		$('.bookmark').click(function(e){
			var credit 	   = $(this).parent().parent().parent().find('.price').children().children().text();
			var credit_int = parseInt(credit);
			var total      = point_int - credit_int;

			if (total < 0) {
				e.preventDefault();
				swal("Sorry, your point is not enough!");
			}
		});

		$(document).on('click', '.enroll', function(){
			var dataHref = $(this).data("href");
			swal({
			    title: "Are you sure?",
			    text: "Are You sure want to enroll this course? Once You enrolled this course, You cannot cancel it anymore.",
			    type: "warning",
			    showCancelButton: true,
			    confirmButtonColor: '#DD6B55',
			    confirmButtonText: 'Yes, I am sure!',
			    cancelButtonText: "No, cancel it!",
			    closeOnConfirm: false,
			    closeOnCancel: false
			},
			function(isConfirm){
			   	if (isConfirm){
			     	swal("Enrolled!", "Course are successfully enrolled!", "success");
			     	window.location = dataHref;
			    } else {
			      	swal("Cancelled", "your point will be returned", "error");
			    }
			});
	    })
});

function success(message)
	{
		$.growl({
			title: 'Success! ',
			message: message,
			url: ''
		}, {
			element: 'body',
			type: 'success',
			allow_dismiss: true,
			placement: {
				from: 'top',
				align: 'right'
			},
			offset: {
				x: 50,
				y: 80
			},
			spacing: 10,
			z_index: 1030,
			delay: 3000,
			timer: 1000,
			url_target: '_blank',
			mouse_over: false,
			animate: {
				enter: 'animated flipInY',
				exit: 'animated flipOutY'
			},
			icon_type: 'class',
			template:
				'<div data-growl="container" class="alert" role="alert">' +
					'<button type="button" class="close" data-growl="dismiss">' +
						'<span aria-hidden="true">&times;</span>' +
						'<span class="sr-only">Close</span>' +
					'</button>' +
					'<span data-growl="icon"></span>' +
					'<span data-growl="title"></span>' +
					'<span data-growl="message"></span>' +
					'<a href="#" data-growl="url"></a>' +
				'</div>'
			});
	}
function error(message)
{
	$.growl({
		title: 'Error! ',
		message: message,
		url: ''
	}, {
		element: 'body',
		type: 'danger',
		allow_dismiss: true,
		placement: {
			from: 'top',
			align: 'right'
		},
		offset: {
			x: 50,
			y: 80
		},
		spacing: 10,
		z_index: 1030,
		delay: 3000,
		timer: 1000,
		url_target: '_blank',
		mouse_over: false,
		animate: {
			enter: 'animated flipInY',
			exit: 'animated flipOutY'
		},
		icon_type: 'class',
		template:
			'<div data-growl="container" class="alert" role="alert">' +
				'<button type="button" class="close" data-growl="dismiss">' +
					'<span aria-hidden="true">&times;</span>' +
					'<span class="sr-only">Close</span>' +
				'</button>' +
				'<span data-growl="icon"></span>' +
				'<span data-growl="title"></span>' +
				'<span data-growl="message"></span>' +
				'<a href="#" data-growl="url"></a>' +
			'</div>'
		});
}

$().ready(function() {
	$('[type=text], [type=email]').attr('autocomplete', 'off');
	$('.number').number(true, 0, '.', ',');
	$('.decimal').number(true, 2, '.', ',');

	$('.required').blur(function() {
		if ($(this).val() != '') $(this).parent().parent().parent().removeClass('has-error');
		else $(this).parent().parent().parent().addClass('has-error');
	});

	$('form').submit(function() {
		var required_arr = $(this).find('.required');
		var has_focused = false;
		var is_completed = true;

		$.each(required_arr, function(key, obj) {
			if ($(obj).val() == '') {
				$(obj).parent().parent().parent().addClass('has-error');
				is_completed = false;

				if ( ! has_focused) {
					$(obj).focus();
					has_focused = true;
				}
			}
			else {
				$(obj).parent().parent().parent().removeClass('has-error');
			}
		});

		if ( ! is_completed) {
			swal('Please complete the form!');
			return false;
		}

		$(this).find('.form-control').attr('readonly', true);
		// $(this).find('[type=submit]').attr('disabled', true);

		return true;
	});

	$('.btn-delete').click(function(e) {
		e.preventDefault();

		var warning = $(this).attr('warning');
		var delete_url = $(this).attr('href');

		swal ({
			title: 'Delete Data'
			, text: 'Are you sure want to delete "'+warning+'" data?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonText: 'Yes, delete it.'
            , cancelButtonText: 'Cancel'
			, closeOnConfirm: false
		}, function() {
			window.location = delete_url;
		});
	});

    $('.logout').click(function(e){
        e.preventDefault();

        var target_url = $(this).attr('href');

        swal ({
            title: 'Logout'
            , text: 'Are you sure want to logout ?'
            , type: 'warning'
            , showCancelButton: true
            , confirmButtonText: 'Yes'
            , cancelButtonText: 'Cancel'
            , closeOnConfirm: false
        }, function() {
            window.location = target_url;
        });
    })
});
</script>
</body>
</html>
