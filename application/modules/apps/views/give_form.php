<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="card-body card-padding-sm">
			<form class="form-horizontal" role="form" method="post" action="<?php echo $action_url; ?>">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">
								<div class="card-header ch-alt">
									<h2>
										<b>Give Credit Form</b>
									</h2>
								</div>
							</div>
							<div class="col-xs-12 col-sm-10 col-md-9 col-lg-9" style="margin: 20px 0px 20px 0px">
								<button class="btn btn-success give-all" type="button">Give All</button>
							</div>
							<div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">
								<table class="table table-bordered table-stripted">
									<thead>
										<tr>
											<th>No</th>
											<th>Users</th>
											<th>Credit Point</th>
											<th>Add Credit Point</th>
											<!-- <th>Total Credit Point</th> -->
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>
										<?php foreach ($userData as $key => $value): ?>
											<tr>
												<td><?php echo $no; 
														$no++; ?></td>
												<td><?php echo $value->user_name; ?></td>
												<td class="text-right" id="point-<?php echo $value->id ?>"><?php echo $value->credit_point; ?></td>
												<td style="text-align: center !important">
													<input type="text" data-point-id="<?php echo $value->id; ?>" 
														   class="form-control text-center credit" 
														   style="width: 75px; display: inline" 
														   value="0"
														   name="credit[<?php echo $value->id; ?>]">
												</td>
												<span style="display: none" id="total-<?php echo $value->id ?>"><?php echo $value->credit_point; ?></span>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">
								<button type="submit" class="btn btn-lg btn-blue">Save Data</button>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>
<script>
	var totalPoint = parseInt($("#credit-point").text());
	$(document).ready(function() {
		giveAll();
		$('.credit').keyup(function(){
			var pointId 	 = $(this).data("point-id");
			var pointVal	 = parseInt($(this).val());
			var currentPoint = parseInt($("#total-" + pointId).text());

			if (pointVal != '') {
				if (pointVal > 0) {
					var totalCurrentPoint = pointVal + currentPoint;
				}
				else {
					var totalCurrentPoint = 0 + currentPoint;
				}

				$("#point-" + pointId).text(totalCurrentPoint);
			}
			countAll();
		});
	});

	function giveAll() {
		$('.give-all').click(function(){
			var count  = 0;
			var credit = 0;
			$.each($('.credit'), function(key, obj) {
	    		credit += parseInt($(obj).val());
	    		count++;
	    	});

	    	creditAll     = Math.floor(totalPoint / count);
	    	creditDefisit = totalPoint - (creditAll * count);
	    	$('.credit').val(creditAll);
	    	$("#credit-point").text(creditDefisit);
		});
	}

	function countAll() {
		var countPoint = 0;
		$('.credit').each(function(){
			var points 	   = parseInt($(this).val());

			if (points != '') {
				if (points > 0) {
					countPoint += points;
					if (countPoint > totalPoint) {
						error("points are not enough");
						$(this).val("");
						return false;
					}
				}
				else {
					countPoint += 0;	
				}
			}

			var totalCredit = totalPoint - countPoint;
			$("#credit-point").text(parseInt(totalCredit));
		});
	}
</script>
