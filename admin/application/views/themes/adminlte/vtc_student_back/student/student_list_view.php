<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .modal-lg {
        width: 80% !important;
    }

    .users-list li {
        border-radius: 5px;
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    .users-list li:hover {
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Student List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>

            <?php echo $this->session->flashdata('validation_errors_list') ?>
        <?php } ?>

        <!-- <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search" aria-hidden="true"></i> Search Student</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/assessment/assessing/batch/'); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Class</b></label>
                            <select name="sector_code" id="sector_code" class="form-control select2">
                                <option value="" hiddden="true">Select Class</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Assessment Year</b></label>
                            <select name="course_code" id="course_code" class="form-control select2">
                                <option value="" hiddden="true">Select Assessment Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Sector Name</b></label>
                            <select name="sector_code" id="sector_code" class="form-control select2">
                                <option value="" hiddden="true">Select Sector</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Course Name</b></label>
                            <select name="course_code" id="course_code" class="form-control select2">
                                <option value="" hiddden="true">Select Course</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Registration Number</b></label>
                            <input type="text" class="form-control" name="reg_number" placeholder="Enter Registration Number" value="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="" for="">&nbsp;</label><br>
                        <button type="submit" class="btn btn-block btn-warning btn-flat">
                            <i class="fa fa-search" aria-hidden="true"></i> Search Assessment Batch
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div> -->

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Student List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/vtc_student/student/add_student') ?>" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Add Student
                    </a>
                </div>
            </div>

            <div class="box-body">
                <ul class="users-list clearfix">
                    <?php if (count($studentList)) { ?>
                        <?php foreach ($studentList as $key => $student) { ?>
                            <li class="get-student-details" id="<?php echo md5($student['student_id_pk']); ?>" style="width: 12.5%;" data-toggle="modal" data-target="#modal-student-details">
                                <?php if (!empty($student['image'])) { ?>
                                    <img src="data:image/jpeg;base64, <?php echo $student['image']; ?>" alt="User Image" style="height: 80px;">
                                <?php } else { ?>
                                    <img src="<?php echo base_url('admin/themes/adminlte/assets/image/user-profile.png'); ?>" alt="User Image" style="height: 80px;">
                                <?php } ?>
                                <a class="users-list-name" href="javascript:void(0);">
                                    <?php echo $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['last_name']; ?>
                                </a>
                                <span class="users-list-date"><i class="fa fa-tags" aria-hidden="true"></i> <?php echo $student['roll_number']; ?></span>
                                <span class="users-list-date"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $student['mobile']; ?></span>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <h4 class="text-center text-danger"><strong>No Data Found...</strong></h4>
                    <?php } ?>
                </ul>
            </div>

            <div class="box-footer"></div>

        </div>

    </section>
</div>

<div class="modal modal-success fade" id="modal-student-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Student Details</h4>
            </div>
            <div class="modal-body student-data-div" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer change-assessor-modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>