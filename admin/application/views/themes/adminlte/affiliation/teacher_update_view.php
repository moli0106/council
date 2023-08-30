<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li><a href="affiliation/teachers"><i class="fa fa-align-center"></i>Teachers / Instructor List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Update</li>
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
                <h3 class="box-title">Update Teachers / Instructor Information</h3>
            </div>
            <div class="box-body">
                <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                <?php echo form_open_multipart('admin/affiliation/teachers/update/' . md5($formData['teacher_id_pk'])) ?>
                <div class="row">
                    <div class="col-md-2">
                        <span>
                            Teacher Type <span class="text-danger">*</span>
                        </span>
                    </div>
                    <div class="col-md-10">
                        <label class="radio-inline">
                            <input type="radio" class="teacher-type-radio" name="teacher_type" value="1" <?php if ($formData['teacher_type'] == 1) echo 'checked'; ?>> Teachers for HS-Voc.
                        </label>
                        <!-- <label class="radio-inline">
                            <input type="radio" class="teacher-type-radio" name="teacher_type" value="2" <?php if ($formData['teacher_type'] == 2) echo 'checked'; ?>> Other Treacher for HS Voc / VIII+ / X+ STC
                        </label> -->
                        <label class="radio-inline">
                            <input type="radio" class="teacher-type-radio" name="teacher_type" value="3" <?php if ($formData['teacher_type'] == 3) echo 'checked'; ?>> Teacher for Trade Subject of VIII+ / X+ STC
                        </label>
                        <?php echo form_error('teacher_type'); ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <!-- <div class="col-md-4 course-id-div" <?php if ($formData['teacher_type'] == 2) {
                                                            echo 'style="display: none;"';
                                                        } ?>>
                        <div class="form-group">
                            <label class="" for="course_id">Select Course <span class="text-danger">*</span></label>
                            <select class="form-control" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Course</option>
                                <?php foreach ($vtc_courseList as $key => $value) { ?>
                                    <option value="<?php echo $value['course_id_pk']; ?>" <?php if ($formData['course_id_fk'] == $value['course_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['group_name']; ?>
                                        [<?php echo $value['group_code']; ?>]
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 course-name-div" <?php if ($formData['teacher_type'] != 2) {
                                                                echo 'style="display: none;"';
                                                            } ?>>
                        <div class="form-group">
                            <label class="" for="attached_with">Enter Course Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="course_name" id="course_name" placeholder="Enter Course Name" value="<?php echo $formData['course_name']; ?>">
                            <?php echo form_error('course_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 course-name-div" <?php if ($formData['teacher_type'] != 2) {
                                                                echo 'style="display: none;"';
                                                            } ?>>
                        <div class="form-group">
                            <label class="" for="subjects_attached_with">Subjects attached with <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subjects_attached_with" id="subjects_attached_with" placeholder="Enter Subjects attached with" value="<?php echo $formData['attached_subjects']; ?>">
                            <?php echo form_error('subjects_attached_with'); ?>
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="teacher_name">Enter Teacher / Instructor Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="teacher_name" id="teacher_name" placeholder="Enter Teacher / Instructor Name" value="<?php echo $formData['teacher_name']; ?>">
                            <?php echo form_error('teacher_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="designation">Select Designation <span class="text-danger">*</span></label>
                            <select class="form-control" name="designation" id="designation">
                                <option value="" hidden="true">Select Designation</option>
                                <?php foreach ($designationList as $key => $value) { ?>
                                    <option value="<?php echo $value['designation_id_pk']; ?>" <?php if ($formData['designation_id_fk'] == $value['designation_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['designation_name']; ?>
                                    </option>
                                <?php } ?>
                                <option value="Other" <?php if ($formData['designation_id_fk'] == NULL) echo 'selected'; ?>>Other</option>
                            </select>
                            <?php echo form_error('designation'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 other-designation-div" <?php if ($formData['designation_id_fk'] != NULL) {
                                                                    echo 'style="display: none;"';
                                                                } ?>>
                        <div class="form-group">
                            <label class="" for="other_designation">Enter Designation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="other_designation" id="other_designation" placeholder="Enter Designation" value="<?php echo $formData['other_designation']; ?>">
                            <?php echo form_error('other_designation'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" name="employee_id" id="employee_id" placeholder="Enter Employee ID" value="<?php echo $formData['employee_id']; ?>">
                            <?php echo form_error('employee_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="engagement_type">Select Type of Engagement <span class="text-danger">*</span></label>
                            <select class="form-control" name="engagement_type" id="engagement_type">
                                <option value="" hidden="true">Select Type of Engagement</option>
                                <?php foreach ($engagementList as $key => $value) { ?>
                                    <option value="<?php echo $value['engagement_id_pk']; ?>" <?php if ($formData['engagement_id_fk'] == $value['engagement_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['engagement_name']; ?>
                                    </option>
                                <?php } ?>
                                <option value="Other" <?php if ($formData['engagement_id_fk'] == NULL) echo 'selected'; ?>>Other</option>
                            </select>
                            <?php echo form_error('engagement_type'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 other-engagement-div" <?php if ($formData['engagement_id_fk'] != NULL) {
                                                                    echo 'style="display: none;"';
                                                                } ?>>
                        <div class="form-group">
                            <label class="" for="other_engagement">Enter Engagement Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="other_engagement" id="other_engagement" placeholder="Enter Engagement Type" value="<?php echo $formData['other_engagement']; ?>">
                            <?php echo form_error('other_engagement'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="highest_qualification">Select Relevant Qualification <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="highest_qualification" id="highest_qualification">
                                <option value="" hidden="true">Select Relevant Qualification</option>
                                <?php foreach ($qualificationList as $key => $value) { ?>
                                    <option value="<?php echo $value['qualification_id_pk']; ?>" <?php if ($formData['qualification_id_fk'] == $value['qualification_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['qualification_name']; ?>
                                    </option>
                                <?php } ?>
                                <option value="Other" <?php if ($formData['qualification_id_fk'] == NULL) echo 'selected'; ?>>Other</option>
                            </select>
                            <?php echo form_error('highest_qualification'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 other-qualification-div" <?php if ($formData['qualification_id_fk'] != NULL) {
                                                                        echo 'style="display: none;"';
                                                                    } ?>>
                        <div class="form-group">
                            <label class="" for="other_qualification">Enter Qualification <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="other_qualification" id="other_qualification" placeholder="Enter Qualification" value="<?php echo $formData['other_qualification']; ?>">
                            <?php echo form_error('other_qualification'); ?>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="qualification_subjects">Enter Subjects Of Qualification <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="qualification_subjects" id="qualification_subjects" placeholder="Enter Subjects Of Qualification" value="<?php echo $formData['qualification_subjects']; ?>">
                            <?php echo form_error('qualification_subjects'); ?>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="qualification_certificate">
                                Upload Relevant certificate
                                <a href="<?php echo base_url('admin/affiliation/teachers/download_qualification_certificate/' . md5($formData['teacher_id_pk'])); ?>" class="label label-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    View
                                </a>
                                <br>
                                <small>(Upload Highest qualification certificate pdf 100 KB)</small>
                            </label>
                            <input type="file" class="form-control" name="qualification_certificate" id="qualification_certificate" placeholder="Enter Subjects attached with">
                            <?php echo form_error('qualification_certificate'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="pan_no_image">
                              Upload PAN
                                <a href="<?php echo base_url('admin/affiliation/teachers/download_pan_image/' . md5($formData['teacher_id_pk'])); ?>" class="label label-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    View
                                </a>
                                <br>
                                <small>(upload an image of Pan card – jpg/jpeg 100 KB)</small>
                            </label>
                            <input type="file" class="form-control" name="pan_no_image" id="pan_no_image" placeholder="Enter Subjects attached with">
                            <?php echo form_error('pan_no_image'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="aadhar_no_image">
                                Upload Aadhar
                                <a href="<?php echo base_url('admin/affiliation/teachers/download_aadhar_image/' . md5($formData['teacher_id_pk'])); ?>" class="label label-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                </a>
                                <br>
                                <small>(upload scan copy of Aadhar card – jpg/jpeg 100 KB)</small>
                            </label>
                            <input type="file" class="form-control" name="aadhar_no_image" id="aadhar_no_image" placeholder="Enter Subjects attached with">
                            <?php echo form_error('aadhar_no_image'); ?>
                        </div>
                    </div>

                   <!-- Added by Moli -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="photo">Upload Photo 
                                <!-- <span class="text-danger">*</span> -->
                                <?php if($formData['photo']!=''){?>
                                    <a href="<?php echo base_url('admin/affiliation/teachers/download_profile_photo/' . md5($formData['teacher_id_pk'])); ?>" class="label label-info">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                    </a>
                                <?php }?>
                                <br><small>(upload Photo – jpg/jpeg 100 KB)</small>
                            </label>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-info">
                                        Browse&hellip;<input type="file" style="display: none;" name="photo" id="photo">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <?php echo form_error('photo'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="pan_no">PAN Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pan_no" id="pan_no" placeholder="Enter PAN Number" value="<?php echo $formData['pan_no']; ?>">
                            <?php echo form_error('pan_no'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="aadhar_no">Aadhar Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="aadhar_no" id="aadhar_no" placeholder="Enter Aadhar Number" value="<?php echo $formData['aadhar_no']; ?>">
                            <?php echo form_error('aadhar_no'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="mobile_no">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter Mobile Number" value="<?php echo $formData['mobile_no']; ?>">
                            <?php echo form_error('mobile_no'); ?>
                        </div>
                    </div>

                    <!-- Added by Moli -->

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="whats_app_no">
                                What’s app mobile no
                            </label>
                            <input type="text" class="form-control" name="whats_app_no" id="whats_app_no" placeholder="Enter What's App No"  value="<?php echo $formData['whats_app_mob_no']; ?>">
                            
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dob">Date of Birth <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control pull-left date-picker" id="teacher-datepicker" name="dob" placeholder="dd/mm/yyyy" value="<?php if($formData['date_of_birth']){echo date('d/m/Y', strtotime($formData['date_of_birth']));} ?>">
                            </div>
                            <?php echo form_error('dob'); ?>
                        </div>
                    </div>
                    <!-- Added by Moli -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="email_id">Email Id <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email_id" id="email_id" placeholder="Enter Email Id" value="<?php echo $formData['email_id']; ?>">
                            <?php echo form_error('email_id'); ?>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" name="employee_id" id="employee_id" placeholder="Enter Employee ID" value="<?php echo $formData['employee_id']; ?>">
                            <?php echo form_error('employee_id'); ?>
                        </div>
                    </div> -->
                    <?php if ($vtcDetails['final_submit_status'] == 0) { ?>
                        <div class="col-md-4 text-center">
                            <label>&nbsp;</label><br>
                            <button type="submit" class="btn btn-success btn-block btn-sm">Update Teachers / Instructor Information</button>
                        </div>
                    <?php } ?>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>