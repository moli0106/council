<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}
</style>

<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Online Application</h2>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active">Jexpo / Voclet Online Application Fee</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<style>
.course_sector_block,
.work_exp_section,
.experience_section,
.agency_section {
    padding: 10px 0px 10px 0px;
    margin-bottom: 10px;
    border: 2px solid #CCC;
}
</style>
<section class="pt-5 pb-5">
    <div class="container">
        

        <div class="row">

            <div class="col-md-12">
                <h3>Proceed To Pay For :: <b><?php echo $pay_for; ?></b></h3>
            </div>

        </div>
        <hr>
        
            <div align="center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">

                        <?php if($payment_type == 3) {?>
                            <div class="panel-heading" style="
                                    height: 45px;
                                    font-size: 18px;
                                    background-color: #00a65a;
                                    color: #fff;
                                    display: flex;
                                ">
                                <span class="glyphicon glyphicon-circle-arrow-right" style="padding: 2px;"></span> 
                                Exam NAME : 
                                <p style="
                                        position: relative;
                                        left: 5px;
                                        font-weight: bolder;
                                        font-family: monospace;
                                        font-size: 22px;
                                        bottom: 3px;
                                        color: #141313;
                                    ">
                                    Jexpo
                                </p>
                                
                                
                            </div>
                            <div class="panel-body">
                                
                                <table class="table table-striped table-condensed">
                                    <thead>
                                        <tr style="font-size: 18px;">
                                            <th>Description</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-md-9">Amount Per Student</td>
                                            <td class="col-md-3"><i class="fa fa-inr"></i>
                                            <?php //echo $details['amount_per_std']?> 1</td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-right"><h2><strong>Total: </strong></h2>
                                            </td>
                                            <td class="text-left text-danger">
                                                <h2><strong><i class="fa fa-inr"></i>
                                                <?php echo $details['total_amount'];?></strong></h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                            
                            </div>
                        

                            <input type="hidden" value="<?php echo $transaction_data;?>" class="transaction_data">
                            <input type="hidden" value="<?php echo $payment_type;?>" class="payment_type">
                            <input type="hidden" value="<?php echo $transaction_id;?>" class="transaction_id">
                            <input type="hidden" value="<?php echo $details['stake_details_id_fk'];?>" class="stake_details_id_fk">
                            
                        
                            <form name="ecom" method="post" action="http://localhost/council_live/sbi_e_pay/sbiepay_form.php">
                                <input type="hidden" name="EncryptTrans" value="<?php echo $encryptTrans; ?>">
                                <input type="hidden" name="merchIdVal" value ="<?php echo $merchantId;?>"/>
                                <div class="form-group" style="float: right;">
                                <input type="submit" name="submit" value="Confirm Payment" class="confirm_payment_btn">
                            </div>
                            </form>
                        <?php }elseif ($res_status == 1) {?>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="
                                            height: 45px;
                                            font-size: 18px;
                                            background-color: #00a65a;
                                            color: #fff;
                                            display: flex;
                                        ">
                                        <span class="glyphicon glyphicon-circle-arrow-right" style="padding: 2px;"></span> 
                                        Payment Successfully Done
                                        <p style="
                                                position: relative;
                                                left: 5px;
                                                font-weight: bolder;
                                                font-family: monospace;
                                                font-size: 22px;
                                                bottom: 3px;
                                                color: #141313;
                                            ">
                                            
                                        </p>
                                        
                                        
                                    </div>
                                    <div class="panel-body">
                                        
                                        <table class="table table-striped table-condensed">
                                            <thead>
                                                <tr style="font-size: 18px;">
                                                    <th>Description</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-9">Transaction Id</td>
                                                    <td class="col-md-3"><i class="fa fa-inr"></i>
                                                    <?php echo $transaction_id?></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-9">SBI Ref ID</td>
                                                    <td class="col-md-3"><?php echo $sbiepay_ref_id;?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><h2><strong>Total Amount: </strong></h2>
                                                    </td>
                                                    <td class="text-left text-danger">
                                                        <h2><strong><i class="fa fa-inr"></i>
                                                        <?php echo $posting_amount;?></strong></h2>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="form-group" style="float: right;">
                                            <a href=<?php echo base_url('admin/sbiepay/proceed_to_pay/download_payment_receipt/' . $transaction_id); ?>  class="block btn btn-sm btn-success bg-yellow" target="_blank" title="Download Receipt">Download Receipt</a>
                                        </div>

                                    </div>
                                </div>
                        </div>
                    </div>
                <?php }elseif ($res_status == 0) {?>
                    <p>Failure Payment</p>
                <?php }?>
                    </div>
                </div>
            </div>
        
       




        

       
        
    </div>

    
    <br>
</section>
    
<!-- </div> -->
<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>

<script>
// $('.confirm_payment_btn').on('submit', function(e){
//     alert( "hiii" );

// });
$('.confirm_payment_btn').click(function() {
    var transaction_data = $('.transaction_data').val();
    var payment_type = $('.payment_type').val();
    var transaction_id = $('.transaction_id').val();
    var stake_details_id_fk = $('.stake_details_id_fk').val();
    alert('-------------'+stake_details_id_fk);

    // event.preventDefault();
    $.ajax({
            url: "sbiepay/proceed_to_pay/sending_transaction_log",
            type: "post",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'transaction_data': transaction_data,
                'payment_type': payment_type,
                'transaction_id': transaction_id,
                'stake_details_id_fk' : stake_details_id_fk
            }
            //data: {'transaction_data':transaction_data,}
            //dataType: "json"
        })
        .done(function(res) {

        })
        .fail(function(res) {
            Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
            event.preventDefault();
        });
});
</script>