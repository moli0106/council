
<?php //print_r($_POST) ?>
<?php if(count($council_qualification_domain)){ ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Qualification</th>
            <th>Domain</th>
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $council_qualification_domain[0]['qualification'] ?></td>
            <td><?php echo $council_qualification_domain[0]['domain_name'] ?></td>
        </tr>
    </tbody>
</table>
<div class="alert alert-warning">
    
    Are you sure you want to delete this Qualification domain map? 
</div>
<?php echo form_open('master/new_domain/delete_domain_details/'.$council_qualification_domain_hash, array("id"=>"delete_course_form")) ?>
<input type="hidden" name="domain_id" id="input_domain_id" class="form-control" value="<?php echo $council_qualification_domain_hash; ?>">
<button type="button" class="btn btn-danger pull-right domain_delete_submit">Delete</button>
<br><br><br>
<?php echo form_close(); ?>
<?php } else { ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Qualification domain map has been successfully deleted.
    </div>

<?php } ?>
