<?php if(isset($success)){ ?>

<div class="alert alert-success">
    Assessor result accepted successfully
</div>
<script>
setInterval(function(){
    window.location.reload();
}, 2000);
</script>
<?php } else { ?>
<?php echo form_open("admin/assessor_ems/assessor_batch_result/approve_assessor_result",array("id"=>"approve_form")) ?>
<input type="hidden" id="ass_id" name="assessor_id_hash" value="<?php echo $assessor_id_hash; ?>">
<input type="hidden" id="batch_id" name="batch_id_hash" value="<?php echo $batch_id_hash; ?>">

Are you sure? You want to accept this assessor's result? 
<br>
<button type="button" class="btn btn-sm btn-success pull-right approve_button">Yes</button>
<br>
<?php echo form_close(); ?>
<?php } ?>