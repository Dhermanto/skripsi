<?php
	$count = 0;
	$date = date("Y-m-d H:i:s");
	$array_dua   = array(0);
	$array_tiga  = array(0);

	foreach ($cek_date as $key => $cek) {
		@$array_dua[] 	= $cek['course_id'];
		@$array_tiga[] 	= $cek['course_closed_date'];
	}
?>
<!-- Page Content -->
<div id="page-content-wrapper">
	<div class="container-fluid">
		<!-- <div class="line-behind-left"><span><b>Bookmarked</b></span></div> -->

		<div class="catalog">
			<div class="row is-flex">

					<?php
                        if (!empty($bookmarked)) {
						foreach ($bookmarked as $key => $value) {
					?>
						<div class="col-xs-12 col-sm-8 col-md-4 col-lg-3">
							<div class="item">
								<div class="thumbnail">
									<a href="<?php echo site_url("apps/detail/course_detail/" .$value['course_id']. "/" . $value['id_user_course'] . "" ); ?>" class="images block" style="background-image:url('<?php echo base_url()?>uploads/catalogs/<?php echo $value['course_image']; ?>')">
									</a> <!-- //images -->
									<div class="caption">
										<h3>
											<a href=" <?php echo site_url("apps/detail/course_detail/". $value['course_id']. "/" . $value['id_user_course'] . "");?> " class="block">
												<b id='judul'><?php echo $value['course_title']; ?></b>
											</a>
										</h3> <!-- //title -->

										<div class="price text-danger">
											<h3 class="no-margin">
												<b id='credit'>
													<?php echo $value['credit_point'] ?>
												</b> Credit Points
											</h3>
										</div>

										<div class="detail">
											<?php
											if (in_array($value['course_id'], @$array_dua)) {
												$jumlah = array_search($value['course_closed_date'], @$array_tiga);
												echo '<div class="col-md-12">
                                                    <a href="'. site_url("apps/detail/course_detail/" . $value['course_id']."/" . $value['id_user_course'] . "") .'" class="btn btn-success btn-sm btn-block">VIEW COURSE</a>
                                                </div>';
											}
											else {
											?>
											<div class="action">
												<div class="row">
                                                    <div class="col-md-6">
                                                        <a href="<?php echo base_url();?>apps/katalog/course_out/enroll/<?php echo $value['id_user_course'];?>"
                                                        onclick="
                                                        window.onload('<?php echo base_url();?>apps/bookmarked');" class="btn btn-primary btn-sm btn-block enroll">ENROLL</a>
                                                    </div>
													<div class="col-md-6">
                                                        <a id='daftar'href="<?php echo base_url();?>apps/katalog/course_out/cancel/<?php echo $value['id_user_course'];?>" class="btn btn-danger btn-sm btn-block">
        													Cancel
        												</a>
                                                    </div>
												</div>
											</div>
											<?php
												}
											?>
										</div> <!-- //detail -->
									</div> <!-- //meta -->
								</div> <!-- //content -->
							</div> <!-- //item -->
						</div> <!-- //col -->
					<?php
							}
                        }
                        else {
                    ?>
                    
                    <?php
                        }
					?>
			</div> <!-- //row -->
		</div> <!-- //catalog -->
	</div>
</div>
