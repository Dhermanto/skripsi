<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="card-body card-padding-sm">
			<form class="form-horizontal" role="form" method="post" action="<?php echo $action_url; ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-md-9 col-lg-7">
						<div class="form-group">
							<label for="" class="col-sm-4 control-label">
								<div class="card-header ch-alt">
									<h2>User Form</h2>
								</div>
							</label>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-4 control-label">User Name</label>
							<div class="col-sm-8">
								<input type="text" name="user_name" class="form-control required" value="<?php echo $data->user_name; ?>">
								<span class="text-danger"><?php echo form_error("user_name");?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-4 control-label">User ID</label>
							<div class="col-sm-8">
								<input type="text" name="user_wizlearn_id" class="form-control required" value="<?php echo $data->user_wizlearn_id; ?>" <?php echo $data->user_wizlearn_id != '' ? 'readonly' : ''; ?> >
								<span class="text-danger"><?php echo form_error("user_wizlearn_id");?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-4 control-label">Position</label>
							<div class="col-sm-8">
								<select class="form-control" name="position">
									<option>Choose Position</option>
									<?php foreach ($position->result() as $key => $value): ?>
									<option 
										<?php if (isset($data->position)): ?>
											<?php echo ($data->position == $value->id) ? "selected" : "" ?> 
										<?php endif ?>
									value="<?php echo $value->id ?>"><?php echo $value->position_name ?></option>
									<?php endforeach ?>
									<span class="text-danger"><?php echo form_error("position");?></span>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-4 control-label">Password</label>
							<div class="col-sm-8">
								<input type="text" name="user_password" class="form-control <?php if ($id == '') echo 'required'; ?>" <?php if ($id != '') echo 'placeholder="Leave blank if you don\'t change the password"' ?> >
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-4 control-label">Email</label>
							<div class="col-sm-8">
								<input type="email" name="user_email" class="form-control required" value="<?php echo $data->user_email; ?>">
							</div>
						</div>
						<p id="demo"></p>
						<div class="form-group">
							<label for="" class="col-sm-4 control-label"></label>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-lg btn-blue">Save Data</button>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
