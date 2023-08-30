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
        <h1>Add Course NoS Marks</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="master/assessment_marks"><i class="fa fa-align-center"></i>Assessment Marks List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Add Course NoS Marks</li>
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
                <h3 class="box-title">Course Details</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Sector Name/Code</b>
                                <a class="pull-right">
                                    <?php echo $course_details['sector_name']; ?>
                                    [<?php echo $course_details['sector_code']; ?>]
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Course Name/Code</b>
                                <a class="pull-right">
                                    <?php echo $course_details['course_name']; ?>
                                    [<?php echo $course_details['course_code']; ?>]
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($nos_details)) { ?>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">NoS List Details</h3>
                </div>
                <div class="box-body">
                    <table class="table table-hover table-bordered">
                        <tr style="background-color: #E8F5E9;">
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>#</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>NoS</strong></td>
                            <td colspan="4" align="center"><strong>Marks Allocation</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>Total Marks</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>Total Pass Marks</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>Pass Marks for NoS</strong></td>
                            <td colspan="3" align="center"><strong>Pass Marks(%)</strong></td>
                        </tr>
                        <tr style="background-color: #E8F5E9;">
                            <td><strong>Theory</strong></td>
                            <td><strong>Practical</strong></td>
                            <td><strong>Viva</strong></td>
                            <td><strong>Total</strong></td>
                            <td><strong>Theory</strong></td>
                            <td><strong>Practical</strong></td>
                            <td><strong>Viva</strong></td>
                        </tr>
                        <?php $count = 0;
                        foreach ($nos_details as $key => $nos) {
                            $totalMarks     = $nos['nos_theory_marks'] + $nos['nos_practical_marks'] + $nos['nos_viva_marks'];
                        ?>

                            <tr>
                                <td><?php echo ++$count; ?>.</td>
                                <td><?php echo $nos['nos_name']; ?>/<?php echo $nos['nos_code']; ?></td>

                                <td><?php echo $nos['nos_theory_marks']; ?></td>
                                <td><?php echo $nos['nos_practical_marks']; ?></td>
                                <td><?php echo ($nos['nos_viva_marks'] != NULL) ? $nos['nos_viva_marks'] : 'N/A'; ?></td>
                                <td><?php echo $totalMarks; ?></td>

                                <?php if ($count == 1) { ?>
                                    <td rowspan="<?php echo count($nos_details); ?>" style="vertical-align : middle;text-align:center;">
                                        <?php echo $course_details['total_marks']; ?>
                                    </td>
                                    <td rowspan="<?php echo count($nos_details); ?>" style="vertical-align : middle;text-align:center;">
                                        <?php echo $course_details['total_pass_marks']; ?>
                                    </td>
                                <?php } ?>

                                <td><?php echo ($nos['pass_marks_for_each_nos']) ? $nos['pass_marks_for_each_nos'] : 'N/A'; ?></td>

                                <!-- <td><?php echo $nos['theory_pass_marks']; ?></td> -->
                                <!-- <td><?php echo $nos['practical_pass_marks']; ?></td> -->
                                <td><?php echo ($nos['theory_pass_marks']) ? $nos['theory_pass_marks'] : 'N/A'; ?></td>
                                <td><?php echo ($nos['practical_pass_marks']) ? $nos['practical_pass_marks'] : 'N/A'; ?></td>
                                <td><?php echo ($nos['viva_pass_marks']) ? $nos['viva_pass_marks'] : 'N/A'; ?></td>
                            </tr>

                        <?php } ?>
                    </table>
                </div>
            </div>
        <?php } ?>

        <?php echo form_open('admin/master/assessment_marks/add_nos_marks', array('id' => 'addNos')) ?>

        <input type="hidden" class="form-control" name="nos_total_marks" id="nos_total_marks" value="<?php echo $course_details['total_marks']; ?>">
        <input type="hidden" class="form-control" name="sector_id_fk" value="<?php echo $course_details['sector_id_fk']; ?>">
        <input type="hidden" class="form-control" name="course_id_fk" value="<?php echo $course_details['course_id_pk']; ?>">

        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Add NoS</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">NoS Type<span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="nos_type" id="nos_type">
                                <option value="" hidden="true">Select NoS Type</option>
                                <?php
                                if (!empty($nos_type_list)) {
                                    foreach ($nos_type_list as $key => $nos_type) { ?>
                                        <option value="<?php echo $nos_type['nos_id_pk']; ?>" <?php echo set_select('nos_type', $nos_type['nos_id_pk']) ?>>
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
                            <input class="form-control" placeholder="Enter NoS Name" name="nos_name" id="nos_name" value="<?php echo set_value('nos_name'); ?>">
                            <?php echo form_error('nos_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nos_code">NoS Code<span class="text-danger">*</span></label>
                            <input class="form-control" placeholder="Enter NoS Code" name="nos_code" id="nos_code" value="<?php echo set_value('nos_code'); ?>">
                            <?php echo form_error('nos_code'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nos_theory_marks">NoS Total Theory Marks<span class="text-danger">*</span></label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter NoS Total Theory Marks" name="nos_theory_marks" id="nos_theory_marks" value="<?php echo set_value('nos_theory_marks'); ?>" min="0">
                            <?php echo form_error('nos_theory_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nos_practical_marks">NoS Total Practical Marks<span class="text-danger">*</span></label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter NoS Total Practical Marks" name="nos_practical_marks" id="nos_practical_marks" value="<?php echo set_value('nos_practical_marks'); ?>" min="0">
                            <?php echo form_error('nos_practical_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nos_viva_marks">NoS Total Viva Marks</label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter NoS Viva Marks" name="nos_viva_marks" id="nos_viva_marks" value="<?php echo set_value('nos_viva_marks'); ?>" min="0">
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
                            <input type="number" step=".01" class="form-control" placeholder="Enter NoS Theory Pass Marks" name="theory_pass_marks" id="theory_pass_marks" value="<?php echo set_value('theory_pass_marks'); ?>" min="0">
                            <?php echo form_error('theory_pass_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="practical_pass_marks">NoS Practical Pass Marks (%)
                                <!-- <span class="text-danger">*</span> -->
                            </label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter NoS Practical Pass Marks" name="practical_pass_marks" id="practical_pass_marks" value="<?php echo set_value('practical_pass_marks'); ?>" min="0">
                            <?php echo form_error('practical_pass_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="viva_pass_marks">NoS Viva Pass Marks (%)</label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter NoS Viva Pass Marks" name="viva_pass_marks" id="viva_pass_marks" value="<?php echo set_value('viva_pass_marks'); ?>" min="0">
                            <?php echo form_error('viva_pass_marks'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nos_wise_no_of_theory_question">NOS wise No. of Theory Question<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" step=".01" placeholder="Enter NoS Practical Pass Marks" name="nos_wise_no_of_theory_question" id="nos_wise_no_of_theory_question" value="<?php echo set_value('nos_wise_no_of_theory_question'); ?>" min="1">
                            <?php echo form_error('nos_wise_no_of_theory_question'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_of_marks_each_question_carries">No. of marks each Question carries<span class="text-danger">*</span></label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter No. of marks each Question carries" name="no_of_marks_each_question_carries" id="no_of_marks_each_question_carries" value="<?php echo set_value('no_of_marks_each_question_carries'); ?>" min="0">
                            <?php echo form_error('no_of_marks_each_question_carries'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pass_marks_for_each_nos">Total Pass Marks for Each NOS (%)</label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter Total Pass Marks for Each NOS" name="pass_marks_for_each_nos" id="pass_marks_for_each_nos" value="<?php echo set_value('pass_marks_for_each_nos'); ?>" min="0">
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

        <div class="alert alert-warning marks-not-matched" style="display: none">
            <strong>Warning!</strong> Number of theory question & number of marks each question not matched with NoS Total Theory Marks.
        </div>

        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="total_marks_for_job_role">Total Marks for Job Role (QP)</label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter Total Pass Marks for the Job Role" name="total_marks_for_job_role" id="total_marks_for_job_role" value="<?php echo $form_input['total_marks']; ?>" readonly="true">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pass_marks_for_job_role">Total Pass Marks for Job Role (QP)<span class="text-danger">*</span></label>
                            <input type="number" step=".01" class="form-control" placeholder="Enter Total Pass Marks for the Job Role" name="pass_marks_for_job_role" id="pass_marks_for_job_role" value="<?php echo $form_input['pass_marks']; ?>" min="0">
                            <?php echo form_error('pass_marks_for_job_role'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Have to pass every NoS ?<span class="text-danger">*</span></label>
                            <div class="radio">
                                <label style="margin-right: 50px;;"><input type="radio" name="pass_in_every_nos" value="Yes" <?php if ($form_input['pass_in_nos'] == 'Yes') echo 'checked'; ?>>Yes</label>
                                <label><input type="radio" step=".01" name="pass_in_every_nos" value="No" <?php if ($form_input['pass_in_nos'] == 'No') echo 'checked'; ?>>No</label>
                                <?php echo form_error('pass_in_every_nos'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-block btn-success">Add NoS</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close() ?>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>