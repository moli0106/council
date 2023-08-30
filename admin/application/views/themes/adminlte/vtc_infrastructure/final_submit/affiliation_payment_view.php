<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title"> Pay For Affiliation Fees</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
        <div class="row" style="margin-top: 50px; margin-bottom: 50px;">
            <div class="col-md-4 col-md-offset-4">

                <?php if($agriDisciplineExist == 'yes'){?>

                    <?php if ($vtcDetails['second_final_submit_status'] == 0) { ?>
                        <?php //if (($checkPaperLabDataCount == 'match') && ($checkCommonLabHsDiscipline == 'match') && !empty($classRoomData) && !empty($labSizeData) && !empty($otherData) && !empty($computerLabData) && !empty($agriData)) { ?>
                            <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
                                <!-- <input type="hidden" value="<?php echo $value['group_id_fk']; ?>" name="group_id">
                                <input type="hidden" value="<?php echo $value['new_addmition']; ?>" name="std_no"> -->
                                <input type="hidden" value="7" name="payment_type">
                                <br><button type="submit"  class="btn btn-info btn-sm">Proceed To Pay</button>
                            <?php echo form_close() ?>

                        <?php //}else{?>


                            <strong>
                                <p style="color: red;">Please fill up all fields</p>
                            </strong>

                        <?php //} ?>
                    <?php }?>

                <?php }else{?>

                    <?php if ($vtcDetails['second_final_submit_status'] == 0) { ?>
                        <?php if (($checkPaperLabDataCount == 'match') && ($checkCommonLabHsDiscipline == 'match') && !empty($classRoomData) && !empty($labSizeData) && !empty($otherData) && !empty($computerLabData)) { ?>
                            <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
                                <!-- <input type="hidden" value="<?php echo $value['group_id_fk']; ?>" name="group_id">
                                <input type="hidden" value="<?php echo $value['new_addmition']; ?>" name="std_no"> -->
                                <input type="hidden" value="7" name="payment_type">
                                <br><button type="submit"  class="btn btn-info btn-sm">Proceed To Pay</button>
                            <?php echo form_close() ?>

                        <?php }else{?>


                            <strong>
                                <p style="color: red;">Please fill up all fields</p>
                            </strong>

                        <?php } ?>
                    <?php }?>
                <?php }?>



                <?php if ($vtcDetails['second_final_submit_status'] == 1) { ?>

                <h3 class="timeline-header">
                    <a href=<?php echo base_url('admin/vtc_infrastructure/final_submit/download_vtc_pdf/' . md5($vtcDetails['vtc_details_id_pk'])); ?>
                        class="block btn btn-sm btn-success bg-yellow" target="_blank" title="Download PDF">Download
                        PDF</a>
                </h3>
                <?php } ?>
            </div>
        </div>
    </div>
</div>