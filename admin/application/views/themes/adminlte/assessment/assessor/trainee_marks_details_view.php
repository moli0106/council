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
        <h1>Trainee Marks</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="assessment/assessor/batch"><i class="fa fa-users"></i> Assessment Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Trainee Marks Details</li>
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
                <h3 class="box-title">Trainee Marks Details</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/assessment/assessor/batch/download_trainee_marks/' . $batch_id_hash); ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-download"></i> Trainee Marks
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="panel-group" id="accordion">
                    <?php foreach ($tranee_details as $key => $trainee) {

                        if (($trainee['trainee_in_time'] != '') || ($trainee['exam_result'] != '')) {
                            if ($trainee['exam_result'] == 1) {
                                $boxClass = 'panel-success';
                            } elseif ($trainee['exam_result'] == 2) {
                                $boxClass = 'panel-danger';
                            } else {
                                $boxClass = 'panel-default';
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
                                                                <?php } elseif ($trainee['exam_result'] == 2) { ?>
                                                                    <span class="label label-danger">Fail</span>
                                                                <?php } else { ?>
                                                                    <span class="label label-default">--</span>
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
                <h4 class="modal-title">Assign Assessor in Batch</h4>
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