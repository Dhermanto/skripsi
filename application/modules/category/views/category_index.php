<div class="card">
	<div class="card-header ch-alt">
		<h2>Course Categories</h2>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-5">
			<form method="post" action="<?php echo $search_url; ?>">
				<div class="input-group search-group">
					<input type="text" name="keyword" class="form-control" placeholder="Search category name" value="<?php echo $keyword; ?>">
					<span class="input-group-btn">
						<button class="btn bgm-lightgreen waves-effect" type="submit"><i class="zmdi zmdi-search"></i></button>
					</span>
				</div>
			</form>
		</div>
	</div>
	<div class="my-actions">
		<a href="<?php echo $addnew_url; ?>"><button type="button" class="btn btn-primary btn-sm"><i class="zmdi zmdi-plus"></i> &nbsp; Add new category</button></a> &nbsp;
		<!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#filter-form"><i class="zmdi zmdi-filter-list"></i> &nbsp; Saring Data</button> -->
	</div>
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
