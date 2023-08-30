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
        <?php echo form_open('admin/master/affiliation_subject/updateSubjectType/'. md5($subject_typeDetails['subject_name_id_pk'])) ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Subject Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="subject_name" id="subject_name" value="<?php echo $subject_typeDetails['subject_name'];?>" readonly>
                    <?php echo form_error('subject_name'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Subject Code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="subject_code" id="subject_code" value="<?php echo $subject_typeDetails['subject_code'];?>" readonly>
                    <?php echo form_error('subject_code'); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="">Subject Type <span class="text-danger">*</span></label>
                    <select class="form-control required" style="width: 100%;" name="subjecttype" id="subjecttype">
                        <option value="" hidden="true">Select Subject Type</option>
                        <?php foreach($subject_type as $stype){ ?>
                           <!-- <option value="<?php echo $stype['subject_type_id_pk'] ?>" <?php echo set_select("subjecttype", $stype['subject_type_id_pk']) ?>><?php echo $stype['subject_type'] ?></option> -->

                            <option value="<?php echo $stype['subject_type_id_pk']?>"
                            <?php if($subject_typeDetails['subject_type_id_fk'] == $stype['subject_type_id_pk']){echo 'selected';} ?><?php echo set_select('discipline_id' , $stype['subject_type_id_pk']); ?>>
                                <?php echo $stype['subject_type']?></option>
                        
                        <?php } ?>
                    </select>
                    <?php echo form_error('subjecttype'); ?>
                </div>
            </div>

            
            <div class="col-md-3"></div>
            <div class="col-md-6">
        <button type="submit" class="btn btn-success btn-block btn-flat" id = "update-subject-type-btn">
                 Update Subject Type
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>