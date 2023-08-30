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
<!-- For disabled on final submit -->

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Details View</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Basic Details</h3>
            </div>
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

               <?php $this->load->view($this->config->item('theme') . 'student_profile/menu_view'); ?>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>


                <h4>Basic Details</h4>
                <hr>

                <div class="row">


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">First name <span class="text-danger">*</span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $app_data['first_name']; ?>" placeholder="Enter First name" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo set_value('fname') ?>" placeholder="Enter First name" />
                                <?php }?>
                            
                            <?php echo form_error('fname'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Middle name</label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $app_data['middle_name']; ?>" placeholder="Enter Middle name" /> 
                            <?php } else {?>
                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo set_value('mname') ?>" placeholder="Enter Middle name" />
                                <?php }?> 
                            
                            <?php echo form_error('mname'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Last name <span class="text-danger">*</span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $app_data['last_name']; ?>" placeholder="Enter Last name" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname') ?>" placeholder="Enter Last name" />
                                <?php }?>
                            <?php echo form_error('lname'); ?>
                        </div>
                    </div>

                </div>

                <div class="row">


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="father_name">Father name</label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $app_data['father_name']; ?>" placeholder="Enter Father name" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo set_value('father_name') ?>" placeholder="Enter Father name" />
                            <?php }?>
                            
                            <?php echo form_error('father_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mother_name">Mother name</label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?php echo $app_data['mothers_name']; ?>" placeholder="Enter Mother name" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?php echo set_value('mother_name') ?>" placeholder="Enter Mother name" />
                            <?php }?>
                            
                            <?php echo form_error('mother_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="guardian_name">Guardian name <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" value="<?php echo $app_data['guardian_name']; ?>" placeholder="Enter Mother name" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="guardian_name" name="guardian_name" value="<?php echo set_value('guardian_name') ?>" placeholder="Enter Guardian Name" />
                            <?php }?>

                           
                            <?php echo form_error('guardian_name'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="guardian_relation">Relationship with Guardian <span
                                    class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="guardian_relation" name="guardian_relation" value="<?php echo $app_data['guardian_relationship']; ?>" placeholder="Relationship with Guardian" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="guardian_relation" name="guardian_relation" value="<?php echo set_value('guardian_relation') ?>" placeholder="Relationship with Guardian" />
                            <?php }?>
                            
                            <!-- <select class="form-control" name="guardian_relation" id="guardian_relation">
                                                    <option value="" hidden="true">-- Relationship with Guardian --</option>
                                                    <?php foreach($relationshipList as $val){ ?>
                                                    <option value="<?php echo $val['guardian_relationship_id_pk'] ?>" <?php echo set_select("guardian_relation",$val['guardian_relationship_id_pk']) ?>><?php echo $val['relationship_name'] ?></option>
                                                    <?php } ?>
                                                </select> -->
                            <?php echo form_error('guardian_relation'); ?>
                        </div>
                    </div>

                    <!-- <div class="col-md-4 other_relation_div" <?php if ((set_value('guardian_relation') != 3) || (set_value('guardian_relation') == NULL)) echo 'style="display: none;"'; ?>>
                                            <div class="form-group">
                                                <label for="otherRelationName">Other Relationship Name <span class="text-danger">*</span></label>
                                                <input id="otherRelationName" name="otherRelationName" class="form-control" type="text" value="<?php echo set_value('otherRelationName'); ?>">
                                                <?php echo form_error('otherRelationName'); ?>
                                            </div>
                                        </div> -->

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="citizenship">Citizenship<span class="text-danger">*</span></label>
                            <select class="form-control" name="citizenship" id="citizenship">
                                <option value="" hidden="true">-- Select Citizenship --</option>
                                <?php foreach ($nationality as $key => $value) {?>

                                    <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $value['nationality_id_pk']; ?>"  <?php echo $value['nationality_id_pk'] == $app_data['nationality_id_fk'] ? 'selected':'' ;?>><?=$value['nationality_name']?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $value['nationality_id_pk']; ?>" <?php echo set_select('citizenship',$value['nationality_id_pk']); ?>><?=$value['nationality_name']?></option>
                                        <?php } ?>

                                
                                <?php }?>

                            </select>
                            <?php echo form_error('citizenship'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 citizenship_doc_div"
                        <?php if ((set_value('citizenship') == 1) || (set_value('citizenship') == NULL)) echo 'style="display: none;"'; ?>>

                        <div class="form-group">
                            <label class="" for="approval_doc">
                                Upload Council Approval
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 200KB)</small>
                            </label>

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="approval_doc"
                                            id="approval_doc">
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

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" value="<?php echo $app_data['aadhar_no']; ?>" placeholder="Aadhar No." />
                            <?php } else {?>
                                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no" value="<?php echo set_value('aadhar_no') ?>" placeholder="Aadhar No." />
                            <?php }?>

                            
                            <?php echo form_error('aadhar_no'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mob_no">Mobile No.<span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="mob_no" name="mob_no" value="<?php echo $app_data['mobile_number']; ?>" placeholder="Mobile No." pattern="^[6-9]\d{9}$"
                                title="Ten Digit Mobile No, Starting with 6 to 9"/>
                            <?php } else {?>
                                <input type="text" class="form-control" id="mob_no" name="mob_no" value="<?php echo set_value('mob_no') ?>" placeholder="Mobile No."  pattern="^[6-9]\d{9}$"
                                title="Ten Digit Mobile No, Starting with 6 to 9"/>
                            <?php }?>

                            
                            <?php echo form_error('mob_no'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email_id">Email ID <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="email" class="form-control" id="email_id" name="email_id" value="<?php echo $app_data['email']; ?>" placeholder="Email ID." />
                            <?php } else {?>
                                <input type="email" class="form-control" id="email_id" name="email_id" value="<?php echo set_value('email_id') ?>" placeholder="Email ID." />
                            <?php }?>

                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">Address 1 <span class="text-danger">*</span></label>
                            <!-- <textarea class="form-control" name="address" rows="3"><?php echo set_value('address'); ?></textarea> -->

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $app_data['address']; ?>" placeholder="Address 1" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo set_value('address') ?>" placeholder="Address 1" />
                            <?php }?>

                            

                            <?php echo form_error('address'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address_2">Address 2 </label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="address_2" name="address_2" value="<?php echo $app_data['address_2']; ?>" placeholder="Address 2" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="address_2" name="address_2" value="<?php echo set_value('address_2') ?>" placeholder="Address 2" />
                            <?php }?>
                            

                            <?php echo form_error('address_2'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address_3">Address 3 </label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="address_3" name="address_3" value="<?php echo $app_data['address_3']; ?>" placeholder="Address 3" />
                            <?php } else {?>
                                <input type="text" class="form-control" id="address_3" name="address_3" value="<?php echo set_value('address_3') ?>" placeholder="Address 3" />
                            <?php }?>

                           

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
                                <option value="<?php echo $value['state_id_pk']; ?>"
                                <?php if ($formData['state_id_fk'] == $value['state_id_pk']) echo 'selected'; ?>>
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
                    <div class="col-md-4 other_state_div"
                        <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                        <div class="form-group">
                            <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                            <select name="subDivision" id="subDivision" class="form-control">

                                <?php if($this->input->method(TRUE) == "POST"){ ?>

                                <?php foreach ($subDivision as $value) {?>
                                <option value="<?php echo $value['subdiv_id_pk']?>"
                                    <?php echo set_select('subDivision' , $value['subdiv_id_pk']); ?>>
                                    <?php echo $value['subdiv_name'];?> </option>
                                <?php }?>
                                <?php } else{?>
                                <option value="" hidden="true">Select Sub Division</option>
                                <option value="" disabled="true">Select District first...</option>
                                <?php }?>

                            </select>
                            <?php echo form_error('subDivision'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 other_state_div"
                        <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                        <div class="form-group">
                            <label for="municipality">Municipality/Block </label>
                            <select name="municipality" id="municipality" class="form-control">
                                <?php if($this->input->method(TRUE) == "POST"){ ?>

                                <?php foreach ($municipality as $value) {?>
                                <option value="<?php echo $value['block_municipality_id_pk']?>"
                                    <?php echo set_select('municipality' , $value['block_municipality_id_pk']); ?>>
                                    <?php echo $value['block_municipality_name'];?> </option>
                                <?php }?>
                                <?php } else{?>
                                <option value="" hidden="true">Select Municipality / Block</option>
                                <option value="" disabled="true">Select Sub Division first...
                                </option>
                                <?php }?>

                            </select>
                            <?php echo form_error('municipality'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pinCode">Pin Code <span class="text-danger">*</span></label>
                            <input id="pinCode" name="pinCode" id="pinCode" class="form-control" type="text"
                                value="<?php echo set_value('pinCode'); ?>">
                            <?php echo form_error('pinCode'); ?>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="caste_id">Caste <span class="text-danger">*</span></label>
                            <select class="form-control" name="caste_id" id="caste_id">
                                <option value="" hidden="true">-- Caste --</option>
                                <?php foreach($casteList as $val){ ?>
                                <option value="<?php echo $val['caste_id_pk'] ?>"
                                    <?php echo set_select("caste_id",$val['caste_id_pk']) ?>>
                                    <?php echo $val['caste_name'] ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('caste_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 caste_doc_div"
                        <?php if ((set_value('caste_id') == 1) || (set_value('caste_id') == NULL)) echo 'style="display: none;"'; ?>>

                        <div class="form-group">
                            <label class="" for="caste_doc">
                                Upload Document
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 100KB)</small>
                            </label>

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="caste_doc"
                                            id="caste_doc">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <?php echo form_error('caste_doc'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="religion_id">Religion</label>
                            <select class="form-control" name="religion_id" id="religion_id">
                                <option value="" hidden="true">-- Religion --</option>
                                <?php foreach($religion as $val){ ?>
                                <option value="<?php echo $val['religion_id_pk'] ?>"
                                    <?php echo set_select("religion_id",$val['religion_id_pk']) ?>>
                                    <?php echo $val['religion_name'] ?></option>
                                <?php } ?>
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

                                <option value="1" <?php echo set_select("phy_challenged",1) ?>>Yes
                                </option>
                                <option value="0" <?php echo set_select("phy_challenged",0) ?>>No
                                </option>

                            </select>
                            <?php echo form_error('phy_challenged'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 phy_challenged_doc_div"
                        <?php if ((set_value('phy_Challenged') == 0) || (set_value('phy_Challenged') == NULL)) echo 'style="display: none;"'; ?>>

                        <div class="form-group">
                            <label class="" for="phy_challenged_doc">
                                Upload P.C Certificate
                                <span class="text-danger">*</span>
                                <!-- <br> -->
                                <small>(.PDF only, Max 200KB)</small>
                            </label>

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;"
                                            name="phy_challenged_doc" id="phy_challenged_doc">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <?php echo form_error('phy_challenged_doc'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="datepicker">D.O.B <span class="text-danger">*</span></label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <div class="common_input_div">
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" class="form-control datepicker" id="dob" name="dob" value="<?php echo date('d-m-Y',strtotime($app_data['date_of_birth'])); ?>" placeholder="DD-MM-YYYY" readonly/>
                            <?php } else {?>
                                <input type="text" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob') ?>" placeholder="Enter DOB" <?php echo $disabled; ?>/>
                                <?php }?>
                                
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

                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="aadhar_doc"
                                            id="aadhar_doc">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <?php echo form_error('aadhar_doc'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender <span class="text-danger">*</span></label>
                            <select class="form-control" name="gender" id="gender">
                                <option value="">-- Select Gender --</option>
                                <?php foreach($genders as $gender){ ?>

                                    <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $gender['gender_id_pk']; ?>"  <?php echo $gender['gender_id_pk'] == $app_data['gender_id_fk'] ? 'selected':'' ;?>><?php echo $gender['gender_description']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $gender['gender_id_pk']; ?>" <?php echo set_select('gender',$gender['gender_id_pk']); ?>><?php echo $gender['gender_description']; ?></option>
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

                                <option value="1" <?php echo set_select("marital_status",1) ?>>
                                    Married</option>
                                <option value="2" <?php echo set_select("marital_status",2) ?>>
                                    Unmarried</option>

                            </select>
                            <?php echo form_error('marital_status'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 kanyashree_no_div"
                        <?php if (((set_value('marital_status') == 1 || set_value('marital_status') == NULL) && (set_value('gender') == 1 || set_value('gender') == NULL)) ) echo 'style="display: none;'; ?>>
                        <div class="form-group">
                            <label for="kanyashree_no">Kanyashree Enrolment Number </label>
                            <input id="kanyashree_no" name="kanyashree_no" class="form-control" type="text"
                                value="<?php echo set_value('kanyashree_no'); ?>">
                            <?php echo form_error('kanyashree_no'); ?>
                        </div>
                    </div>

                    

                    
                </div>

                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="student_profile/std_registration" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="student_profile/std_registration/photo_signature" class="btn btn-primary btn-space">Next >
                    </a>
                </div>
                <?php // if($app_data[0]['final_flag'] != 't'){ ?>
                <button type="submit" class="btn btn-primary pull-right">Save</button>
                <?php //} ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>


    </section>
    <?php //$this->load->view($this->config->item('theme_uri').'assessor_profile/terms_condition_view'); ?>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>