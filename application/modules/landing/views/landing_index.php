<!-- BANNER START-->
    <div class="banner">
        <ul class="bxslider">
          <li><img src="<?php echo base_url("landingfiles")?>/slider/1.jpg" alt=""> </li>
          <li><img src="<?php echo base_url("landingfiles")?>/slider/2.jpg" alt=""></li>
          <li><img src="<?php echo base_url("landingfiles")?>/slider/3.jpg" alt=""></li>
          <li><img src="<?php echo base_url("landingfiles")?>/slider/4.jpg" alt=""></li>
          <!-- <li><img src="<?php echo base_url("landingfiles")?>/slider/5.jpg" alt=""></li> -->
        </ul>
        <div class="newsletters">
        	<h1>Welcome to iLearn.</h1>
            <h4>Search for online courses on Marketing, Banking, Corporate, or anything else.</h4>
            <!-- <div class="subscribe">
            	<input type="text" class="input-block-level">
                <button>Subscribe</button>
            </div> -->
        </div>
    </div>
    <!--BANNER END-->
    <!--CONTANT START-->
    <div class="contant">
    	<!--SERVICES SECTION START-->
        <section>
        	<div class="container">
            	<!--SECTION HEADER START-->
            	<div class="sec-header">
                	<h2>Courses</h2>
                    <!-- <p>Student &amp; Campus Life</p> -->
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <!--SECTION HEADER END-->
                <div class="row">
                    <?php foreach($courses as $x => $v):?>
                	<div class="span3" style="margin-bottom: 20px">
                    	<div class="f-stories">
                        	<div class="thumb" style="height: 150px">
                            	<a href="<?php echo base_url("landing/course")."/".$v['id']?>"><img src="<?php echo base_url("uploads/catalogs")."/".$v['course_image']?>" alt=""></a>
                            </div>
                            <div class="text" style="height: 130px">
                            	<h4><?php echo $v['course_title']?></h4>
                                <!-- <p> -->
                                    <?php 
                                        // echo substr($v['course_description'], 0, 70); 
                                    ?> 
                                    <!-- . . . 
                                </p> -->
                                <a href="<?php echo base_url("landing/course")."/".$v['id']?>">Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </section>
        <!--SERVICES SECTION END-->
        <!--SERVICES SECTION START-->
        <section>
            <div class="container">
                <!--SECTION HEADER START-->
                <div class="sec-header">
                    <h2>Our Services</h2>
                    <p>Take a look at what we have are doing</p>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <!--SECTION HEADER END-->
                <div class="row">
                    <?php foreach($category as $x => $v):?>
                    <!--SERVICE ITEM START-->
                    <a href="<?php echo base_url() ?>landing/content/<?php echo $v['id'] ?>">
                        <div class="span4" style="margin-bottom: 20px">
                            <div class="services">
                                <div class="header">
                                    <i class="fa fa-tablet"></i>
                                    <i class="fa <?php echo icon()[$x] ?> inner-icon"></i>
                                </div>
                                <div class="text">
                                    <h3><?php echo $v['category_name']?></h3>
                                    <!-- <p>UI improvements were the one aspect of WordPress's future that everyone I spoke to seemed to agree on: </p> -->
                                </div>
                            </div>
                        </div>
                    </a>
                    <!--SERVICE ITEM END-->
                    <?php endforeach;?>
                </div>
            </div>
        </section>
        <!--SERVICES SECTION END-->
        
        <!--FOLLOW US SECTION START-->
        <!-- <section class="follow-us">
        	<div class="container">
            	<div class="row">
                	<div class="span4">
                    	<div class="follow">
                        	<a href="#">
                                <i class="fa fa-facebook"></i>
                                <div class="text">
                                    <h4>Follow us on Facebook</h4>
                                    <p>Faucibus toroot menuts</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="span4">
                    	<div class="follow">
                        	<a href="#">
                                <i class="fa fa-google"></i>
                                <div class="text">
                                    <h4>Follow us on Google Plus</h4>
                                    <p>Faucibus toroot menuts</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="span4">
                    	<div class="follow">
                        	<a href="#">
                                <i class="fa fa-linkedin"></i>
                                <div class="text">
                                    <h4>Follow us on Linkedin</h4>
                                    <p>Faucibus toroot menuts</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!--FOLLOW US SECTION END-->
    </div>
    <!--CONTANT END
