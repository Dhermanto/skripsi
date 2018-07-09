<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="setting">
			<form class="form-horizontal" method="post" action="<?php echo $action; ?>/">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-md-9 col-lg-7">
						<br>
						<div class="form-group">
							<label for="password" class="col-sm-4 control-label">Your Password</label>
							<div class="col-sm-8">
								<input type="password" name="pwd_old" required class="form-control" id="password" value="">
							</div>
						</div>

						<div class="form-group">
							<label for="password-r" class="col-sm-4 control-label">New Password</label>
							<div class="col-sm-8">
								<input type="password" name="pwd_new" required class="form-control" id="password-r" value="">
							</div>
						</div>

						<div class="form-group">
							<label for="password-rp" class="col-sm-4 control-label">Repeat Password</label>
							<div class="col-sm-8">
								<input type="password" name="rpt_pwd" required class="form-control" id="password-r" value="">
							</div>
						</div>

						<!-- <div class="form-group">
							<label for="photo" class="col-sm-4 control-label">Photo Profile</label>
							<div class="col-sm-8">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
										<img data-src="holder.js/100%x100%">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
								<div>
									<span class="btn btn-default btn-file"><span class="fileinput-new">Choose Photo</span><span class="fileinput-exists">Change</span><input type="file" name="Photo"></span>
								</div>
							</div>
						</div> -->

						<div class="form-group">
							<label class="col-sm-4 control-label"></label>
							<div class="col-sm-8">
								<br />
								<button type="submit" name="submit" class="btn btn-lg btn-blue">Save Change</button>
							</div>
						</div>
						<div class="form-group">
							<label for="password-rp" class="col-sm-4 control-label"></label>
							<div class="col-sm-8">
								<?php echo $this->session->flashdata('pwd_status'); ?>
							</div>
						</div>
					</div> <!-- //col -->
				</div> <!-- //row -->
			</form>
		</div> <!-- //setting -->
	</div>
</div>
