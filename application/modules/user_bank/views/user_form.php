<div class="card">
	<div class="card-header ch-alt">
		<h2>User Form</h2>
	</div>
	
	<div class="card-body card-padding-sm">
		<form class="form-horizontal" role="form" method="post" action="<?php echo $action_url; ?>">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">User Name</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="user_name" class="form-control required" value="<?php echo $data->user_name; ?>">
							<span class="text-danger"><?php echo form_error("user_name");?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">User ID</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="user_wizlearn_id" class="form-control required" value="<?php echo $data->user_wizlearn_id; ?>" <?php echo $data->user_wizlearn_id != '' ? 'readonly' : ''; ?> >
							<span class="text-danger"><?php echo form_error("user_wizlearn_id");?></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Password</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="user_password" class="form-control <?php if ($id == '') echo 'required'; ?>" <?php if ($id != '') echo 'placeholder="Leave blank if you don\'t change the password"' ?> >
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">User Group</label>
					<div class="col-sm-8">
						<div class="fg-line">
								<select name="user_group" class="chosen required" data-placeholder="Pilih Level">
									<?php
										if($data->user_group == 'admin')
										{
											echo "
											<option value=\"admin\" selected>Admin</option>
											<option value=\"admin_bank\" selected>Admin Customer</option>
											<option value=\"customer\">Customer</option>
											";
										}
										else if($data->user_group == '')
										{
											echo "
											<option value=\"\">Choose User Group</option>
											<option value=\"admin\">Admin</option>
											<option value=\"admin_bank\">Admin Customer</option>
											<option value=\"customer\">Customer</option>";
										}
										else if($data->user_group == 'admin_bank')
										{
											echo "
											<option value=\"admin_bank\">Admin Customer</option>
											<option value=\"admin\">Admin</option>
											<option value=\"customer\">Customer</option>";
										}
										else
										{
											echo "
											<option value=\"admin\">Admin</option>
											<option value=\"admin_bank\">Admin Customer</option>
											<option value=\"customer\" selected>Customer</option>";
										}
									?>
								</select>
						</div>
					</div>
				</div>
								<div class="form-group" id='customer_id'>
									<label for="" class="col-sm-4 control-label"></label>
									<div class="col-sm-8">
										<div class="fg-line">
											<select name="customer_id" class="chosen" data-placeholder="Choose Customer...">
												<option value=""></option>
												<?php echo modules::run('lookup/customer', $data->customer_id); ?>
											</select>
										</div>
									</div>
								</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Email</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="email" name="user_email" class="form-control required" value="<?php echo $data->user_email; ?>">
						</div>
					</div>
				</div><p id="demo"></p>
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

<script>
	function tampil() {
		var admin = $('[name=user_group]').val();
		if (admin == 'admin' || admin == 'admin_bank') {
			$('#customer_id').hide();
		}
		else {
			$('#customer_id').show();
		}
	}

	$(document).ready(function(){
		$('#customer_id').hide();
		$('[name=user_group]').change(tampil);
	});
</script>
