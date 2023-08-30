<div class="row work_exp_section">
    <div class="row">
        <div class="col-md-12">
        <div class="col-md-3">
            <div class="form-group">
                <label for="landline">Organisation Name <span class="text-danger">*</span></label>
                <input type="text" value="" name="org_name[<?php echo $count_work_experience ?>]" class="form-control" placeholder="Organisation Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="landline">Area of Work <span class="text-danger">*</span></label>
                <input type="text" value="" name="work_area[<?php echo $count_work_experience ?>]" id="" class="form-control" placeholder="Area of Work">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="landline">No of Years <span class="text-danger">*</span></label>
                <input type="text" value="" name="work_years[<?php echo $count_work_experience ?>]" class="form-control" placeholder="No of Years">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="landline">No of Months <span class="text-danger">*</span></label>
                <input type="text" value="" name="work_months[]" class="form-control" placeholder="No of Months">
            </div>
        </div>
        </div>
        <div class="col-md-12">
        
            <div class="col-md-3">
                <div class="form-group">
                    <label>Upload doc (50KB Max) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" placeholder="Experience Month" name="experience_<?php echo $count_work_experience ?>" value="">
                    
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>&nbsp;</label><br>
                    <button type="button" class="btn btn-danger work_experiance_remove"><i class="fa fa-times" aria-hidden="true"></i></button> 
                </div>   
            </div>
        </div>
    </div>
    
</div>