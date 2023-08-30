<?php if(isset($success)){ ?>

<div class="alert alert-success">
    Assessor Course accepted successfully
</div>
<!-- <script>
setInterval(function(){
window.location.replace("council/assessor_list/view_course_details/"+assessor_id);
}, 2000);
</script> -->
<?php } else { ?>
<?php echo form_open("admin/council/assessor_list/approve_assessor_course",array("id"=>"approve_form")) ?>
<input type="hidden" id="assessor_course_id" name="assessor_course_id" value="<?php echo $assessor_course_id_hash; ?>">

Are you sure? You want to accept this Course? 
<button type="button" class="btn btn-sm btn-success pull-right approve_button">Yes</button>

<?php echo form_close(); ?>
<?php } ?>