<div class="contant" style="margin-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="span3 sidebar">
                <!--TUTOR PROFILE START-->
                <div class="widget course-tutor">
                    <div class="thumb">
                        <img src="<?php echo base_url("uploads/catalogs")."/".$course->course_image?>" alt="">
                    </div>
                    <div class="text">
                        <p class="tutor-name color"><?php echo $course->course_title?></p>
                        <p><?php echo $course->category_name?></p>
                    </div>
                </div>
                <!--TUTOR PROFILE END-->
                
            </div>
            <div class ="span9">
                <!--COURSE DETAIL START-->
                <div class ="tutor-detail-section">
                    <div class ="thumb">
                        <div id="list" width ="100%" height="320"></div>
                        <iframe width ="100%" height="320" src="<?php echo $course->course_demo?>" alt='No Content Video' frameborder="0" allowfullscreen></iframe>
                    </div>
                    <div class="tutor-duration">
                        <div class="duration">
                            <ul>
                                <li>
                                    <h4>Start</h4>
                                    <p><?php echo $course->course_opened_date == "" ? "-" : $course->course_opened_date?></p>
                                </li>
                                <li>
                                    <h4>End</h4>
                                    <p><?php echo $course->course_closed_date == "" ? "-" : $course->course_closed_date?></p>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                        <div class="text">
                            <div class="desc">
                                <?php echo $course->course_description; ?>
                            </div>
                        </div>

                </div>
                <!--COURSE DETAIL END-->
                <!--RELATED COURSES START-->
                
                <!--RELATED COURSES END-->
            </div>
        </div>
    </div>
    <!--FOLLOW US SECTION START-->
    <section class="follow-us">
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
    </section>
    <!--FOLLOW US SECTION END-->
</div>
<!--CONTANT END-->
<script>
$(document).ready(function(){
    var check = $("iframe").attr('src');
    if (check == '') {
        $('#list').html('No content video');
    }

    $('.desc > ul').addClass('list-style1');
    $('.desc > ol').addClass('list-style1');

})
</script>
