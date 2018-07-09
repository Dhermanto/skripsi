<!-- Page Content -->
<?php
	$date1		= $course_detail->course_opened_date;
	$date2		= $course_detail->course_closed_date;
	$datetime1 	= new DateTime($date1);
	$datetime2 	= new DateTime($date2);
	$difference = $datetime1->diff($datetime2);

	$count = 0;
	$date = date("Y-m-d H:i:s");
	$array_satu = array(0);
	$array_dua = array(0);
	$array_tiga = array(0);

	foreach ($course_id as $key => $course) {
		@$array_satu[] = $course['course_id'];
	}
	foreach ($cek_date as $key => $cek) {
		@$array_dua[] 	= $cek['course_id'];
		@$array_tiga[] 	= $cek['course_closed_date'];
	}
?>
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="detail">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<div class="images">
						<img class="img-responsive img-rounded" width="100%" src="<?php echo base_url('/uploads/catalogs/'.$my_course->course_image); ?>" />
					</div> <!-- //images -->
					<div class="name">
						<h2><b><?php echo $my_course->course_title; ?></b></h2>
					</div> <!-- //name -->
					<div class="price">
						<div class="row">
							<div class="col-xs-5">
								<span>Credit Points</span>
							</div> <!-- //col -->
							<div class="col-xs-7">
								<span class="text-danger"><b><?php echo $my_course->credit_point; ?></b></span>
							</div> <!-- //col -->
						</div> <!-- //row -->
					</div> <!-- //price -->
					<div class="meta reg-button">
						<?php if ($my_course->enrollment_status == 1): ?>
							<?php if (is_null($my_course->completion_date)): ?>
								<button class="btn btn-warning" style="width: 100%" id="completion" title="When you're done watching the video">Completion</button>
							<?php else: ?>
								<button class="btn bgm-lightgreen waves-effect" style="width: 100%" id="recorded">Done</button>
							<?php endif ?>
						<?php endif ?>
						<?php
							if ($userCourseId == '') {
								$userCourseId = $my_course->id;
							}
							switch ($my_course->enrollment_status) {
								case null:
									echo "<a href=\"".base_url()."apps/katalog/course_in/". $userCourseId ."\" 
									class=\"btn btn-lg btn-block btn-primary\"> Bookmark Now </a> ";
									break;
								case 0:
									echo "<div class=\"row\">
                                            <div class=\"col-md-6\">
                                                <a href=\"".base_url("apps/katalog/course_out/enroll")."/".$userCourseId."\"
                                                onclick=\"
                                                window.onload('http://localhost/ilearn/apps/bookmarked');\" class=\"btn btn-primary btn-lg btn-block enroll\">ENROLL</a>
                                            </div>
											<div class=\"col-md-6\">
                                                <a id='daftar' href=\"".base_url("apps/katalog/course_out/cancel")."/".$userCourseId."\" class=\"btn btn-danger btn-lg btn-block\">
													Cancel
												</a>
                                            </div>
										</div>";
										break;
								default:
									break;
							}
						?>
					</div>
				</div> <!-- //col -->

				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<?php if ($my_course->enrollment_status == 1): ?>
						<div>
							<iframe width="100%" height="320" src="<?php echo $my_course->course_demo?>" frameborder="0" allowfullscreen></iframe>
						</div>
					<?php else: ?>
						<div style="width: 100%; 
									height: 320px; 
									background-color: #dadada; 
									">
							<img style="display: block;
									    margin-left: auto;
									    padding-top: 17%;
									    margin-right: auto;" 
									    src="<?php echo base_url('images/lock.png'); ?>" />
						</div>
					<?php endif ?>
					<div class="description">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs btn-group btn-group-justified" role="tablist">
							<li role="presentation" class="active"><a href="" data-toggle="tab" data-target="deskripsi">Description</a></li>
							<?php if ($my_course->enrollment_status == 1): ?>
								<li role="presentation"><a href="" data-toggle="tab" data-target="prerequisit">Download Exam</a></li>
								<li role="presentation"><a href="" data-toggle="tab" data-target="pemateri">Upload Answer</a></li>
							<?php endif ?>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="deskripsi">
								<p><?php echo $my_course->course_description; ?></p>
							</div> <!-- //deskripsi -->
							<div role="tabpanel" class="tab-pane" id="prerequisit">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="col-xs-12 col-sm-3 text-center exam"
											style="
												position: absolute;
											    margin: auto;
											    top: 0;
											    left: 0;
											    right: 0;
											    bottom: 0;
											    cursor: pointer">
											<img class="img-responsive" src="<?php echo base_url(); ?>images/file.png" alt="exam" />
											<div>Download exam</div>
										</div>
										<div style="display: none">
											<a target="blank" id="fileExam" href="<?php echo base_url(); ?>uploads/exam/<?php echo $exam->exam; ?>" id="exam">Text</a>
										</div>
									</div> <!-- //col -->
								</div> <!-- //row -->
							</div> <!-- //prerequisit -->
							<div role="tabpanel" class="tab-pane" id="pemateri">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<span id="answerUpload">
											<div 	<?php if ($examFile == ''): ?>
														style="
															position: absolute;
														    margin: auto;
														    top: 0;
														    left: 0;
														    right: 0;
														    bottom: 0;
														    cursor: pointer"
														class="col-xs-12 col-sm-3 text-center answer"	
													<?php else: ?>
															style="
															position: absolute;
														    margin: auto;
														    top: 0;
														    left: 0;
														    right: 0;
														    bottom: 0;"
														class="col-xs-12 col-sm-3 text-center"	
													<?php endif ?>>
													<?php if ($examFile == ''): ?>
														<img class="img-responsive" src="<?php echo base_url(); ?>images/upload.png" alt="answer" />
														<div>Upload answer</div>
													<?php else: ?>
														<img class="img-responsive" src="<?php echo base_url(); ?>images/done.png" alt="answer" />
														<div>answer successfully uploaded</div>
													<?php endif ?>
											</div>
										</span>
										<span id="answerDone" style="display: none">
											<div class="col-xs-12 col-sm-3 text-center"
												style="
													position: absolute;
												    margin: auto;
												    top: 0;
												    left: 0;
												    right: 0;
												    bottom: 0;">
												<img class="img-responsive" src="<?php echo base_url(); ?>images/done.png" alt="answer" />
												<div>answer successfully uploaded</div>
											</div>
										</span>
										<div style="display: none">
											<form id="formAnswer" method="post" action="<?php echo base_url(); ?>apps/detail/updateAnswer" enctype="multipart/form-data">
												<input type="file" name="answer">
												<input type="text" name="course_id" value="<?php echo $my_course->id ?>">
												<input type="submit">
											</form>
										</div>
									</div> <!-- //col -->
								</div> <!-- //row -->
							</div> <!-- //pemateri -->
						</div>
					</div> <!-- //description -->
				</div> <!-- //col -->
			</div> <!-- //row -->
		</div> <!-- //catalog -->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("a[data-toggle='tab']").click(function(){
			$("div[role='tabpanel']").hide();
			$("#"+$(this).attr("data-target")).show();
		});
	});

	$(document).on('click', '.exam', function(){
		$('#fileExam')[0].click();
		success("Downloaded has been successfully");
	});

	$(document).on('click', '.answer', function(){
		$('input[name="answer"]').trigger("click");
	});

	$(document).on("click", "#completion", function(){
		swal({
			title: "Are you sure?",
		    text: "You can not repeat this process again!",
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
		   		$.ajax({
		            type:'POST',
		            url: "<?php echo base_url(); ?>apps/detail/setCompletionDate/<?php echo $my_course->id ?>",
		            data: {},
		            cache:false,
		            contentType: false,
		            processData: false,
		            success:function(data){
		            	console.log(data);
		            	swal("Recorded!", "Your completion date was recorded!", "success");
				     	$('#completion').removeClass("btn-warning");
				     	$('#completion').addClass("bgm-lightgreen waves-effect");
				     	$('#completion').text("Done");
				     	$('#completion').attr("id", "recorded");
		            },
		            error: function(data){
		            	swal("Something error");
		            }
		        });
		    } else {
		      	swal("Cancelled", "", "error");
		        e.preventDefault();
		    }
		});
	});

	$(document).on('click', '#recorded', function(){
		swal("Your completion date was recorded");
	});	

	$(document).ready(function (e) {
		$(document).on('change', 'input[name="answer"]', function(){
			$('#formAnswer').submit();
		});

		$('#formAnswer').on('submit',(function(e) {
	        e.preventDefault();
	        var formData = new FormData(this);

	        $.ajax({
	            type:'POST',
	            url: $(this).attr('action'),
	            data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	                success("Uploaded file has been successful");
	                $('#answerDone').show();
	                $('#answerUpload').hide();
	                console.log(data);
	            },
	            error: function(data){
	                swal("Error when upload! Try again later");
	                console.log(data);
	            }
	        });
	    }));
	});
</script>
