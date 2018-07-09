<div class="card">
    <div class="card-header ch-alt">
		<h2>Customer</h2>
		<h2>
            <?php
                if (empty($data->row()->customer_name)) echo "";
                else echo  $data->row()->customer_name;
            ?>
            <div style="float: right; margin: 0px 40px 0px 0px; ">Credit remaining :
                <span id="credit_remaining" style="font-size: 20px; font-weight: bold; padding: 0px 20px">
                <?php
                    echo empty($data->row()->credit_point) ? 0 : $data->row()->credit_point;
                ?>
                </span>
                    <span id="total2" style="font-size: 20px; font-weight: bold; padding: 0px 20px"></span>
            </div>
        </h2>
	</div>
    <div class="clearfix"></div>
    <?php
        if (empty($data->row()->user_name)) {
    ?>
    <div class="card-body for-table">
        <div class="alert alert-warning alert-grid" role="alert">Sorry, no user exists.  <a href="<?php echo base_url('/user/tambah'); ?>">Add New One</a>
        </div>
    </div>
    <?php
        }
        else {
    ?>
    <div class="my-actions">
        <button type="button" name="give_all" class="btn btn-primary">Give All</button>
        <button type="button" name="clear" class="btn btn-primary">Clear</button>
    </div>
    <div class="alert alert-warning" style="margin: 20px 20px 0px 20px; display: none">
        <strong>Warning!</strong> Indicates a warning that might need attention.
    </div>
    <div class="card-body for-table">
        <div class="table-responsive">
            <form class="form-horizontal" role="form" method="post" action="<?php echo $action_url; ?>">
                <table class="table table-non-fluid table-bordered table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Credit point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            foreach ($data->result() as $key => $value): ?>
                            <tr>
                                <td width='40' align='center'><?php echo $no++ ?></td>
                                <td width='200'><?php echo $value->user_name ?></td>
                                <td width='200' align='center'>
                                    <input size="10" align="right" style="text-align:right" class="table-control num credit" type="text" name="user_name[]">
                                    <input type="hidden" name="user_id[]" value="<?php echo $value->user_id; ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="1"></td>
                            <td align="right">TOTAL</td>
                            <td>
                                <input type="text" style="text-align:right" class="table-control" readonly tabindex="-1" id="total">
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <button style="margin: 5px 0px 20px 0px;" type="submit" class="btn bgm-lightgreen waves-effect" name="save_give" value="save-only">Save</button>
            </form>
        </div>
    </div>
</div>

<?php } ?>

<script>
    function hitung()
    {
        var credit_point = 0;
        var total = 0;
        var no = 0;
        var credit_remaining = $('#credit_remaining').text();
        var credit = parseInt(credit_remaining);

        $.each($('.credit'), function(key, obj) {
    		credit_point = credit_point + currencytonum($(obj).val());
    	});

        total   = credit_point;
        total2  = credit - credit_point;

        if (total > credit) {

            $('form').attr("onsubmit", "return(false)");
            $('.alert').css("display", "block");
            total2 = 0;
        }
        else {
            $('form').attr("onsubmit", "return(true)");
            $('.alert').css("display", "none");
        }

        $('#total').val(total);
        $('#total2').text(total2);
        $('#credit_remaining').css("display", "none");
    }

    function clear()
    {
        var credit_remaining = $('#credit_remaining').text();
        var credit = parseInt(credit_remaining);
        credit_point = 0;

        $.each($('.credit'), function(key, obj) {
            credit_point = credit_point + currencytonum($(obj).val());
            $('#total').val(0);
    		$(obj).val(0) ;
    	});

        $('#credit_remaining').css("display", "none");
        $('.alert').css("display", "none");
        $('#total2').text(credit);
    }

    function give_all()
    {
        var count               = $('.credit').length;
        var credit_remaining    = $('#credit_remaining').text();
        var credit              = parseInt(credit_remaining);
        var credit_point        = 0
        var total               = 0;
        var hasil               = 0;

        if (credit < 0) {
            total   = 0;
            credit  = 0;
            $('#total2').text(credit_remaining);
        }
        else if (credit >= 0) {
            total = credit/count;
            fix = Math.floor(total);
            $('#total2').text(0);
        }

        $.each($('.credit'), function(key, obj) {
            $(obj).val(fix);
            credit_point = credit_point + currencytonum($(obj).val());
    	});

        hasil = credit - credit_point;

        $('#total').val(credit_point);
        $('#credit_remaining').css("display", "none");
        $('#total2').text(hasil);
    }

    $().ready(function() {
    	$('.table-control').keyup(hitung);
        $('.num').keydown(function(e){
            if(isNaN(e.key)) {
                if(e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40 && e.keyCode != 9)
                {
                    e.preventDefault();
                }
            }
        });
        $('[name=clear]').click(clear);
        $('[name=give_all]').click(give_all);
        $('[name=save_give]').click(hitung)
    });

</script>
