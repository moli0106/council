<?php echo form_open('admin/assessment/assessor/batch/batchConfirmation', array('id' => 'batch-confirmation-form')) ?>
<div class="box" style="padding: 10px 10px;">
    <input type="hidden" name="map_id_hash" value="<?php echo $map_id_hash; ?>">
    <input type="hidden" name="batch_id_hash" value="<?php echo md5($batch_details['assessment_batch_id_pk']); ?>">
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Vertical Code : </strong>
                    <?php echo $batch_details['vertical_code']; ?>
                </li>
                <li class="list-group-item">
                    <strong>Batch Code : </strong>
                    <?php echo $batch_details['user_batch_id']; ?>
                </li>
                <li class="list-group-item">
                    <strong>TC Name : </strong>
                    <?php echo $batch_details['council_tc_name']; ?>
                </li>
                <li class="list-group-item">
                    <strong>Sector Name : </strong>
                    <?php echo $batch_details['sector_name'] . ' [' . $batch_details['sector_code'] . ']'; ?>
                </li>
                <li class="list-group-item">
                    <strong>Course Name : </strong>
                    <?php echo $batch_details['course_name'] . ' [' . $batch_details['course_code'] . ']'; ?>
                </li>
                <li class="list-group-item">
                    <label for="batch_status">Status : <span class="text-danger">*</span></label>
                    <div class="radio text-center">
                        <label><input type="radio" name="batch_status" value="approve">Approve</label>
                        <label><input type="radio" name="batch_status" value="inability">Inability</label>
                        <?php echo form_error('batch_status'); ?>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-group">
                        <label class="" for="">Comment : <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="batch_notes" rows="5" id="comment"></textarea>
                        <?php echo form_error('batch_notes'); ?>
                    </div>
                </li>
                <li class="list-group-item">
                    <p class="text-danger"> Please verify before confirm. Once it confirm you can't able to revert it.</p>
                </li>
                <li class="list-group-item submit-button text-center">
                    <button type="submit" class="btn btn-success" id="submit-batch-confirmation">Confirm</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php echo form_close() ?>