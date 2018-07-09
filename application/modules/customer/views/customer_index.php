<div class="card">
	<div class="card-header ch-alt">
		<h2>Customers</h2>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-5">
			<form method="post" action="<?php echo $search_url; ?>">
				<div class="input-group search-group">
					<input type="text" name="keyword" class="form-control" placeholder="Search customer name..." value="<?php echo $keyword; ?>">
					<span class="input-group-btn">
						<button class="btn bgm-lightgreen waves-effect" type="submit"><i class="zmdi zmdi-search"></i></button>
					</span>
				</div>
			</form>
		</div>
	</div>
	
	<?php $user_group = $this->session->userdata('pengguna')->user_group; ?>

	<?php if ($user_group != 'admin_bank'): ?>
		<div class="my-actions">
			<a href="<?php echo $addnew_url; ?>"><button type="button" class="btn btn-primary btn-sm"><i class="zmdi zmdi-plus"></i> &nbsp; Add New Costumer</button></a> &nbsp;
			<!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#filter-form"><i class="zmdi zmdi-filter-list"></i> &nbsp; Saring Data</button> -->
		</div>
	<?php endif ?>
	<div class="card-body for-table">
		<?php echo $grid; ?>
		<?php echo $pagelink; ?>
	</div>
</div>
<?php 
	$message = $this->session->flashdata('success');
?>

<?php if ($message): ?>
<script>	
$(document).ready(function(){
	success("<?php echo $message; ?>");
	// sweetAlertInitialize();
});
</script>
<?php endif ?>
