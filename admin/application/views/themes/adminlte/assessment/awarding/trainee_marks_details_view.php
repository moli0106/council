<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .width-20 {
        width: 20%;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Trainee Marks List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="assessment/awarding/batch"><i class="fa fa-users"></i> Assessment Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Trainee Marks</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <a href="<?php echo base_url('admin/assessment/awarding/batch/download_assessment_pdf/' . $id_hash); ?>" class="btn btn-sm btn-block btn-flat bg-maroon">
                            <i class="fa fa-download" aria-hidden="true"></i> Download Trainee Marks
                        </a>
                    </div>
                    <div class="col-md-3 text-center">
                        <a href="<?php echo base_url('admin/assessment/awarding/batch/download_trainee_attendance_pdf/' . $id_hash); ?>" class="btn btn-sm btn-block btn-flat bg-navy">
                            <i class="fa fa-download" aria-hidden="true"></i> Download Trainee Attendance
                        </a>
                    </div>
                    <?php if ($tranee_details[0]['flag_batch_marks_status'] != '') { ?>
                        <div class="col-md-6 text-center">
                            <?php if ($tranee_details[0]['flag_batch_marks_status'] == 1) { ?>
                                <span class="label label-success">Trainee Marks Accepted</span>
                            <?php } else { ?>
                                <span class="label label-danger">Trainee Marks Declined</span>
                            <?php } ?>
                            <p><span class="label label-info"><?php echo date('d-m-Y', strtotime($tranee_details[0]['batch_marks_status_updated_date'])); ?></span></p>
                            <p><?php echo $tranee_details[0]['batch_marks_status_comment']; ?></p>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3 text-center">
                            <button type="button" class="btn btn-success btn-sm btn-block btn-flat accept-marks" data-id="<?php echo $id_hash; ?>" data-toggle="modal" data-target="#modal-trainee-marks">
                                <i class="fa fa-check" aria-hidden="true"></i> Accept Trainee Marks
                            </button>
                        </div>
                        <div class="col-md-3 text-center">
                            <button type="button" class="btn btn-danger btn-sm btn-block btn-flat decline-marks" data-id="<?php echo $id_hash; ?>" data-toggle="modal" data-target="#modal-trainee-marks">
                                <i class="fa fa-times" aria-hidden="true"></i> Revert Trainee Marks
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Trainee Result</h3>
            </div>
            <div class="box-body">
                <div class="panel-group" id="accordion">
                    <?php foreach ($tranee_details as $key => $trainee) {

                        // if ($trainee['trainee_in_time'] != '') {
                        if (($trainee['trainee_in_time'] != '') || ($trainee['exam_result'] != '')) {
                            if ($trainee['exam_result'] == 1) {
                                $boxClass = 'panel-success';
                            } else {
                                $boxClass = 'panel-danger';
                            }
                        } else {
                            $boxClass = 'panel-info';
                        }
                    ?>

                        <div class="panel <?php echo $boxClass; ?>">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $trainee['assessment_trainee_id_pk']; ?>">
                                        <?php echo $trainee['trainee_full_name']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="<?php echo $trainee['assessment_trainee_id_pk']; ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li>
                                                    <a>
                                                        Council Trainee Code
                                                        <span class="pull-right text-info"><?php echo $trainee['council_trainee_code']; ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a>
                                                        User Trainee Code
                                                        <span class="pull-right text-info"><?php echo $trainee['user_trainee_id']; ?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-6">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li>
                                                    <a>
                                                        Trainee Mobile Number
                                                        <span class="pull-right text-info"><?php echo $trainee['trainee_mobile_no']; ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a>
                                                        Trainee Email
                                                        <span class="pull-right text-info"><?php echo ($trainee['trainee_email']) ? $trainee['trainee_email'] : '--'; ?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-md-12">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>NoS</th>
                                                        <th>Theory Marks</th>
                                                        <th>Practical Marks</th>
                                                        <th>Viva Marks</th>
                                                        <th>Total Marks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $count = 0;
                                                    foreach ($trainee['tranee_marks'] as $key => $marks) { ?>
                                                        <tr>
                                                            <td><?php echo ++$count; ?>.</td>
                                                            <td><?php echo $marks['nos_name']; ?> [<?php echo $marks['nos_code']; ?>]</td>
                                                            <td><?php echo $marks['theory_marks']; ?></td>
                                                            <td><?php echo $marks['practical_marks']; ?></td>
                                                            <td><?php echo ($marks['viva_marks']) ? $marks['viva_marks'] : '--'; ?></td>
                                                            <td><?php echo $marks['total_marks']; ?></td>
                                                        </tr>
                                                        <!-- <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span> -->
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="4">
                                                            Status :
                                                            <?php if (($trainee['trainee_in_time'] != '') || ($trainee['exam_result'] != '')) { ?>
                                                                <?php if ($trainee['exam_result'] == 1) { ?>
                                                                    <span class="label label-success">Pass</span>
                                                                <?php } else { ?>
                                                                    <span class="label label-danger">Fail</span>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <span class="label label-info">Absent</span>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="pull-right">Total Marks :</td>
                                                        <?php if (($trainee['trainee_in_time'] != '') || ($trainee['exam_result'] != '')) { ?>
                                                            <td><?php echo $trainee['total_marks']; ?> / <?php echo $marks['total_course_marks']; ?></td>
                                                        <?php } else { ?>
                                                            <td>--</td>
                                                        <?php } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
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


<div class="modal modal-success fade" id="modal-trainee-marks" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approve / Revert Trainee Marks</h4>
            </div>
            <div class="modal-body trainee-marks-data" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;">
                <div class="overlay">
                    <div class="sp sp-wave"></div>
                </div>
            </div>
            <div class="modal-footer assign-assessor-modal-footer">
                <button type="button" class="btn btn-outline pull-right close-trainee-marks" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>