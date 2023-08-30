
<?php echo form_open('admin/master/new_sector/edit_sector/'. $sector_id_hash,array("id"=> "course_edit_form")) ?>
<input type="hidden" name="sector_id" id="input_course_id" class="form-control" value="<?php echo $sector_id_hash ?>">

<div class="row">
    
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Sector Name</label>
            <input type="text" class="form-control" name="sector_name" id="sector_name"
                value="<?php echo $sectors['sector_name']; ?>" placeholder="Enter course name">
            <?php echo form_error('sector_name'); ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Sector Code</label>
            <input type="text" class="form-control" name="sector_code" id="sector_code"
                value="<?php echo $sectors['sector_code']; ?>" placeholder="Enter course code">
            <?php echo form_error('sector_code'); ?>
        </div>
    </div>
	<div class="col-md-4">
        <div class="form-group">
            <label class="" for="">Sector Description</label>
            <input type="text" class="form-control" name="sector_desc" id="sector_desc"
                value="<?php echo $sectors['sector_description']; ?>" placeholder="Enter course code">
            <?php echo form_error('sector_desc'); ?>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12 course_edit_submit">
        <button type="submit" class="btn btn-primary pull-right submit_edit">Update</button>
    </div>
</div>
<?php echo form_close() ?>
