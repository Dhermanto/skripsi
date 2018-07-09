<div class="card">
	<div class="card-header ch-alt">
		<h2>Content Form</h2>
	</div>
	
	<div class="card-body card-padding-sm">
		<form class="form-horizontal" role="form" method="post" action="<?php echo $action_url; ?>">
			<div class="col-md-12">
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Category</label>
					<div class="col-sm-4">
						<div class="fg-line">
								<select name="id_category" class="chosen required" data-placeholder="Pilih Level">
									<option value="">Chose category</option>
									<?php echo modules::run('lookup/category', $filter['id_category']); ?>
								</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Content</label>
					<div class="col-sm-10">
						<div class="fg-line">
							<textarea type="text" id="editor1" name="content" class="form-control required">
							</textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"></label>
					<div class="col-sm-4">
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