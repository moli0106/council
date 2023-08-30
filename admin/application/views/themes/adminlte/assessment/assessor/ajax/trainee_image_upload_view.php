<style>
    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }
</style>



<?php echo form_open_multipart("admin/assessment/assessor/batch/updateTraineeProfilePic/" . md5($trainee_details[0]['assessment_trainee_id_pk'])); ?>

    <input type="hidden" name="batch_id" value="<?php echo md5($trainee_details[0]['assessment_batch_id_fk'])?>">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="">Trainee Full Name</label>
                        <input type="text" class="form-control" value="<?php echo $trainee_details[0]['trainee_full_name']?>" readonly>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="profile_pic">Upload Student Image <br><small>(image should be – jpg/jpeg 100 KB)</small></label>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-success">
                                    Browse&hellip;<input type="file" style="display: none;" name="profile_pic" id="profile_pic" class="<?php if ($trainee_details[0]['trainee_image'] == NULL) {
                                                                                                    echo 'required';
                                                                                                } ?>">
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                            <?php echo form_error('profile_pic'); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-warning btn-block btn-flat" id="submit-trainee-pic">Upload Photo</button>
                </div>

            </div>

        </div>
    </div>

<?php echo form_close() ?>

