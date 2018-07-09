<?php
	$count = 0;
	$date = date("Y-m-d H:i:s");
	$data_course 	 = $course_category->result_array();
	$data_category	 = $category->result_array();
	$array_satu  = array(0);
	$array_dua   = array(0);
	$array_tiga  = array(0);

	foreach ($course_id as $key => $course) {
		@$array_satu[] = $course['course_id'];
	}
	foreach ($cek_date as $key => $cek) {
		@$array_dua[] 	= $cek['course_id'];
		@$array_tiga[] 	= $cek['course_closed_date'];
	}
?>
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div style="margin-bottom: 30px;">
			<form class="form-inline">
			  	<div class="form-group">
			    	<label  for="exampleInputEmail3">Category : </label>
			    	<select class="form-control" id="category_triggerer">
				    	<?php foreach($category->result_array() as $x => $v) : ?>
				    		<option value="<?php echo $v['id']?>"> <?php echo $v['category_name']?> </option>
				    	<?php endforeach;?>
			    	</select>
			  	</div>
			</form>
		</div>
		<?php
			echo "<div class=\"catalog\">";
			foreach($data_category as $key => $hasil) {
				echo "<div class=\"row is-flex\">";
				foreach ($data_course as $key => $hasil2) {
					if ($hasil2['course_category'] === $hasil['id']) {
			?>
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 cat cat<?php echo $hasil2['id_category']?>" style="display: none">
				<div class="item">
					<div class="thumbnail">
						<a href="<?php echo site_url("apps/detail/course_detail/" .$hasil2['id_course']. ""); ?>" class="images block" style="background-image:url('<?php echo base_url()?>uploads/catalogs/<?php echo $hasil2['course_image']; ?>')">
						</a> <!-- //images -->
						<div class="caption">
							<h3>
								<a href=" <?php echo site_url("apps/detail/course_detail/".$hasil2['id_course']."");?> " class="block">
									<b id='judul'><?php echo $hasil2['course_title']; ?></b>
								</a>
							</h3> <!-- //title -->

							<div class="price text-danger">
								<h3 class="no-margin"><b id='credit'><?php echo $hasil2['credit_point'] ?></b> Credit Points</h3>
							</div>

							<div class="detail">
								<div class="row">
									<div class="col-xs-9">
									</div> <!-- //col -->
									<div class="col-xs-9">
									</div> <!-- //col -->
								</div> <!-- //row -->
								<div class="action">
								 <a id='daftar'href="<?php echo base_url();?>apps/katalog/course_in/<?php echo $hasil2['id_course'];?>"
									 <?php
										if (in_array($hasil2['id_course'], @$array_satu)) {
											$label = "Bookmarked";
											echo "style='pointer-events: none; cursor: default'";
											echo "class='btn btn-warning btn-sm btn-block'";
										}
										else if (in_array($hasil2['id_course'], @$array_dua)) {
											$jumlah = array_search($hasil2['course_closed_date'], @$array_tiga);

											if ($date < $array_tiga[$jumlah]) {
												$label = "Enrolled";
												echo "style='pointer-events: none; cursor: default'";
												echo "class='btn btn-success btn-sm btn-block enrolled'";
											}
											else {
												$label = "Bookmark";
											}
										}
										else {
											$label = "Bookmark";
										}
									?>
								 class="btn btn-primary btn-sm btn-block bookmark">
									<?php echo $label; ?>
								 </a>
								</div>
							</div> <!-- //detail -->
						</div> <!-- //meta -->
					</div> <!-- //content -->
				</div> <!-- //item -->
			</div> <!-- //col -->
			<?php
					}
				}
				echo "	</div> <!-- //row -->";
				
			}
			?>
			</div> <!-- //catalog -->
		</div>
	</div>


<script type="text/javascript">
	$(document).ready(function(){

		setVisible($("#category_triggerer").val());

		$("#category_triggerer").change(function(){
			setVisible($(this).val());
		});


		function setVisible(category){
			// alert("asdd");
			$(".cat").hide();
			$(".cat"+category).show();
		}

		$('.enroll').click(function(){
	        var cek = confirm("Are You sure want to enroll this course? Once You enrolled this course, You cannot cancel it anymore.");
	        if (cek == true) {
	        	setInterval(function () { 
	        		location.reload();
	        	}, 10);
	            return true;
	        }
	        else {
	            return false;
	        }
	    })
	});
</script>

