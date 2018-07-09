<div class="card">
	<div class="card-header ch-alt">
		<h2>Course Form</h2>
	</div>
	<div class="card-body card-padding-sm">
		<form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="<?php echo $action_url; ?>">
			<input type="hidden" name="course_wizlearn_id" value="<?php echo $data->course_wizlearn_id == '' ? '0' : $data->course_wizlearn_id; ?>">
			<input type="hidden" name="redirect" value="<?php echo $this->agent->referrer(); ?>">
			<div class="col-md-12">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Course title</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="course_title" class="form-control required" value="<?php echo $data->course_title; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Category</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<select name="course_category" class="chosen required" data-placeholder="Choose Category...">
								<option value="">Choose category...</option>
								<?php echo modules::run('lookup/category', $data->course_category); ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">URL</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="course_demo" class="form-control" value="<?php echo $data->course_demo; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Description</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<textarea type="text" id="editor1" name="course_description" class="form-control"><?php echo $data->course_description; ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Credit points</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="credit_point" class="form-control" value="<?php echo $data->credit_point; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Active duration (days)</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="active_duration" class="form-control number" value="<?php echo $data->active_duration; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Course status</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<select name="course_status" class="chosen required" data-placeholder="Pilih Status">
								<?php
									if($data->course_status == 1)
									{
										echo "
										<option value=\"1\" selected>ACTIVE</option>
										<option value=\"0\">INACTIVE</option>";
									}
									else if($data->course_status == '')
									{
										echo "
										<option value=\"1\">ACTIVE</option>
										<option value=\"0\">INACTIVE</option>";
									}
									else
									{
										echo "
										<option value=\"1\">ACTIVE</option>
										<option value=\"0\" selected>INACTIVE</option>";
									}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"></label>
					<div class="col-sm-6">
						<div class="fg-line">
							<?php if($data->course_image) : ?>
								<img id="logo" src="<?php echo base_url('uploads/catalogs/'. $data->course_image)?>" class="form-control" style="height:auto;" />
							<?php else : ?>
								<img id="logo" src="<?php echo base_url('uploads/catalogs/no-image.png')?>" class="form-control" style="height:auto;" />
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Image</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="file" id="imgInp" name="course_image" class="form-control" value="<?php echo $data->course_image; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"></label>
					<div class="col-sm-8">
						<div class="fg-line">
							<button type="submit" class="btn bgm-lightgreen waves-effect">Save Data</button>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</form>
	</div>
</div>
<script>
	$('[type="submit"]').click(function(){
		var course_title = $('[name="course_title"]').val();
		var category = $('[name="course_category"]').val();
		if (course_title.length < 10) {
			swal("Course title must 10 character or more !");
			return false;
		}
		else {
			return true;
		}		

		return false;
	});

	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#logo').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#imgInp").change(function(){
	    readURL(this);
	});

	$(function () {
    	CKEDITOR.replace('editor1');
  	});
</script>
