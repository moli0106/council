<?=form_open("admin/master/new_course/edit_domain/".$domain_id_hash, array("id"=> "domain_edit_form"))?>
    <div class="row">
        <input type="hidden" name="domain_id_hash" value="<?=md5($domain['course_qualification_map_id_pk'])?>" readonly="true">
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="" for="">Qualification*</label>
                <input type="text" class="form-control" name="domain_quali" value="<?=$domain['qualification']?>" readonly="true">
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="" for="">Domain Experience(year)*</label>
                <input type="text" class="form-control" name="domain_exp" value="<?=$domain['domain_specific_working_experience']?>" id="updateDomainExperience">
                <?php echo form_error('domain_exp'); ?>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="form-group">
                <label class="" for="">Domain*</label>
                <input type="text" class="form-control" name="domain_name" value="<?=$domain['domain_name']?>" readonly="true">
            </div>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary updateDomainForm">Update</button>
            </div>
        </div>
    </div>
<?=form_close()?>