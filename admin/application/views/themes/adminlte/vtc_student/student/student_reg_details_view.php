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
                <?php $std_id = md5($student_data['student_id_pk']); ?>
                <?php echo form_open_multipart("admin/vtc_student/student_reg/student_details/".$std_id); ?>

                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcCode">VTC Code <span class="text-danger">*</span></label>
                            <input id="vtcCode" name="vtcCode" class="form-control" type="text" value="<?php echo $school_data['vtc_code']; ?>" readonly>
                            <?php echo form_error('vtcCode'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcName">VTC Name <span class="text-danger">*</span></label>
                            <input id="vtcName" name="vtcName" class="form-control" type="text" value="<?php echo $school_data['vtc_name']; ?>" readonly>
                            <?php echo form_error('vtcName'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="udise_code">UDISE Code</label>
                            <input id="udise_code" name="udise_code" class="form-control" type="text" value="<?php echo set_value('udise_code'); ?>">
                            <?php echo form_error('udise_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="admissionYear">Year of Admission <span class="text-danger">*</span></label>
                            <input id="admissionYear" name="admissionYear" class="form-control" type="text" value="<?php echo $academic_year; ?>" readonly>
                            <?php echo form_error('admissionYear'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bengShikshaRegNo">Registration Number <b>(Bangla Shiksha Portal)</b>  </span></label>
                            <input id="bengShikshaRegNo" name="bengShikshaRegNo" class="form-control" type="text" value="<?php echo $form_data['bangla_shiksha_reg_number']; ?>">
                            
                            <?php echo form_error('bengShikshaRegNo'); ?>
                        </div>
                    </div>
                    
                </div>

                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Basic Details:</strong></h4>
                <div class="content-block">
                    <div class="row">
                        <!--div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Salutation <span class="text-danger">*</span></label>
                                <select class="form-control" name="salutation" id="salutation">
                                    <option value="">-- Salutation --</option>
                                    <?php foreach($salutations as $salutation){ ?>
                                    <option value="<?php echo $salutation['salutation_id_pk'] ?>" <?php if($form_data['salutation_id_fk']== $salutation['salutation_id_pk']){echo 'selected';} ?>><?php echo $salutation['salutation_desc'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('salutation'); ?>
                            </div>
                        </div-->

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">First name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo $form_data['first_name']; ?>" name="fname" id="fname" class="form-control"  placeholder="First name">
                                <?php echo form_error('fname'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Middle name</label>
                                <input type="text" value="<?php echo $form_data['middle_name']; ?>" name="mname" id="mname" class="form-control"  placeholder="Middle name">
                                <?php echo form_error('mname'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Last name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo $form_data['last_name']; ?>" name="lname" id="lname" class="form-control"  placeholder="Last name">
                                <?php echo form_error('lname'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="father_name">Father name </label>
                                <input type="text" value="<?php echo $form_data['father_name']; ?>" name="father_name" id="father_name" class="form-control"  placeholder="Father name">
                                <?php echo form_error('father_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mother_name">Mother name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo $form_data['mothers_name']; ?>" name="mother_name" id="mother_name" class="form-control"  placeholder="Mother name">
                                <?php echo form_error('mother_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="guardian_name">Guardian name <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo $form_data['guardian_name']; ?>" name="guardian_name" id="guardian_name" class="form-control"  placeholder="Guardian name">
                                <?php echo form_error('guardian_name'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="guardian_relation">Relationship with Guardian <span class="text-danger">*</span></label>
                                <!--input type="text" value="<?php echo $form_data['guardian_relationship']; ?>" name="guardian_relation" id="guardian_relation" class="form-control"  placeholder="Guardian name"-->
								<select name="guardian_relation" id="guardian_relation" class="form-control">
									<option value="" hidden="true">Select Relationship with Guardian</option>

									<?php foreach ($guardian_relation as $value) {?>
									<option value="<?php echo $value['guardian_relationship_id_pk']?>" <?php if($form_data['guardian_relationship'] == $value['guardian_relationship_id_pk']){echo 'selected';} ?>>
										<?php echo $value['relationship_name'];?> </option>
									<?php }?> 

								</select>
                                <?php echo form_error('guardian_relation'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="citizenship">Citizenship<span class="text-danger">*</span></label>
                                <select class="form-control" name="citizenship" id="citizenship">
                                    <option value="" hidden="true">-- Select Citizenship --</option>
                                    <?php foreach ($nationality as $key => $value) {?>
                                       
                                        <option value="<?=$value['nationality_id_pk'];?>" <?php if($form_data['nationality_id_fk'] == $value['nationality_id_pk']){echo 'selected';} ?>><?=$value['nationality_name']?></option>
                                    <?php }?>
                                    
                                </select>
                                <?php echo form_error('citizenship'); ?>
                            </div>
                        </div>

                        <div class="col-md-4 citizenship_doc_div" <?php if (($form_data['nationality_id_fk'] == 1) || ($form_data['nationality_id_fk'] == NULL)) echo 'style="display: none;"'; ?>>
                            
                            <div class="form-group">
                                <label class="" for="approval_doc">
                                Upload Council Approval 
                                    <span class="text-danger">*</span>
                                    <!-- <br> -->
                                    <small>(.PDF only, Max 200KB)</small>
                                    <?php if($student_data['citizenship_approval_doc'] !='') {?>
                                        <a href="<?php echo base_url('admin/vtc_student/student_reg/showApproval_doc/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <?php }?>
                                </label>
                            
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            Browse&hellip;<input type="file" style="display: none;" name="approval_doc" id="approval_doc">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <?php echo form_error('approval_doc'); ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="aadhar_no">Aadhar No.<span class="text-danger">*</span></label>
                                <input type="number" value="<?php echo $form_data['aadhar_no']; ?>" name="aadhar_no" id="aadhar_no" class="form-control"  placeholder="Aadhar No.">
                                <?php echo form_error('aadhar_no'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mob_no">Mobile No.<span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo $form_data['mobile']; ?>" name="mob_no" id="mob_no" class="form-control"  placeholder="Mobile No." pattern="^[6-9]\d{9}$" title="Ten Digit Mobile No, Starting with 6 to 9">
                                <?php echo form_error('mob_no'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email_id">Email ID <span class="text-danger">*</span></label>
                                <input type="email" value="<?php echo $form_data['email']; ?>" name="email_id" id="email_id" class="form-control" placeholder="Email ID">
                                <?php echo form_error('email_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address 1 <span class="text-danger">*</span></label>
                                <!-- <textarea class="form-control" name="address" rows="3"><?php echo set_value('address'); ?></textarea> -->
                                <input type="text" value="<?php echo $form_data['address']; ?>" name="address" id="address" class="form-control" placeholder="Address 1">

                                <?php echo form_error('address'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address 2 </label>
                                <input type="text" value="<?php echo $form_data['address_2']; ?>" name="address_2" id="address_2" class="form-control" placeholder="Address 2">

                                <?php echo form_error('address_2'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address 3 </label>
                                    <input type="text" value="<?php echo $form_data['address_3']; ?>" name="address_3" id="address_3" class="form-control" placeholder="Address 3">

                                <?php echo form_error('address_3'); ?>
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
                                        <option value="<?php echo $value['state_id_pk']; ?>" <?php if ($form_data['state_id_fk'] == $value['state_id_pk']) echo 'selected'; ?>>
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
                                    <option value="" hidden="true">Select District</option>
                                    <?php foreach ($districtList as $key => $value) { ?>
                                        <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($form_data['district_id_fk'] == $value['district_id_pk']) echo 'selected'; ?>>
                                            <?php echo $value['district_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('district'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 other_state_div" <?php if ($form_data['state_id_fk'] != 19 ) echo 'style="display: none;"'; ?>>
                            

                            <div class="form-group">
                                <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                                <select name="subDivision" id="subDivision" class="form-control">
                                    <option value="" hidden="true">Select Sub Division</option>
                                    <?php if (count($subDivision)) { ?>
                                        <?php foreach ($subDivision as $key => $value) { ?>
                                            <option value="<?php echo $value['subdiv_id_pk']; ?>" <?php if ($form_data['subdiv_id_fk'] == $value['subdiv_id_pk']) echo 'selected'; ?>>
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
                        <div class="col-md-4 other_state_div" <?php if ($form_data['state_id_fk'] != 19 ) echo 'style="display: none;"'; ?>>
                            

                            <div class="form-group">
                                <label for="municipality">Municipality </label>
                                <select name="municipality" id="municipality" class="form-control">
                                    <option value="" hidden="true">Select Municipality</option>
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
                                <label for="pinCode">Pin Code <span class="text-danger">*</span></label>
                                <input id="pinCode" name="pinCode" class="form-control" type="text" value="<?php echo $form_data['pin']; ?>">
                                <?php echo form_error('pinCode'); ?>
                            </div>
                        </div>

                       

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="caste_id">Caste <span class="text-danger">*</span></label>
                                <select class="form-control" name="caste_id" id="caste_id">
                                    <option value="" hidden="true">-- Caste --</option>
                                    <?php foreach($casteList as $val){ ?>
                                    <option value="<?php echo $val['caste_id_pk'] ?>" <?php if($form_data['caste'] == $val['caste_id_pk']){echo 'selected';} ?>><?php echo $val['caste_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('caste_id'); ?>
                            </div>
                        </div>

                    <!-- </div>
                    <div class="row"> -->

                        <div class="col-md-4 caste_doc_div" <?php if ($form_data['caste'] == 1 ) echo 'style="display: none;"'; ?>>
                            
                            <div class="form-group">
                                <label class="" for="caste_doc">
                                Upload Caste Document 
                                    <span class="text-danger">*</span>
                                    <!-- <br> -->
                                    <small>(.PDF only, Max 100KB)</small>
                                    <?php if($student_data['caste_doc'] !='') {?>
                                        <a href="<?php echo base_url('admin/vtc_student/student_reg/showCastedoc/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i>Uploaded</a>
                                    <?php }?>
                                </label>
                            
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            Browse&hellip;<input type="file" style="display: none;" name="caste_doc" id="caste_doc">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <?php echo form_error('caste_doc'); ?>
                            </div>
                        </div>
                    

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="religion_id">Religion <span class="text-danger">*</span></label>
                                <select class="form-control" name="religion_id" id="religion_id">
                                    <option value="" hidden="true">-- Religion --</option>
                                    <?php foreach($religion as $val){ ?>
                                    <option value="<?php echo $val['religion_id_pk'] ?>" <?php if($form_data['religion'] == $val['religion_id_pk']){echo 'selected';} ?>><?php echo $val['religion_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('religion_id'); ?>
                            </div>
                        </div>

                        <!--div class="col-md-4 other_religion_div" <?php if (($form_data['religion'] != 4) || ($form_data['religion'] == NULL)) echo 'style="display: none;"'; ?>>
                            <div class="form-group">
                                <label for="otherReligionName">Other Religion Name <span class="text-danger">*</span></label>
                                <input id="otherReligionName" name="otherReligionName" class="form-control" type="text" value="<?php echo $form_data['other_religion_name']; ?>">
                                <?php echo form_error('otherReligionName'); ?>
                            </div>
                        </div-->

                    <!-- </div>
                    <div class="row"> -->


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phy_challenged">Physically Challenged (P.C) <span class="text-danger">*</span></label>
                                <select class="form-control" name="phy_challenged" id="phy_challenged">
                                    <option value="" hidden="true">-- Physically Challenged --</option>
                                    
                                    <option value="1" <?php if($form_data['physically_challenged'] == 1){echo 'selected';} ?>>Yes</option>
                                    <option value="0" <?php if($form_data['physically_challenged'] == 0){echo 'selected';} ?>>No</option>
                                    
                                </select>
                                <?php echo form_error('phy_challenged'); ?>
                            </div>
                        </div>

                        <div class="col-md-4 phy_challenged_doc_div" <?php if (($form_data['physically_challenged'] == 0) || ($form_data['physically_challenged'] == NULL)) echo 'style="display: none;"'; ?>>
                            
                            <div class="form-group">
                                <label class="" for="phy_challenged_doc">
                                Upload P.C Certificate 
                                    <span class="text-danger">*</span>
                                    <!-- <br> -->
                                    <small>(.PDF only, Max 200KB)</small>

                                    <?php if($student_data['phy_challenged_doc'] !='') {?>
                                        <a href="<?php echo base_url('admin/vtc_student/student_reg/show_phy_challenged_doc/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i>Uploaded</a>
                                    <?php }?>
                                </label>
                            
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            Browse&hellip;<input type="file" style="display: none;" name="phy_challenged_doc" id="phy_challenged_doc">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <?php echo form_error('phy_challenged_doc'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="datepicker">D.O.B (as per Aadhar) <span class="text-danger">*</span></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="common_input_div">
                                    <input type="text" value="<?php echo date('d/m/Y',strtotime($student_data['date_of_birth'])); ?>" class="form-control pull-right datepicker" id="dob" name="dob" placeholder="DD/MM/YYYY" autocomplete="off">
                                </div>
                            </div>
                            <?php echo form_error('dob'); ?>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-4">
                            
                            <div class="form-group">
                                <label class="" for="std_image">
                                Upload Student Photo 
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
						
						<?php if($student_data['image'] !='') {?>
						
							<div class="col-md-1">
								<div class="form-group">
									<div class="photo-box">
										<img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($student_data['image']); ?>">
									</div>
								</div>
							</div>
							<!--a href="<?php echo base_url('admin/vtc_student/student_reg/showStudentImage/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a-->
						<?php }?>

                        <div class="col-md-4">
                                            
                            <div class="form-group">
                                <label class="" for="std_signature">
                                Upload Student Signature 
                                    <span class="text-danger">*</span>
                                    <!-- <br> -->
                                    <small>(.jpeg only,max 50 KB)</small>,

                                    
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
						<?php if($student_data['std_signature'] !='') {?>
						
							<div class="col-md-1">
								<div class="form-group">
									<div class="photo-box">
										<img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($student_data['std_signature']); ?>">
									</div>
								</div>
							</div>
                                <!--a href="<?php echo base_url('admin/vtc_student/student_reg/show_std_signature/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a-->
                        <?php }?>

                        <div class="col-md-4">
                            
                            <div class="form-group">
                                <label class="" for="aadhar_doc">
                                Upload Aadhar 
                                    <span class="text-danger">*</span>
                                    <!-- <br> -->
                                    <small>(.PDF only, Max 200KB)</small>

                                    <?php if($student_data['aadhar_doc'] !='') {?>
                                        <a href="<?php echo base_url('admin/vtc_student/student_reg/show_aadhar_doc/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i>Uploaded</a>
                                    <?php }?>
                                </label>
                            
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            Browse&hellip;<input type="file" style="display: none;" name="aadhar_doc" id="aadhar_doc">
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <?php echo form_error('aadhar_doc'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                       

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                <select class="form-control" name="gender" id="gender">
                                    <option value="">-- Select Gender --</option>
                                    <?php foreach($genders as $gender){ ?>
                                    <option value="<?php echo $gender['gender_id_pk'] ?>" <?php if($student_data['gender_id_fk'] == $gender['gender_id_pk']){echo 'selected';} ?>><?php echo $gender['gender_description'] ?></option>
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
                                    
                                    <option value="1" <?php if($form_data['marital_status'] == 1){echo 'selected';} ?>>Married</option>
                                    <option value="2" <?php if($form_data['marital_status'] == 2){echo 'selected';} ?>>Unmarried</option>
                                    
                                </select>
                                <?php echo form_error('marital_status'); ?>
                            </div>
                        </div>

                        <div class="col-md-4 kanyashree_no_div" <?php if (($form_data['marital_status'] == 2 && $form_data['gender_id_fk'] == 2) ){ echo 'style="display: block;';}else{echo 'style="display: none;';} ?>>
                            <div class="form-group">
                                <label for="kanyashree_no">Kanyashree Enrolment  Number </label>
                                <input id="kanyashree_no" name="kanyashree_no" class="form-control" type="text" value="<?php echo $form_data['kanyashree_no']; ?>">
                                <?php echo form_error('kanyashree_no'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Present Academic details:</strong></h4>
                <div class="content-block">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="course_name_id">Select course name <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="course_name_id" id="course_name_id">
                                    <option value="" hidden="true">Select course name</option>
                                    <!--option value="1" <?php if($form_data['class_id_fk'] == '1'){echo 'selected';}?>>HS-Voc</option-->
                                    <option value="4" <?php if($form_data['class_id_fk'] == '4'){echo 'selected';}?>>VIII+ STC</option>

                                </select>
                                <?php echo form_error('course_name_id'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="group_id">Select Group/Trade Name <span class="text-danger">*</span></label>
                                <select name="group_id" id="group_id" class="form-control">
                                    <option value="" hidden="true">Select Group/Trade</option>
                                    <?php if (count($group)) { ?>
                                        <?php foreach ($group as $key => $value) { ?>
                                            <option value="<?php echo $value['group_id_pk']; ?>" <?php if ($form_data['course_id_fk'] == $value['group_id_pk']) echo 'selected'; ?>>
                                                <?php echo $value['group_name']; ?>
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled>No Data Found...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('group_id'); ?>
                            </div>
                        </div>

                        <div class="col-md-4 batch_duration_div" <?php if (($form_data['class_id_fk'] == 1 ) || ($form_data['class_id_fk'] == NULL)) echo 'style="display: none;"'; ?>>
                            <div class="form-group">
                                <label class="" for="batch_duration">Select Batch Duration <span class="text-danger">*</span></label>
                                <?php /* if(count($group_details)){?>

                                    <select class="form-control" name="batch_duration" id="batch_duration">
                                        <option value="" hidden="true">Select Batch Duration</option>
                                        <?php if($group_details['duration'] == 6){?>
                                            <option value="2" <?php if($form_data['phase'] == 2){echo 'selected';} ?>> July to December (6 Months)</option>
                                            <?php $month = date('m');
                                            if($month <= '06'){?>

                                            
                                                <option value="3" <?php if($form_data['phase'] == 3){echo 'selected';} ?>>
                                                    January to June (6 Months)
                                                </option>
                                            
                                            <?php }
                                        } elseif ($group_details['duration'] == 6) {?>
                                            <option value="1"<?php if($form_data['phase'] == 1){echo 'selected';} ?> > July to June (1 Year)</option>
                                        <?php }?>
                                    </select>

                                <?php }else{?>
                                    <select class="form-control" name="batch_duration" id="batch_duration">
                                        <option value="" hidden="true">Select Batch Duration</option>
                                    </select>
                                <?php } */?>
                                 <input type="number" class="form-control" name="batch_duration" id="batch_duration" value="<?php echo $form_data['phase']?>" readonly>

                                <?php echo form_error('batch_duration'); ?>
                            </div>
                        </div>

                       
                    </div>
                </div>

                <hr>
                <h4><i class="fa fa-circle-o text-orange"></i> <strong>Particulars of the last Examination Passed:</strong></h4>
                <div class="content-block">


                    <div class="card-body text-dark stc_last_exam_div" <?php if ($form_data['class_id_fk'] == 4 ){echo 'style="display: block;"';}else{echo 'style="display: none;"';}  ?>>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_exam_id">Last  Academic exam passed <span class="text-danger">*</span></label>
                                    <select class="form-control" name="last_exam_id" id="last_exam_id">
                                        <option value="">Select Last Exam</option>
                                        <?php foreach($last_exam as $exam){ ?>
                                            <option value="<?php echo $exam['last_academic_exam_id_pk'] ?>" <?php if($form_data['last_academic_exam_id_fk'] == $exam['last_academic_exam_id_pk']){echo 'selected';} ?>><?php echo $exam['exam_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('last_exam_id'); ?>
                                </div>
                            </div>

                           

                            <div class="col-md-5">
                                
                                <div class="form-group">
                                    <label class="" for="marksheet">
                                    Upload mark sheet/certificate of passing 
                                        <span class="text-danger">*</span>
                                        <!-- <br> -->
                                        <small>(.PDF only, Max 200KB)</small>

                                        <?php if($student_data['marksheet'] !='') {?>
                                            <a href="<?php echo base_url('admin/vtc_student/student_reg/show_marksheet/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success marksheet_btn"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }?>
                                    </label>
                                
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-success">
                                                Browse&hellip;<input type="file" style="display: none;" name="marksheet" id="marksheet">
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <?php echo form_error('marksheet'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <span>
                                    Have you ever registered under WBSCT&VE&SD for VIII+ STC? (yes/no)
                                    <span class="text-danger">*</span>
                                    <?php echo form_error('haveRegisterNo'); ?>
                                </span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check-inline">
                                    <label class="radio-inline">
                                        <input type="radio" class="form-check-input" name="haveRegisterNo" id="haveRegisterNo" value="1" <?php if ($form_data['council_register'] == 1) echo 'checked' ?>> Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="radio-inline">
                                        <input type="radio" class="form-check-input" name="haveRegisterNo" id="haveRegisterNo" value="0" <?php if ($form_data['council_register'] == 0) echo 'checked' ?>> No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row stc_reg_div" <?php if ($form_data['council_register'] != 1) echo 'style="display: none;"'; ?>>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="old_reg_no">Registration No<span class="text-danger">*</span></label>
                                    <input type="number" value="<?php echo $form_data["old_reg_no"]; ?>" name="old_reg_no" id="old_reg_no" class="form-control"  placeholder="Registration No">
                                    <?php echo form_error('old_reg_no'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="old_reg_year">Year of registration<span class="text-danger">*</span></label>
                                    <!-- <input type="number" value="<?php echo $form_data["old_reg_year"]; ?>" name="old_reg_year" id="old_reg_year" class="form-control"  placeholder="Year of registration"> -->
                                    <select class="form-control" name="old_reg_year" id="old_reg_year">
                                        <option value="" hidden="true">Select Year</option>
                                        <?php for ($i = 2005; $i <= date('Y'); $i++) { ?>
                                            
                                            <option value="<?php echo $i; ?>" <?php if($form_data["old_reg_year"] == $i) {echo 'selected';}?>>
                                                <?php echo $i; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('old_reg_year'); ?>
                                </div>
                            </div>

                            
                        </div>

                    </div>


                    <!-- If HS-voc is selected in previous menu -->

                    <div class="card-body text-dark HSVoc_last_exam_div" <?php if ($form_data['class_id_fk'] == 1 ){echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ten_passing_year">year of passing class X <span class="text-danger">*</span></label>
                                    <input type="number" value="<?php echo $form_data["ten_passing_year"]; ?>" name="ten_passing_year" id="ten_passing_year" class="form-control"  placeholder="Year of registration">
                                    <?php echo form_error('ten_passing_year'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="board_name">Name of the BOARD/COUNCIL  <span class="text-danger">*</span></label>
                                    <select class="form-control" name="board_name" id="board_name">
                                        <option value="">Select BOARD/COUNCIL</option>
                                        <?php foreach($boardList as $val){ ?>
                                            <option value="<?php echo $val['board_id_pk'] ?>" <?php if($form_data['board_id_fk'] == $val['board_id_pk']){echo 'selected';} ?>><?php echo $val['board_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('board_name'); ?>
                                </div>
                            </div>

                            <div class="col-md-5">
                                
                                <div class="form-group">
                                    <label class="" for="hs_marksheet">
                                    Upload class X mark sheet 
                                        <span class="text-danger">*</span>
                                        <!-- <br> -->
                                        <small>(.PDF only, Max 200KB)</small>
                                        <?php if($student_data['marksheet'] !='') {?>
                                            <a href="<?php echo base_url('admin/vtc_student/student_reg/show_marksheet/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }?>
                                    </label>
                                
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-success">
                                                Browse&hellip;<input type="file" style="display: none;" name="hs_marksheet" id="hs_marksheet">
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <?php echo form_error('hs_marksheet'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="school_state">State of location of school from which passed class X <span class="text-danger">*</span></label>
                                    <select class="form-control" name="school_state" id="school_state">
                                        <option value="">Select State</option>
                                        <?php foreach($stateList as $state){ ?>
                                        <option value="<?php echo $state['state_id_pk'] ?>" <?php if($form_data['ten_school_state']==$state['state_id_pk']){echo 'selected';} ?>><?php echo $state['state_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('school_state'); ?>
                                </div>
                            </div>

                            <div class="col-md-6 migrate_certificate_div" <?php if ($form_data['ten_school_state'] == 19 || $form_data['ten_school_state'] == NULL ) echo 'style="display: none;"'; ?>>
                                
                                <div class="form-group">
                                    <label class="" for="migration_certificate">
                                        Upload migration certificate 
                                        <span class="text-danger">*</span>
                                        <!-- <br> -->
                                        <small>(.PDF only, Max 200KB)</small>

                                        <?php if($student_data['migration_certificate'] !='') {?>
                                            <a href="<?php echo base_url('admin/vtc_student/student_reg/show_migration_certificate/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }?>

                                    </label>
                                
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-success">
                                                Browse&hellip;<input type="file" style="display: none;" name="migration_certificate" id="migration_certificate">
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <?php echo form_error('migration_certificate'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_marks">Total  Marks<span class="text-danger">*</span></label>
                                    <input type="number" value="<?php echo $form_data['total_marks']; ?>" name="total_marks" id="total_marks" class="form-control"  placeholder="Total  Marks">
                                    <?php echo form_error('total_marks'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="aggregate_marks">Aggregate Marks<span class="text-danger">*</span></label>
                                    <input type="number" value="<?php echo $form_data['aggregate_marks']; ?>" name="aggregate_marks" id="aggregate_marks" class="form-control"  placeholder="Aggregate  Marks">
                                    <?php echo form_error('aggregate_marks'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="percentage_marks">Percentage<span class="text-danger">*</span></label>
                                    <input type="number" value="<?php echo $form_data['percentage']; ?>" name="percentage_marks" id="percentage_marks" class="form-control"  placeholder="Percentage" readonly>
                                    <?php echo form_error('percentage_marks'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <span>
                                    Have you ever registered under WBSCT&VE&SD for HS-Voc? (yes/no)
                                    <span class="text-danger">*</span>
                                    <?php echo form_error('haveHSRegisterNo'); ?>
                                </span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="haveHSRegisterNo" value="1" <?php if ($form_data['council_register'] == 1) echo 'checked' ?>> Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="haveHSRegisterNo" value="0" <?php if ($form_data['council_register'] == 0) echo 'checked' ?>> No
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row hs_reg_div" <?php if ($form_data['council_register'] != 1) echo 'style="display: none;"'; ?>>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="old_hs_reg_no">Registration No<span class="text-danger">*</span></label>
                                    <input type="number" value="<?php echo $form_data["old_reg_no"]; ?>" name="old_hs_reg_no" id="old_hs_reg_no" class="form-control"  placeholder="Registration No">
                                    <?php echo form_error('old_hs_reg_no'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="old_hs_reg_year">Year of registration<span class="text-danger">*</span></label>
                                    <!-- <input type="number" value="<?php echo $form_data["old_reg_year"]; ?>" name="old_hs_reg_year" id="old_hs_reg_year" class="form-control"  placeholder="Year of registration"> -->
                                    <select class="form-control" name="old_hs_reg_year" id="old_hs_reg_year">
                                        <option value="" hidden="true">Select Year</option>
                                        <?php for ($i = 2005; $i <= date('Y'); $i++) { ?>
                                            
                                            <option value="<?php echo $i; ?>" <?php if($form_data["old_reg_year"] == $i) {echo 'selected';}?>>
                                                <?php echo $i; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('old_hs_reg_year'); ?>
                                </div>
                            </div>

                            
                        </div> <br>

                        <div class="row">
                            <div class="col-md-8">
                                <span>
                                    Have you registered for Higher Secondary or equivalent course under any other Board / Council/ University? (Y/N)
                                    <span class="text-danger">*</span>
                                    <?php echo form_error('register_hs_course'); ?>
                                </span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="register_hs_course" value="1" <?php if($form_data['register_hs_course'] == 1){echo 'checked';} ?>> Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="register_hs_course" value="0" <?php if($form_data['register_hs_course'] == 0){echo 'checked';} ?>> No
                                    </label>
                                </div>
                            </div>
                        </div> <br>

                        <div class="row">
                            <div class="col-md-6 transfer_certificate_div" <?php if ($form_data['register_hs_course'] == 0 || $form_data['register_hs_course'] == NULL ) echo 'style="display: none;"'; ?>>
                                
                                <div class="form-group">
                                    <label class="" for="transfer_certificate">
                                        Upload migration/Transfer certificate 
                                        <span class="text-danger">*</span>
                                        <!-- <br> -->
                                        <small>(.PDF only, Max 200KB)</small>

                                        <?php if($student_data['transfer_certificate'] !='') {?>
                                            <a href="<?php echo base_url('admin/vtc_student/student_reg/show_transfer_certificate/' . md5($student_data['student_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php }?>
                                    </label>
                                
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-success">
                                                Browse&hellip;<input type="file" style="display: none;" name="transfer_certificate" id="transfer_certificate">
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <?php echo form_error('transfer_certificate'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <span>
                                    Have you ever passed Higher Secondary or equivalent examination or an examination superior to Higher Secondary Examination under any board / university? (Y/N)
                                    <span class="text-danger">*</span>
                                    <?php echo form_error('haveSHSPassed'); ?>
                                </span>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="haveSHSPassed" value="1" <?php if($form_data['hs_passed'] == 1){echo 'checked';} ?>> Yes
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="haveSHSPassed" value="0" <?php if($form_data['hs_passed'] == 0){echo 'checked';} ?>> No
                                    </label>
                                </div>
                            </div>
                        </div> <br>

                        <center>
                            
                            <span class="text-danger eligable_text" <?php if (set_value('haveSHSPassed') != 1) echo 'style="display: none;"'; ?>>
                                *** You are not eligible for admission in class 11” and the form will not proceed further ***
                            </span>
                        </center>
                        
                        

                    </div>
                    

                        
                </div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
					<?php if($student_data['approve_reject_status'] == ''){?>
                        <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Update Student</button>
					<?php }?>
					<?php //}?>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>

        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>