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
		<a href="<?php echo $excel_url."/".$param ?>" class="btn bgm-green btn-sm" ><i class="zmdi zmdi-download"></i> &nbsp; Download Excel</a href="<?php echo $excel_url?>">
	</div>
	<div class="card-body for-table">
		<?php echo $grid; ?>
		<?php echo $pagelink; ?>
	</div>
</div>
