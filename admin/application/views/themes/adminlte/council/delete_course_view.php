
<?php //print_r($_POST) ?>
<?php if(count($course)){ ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Course Name</th>
            <th>Course Code</th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $course[0]['course_name'] ?></td>
            <td><?php echo $course[0]['course_code'] ?></td>
        </tr>
    </tbody>
</table>
<div class="alert alert-warning">
    
    Are you sure you want to delete this course permanently? 
</div>
<?php echo form_open('council/new_course/delete_course_details/'.$course_id_hash, array("id"=>"delete_course_form")) ?>
<input type="hidden" name="course_id" id="input_course_id" class="form-control" value="<?php echo $course_id_hash; ?>">
<button type="button" class="btn btn-danger pull-right course_delete_submit">Delete</button>
<br><br><br>
<?php echo form_close(); ?>
<?php } else { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Course has been successfully deleted.
    </div>

<?php } ?>
