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
    span.select2.select2-container.select2-container--default {
        width: 350px !important;
    }

    .select2-container--default.select2-container--focus, .select2-selection.select2-container--focus, .select2-container--default:focus, .select2-selection:focus, .select2-container--default:active, .select2-selection:active {
        outline: none;
        width: 350px !important;
    }
</style>



<?php echo form_open("admin/affiliation/teachers/assignSubjectForTeacher", array("id" => "assign_teacher")); ?>

<label for="">Teacher Name: </label><span> <?php echo $teacherDetails['teacher_name']; ?></span><br><br>
<label for="">Employee ID: </label><span> <?php echo $teacherDetails['employee_id']; ?></span><br><br>

<input type="hidden" name="teacher_id" value="<?php echo $teacherDetails['teacher_id_pk']; ?>">
<input type="hidden" name="teacher_type" value="<?php echo $teacherDetails['teacher_type']; ?>">

<div class="">


    <div class="row">

        <?php if($teacher_type == 1){?>
            <div class="col-md-10">
                <div class="form-group">
                    <label class="" for="subject_group_name">Select Subject : </label>

                    <select class="form-control select1" name="subject_group_name[]" id="subject_group_name" multiple="multiple">

                        <option value="" disabled>Select Subject</option>
                        <?php if(!empty($assignedSubjectGroup)){

                            foreach ($vtcSubject as $val) { ?>

                            <option value="<?php echo $val['subject_name_id_fk']?>" <?php if (in_array($val['subject_name_id_fk'], $assignedSubjectGroup)) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>>
                                <?php echo $val['subject_name']?> [<?php echo $val['subject_code']?>]
                            </option>

                            <?php }?>
                        <?php }else{
                            foreach ($vtcSubject as $val) { ?>

                            <option value="<?php echo $val['subject_name_id_fk']?>"><?php echo $val['subject_name']?> [<?php echo $val['subject_code']?>]</option>

                        <?php }}?>
                        
                    </select>
                </div>
            </div>
        <?php }elseif($teacher_type == 3){?>

            <div class="col-md-10">
            <div class="form-group">
                <label class="" for="subject_group_name">Select Group : </label>

                <select class="form-control select1" name="subject_group_name[]" id="subject_group_name" multiple="multiple">

                    <option value="" disabled>Select Group</option>
                    <?php if(!empty($assignedSubjectGroup)){

                        foreach ($vtcGroup as $val) { ?>

                        <option value="<?php echo $val['group_id_pk']?>" <?php if (in_array($val['group_id_pk'], $assignedSubjectGroup)) {
                                                                                                                echo 'selected';
                                                                                                            } ?>>
                            <?php echo $val['group_name']?> [<?php echo $val['group_code']?>]
                        </option>

                        <?php }?>
                    <?php }else{
                        foreach ($vtcGroup as $val) { ?>

                        <option value="<?php echo $val['group_id_pk']?>"><?php echo $val['group_name']?> [<?php echo $val['group_code']?>]</option>

                    <?php }}?>
                    
                </select>
            </div>
        </div>
        <?php }?>

    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-5">
            
            <?php if($teacher_type == 1){?>
                <button type="submit" class="btn btn-warning btn-block btn-flat" id="assign-subject-teacher">Submit Techer Subject</button>
            <?php }elseif($teacher_type == 3){?>
                <button type="submit" class="btn btn-warning btn-block btn-flat" id="assign-subject-teacher">Submit Techer Group</button>

            <?php }?>
        </div>
    </div>
</div>

<?php echo form_close() ?>
<script>
    $(document).ready(function() {
        //$('.select1').select2();



        $('.select1').select2({
            dropdownParent: $('#modal-teacher-subject-map')
        });
        // Do this before you initialize any of your modals
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    });
</script>

