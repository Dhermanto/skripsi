<?php 
	$userCourse = array();
	$userCourseEnrolled = array();
	$userCourseClosed   = array();
	$date 				= date("Y-m-d H:i:s");
	foreach ($course_id as $key => $course) {
		$userCourse[] = $course['course_id'];
	}

	foreach ($cek_date as $key => $cek) {
		$userCourseEnrolled[] = $cek['course_id'];
		$userCourseClosed[]   = $cek['course_closed_date'];
	}

	$credit = $this->db->query("SELECT *, IFNULL(SUM(credit_point), 0) AS credit FROM user_journals WHERE user_id = $user_id")->row()->credit;
?>
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div style="margin-bottom: 30px;">
			<form class="form-inline">
			  	<div class="form-group">
			    	<label  for="exampleInputEmail3">Category : </label>
			    	<select class="form-control" id="category_triggerer">
				    	<?php foreach( $category->result_array() as $x => $v ) : ?>
				    		<option value="<?php echo $v['id']?>"> <?php echo $v['category_name']?> </option>
				    	<?php endforeach;?>
			    	</select>
			  	</div>
			</form>
		</div>
		<div class="catalog">
			<?php foreach ( $category->result_array() as $key => $value ): ?>
				<div class="row is-flex">
					<?php foreach ( $course_category->result_array() as $index => $result ): ?>
						<?php if ( $result['course_category'] === $value['id'] ): ?>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 cat cat<?php echo $result['id_category']?>" style="display: none">
								<div class="item">
									<div class="thumbnail">
										<a  href="<?php echo site_url("apps/detail/course_detail/" . $result['id_course'] . ""); ?>" 
											class="images block" 
											style="background-image:url('<?php echo base_url()?>uploads/catalogs/<?php echo $result['course_image']; ?>')">
										</a> <!-- //images -->
										<div class="caption">
											<h3>
												<a href=" <?php echo site_url("apps/detail/course_detail/" . $result['id_course'] . "");?> " class="block">
													<b id='judul'><?php echo $result['course_title']; ?></b>
												</a>
											</h3> <!-- //title -->

											<div class="price text-danger">
												<h3 class="no-margin"><b id='credit'><?php echo $result['credit_point'] ?></b> Credit Points</h3>
											</div>

											<div class="detail">
												<div class="row">
													<div class="col-xs-9">
													</div> <!-- //col -->
													<div class="col-xs-9">
													</div> <!-- //col -->
												</div> <!-- //row -->
												<div class="action">
													<?php if ((!$credit) || $credit < $result['credit_point']): ?>
														<button disabled="" class="btn btn-default btn-sm btn-block">Your point is not enought</button>
													<?php else: ?>
													 	<a id='daftar' 
													 		href="<?php echo base_url();?>apps/katalog/course_in/<?php echo $result['id_course'];?>"
													 		<?php if ( in_array($result['id_course'], $userCourse) ): ?>
													 			style = "pointer-events: none; cursor: default"
													 			class = "btn btn-warning btn-sm btn-block"
													 			<?php 
													 				$label = "Bookmarked";
													 			?>
													 		<?php elseif ( in_array($result['id_course'], $userCourseEnrolled) ): ?>
													 			<?php 
													 				$jumlah = array_search( $result['course_closed_date'], $userCourseClosed );
													 			?>
													 			<?php if ( $date < $userCourseClosed[$jumlah] ): ?>
													 				<?php 
													 					$label = "Enrolled";
													 				?>
													 				style = "pointer-events: none; cursor: default"
													 				class = "btn btn-success btn-sm btn-block enrolled"
													 			<?php else: ?>
													 				<?php 
													 					$label = "Bookmark";
													 				?>
													 			<?php endif ?>
													 		<?php else: ?>
													 				<?php 
													 					$label = "Bookmark";
													 				?>
													 		<?php endif ?>
													 	class="btn btn-primary btn-sm btn-block bookmark">
															<?php echo $label; ?>
													 	</a>
												 	<?php endif ?>
												</div>
											</div> <!-- //detail -->
										</div> <!-- //meta -->
									</div> <!-- //content -->
								</div> <!-- //item -->
							</div> <!-- //col -->
						<?php endif ?>
					<?php endforeach ?>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		setVisible($("#category_triggerer").val());
		$("#category_triggerer").change(function(){
			setVisible($(this).val());
		});

		function setVisible(category){
			$(".cat").hide();
			$(".cat" + category).show();
		}
	});
</script>
