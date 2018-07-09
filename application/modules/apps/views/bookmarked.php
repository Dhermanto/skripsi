<?php
	$count = 0;
	$date = date("Y-m-d H:i:s");
	$userCourseEnrolled = array();
	$userCourseClosed   = array();

	foreach ($cek_date as $key => $cek) {
		$userCourseEnrolled[] = $cek['course_id'];
		$userCourseClosed[]   = $cek['course_closed_date'];
	}
?>
<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="catalog">
			<div class="row is-flex">
				<?php if ( !empty( $bookmarked ) ): ?>
					<?php foreach ( $bookmarked as $key => $value ): ?>
						<div class="col-xs-12 col-sm-8 col-md-4 col-lg-3">
							<div class="item">
								<div class="thumbnail">
									<a href="<?php echo site_url("apps/detail/course_detail/" . $value['course_id'] . "/" . $value['id_user_course'] . "" ); ?>" class="images block" 
										style="background-image:url('<?php echo base_url()?>uploads/catalogs/<?php echo $value['course_image']; ?>')">
									</a>
									<div class="caption">
										<h3>
											<a href=" <?php echo site_url("apps/detail/course_detail/" . $value['course_id'] . "/" . $value['id_user_course'] . "");?> " class="block">
												<b id='judul'><?php echo $value['course_title']; ?></b>
											</a>
										</h3>
										<div class="price text-danger">
											<h3 class="no-margin">
												<b id='credit'>
													<?php echo $value['credit_point'] ?>
												</b> Credit Points
											</h3>
										</div>
										<div class="detail">
											<?php if ( in_array( $value['course_id'], $userCourseEnrolled )): ?>
												<?php 
													$jumlah = array_search( $value['course_closed_date'], $userCourseClosed );
												?>
												<div class="col-md-12">
                                                    <a href="<?php echo site_url("apps/detail/course_detail/" . $value['course_id'] . "/" . $value['id_user_course'] . ""); ?>" class="btn btn-success btn-sm btn-block">VIEW COURSE</a>
                                                </div>
                                            <?php else: ?>
                                            	<div class="action">
													<div class="row">
	                                                    <div class="col-md-6">
	                                                        <a href="#"
	                                                        data-href="<?php echo base_url();?>apps/katalog/course_out/enroll/<?php echo $value['id_user_course'];?>"
	                                                        onclick="window.onload('<?php echo base_url();?>apps/bookmarked');" 
	                                                        class="btn btn-primary btn-sm btn-block enroll">ENROLL</a>
	                                                    </div>
														<div class="col-md-6">
	                                                        <a id='daftar' href="<?php echo base_url();?>apps/katalog/course_out/cancel/<?php echo $value['id_user_course'];?>" class="btn btn-danger btn-sm btn-block">
	        													Cancel
	        												</a>
	                                                    </div>
													</div>
												</div>
											<?php endif ?>
										</div> <!-- //detail -->
									</div> <!-- //meta -->
								</div> <!-- //content -->
							</div> <!-- //item -->
						</div> <!-- //col -->
					<?php endforeach ?>
				<?php else: ?>
					<div class="col-xs-12">
                        <div class="alert alert-warning">
                            No bookmarked course yet.
                        </div>
                    </div> <!-- //col -->
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
