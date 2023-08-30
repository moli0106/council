<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Payment Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
        <table class="table table-bordered">
                        <tr>
                            <td class="font_size">Application Fee (Non - Refundable):</td>
                            <th class="font_size" ><?php echo $payment['application_fees'];?></th>
                        </tr>
                        <tr>
                            <td class="font_size">Inspection Fee (Non-Refundable):</td>
                            <th class="font_size"><?php echo $payment['inspection_fees'];?></th>
                        </tr>
                        <tr>
                            <td><?php echo $payment['new_or_renewal'] ?> Affiliation Fees</td>
                            <td><?php echo $payment['affiliation_fees'];?></td>
                        </tr>
                        <?php if($payment['increse_course_amnt'] != 0) {?>
                            <tr>
                                <td class="font_size"><?php echo $payment['new_or_renewal'] ?> Affiliation Fee  (for Additional Course):</td>
                                <th class="font_size"><?php echo $payment['increse_course_amnt'] ?></th>
                            </tr>
                        <?php }?>

                        <?php if($payment['increase_intake_amount'] != 0) {?>
                            <tr>
                                <td><?php echo $payment['new_or_renewal'] ?> Affiliation Fee for Additional Intake ()</td>
                                <td><?php echo $payment['increase_intake_amount'] ?></td>
                            </tr>
                        <?php }?>
                        <tr>
                            <td class="font_size">Total Fees:</td>
                            <th class="font_size"><?php echo $payment['total_fees']; ?></th>
                        </tr>
                        <tr>
                            <td class="font_size">Payment Status:</td>
                            <th class="font_size">Successful</th>
                        </tr>
                        <tr>
                            <td class="font_size">Transaction ID:</td>
                            <th class="font_size"><?php echo $payment_status['transaction_id']; ?></th>
                        </tr>
                        <tr>
                            <td class="font_size">Transaction Date & Time:</td>
                            <th class="font_size"><?php echo $payment_status['sending_time']; ?></th>
                        </tr>  
                        <tr>
                            <td class="font_size">Transaction Amount:</td>
                            <th class="font_size"><?php echo $payment_status['posting_amount']; ?></th>
                        </tr>                       
                        <!-- <tr>
                            <td class="font_size">Payment Mode:</td>
                            <th class="font_size">NET_BANKING</th>
                        </tr>                        -->
                        
                    </table>
                
            
        </div>
    </div>
    </div>
</div>