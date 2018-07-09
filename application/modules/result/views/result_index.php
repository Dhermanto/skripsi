<div class="card">
	<div class="card-header ch-alt">
		<h2>Course Result</h2>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-5">
			<form method="post" action="<?php echo $search_url; ?>">
				<div class="input-group search-group">
					<input type="text" name="keyword" class="form-control" placeholder="Search User..." value="<?php echo $keyword; ?>">
					<span class="input-group-btn">
						<button class="btn bgm-lightgreen waves-effect" type="submit"><i class="zmdi zmdi-search"></i></button>
					</span>
				</div>
			</form>
		</div>
	</div>
	<div class="my-actions">
		<!-- <a href="<?php echo $addnew_url; ?>"><button type="button" class="btn btn-primary btn-sm"><i class="zmdi zmdi-plus"></i> &nbsp; Add new course</button></a> &nbsp; -->
		<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#filter-form"><i class="zmdi zmdi-filter-list"></i> &nbsp; Filter</button>

		<a href="<?php echo $excel_url."/".$param?>" class="btn bgm-green btn-sm" ><i class="zmdi zmdi-download"></i> &nbsp; Download Excel</a href="<?php echo $excel_url?>">
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
					<h4 class="modal-title">Course Filter</h4>
				</div>
				<div class="modal-body">
					<!-- <div class="form-group">
						<label for="" class="col-sm-4 control-label">Course</label>
						<div class="col-sm-7">
							<div>
								<select name="course" class="chosen">
									<option value="">All</option>
									<?php echo modules::run('lookup/filter_course', $filter['id']); ?>
								</select>
							</div>
						</div>
					</div> -->
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Course Category</label>
						<div class="col-sm-7">
							<div>
								<select name="course_category" class="chosen" id="course_category">
									<option value="">All</option>
									<?php echo modules::run('lookup/filter_course', $filter['id']); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Course</label>
						<div class="col-sm-7">
							<div>
								<select class="chosen" id="course_id" name="course_id">
									<option value="">All</option>
									
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-4 control-label">Customer</label>
						<div class="col-sm-7">
							<div>
								<select class="chosen" id="customer_triger" name="customer_id">
									<option value="">All</option>
									<?php echo modules::run('lookup/customer', $filter['id']); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-4 control-label">User</label>
						<div class="col-sm-7">
							<div>
								<select id="id_user" name="user_id" class="chosen" >
									<option value="">All</option>
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
<script type="text/javascript">
	$(document).ready(function(){

		$("#customer_triger").change(function(){
			console.log("<?php echo base_url("lookup/user_by_customer");?>/"+$(this).val());
			// alert($(this).val());
			$.ajax("<?php echo base_url("lookup/user_by_customer");?>/"+$(this).val())
			 	.done(function(data) {
			 		// $("#customer_triger").hide();
			 		// console.log(data);
			    	// alert( "success" );
			    	// alert("asdasdxxxx");
			    	$("#id_user").html("");
			    	$("#id_user").append("<option value=''>All</option>");
			    	$("#id_user").append(data);
			    	$('#id_user').chosen().trigger("chosen:updated");
			    	
			 	});
		});

		$("#course_category").change(function(){
			console.log("<?php echo base_url("lookup/course_by_category");?>/"+$(this).val());
			// alert($(this).val());
			$.ajax("<?php echo base_url("lookup/course_by_category");?>/"+$(this).val())
			 	.done(function(data) {
			 		// $("#customer_triger").hide();
			 		// console.log(data);
			    	// alert( "success" );
			    	// alert("asdasdxxxx");
			    	$("#course_id").html("");
			    	$("#course_id").append("<option value=''>All</option>");
			    	$("#course_id").append(data);
			    	$('#course_id').chosen().trigger("chosen:updated");
			  
			 	});
		});
	});
</script>
