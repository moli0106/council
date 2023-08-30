<?php if(isset($success)){ ?>

<div class="alert alert-success">
Link for Online Training successfully send
</div>
<script>
setInterval(function(){
window.location.replace("trainer/batch");
}, 2000);
</script>
<?php } else { ?>
<?php echo form_open("admin/trainer/batch/send_training_link",array("id"=>"send_link_form")) ?>
<input type="hidden" id="ass_id" name="batch_id_hash" value="<?php echo $batch_id_hash; ?>">

<!-- Are you sure? You want to Revert this assessor?
<br> -->
<label for="reject_reason">Enter Link for Online Training *</label>
<input type="text" name="training_link" id="training_link" class="form-control" placeholder="Enter Link for Online Training" rows="3" required="required" value="<?php echo set_value("training_link") ?>">
<?php echo form_error('training_link'); ?>
<br>
<button type="button" class="btn btn-sm btn-success pull-right send_link_button">Yes</button>
<br>
<?php echo form_close(); ?>
<?php } ?>