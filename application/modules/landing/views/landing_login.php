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


</head>
<body style="height: auto">
<!--WRAPPER START-->
<div class="span6" style="margin: 5% auto;float: none;">
    <div class="form-box" style="min-height:100px">
        <form method="post" action="<?php echo $login_url?>">
        <div class="form-body" >
        <fieldset>
        <legend>Login</legend>
        <?php if ($this->session->flashdata('login_status') == 'wrong'): ?>
            <div class="alert alert-danger">Login failed. Invalid username or password.</div>
        <?php endif; ?>
        <label>User ID</label>
        <input required="" type="text" name="nama_login" placeholder="Enter your User ID" class="input-block-level">
        <label>Password</label>
        <input required="" type="password" name="password" placeholder="Enter Password" class="input-block-level">                        
        
        <button type="submit" class="btn-style">Submit</button>
        </fieldset>
        </div>
        </form>
    </div>
</div>
<!--WRAPPER END-->
<!-- Jquery Lib -->
<script src="<?php echo base_url("landingfiles")?>/js/jquery-1.11.0.min.js"></script>
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
