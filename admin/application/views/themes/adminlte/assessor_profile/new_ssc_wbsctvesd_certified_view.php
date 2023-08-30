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
  <?php if($application_count[0]['final_submission_status'] == 1){
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
        <!--24-03-2021 start -->
        <input type="hidden" name="application_no" id="application_no" class="form-control" value="<?php echo $application_count[0]['assessor_registration_application_no'] ?>">
        <input type="hidden" name="application_count_id" id="application_count_id" class="form-control" value="<?php echo $application_count[0]['assessor_registration_application_nubmer_id_pk'] ?>">
        <!--24-03-2021 end -->
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
                    <li><a href="assessor_profile/add_other_job_role/new_application_form">Course</a></li>
                    <li><a href="assessor_profile/add_other_job_role/document_upload">Document<br>Upload</a></li>
                    <!-- <li><a href="assessor_profile/add_other_job_role/edu_quali_indus_profe_exp">Qualifications & <br>Professional Experience</a></li> -->
                    <li><a href="assessor_profile/add_other_job_role/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/add_other_job_role/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li  class="active"><a href="assessor_profile/add_other_job_role/ssc_wbsctvesd_certified">SSC/ WBSCTVESD <br> Certified</a></li>
                    <li><a href="assessor_profile/add_other_job_role/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>

                
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Are you a SSC/ WBSCTVESD certified assessor?</th>
                            <th>Have you attended any TOA ?</th>
                            <th>Certificate validity</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach($certificates as $certificate) { ?>
                        <tr>
                            <td><?php echo $i ;?></td>
                            <td><?php echo $certificate['course_name']  ?> (<?php echo $certificate['course_code']; ?>)</td>
                            <td><?php echo $certificate['ssc_wbsctvesd_certified'] == 1 ? "Yes" : "No";  ?></td>
                            <td><?php echo $certificate['attended_any_toa'] == 1 ? "Yes" : "No";  ?></td>
                            <td><?php echo $certificate['cf_validity'] ?></td>
                            <td>
                            <?php
                                if($certificate['attended_any_toa'] == 1){
                                    ?><a href="assessor_profile/add_other_job_role/download_certificate_pdf/<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>">Download</a><?php 
                                } else {
                                    ?>NA<?php
                                }
                            ?>
                            
                            
                            </td>
                        </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>
                

                <h4>SSC/ WBSCTVESD certified</h4><hr>
                <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label> Job Role<span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" id="course_id" name="course_id" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                <option value="">-- Select --</option>
                                <?php foreach($assessor_courses as $assessor_course) { ?>
                                <option value="<?php echo $assessor_course["course_id_pk"] ?>" <?php echo set_select("course_id",$assessor_course["course_id_pk"]) ?>><?php echo $assessor_course["course_name"] ?> (<?php echo $assessor_course["course_code"] ?>)</option>
                                <?php } ?>
                                
                                
                        </select>
                        <?php echo form_error('course_id'); ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Are you a SSC/ WBSCTVESD certified assessor ? <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" id="ssc_wbsctvesd_certified" name="ssc_wbsctvesd_certified" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                <option value="">-- Select --</option>
                                
                                <option value="1" <?php echo set_select("ssc_wbsctvesd_certified",1) ?>>Yes </option>
                                <option value="2" <?php echo set_select("ssc_wbsctvesd_certified",2) ?>>No </option>
                               
                        </select>
                        <?php echo form_error('ssc_wbsctvesd_certified'); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Certificate validity <span class="text-danger">*</span></label>
                        <input type="text" name="cf_validity" id="cf_validity" class="form-control datepicker" value="<?php echo set_value("cf_validity"); ?>" placeholder="DD-MM-YYYY">
                        <?php echo form_error('cf_validity'); ?>
                    </div>
                </div>
                </div>
                <div class="row">
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="col-md-4 hide_show_attened_toa" style="<?php echo $app_data[0]['ssc_wbsctvesd_certified'] == '1' ? "" : "display:none" ; ?>">
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
                <div class="col-md-4 hide_show_attened_toa" style="<?php echo $this->input->post("ssc_wbsctvesd_certified") == '1' ? "" : "display:none";?>">
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
                <?php /*<?php if($app_data[0]['toa_certificate']!=''){?>
                <div class="col-md-1 hide_show_toa_certificate">
                    <div class="form-group">
                        
                        <a target="_blank"href="assessor_profile/assessor_registration/download_toa_certificate_file/<?php echo md5($app_data[0]['assessor_registration_details_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                    </div>
                </div>
                <?php }?> */ ?>
            </div>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/add_other_job_role/professional_details" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="assessor_profile/add_other_job_role/final_submit" class="btn btn-primary btn-space confirm_next">Next > </a>
                </div>
                <?php if($application_count[0]['final_submission_status'] != 1){ ?>
                <button type="submit" class="btn btn-primary pull-right">Add & Save</button>
                <?php } ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>

        
	</section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
