<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Marks</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="master/assessment_marks"><i class="fa fa-align-center"></i>Assessment Marks List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Add Assessment Marks</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Add Course wise Marks for Assessment</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/assessment_marks/add_assessment_marks') ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Sector<span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="sector_id" id="sector_id">
                                <option value="" hidden="true">Select Sector</option>
                                <?php foreach ($sector_list as $key => $sector) { ?>
                                    <option value="<?php echo $sector['sector_id_pk']; ?>" <?php echo set_select('sector_id', $sector['sector_id_pk']) ?>>
                                        <?php echo $sector['sector_name']; ?>
                                        [<?php echo $sector['sector_code']; ?>]
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('sector_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Job Role<span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Job Role</option>
                                <?php
                                if (!empty($course_list)) {
                                    foreach ($course_list as $key => $course) { ?>
                                        <option value="<?php echo $course['course_id_pk']; ?>" <?php echo set_select('course_id', $course['course_id_pk']) ?>>
                                            <?php echo $course['course_name']; ?>
                                            [<?php echo $course['course_code']; ?>]
                                        </option>
                                <?php }
                                } else echo '<option value="" disabled="true">Select Sector First...</option>'; ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nos_name">NoS Name<span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="Enter NoS Name" name="nos_name" id="nos_name" value="<?php echo set_value('nos_name'); ?>">
                            <?php echo form_error('nos_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nos_code">NoS Code<span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="Enter NoS Code" name="nos_code" id="nos_code" value="<?php echo set_value('nos_code'); ?>">
                            <?php echo form_error('nos_code'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">NoS Type<span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="nos_type" id="nos_type">
                                <option value="" hidden="true">Select NoS Type</option>
                                <option value="NoS Type 1" <?php echo set_select('nos_type', 'NoS Type 1') ?>>NoS Type 1</option>
                                <option value="NoS Type 2" <?php echo set_select('nos_type', 'NoS Type 2') ?>>NoS Type 2</option>
                                <option value="NoS Type 3" <?php echo set_select('nos_type', 'NoS Type 3') ?>>NoS Type 3</option>
                                <option value="NoS Type 4" <?php echo set_select('nos_type', 'NoS Type 4') ?>>NoS Type 4</option>
                                <option value="NoS Type 5" <?php echo set_select('nos_type', 'NoS Type 5') ?>>NoS Type 5</option>
                                <!-- <option value="" disabled="true">No Data Found...</option> -->
                            </select>
                            <?php echo form_error('nos_type'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nos_theory_marks">NoS Total Theory Marks<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter NoS Total Theory Marks" name="nos_theory_marks" id="nos_theory_marks" value="<?php echo set_value('nos_theory_marks'); ?>" min="1">
                            <?php echo form_error('nos_theory_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nos_practical_marks">NoS Total Practical Marks<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter NoS Total Practical Marks" name="nos_practical_marks" id="nos_practical_marks" value="<?php echo set_value('nos_practical_marks'); ?>" min="1">
                            <?php echo form_error('nos_practical_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nos_viva_marks">NoS Total Viva Marks</label>
                            <input type="number" class="form-control" placeholder="Enter NoS Viva Marks" name="nos_viva_marks" id="nos_viva_marks" value="<?php echo set_value('nos_viva_marks'); ?>" min="0">
                            <?php echo form_error('nos_viva_marks'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="theory_pass_marks">NoS Theory Pass Marks (%)<span class="text-danger">*</span><br></label>
                            <input type="number" class="form-control" placeholder="Enter NoS Theory Pass Marks" name="theory_pass_marks" id="theory_pass_marks" value="<?php echo set_value('theory_pass_marks'); ?>" min="1">
                            <?php echo form_error('theory_pass_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="practical_pass_marks">NoS Practical Pass Marks (%)<span class="text-danger">*</span><br></label>
                            <input type="number" class="form-control" placeholder="Enter NoS Practical Pass Marks" name="practical_pass_marks" id="practical_pass_marks" value="<?php echo set_value('practical_pass_marks'); ?>" min="1">
                            <?php echo form_error('practical_pass_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="viva_pass_marks">NoS Viva Pass Marks (%)</label>
                            <input type="number" class="form-control" placeholder="Enter NoS Viva Pass Marks" name="viva_pass_marks" id="viva_pass_marks" value="<?php echo set_value('viva_pass_marks'); ?>" min="0">
                            <?php echo form_error('viva_pass_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pass_marks_for_each_nos">Total Pass Marks for Each NOS (%)</label>
                            <input type="number" class="form-control" placeholder="Enter Total Pass Marks for Each NOS" name="pass_marks_for_each_nos" id="pass_marks_for_each_nos" value="<?php echo set_value('pass_marks_for_each_nos'); ?>" min="0">
                            <?php echo form_error('pass_marks_for_each_nos'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pass_marks_for_job_role">Total Pass Marks for Job Role (QP)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter Total Pass Marks for the Job Role" name="pass_marks_for_job_role" id="pass_marks_for_job_role" value="<?php echo set_value('pass_marks_for_job_role'); ?>" min="1">
                            <?php echo form_error('pass_marks_for_job_role'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nos_wise_no_of_theory_question">NOS wise No. of Theory Question<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter NoS Practical Pass Marks" name="nos_wise_no_of_theory_question" id="nos_wise_no_of_theory_question" value="<?php echo set_value('nos_wise_no_of_theory_question'); ?>" min="1">
                            <?php echo form_error('nos_wise_no_of_theory_question'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="no_of_marks_each_question_carries">No. of marks each Question carries<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter No. of marks each Question carries" name="no_of_marks_each_question_carries" id="no_of_marks_each_question_carries" value="<?php echo set_value('no_of_marks_each_question_carries'); ?>" min="1">
                            <?php echo form_error('no_of_marks_each_question_carries'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Have to pass every NoS ?<span class="text-danger">*</span></label>
                            <div class="radio">
                                <label style="margin-right: 50px;;"><input type="radio" name="pass_in_every_nos" value="Yes" <?php echo set_radio('pass_in_every_nos', 'Yes'); ?>>Yes</label>
                                <label><input type="radio" name="pass_in_every_nos" value="No" <?php echo set_radio('pass_in_every_nos', 'No'); ?>>No</label>
                                <?php echo form_error('pass_in_every_nos'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Note: </strong><i class="text-danger">NoS Total Viva Marks, NoS Viva Pass Marks & Total Pass Marks for Each NOS, Provision for NA Leave it blank.</i></p>
                    </div>
                    <div class="col-md-3 col-md-offset-9">
                        <div class="form-group">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-block btn-success">Submit</button>
                        </div>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>