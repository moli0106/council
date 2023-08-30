
<?php //print_r($_POST) ?>
<?php if(count($course)){ ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Domain Name</th>
            <!-- <th>Course Code</th> -->
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $course[0]['domain_name'] ?></td>
            <!-- <td><?php echo $course[0]['course_code'] ?></td> -->
        </tr>
    </tbody>
</table>
<div class="alert alert-warning">
    
    Are you sure you want to delete this Domain permanently? 
</div>
<?php echo form_open('master/new_domain/delete_domain_details/'.$domain_id_hash, array("id"=>"delete_course_form")) ?>
<input type="hidden" name="domain_id" id="input_domain_id" class="form-control" value="<?php echo $domain_id_hash; ?>">
<button type="button" class="btn btn-danger pull-right domain_delete_submit">Delete</button>
<br><br><br>
<?php echo form_close(); ?>
<?php } else { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Domain has been successfully deleted.
    </div>

<?php } ?>
