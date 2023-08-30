<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="vtc_student_batch/batch"><i class="fa fa-align-center"></i> Batch List</a></li>
            <li><a href="vtc_student_batch/batch/jobrolelist"><i class="fa fa-align-center"></i> Jobrole List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Create Batch</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <!-- <?php //if ($image_status == 0) { ?>
            <div class="form-group" style="background-color: #FFCDD2; padding: 10px 10px; border-radius: 4px;">
                <input type="checkbox" id="confirmation">
                <label for="html">Photos of Candidates mentioned below could not be uploaded as they are not reachable.!</label>
            </div>
        <?php //} ?> -->

        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>
                                    <small style="font-size: 14px; color: #fff;">Student:</small>
                                    <?php echo count($studentList); ?>
                                </h3>
                                
                            </div>
                            <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                            <?php if ($image_status == 1) { ?>
                                <p>Ready for Batch create</p>
                            <a href="javascript:void(0);" class="small-box-footer" id="create-batch">Create Batch <i class="fa fa-arrow-circle-right"></i></a>
                            <?php } else {?>
                                <span style="color:red; font-size:20px;font-weight: bold;">Please Uploade All Student Image</span>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Batch Details</h3>
                                <div class="box-tools pull-right"></div>
                            </div>
                            <div class="box-body">
                                <?php echo form_open_multipart('admin/organization_batch/batch/create?sid=' . md5($batchDetails['sector_id_fk']) . '&cid=' . md5($batchDetails['course_id_fk']), array('id' => 'create-batch-form')) ?>
                                <input type="hidden" name="school" class="form-control" value="<?php echo md5($batchDetails['institute_id_fk']); ?>">
                                <input type="hidden" name="sector" class="form-control" value="<?php echo md5($batchDetails['sector_id_fk']); ?>">
                                <input type="hidden" name="course" class="form-control" value="<?php echo md5($batchDetails['course_id_fk']); ?>">

                                <div class="form-group">
                                    <label for="">Assessment Year</label>
                                    <input id="" name="assessment_year" class="form-control" value="<?php echo date('Y'); ?>" readonly>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Batch Code</label>
                                    <input id="" name="batch_code" class="form-control" value="<?php //echo $batch_code; ?>" readonly>
                                </div> -->
                                <div class="form-group">
                                    <label for="">Batch Start Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <?php
                                        if (!empty($studentList[0]['batch_start_date'])) {
                                            $batch_start_date = date('d/m/Y', strtotime($studentList[0]['batch_start_date']));
                                        } else {
                                            $batch_start_date = '';
                                        }
                                        ?>
                                        <input class="form-control pull-left calender_date" name="batch_start_date" placeholder="dd/mm/yyyy" readonly="true" value="<?php echo $batch_start_date; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Batch End Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <?php
                                        if (!empty($studentList[0]['batch_end_date'])) {
                                            $batch_end_date = date('d/m/Y', strtotime($studentList[0]['batch_end_date']));
                                        } else {
                                            $batch_end_date = '';
                                        }
                                        ?>
                                        <input class="form-control pull-left calender_date" name="batch_end_date" placeholder="dd/mm/yyyy" readonly="true" value="<?php echo $batch_end_date; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Batch Tentative Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <?php
                                        if (!empty($studentList[0]['batch_tentative_date'])) {
                                            $batch_tentative_date = date('d/m/Y', strtotime($studentList[0]['batch_tentative_date']));
                                        } else {
                                            $batch_tentative_date = '';
                                        }
                                        ?>
                                        <input class="form-control pull-left calender_date" name="batch_tentative_date" placeholder="dd/mm/yyyy" readonly="true" value="<?php echo $batch_tentative_date; ?>">
                                    </div>
                                </div>

                                <hr style="border-top: 2px dashed #29B6F6;">
                                <label for="">Sector: </label>
                                <p><?php echo $batchDetails['sector_name']; ?> <span class="label label-info"><?php echo $batchDetails['sector_code']; ?></span></p>

                                <hr style="border-top: 2px dashed #29B6F6;">
                                <label for="">Jobrole: </label>
                                <p><?php echo $batchDetails['course_name']; ?> <span class="label label-info"><?php echo $batchDetails['course_code']; ?></span></p>

                                <?php echo form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Student List</h3>
                                <div class="box-tools pull-right">
                                    <span class="badge bg-yellow">Total Student: <?php echo count($studentList); ?></span>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Registration Number</th>
                                                <th>Guardian Name</th>
                                                <th>Class</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $image_status = 1; ?>
                                            <?php $count = 0; ?>
                                            <?php if (!empty($studentList)) { ?>
                                                <?php foreach ($studentList as $key => $value) { ?>
                                                    <tr>
                                                        <td><?php echo ++$count; ?></td>
                                                        <td>
                                                            <div class="user-block">
                                                                <?php if (!empty($value['image'])) { ?>
                                                                    <?php $image_status = 0; ?>
                                                                    <img src="data:image/jpeg;base64, <?php echo $value['image']; ?>" alt="User Image" style="height: 40px;">
                                                                <?php } else { ?>
                                                                    <img src="<?php echo base_url('admin/themes/adminlte/assets/image/user-profile.png'); ?>" alt="User Image" style="height: 40px;">
                                                                <?php } ?>
                                                                <span class="username">
                                                                    <a href="javascript: void(0);">
                                                                        <?php echo $value['first_name']; ?>
                                                                        <?php echo $value['middle_name']; ?>
                                                                        <?php echo $value['last_name']; ?>
                                                                    </a>
                                                                </span>
                                                                <span class="description"><?php echo $value['roll_number']; ?></span>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $value['registration_number']; ?></td>
                                                        <td><?php echo $value['guardian_name']; ?></td>
                                                        <td><?php echo $value['class_name']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="7" class="text-center text-danger">No Data Found...</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Registration Number</th>
                                                <th>Guardian Name</th>
                                                <th>Class</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="box-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>