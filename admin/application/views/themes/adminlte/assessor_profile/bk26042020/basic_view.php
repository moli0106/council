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
    	<h1>Assessor Registration Form</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> Assessor Registration Form</li>
            <li class="active"><i class="fa fa-envelope-o"></i> Basic Details</li>
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
						<div class="alert alert-success"><p><?php echo $this->session->flashdata('alert_msg'); ?></p></div>
				<?php 
					}
				?>
                
                <ul class="nav nav-tabs">
                    <li class="active"><a href="assessor_profile/assessor_registration/basic">Basic</a></li>
                    <li><a href="assessor_profile/assessor_registration/course">Course</a></li>
                    <li><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/ssc_wbsctvesd_certified">SSC/ WBSCTVESD <br> Certified</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>


                <h4>Basic Information</h4><hr>
                <div class="row">
                <div class="col-md-3">
            			<div class="form-group">
							<label for="tp">Salutation <span class="text-danger">*<span></label>
							<div class="form-group">
								<select class="form-control select2 select2-hidden-accessible" id="salutation" name="salutation" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" disabled>
	                                <option value="">-- Salutation --</option>
                                    <?php foreach($salutations as $salutation){?>
                                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $salutation['salutation_id_pk']; ?>"  <?php echo $salutation['salutation_id_pk'] == $app_data[0]['salutation_id_fk'] ? 'selected':'' ;?>><?php echo $salutation['salutation_desc']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $salutation['salutation_id_pk']; ?>" <?php echo set_select('salutation',$salutation['salutation_id_pk']); ?>><?php echo $salutation['salutation_desc']; ?></option>
                                        <?php } ?>
	                                <?php } ?>
	                            </select>
	                            <?php echo form_error('salutation');?>
							</div>
						</div>
            		</div>
            		<div class="col-md-3">
            			<div class="form-group">
                            <label for="district">First name <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $app_data[0]['fname']; ?>" placeholder="Enter First name" disabled />
                            <?php } else {?>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo set_value('fname') ?>" placeholder="Enter First name" disabled />
                                <?php }?>
            				<?php echo form_error('fname'); ?>
            			</div>
                    </div>
                    <div class="col-md-3">
            			<div class="form-group">
                            <label for="district">Middle name</label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $app_data[0]['mname']; ?>" placeholder="Enter Middle name" disabled /> 
                            <?php } else {?>
                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo set_value('mname') ?>" placeholder="Enter Middle name" disabled />
                                <?php }?>                              
            				<?php echo form_error('mname'); ?>
            			</div>
                    </div>
                    <div class="col-md-3">
            			<div class="form-group">
                            <label for="district">Last name <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $app_data[0]['lname']; ?>" placeholder="Enter Last name" disabled />
                            <?php } else {?>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname') ?>" placeholder="Enter Last name" disabled />
                                <?php }?>
            				<?php echo form_error('lname'); ?>
            			</div>
            		</div>
            		
                </div>

                <div class="row">
                    <div class="col-md-3">
            			<div class="form-group">
							<label for="tp">Gender  <span class="text-danger">*<span></label>
							<div class="form-group">
								<select class="form-control select2 select2-hidden-accessible" id="gender" name="gender" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" disabled>
	                                <option value="">-- Gender  --</option>
                                    <?php foreach($genders as $gender){?>
                                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $gender['gender_id_pk']; ?>"  <?php echo $gender['gender_id_pk'] == $app_data[0]['gender_id_fk'] ? 'selected':'' ;?>><?php echo $gender['gender_description']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $gender['gender_id_pk']; ?>" <?php echo set_select('gender',$gender['gender_id_pk']); ?>><?php echo $gender['gender_description']; ?></option>
                                        <?php } ?>
	                                <?php } ?>
	                            </select>
	                            <?php echo form_error('gender');?>
							</div>
						</div>
            		</div>
            		<div class="col-md-3">
            			<div class="form-group">
                            <label for="district">D.O.B <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" class="form-control datepicker" id="dob" name="dob" value="<?php echo date('d-m-Y',strtotime($app_data[0]['dob'])); ?>" placeholder="DD-MM-YYYY" readonly/>
                            <?php } else {?>
                                <input type="text" class="form-control" id="dob" name="dob" value="<?php echo set_value('dob') ?>" placeholder="Enter DOB" <?php echo $disabled; ?>/>
                                <?php }?>
            				<?php echo form_error('dob'); ?>
            			</div>
                    </div>
                    <div class="col-md-3">
            			<div class="form-group">
							<label for="tp">Language  <span class="text-danger">*<span></label>
							<div class="form-group">
								<select class="form-control select2 select2-hidden-accessible" id="language" name="language" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" disabled>
	                                <option value="">-- Language  --</option>
                                    <?php foreach($languages as $language){?>
                                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $language['language_id_pk']; ?>"  <?php echo $language['language_id_pk'] == $app_data[0]['language_id_fk'] ? 'selected':'' ;?>><?php echo $language['language_desc']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $language['language_id_pk']; ?>" <?php echo set_select('language',$language['language_id_pk']); ?>><?php echo $language['language_desc']; ?></option>
                                        <?php } ?>
	                                <?php } ?>
	                            </select>
	                            <?php echo form_error('language');?>
							</div>
						</div>
                    </div>
                    <div class="col-md-3">
            			<div class="form-group">
                            <label for="district">PAN No. <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" class="form-control" id="pan" name="pan" value="<?php echo $app_data[0]['pan']; ?>" placeholder="Enter PAN No." readonly />
                            <?php } else {?>
                                <input type="text" class="form-control" id="pan" name="pan" value="<?php echo set_value('pan') ?>" placeholder="Enter PAN No." readonly/>
                                <?php }?>
            				<?php echo form_error('pan'); ?>
            			</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
            			<div class="form-group">
							<label for="tp">ID Type (Alternate)  <span class="text-danger">*<span></label>
							<div class="form-group">
								<select class="form-control select2 select2-hidden-accessible" id="id_type_alt" name="id_type_alt" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" disabled>
	                                <option value="">-- ID Type --</option>
                                    <?php foreach($id_types as $id_type){?>
                                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $id_type['id_type_id_pk']; ?>"  <?php echo $id_type['id_type_id_pk'] == $app_data[0]['id_type_alt_id_fk'] ? 'selected':'' ;?>><?php echo $id_type['id_type_name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $id_type['id_type_id_pk']; ?>" <?php echo set_select('id_type_alt',$id_type['id_type_id_pk']); ?>><?php echo $id_type['id_type_name']; ?></option>
                                        <?php } ?>
	                                <?php } ?>
	                            </select>
	                            <?php echo form_error('id_type_alt');?>
							</div>
						</div>
                    </div>
                    <div class="col-md-3">
            			<div class="form-group">
                            <label for="district">ID No. (Alternate) <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" class="form-control" id="id_no_alt" name="id_no_alt" value="<?php echo $app_data[0]['id_no_alt']; ?>" placeholder="Enter ID No" readonly/>
                            <?php } else {?>
                                <input type="text" class="form-control" id="id_no_alt" name="id_no_alt" value="<?php echo set_value('id_no_alt') ?>" placeholder="Enter ID No" readonly/>
                                <?php }?>
            				<?php echo form_error('id_no_alt'); ?>
            			</div>
                    </div>
                    <?php if($app_data[0]['pan_file']!=''){?>
                    <div class="col-md-2">
                        <div class="form-group">
                        <label for="pan">Photo Copy of PAN <span class="text-danger">*<span></label>
                        <a target="_blank"href="assessor_profile/assessor_registration/download_pan_file/<?php echo md5($app_data[0]['assessor_registration_details_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <h4>Contact Information</h4><hr>
                <div class="row">
                    <div class="col-md-3">
            			<div class="form-group">
                            <label for="district">Mobile No.  <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo $app_data[0]['mobile_no']; ?>" placeholder="Enter Mobile No. " readonly />
                            <?php } else {?>
                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="<?php echo set_value('mobile_no') ?>" placeholder="Enter Mobile No." readonly/>
                                <?php }?>
            				<?php echo form_error('mobile_no'); ?>
            			</div>
                    </div>
                    <div class="col-md-3">
            			<div class="form-group">
                            <label for="district">Landline No</label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" class="form-control" id="landline" name="landline" value="<?php echo $app_data[0]['landline_no']; ?>" placeholder="Enter Landline No" readonly/>
                            <?php } else {?>
                                <input type="text" class="form-control" id="landline" name="landline" value="<?php echo set_value('landline') ?>" placeholder="Enter Landline No" readonly/>
                                <?php }?>
            				<?php echo form_error('landline'); ?>
            			</div>
                    </div>
                    <div class="col-md-3">
            			<div class="form-group">
                            <label for="district">Email ID <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" class="form-control" id="email_id" name="email_id" value="<?php echo $app_data[0]['email_id']; ?>" placeholder="Enter Email ID" readonly />
                            <?php } else {?>
                                <input type="text" class="form-control" id="email_id" name="email_id" value="<?php echo set_value('email_id') ?>" placeholder="Enter Email ID" readonly/>
                                <?php }?>
            				<?php echo form_error('email_id'); ?>
            			</div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/course" class="btn btn-primary btn-space">Next > </a>
                </div>
                <?php if($app_data[0]['final_flag'] != 't'){ ?>
                <!-- <button type="submit" class="btn btn-primary pull-right">Save</button> -->
                <?php } ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>

        
	</section>
<?php //$this->load->view($this->config->item('theme_uri').'assessor_profile/terms_condition_view'); ?>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
