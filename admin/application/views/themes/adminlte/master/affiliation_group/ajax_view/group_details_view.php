<style>
    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }
</style>

<div class="row">
   

    <div class="box-body">
        <?php echo form_open('admin/master/affiliation_group/updateGroupDetails/'. md5($groupDetails['group_id_pk'])) ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Group Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="group_name" id="group_name" value="<?php echo $groupDetails['group_name'];?>" readonly>
                    <?php echo form_error('group_name'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Group Code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" name="group_code" id="group_code" value="<?php echo $groupDetails['group_code'];?>">
                    <?php echo form_error('group_code'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Duration <span class="text-danger">*</span></label>
                    <select class="form-control required" style="width: 100%;" name="duration" id="duration">
                        <option value="" hidden="true">Select Duration</option>
                        <option value="600" <?php if($groupDetails['duration'] == 600){echo "selected";} ?>>600 hrs</option>
                        <option value="1200" <?php if($groupDetails['duration'] == 1200){echo "selected";} ?>>1200 hrs</option>
                    </select>
                    <?php echo form_error('duration'); ?>
                </div>
            </div>

            
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success btn-block btn-flat" id = "update-group-btn">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    Update Affiliation Group
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>