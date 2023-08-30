<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .profile-user-img {
        margin: 0 auto;
        width: 30px;
        padding: 0px;
        border: 0px solid #d2d6de;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="assessment/assessor/batch"><i class="fa fa-align-center"></i>Assessment Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Trainee List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <?php if (($tranee_list[0]['flag_trainee_attendance_captured'] != 1) && ($batch_type == 'PBSSD')) { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i>Warning!</h4>
                Trainee attendance not captured, Please contact Council Admin.
            </div>
        <?php } ?>

        <?php if ($tranee_list[0]['flag_batch_marks_status'] == 1) { ?>
            <div class="alert alert-success alert-dismissible">
                <h4>
                    <i class="icon fa fa-check"></i>
                    Success!
                    <span class="label label-info"><?php echo date('d-m-Y', strtotime($tranee_list[0]['batch_marks_status_updated_date'])); ?></span>
                </h4>
                Trainee Marks Accepted by Council Admin.
                <p><?php echo $tranee_list[0]['batch_marks_status_comment']; ?></p>
            </div>
        <?php } elseif ($tranee_list[0]['flag_batch_marks_status'] == 2) { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4>
                    <i class="icon fa fa-warning"></i>
                    Warning!
                    <span class="label label-info"><?php echo date('d-m-Y', strtotime($tranee_list[0]['batch_marks_status_updated_date'])); ?></span>
                </h4>
                Trainee Marks Declined by Council Admin.
                <p><?php echo $tranee_list[0]['batch_marks_status_comment']; ?></p>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Trainee List</h3>
                <div class="box-tools pull-right">
                    <?php if (($batch_type == 'ORG') || ($batch_type == 'CSSVSE')) { ?>
                        <a href="<?php echo base_url('admin/assessment/assessor/batch/view_trainee_marks/' . md5($tranee_list[0]['assessment_batch_id_fk'])); ?>" class="btn btn-success btn-sm">View Trainee Marks</a>
                    <?php } elseif (($tranee_list[0]['flag_trainee_attendance_captured'] == 1)) { ?>
                        <a href="<?php echo base_url('admin/assessment/assessor/batch/view_trainee_marks/' . md5($tranee_list[0]['assessment_batch_id_fk'])); ?>" class="btn btn-success btn-sm">View Trainee Marks</a>
                    <?php } ?>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Trainee Name</th>
                            <th>Council Code</th>
                            <th>User Code</th>
                            <th>Mobile No.</th>
                            <!-- <th>State</th> -->
                            <th>District</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php $count = 0;
                        $all_trainee_marks_uploaded = 1;
                        foreach ($tranee_list as $key => $trainee) { ?>

                            <tr id="<?php echo md5($trainee['assessment_trainee_id_pk']); ?>">
                                <td><?php echo ++$count; ?>.</td>
                                <td>
                                    <?php if ($trainee['trainee_image'] != NULL) { ?>
                                        <img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64, <?php echo $trainee['trainee_image']; ?>" alt="Trainee Picture">
                                    <?php } else { ?>
                                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('admin/themes/adminlte/assets/image/user-profile.png'); ?>" alt="Trainee Picture">
                                    <?php } ?>
                                </td>
                                <td><?php echo $trainee['trainee_full_name']; ?></td>
                                <td><?php echo $trainee['council_trainee_code']; ?></td>
                                <td><?php echo $trainee['user_trainee_id']; ?></td>
                                <td><?php echo $trainee['trainee_mobile_no']; ?></td>
                                <!-- <td><?php echo $trainee['trainee_state_name']; ?></td> -->
                                <td><?php echo $trainee['trainee_district_name']; ?></td>
                                <td>
                                    <?php if (($trainee['trainee_in_time'] != '') || ($trainee['exam_result'] != '')) { ?>

                                        <?php if ($trainee['exam_result'] == 1) { ?>
                                            <span class="badge bg-green">Pass</span>
                                        <?php } else if ($trainee['exam_result'] == 2) { ?>
                                            <span class="badge bg-red">Fail</span>
                                        <?php } else if ($trainee['exam_result'] == 3) { ?>
                                            <span class="badge bg-orange">Absent</span>
                                        <?php } else { ?>
                                            <span class="badge bg-orange">N/A</span>
                                        <?php } ?>

                                    <?php } elseif ($trainee['flag_trainee_attendance_captured'] != 1) { ?>
                                        <span class="badge bg-orange">N/A</span>
                                    <?php } else { ?>
                                        <span class="badge bg-blue">Absent</span>
                                    <?php } ?>
                                </td>
                                <td align="center">
                                    <?php if (($trainee['flag_trainee_attendance_captured'] == 1)) { ?>
                                        <?php if ($trainee['trainee_in_time'] != '') { ?>
                                            <?php if ($trainee['total_marks'] != '') { ?>
                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/upload_marks/' . md5($trainee['assessment_trainee_id_pk'])); ?>" class="btn btn-info btn-xs btn-block">View Marks</a>
                                            <?php } else { ?>
                                                <?php $all_trainee_marks_uploaded = 0; ?>
                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/upload_marks/' . md5($trainee['assessment_trainee_id_pk'])); ?>" class="btn btn-success btn-xs btn-block">Upload Marks</a>
                                            <?php } ?>

                                            <?php if ($trainee['trainee_image'] == NULL) { ?>
                                                <!--<button class="btn btn-block bg-navy btn-xs btn-flat upload-trainee-image" data-toggle="modal" data-target="#modal-trainee-profile-image">Upload Photo</button>-->
                                            <?php } ?>
                                        <?php } else {
                                            echo '--';
                                        } ?>
                                    <?php } elseif (($batch_type == 'ORG') || ($batch_type == 'CSSVSE')) { ?>
                                        <?php if ($trainee['proposed_assessment_date'] < date('Y-m-d')) { ?>
                                            <?php if ($trainee['total_marks'] != '') { ?>
                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/upload_marks/' . md5($trainee['assessment_trainee_id_pk'])); ?>" class="btn btn-info btn-xs btn-block">View Marks</a>
                                            <?php } else { ?>
                                                <?php $all_trainee_marks_uploaded = 0; ?>
                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/upload_marks/' . md5($trainee['assessment_trainee_id_pk'])); ?>" class="btn btn-success btn-xs btn-block">Upload Marks</a>
                                            <?php } ?>

                                            <?php if ($trainee['trainee_image'] == NULL) { ?>
                                                <!-- <button class="btn btn-block bg-navy btn-xs btn-flat upload-trainee-image" data-toggle="modal" data-target="#modal-trainee-profile-image">Upload Photo</button> -->
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php $all_trainee_marks_uploaded = 0; ?>
                                            "You can upload the marks <br> after one day of assessment.
                                        <?php } ?>
                                    <?php } else {
                                        echo '--';
                                    } ?>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if (($all_trainee_marks_uploaded == 1) && ($tranee_list[0]['flag_finalize_assessment'] != 2)) { ?>
                <div class="box-footer">
                    <?php echo form_open_multipart('admin/assessment/assessor/batch/finalize_marks/' . $map_id_hash) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Trainee Marks Doc. (Only PDF file within 500 KB)</span>
                                <input type="file" class="form-control" name="assessment_doc" id="assessment_doc">
                            </div>
                            <?php echo form_error('assessment_doc'); ?>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Trainee Attendance Doc. (Only PDF file within 500 KB)</span>
                                <input type="file" class="form-control" name="attendance_doc" id="attendance_doc">
                            </div>
                            <?php echo form_error('attendance_doc'); ?>
                        </div>
                        <div class="col-md-4 col-md-offset-4" style="padding: 10px 10px;">
                            <button type="submit" class="btn btn-success btn-block">Final Submit Marks</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            <?php } ?>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>