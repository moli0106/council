<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

  <!-- Content Wrapper. Contains page content -->
  <style>
	.wrapper {
		overflow-x: auto;
		overflow-y: hidden;
	}
	.modal-header {
    background-color: #4ccaca;
}
.modal-footer {
    background-color: #4ccaca;
}
.btn-space {
    margin-right: 5px;
    }
  </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
	  Assessor Registration Form
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><i class="fa fa-user"></i> Assessor Registration Form</li>
        <li class="active"><i class="fa fa-envelope-o"></i> Final Submit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
  
		<div class="box box-primary">

		<div class="box-header with-border">
                <h3 class="box-title">Final Submit</h3>
            </div>


			<?php echo form_open('admin/'.uri_string(), array('autocomplete' =>'off' )); ?>
			<input type="hidden" name="final_token" value="<?php echo $this->session->final_token; ?>" />
			<div class="box-body box-profile">
				
				<?php if(isset($update_code)){ ?>
                	<?php if($update_code == 1){ ?>
                        <div class="alert alert-success text-center">
                          <?php echo $update_success ?>
                        </div>
                    <?php } else if($update_code == 0){ ?>
                        <div class="alert alert-warning text-center">
                          <?php echo $update_success ?>
                        </div>
                    <?php } ?>
				<?php } ?>
				
				<ul class="nav nav-tabs">
					<li><a href="assessor_profile/assessor_registration/basic">Basic</a></li>
                    <li><a href="assessor_profile/assessor_registration/course">Course</a></li>
                    <li><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
				</ul>
				<br>

				<div class="clearfix"></div>
                
				<!--timeline start -->
				<?php 
					if($this->session->flashdata('alert_msg'))
					{
				?>
						<div class="alert alert-warning"><p><?php echo $this->session->flashdata('alert_msg'); ?></p></div>
				<?php 
					}
				?>

					
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<ul class="timeline">
						<!-- timeline time label -->
						<li class="time-label">
							<span class="bg-red">
								Profile Submission Status
							</span>
						</li>
						<!-- /.timeline-label -->
						<!-- timeline item -->
						<li>
						<i class="fa <?php echo $app_data[0]['basic_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/basic">Basic Details</a></h3>
						</div>
						</li>
						<li>
						<i class="fa <?php echo $app_data[0]['course_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/course">Course Details</a></h3>
							<span class="label label-warning" style="color:#F00; font-size:12px;">(At least one course is mandatory for each Assessor for Final Submit.)</span>
						</div>
						</li>
						<li>
						<i class="fa <?php echo $app_data[0]['edu_qualification_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Educational Qualification And Industry/Professional Experience</a></h3>
						</div>
						</li>
						<li>
						<i class="fa <?php echo $app_data[0]['residential_address_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/contact">Residential Address & Contact Information</a> 
							
							<!--<span class="label label-warning pull-right">Not Mandatory</span>--></h3>
						</div>
						</li>
						<li>
						<i class="fa <?php echo $app_data[0]['work_experience_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/work_experience">Work Experience</a> 
							<span class="label label-warning" style="color:#F00; font-size:12px;">(At least one Work Experience details is mandatory for each Assessor for Final Submit.)</span>
							</h3>
						</div>
						</li>

						<li>
						<i class="fa <?php echo $app_data[0]['experience_assessor_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-orange'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/assessor_experience">Experience As Assessor / Expert of syllabus committee</a> 
							<!--<span class="label label-warning" style="color:#F00; font-size:12px;">(At least one Experience As Assessor / Expert of syllabus committee is mandatory for each Training Centre for Final Submit.)</span>-->
							</h3>
						</div>
						</li>

						<li>
						<i class="fa <?php echo $app_data[0]['professional_details_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/professional_details">Present Engagement</a> 
							<!--<span class="label label-warning" style="color:#F00; font-size:12px;">(At least one Professional is mandatory for each Training Centre for Final Submit.)</span>-->
							
							</h3>
						</div>
						</li>

						<li>
						<i class="fa <?php echo $app_data[0]['resume_photo_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/resume_photo">Resume & Photo</a> 
							
							</h3>
						</div>
						</li>

						<li>
						<i class="fa <?php echo $app_data[0]['final_flag'] == 't' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
						<div class="timeline-item">
							<h3 class="timeline-header"><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></h3>
						
						</div>
						</li>
						<!-- END timeline item -->
					</ul>
					
					<!--timeline end -->
					</div>

					
				<br>

				
				
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">


					<?php if($app_data[0]['final_flag'] != 't'){ ?>
					<?php if($app_data[0]['basic_flag'] == 't' && $app_data[0]['course_flag'] == 't' && $app_data[0]['edu_qualification_flag'] == 't' && $app_data[0]['residential_address_flag'] == 't' && $app_data[0]['work_experience_flag'] == 't' && $app_data[0]['professional_details_flag'] == 't' && $app_data[0]['resume_photo_flag'] == 't'){ ?>
						<a href="javascript:void(0)" id="<?php echo md5($this->session->userdata('stake_details_id_fk'))?>" rel="<?php echo md5($this->session->userdata('stake_details_id_fk'))?>" class="btn btn-primary pull-right confirm_final_submit" data-toggle="modal" data-target="#confirmFinalsubmit">Final Submit</a>
						<a href="assessor_profile/assessor_registration/view_details" class="btn btn-primary pull-right btn-space" target="_blank" >Application Preview</a>
						<!-- <button type="submit" class="btn btn-primary pull-right">Submit</button> -->
					<?php }} ?>
					<?php if($app_data[0]['final_flag'] == 't'){ ?>
						<a href="assessor_profile/assessor_registration/view_details" class="btn btn-primary pull-right btn-space" target="_blank" >Application Preview</a>
						<?php }?>

					

					


					<div class="btn-group">
					<a href="assessor_profile/assessor_registration/resume_photo" class="btn btn-primary confirm_pre"> < Previous</a>
					</div>
				</div>
			</div>

	    </div>
 
    	</div>

	 </section>
  </div>
  <!-- /.content-wrapper -->



  <!---------------------------- Modal for Confirm final Submit ----------------------->
  <div id="confirmFinalsubmit" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal_remove_content">

	    </div>
	  </div>
	</div>
    <!---------------------------- Modal forConfirm final Submit ------------------------>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>