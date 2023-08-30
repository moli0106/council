<?php if(isset($success)){ ?>

<div class="alert alert-success">
    Assessor Result Reverted successfully
</div>
<script>
setInterval(function(){
    window.location.reload();
}, 2000);
</script>
<?php } else { ?>
    <?php echo form_open("admin/assessor_ems/assessor_batch_result/reject_assessor_result",array("id"=>"approve_form")) ?>
<input type="hidden" id="ass_id" name="assessor_id_hash" value="<?php echo $assessor_id_hash; ?>">
<input type="hidden" id="batch_id" name="batch_id_hash" value="<?php echo $batch_id_hash; ?>">

Are you sure? You want to Revert this assessor's result?
<br>
<label for="reject_reason">Revert Reason *</label>
<textarea name="reject_reason" id="reject_reason" class="form-control" rows="3" required="required"><?php echo set_value("reject_reason") ?></textarea>
<?php echo form_error('reject_reason'); ?>
<br>
<button type="button" class="btn btn-sm btn-success pull-right reject_button">Yes</button>
<br>
<?php echo form_close(); ?>
<?php } ?>