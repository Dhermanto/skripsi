<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="box-user-meta table-block">
					<div class="cell media-middle">
						<i class="icon ic-account-box"></i>
					</div>

					<div class="cell media-middle">
						<span class="block title">User Name</span>
						<span class="block desc"><b><?php echo $nama; ?></b></span>
					</div>
				</div>
			</div> <!-- //col -->
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="box-user-meta table-block">
					<div class="cell media-middle">
						<i class="icon ic-today"></i>
					</div>

					<div class="cell media-middle">
						<span class="block title">Bookmarked course</span>
						<span class="block desc"><b><?php echo $keranjang; ?></b></span>
					</div>
				</div>
			</div> <!-- //col -->
				
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="box-user-meta table-block">
					<div class="cell media-middle">
						<i class="icon ic-switch-camera"></i>
					</div>

					<div class="cell media-middle">
						<span class="block title">Credit point</span>
						<span class="block desc"><b><?php echo $credit ?></b></span>
					</div>
				</div>
			</div> <!-- //col -->

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="box-user-meta table-block">
					<div class="cell media-middle">
						<i class="icon ic-sync-disabled"></i>
					</div>

					<div class="cell media-middle">
						<span class="block title">Expired Date Point</span>
						<span class="block desc"><b><?php echo $exp; ?></b></span>
					</div>
				</div>
			</div> <!-- //col -->
		</div> <!-- //row -->

		<div class="line-behind-left"><span><b>My Courses</b></span></div>

		<div class="catalog">
			<div class="row is-flex">
				<?php foreach ($data_home as $key => $value): ?>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
					<div class="item">
						<div class="thumbnail">
							<a href="<?php echo site_url("apps/detail/course_detail/" .$value->course_id. ""); ?>" class="images block" style="background-image:url('<?php echo base_url()?>uploads/catalogs/<?php echo $value->course_image; ?>')">
							</a> 
							<div class="caption">
								<h3>
									<a href="<?php echo site_url("apps/detail/course_detail/" .$value->course_id. ""); ?>" class="block">
										<b><?php echo $value->course_title; ?></b>
									</a>
								</h3>
								<div class="detail">
									<div class="col-md-12">
										<a href="<?php echo site_url() ?>apps/detail/course_detail/<?php echo $value->course_id . "/" . $value->id_user_course; ?>" class="btn btn-success btn-sm btn-block">OPEN THIS COURSE</a>
		                            </div>
								</div>
							</div> <!-- //meta -->
						</div> <!-- //content -->
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
