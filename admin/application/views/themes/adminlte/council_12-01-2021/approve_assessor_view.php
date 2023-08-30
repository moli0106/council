<?php if(isset($success)){ ?>

<div class="alert alert-success">
    Assessor approved successfully
</div>
<script>
setInterval(function(){
window.location.replace("council/assessor_list");
}, 2000);
</script>
<?php } else { ?>
<?php echo form_open("admin/council/assessor_list/approve_assessor",array("id"=>"approve_form")) ?>
<input type="hidden" id="ass_id" name="assessor" value="<?php echo $assessor_id_hash; ?>">

Are you sure? You want to approve this assessor? 
<button type="button" class="btn btn-sm btn-success pull-right approve_button">Yes</button>

<?php echo form_close(); ?>
<?php } ?>