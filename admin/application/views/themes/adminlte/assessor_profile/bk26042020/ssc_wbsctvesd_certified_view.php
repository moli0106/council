<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
  <!-- Content Wrapper. Contains page content -->
  <style>
  .btn-space {
    margin-right: 5px;
    }
   .photo-box {
    width: 120px;
    height: 150px;
    overflow: hidden;}
    .photo-box img {width: 100%; height: 100%;}
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
            <li class="active"><i class="fa fa-envelope-o"></i> SSC/ WBSCTVESD certified</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">SSC/ WBSCTVESD certified</h3>
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
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/ssc_wbsctvesd_certified">SSC/ WBSCTVESD <br> Certified</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>



               
                <h4>SSC/ WBSCTVESD certified</h4><hr>
                <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Are you a SSC/ WBSCTVESD certified assessor ? <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" id="ssc_wbsctvesd_certified" name="ssc_wbsctvesd_certified" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                <option value="">-- Select --</option>
                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <option value="1" <?php echo $app_data[0]['ssc_wbsctvesd_certified']==1 ? 'selected':'' ;?>>Yes </option>
                                <option value="2" <?php echo $app_data[0]['ssc_wbsctvesd_certified']==2 ? 'selected':'' ;?>>No </option>
                                <?php } else {?>
                                <option value="1" <?php echo set_select("ssc_wbsctvesd_certified",1) ?>>Yes </option>
                                <option value="2" <?php echo set_select("ssc_wbsctvesd_certified",2) ?>>No </option>
                                <?php }?>
                        </select>
                        <?php echo form_error('ssc_wbsctvesd_certified'); ?>
                    </div>
                </div>
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="col-md-3 hide_show_attened_toa" style="<?php echo $app_data[0]['ssc_wbsctvesd_certified'] == '1' ? "" : "display:none" ; ?>">
                    <div class="form-group">
                        <label>Have you attended any TOA ? <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" id="attended_any_toa" name="attended_any_toa" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                <option value="">-- Select --</option>
                                <option value="1" <?php echo $app_data[0]['attended_any_toa']==1 ? 'selected':'' ;?>>Yes </option>
                                <option value="2" <?php echo $app_data[0]['attended_any_toa']==2 ? 'selected':'' ;?>>No </option>
                        </select>
                        <?php echo form_error('attended_any_toa'); ?>
                    </div>
                </div>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                <div class="col-md-3 hide_show_attened_toa" style="<?php echo $this->input->post("ssc_wbsctvesd_certified") == '1' ? "" : "display:none";?>">
                    <div class="form-group">
                        <label>Have you attended any TOA ? <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" id="attended_any_toa" name="attended_any_toa" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                <option value="">-- Select --</option>
                                <option value="1" <?php echo set_select("attended_any_toa",1) ?>>Yes </option>
                                <option value="2" <?php echo set_select("attended_any_toa",2) ?>>No </option>
                        </select>
                        <?php echo form_error('attended_any_toa'); ?>
                    </div>
                </div>
                <?php }?>
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="col-md-4 hide_show_toa_certificate" style="<?php echo $app_data[0]['attended_any_toa'] == '1' ? "" : "display:none" ; ?>">
                    <div class="form-group ">
                        <label>Upload TOA certificate <span class="text-danger">*</span> (.PDF only, Max 100KB)</label>
                        <input type="file" class="form-control" placeholder="Upload TOA certificate" name="toa_certificate" value="" <?php echo $disabled; ?>>
                        <?php echo form_error('toa_certificate'); ?>
                    </div>
                </div>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                <div class="col-md-4 hide_show_toa_certificate" style="<?php echo $this->input->post("attended_any_toa") == '1' ? "" : "display:none";?>">
                    <div class="form-group ">
                        <label>Upload TOA certificate <span class="text-danger">*</span> (.PDF only, Max 100KB)</label>
                        <input type="file" class="form-control" placeholder="Upload TOA certificate" name="toa_certificate" value="" <?php echo $disabled; ?>>
                        <?php echo form_error('toa_certificate'); ?>
                    </div>
                </div>
                <?php }?>
                <?php if($app_data[0]['toa_certificate']!=''){?>
                <div class="col-md-1 hide_show_toa_certificate">
                    <div class="form-group">
                        
                        <a target="_blank"href="assessor_profile/assessor_registration/download_toa_certificate_file/<?php echo md5($app_data[0]['assessor_registration_details_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
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
                    <a href="assessor_profile/assessor_registration/professional_details" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="assessor_profile/assessor_registration/resume_photo" class="btn btn-primary btn-space confirm_next">Next > </a>
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
