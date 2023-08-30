<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<!-- Content Wrapper. Contains page content -->
<style>
.btn-space {
    margin-right: 5px;
}
</style>

<!-- For disabled on final submit -->
<?php if($app_data[0]['final_flag'] == 't'){
        $disabled="disabled";
    }else{
        $disabled=NULL;  
        }
    ?>


<?php if ($formData['state_id_fk'] == 19) {
            $enable_data = '';
        } else {
            $enable_data = 'none';
        } ?>

        <?php if ($formData['nationality_id_fk'] == 2) {
            $nationality_data = '';
        } else {
            $nationality_data = 'none';
        } ?>


        <?php if (($formData['gender'] == 2 && $formData['marital_status'] == 2) ) {
            $kanyas_view = 'block';
        } else {
            $kanyas_view = 'none';
        } ?>

     <?php if (($formData['exam_type_id'] == 3 ) ) {
            $suj_marks_view = 'block';
        } else {
            $suj_marks_view = 'none';
        } ?>
<!-- For disabled on final submit -->

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Registration Form</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Details View</li>
        </ol>
    </section>
    <section class="content">
    <?php echo form_open_multipart('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            
            <div class="box-body">

                <?php if(isset($status)){ ?>
                <div class="alert alert-<?php echo $status == TRUE ? 'success' : 'danger'; ?>">
                    <strong>Success!</strong> <?php echo $message; ?>.
                </div>
                <?php } ?>

                <?php 
					if($this->session->flashdata('alert_msg'))
					{
				?>
                <div class="alert alert-success">
                    <p><?php echo $this->session->flashdata('alert_msg'); ?></p>
                </div>
                <?php 
					}
				?>

             
                <div class="clearfix"></div>
                <br>
                
                <h4> <b style="color:blue;">Institute Details </b></h4>
                <hr>
                <div class="row">


                <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="exam_type_id">Select Exam/Application name <span class="text-danger">*</span></label>
                            <select class="form-control" name="exam_type_id" id="exam_type_id">
                                <option value="" hidden="true">---Select Exam/Application name---</option>
                                <?php foreach ($exam_type as $val) { ?>
                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                        <option value="<?php echo $val['exam_type_id_pk']; ?>" <?php echo $val['exam_type_id_pk'] == $app_data['exam_type_id_fk'] ? 'selected' : ''; ?>><?php echo $val['name_for_std_reg']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $val['exam_type_id_pk']; ?>" <?php echo set_select('exam_type_id', $val['exam_type_id_pk']); ?>><?php echo $val['name_for_std_reg']; ?></option>
                                <?php }
                                 } ?>
                             </select>
                            <?php echo form_error('exam_type_id'); ?>
                        </div>
                    </div> 

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcName">Institute Name <span class="text-danger">*</span></label>
                            <input id="vtcName" name="vtcName" class="form-control" type="text" value="<?php echo $app_data['vtc_name'];?>">
                            <!-- <input type='text' id='selectuser_ids' value=""/> -->
                            <?php echo form_error('vtcName'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcCode">Institute Code <span class="text-danger">*</span></label>
                            <input id="instituteCode" name="vtcCode" class="form-control" type="text" value="<?php echo $app_data['vtc_code'];?>" readonly>
                            <?php echo form_error('vtcCode'); ?>
                        </div>
                    </div>
					
					<div class="col-md-4">
                        <div class="form-group">
                            <label for="ins_category">Institute Category <span class="text-danger">*</span></label>
                            <input id="ins_category" name="ins_category" class="form-control" type="text" value="<?php echo $app_data['institute_category'];?>" readonly>
                            <?php echo form_error('ins_category'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="admissionYear">Year of Admission <span class="text-danger">*</span></label>
                            <input id="admissionYear" name="admissionYear" value="<?php echo $app_data['registration_year'];?>" class="form-control" type="text"
                                value="<?php //echo $academic_year; ?>" readonly>
                            <?php echo form_error('admissionYear'); ?>
                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="exam_type_id">Select Exam/Application name <span class="text-danger">*</span></label>
                            <select class="form-control" name="exam_type_id" id="exam_type_id">
                                <option value="" hidden="true">---Select Exam/Application name---</option>
                                <?php foreach ($exam_type as $val) { ?>
                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                        <option value="<?php echo $val['exam_type_id_pk']; ?>" <?php echo $val['exam_type_id_pk'] == $app_data['exam_type_id_fk'] ? 'selected' : ''; ?>><?php echo $val['name_for_std_reg']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $val['exam_type_id_pk']; ?>" <?php echo set_select('exam_type_id', $val['exam_type_id_pk']); ?>><?php echo $val['name_for_std_reg']; ?></option>
                                <?php }
                                 } ?>
                             </select>
                            <?php echo form_error('exam_type_id'); ?>
                        </div>
                    </div> -->


                     <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Select course Name <span class="text-danger">*</span></label>

                            <select class="form-control" name="course_id" id="course_id">
                                <option value="" hidden="true">-- Select course Name --</option>
                                <?php foreach ($course as $val) { ?>

                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>

                                        <option value="<?php echo $val['discipline_id_pk']; ?>" <?php echo $val['discipline_id_pk'] == $app_data['course_id_fk'] ? 'selected' : ''; ?>><?php echo $val['discipline_name']; ?>[<?php echo $val['discipline_code']; ?>]</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $val['discipline_id_pk']; ?>" <?php echo set_select('course_id', $val['discipline_id_pk']); ?>><?php echo $val['discipline_name']; ?>[<?php echo $val['discipline_code']; ?>]</option>
                                <?php }
                                } ?>

                            </select>

                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>


                </div>

                <!-- basic Details -->
                <h4> <b style="color:blue;">Basic Details </b></h4>
                <hr>

                <div class="row">

					<div class="col-md-4">
                        <div class="form-group">
                            <label for="bengShikshaRegNo">Registration Number <b>(Bangla Shiksha Portal)</b>  </span></label>
                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input id="bengShikshaRegNo" name="bengShikshaRegNo" class="form-control" type="text" value="0<?php echo $app_data['bangla_shiksha_reg_number']; ?>" readonly >
                            <?php }else{?>
                                <input id="bengShikshaRegNo" name="bengShikshaRegNo" class="form-control" type="text" value="<?php echo set_value('bengShikshaRegNo'); ?>" readonly>
                            <?php }?>
                            <?php echo form_error('bengShikshaRegNo'); ?>
                        </div>
                    </div>

                    <!-- Add For Bangla Shiksha Reg No -->
                    <input type="hidden" id="basic_save_status" value="<?php echo $app_data['basic_d_save_status'];?>">
                    <input type="hidden" id="validate_error" value="<?php echo $validate_error;?>">
                    <input type="hidden" id="page" value="basic_page">
                    <!-- Add For Bangla Shiksha Reg No -->
					
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">First name <span class="text-danger">*</span></label>
                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $app_data['first_name']; ?>" placeholder="Enter First name" />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo set_value('fname') ?>" placeholder="Enter First name" />
                            <?php } ?>

                            <?php echo form_error('fname'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Middle name</label>
                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $app_data['middle_name']; ?>" placeholder="Enter Middle name" />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo set_value('mname') ?>" placeholder="Enter Middle name" />
                            <?php } ?>

                            <?php echo form_error('mname'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Last name <span class="text-danger">*</span></label>
                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $app_data['last_name']; ?>" placeholder="Enter Last name" />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname') ?>" placeholder="Enter Last name" />
                            <?php } ?>
                            <?php echo form_error('lname'); ?>
                        </div>
                    </div>

                </div>

                <div class="row">


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="father_name">Father name</label>
                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $app_data['father_name']; ?>" placeholder="Enter Father name" />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo set_value('father_name') ?>" placeholder="Enter Father name" />
                            <?php } ?>

                            <?php echo form_error('father_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mother_name">Mother name</label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?php echo $app_data['mothers_name']; ?>" placeholder="Enter Mother name" />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?php echo set_value('mother_name') ?>" placeholder="Enter Mother name" />
                            <?php } ?>

                            <?php echo form_error('mother_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="guardian_name">Guardian name <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" value="<?php echo $app_data['guardian_name']; ?>" placeholder="Enter Mother name" />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" value="<?php echo set_value('guardian_name') ?>" placeholder="Enter Guardian Name" />
                            <?php } ?>


                            <?php echo form_error('guardian_name'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="guardian_relation">Relationship with Guardian <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="guardian_relation" name="guardian_relation" value="<?php echo $app_data['guardian_relationship']; ?>" placeholder="Relationship with Guardian" />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="guardian_relation" name="guardian_relation" value="<?php echo set_value('guardian_relation') ?>" placeholder="Relationship with Guardian" />
                            <?php } ?>

                           
                            <?php echo form_error('guardian_relation'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Citizenship">Citizenship <span class="text-danger">*</span></label>
							<input type="hidden" name="citizenship" value="<?php echo $app_data['nationality_id_fk'];?>">
                            <select class="form-control" name="citizenship" id="citizenship" disabled>
                                <option value="" hidden="true">-- Select Citizenship --</option>
                                <?php foreach ($nationality as $val) { ?>

                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                        
                                        <option value="<?php echo $val['nationality_id_pk']; ?>" <?php echo $val['nationality_id_pk'] == $app_data['nationality_id_fk'] ? 'selected' : ''; ?> ><?php echo $val['nationality_name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $val['nationality_id_pk']; ?>" <?php echo set_select('citizenship', $val['nationality_id_pk']); ?>><?php echo $val['nationality_name']; ?></option>
                                <?php }
                                } ?>

                            </select>
                            <?php echo form_error('citizenship'); ?>
                        </div>
                    </div>


                    

                    <div class="col-md-4 citizenship_doc_div" <?php if (($formData['citizenship'] == 1) || ($formData['citizenship'] == NULL)) echo 'style="display: none;"'; ?>>

                   
                        
                        <div class="form-group">
                            <label class="" for="citizenship_doc">
                                Upload Citizenship Document
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 200KB)</small>
                            </label>

                            <?php if($app_data['citizenship_approval_doc'] !='') {?>

                            <small><a target="_blank" href="poly_institute/institute_list/download_citizenship_doc/<?php echo md5($app_data['institute_student_details_id_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-download" style="font-size:18px"> </i></a></small>
                            <?php } ?>
                               
                                

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="citizenship_doc" id="citizenship_doc" >
                                    </span>
                                </label>
                                <input type="text" class="form-control" disabled >
                            </div>
                            <?php echo form_error('citizenship_doc'); ?>
                        </div> 
                        
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="aadhar_no">Aadhar No.<span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" value="<?php echo $app_data['aadhar_no']; ?>" placeholder="Aadhar No."  />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" value="<?php echo set_value('aadhar_no') ?>" placeholder="Aadhar No."  />
                            <?php } ?>


                            <?php echo form_error('aadhar_no'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mob_no">Mobile No.<span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="mob_no" name="mob_no" value="<?php echo $app_data['mobile_number']; ?>" placeholder="Mobile No." pattern="^[6-9]\d{9}$" title="10 Digit Mobile No, Starting with 6 to 9" readonly />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="mob_no" name="mob_no" value="<?php echo set_value('mob_no') ?>" placeholder="Mobile No." pattern="^[6-9]\d{9}$" title="Ten Digit Mobile No, Starting with 6 to 9" readonly />
                            <?php } ?>


                            <?php echo form_error('mob_no'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email_id">Email ID <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="email" class="form-control" id="email_id" name="email_id" value="<?php echo $app_data['email']; ?>" placeholder="Email ID." readonly />
                            <?php } else { ?>
                                <input type="email" class="form-control" id="email_id" name="email_id" value="<?php echo set_value('email_id') ?>" placeholder="Email ID." readonly />
                            <?php } ?>
							 <?php echo form_error('email_id'); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Address 1 <span class="text-danger">*</span></label>
                            <!-- <textarea class="form-control" name="address" rows="3"><?php echo set_value('address'); ?></textarea> -->

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $app_data['address']; ?>" placeholder="Address 1"  readonly/>
                            <?php } else { ?>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address') ?>" placeholder="Address 1"  readonly/>
                            <?php } ?>



                            <?php echo form_error('address'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address_2">Address 2 </label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="address_2" name="address_2" value="<?php echo $app_data['address_2']; ?>" placeholder="Address 2" readonly />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="address_2" name="address_2" value="<?php echo set_value('address_2') ?>" placeholder="Address 2"  readonly />
                            <?php } ?>


                            <?php echo form_error('address_2'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address_3">Address 3 </label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="address_3" name="address_3" value="<?php echo $app_data['address_3']; ?>" placeholder="Address 3" readonly />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="address_3" name="address_3" value="<?php echo set_value('address_3') ?>" placeholder="Address 3" readonly />
                            <?php } ?>



                            <?php echo form_error('address_3'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">

                <div class="col-md-4">
                        <div class="form-group">
                            <label for="state">State <span class="text-danger">*</span></label>
							<input type="hidden" name="state" value="<?php echo $formData['state_id_fk'];?>">
                            <select name="state" id="state" class="form-control" disabled>
                                <option value="" hidden="true">Select state</option>
                                <?php foreach ($stateList as $key => $value) { ?>
                                    <option value="<?php echo $value['state_id_pk']; ?>" <?php if ($formData['state_id_fk'] == $value['state_id_pk']) echo 'selected'; ?> >
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
							
							<input type="hidden" name="district" value="<?php echo $formData['district_id_fk'];?>">
                            <select name="district" id="district" class="form-control"disabled >


                                <?php if (count($district)) { ?>
                                    <?php foreach ($district as $key => $value) { ?>
                                        <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($formData['district_id_fk'] == $value['district_id_pk']) echo 'selected'; ?>>
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

                    <div class="col-md-4 other_state_div" <?php if($formData['state_id_fk'] != 19) echo 'style="display: none;"'; ?>>
                        <div class="form-group">
                            <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
							<input type="hidden" name="subDivision" value="<?php echo $formData['sub_division_id_fk'];?>">
                            <select name="subDivision" id="subDivision" class="form-control" disabled>


                                <?php if (count($subDivision)) { ?>
                                    <?php foreach ($subDivision as $key => $value) { ?>
                                        <option value="<?php echo $value['subdiv_id_pk']; ?>" <?php if ($formData['sub_division_id_fk'] == $value['subdiv_id_pk']) echo 'selected'; ?>>
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

                    <div class="col-md-4 other_state_div" <?php if($formData['state_id_fk'] != 19) echo 'style="display: none;"'; ?>>
                        <div class="form-group">
                            <label for="municipality">Select Municipality/Block <span class="text-danger">*</span></label>
							<input type="hidden" name="municipality" value="<?php echo $formData['municipality_id_fk'];?>">
                            <select name="municipality" id="municipality" class="form-control" disabled>


                                <?php if (count($municipality)) { ?>
                                    <?php foreach ($municipality as $key => $value) { ?>
                                        <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($formData['municipality_id_fk'] == $value['block_municipality_id_pk']) echo 'selected'; ?>>
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



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pinCode">Pin Code <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input id="pinCode" name="pinCode" id="pinCode" class="form-control" type="text" value="<?php echo $app_data['pincode']; ?>" readonly>

                            <?php } else { ?>
                                <input id="pinCode" name="pinCode" id="pinCode" class="form-control" type="text" value="<?php echo set_value('pinCode'); ?>" readonly>
                            <?php } ?>

                            <?php echo form_error('pinCode'); ?>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="caste_id">Caste <span class="text-danger">*</span></label>
							<input type="hidden" name="caste_id" value="<?php echo $app_data['caste_id_fk']; ?>">
                            <select class="form-control" name="caste_id" id="caste_id" disabled>
                                <option value="" hidden="true">-- Caste --</option>
                                <?php foreach ($casteList as $val) { ?>

                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                        <option value="<?php echo $val['caste_id_pk']; ?>" <?php echo $val['caste_id_pk'] == $app_data['caste_id_fk'] ? 'selected' : ''; ?>><?php echo $val['caste_name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $val['caste_id_pk']; ?>" <?php echo set_select('caste_id', $val['caste_id_pk']); ?>><?php echo $val['caste_name']; ?></option>
                                <?php }
                                } ?>

                            </select>
                            <?php echo form_error('caste_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 caste_doc_div" <?php if (($formData['caste_id'] == 1) || ($formData['caste_id'] == NULL)) echo 'style="display: none;"'; ?>>

                        <div class="form-group">
                            <label class="" for="caste_doc">
                                Upload Caste Document
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 200KB)</small>
                            </label>

                        <?php if($app_data['caste_doc'] !='') {?>

                        <small><a target="_blank"href="poly_institute/institute_list/download_caste_doc/<?php echo md5($app_data['institute_student_details_id_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-download" style="font-size:18px"> </i></a></small>
                            <?php } ?>

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="caste_doc" id="caste_doc" disabled>
                                    </span>
                                </label>
                                <input type="text" class="form-control" disabled>
                            </div>
                            <?php echo form_error('caste_doc'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="religion_id">Religion</label>
                            <select class="form-control" name="religion_id" id="religion_id">
                                <option value="" hidden="true">-- Religion --</option>
                                <?php foreach ($religion as $val) { ?>

                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                        <option value="<?php echo $val['religion_id_pk']; ?>" <?php echo $val['religion_id_pk'] == $app_data['religion_id_fk'] ? 'selected' : ''; ?>><?php echo $val['religion_name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $val['religion_id_pk']; ?>" <?php echo set_select('religion_id', $val['religion_id_pk']); ?>><?php echo $val['religion_name']; ?></option>
                                <?php }
                                } ?>


                            </select>
                            <?php echo form_error('religion_id'); ?>
                        </div>
                    </div>

                    <!-- <div class="col-md-4 other_religion_div" <?php if ((set_value('religion_id') != 4) || (set_value('religion_id') == NULL)) echo 'style="display: none;"'; ?>>
                                            <div class="form-group">
                                                <label for="otherReligionName">Other Religion Name <span class="text-danger">*</span></label>
                                                <input id="otherReligionName" name="otherReligionName" class="form-control" type="text" value="<?php echo set_value('otherReligionName'); ?>">
                                                <?php echo form_error('otherReligionName'); ?>
                                            </div>
                                        </div> -->


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phy_challenged">Physically Challenged <span class="text-danger">*</span></label>
                            <select class="form-control" name="phy_challenged" id="phy_challenged">
                                <option value="" hidden="true">-- Physically Challenged --</option>

                                <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                    <option value="1" <?php echo $app_data['handicapped'] == '1' ? 'selected' : ''; ?>>Yes</option>
                                    <option value="0" <?php echo $app_data['handicapped'] == '0' ? 'selected' : ''; ?>>No</option>
                                <?php } else { ?>
                                    <option value="1" <?php echo set_select("phy_challenged", 1) ?>>Yes
                                    </option>
                                    <option value="0" <?php echo set_select("phy_challenged", 0) ?>>No
                                    </option>
                                <?php } ?>



                            </select>
                            <?php echo form_error('phy_challenged'); ?>
                        </div>
                    </div>
                                    
                    <div class="col-md-4 phy_challenged_doc_div" <?php if (($formData['phy_challenged'] == 0) || ($formData['phy_challenged'] == NULL)){ echo 'style="display: none;"';} ?>>

                        <div class="form-group">
                            <label class="" for="phy_challenged_doc">
                                Upload P.C Certificate
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 200KB)</small>
                            </label>
                            <?php if($app_data['phy_challenged_doc'] !='') {?>

                                <small><a target="_blank"href="poly_institute/institute_list/download_handicap_doc/<?php echo md5($app_data['institute_student_details_id_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-download" style="font-size:18px"> </i></a></small>
                            <?php } ?>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="phy_challenged_doc" id="phy_challenged_doc" disabled>
                                    </span>
                                </label>
                                <input type="text" class="form-control" disabled>
                            </div>
                            <?php echo form_error('phy_challenged_doc'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="datepicker">D.O.B (MM/DD/YYYY) <span class="text-danger">*</span></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="common_input_div">
                                <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                    <input type="text" class="form-control datepicker" id="std_dob" name="dob" value="<?php if($app_data['date_of_birth']!=''){echo date('m/d/Y', strtotime($app_data['date_of_birth']));} ?>" placeholder="MM/DD/YYYY" readonly />
                                <?php } else { ?>
                                    <input type="text" class="form-control datepicker" id="std_dob" name="dob" value="<?php echo set_value('dob') ?>" placeholder="Enter DOB" <?php echo $disabled; ?> readonly />
                                <?php } ?>

                            </div>
                        </div>
                        <?php echo form_error('dob'); ?>
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">
                            <label class="" for="aadhar_doc">
                                Upload Aadhar
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 200KB)</small>
                            </label>
                            <?php if($app_data['aadhar_doc'] !='') {?>

                                <small><a target="_blank"href="poly_institute/institute_list/download_aadhaar_doc/<?php echo md5($app_data['institute_student_details_id_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-download" style="font-size:18px"> </i></a></small>
                            <?php } ?>

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="aadhar_doc" id="aadhar_doc" disabled>
                                    </span>
                                </label>
                                <input type="text" class="form-control" disabled>
                            </div>
                            <?php echo form_error('aadhar_doc'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender <span class="text-danger">*</span></label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="">-- Select Gender --</option>
                                <?php foreach ($genders as $gender) { ?>

                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                        <option value="<?php echo $gender['gender_id_pk']; ?>" <?php echo $gender['gender_id_pk'] == $app_data['gender_id_fk'] ? 'selected' : ''; ?>><?php echo $gender['gender_description']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $gender['gender_id_pk']; ?>" <?php echo set_select('gender', $gender['gender_id_pk']); ?>><?php echo $gender['gender_description']; ?></option>
                                    <?php } ?>

                                <?php } ?>
                            </select>
                            <?php echo form_error('gender'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="marital_status">Marital Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="marital_status" id="marital_status">
                                <option value="" hidden="true">-- Select Marital Status --</option>


                                <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                    <option value="1" <?php echo $app_data['marital_status'] == '1' ? 'selected' : ''; ?>>Married</option>

                                    <option value="2" <?php echo $app_data['marital_status'] == '2' ? 'selected' : ''; ?>>Unmarried</option>
                                <?php } else { ?>

                                    <option value="1" <?php echo set_select("marital_status", 1) ?>>
                                        Married</option>
                                    <option value="2" <?php echo set_select("marital_status", 2) ?>>
                                        Unmarried</option>

                                <?php } ?>
                            </select>
                            <?php echo form_error('marital_status'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 kanyashree_no_div" style="display:<?php echo $kanyas_view; ?>" >
                        <div class="form-group">
                            <label for="kanyashree_no">Kanyashree Enrolment Number </label>
                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input id="kanyashree_no" name="kanyashree_no" class="form-control" type="text"  value="<?php echo $app_data['kanyashree_no']; ?>" readonly>
                            <?php } else { ?>
                                <input id="kanyashree_no" name="kanyashree_no" class="form-control" type="text" value="<?php echo set_value('kanyashree_no'); ?>" readonly >
                                <?php } ?>
                            <?php echo form_error('kanyashree_no'); ?>
                        </div>
                    </div>




                </div>

                <h4><b style="color:blue;">Photo & Signature </b></h4>
                <hr>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group ">
                            <label>Upload Signature <span class="text-danger">*</span> (JPEG format between 100KB. Dimensions 250x320 pixels preferred)</label>
                            <input type="file" class="form-control" placeholder="Signature" name="sign" id="sign" value="" <?php echo $disabled; ?> disabled>
                            <?php echo form_error('sign'); ?>
                        </div>
                    </div>

                    <?php if ($app_data['sign'] != '') { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="photo-box">
                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($app_data['sign']); ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <label>Upload Photo <span class="text-danger">*</span> (JPEG format between 100KB. Dimensions 250x320 pixels preferred)</label>
                            <input type="file" class="form-control" placeholder="Photo" name="photo" id="photo" value="" <?php echo $disabled; ?> disabled>
                            <?php echo form_error('photo'); ?>
                        </div>
                    </div>

                    <?php if ($app_data['picture'] != '') { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="photo-box">
                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($app_data['picture']); ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


                <h4><b style="color:blue;">Particulars of the last Examination Passed</b></h4>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="board_id">Select Board name <span
                                    class="text-danger">*</span></label>
							<input type="hidden" name="board_id" value="<?php echo $formData['board_id'];?>">
                            <select class="form-control" name="board_id" id="board_id" disabled>
                                <option value="" hidden="true">Select Board name</option>
                                <?php foreach ($board_name as $value) { ?>
                                    <option value="<?php echo $value['board_id_pk']?>" <?php if($formData['board_id'] == $value['board_id_pk']){echo 'selected';}?>><?php echo $value['board_name']?></option>
                                <?php }?>
                                
                                

                            </select>
                            <?php echo form_error('board_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="institute_name">Name of the Last Institute <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="text" class="form-control" id="institute_name" name="institute_name" value="<?php echo $app_data['institute_name']; ?>" placeholder="Institute Name" readonly />
                            <?php } else { ?>
                                <input type="text" class="form-control" id="institute_name" name="institute_name" value="<?php echo set_value('institute_name') ?>" placeholder="Institute Name" readonly />
                            <?php } ?>



                            <?php echo form_error('institute_name'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="passing_year">Year of Passing <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="passing_year" name="passing_year" value="<?php echo $app_data['year_of_passing']; ?>" placeholder="Passing Year" readonly />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="passing_year" name="passing_year" value="<?php echo set_value('passing_year') ?>" placeholder="Passing Year" readonly />
                            <?php } ?>



                            <?php echo form_error('passing_year'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <input type="hidden" id="exam_type_id" value="<?php echo $app_data['exam_type_id_fk'];?>">
                    
                    <h5 >
                        <?php 
                            if($app_data['exam_type_id_fk'] == 3)
                            {
                               
                                echo'<div class="clearfix"></div>
                                <br>


                                <h4 style="margin-left:30px"> <b>Examination Qualified - Class 12/Higher Secondary in Science Stream</b></h4>
                                <hr>';
                            }
                            elseif($app_data['exam_type_id_fk'] == 1){
                                echo '<h4 style="margin-left:30px"> <b>Examination Qualified - Class 10 / Madhyamik/Equivalent Examination</b></h4>';
                            }elseif($app_data['exam_type_id_fk'] == 2){
                                echo '<h4 style="margin-left:30px"> <b>Examination Qualified - Class 12/Higher Secondary/Higher Secondary (Vocational)/Equivalent Examination/ITI (2 years continuous)</b></h4>';
                            }
                        ?>
                    </h5>
                   
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fullmark">Total Aggregate Marks <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="fullmark" name="fullmark" value="<?php echo $app_data['fullmarks']; ?>" placeholder="Full Marks" readonly />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="fullmark" name="fullmark" value="<?php echo set_value('fullmark') ?>" placeholder="Full Marks" readonly />
                            <?php } ?>



                            <?php echo form_error('fullmark'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mark_obtain">Marks Obtained <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="marks_obtain" name="marks_obtain" value="<?php echo $app_data['marks_obtain']; ?>" placeholder="Marks Obtain" readonly />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="marks_obtain" name="marks_obtain" value="<?php echo set_value('marks_obtain') ?>" placeholder="Marks Obtain" readonly />
                            <?php } ?>



                            <?php echo form_error('marks_obtain'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="percentage">Percentage % <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="percentage" name="percentage" value="<?php echo $app_data['percentage']; ?>" placeholder="Percentage" readonly />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="percentage" name="percentage" value="<?php echo set_value('percentage') ?>" placeholder="Percentage" readonly />
                            <?php } ?>
                             <?php echo form_error('percentage'); ?>
                        </div>
                    </div>

                   

                </div>
                
                <div class="row" id="marks_submit_div" style="display:<?php echo $suj_marks_view; ?>;">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullmark">Marks of Physics<span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="phy_marks" name="phy_marks" value="<?php echo $app_data['phy_marks']; ?>" placeholder="Marks of Physics" step=".01" readonly />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="phy_marks" name="phy_marks" value="<?php echo set_value('phy_marks') ?>" placeholder="Marks of Physics" step=".01" readonly />
                            <?php } ?>



                            <?php echo form_error('phy_marks'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="chem_marks">Marks of Chemistry <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="chem_marks" name="chem_marks" value="<?php echo $app_data['chem_marks']; ?>" placeholder="Marks of Chemistry" step=".01" readonly />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="chem_marks" name="chem_marks" value="<?php echo set_value('chem_marks') ?>" placeholder="Marks of Chemistry" step=".01" readonly />
                            <?php } ?>


                            <?php echo form_error('chem_marks'); ?>
                        </div>
                    </div>
               
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="math_bio_marks">Marks of Biology /Mathematics <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="math_bio_marks" name="math_bio_marks" value="<?php echo $app_data['math_bio_marks']; ?>" placeholder="Marks of Biology /Mathematics" step=".01" readonly />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="math_bio_marks" name="math_bio_marks" value="<?php echo set_value('math_bio_marks') ?>" placeholder="Marks of or Biology /Mathematics" step=".01" readonly />
                            <?php } ?>



                            <?php echo form_error('math_bio_marks'); ?>
                        </div>
                    </div>
         
                </div>



                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              
                <div class="btn-group blink_text" style="display:none;">
                    <label>&nbsp;</label><br>
					<?php if($app_data['exam_type_id_fk'] == 1){?>
                    <span class="btn-border pull-right blink text-danger">***You are Fail because your percentage is below 25*</span>
					<?php }else{?>
					<span class="btn-border pull-right blink text-danger">***You are Fail because your percentage is below 30*</span>
					<?php }?>
                </div>
                <?php // if ($app_data['final_save_status'] != 1) { ?>
                <button type="submit" class="btn btn-primary pull-right edu_save_btn">Update</button>
                <?php  // } 
                ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>


    </section>
    <?php //$this->load->view($this->config->item('theme_uri').'assessor_profile/terms_condition_view'); ?>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>