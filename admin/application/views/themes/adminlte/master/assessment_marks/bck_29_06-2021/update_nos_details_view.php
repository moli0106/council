<?php echo form_open('admin/master/assessment_marks/update_nos_marks', array('id' => 'updateNos')) ?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">NoS Details</h3>
    </div>
    <div class="box-body">

        <input type="hidden" name="course_marks_row" id="" value="<?php echo $nos_details['course_marks_id_pk']; ?>">
        <input type="hidden" name="course" id="" value="<?php echo $nos_details['course_id_fk']; ?>">
        <input type="hidden" name="tmp_marks" id="nos_total_marks" value="<?php echo $nos_details['tmp_total_marks']; ?>">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="">NoS Type<span class="text-danger">*</span></label><?= $nos_details['nos_type'] ?>
                    <select class="form-control select2" style="width: 100%;" name="nos_type" id="nos_type">
                        <option value="" hidden="true">Select NoS Type</option>
                        <?php
                        if (!empty($nos_type_list)) {
                            foreach ($nos_type_list as $key => $nos_type) { ?>
                                <option value="<?php echo $nos_type['nos_id_pk']; ?>" <?php if ($nos_type['nos_id_pk'] == $nos_details['nos_type']) echo 'selected'; ?>>
                                    <?php echo $nos_type['nos_name']; ?>
                                </option>
                            <?php }
                        } else { ?>
                            <option value="" disabled="true">No Data Found...</option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('nos_type'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nos_name">NoS Name<span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="Enter NoS Name" name="nos_name" id="nos_name" value="<?php echo $nos_details['nos_name']; ?>">
                    <?php echo form_error('nos_name'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nos_code">NoS Code<span class="text-danger">*</span></label>
                    <input class="form-control" placeholder="Enter NoS Code" name="nos_code" id="nos_code" value="<?php echo $nos_details['nos_code']; ?>">
                    <?php echo form_error('nos_code'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nos_theory_marks">NoS Total Theory Marks<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Enter NoS Total Theory Marks" name="nos_theory_marks" id="nos_theory_marks" value="<?php echo $nos_details['nos_theory_marks']; ?>" min="1">
                    <?php echo form_error('nos_theory_marks'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nos_practical_marks">NoS Total Practical Marks<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Enter NoS Total Practical Marks" name="nos_practical_marks" id="nos_practical_marks" value="<?php echo $nos_details['nos_practical_marks']; ?>" min="1">
                    <?php echo form_error('nos_practical_marks'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nos_viva_marks">NoS Total Viva Marks</label>
                    <input type="number" class="form-control" placeholder="Enter NoS Viva Marks" name="nos_viva_marks" id="nos_viva_marks" value="<?php echo $nos_details['nos_viva_marks']; ?>" min="0">
                    <?php echo form_error('nos_viva_marks'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="theory_pass_marks">NoS Theory Pass Marks (%)
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="number" class="form-control" placeholder="Enter NoS Theory Pass Marks" name="theory_pass_marks" id="theory_pass_marks" value="<?php echo $nos_details['theory_pass_marks']; ?>" min="1">
                    <?php echo form_error('theory_pass_marks'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="practical_pass_marks">NoS Practical Pass Marks (%)
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="number" class="form-control" placeholder="Enter NoS Practical Pass Marks" name="practical_pass_marks" id="practical_pass_marks" value="<?php echo $nos_details['practical_pass_marks']; ?>" min="1">
                    <?php echo form_error('practical_pass_marks'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="viva_pass_marks">NoS Viva Pass Marks (%)</label>
                    <input type="number" class="form-control" placeholder="Enter NoS Viva Pass Marks" name="viva_pass_marks" id="viva_pass_marks" value="<?php echo $nos_details['viva_pass_marks']; ?>" min="0">
                    <?php echo form_error('viva_pass_marks'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="nos_wise_no_of_theory_question">NOS wise No. of Theory Question<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Enter NoS Practical Pass Marks" name="nos_wise_no_of_theory_question" id="nos_wise_no_of_theory_question" value="<?php echo $nos_details['nos_wise_no_of_theory_question']; ?>" min="1">
                    <?php echo form_error('nos_wise_no_of_theory_question'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="no_of_marks_each_question_carries">No. of marks each Question carries<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Enter No. of marks each Question carries" name="no_of_marks_each_question_carries" id="no_of_marks_each_question_carries" value="<?php echo $nos_details['no_of_marks_each_question_carries']; ?>" min="1">
                    <?php echo form_error('no_of_marks_each_question_carries'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pass_marks_for_each_nos">Total Pass Marks for Each NOS (%)</label>
                    <input type="number" class="form-control" placeholder="Enter Total Pass Marks for Each NOS" name="pass_marks_for_each_nos" id="pass_marks_for_each_nos" value="<?php echo $nos_details['pass_marks_for_each_nos']; ?>" min="0">
                    <?php echo form_error('pass_marks_for_each_nos'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><strong>Note: </strong><i class="text-danger">NoS Theory Pass Marks, NoS Practical Pass Marks, NoS Total Viva Marks, NoS Viva Pass Marks & Total Pass Marks for Each NOS, Provision for NA Leave it blank.</i></p>
            </div>
        </div>
    </div>
</div>

<?php if (isset($mismatched_marks)) { ?>
    <div class="alert alert-warning marks-not-matched">
        <strong>Warning!</strong> Number of theory question & number of marks each question not matched with NoS Total Theory Marks.
    </div>
<?php } ?>

<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="total_marks_for_job_role">Total Marks for Job Role (QP)</label>
                    <input type="number" class="form-control" placeholder="Enter Total Pass Marks for the Job Role" name="total_marks_for_job_role" id="total_marks_for_job_role" value="<?php echo $nos_details['total_marks']; ?>" readonly="true">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pass_marks_for_job_role">Total Pass Marks for Job Role (QP)<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" placeholder="Enter Total Pass Marks for the Job Role" name="pass_marks_for_job_role" id="pass_marks_for_job_role" value="<?php echo $nos_details['total_pass_marks']; ?>" min="1">
                    <?php echo form_error('pass_marks_for_job_role'); ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Have to pass every NoS ?<span class="text-danger">*</span></label>
                    <div class="radio">
                        <label style="margin-right: 50px;;"><input type="radio" name="pass_in_every_nos" value="Yes" <?php if ($nos_details['pass_in_every_nos'] == 'Yes') echo 'checked'; ?>>Yes</label>
                        <label><input type="radio" name="pass_in_every_nos" value="No" <?php if ($nos_details['pass_in_every_nos'] == 'No') echo 'checked'; ?>>No</label>
                        <?php echo form_error('pass_in_every_nos'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="" for="">&nbsp;</label>
                    <button type="submit" class="btn btn-block btn-success">Update NoS</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_close() ?>