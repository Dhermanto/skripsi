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
												<td class="text-right all-point" id="point-<?php echo $value->id ?>"><?php echo $value->credit_point; ?></td>
												<td style="text-align: center !important">
													<input type="number" min="0" data-point-id="<?php echo ($value->id); ?>" 
														   class="form-control text-center credit" 
														   style="width: 75px; display: inline" 
														   value="0"
														   name="credit[<?php echo $value->id; ?>]">
												</td>
												<span style="display: none" id="total-<?php echo $value->id ?>"><?php echo ($value->credit_point) ? $value->credit_point : 0; ?></span>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">
								<button type="submit" class="btn btn-lg btn-blue give">Save Data</button>
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
	$(document).ready(function(){
		$('html').bind('keypress', function(e)
		{
		   if(e.keyCode == 13)
		   {
		      return false;
		   }
		});
		giveAll();
		give();
		minCredit();
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

	    	$.each($('.all-point'), function(key, obj) {
	    		var data = parseInt($(obj).text()) + creditAll;
	    		$(obj).text(data);
	    	});
		});
	}

	var validation = 0;
	function give() {
		var total = 0;
		$('.give').click(function(e){
			validation = 0;
			$('.credit').each(function(){
				var points 	   = parseInt($(this).val());
				if (points != "") {
					if (points < 0) {
						swal("credit point cannot be minus");
						validation++;
						return false;
					}
					else {
						total += points;
					}
				}
			});
			if (validation == 0) {
				if (totalPoint < total) {
					swal("credit point is not enough");
					return false;
				}	
				else {
					e.preventDefault();
					swal({
					    title: "Are you sure?",
					    text: "Are you sure you will process this?",
					    type: "warning",
					    showCancelButton: true,
					    confirmButtonColor: '#DD6B55',
					    confirmButtonText: 'Yes, I am sure!',
					    cancelButtonText: "No, cancel it!",
					    closeOnConfirm: false,
					    closeOnCancel: false
					},
					function(isConfirm){
					   	if (isConfirm){
					     	swal("Succeded!", "Credit point are successfully transfered!", "success");
					     	$('form').trigger('submit');
					    } else {
					      	swal("Cancelled", "your point will be returned", "error");
					    }
					});
				}
			}
		});
	}

	function minCredit() {
		$('.credit').keyup(function(e){
			var pointId 	 = $(this).data("point-id");
			var pointVal	 = parseInt($(this).val());
			var currentPoint = parseInt($("#total-" + pointId).text());
			if (pointVal != '') {
				if (pointVal > 0) {
					var totalCurrentPoint = pointVal + currentPoint;
					var totalCredit = totalPoint - pointVal;
				}
				else {
					// $(this).val(0);
					var totalCurrentPoint = 0 + currentPoint;
					var totalCredit = totalPoint - 0;
				}

				if (totalCredit >= 0) {
					$("#point-" + pointId).text(totalCurrentPoint);
				}
			}
			else if (pointVal != '' || pointVal == 0) {
				var totalCredit = totalPoint - 0;
				$("#point-" + pointId).text(currentPoint);
			}

			if (totalCredit < 0) {
				error("points is not enough");
			}
			else {
				$("#credit-point").text(parseInt(totalCredit));
			}
		});
	}
</script>
