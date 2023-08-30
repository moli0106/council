<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Batch List</li>
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
                <h3 class="box-title">Batch Details</h3>
                <div class="box-tools pull-right">
                    <?php if ($batchDetails[0]['batch_question_map_id_pk'] == '' || $batchDetails[0]['batch_question_map_id_pk'] == NULL) { ?>
                        <button id="assignQuestion" data-id="<?php echo $this->uri->segment(4); ?>" class="btn btn-success btn-sm">Assign Question to Batch</button>
                    <?php } ?>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3"><strong>Batch Type</strong></div>
                    <div class="col-md-3">:
                        <?php
                        echo ($batchDetails[0]['batch_type'] == 1) ? 'Domain' : 'Platform';
                        ?>
                    </div>
                    <div class="col-md-3"><strong>Assessment Mode</strong></div>
                    <div class="col-md-3">: <?php
                                            echo ($batchDetails[0]['assment_mode'] == 1) ? 'Online' : 'Offline';
                                            ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Date :</strong></div>
                    <div class="col-md-3">: <?php
                                            echo date('d-m-Y', strtotime($batchDetails[0]['start_date']))
                                                . ' <i>to</i> ' .
                                                date('d-m-Y', strtotime($batchDetails[0]['end_date']));
                                            ?></div>
                    <div class="col-md-3"><strong>Time :</strong></div>
                    <div class="col-md-3">: <?php
                                            echo $batchDetails[0]['start_time']
                                                . ' <i>to</i> ' .
                                                $batchDetails[0]['end_time'];
                                            ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Trainer :</strong></div>
                    <div class="col-md-3">: <?php echo $this->session->userdata('stake_holder_details'); ?></div>
                    <div class="col-md-3"><strong>Sector :</strong></div>
                    <div class="col-md-3">: <?php echo ($batchDetails[0]['sector_name']) ? $batchDetails[0]['sector_name'] : '--'; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Job Role :</strong></div>
                    <div class="col-md-9">: <?php echo ($batchDetails[0]['course_name']) ? $batchDetails[0]['course_name'] : '--'; ?></div>
                </div>
                <?php if ($batchDetails[0]['training_link'] != '') { ?>
                    <div class="row">
                        <div class="col-md-3"><strong>Link for Online Training :</strong></div>
                        <div class="col-md-9">: <?php echo $batchDetails[0]['training_link']; ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php echo form_open('admin/trainer/batch/eligibleForAssessment', array('id' => "eligibleForAssessment")) ?>

        <input type="hidden" name="batch_id_hash" value="<?php echo md5($batchDetails[0]['batch_ems_id_pk']); ?>">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor List</h3>
                <?php //if ($batchDetails[0]['end_date'] >= date('Y-m-d')) { ?>
                    <div class="box-tools pull-right" id="show_eligible_asseessement" <?php if ($batchDetails[0]['batch_question_map_id_pk'] == '' || $batchDetails[0]['batch_question_map_id_pk'] == NULL) {
                                                                                            echo 'style="display:none"';
                                                                                        } ?>>
                        <div class="custom-control custom-checkbox">
                            <label class="custom-control-label" for="check_all">Select All</label>
                            <input type="checkbox" class="custom-control-input" id="check_all">
                            <button type="submit" class="btn btn-info btn-sm">Eligible for Assessment</button>
                        </div>
                    </div>
                <?php //} ?>
            </div>

            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Assessor</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Continuous Evaluation Marks <br><small>(Total Marks 50)</small></th>
                            <th>No. Days Trainee Attends</th>
                            <th>Eligible for Assessment</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php $count = 0;
                        foreach ($assessorList as $key => $assessor) { ?>

                            <tr id="<?php echo md5($assessor['batch_assessor_map_id_pk']); ?>">
                                <td><?php echo ++$count; ?>.</td>
                                <td><?php echo $assessor['fname'] . ' ' . $assessor['lname']; ?></td>
								<?php// echo $assessor['fname'] . ' ' . $assessor['mname']. ' ' . $assessor['lname']; ?>
                                <td><?php echo $assessor['mobile_no']; ?></td>
                                <td><?php echo $assessor['email_id']; ?></td>
                                <td class="text-center">
                                    <?php if ($batchDetails[0]['batch_type'] == 2) { ?>
                                        <?php if ($assessor['exam_status'] != 0) { ?>
                                            <input type="text" class="form-control" name="con_eval_marks[<?php echo $assessor['assessor_id_fk']; ?>]" placeholder="Continuous Evaluation Marks" value="<?php echo $con_eval_marks[$assessor['assessor_id_fk']]; ?>">
                                            <?php echo form_error('con_eval_marks[' . $assessor['assessor_id_fk'] . ']'); ?>
                                        <?php } else {
                                            echo '--';
                                        }
                                        ?>
                                    <?php } else {
                                        echo '--';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($batchDetails[0]['batch_type'] == 2) { ?>
                                        <?php if ($assessor['exam_status'] != 0) { ?>
                                            <input type="text" class="form-control" name="trainee_attends[<?php echo $assessor['assessor_id_fk']; ?>]" placeholder="No. Days Trainee Attends" value="<?php echo $trainee_attends[$assessor['assessor_id_fk']]; ?>">
                                            <?php echo form_error('trainee_attends[' . $assessor['assessor_id_fk'] . ']'); ?>
                                        <?php } else {
                                            echo '--';
                                        }
                                        ?>
                                    <?php } else {
                                        echo '--';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input assessorCheckbox" name="map_id[]" value="<?php echo $assessor['batch_assessor_map_id_pk']; ?>" <?php echo ($assessor['eligibility']) ? "checked" : ""; ?>>
                                        <label class="custom-control-label" for="customCheck1"></label>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>

                    <tfoot>
                        <?php if ($batchDetails[0]['batch_type'] == 2) { ?>
                            <?php if (date('Y-m-d') >= $batchDetails[0]['end_date']) { ?>
                                <?php if ($batchDetails[0]['eval_marks_status'] != 1) { ?>
                                    <tr>
                                        <td colspan="4">*</td>
                                        <td colspan="2" class="text-center">
                                            <button type="button" class="btn btn-success btn-sm" id="UpdateEvaluationMarks">
                                                Update Evaluation Marks & No. of Days
                                            </button>
                                            <button type="submit" name="UpdateEvaluationMarks" id="UpdateEvaluationMarksSubmit" value="1" class="btn btn-success btn-sm" style="display: none;">
                                                Marks Submit
                                            </button>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tfoot>
                </table>
            </div>
        </div>

        <?php echo form_close() ?>

    </section>
</div>



<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white;">Continuous Evaluation Marks & Trainee Attends</h4>
            </div>
            <div class="modal-body continuous_evaluation_marks_content">
                <p>Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>