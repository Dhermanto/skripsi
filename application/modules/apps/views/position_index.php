<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="card-header ch-alt">
			<h2>Position Management</h2>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-5">
				<form method="post" action="<?php echo $search_url; ?>">
					<div class="input-group search-group">
						<input type="text" name="keyword" class="form-control" placeholder="Search position" value="<?php echo $keyword; ?>">
						<span class="input-group-btn">
							<button class="btn bgm-lightgreen waves-effect" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
		<div class="row" style="margin: 20px 0;">
			<a href="<?php echo $addnew_url; ?>"><button type="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add New Position</button></a> &nbsp;
		</div>
		<div class="card-body for-table">
			<?php echo $grid; ?>
			<?php echo $pagelink; ?>
		</div>
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
