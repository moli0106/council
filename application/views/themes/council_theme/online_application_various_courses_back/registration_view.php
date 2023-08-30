<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Online Application</h2>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active">Online Application / Various Courses registration form</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<style>
    .course_sector_block,
    .work_exp_section,
    .experience_section,
    .agency_section {
        padding: 10px 0px 10px 0px;
        margin-bottom: 10px;
        border: 2px solid #CCC;
    }
</style>
<div class="container">
<?php if ($this->session->flashdata('status') !== null) { ?>
    <div class="alert alert-<?= $this->session->flashdata('status') ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?= $this->session->flashdata('alert_msg') ?>
    </div>
    <?php } ?>

    <div class="row">

        <div class="col-md-12">
            <h3>Various Courses / Online registration form</h3>
        </div>

    </div>
    <hr>
    <?php $std_id = $stdDetails['student_details_id_pk']; ?>
    <?php echo form_open_multipart("online_application_various_courses/registration/std_info/".md5($std_id), array("id" => "basic_assessor_reg_form")); ?>
    <!-- <input type="hidden" name="token" value="<?php echo $captcha['word'] ?>"> -->
    <h4>Basic Information</h4>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="designation">Course Applied For <span class="text-danger">*</span></label>
                <select class="form-control" name="courses" id="courses">
                    <option value="">-- Courses --</option>
                    <?php foreach ($courses as $course) { ?>
                        <option value="<?php echo $course['course_id_pk'] ?>" <?php echo set_select("courses", $course['course_id_pk']) ?>><?php echo $course['course_name'] ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('courses'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="fullname">Name <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo $stdDetails['candidate_name']; ?>" name="fullname" id="fullname" class="form-control" placeholder="Name">
                <?php echo form_error('fullname'); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="stdEmail">Email <span class="text-danger">*</span></label>
                <!-- <small><i>Login credentials will be send to VTC email.</i></small> -->
                <input id="stdEmail" name="stdEmail" class="form-control" type="email" value="<?php echo $stdDetails['email']; ?>" readonly>
                <?php echo form_error('stdEmail'); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="stdMobileNo">Mobile No. <span class="text-danger">*</span></label>
                <!-- <small><i>OTP will be send to Mobile No.</i></small> -->
                <input type="number" id="stdMobileNo" name="stdMobileNo" class="form-control" value="<?php echo $stdDetails['mobile_number']; ?>" readonly>
                <?php echo form_error('stdMobileNo'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="designation">Guardian's Name</label>
                <input type="text" value="<?php echo set_value("guardian_name"); ?>" name=" guardian_name" id="guardian_name" class="form-control" placeholder="Guardian's name">
                <?php echo form_error('guardian_name'); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="gender">Gender <span class="text-danger">*</span></label>
                <select class="form-control" name="gender" id="gender">
                    <option value="">-- Select Gender --</option>
                    <?php foreach ($genders as $gender) { ?>
                        <option value="<?php echo $gender['gender_id_pk'] ?>" <?php echo set_select("gender", $gender['gender_id_pk']) ?>><?php echo $gender['gender_description'] ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('gender'); ?>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3" id="kanyashree" <?php if((set_value('gender')!= 2)){echo 'style="display:none"';}?>>
            <div class="form-group">
                <label for="kanyashree">Kanyashree<span class="text-danger">*</span></label>
                <br />
                <input type="radio" name="kanyashree" id="kanyashree_yes" value="yes" <?php echo set_radio("kanyashree", "yes") ?>>
                  <label for="kanyashree_yes">Yes</label>
                  <input type="radio" name="kanyashree" id="kanyashree_no" value="no" <?php echo set_radio("kanyashree", "no") ?>>
                  <label for="kanyashree_no">No</label>

                <?php echo form_error('kanyashree'); ?>
            </div>
        </div>

        <div class="col-md-5" id="unique_id" <?php if((set_value('kanyashree')!= 'yes')){echo 'style="display:none"';}?>>
            <div class="form-group">
                <label for="designation">Unique ID <span class="text-danger">*</span></label>
                <input type="number" value="<?php echo set_value("unique_id"); ?>" name="unique_id" id="unique_id" class="form-control" placeholder="UNIQUE ID.">
                <?php echo form_error('unique_id'); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="designation">Nationality <span class="text-danger">*</span></label>
                <select class="form-control" name="nationality" id="nationality">
                    <option value="">-- Select Nationality --</option>
                    <?php foreach ($nationality as $nationality) { ?>
                        <option value="<?php echo $nationality['nationality_id_pk'] ?>" <?php echo set_select("nationality", $nationality['nationality_id_pk']) ?>><?php echo $nationality['nationality_name'] ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('nationality'); ?>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="category">Category <span class="text-danger">*</span></label>
                <select class="form-control" name="category" id="category">
                    <option value="">-- Select Category --</option>
                    <?php foreach ($castes as $caste) { ?>
                        <option value="<?php echo $caste['caste_id_pk'] ?>" <?php echo set_select("category", $caste['caste_id_pk']) ?>><?php echo $caste['caste_name'] ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('category'); ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="designation">Physically Challenged<span class="text-danger">*</span></label>
                <br />
                <input type="radio" name="handicapped" id="handicapped_yes" value="yes"<?php echo set_radio("handicapped", "yes") ?>>
                  <label for="handicapped_yes">Yes</label>
                  <input type="radio" id="handicapped_no" name="handicapped" value="no"<?php echo set_radio("handicapped", "no") ?>>
                  <label for="handicapped_no">No</label>

                <?php echo form_error('handicapped'); ?>
            </div>
        </div>
        <div class="col-md-3">
            <label for="datepicker">D.O.B <span class="text-danger">*</span></label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="common_input_div">
                    <input type="text" value="<?php echo set_value("dob"); ?>" class="form-control pull-right datepicker" id="dob" name="dob" placeholder="DD/MM/YYYY" autocomplete="off">
                </div>
            </div>
            <?php echo form_error('dob'); ?>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="designation">Religion <span class="text-danger">*</span></label>
                <select class="form-control" name="religion" id="religion">
                    <option value="">-- Select Category --</option>
                    <?php foreach ($religions as $religion) { ?>
                        <option value="<?php echo $religion['religion_id_pk'] ?>" <?php echo set_select("religion", $religion['religion_id_pk']) ?>><?php echo $religion['religion_name'] ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('religion'); ?>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="designation">Aadhar No <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo set_value("aadhar_no"); ?>" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Aadhar No." style="text-transform: uppercase;">
                <?php echo form_error('aadhar_no'); ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="designation">Last Qualification <span class="text-danger">*</span></label>
                <select class="form-control" name="last_qualification" id="last_qualification">
                    <option value="">-- Select Last Qualification --</option>
                    <?php foreach ($qualifications as $qualification) { ?>
                        <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("last_qualification", $qualification['qualification_id_pk']) ?>><?php echo $qualification['qualification_name'] ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('last_qualification'); ?>
            </div>
        </div>

        <!-- <div class="col-md-2">
            <div class="form-group">
              <label for="designation">Registration No <span class="text-danger">*</span></label> 
                <input type="hidden" value="<?php echo set_value("registration_no"); ?>" name="registration_no" id="registration_no" class="form-control" placeholder="Registration No." style="text-transform: uppercase;">
                <?php echo form_error('registration_no'); ?>
            </div>
        </div> -->

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="last_reg_no">Registration No.<span class="text-danger">*</span></label>
                <input type="number" value="<?php echo set_value("last_reg_no"); ?>" name="last_reg_no" id="last_reg_no" class="form-control"  placeholder="Reg No.">
                <?php echo form_error('last_reg_no'); ?>
            </div>
        </div>
        <div class="col-md-4">
            
            <div class="form-group">
                <label class="" for="std_image">
                Upload Student Image 
                    <span class="text-danger">*</span>
                    <!-- <br> -->
                    <small>(.jpeg only,max 100 KB)</small>
                </label>
            
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-success">
                            Browse&hellip;<input type="file" style="display: none;" name="std_image" id="std_image">
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly>
                </div>
                <?php echo form_error('std_image'); ?>
            </div>
        </div>

        <div class="col-md-4">
                            
            <div class="form-group">
                <label class="" for="std_signature">
                Upload Student Signature 
                    <span class="text-danger">*</span>
                    <!-- <br> -->
                    <small>(.jpeg only,max 50 KB)</small>
                </label>
            
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-success">
                            Browse&hellip;<input type="file" style="display: none;" name="std_signature" id="std_signature">
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly>
                </div>
                <?php echo form_error('std_signature'); ?>
            </div>
        </div>

        
    </div>

    <br>
    <h4>Educational Information</h4>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="fullmark">Full Marks <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo set_value("fullmark") ?>" name="fullmark" id="fullmark" class="form-control" placeholder="fullmarks">

                <?php echo form_error('fullmark'); ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="mark_obtain">Marks Obtained <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo set_value("marks_obtain") ?>" name="marks_obtain" id="marks_obtain" class="form-control" placeholder="Marks Obtain">

                <?php echo form_error('marks_obtain'); ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="percentage">Percentage % <span class="text-danger">*</span></label>
                <input type="number" name="percentage" id="percentage" value="<?php echo set_value('percentage') ?>" class="form-control" placeholder="Percentage">

                <?php echo form_error('percentage'); ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="cgpa">C.G.P.A <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo set_value("c_g_p_a") ?>" name="c_g_p_a" id="c_g_p_a" class="form-control" placeholder="C G P A">

                <?php echo form_error('c_g_p_a'); ?>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label for="fullmark">Name of the Institute <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo set_value("institute_name") ?>" name="institute_name" id="institute_name" class="form-control" placeholder="Institute Name">

                <?php echo form_error('institute_name'); ?>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="fullmark">Year of Passing <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo set_value("passing_year") ?>" name="passing_year" id="passing_year" class="form-control" placeholder="Passing Year">

                <?php echo form_error('passing_year'); ?>
            </div>
        </div>
    </div>
    <br>
    <h4>Contact Information</h4>
    <hr>
    <div class="row">
        <div class="col-md-12">
        <div class="form-group">
            <label for="address">Address <span class="text-danger">*</span></label>
            <textarea class="form-control" name="address" rows="3"><?php echo set_value('address'); ?></textarea>
            <?php echo form_error('address'); ?>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="state">State <span class="text-danger">*</span></label>
                <select name="state" id="state" class="form-control">
                    <option value="" hidden="true">Select state</option>
                    <?php foreach ($states as $key => $value) { ?>
                        <option value="<?php echo $value['state_id_pk']; ?>" <?php echo set_select('state', $value['state_id_pk']); ?>>
                            <?php echo $value['state_name']; ?>
                        </option>
                    <?php } ?>
                </select>
                <?php echo form_error('state'); ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="district">District <span class="text-danger">*</span></label>
                <select name="district" id="district" class="form-control">

                    <?php if ($this->input->method(TRUE) == "POST") { ?>

                        <?php foreach ($district as $value) { ?>
                            <option value="<?php echo $value['district_id_pk'] ?>" <?php echo set_select('district', $value['district_id_pk']); ?>>
                                <?php echo $value['district_name']; ?> </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="" hidden="true">Select District</option>
                        
                        <option value="" disabled="true">Select State first...</option>
                    <?php } ?>
                </select>
                <?php echo form_error('district'); ?>
            </div>
        </div>


        <div class="col-md-3 other_state_div" <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
            <div class="form-group">
                <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                <select name="subDivision" id="subDivision" class="form-control">

                    <?php if ($this->input->method(TRUE) == "POST") { ?>

                        <?php foreach ($subDivision as $value) { ?>
                            <option value="<?php echo $value['subdiv_id_pk'] ?>" <?php echo set_select('subDivision', $value['subdiv_id_pk']); ?>>
                                <?php echo $value['subdiv_name']; ?> </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="" hidden="true">Select Sub Division</option>
                        <option value="" disabled="true">Select District first...</option>
                    <?php } ?>

                </select>
                <?php echo form_error('subDivision'); ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="pincode">Pincode <span class="text-danger">*</span></label>
                <input type="text" value="<?php echo set_value('pincode'); ?>" name="pincode" id="pincode" class="form-control" placeholder="PINCODE">
                <?php echo form_error('pincode'); ?>
            </div>
        </div>
    </div>
    <div class="row">


        <div class="col-md-7">
            <label for="captcha">&nbsp;</label><br>
            <button type="submit" class="btn btn-warning pull-right" onclick="javascript:redirect_url();">Submit</button>
        </div>
    </div>
    <br>
    <?php echo form_close(); ?>
</div>
<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>

<script>
     function redirect_url() {
    
  }
</script>