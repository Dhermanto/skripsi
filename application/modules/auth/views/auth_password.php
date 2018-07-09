<div class="card" id="profile-main">
	<div class="pm-overview c-overflow">
		<div class="pmo-pic">
			<div class="p-relative">

			</div>
		</div>
	</div>
	<div class="pm-body clearfix">
		<div class="pmb-block">
			<div class="pmbb-header">
				<h2><i class="zmdi zmdi-key m-r-5"></i>Change Password</h2>
			</div>
			<div class="pmbb-body p-l-30">
				<form class="form-horizontal" method="post" action="<?php echo $action_url; ?>">
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Old Password</label>
						<div class="col-sm-8">
							<div class="fg-line">
								<input type="password" class="form-control required" name="pwd_old">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">New Password</label>
						<div class="col-sm-8">
							<div class="fg-line">
								<input type="password" class="form-control required" name="pwd_new">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Retype Password</label>
						<div class="col-sm-8">
							<div class="fg-line">
								<input type="password" class="form-control required" name="pwd_retype">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-8">
							<div class="fg-line">
								<button type="submit" class="btn bgm-lightgreen waves-effect">Save Password</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
$().ready(function() {
	$('form').submit(function() {
		var pwd_old = $('[name=pwd_old]').val();
		var pwd_new = $('[name=pwd_new]').val();
		var pwd_retype = $('[name=pwd_retype]').val();

		if (pwd_new != pwd_retype) {
			alert('Password yang diketik ulang tidak sama!');
			$(this).find('.form-control').attr('readonly', false);
			return false;
		}

		return true;
	});
});
</script>

<?php if ($this->session->flashdata('pwd_status') == 'ok'): ?>
<script>success('Password berhasil disimpan.');</script>
<?php endif; ?>
