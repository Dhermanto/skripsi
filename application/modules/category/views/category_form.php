<div class="card">
	<div class="card-header ch-alt">
		<h2>Category Form</h2>
	</div>
	<div class="card-body card-padding-sm">
		<form class="form-horizontal" role="form" method="post" action="<?php echo $action_url; ?>">
			<div class="col-md-12">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Category name</label>
					<div class="col-sm-4">
						<div class="fg-line">
							<input type="text" name="category_name" class="form-control required" value="<?php echo @$data->category_name; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Content</label>
					<div class="col-sm-10">
						<div class="fg-line">
							<textarea type="text" id="editor1" name="content" class="form-control"><?php echo @$data->content; ?></textarea>
						</div>
					</div>
				</div>
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
	$(function () {
	    CKEDITOR.replace('editor1');
	});
</script>
