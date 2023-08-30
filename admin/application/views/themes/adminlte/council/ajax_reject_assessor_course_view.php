<?php if(isset($success)){ ?>

<div class="alert alert-success">
    Assessor Course rejected successfully
</div>
<!-- <script>
setInterval(function(){
window.location.replace("council/assessor_list");
}, 2000);
</script> -->
<?php } else { ?>
<?php echo form_open("admin/council/assessor_list/reject_assessor_course",array("id"=>"approve_form")) ?>
<input type="hidden" id="assessor_course_id" name="assessor_course_id" value="<?php echo $assessor_course_id_hash; ?>">

Are you sure? You want to reject this course?
<!-- <br>
<label for="reject_reason">Reject Reason *</label>
<textarea name="reject_reason" id="reject_reason" class="form-control" rows="3" required="required"><?php //echo set_value("reject_reason") ?></textarea>
<?php //echo form_error('reject_reason'); ?>
<br> -->
<button type="button" class="btn btn-sm btn-success pull-right reject_button">Yes</button>
<br>
<?php echo form_close(); ?>
<?php } ?>