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
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>



               
                <h4>Resume & Photo</h4><hr>
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
                        <label>Upload Photo <span class="text-danger">*</span> (JPEG format between 100KB. Dimensions 250x320 pixels preferred)</label>
                        <input type="file" class="form-control" placeholder="Photo" name="photo" value="" <?php echo $disabled; ?>>
                        <?php echo form_error('photo'); ?>
                    </div>
                </div>

                <?php if($app_data[0]['photo']!=''){?>
                <div class="col-md-2">
                    <div class="form-group">
                    <div class="photo-box">
                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($app_data[0]['photo']); ?>">
                    </div>
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
