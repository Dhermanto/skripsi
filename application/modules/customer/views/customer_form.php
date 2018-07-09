<div class="card">
	<div class="card-header ch-alt">
		<h2>Customer Form</h2>
	</div>
	<div class="card-body card-padding-sm">
		<form enctype="multipart/form-data" class="form-horizontal" role="form" method="post" action="<?php echo $action_url; ?>" runat="server">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Customer Name</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="customer_name" class="form-control required" value="<?php echo $data->customer_name; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Address</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<textarea name="customer_address" rows="8" cols="40" class="form-control"><?php echo $data->customer_address; ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Phone</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="customer_phone" class="form-control" value="<?php echo $data->customer_phone; ?>">
						</div>
					</div>
				</div>
				<!-- <div class="form-group">
					<label for="" class="col-sm-4 control-label">Fax</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="customer_fax" class="form-control" value="<?php echo $data->customer_fax; ?>">
						</div>
					</div>
				</div> -->
				<div class="form-group">
					<label for="" class="col-sm-4 control-label" class="form-control">Email</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="email" name="customer_email" class="form-control" value="<?php echo $data->customer_email; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Website</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="customer_website" class="form-control" value="<?php echo $data->customer_website; ?>">
						</div>
					</div>
				</div>


				<?php

				if ($data->customer_logo === '')
					{
						echo "
							<div class=\"form-group\" id=\"image\" style=\"display: none\">
						";
					}
				else{
						echo "
						<div class=\"form-group\"> ";
					}
				?>

				<label for="" class="col-sm-4 control-label"></label>
					<div class="col-sm-8">
						<div class="fg-line">
							<img id="logo" src="<?php echo base_url('uploads/'. $data->customer_logo)?>" width="200" />
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Logo</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="file" id="imgInp" name="customer_logo" class="form-control" value="<?php echo $data->customer_logo; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"></label>
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
<script type="text/javascript">
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
		$("#image").css("display", "block");
		readURL(this);
	});
</script>
