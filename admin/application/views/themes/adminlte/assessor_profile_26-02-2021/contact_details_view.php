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
            <li class="active"><i class="fa fa-envelope-o"></i> Residential Address & Contact Information</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Residential Address & Contact Information</h3>
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
                    <li><a href="assessor_profile/assessor_registration/basic">Basic</a></li>
                    <li><a href="assessor_profile/assessor_registration/course">Course</a></li>
                    <li><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional Experience</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>



                <h4>Present Address</h4><hr>
                <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">House / Flat / Building / Plot <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" name="house_flat_building" value="<?php echo $app_data[0]['house_flat_building']; ?>" id="house_flat_building" class="form-control"  placeholder="House / Flat / Building / Plot" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" name="house_flat_building" value="<?php echo set_value("house_flat_building")  ?>" id="house_flat_building" class="form-control"  placeholder="House / Flat / Building / Plot">
                            <?php }?>
                        <?php echo form_error('house_flat_building'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Street Name <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" name="street"  value="<?php echo $app_data[0]['street']; ?>" id="street" class="form-control"  placeholder="Street Name" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" name="street"  value="<?php echo set_value("street")  ?>" id="street" class="form-control"  placeholder="Street Name">
                            <?php }?>
                        <?php echo form_error('street'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Post Office <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" name="post_opffice"  value="<?php echo $app_data[0]['post_opffice']; ?>" id="post_opffice" class="form-control"  placeholder="Post Office" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" name="post_opffice"  value="<?php echo set_value("post_opffice")  ?>" id="post_opffice" class="form-control"  placeholder="Post Office">
                            <?php }?>
                        <?php echo form_error('post_opffice'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Police Station </label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" name="police"  value="<?php echo $app_data[0]['police']; ?>" id="police" class="form-control"  placeholder="Police Station" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" name="police"  value="<?php echo set_value("police")  ?>" id="police" class="form-control"  placeholder="Police Station">
                            <?php }?>
                        <?php echo form_error('police'); ?>
                        
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">State <span class="text-danger">*</span></label>
                        
                        <select class="form-control select2 select2-hidden-accessible" name="state" id="state" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select State --</option>
                            <?php foreach($states as $state){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $state['state_id_pk']; ?>"  <?php echo $state['state_id_pk'] == $app_data[0]['state_id_fk'] ? 'selected':'' ;?>><?php echo $state['state_name']; ?></option>
                                <?php } else {?>
                                    <option value="<?php echo $state['state_id_pk']; ?>" <?php echo set_select("state",$state['state_id_pk']); ?>><?php echo $state['state_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('state'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">District <span class="text-danger">*</span></label>
                        
                        <select class="form-control select2 select2-hidden-accessible" name="district" id="district" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select District --</option>
                            <?php foreach($districts as $district){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $district['district_id_pk']; ?>"  <?php echo $district['district_id_pk'] == $app_data[0]['district_id_fk'] ? 'selected':'' ;?>><?php echo $district['district_name']; ?></option>
                                <?php } else {?>
                                    <option value="<?php echo $district['district_id_pk']; ?>" <?php echo set_select("district",$district['district_id_pk']); ?>><?php echo $district['district_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('district'); ?>
                    </div>
                </div>
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="col-md-3 other_block_hide" style="<?php echo $app_data[0]['state_id_fk'] == 19 ? "" : "display:none" ; ?>">
                    <div class="form-group">
                        <label for="designation">Block / Municipality <span class="text-danger">*</span></label>
                        
                        <select class="form-control select2 select2-hidden-accessible" name="block" id="block" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select Block / Municipality --</option>
                            <?php ///if($this->input->method(TRUE) == "POST"){ ?>
                            <?php foreach($blocks as $block){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $block['block_municipality_id_pk']; ?>"  <?php echo $block['block_municipality_id_pk'] == $app_data[0]['block_id_fk'] ? 'selected':'' ;?>><?php echo $block['block_municipality_name']; ?></option>
                                <?php } else {?>
                                    <option value="<?php echo $block['block_municipality_id_pk']; ?>" <?php echo set_select("block",$block['block_municipality_id_pk']) ?>><?php echo $block['block_municipality_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                            <?php //} ?>
                        </select>
                        <?php echo form_error('block'); ?>
                    </div>
                </div>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                    <div class="col-md-3 other_block_hide" style="<?php echo $this->input->post("state") == 19 ? "" : "display:none" ; ?>">
                    <div class="form-group">
                        <label for="designation">Block / Municipality <span class="text-danger">*</span></label>
                        
                        <select class="form-control select2 select2-hidden-accessible" name="block" id="block" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select Block / Municipality --</option>
                            <?php ///if($this->input->method(TRUE) == "POST"){ ?>
                            <?php foreach($blocks as $block){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $block['block_municipality_id_pk']; ?>"  <?php echo $block['block_municipality_id_pk'] == $app_data[0]['block_id_fk'] ? 'selected':'' ;?>><?php echo $block['block_municipality_name']; ?></option>
                                <?php } else {?>
                                    <option value="<?php echo $block['block_municipality_id_pk']; ?>" <?php echo set_select("block",$block['block_municipality_id_pk']) ?>><?php echo $block['block_municipality_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                            <?php //} ?>
                        </select>
                        <?php echo form_error('block'); ?>
                    </div>
                </div>
                <?php }?>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">PIN Code <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                            <input type="text" name="pin" value="<?php echo $app_data[0]['pin']; ?>" id="pin" maxlength="6" class="form-control"  placeholder="PIN" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" name="pin" value="<?php echo set_value("pin") ?>" id="pin" maxlength="6" class="form-control"  placeholder="PIN">
                            <?php }?>
                        <?php echo form_error('pin'); ?>
                    </div>
                </div>
           </div>

           <h4>Permanent Address</h4>
           <hr>
           <div class="row">
                <div class="col-md-12">
                	<div class="form-group">
                    	<input type="checkbox" value="<?php echo set_value("permanent_same_present_addr") ?>" id="permanent_same_present_addr" name="permanent_same_present_addr" <?php echo $disabled; ?>><span>  <b>  Same as Present Address</b></span>
                        <?php echo form_error('permanent_same_present_addr'); ?>
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">House / Flat / Building / Plot <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" value="<?php echo $app_data[0]['permanent_house_flat_building'] ?>" name="permanent_house_flat_building" id="permanent_house_flat_building" class="form-control"  placeholder="House / Flat / Building / Plot" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" value="<?php echo set_value("permanent_house_flat_building") ?>" name="permanent_house_flat_building" id="permanent_house_flat_building" class="form-control"  placeholder="House / Flat / Building / Plot">
                            <?php }?>
                        <?php echo form_error('permanent_house_flat_building'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Street Name <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" value="<?php echo $app_data[0]['permanent_street'] ?>" name="permanent_street" id="permanent_street" class="form-control"  placeholder="Street Name" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" value="<?php echo set_value("permanent_street") ?>" name="permanent_street" id="permanent_street" class="form-control"  placeholder="Street Name">
                            <?php }?>
                        <?php echo form_error('permanent_street'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Post Office <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" value="<?php echo $app_data[0]['permanent_post_office'] ?>" name="permanent_post_office" id="permanent_post_office" class="form-control"  placeholder="Post Office" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" value="<?php echo set_value("permanent_post_office") ?>" name="permanent_post_office" id="permanent_post_office" class="form-control"  placeholder="Post Office">
                            <?php }?>
                        <?php echo form_error('permanent_post_office'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Police Station</label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" value="<?php echo $app_data[0]['permanent_police'] ?>" name="permanent_police" id="permanent_police" class="form-control"  placeholder="Police Station" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" value="<?php echo set_value("permanent_police") ?>" name="permanent_police" id="permanent_police" class="form-control"  placeholder="Police Station">
                            <?php }?>
                        <?php echo form_error('permanent_police'); ?>
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">State <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" name="permanent_state" id="permanent_state" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select State --</option>
                            <?php foreach($states as $state){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $state['state_id_pk']; ?>"  <?php echo $state['state_id_pk'] == $app_data[0]['permanent_state_id_fk'] ? 'selected':'' ;?>><?php echo $state['state_name']; ?></option>
                                
                                <?php } else {?>
                                    <option value="<?php echo $state['state_id_pk']; ?>" <?php echo set_select("permanent_state",$state['state_id_pk']); ?>><?php echo $state['state_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('permanent_state'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">District <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" name="permanent_district" id="permanent_district" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select District --</option> 
                            <?php foreach($districts_per as $district){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $district['district_id_pk']; ?>"  <?php echo $district['district_id_pk'] == $app_data[0]['permanent_district_id_fk'] ? 'selected':'' ;?>><?php echo $district['district_name']; ?></option>
                                <?php } else {?>
                                    <option value="<?php echo $district['district_id_pk']; ?>" <?php echo set_select("permanent_district",$district['district_id_pk']); ?>><?php echo $district['district_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('permanent_district'); ?>
                    </div>
                </div>
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="col-md-3 other_permanent_block_hide" style="<?php echo $app_data[0]['permanent_state_id_fk'] == 19 ? "" : "display:none" ; ?>">
                    <div class="form-group">
                        <label for="designation">Block / Municipality <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" name="permanent_block" id="permanent_block" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select Block / Municipality --</option> 
                            <?php //if($this->input->method(TRUE) == "POST"){ ?>
                            <?php foreach($permanent_blocks as $permanent_block){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $permanent_block['block_municipality_id_pk']; ?>"  <?php echo $permanent_block['block_municipality_id_pk'] == $app_data[0]['permanent_block_id_fk'] ? 'selected':'' ;?>><?php echo $permanent_block['block_municipality_name']; ?></option>
                                <?php } else {?>
                                    <option value="<?php echo $permanent_block['block_municipality_id_pk']; ?>" <?php echo set_select("permanent_block",$permanent_block['block_municipality_id_pk']); ?>><?php echo $permanent_block['block_municipality_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                            <?php //} ?>
                        </select>
                        <?php echo form_error('permanent_block'); ?>
                    </div>
                </div>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                <div class="col-md-3 other_permanent_block_hide" style="<?php echo $this->input->post("permanent_state") == 19 ? "" : "display:none" ; ?>">
                    <div class="form-group">
                        <label for="designation">Block / Municipality <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" name="permanent_block" id="permanent_block" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select Block / Municipality --</option> 
                            <?php //if($this->input->method(TRUE) == "POST"){ ?>
                            <?php foreach($permanent_blocks as $permanent_block){ ?>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $permanent_block['block_municipality_id_pk']; ?>"  <?php echo $permanent_block['block_municipality_id_pk'] == $app_data[0]['permanent_block_id_fk'] ? 'selected':'' ;?>><?php echo $permanent_block['block_municipality_name']; ?></option>
                                <?php } else {?>
                                    <option value="<?php echo $permanent_block['block_municipality_id_pk']; ?>" <?php echo set_select("permanent_block",$permanent_block['block_municipality_id_pk']); ?>><?php echo $permanent_block['block_municipality_name']; ?></option>
                                    <?php }?>
                            <?php } ?>
                            <?php //} ?>
                        </select>
                        <?php echo form_error('permanent_block'); ?>
                    </div>
                </div>
                    
                <?php }?>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">PIN Code <span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == 'GET'){ ?>
                        <input type="text" value="<?php echo $app_data[0]['permanent_pin'] ?>" name="permanent_pin" id="permanent_pin" maxlength="6" class="form-control"  placeholder="PIN" <?php echo $disabled; ?>>
                        <?php } else {?>
                            <input type="text" value="<?php echo set_value("permanent_pin") ?>" name="permanent_pin" id="permanent_pin" maxlength="6" class="form-control"  placeholder="PIN">
                            <?php }?>
                        <?php echo form_error('permanent_pin'); ?>
                    </div>
                </div>
           </div>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp" class="btn btn-primary btn-space confirm_pre">< Previous</a>
                    <a href="assessor_profile/assessor_registration/work_experience" class="btn btn-primary btn-space confirm_next">Next ></a>
                </div>
                <?php if($app_data[0]['final_flag'] != 't'){ ?>
                <button type="submit" class="btn btn-primary pull-right">Save</button>
                <?php } ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>

        
	</section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<!-- <script>
$('a.confirm_next').click(function(){return confirm('Are You want to continue Next tab without saving this form?');});
$('a.confirm_pre').click(function(){return confirm('Are You want to continue Previous tab without saving this form?');});
</script> -->

