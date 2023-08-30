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
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="assessment/assessor/batch"><i class="fa fa-align-center"></i>Assessment Batch List</a></li>
            <li><a href="assessment/assessor/batch/trainee_list/<?php echo md5($course_details['assessment_batch_assessor_map_id_pk']); ?>"><i class="fa fa-users"></i>Assessment Trainee List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Upload Marks</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <?php if (empty($course_marks)) { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning!</h4>
                Marks not uploaded yet for course
                <?php echo $course_details['course_name']; ?>
                [<?php echo $course_details['course_code']; ?>]. Please, contact council admin to upload marks.
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Trainee Details</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Trainee Name</b> <a class="pull-right"><?php echo $course_details['trainee_full_name']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Trainee Mobile</b> <a class="pull-right"><?php echo $course_details['trainee_mobile_no']; ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Council Trainee Code</b> <a class="pull-right"><?php echo $course_details['council_trainee_code']; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>User Trainee Code</b> <a class="pull-right"><?php echo $course_details['user_trainee_id']; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($course_marks)) { ?>

            <div class="box box-success">
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
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>Pass Marks for NoS<br>(%)</strong></td>
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
                        foreach ($course_marks as $key => $nos) {
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
                                    <td id="nosTotalMarks" rowspan="<?php echo count($course_marks); ?>" style="vertical-align : middle;text-align:center;"><?php echo $nos['total_marks']; ?></td>
                                    <td id="nosPassMarks" rowspan="<?php echo count($course_marks); ?>" style="vertical-align : middle;text-align:center;"><?php echo $nos['total_pass_marks']; ?></td>
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

            <?php echo form_open('admin/assessment/assessor/batch/upload_marks/' . md5($course_details['assessment_trainee_id_pk'])) ?>

            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload Trainee Marks</h3>
                    <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">

                    <input type="hidden" name="batchIdPk" id="batchIdPk" value="<?php echo $course_details['assessment_batch_id_pk']; ?>">
                    <input type="hidden" name="traineeIdPk" id="traineeIdPk" value="<?php echo $course_details['assessment_trainee_id_pk']; ?>">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NoS Name/Code</th>
                                <th>Theory Marks</th>
                                <th>Practical Marks</th>
                                <th>Viva Marks</th>
                                <th>Total Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0;
                            foreach ($course_marks as $key => $nos) { ?>

                                <tr id="<?php md5($nos['course_marks_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $nos['nos_name']; ?> / <?php echo $nos['nos_code']; ?></td>
                                    <td>
                                        <input type="number" class="form-control inputTheoryMarks" name="theory_marks[<?php echo $nos['course_marks_id_pk']; ?>]" placeholder="Enter Theory Marks" value="<?php echo $theory_marks[$nos['course_marks_id_pk']]; ?>">

                                        <?php echo form_error('theory_marks[' . $nos['course_marks_id_pk'] . ']'); ?>

                                        <input type="hidden" name="nos_theory_marks[<?php echo $nos['course_marks_id_pk']; ?>]" value="<?php echo $nos['nos_theory_marks']; ?>">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control inputPracticalMarks" name="practical_marks[<?php echo $nos['course_marks_id_pk']; ?>]" placeholder="Enter Practical Marks" value="<?php echo $practical_marks[$nos['course_marks_id_pk']]; ?>">

                                        <?php echo form_error('practical_marks[' . $nos['course_marks_id_pk'] . ']'); ?>

                                        <input type="hidden" name="nos_practical_marks[<?php echo $nos['course_marks_id_pk']; ?>]" value="<?php echo $nos['nos_practical_marks']; ?>">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control inputVivaMarks" name="viva_marks[<?php echo $nos['course_marks_id_pk']; ?>]" placeholder="Enter Viva Marks" <?php echo ($nos['nos_viva_marks'] == 0 || $nos['nos_viva_marks'] == NULL) ? 'readonly="true"' : '' ?> value="<?php echo $viva_marks[$nos['course_marks_id_pk']]; ?>">

                                        <?php echo form_error('viva_marks[' . $nos['course_marks_id_pk'] . ']'); ?>

                                        <input type="hidden" name="nos_viva_marks[<?php echo $nos['course_marks_id_pk']; ?>]" value="<?php echo $nos['nos_viva_marks']; ?>">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control inputTotalMarks" name="total_marks[<?php echo $nos['course_marks_id_pk']; ?>]" placeholder="Total Marks" readonly="true" value="<?php echo $total_marks[$nos['course_marks_id_pk']]; ?>">
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                </div>
                <div class="box-footer">
                    <?php if ($course_details['flag_finalize_assessment'] != 2) { ?>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-block btn-info">Save Trainee Marks</button>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="progress-group">
                                <span class="progress-text">Total Marks</span>
                                <span class="progress-number"><b class="traineeObtainedMarks">0</b>/<?php echo $nos['total_marks']; ?></span>

                                <div class="progress sm">
                                    <div class="progress-bar progress-bar-green" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <?php echo form_close(); ?>
        <?php } ?>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>