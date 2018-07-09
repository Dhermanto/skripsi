<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-5">
				<form method="post" action="<?php echo $search_url; ?>">
					<div class="input-group search-group">
						<input type="text" name="keyword" class="form-control" placeholder="Search course title" value="<?php echo $keyword; ?>">
						<span class="input-group-btn">
							<button class="btn bgm-lightgreen waves-effect" type="submit"><i class="glyphicon glyphicon-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
		<div class="row" style="margin: 20px 0;">
			<div class="col-xs-12 col-sm-5">
				<a href="<?php echo $excel_url?>" class="btn btn-success btn-sm" type="submit"><i class="glyphicon glyphicon-arrow-down"></i> &nbsp; Download Excel</a>
			</div>
		</div>
		<div class="card-body for-table">
			<?php echo $grid; ?>
			<?php echo $pagelink; ?>
		</div>
		
	</div>
</div>
