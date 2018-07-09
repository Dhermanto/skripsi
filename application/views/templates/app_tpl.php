<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-LEARNING | SYSTEM</title>

        <!-- Vendor CSS -->
        <link href="<?php echo base_url(); ?>vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>vendors/bower_components/chosen/chosen.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="<?php echo base_url(); ?>css/app.min.1.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/app.min.2.css" rel="stylesheet">

		<!-- Javascript Libraries -->
        <script src="<?php echo base_url(); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url(); ?>vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bower_components/fullcalendar/dist/fullcalendar.min.js "></script>
        <!-- <script src="<?php echo base_url(); ?>vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script> -->
        <script src="<?php echo base_url(); ?>vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>vendors/bower_components/chosen/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url(); ?>vendors/bower_components/typeahead.js/dist/typeahead.bundle.min.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.number.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="<?php echo base_url(); ?>vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url(); ?>js/functions.js"></script>
        <script>
		function currencytonum(str)
		{
			if (str == '') return 0;
			str = str.replace(/\,/g, '');
			return parseFloat(str);
		}

        function seccessSwal(message) {
            swal ({
                title: 'Success'
                , text: 'message'
                , type: 'success'
            });
        }

		function success(message)
		{
			$.growl({
				title: 'Sukses! ',
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
					alert('Mohon lengkapi form!');
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
    </head>
    <?php
        $userDetail = $this->session->userdata('pengguna');
    ?>
    <body class="sw-toggled">
        <header id="header" class="clearfix" data-current-skin="blue">
            <ul class="header-inner">
                <li id="menu-trigger" data-trigger="#sidebar">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">
                    <a href="<?php echo site_url('/dasbor'); ?>">IIM CENTER E-LEARNING SYSTEM</a>
                </li>

                <li class="pull-right">
                    <ul class="top-menu">
                        <li class="dropdown">
                            <a data-toggle="dropdown" href=""><i class="tm-icon zmdi zmdi-account-circle"></i></a>
                            <ul class="dropdown-menu dm-icon pull-right">
								<li>
                                    <a href="<?php echo site_url('/pengguna'); ?>"><i class="zmdi zmdi-face"></i> <?php echo $this->session->userdata('pengguna')->user_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('/auth/auth/password'); ?>"><i class="zmdi zmdi-key"></i> Change Password</a>
                                </li>
                                <li class="divider"></li>
								<li>
                                    <a href="<?php echo site_url('/auth/auth/logout'); ?>"><i class="zmdi zmdi-power"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/auth/auth/logout'); ?>" class="logout"><i class="tm-icon zmdi zmdi-power"></i></a>
                        </li>
                    </ul>
                </li>
            </ul>


            <!-- Top Search Content -->
            <div id="top-search-wrap">
                <div class="tsw-inner">
                    <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
                    <input type="text">
                </div>
            </div>
        </header>

        <section id="main" data-layout="layout-1">
            <aside id="sidebar" class="sidebar c-overflow">
                <ul class="main-menu">
                    <li>
                        <a href="<?php echo site_url('/dasbor'); ?>"><i class="zmdi zmdi-home"></i>Dashboard</a>
                    </li>
                    <?php if ($userDetail->user_group == 'admin_bank'): ?>
                        <li>
                            <a href="<?php echo site_url("/customer/give/$userDetail->customer_id/userBank"); ?>"><i class="zmdi zmdi-home"></i>Give Credit</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("/user_bank/index/$userDetail->customer_id"); ?>"><i class="zmdi zmdi-layers"></i> Users</a>
                        </li>
                    <?php else: ?>
                        <li>
                        <a href="<?php echo site_url('/category/category'); ?>"><i class="zmdi zmdi-layers"></i>Course Categories</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/course/course'); ?>"><i class="zmdi zmdi-layers"></i> Courses</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/result/result'); ?>"><i class="zmdi zmdi-layers"></i> Course Result</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/customer/customer'); ?>"><i class="zmdi zmdi-layers"></i> Customers</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/user/user'); ?>"><i class="zmdi zmdi-layers"></i> Users</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('/credit/credit'); ?>"><i class="zmdi zmdi-layers"></i> Credit Points</a>
                        </li>
                       <!--  <li>
                            <a href="<?php echo site_url('/landing/content'); ?>"><i class="zmdi zmdi-layers"></i> Content</a>
                        </li> -->
                        <li>
                            <a href="<?php echo site_url('/auth/auth/logout'); ?>" class="logout"><i class="zmdi zmdi-power"></i> Logout</a>
                        </li>
                    <?php endif ?>
                </ul>
            </aside>

            <section id="content">
                <div class="container">
                    <?php $this->load->view($content); ?>
                </div>
            </section>
        </section>

        <footer id="footer">
            Copyright &copy; <?php echo date('Y'); ?> - iLearn - <a href="#" target="_blank">IIM CENTER</a>
        </footer>
    </body>
</html>
