<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>SBI-E-Pay</li>
            <li class="active"><i class="fa fa-align-center"></i>Payment Proceed</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('alert_msg') ?>
        </div>
        <?php } ?>


        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Proceed To Pay For :: <b>VTC Student Registration</b>  </h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body">            
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
                                GROUP NAME : 
                                <p style="
                                        position: relative;
                                        left: 5px;
                                        font-weight: bolder;
                                        font-family: monospace;
                                        font-size: 22px;
                                        bottom: 3px;
                                        color: #141313;
                                    ">
                                    <?php echo $details['group_details']['group_name']?>
                                    [<?php echo $details['group_details']['group_code']?>]
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
                                            <?php //echo $details['amount_per_std']?>1/-</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-9">Total No Of Student</td>
                                            <td class="col-md-3"><?php //echo $details['total_std'];?>1</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right"><h2><strong>Total: </strong></h2>
                                            </td>
                                            <td class="text-left text-danger">
                                                <h2><strong><i class="fa fa-inr"></i>
                                                <?php //echo $details['total_amount'];?>1/-</strong></h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <input type="hidden" value="<?php echo $transaction_data;?>" class="transaction_data">
                                <input type="hidden" value="<?php echo $payment_type;?>" class="payment_type">
                                <input type="hidden" value="<?php echo $transaction_id;?>" class="transaction_id"> -->

                                <form name="ecom" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener">
                                    <input type="text" name="EncryptTrans" value="<?php echo $encryptTrans; ?>">
                                    <input type="text" name="merchIdVal" value ="<?php echo $merchantId;?>"/>
                                    <input type="submit" name="submit" value="Submit">
                                </form>
                                <!-- <form name="ecom" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener">
                                    <input type="hidden" name="EncryptTrans" value="<?php echo $encryptTrans;?>">
                                    <input type="hidden" name="merchIdVal" value="<?php echo $merchantId;?>" />
                                        
                                    <div class="form-group" style="float: right;">
                                    <input type="submit" name="submit" value="Submit">
                                </form> -->

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </section>
</div>





<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>
<script>
// $('.confirm_payment_btn').on('submit', function(e){
//     alert( "hiii" );

// });
$('.confirm_payment_btn').click(function() {
    var transaction_data = $('.transaction_data').val();
    var payment_type = $('.payment_type').val();
    var transaction_id = $('.transaction_id').val();
    // alert('-------------'+transaction_data);

    // event.preventDefault();
    $.ajax({
            url: "sbiepay/proceed_to_pay/sending_transaction_log/",
            type: "post",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'transaction_data': transaction_data,
                'payment_type': payment_type,
                'transaction_id': transaction_id
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