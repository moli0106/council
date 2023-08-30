
<?php //print_r($_POST) ?>
<?php if(count($course)){ ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Qualification Name</th>
            <!-- <th>Course Code</th> -->
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $course[0]['qualification'] ?></td>
            <!-- <td><?php echo $course[0]['course_code'] ?></td> -->
        </tr>
    </tbody>
</table>
<div class="alert alert-warning">
    
    Are you sure you want to delete this qualification permanently? 
</div>
<?php echo form_open('master/new_qualification/delete_qualification_details/'.$qualification_id_hash, array("id"=>"delete_course_form")) ?>
<input type="hidden" name="qualification_id" id="input_qualification_id" class="form-control" value="<?php echo $qualification_id_hash; ?>">
<button type="button" class="btn btn-danger pull-right qualification_delete_submit">Delete</button>
<br><br><br>
<?php echo form_close(); ?>
<?php } else { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Qualification has been successfully deleted.
    </div>

<?php } ?>
