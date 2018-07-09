<div class="card">
	<div class="card-header ch-alt">
		<h2>Credit Point Trx Form</h2>
	</div>
	<div class="card-body card-padding-sm">
		<form class="form-horizontal"  role="form" method="post" action="<?php echo $action_url; ?>">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Trx. no.</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" placeholder='[ Auto Number ]' readOnly name="trx_no" class="form-control" value="<?php echo $data->trx_no; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Trx. date</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="trx_date" class="form-control date-picker" value="<?php echo $data->trx_date; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Customer</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<?php if (empty($data->customer_id)): ?>
								<select name="customer_name" class="chosen required" data-placeholder="Pilih Status">
									<option value=''>Choose costumer</option>
									<?php foreach ($customer_name as $key => $value): ?>
										<option value="<?php echo $value->id; ?>"><?php echo $value->customer_name; ?></option>
									<?php endforeach ?>
								</select>
							<?php else: ?>
								<input type="text" name="customer_name" class="form-control" readonly value="<?php echo $data->customer_name; ?>">
								<input type="hidden" name="customer_id" class="form-control" value="<?php echo $data->customer_id; ?>">
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Credit points</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" <?php echo ($data->credit_point > 0) ? "disabled" : ""; ?> name="credit_point" class="form-control required" value="<?php echo $data->credit; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Expired date</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<input type="text" name="credit_exp_date" class="form-control date-picker" value="<?php echo $data->credit_exp_date; ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label">Remarks</label>
					<div class="col-sm-8">
						<div class="fg-line">
							<textarea name="remarks" rows="8" cols="40" class="form-control"><?php echo $data->remarks; ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-4 control-label"></label>
					<div class="col-sm-8">
						<div class="fg-line">
							<button type="submit" class="btn bgm-lightgreen waves-effect">Save Transaction</button>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</form>
	</div>
</div>
