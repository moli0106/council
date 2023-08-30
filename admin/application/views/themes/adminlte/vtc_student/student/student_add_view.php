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

    .content-block {
        border: 4px solid #43A047;
        border-radius: 10px;
        border-top: none;
        border-bottom: none;
        padding: 5px 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        background-color: #ECEFF1;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="cssvse/student"><i class="fa fa-list"></i> Student List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Add Student</li>
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
                <h3 class="box-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Student</h3>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                <?php echo form_open_multipart("admin/cssvse/student/add"); ?>

                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Basic Details:</strong></h4>
                <div class="content-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('salutation') != '') ? 'has-error' : ''; ?>">
                                <label for="salutation">Salutation <span class="text-danger">*<span></label>
                                <select class="form-control" id="salutation" name="salutation">
                                    <option value="" hidden="true">Select Salutation</option>
                                    <?php foreach ($salutationList as $key => $value) { ?>
                                        <option value="<?php echo $value['salutation_id_pk']; ?>" <?php echo set_select('salutation', $value['salutation_id_pk']) ?>>
                                            <?php echo $value['salutation_desc']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('salutation'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('stdFirstName') != '') ? 'has-error' : ''; ?>">
                                <label for="stdFirstName">Student First Name <span class="text-danger">*</span></label>
                                <input id="stdFirstName" name="stdFirstName" class="form-control" value="<?php echo set_value('stdFirstName'); ?>">
                                <?php echo form_error('stdFirstName'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('stdMidName') != '') ? 'has-error' : ''; ?>">
                                <label for="stdMidName">Student Middle Name</label>
                                <input id="stdMidName" name="stdMidName" class="form-control" value="<?php echo set_value('stdMidName'); ?>">
                                <?php echo form_error('stdMidName'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('stdLastName') != '') ? 'has-error' : ''; ?>">
                                <label for="stdLastName">Student Last Name <span class="text-danger">*</span></label>
                                <input id="stdLastName" name="stdLastName" class="form-control" value="<?php echo set_value('stdLastName'); ?>">
                                <?php echo form_error('stdLastName'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('stdMotherName') != '') ? 'has-error' : ''; ?>">
                                <label for="stdMotherName">Mother's Name</label>
                                <input id="stdMotherName" name="stdMotherName" class="form-control" value="<?php echo set_value('stdMotherName'); ?>">
                                <?php echo form_error('stdMotherName'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('guardianName') != '') ? 'has-error' : ''; ?>">
                                <label for="guardianName">Student Guardian Name <span class="text-danger">*</span></label>
                                <input id="guardianName" name="guardianName" class="form-control" value="<?php echo set_value('guardianName'); ?>">
                                <?php echo form_error('guardianName'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('gender') != '') ? 'has-error' : ''; ?>">
                                <label for="tp">Gender <span class="text-danger">*<span></label>
                                <select class="form-control select2 select2-hidden-accessible" id="gender" name="gender" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off">
                                    <option value="" hidden="true">Select Gender</option>
                                    <?php foreach ($genderList as $key => $value) { ?>
                                        <option value="<?php echo $value['gender_id_pk']; ?>" <?php echo set_select('gender', $value['gender_id_pk']) ?>>
                                            <?php echo $value['gender_description']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('gender'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('dob') != '') ? 'has-error' : ''; ?>">
                                <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control pull-left calender_date" id="std-datepicker" name="dob" placeholder="dd/mm/yyyy" readonly="true" value="<?php echo set_value('stdFirstName'); ?>">
                                </div>
                                <?php echo form_error('dob'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('guardianRelation') != '') ? 'has-error' : ''; ?>">
                                <label for="guardianRelation">Student Relationship with Guardian <span class="text-danger">*</span></label>
                                <input id="guardianRelation" name="guardianRelation" class="form-control" value="<?php echo set_value('guardianRelation'); ?>">
                                <?php echo form_error('guardianRelation'); ?>
                            </div>
                        </div> -->
                        <!-- <div class=" col-md-3">
                            <div class="form-group <?php echo (form_error('stdCaste') != '') ? 'has-error' : ''; ?>">
                                <label for="stdCaste">Student Caste</label>
                                <input id="stdCaste" name="stdCaste" class="form-control" value="<?php echo set_value('stdCaste'); ?>">
                                <?php echo form_error('stdCaste'); ?>
                            </div>
                        </div> -->
                        <!--  <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('stdReligion') != '') ? 'has-error' : ''; ?>">
                                <label for="stdReligion">Student Religion <span class="text-danger">*</span></label>
                                <input id="stdReligion" name="stdReligion" class="form-control" value="<?php echo set_value('stdReligion'); ?>">
                                <?php echo form_error('stdReligion'); ?>
                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('stdMobile') != '') ? 'has-error' : ''; ?>">
                                <label for="stdMobile">Mobile Number</label>
                                <input id="stdMobile" name="stdMobile" class="form-control" type="number" value="<?php echo $form_data['stdMobile']; ?>">
                                <?php echo form_error('stdMobile'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('stdEmail') != '') ? 'has-error' : ''; ?>">
                                <label for="stdEmail">Email Id</label>
                                <input id="stdEmail" name="stdEmail" class="form-control" value="<?php echo $form_data['stdEmail']; ?>">
                                <?php echo form_error('stdEmail'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('state') != '') ? 'has-error' : ''; ?>">
                                <label for="state">State</label>
                                <select name="state" id="state" class="form-control <?php echo (form_error('state') != '') ? 'is-invalid' : ''; ?>">
                                    <option value="" hidden="true">Select State</option>
                                    <option value="19" selected="true">West Bengal</option>
                                </select>
                                <?php echo form_error('state'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('district') != '') ? 'has-error' : ''; ?>">
                                <label for="district">District</label>
                                <select name="district" id="district" class="form-control districtVal <?php echo (form_error('district') != '') ? 'is-invalid' : ''; ?>">
                                    <option value="" hidden="true">Select District</option>
                                    <?php foreach ($districtList as $key => $value) { ?>
                                        <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($form_data['district'] == $value['district_id_pk']) echo 'selected'; ?>>
                                            <?php echo $value['district_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('district'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('municipality') != '') ? 'has-error' : ''; ?>">
                                <label for="municipality">Block / Municipality / Corporation</label>
                                <select name="municipality" id="municipality" class="form-control <?php echo (form_error('municipality') != '') ? 'is-invalid' : ''; ?>">
                                    <option value="" hidden="true">Select Block / Municipality / Corporation</option>
                                    <?php if (!empty($municipality)) { ?>
                                        <?php foreach ($municipality as $key => $value) { ?>
                                            <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($form_data['municipality'] == $value['block_municipality_id_pk']) echo 'selected'; ?>>
                                                <?php echo $value['block_municipality_name']; ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled="true">Select Sub District first...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('municipality'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('pinNo') != '') ? 'has-error' : ''; ?>">
                                <label for="pinNo">Pin Code</label>
                                <input type="number" id="pinNo" name="pinNo" class="form-control" value="<?php echo $form_data['pinNo']; ?>">
                                <?php echo form_error('pinNo'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo (form_error('student_image') != '') ? 'has-error' : ''; ?>">
                                <label class="" for="student_image">
                                    Upload Student Image <small>(image should be – jpg/jpeg 100 KB)</small> <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            Browse&hellip;<input type="file" style="display: none;" name="student_image" id="student_image">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                    <?php echo form_error('student_image'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group <?php echo (form_error('address') != '') ? 'has-error' : ''; ?>">
                                <label for="address">Student Address</label>
                                <textarea class="form-control <?php echo (form_error('address') != '') ? 'is-invalid' : ''; ?>" name="address" id="address" rows="3"><?php echo $form_data['address']; ?></textarea>
                                <?php echo form_error('address'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Academic Details:</strong></h4>
                <div class="content-block">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group <?php echo (form_error('assessmentYear') != '') ? 'has-error' : ''; ?>">
                                <label for="assessmentYear">Assessment Year <span class="text-danger">*</span></label>
                                <input name="assessmentYear" class="form-control" value="<?php echo date('Y'); ?>" readonly>
                                <?php echo form_error('assessmentYear'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group <?php echo (form_error('regNumber') != '') ? 'has-error' : ''; ?>">
                                <label for="regNumber">Registration Number <span class="text-danger">*<span></label>
                                <input id="regNumber" name="regNumber" class="form-control" value="<?php echo set_value('regNumber'); ?>">
                                <?php echo form_error('regNumber'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group <?php echo (form_error('class_id') != '') ? 'has-error' : ''; ?>">
                                <label for="class_id">Class <span class="text-danger">*</span></label>
                                <select name="class_id" id="class_id" class="form-control <?php echo (form_error('class_id') != '') ? 'is-invalid' : ''; ?>">
                                    <option value="" hidden="true">Select Class</option>
                                    <?php foreach ($classList as $key => $value) { ?>
                                        <option value="<?php echo $value['class_id_pk']; ?>" <?php echo set_select('class_id', $value['class_id_pk']) ?>>
                                            <?php echo $value['class_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('class_id'); ?>
                            </div>
                        </div>
                        <!--  <div class="col-md-3">
                            <div class="form-group <?php echo (form_error('attPercentage') != '') ? 'has-error' : ''; ?>">
                                <label for="attPercentage">Attendance Percentage <span class="text-danger">*</span></label>
                                <input id="attPercentage" name="attPercentage" class="form-control" type="number" value="<?php echo set_value('attPercentage'); ?>">
                                <?php echo form_error('attPercentage'); ?>
                            </div>
                        </div> -->
                    </div>
                </div>

                <hr>
                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Course Details:</strong></h4>
                <div class="content-block">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group <?php echo (form_error('stdSector') != '') ? 'has-error' : ''; ?>">
                                <label for="stdSector">Sector <span class="text-danger">*</span></label>
                                <select name="stdSector" id="stdSector" class="form-control <?php echo (form_error('stdSector') != '') ? 'is-invalid' : ''; ?>">
                                    <option value="" hidden="true">Select Sector</option>
                                    <?php foreach ($sectorList as $key => $value) { ?>
                                        <option value="<?php echo $value['sector_id_pk']; ?>" <?php echo set_select('stdSector', $value['sector_id_pk']) ?>>
                                            <?php echo $value['sector_name']; ?> [<?php echo $value['sector_code']; ?>]
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('stdSector'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group <?php echo (form_error('stdCourse') != '') ? 'has-error' : ''; ?>">
                                <label for="stdCourse">Course <span class="text-danger">*</span></label>
                                <select name="stdCourse" id="stdCourse" class="form-control">
                                    <option value="" hidden="true">Select Course</option>
                                    <?php if (!empty($courseList)) { ?>
                                        <?php foreach ($courseList as $key => $value) { ?>
                                            <option value="<?php echo $value['course_id_pk']; ?>" <?php echo set_select('stdCourse', $value['course_id_pk']); ?>>
                                                <?php echo $value['course_name']; ?> [<?php echo $value['course_code']; ?>]
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled="true">Select Sector first...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('stdCourse'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group <?php echo (form_error('courseDuration') != '') ? 'has-error' : ''; ?>">
                                <label for="courseDuration">Duration of the Course <small>(in hrs)</small><span class="text-danger">*</span></label>
                                <select name="courseDuration" id="courseDuration" class="form-control">
                                    <option value="" hidden="true">Select Course Duration</option>
                                    <option value="200" <?php echo set_select('courseDuration', 200); ?>>200</option>
                                    <option value="300" <?php echo set_select('courseDuration', 300); ?>>300</option>
                                </select>
                                <?php echo form_error('courseDuration'); ?>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group <?php echo (form_error('courseDesp') != '') ? 'has-error' : ''; ?>">
                                <label for="courseDesp">Description of the Course</label>
                                <textarea class="form-control <?php echo (form_error('courseDesp') != '') ? 'is-invalid' : ''; ?>" name="courseDesp" id="courseDesp" rows="2"><?php echo set_value('courseDesp'); ?></textarea>
                                <?php echo form_error('courseDesp'); ?>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
					<?php if($school_reg_id_pk == 3964){?>
                        <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Add Student</button>
					<?php }?>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>

        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>