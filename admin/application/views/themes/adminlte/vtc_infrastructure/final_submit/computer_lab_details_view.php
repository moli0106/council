<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Other Infrastructure Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">

        <div class="row">

            <?php if (!empty($computerLabData)) { ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="" for="lab_present">Present Computer Lab <span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">

                            <input class="form-check-input lab-present" type="radio" name="lab_present" id="lab_present_yes"
                                value="1" <?php if ($computerLabData['lab_present'] == 1){ echo 'checked';}?>>
                            <label class="form-check-label" for="lab_present_yes">Yes</label>

                            <input class="form-check-input lab-present" type="radio" name="lab_present" id="lab_present_no"
                                value="0" <?php if ($computerLabData['lab_present'] == 0) { echo 'checked';}?>>
                            <label class="form-check-label" for="lab_present_no">No</label>

                            
                        </div>
                    </div>
                </div>

                <div class="col-md-4 computer-no-div"
                    <?php if($computerLabData['lab_present'] != 1){echo 'style="display: none;"';}?>>
                    <div class="form-group">
                        <label for="no_of_computer">No of Computers<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="no_of_computer" id="no_of_computer" min="1"
                            value="<?php if($computerLabData){echo $computerLabData['no_of_computer']; }else{echo set_value('no_of_computer');} ?>">
                        <?php echo form_error('no_of_computer'); ?>
                    </div>
                </div>


                <div class="col-md-4 computer-no-div"
                    <?php if($computerLabData['lab_present'] != 1){echo 'style="display: none;"';}?>>
                    <div class="form-group">
                        <label for="working_computer">No of Working Computers<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="working_computer" id="working_computer" min="1"
                            value="<?php if($computerLabData){echo $computerLabData['no_of_working_computer']; }else{echo set_value('working_computer');} ?>">
                        <?php echo form_error('working_computer'); ?>
                    </div>
                </div>

            <?php } else { ?>
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                        Your Computer Lab Details is not added 
                        <!-- for academic year <span
                            class="label label-success"><?php echo $academic_year; ?></span> -->
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>