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
            <li class="active"><i class="fa fa-envelope-o"></i> Professional details</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Professional details</h3>
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
                    <li><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or Expert <br> Experience</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/professional_details">Professional details</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>



               
                <h4>Professional details</h4><hr>

                <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                        <label for="sel1">Are you working in any<span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" id="working_in" name="working_in" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Select --</option>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <option value="vtc"  <?php echo 'vtc' == $app_data[0]['working_in'] ? 'selected':'' ;?>>VTC</option>
                                <option value="pbssd"  <?php echo 'pbssd' == $app_data[0]['working_in'] ? 'selected':'' ;?>>PBSSD</option>
                                <option value="not_pbssd_vtc"  <?php echo 'not_pbssd_vtc' == $app_data[0]['working_in'] ? 'selected':'' ;?>>Neither PBSSD or VTC</option>
                            <?php }else{?>
                                <option value="vtc" <?php echo set_select("working_in",'vtc'); ?>>VTC</option>
                                <option value="pbssd" <?php echo set_select("working_in",'pbssd'); ?>>PBSSD</option>
                                <option value="not_pbssd_vtc" <?php echo set_select("working_in",'not_pbssd_vtc'); ?>>Neither PBSSD or VTC</option>
                                <?php }?>
                        </select>
                        <?php echo form_error('working_in'); ?>
                    </div>
                </div>
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="centre_hide_show" style="<?php echo $app_data[0]['working_in'] != 'not_pbssd_vtc' ? "" : "display:none" ; ?>">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Centre Code<span class="text-danger">*</span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" value="<?php echo $app_data[0]['centre_code']; ?>" name="centre_code" id="centre_code" class="form-control" placeholder="Centre Code" <?php echo $disabled; ?>>
                            <?php } else {?>
                                <input type="text" value="<?php echo set_value("centre_code"); ?>" name="centre_code" id="centre_code" class="form-control" placeholder="Centre Code">
                                <?php }?>
                            <?php echo form_error('centre_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Centre Name<span class="text-danger">*</span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" value="<?php echo $app_data[0]['centre_name']; ?>" name="centre_name" id="centre_name" class="form-control" placeholder="Centre Name" <?php echo $disabled; ?>>
                            <?php } else {?> 
                                <input type="text" value="<?php echo set_value("centre_name"); ?>" name="centre_name" id="centre_name" class="form-control" placeholder="Centre Name">
                            <?php }?>   
                            <?php echo form_error('centre_name'); ?>
                        </div>
                    </div>
                </div>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                    <div class="centre_hide_show" style="<?php echo $this->input->post("working_in") != 'not_pbssd_vtc' ? "" : "display:none" ; ?>">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Centre Code<span class="text-danger">*</span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" value="<?php echo $app_data[0]['centre_code']; ?>" name="centre_code" id="centre_code" class="form-control" placeholder="Centre Code" <?php echo $disabled; ?>>
                            <?php } else {?>
                                <input type="text" value="<?php echo set_value("centre_code"); ?>" name="centre_code" id="centre_code" class="form-control" placeholder="Centre Code">
                                <?php }?>
                            <?php echo form_error('centre_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Centre Name<span class="text-danger">*</span></label>
                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="text" value="<?php echo $app_data[0]['centre_name']; ?>" name="centre_name" id="centre_name" class="form-control" placeholder="Centre Name" <?php echo $disabled; ?>>
                            <?php } else {?> 
                                <input type="text" value="<?php echo set_value("centre_name"); ?>" name="centre_name" id="centre_name" class="form-control" placeholder="Centre Name">
                            <?php }?>   
                            <?php echo form_error('centre_name'); ?>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
                <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Upload CV <span class="text-danger">*</span> (Please provide .pdf within 200KB)</label>
                        <input type="file" class="form-control" placeholder="Experience Month" name="cv" <?php echo $disabled; ?>>
                        <?php echo form_error('cv'); ?>
                    </div>
                </div>
                <?php if($app_data[0]['cv']!=''){?>
                <div class="col-md-2">
                    <div class="form-group">
                        <a target="_blank"href="assessor_profile/assessor_registration/download_cv_file/<?php echo md5($app_data[0]['assessor_registration_details_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </div>
                </div>
                <?php }?>
                
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Upload Photo <span class="text-danger">*</span> (JPEG format between 50KB. Dimensions 250x320 pixels preferred)</label>
                        <input type="file" class="form-control" placeholder="Photo" name="photo" value="" <?php echo $disabled; ?>>
                        <?php echo form_error('photo'); ?>
                    </div>
                </div>

                <?php if($app_data[0]['photo']!=''){?>
                <div class="col-md-2">
                    <div class="form-group">
                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($app_data[0]['photo']); ?>">
                    </div>
                </div>
                <?php }?>
            </div>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/assessor_experience" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="assessor_profile/assessor_registration/final_submit" class="btn btn-primary btn-space confirm_next">Next > </a>
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
