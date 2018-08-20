<div class="card">
	<div class="card-header ch-alt">
		<h2>Users</h2>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-5">
			<form method="post" action="<?php echo $search_url; ?>">
				<div class="input-group search-group">
					<input type="text" name="keyword" class="form-control" placeholder="Search user name" value="<?php echo $keyword; ?>">
					<span class="input-group-btn">
						<button class="btn bgm-lightgreen waves-effect" type="submit"><i class="zmdi zmdi-search"></i></button>
					</span>
				</div>
			</form>
		</div>
	</div>
	<div class="my-actions">
		<a href="<?php echo $addnew_url; ?>"><button type="button" class="btn btn-primary btn-sm"><i class="zmdi zmdi-plus"></i> &nbsp; Add New User</button></a> &nbsp;
		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#filter-form"><i class="zmdi zmdi-filter-list"></i> &nbsp; Filter</button>
	</div>
	<div class="card-body for-table">
		<?php echo $grid; ?>
		<?php echo $pagelink; ?>
	</div>
</div>

<div id="filter-form" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="<?php echo $filter_url; ?>" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">User Filter</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">User Group</label>
						<div class="col-sm-7">
							<div>
								<select name="user_group" class="chosen">
									<option value="">All</option>
									<!-- <?php echo modules::run('lookup/group_user', $filter['id']); ?> -->
									<option value="admin">Admin</option>
									<!-- <option value="customer">Customer</option> -->
									<option value="admin_bank">Admin customer</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-sm">Show</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
				</div>
			</form>
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
