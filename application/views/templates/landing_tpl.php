<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>iLearn</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CUSTOM CSS -->
<link href="<?php echo base_url("landingfiles")?>/css/style.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url("landingfiles")?>/css/color3.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url("landingfiles")?>/css/transitions.css" rel="stylesheet" media="screen">
<!-- BOOTSTRAP -->
<link href="<?php echo base_url("landingfiles")?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url("landingfiles")?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
<!-- BX SLIDER-->
<link href="<?php echo base_url("landingfiles")?>/css/jquery.bxslider.css" rel="stylesheet" media="screen">
<!-- OWL CAROUSEL -->
<link href="<?php echo base_url("landingfiles")?>/css/owl.carousel.css" rel="stylesheet">
<!-- FONT AWESOME -->
<link href="<?php echo base_url("landingfiles")?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
<!-- PARALLAX BACKGROUNDS -->
<link href="<?php echo base_url("landingfiles")?>/css/parallax.css" rel="stylesheet" type="text/css" />

<script src="<?php echo base_url("landingfiles")?>/js/jquery-1.11.0.min.js"></script>
</head>
<body>
<!--WRAPPER START-->
<div class="wrapper">
    <!--HEADER START-->
    <header class="header-6">
    	<!--NAVIGATION START-->
        <!--NAVIGATION START-->
        <div class="navigation-bar">
            <div class="container">
                <div class="logo" style="width: auto;margin: 10px 0;text-align: center;">
                    <a href="<?php echo base_url()?>" style="color: #FFF;font-size: 30px;font-weight:700;height: 100%;line-height: 50px">iLearn</a>
                </div>
                <div class="navigation">
                    <div class="navbar">
                      <div class="navbar-inner" >
                        <div class="container">
                          <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                          <div class="nav-collapse collapse">
                            <ul>
                                <li><a href="<?php echo base_url()?>">Home</a></li>
                                <li><a href="<?php echo base_url("login")?>">Login</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!--NAVIGATION END-->
        <!--NAVIGATION END-->
    	<!--TOP STRIP START-->
        
        <!--TOP STRIP END-->
        
    </header>
    <!--HEADER END-->
    <?php $this->load->view($content); ?>
    <!--FOOTER START-->
    <footer>
        <div class="copyright">
        	<div class="container">
        		<p>© Copyrights 2016. All Rights Reserved <a href="#">iLearn</a></p>
            </div>
        </div>
    </footer>
    <!--FOOTER END-->
</div>
<!--WRAPPER END-->
<!-- Jquery Lib -->
<!-- Bootstrap -->
<script src="<?php echo base_url("landingfiles")?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url("landingfiles")?>/js/jquery.bxslider.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="<?php echo base_url("landingfiles")?>/js/owl.carousel.js"></script>
<script src="<?php echo base_url("landingfiles")?>/js/modernizr.js"></script>
<script type="text/javascript" src="<?php echo base_url("landingfiles")?>/js/skrollr.min.js"></script>
<script src="<?php echo base_url("landingfiles")?>/js/functions.js"></script>
</body>
</html>
