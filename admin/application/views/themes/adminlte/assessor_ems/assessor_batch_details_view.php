<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Aassessor Result</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-file-text-o"></i> Assessor EMS</li>
            <li><a href="assessor_ems/assessor_batch"><i class="fa fa-users"></i> Assessor Batch List</a></li>
            <li class="active"><i class="fa fa-users"></i> Assessor List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Batch Details</h3>
                <div class="box-tools pull-right">
                    <!-- Statement -->
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3"><strong>Batch Type:</strong></div>
                    <div class="col-md-3">
                        <?php
                        echo ($batchDetails[0]['batch_type'] == 1) ? 'Domain' : 'Platform';
                        ?>
                    </div>
                    <div class="col-md-3"><strong>Assessment Mode:</strong></div>
                    <div class="col-md-3">
                        <?php
                        echo ($batchDetails[0]['assment_mode'] == 1) ? 'Online' : 'Offline';
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Date :</strong></div>
                    <div class="col-md-3"> <?php echo date('d-m-Y', strtotime($batchDetails[0]['start_date'])) . ' <i>to</i> ' . date('d-m-Y', strtotime($batchDetails[0]['end_date'])); ?></div>
                    <div class="col-md-3"><strong>Time :</strong></div>
                    <div class="col-md-3"> <?php echo $batchDetails[0]['start_time'] . ' <i>to</i> ' . $batchDetails[0]['end_time']; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Trainer :</strong></div>
                    <div class="col-md-3"> <?php echo $batchDetails[0]['f_name'] . ' ' . $batchDetails[0]['l_name']  ?></div>
                    <div class="col-md-3"><strong>Sector :</strong></div>
                    <div class="col-md-3"><?php echo ($batchDetails[0]['sector_name']) ? $batchDetails[0]['sector_name'] : '--'; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Job Role :</strong></div>
                    <div class="col-md-9"> <?php echo ($batchDetails[0]['course_name']) ? $batchDetails[0]['course_name'] : '--'; ?></div>
                </div>
				<?php if($batchDetails[0]['exam_date_time_status']==1){?>
                <div class="row">
                    <div class="col-md-3"><strong>Exam Date :</strong></div>
                    <div class="col-md-3"> <?php echo date('d-m-Y', strtotime($batchDetails[0]['batch_exam_date'])); ?></div>
                    <div class="col-md-3"><strong>Exam Time :</strong></div>
                    <div class="col-md-3"> <?php echo $batchDetails[0]['batch_exam_time']; ?></div>
                </div>
                <?php }?>
            </div>
        </div>
		
		<?php if (($batchDetails[0]['batch_type'] == 2) && ($batchDetails[0]['eval_marks_status'] == 0)) { ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        Continuous Evaluation Marks not uploaded yet!
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor Result List</h3>
                <div class="box-tools pull-right">
                    <!-- Statement -->
                </div>
            </div>
            <div class="box-body">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php $count = 1;
                    foreach ($assessorList as $key => $assessor) {

                        if ($assessor['exam_status'] > 0) {
                            if ($assessor['marks'] >= 50) {
                                if ($batchDetails[0]['batch_type'] == 2) {
                                    if ($assessor['con_eval_marks'] >= 25) {
                                        $result_status = '<span class="badge bg-green">Pass</span>';
                                        $panel_class = 'panel-success';
                                        $list_class  = 'list-group-item-success';
                                    } else {
                                        $result_status = '<span class="badge bg-red">Fail</span>';
                                        $panel_class = 'panel-danger';
                                        $list_class  = 'list-group-item-danger';
                                    }
                                } else {
                                    $result_status = '<span class="badge bg-green">Pass</span>';
                                    $panel_class = 'panel-success';
                                    $list_class  = 'list-group-item-success';
                                }
                            } else {
                                $result_status = '<span class="badge bg-red">Fail</span>';
                                $panel_class = 'panel-danger';
                                $list_class  = 'list-group-item-danger';
                            }
                        } else {
                            $result_status = '<span class="badge bg-orange">Not Appear</span>';
                            $panel_class = 'panel-warning';
                            $list_class  = 'list-group-item-warning';
                        }
                    ?>
                        <div class="panel <?php echo $panel_class; ?>">
                            <div class="panel-heading" role="tab" id="<?php echo md5($assessor['assessor_id_fk']); ?>_<?php echo $count; ?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo md5($assessor['assessor_id_fk']); ?>_<?php echo ++$count; ?>" aria-expanded="true" aria-controls="<?php echo md5($assessor['assessor_id_fk']); ?>_<?php echo $count; ?>">
                                        <?php echo $assessor['fname'] . ' ' . $assessor['mname'] . ' ' . $assessor['lname']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?php echo md5($assessor['assessor_id_fk']); ?>_<?php echo $count; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo md5($assessor['assessor_id_fk']); ?>_<?php echo --$count; ?>">
                                <div class="panel-body">
                                    <?php $count += 2; ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                <li class="list-group-item <?php echo $list_class; ?>">
                                                    <strong>Assessor Details</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Name : </strong>
                                                    <?php echo $assessor['fname'] . ' ' . $assessor['lname']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Mobile : </strong>
                                                    <?php echo $assessor['mobile_no']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessor Email : </strong>
                                                    <?php echo $assessor['email_id']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Exam Status : </strong>
                                                    <?php if ($assessor['exam_status'] == 2) {

                                                        echo '<span class="badge bg-green">Appear</span>';
                                                    } else if ($assessor['exam_status'] == 1) {

                                                        echo '<span class="badge bg-maroon">Abnormally Exist</span>';
                                                    } else {

                                                        echo '<span class="badge bg-orange">Not Appear</span>';
                                                    } ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                <li class="list-group-item <?php echo $list_class; ?>">
                                                    <strong>Marks Details</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Total Number of Questions : </strong>
                                                    <?php echo $assessor['total_question']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Number of Attempted Questions : </strong>
                                                    <?php echo $assessor['question_attempt']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Number of Correct Answer : </strong>
                                                    <?php echo $assessor['correct_answer']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Marks Obtained in Exam : </strong>
                                                    <?php echo $assessor['marks']; ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <ul class="list-group">
                                                <li class="list-group-item <?php echo $list_class; ?>">
                                                    <strong>Marks Details</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Percentage : </strong>
                                                    <?php
                                                    if ($assessor['percentage'] != NULL) {
                                                        echo $assessor['percentage'] . ' %';
                                                    }
                                                    ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Continuous Evaluation Marks : </strong>
                                                    <?php echo $assessor['con_eval_marks']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Over all Marks : </strong>
                                                    <?php
                                                    $con_eval_marks = ($assessor['con_eval_marks'] != NULL) ? $assessor['con_eval_marks'] : 0;
                                                    echo ($con_eval_marks + $assessor['marks']);
                                                    ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Result Status : </strong>
                                                    <?php echo $result_status; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>