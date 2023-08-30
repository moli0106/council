<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-body box-profile">

                    <?php if (!empty($studentDetails['image'])) { ?>
                        <img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64, <?php echo $studentDetails['image']; ?>" alt="User profile picture">
                    <?php } else { ?>
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('admin/themes/adminlte/assets/image/user-profile.png'); ?>" alt="User profile picture">
                    <?php } ?>

                    <h3 class="profile-username text-center">
                        <?php echo $studentDetails['first_name'] . ' ' . $studentDetails['middle_name'] . '' . $studentDetails['last_name']; ?>
                    </h3>
                    <p class="text-muted text-center">Class <?php echo $studentDetails['class_name']; ?></p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Assessment Year</b> <a class="pull-right"><?php echo $studentDetails['assessment_year']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Registration No.</b> <a class="pull-right"><?php echo $studentDetails['registration_number']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Contact No.</b> <a class="pull-right">
                                <?php echo ($studentDetails['mobile'] != NULL) ? $studentDetails['mobile'] : $school_data['school_mobile']; ?>
                            </a>
                        </li>
                    </ul>

                    <strong class="text-danger"><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                    <p>Student contact details by default set as school contact details. If you want, you can change it.</p>
                </div>
            </div>

            <?php if (($studentDetails['nsqf_level'] == NULL) && ($studentDetails['batch_assigned_status'] == 0)) { ?>
                <div class="text-center">
                    <?php echo form_open("admin/cssvse/student/remove_student", array("id" => "update-student-status")); ?>
                    <input type="hidden" name="student_id" class="std_id_hash" value="<?php echo md5($studentDetails['student_id_pk']); ?>">
                    <button type="button" class="btn btn-danger delete-student"><i class="fa fa-trash-o"></i> Delete</button>
                    <?php echo form_close() ?>
                </div>
            <?php } ?>
        </div>

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#studentInformation" data-toggle="tab">Student Information</a></li>
                    <!-- <li><a href="#activity" data-toggle="tab">Activity</a></li> -->
                    <!-- <li><a href="#batchDetails" data-toggle="tab">Batch Details</a></li> -->
                </ul>
                <div class="tab-content" style="height: 450px; overflow-y: scroll;" id="custom-scrollbar">
                    <div class="active tab-pane" id="studentInformation">

                        <?php echo form_open_multipart("admin/cssvse/student/update", array("id" => "update-student-info-form")); ?>
                        <input type="hidden" name="student_id" value="<?php echo md5($studentDetails['student_id_pk']); ?>">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Assessment Year</th>
                                    <td>
                                        <div class="form-group">
                                            <input name="assessmentYear" class="form-control" value="<?php echo date('Y'); ?>" readonly>
                                        </div>
                                    </td>
                                    <th><i class="fa fa-circle-o text-green"></i> Registration No.</th>
                                    <td>
                                        <div class="form-group">
                                            <input name="regNumber" class="form-control" value="<?php echo $studentDetails['registration_number']; ?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;"><i class="fa fa-circle-o text-green"></i> Student Name</th>
                                    <td style="width: 30%;">
                                        <div class="form-group">
                                            <input class="form-control" value="<?php echo $studentDetails['first_name'] . ' ' . $studentDetails['middle_name'] . '' . $studentDetails['last_name']; ?>" readonly>
                                        </div>
                                    </td>
                                    <th><i class="fa fa-circle-o text-green"></i> Class</th>
                                    <td>
                                        <div class="form-group">
                                            <select name="class_id" id="class_id" class="form-control <?php echo (form_error('class_id') != '') ? 'is-invalid' : ''; ?>">
                                                <option value="" hidden="true">Select Class</option>
                                                <?php foreach ($classList as $key => $value) { ?>
                                                    <option value="<?php echo $value['class_id_pk']; ?>" <?php if ($studentDetails['class_id_fk'] == $value['class_id_pk']) echo 'selected'; ?>>
                                                        <?php echo $value['class_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Mother's Name</th>
                                    <td>
                                        <div class="form-group">
                                            <input name="stdMotherName" class="form-control" value="<?php echo $studentDetails['mothers_name']; ?>">
                                        </div>
                                    </td>
                                    <th><i class="fa fa-circle-o text-green"></i> Guardian Name</th>
                                    <td>
                                        <div class="form-group">
                                            <input name="" class="form-control" value="<?php echo $studentDetails['guardian_name']; ?>" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;"><i class="fa fa-circle-o text-green"></i> Gender</th>
                                    <td style="width: 30%;">
                                        <div class="form-group">
                                            <select class="form-control select2 select2-hidden-accessible" id="gender" name="gender" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off">
                                                <option value="" hidden="true">Select Gender</option>
                                                <?php foreach ($genderList as $key => $value) { ?>
                                                    <option value="<?php echo $value['gender_id_pk']; ?>" <?php if ($studentDetails['gender_id_fk'] == $value['gender_id_pk']) echo 'selected'; ?>>
                                                        <?php echo $value['gender_description']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <th><i class="fa fa-circle-o text-green"></i> Date of Birth</th>
                                    <td>
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control pull-left calender_date" id="std-datepicker" name="dob" readonly="true" value="<?php echo date('d/m/Y', strtotime($studentDetails['date_of_birth'])); ?>">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Mobile Number</th>
                                    <td>
                                        <div class="form-group">
                                            <input name="stdMobile" class="form-control" value="<?php echo ($studentDetails['mobile'] != NULL) ? $studentDetails['mobile'] : $school_data['school_mobile']; ?>">
                                        </div>
                                    </td>
                                    <th><i class="fa fa-circle-o text-green"></i> Email Id</th>
                                    <td>
                                        <div class="form-group">
                                            <input name="stdEmail" class="form-control" value="<?php echo ($studentDetails['email'] != NULL) ? $studentDetails['email'] : $school_data['school_email']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> State</th>
                                    <td>
                                        <div class="form-group">
                                            <select name="state" id="state" class="form-control <?php echo (form_error('state') != '') ? 'is-invalid' : ''; ?>">
                                                <option value="" hidden="true">Select State</option>
                                                <option value="19" selected="true">West Bengal</option>
                                            </select>
                                        </div>
                                    </td>
                                    <th><i class="fa fa-circle-o text-green"></i> <?= $studentDetails['district_id_fk'] ?>District</th>
                                    <td>
                                        <div class="form-group">
                                            <select name="district" id="district" class="form-control districtVal <?php echo (form_error('district') != '') ? 'is-invalid' : ''; ?>">
                                                <option value="" hidden="true">Select District</option>
                                                <?php foreach ($districtList as $key => $value) { ?>
                                                    <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($studentDetails['district_id_fk'] == $value['district_id_pk']) echo 'selected'; ?>>
                                                        <?php echo $value['district_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Block / Municipality</th>
                                    <td>
                                        <div class="form-group">
                                            <select name="municipality" id="municipality" class="form-control <?php echo (form_error('municipality') != '') ? 'is-invalid' : ''; ?>">
                                                <option value="" hidden="true">Select Block / Municipality / Corporation</option>
                                                <?php if (!empty($municipality)) { ?>
                                                    <?php foreach ($municipality as $key => $value) { ?>
                                                        <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($studentDetails['municipality_id_fk'] == $value['block_municipality_id_pk']) echo 'selected'; ?>>
                                                            <?php echo $value['block_municipality_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option value="" disabled="true">Select Sub District first...</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <th><i class="fa fa-circle-o text-green"></i> Pin Code</th>
                                    <td>
                                        <div class="form-group">
                                            <input name="pinNo" class="form-control" value="<?php echo ($studentDetails['pin'] != NULL) ? $studentDetails['pin'] : $school_data['pin_code']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Address </th>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <textarea class="form-control" name="address" rows="1"><?php echo ($studentDetails['address'] != NULL) ? $studentDetails['address'] : $school_data['school_address']; ?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Sector</th>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <select name="stdSector" id="stdSector" class="form-control <?php echo (form_error('stdSector') != '') ? 'is-invalid' : ''; ?>">
                                                <option value="" hidden="true">Select Sector</option>
                                                <?php foreach ($sectorList as $key => $value) { ?>
                                                    <option value="<?php echo $value['sector_id_pk']; ?>" <?php if ($studentDetails['sector_id_fk'] == $value['sector_id_pk']) echo 'selected'; ?>>
                                                        <?php echo $value['sector_name']; ?> [<?php echo $value['sector_code']; ?>]
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Course</th>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <select name="stdCourse" id="stdCourse" class="form-control">
                                                <option value="" hidden="true">Select Course</option>
                                                <?php if (!empty($courseList)) { ?>
                                                    <?php foreach ($courseList as $key => $value) { ?>
                                                        <option value="<?php echo $value['course_id_pk']; ?>" <?php if ($studentDetails['course_id_fk'] == $value['course_id_pk']) echo 'selected'; ?>>
                                                            <?php echo $value['course_name']; ?> [<?php echo $value['course_code']; ?>]
                                                        </option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <option value="" disabled="true">Select Sector first...</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Description</th>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <textarea class="form-control" name="courseDesp" rows="1"><?php echo $studentDetails['course_description']; ?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><i class="fa fa-circle-o text-green"></i> Student Image</th>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <label class="" for="aadhar_no_image">Upload Student Image <br><small>(image should be – jpg/jpeg 100 KB)</small></label>
                                            <div class="input-group">
                                                <label class="input-group-btn">
                                                    <span class="btn btn-success">
                                                        Browse&hellip;<input type="file" style="display: none;" name="student_image" id="student_image">
                                                    </span>
                                                </label>
                                                <input <?php echo $studentDetails['first_name']; ?> class="form-control" readonly>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <button type="button" class="btn btn-sm btn-info btn-flat" id="update-student-profile">
                                            Update Student Profile
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php echo form_close() ?>
                    </div>

                    <!-- <div class="tab-pane" id="activity">
                        <h3>No Data Found...</h3>
                    </div> -->

                    <!-- <div class="tab-pane" id="batchDetails">
                        <h3>No Data Found...</h3>
                    </div> -->
                </div>

            </div>
        </div>
    </div>

</section>