<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i>Student Details</li>
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
                <h3 class="box-title">Curent Year Student Details</h3>
            </div>
            <?php if (!empty($vtcCourseList)) { ?>
                <div class="box-body">

                    <?php if (empty($studentCountDetails)) { ?>
                        <?php echo form_open('admin/affiliation/students/add') ?>
                    <?php } else if ($vtcDetails['final_submit_status'] == 0) { ?>
                        <?php echo form_open('admin/affiliation/students/update') ?>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                <!-- <label class="" for="running_year">VTC Running Since Year <span class="text-danger">*</span></label> -->
                                <label class="" for="running_year">VTC Student Count For The Year <span class="text-danger">*</span></label>
                                <select class="form-control" name="running_year" id="running_year">
                                    <option value="" hidden="true">Select Year</option>
                                    <?php for ($i = 2005; $i <= date('Y'); $i++) { ?>
                                        <?php
                                        if ($i == date('Y')) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = 'disabled';
                                        }
                                        ?>
                                        <option value="<?php echo $i; ?>" <?php echo $selected; ?>>
                                            <?php echo $i; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <?php if (!empty($vtc_hs_courseList)) { ?>
                            <div class="col-md-6 <?php if (empty($vtc_stc_courseList)) echo 'col-md-offset-3'; ?>">
                                <div class="text-center">
                                    <span class="btn bg-navy btn-flat margin">
                                        <i class="fa fa-book margin-r-5"></i> HS-Voc Course List
                                    </span>
                                </div>
                                <hr>
                                <div class="well well-sm no-shadow">
                                    <?php foreach ($vtc_hs_courseList as $key => $courseList) { ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="" for="hs_course_id">Course Of The Year <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="hs_course_id[]" id="hs_course_id">
                                                        <option value="<?php echo $courseList['course_id_pk']; ?>" selected>
                                                            <?php echo $courseList['group_name']; ?>
                                                            [<?php echo $courseList['group_code']; ?>]
                                                        </option>
                                                    </select>
                                                    <?php echo form_error('hs_course_id[' . $key . ']'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <label class="" for="hs_enrolled_student">Enrolled Student <span class="text-danger">*</span></label> -->
                                                    <label class="" for="hs_enrolled_student">Enrolled student in Class XI <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="hs_enrolled_student[]" id="hs_enrolled_student" placeholder="No of Student" value="<?php echo $hs_enrolled_student[$key]; ?>">
                                                    <?php echo form_error('hs_enrolled_student[' . $key . ']'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($vtc_stc_courseList)) { ?>
                            <div class="col-md-6 <?php if (empty($vtc_hs_courseList)) echo 'col-md-offset-3'; ?>">
                                <div class="text-center">
                                    <span class="btn bg-navy btn-flat margin">
                                        <i class="fa fa-book margin-r-5"></i> VIII+ STC Course List
                                    </span>
                                </div>
                                <hr>
                                <div class="well well-sm no-shadow">
                                    <?php foreach ($vtc_stc_courseList as $key => $courseList) { ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="" for="stc_course_id">Course Of The Year <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="stc_course_id[]" id="stc_course_id">
                                                        <option value="<?php echo $courseList['course_id_pk']; ?>" selected>
                                                            <?php echo $courseList['group_name']; ?>
                                                            [<?php echo $courseList['group_code']; ?>]
                                                        </option>
                                                    </select>
                                                    <?php echo form_error('stc_course_id[' . $key . ']'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <label class="" for="stc_enrolled_student">Enrolled Student <span class="text-danger">*</span></label> -->
                                                    <label class="" for="stc_enrolled_student">Enrolled Student For New Batch <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="stc_enrolled_student[]" id="stc_enrolled_student" placeholder="No of Student" value="<?php echo $stc_enrolled_student[$key]; ?>">
                                                    <?php echo form_error('stc_enrolled_student[' . $key . ']'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                    <?php if (empty($studentCountDetails)) { ?>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-sm btn-block">Submit Curent Year Student Data</button>
                            </div>
                        </div>
                    <?php } else if ($vtcDetails['final_submit_status'] == 0 || $vtcDetails['second_final_submit_status'] == 1) { ?>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-sm btn-block">Update Curent Year Student Data</button>
                            </div>
                        </div>
                    <?php } ?>
                    <?php echo form_close() ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Courses is not added for academic year <span class="label label-success"><?php echo $academic_year; ?></span>
                </div>
            <?php } ?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>