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
                <h3 class="box-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Student</h3><br>
				<h4><span class="text-danger"></span></h4>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                <?php echo form_open_multipart("admin/organization/student_reg/add",array('onsubmit' => "$('#loading').show();")); ?>
                <div id="loading" style="display:none">Uploading...</div>
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcCode">Organaization Name <span class="text-danger">*</span></label>
                            <input id="vtcCode" name="vtcCode" class="form-control" type="text" value="<?php echo $organization_details['organization_name']; ?>" readonly>
                            <?php echo form_error('vtcCode'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcName">Othorize Person <span class="text-danger">*</span></label>
                            <input id="vtcName" name="vtcName" class="form-control" type="text" value="<?php echo $organization_details['othorization_person']; ?>" readonly>
                            <?php echo form_error('vtcName'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tc_name">Select Institute<span class="text-danger">*</span></label>
                            <input id="tc_name" name="tc_name" class="form-control" type="text" value="<?php echo $tc_details['tc_name']; ?>" readonly>
                            <input type="hidden" name="tc_id_fk" value="<?php echo $tc_details['tc_id_pk']; ?>">
                            <?php echo form_error('tc_name'); ?>
                        </div>
                    </div>
                    
                    
                </div>

                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Basic Details:</strong></h4>
                <div class="content-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Salutation <span class="text-danger">*</span></label>
                                <select class="form-control" name="salutation" id="salutation">
                                    <option value="">-- Salutation --</option>
                                    <?php foreach($salutations as $salutation){ ?>
                                    <option value="<?php echo $salutation['salutation_id_pk'] ?>" <?php echo set_select("salutation",$salutation['salutation_id_pk']) ?>><?php echo $salutation['salutation_desc'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('salutation'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">First name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("fname"); ?>" name="fname" id="fname" class="form-control"  placeholder="First name">
                                <?php echo form_error('fname'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Middle name</label>
                                <input type="text" value="<?php echo set_value("mname"); ?>" name="mname" id="mname" class="form-control"  placeholder="Middle name">
                                <?php echo form_error('mname'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Last name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("lname"); ?>" name="lname" id="lname" class="form-control"  placeholder="Last name">
                                <?php echo form_error('lname'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="father_name">Father name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("father_name"); ?>" name="father_name" id="father_name" class="form-control"  placeholder="Father name">
                                <?php echo form_error('father_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mother_name">Mother name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("mother_name"); ?>" name="mother_name" id="mother_name" class="form-control"  placeholder="Mother name">
                                <?php echo form_error('mother_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="guardian_name">Guardian name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("guardian_name"); ?>" name="guardian_name" id="guardian_name" class="form-control"  placeholder="Guardian name">
                                <?php echo form_error('guardian_name'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="aadhar_no">Aadhar No.<span class="text-danger">*</span></label>
                                <input type="number" value="<?php echo set_value("aadhar_no"); ?>" name="aadhar_no" id="aadhar_no" class="form-control"  placeholder="Aadhar No.">
                                <?php echo form_error('aadhar_no'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mob_no">Mobile No.<span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("mob_no"); ?>" name="mob_no" id="mob_no" class="form-control"  placeholder="Mobile No." pattern="^[6-9]\d{9}$" title="Ten Digit Mobile No, Starting with 6 to 9">
                                <?php echo form_error('mob_no'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email_id">Email ID <span class="text-danger">*</span></label>
                                <input type="email" value="<?php echo set_value('email_id'); ?>" name="email_id" id="email_id" class="form-control" placeholder="Email ID">
                                <?php echo form_error('email_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="datepicker">D.O.B (as per Aadhar)<span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="common_input_div">
                                    <input type="text" value="<?php echo set_value("dob"); ?>" class="form-control pull-right std-datepicker" id="dob" name="dob" placeholder="DD/MM/YYYY" autocomplete="off">
                                </div>
                            </div>
                            <?php echo form_error('dob'); ?>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">-- Select Gender --</option>
                                    <?php foreach($genders as $gender){ ?>
                                    <option value="<?php echo $gender['gender_id_pk'] ?>" <?php echo set_select("gender",$gender['gender_id_pk']) ?>><?php echo $gender['gender_description'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('gender'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="caste_id">Caste</label>
                                <select class="form-control" name="caste_id" id="caste_id">
                                    <option value="" hidden="true">-- Caste --</option>
                                    <?php foreach($casteList as $val){ ?>
                                    <option value="<?php echo $val['caste_id_pk'] ?>" <?php echo set_select("caste_id",$val['caste_id_pk']) ?>><?php echo $val['caste_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('caste_id'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="religion_id">Religion </label>
                                <select class="form-control" name="religion_id" id="religion_id">
                                    <option value="" hidden="true">-- Religion --</option>
                                    <?php foreach($religion as $val){ ?>
                                    <option value="<?php echo $val['religion_id_pk'] ?>" <?php echo set_select("religion_id",$val['religion_id_pk']) ?>><?php echo $val['religion_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('religion_id'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reg_no">Registration Number <span class="text-danger">*</span></label>
                                <input id="reg_no" name="reg_no" class="form-control" type="text" value="<?php echo set_value('reg_no'); ?>" placeholder="Registration No">
                                <?php echo form_error('reg_no'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Street/Village/Town <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("address"); ?>" name="address" id="address" class="form-control"  placeholder="Street/Village/Town">
                                <?php echo form_error('address'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Post Office <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("po"); ?>" name="po" id="po" class="form-control"  placeholder="Post Office">
                                <?php echo form_error('po'); ?>
                            </div>
                        </div>

                   

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="police_station">Police Station <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo set_value("police_station"); ?>" name="police_station" id="police_station" class="form-control"  placeholder="Police Station">
                                <?php echo form_error('police_station'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pinCode">Pin Code <span class="text-danger">*</span></label>
                                <input id="pinCode" name="pinCode" class="form-control" type="text" value="<?php echo set_value('pinCode'); ?>">
                                <?php echo form_error('pinCode'); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state">State <span class="text-danger">*</span></label>
                                <select name="state" id="state" class="form-control">
                                    <option value="" hidden="true">Select state</option>
                                    <?php foreach ($stateList as $key => $value) { ?>
                                        <option value="<?php echo $value['state_id_pk']; ?>" <?php echo set_select('state', $value['state_id_pk']); ?>>
                                            <?php echo $value['state_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('state'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="district">District <span class="text-danger">*</span></label>
                                <select name="district" id="district" class="form-control">
                                    <?php if (count($district)) { ?>
                                        <?php foreach ($district as $key => $value) { ?>
                                            <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($form_data['district'] == $value['district_id_pk']) echo 'selected'; ?>>
                                                <?php echo $value['district_name']; ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled>No Data Found...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('district'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 other_state_div" <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                            

                            <div class="form-group ">
                                <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                                <select name="subDivision" id="subDivision" class="form-control">
                                    <option value="" hidden="true">Select Sub Division</option>
                                    <?php if (count($subDivision)) { ?>
                                        <?php foreach ($subDivision as $key => $value) { ?>
                                            <option value="<?php echo $value['subdiv_id_pk']; ?>" <?php if ($form_data['sub_division_id_fk'] == $value['subdiv_id_pk']) echo 'selected'; ?>>
                                                <?php echo $value['subdiv_name']; ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled>No Data Found...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('subDivision'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 other_state_div" <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                            

                            <div class="form-group">
                                <label for="municipality">Municipality / Block </label>
                                <select name="municipality" id="municipality" class="form-control">
                                    <option value="" hidden="true">Select Municipality / Block</option>
                                    <?php if (count($municipality)) { ?>
                                        <?php foreach ($municipality as $key => $value) { ?>
                                            <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($form_data['municipality_id_fk'] == $value['block_municipality_id_pk']) echo 'selected'; ?>>
                                                <?php echo $value['block_municipality_name']; ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled>No Data Found...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('municipality'); ?>
                            </div>
                        </div>

                        
                       

                       
                    </div>

                    <div class="row">
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
                                            <!-- Browse&hellip;<input type="file" style="display: none;"  id="std_image"> -->

                                            Browse&hellip;<input type="file" style="display: none;" id="file1"   accept="image/jpeg">
                                            <input type="hidden" id="textArea" name="std_image">
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
                                            <!-- Browse&hellip;<input type="file" style="display: none;" name="std_signature" id="std_signature"> -->

                                            Browse&hellip;<input type="file" style="display: none;" id="file2"   accept="image/jpeg">
                                            <input type="hidden" id="textArea2" name="std_signature">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <?php echo form_error('std_signature'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            
                            <div class="form-group">
                                <label class="" for="aadhar_doc">
                                Upload Aadhar 
                                    <span class="text-danger">*</span>
                                    <!-- <br> -->
                                    <small>(.PDF only, Max 200KB)</small>
                                </label>
                            
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            <!-- Browse&hellip;<input type="file" style="display: none;" name="aadhar_doc" id="aadhar_doc"> -->

                                            Browse&hellip;<input type="file" style="display: none;"  id="file3"   accept="application/pdf">
                                            <input type="hidden" id="textArea3" name="aadhar_doc">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <?php echo form_error('aadhar_doc'); ?>
                            </div>
                        </div>

                        
                    </div>
                    
                   
                   
                </div>

                <hr>
                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Course Details:</strong></h4>
                <div class="content-block">
                    <div class="row">
                        <!-- <div class="col-md-4">
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
                        </div> -->
                        <!-- <div class="col-md-4">
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
                        </div> -->

                        <div class="col-md-6">
                            <div class="form-group <?php echo (form_error('stdCourse') != '') ? 'has-error' : ''; ?>">
                                <label for="stdCourse">Course <span class="text-danger">*</span></label>
                                <select name="stdCourse" id="stdCourse" class="form-control">
                                    <option value="" hidden="true">Select Course</option>
                                    <?php if (!empty($tc_course)) { ?>
                                        <?php foreach ($tc_course as $key => $value) { ?>
                                            <option value="<?php echo $value['course_id_fk']; ?>" <?php echo set_select('stdCourse', $value['course_id_fk']); ?>>
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
                        <div class="col-md-6">
                            <div class="form-group <?php echo (form_error('courseDuration') != '') ? 'has-error' : ''; ?>">
                                <label for="courseDuration">Duration of the Course <small>(in hrs)</small><span class="text-danger">*</span></label>
                                <input type="text" name="courseDuration" id="courseDuration" class="form-control" value="" readonly>
                                <!-- <select name="courseDuration" id="courseDuration" class="form-control">
                                    <option value="" hidden="true">Select Course Duration</option>
                                    <option value="200" <?php echo set_select('courseDuration', 200); ?>>200</option>
                                    <option value="300" <?php echo set_select('courseDuration', 300); ?>>300</option>
                                </select> -->
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
						<button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Add Student</button>
						
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>

        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>