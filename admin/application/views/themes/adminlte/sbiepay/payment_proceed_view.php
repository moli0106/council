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
                <h3 class="box-title">Proceed To Pay For :: <b><?php echo $pay_for; ?></b>  </h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <div class="box-body"> 
                <?php if($res_status == ''){?>
                                            
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="panel panel-default">

                                <?php if($payment_type == 1 || $payment_type == 5) {?>
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
                                                    <?php echo $details['amount_per_std']?></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-9">Total No Of Student</td>
                                                    <td class="col-md-3"><?php echo $details['total_std'];?></td>
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
                                <?php }elseif ($payment_type == 2 || $payment_type == 4 || $payment_type == 6 || $payment_type == 8) {?>  <!-- For Institute Registration Fee-->

                                    <?php $this->load->view($this->config->item('theme_uri') . 'sbiepay/insStd_registration_payment_page_view'); ?>
                                <?php }elseif ($payment_type == 7) {?>

                                    <?php $this->load->view($this->config->item('theme_uri') . 'sbiepay/vtc_affiliation_payment_page_view'); ?>

                               <?php }elseif ($payment_type == 9) { ?>
                                    <?php $this->load->view($this->config->item('theme_uri') . 'sbiepay/polytechnic_affiliation_payment_page_view'); ?>
                               <?php }?>

                                <input type="hidden" value="<?php echo $transaction_data;?>" class="transaction_data">
                                    <input type="hidden" value="<?php echo $payment_type;?>" class="payment_type">
                                    <input type="hidden" value="<?php echo $transaction_id;?>" class="transaction_id">
                                    
                                
                                    <form name="ecom" method="post" id="your_forms" action="http://localhost/council_live/sbi_e_pay/sbiepay_form.php" onsubmit="//return download()">
                                        <input type="hidden" name="EncryptTrans" value="<?php echo $encryptTrans; ?>">
                                        <input type="hidden" name="merchIdVal" value ="<?php echo $merchantId;?>"/>
                                        <div class="form-group" style="float: right;">

                                        <?php if ($payment_type == 4 || $payment_type == 5 || $payment_type == 8 || $payment_type == 9){?>
                                            <input type="submit" name="submit" value="Confirm Payment">
                                        <?php }else{?>
                                            <input type="submit" name="submit" value="Confirm Payment" class="confirm_payment_btn">
                                        <?php }?>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                
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




    </section>
</div>





<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>
<script>
// $('.confirm_payment_btn').on('submit', function(e){
//     alert( "hiii" );

// });

//function download(){
$("#your_form").submit(function(e) {
    var transaction_data = $('.transaction_data').val();
    var payment_type = $('.payment_type').val();
    var transaction_id = $('.transaction_id').val();
    // alert('-------------'+transaction_data);

    event.preventDefault();
    var form = $(this);
    var stopSubmit = false;
    if(transaction_id){
        $.ajax({
            url: "sbiepay/proceed_to_pay/sending_transaction_log",
            type: "post",
            async:false,
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                'transaction_data': transaction_data,
                'payment_type': payment_type,
                'transaction_id': transaction_id
            },
            //data: {'transaction_data':transaction_data,}
            //dataType: "json"
            success: function (response) {
                console.log(response);

                if(response) {
                    stopSubmit = false;
                    form.unbind('submit').submit();  
                } else {
                    
                    stopSubmit = true;
                    Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
                    return false;
                }
            }
        })
    }else {
       
        stopSubmit = true;
        Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
    }
    if(stopSubmit){
        return false;
    }

        // .done(function(res) {
        //     console.log(res);
        //     if(res){
               
        //         //afterAjax(res);
        //         stopSubmit = false;
        //     }else{
        //         // event.preventDefault();
        //         // Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
        //         // return false;
        //        // afterAjax(res);  
        //        stopSubmit = true;            
        //     }
        // })
        // .fail(function(res) {
        //     // event.preventDefault();
        //     // Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
        //     // return false; 
        //     afterAjax(res);
        // });
})

function afterAjax(res){
    alert(res);
    if (res == ''){
        Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
        event.preventDefault();
        return false;
    }else{
        return true;
    }
}

// $('.your_form').sumbit(function() {
//     var transaction_data = $('.transaction_data').val();
//     var payment_type = $('.payment_type').val();
//     var transaction_id = $('.transaction_id').val();
//     // alert('-------------'+transaction_data);

//     // event.preventDefault();
//     $.ajax({
//             url: "sbiepay/proceed_to_pay/sending_transaction_log",
//             type: "post",
//             data: {
//                 '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
//                 'transaction_data': transaction_data,
//                 'payment_type': payment_type,
//                 'transaction_id': transaction_id
//             }
//             //data: {'transaction_data':transaction_data,}
//             //dataType: "json"
//         })
//         .done(function(res) {
//             console.log(res);
//             if(res=='done'){
//                // $('#your_form').attr('action', 'http://localhost/council_live/sbi_e_pay/sbiepay_form.php');
//             }else{
//                 Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
//                 return false;
//                 event.preventDefault(e);
//             }
//         })
//         .fail(function(res) {
//             Swal.fire('Warning!', 'Oops! Something went wrong, Please try later.', 'warning');
//             event.preventDefault();
//         });
// });
</script>