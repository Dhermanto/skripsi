<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="card-body card-padding-sm">
			<form class="form-horizontal" role="form" enctype="multipart/form-data" method="post" action="<?php echo $action_url; ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="form-group">
							<label for="" class="col-sm-12 control-label" style="text-align: left">
								<div class="card-header ch-alt">
									<h2>Position Form</h2>
								</div>
							</label>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Position name</label>
							<div class="col-sm-9 changeSize">
								<div class="fg-line">
									<input type="text" name="position_name" class="form-control required" value="<?php echo @$data[0]->position_name; ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Course Management</label>
							<div class="col-sm-9 changeSize">
								<div class="fg-line">
									<?php 
										$course = $this->load->model('course/course_model');
										if (isset($data[0]->course_id)) {
											$courseData = array();
											$courseExam = array();
											foreach ($data as $key => $value) {
												array_push($courseData, $value->course_id);
												array_push($courseExam, $value->exam);
											}
										}
									?>
									<?php foreach ($category->result() as $key => $value): ?>
										<button type="button" 
												class="course-category bgm-lightgreen waves-effect btn-lg" 
												data-id-category="<?php echo $value->id ?>" 
												style="width: 100%; background-color: rgb(96, 134, 178); color: #fff; border: 1px solid #fff;">
												<?php echo $value->category_name; ?>
										</button>
										<?php $courseCategory = $course->byCategory($value->id); ?>
										<div class="row tab-not-active <?php echo $value->id ?>" style=" margin: 5px 0px 5px 0px; 
													border: 1px #cac4c4 solid;
													border-radius: 5px;
													padding: 5px;">
											<!-- <div class="col-md-6">
												<input type="checkbox" class="_all" value="<?php echo $value->id ?>" id="<?php echo $value->id ?>">
												<label class="form-check-label" for="<?php echo $value->id ?>">All</label>
											</div> -->
											<div class="col-md-6" style="margin-bottom: 10px"></div>
											<div class="clearfix"></div>
											<?php foreach ($courseCategory->result() as $index => $hasil): ?>
												<div class="col-md-6">
													<input type="checkbox" 
														<?php if (isset($data[0]->course_id)): ?>
															<?php if (in_array($hasil->id, $courseData)): ?>
																checked
															<?php endif ?>
														<?php endif ?>
													class="form-check-input category-<?php echo $value->id ?>" name="courses[]" id="<?php echo $hasil->id ?>" value="<?php echo $hasil->id ?>">
													<label class="form-check-label" for="<?php echo $hasil->id ?>"><?php echo $hasil->course_title ?></label>
												</div>
												<div class="col-md-6">
													<div style="display: none; margin-bottom: 10px" id="exam-<?php echo $hasil->id ?>">
														<button class="btn btn-success btn-sm inputExam" type="button">
														<?php if (!isset($data[0]->course_id)): ?>
															Upload exam
														<?php else: ?>
															Change exam?
														<?php endif ?>
														</button>
														<span style="padding: 10px">
															<?php if (isset($data[0]->course_id)): ?>
																<?php foreach ($data as $key => $value): ?>
																	<?php if ($value->course_id == $hasil->id): ?>
																		<a target="blank" href="<?php echo base_url(); ?>uploads/exam/<?php echo $value->exam ?>">FILE</a>
																	<?php endif ?>
																<?php endforeach ?>
															<?php endif ?>
														</span>
														<input type="file" name="exam[<?php echo $hasil->id ?>]" id="examInput-<?php echo $hasil->id ?> value="" style="display: none">
													</div>
												</div>
												<div class="clearfix"></div>
											<?php endforeach ?>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-10">
								<div class="fg-line">
									<button type="submit" class="btn bgm-lightgreen waves-effect">Save Data</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.course-category').click(function(){
		var idData 	   = $(this).data('id-category');
		var checkClass = $('.' + idData).hasClass('tab-not-active');
		if (checkClass) {
			$('.' + idData).removeClass('tab-not-active');
			$('.' + idData).addClass('tab-active');
		}
		else {
			$('.' + idData).addClass('tab-not-active');
			$('.' + idData).removeClass('tab-active');	
		}
	});

	$('._all').click(function(){
		var hasil 	  = $(this).val();
		var checkAttr = ($(this).is(':checked'));
		if (checkAttr) {
			$('.category-' + hasil).prop('checked', true);
		}
		else {
			$('.category-' + hasil).removeAttr('checked');	
		}
	});

	$('.form-check-input').click(function(){
		var idData = $(this).val();
		var checkAttr = ($(this).is(':checked'));
		if (checkAttr) {
			$('#exam-' + idData).show();
		}
		else {
			$('#examInput-' + idData).val("");
			$('#exam-' + idData).hide();
		}
	});

	$('.form-check-input').each(function(){
		var idData = $(this).val();
		var checkAttr = ($(this).is(':checked'));
		if (checkAttr) {
			$('#exam-' + idData).show();
		}
		else {
			$('#exam-' + idData).hide();
		}
	});

	$(document).on('click', '.inputExam', function(){
		var input    = $(this).parent().find('input');
		input.trigger('click');
	});

	$(document).on('change', 'input[type=file]', function() {
		var filename = $(this).val().split('\\').pop();
		var span  = $(this).parent().find("span");
		span.html("Filename : " + filename);
	});
});
</script>
