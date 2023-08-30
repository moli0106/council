<!-- Course sector block  start-->
<div class="row course_sector_block">
    <div class="col-md-3">
        <div class="form-group">
            <label>Job Role <span class="text-danger">*</span></label>
            <select class="form-control job_role" name="job_role[<?php echo $course_sector_block_count ?>]">
                <option value="">-- Select Job Role --</option>
                <?php foreach($courses as $course){ ?>
                <option value="<?php echo $course["course_id_pk"] ?>"><?php echo $course["course_name"] ?> (<?php echo $course["course_code"]  ?>)</option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Sector <span class="text-danger">*</span></label>
            <input type="text" class="form-control sector_name" value="" placeholder="Sector name" name="sector[<?php echo $course_sector_block_count ?>]" readonly>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="job_role_sp_quali">Job role specific qualification</label>
            <input type="text" class="form-control job_role_sp_quali" value="" placeholder="Job role specific qualification" name="job_role_sp_quali[<?php echo $course_sector_block_count ?>]" >
            </select>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <label>&nbsp;</label><br>
            <button type="button" class="btn btn-danger course_sector_block_remove"><i class="fa fa-times" aria-hidden="true"></i></button> 
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group text_here">
            
        </div>
    </div>
</div>

<!-- Course sector block  end-->
