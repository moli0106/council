<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
  <!-- Content Wrapper. Contains page content -->
  <style>
      .course_sector_block, .work_exp_section, .experience_section, .agency_section{
    padding:10px 0px 10px 0px;
    margin-bottom:10px;
    border:2px solid #CCC;
      }
      .btn-space {
    margin-right: 5px;
    }
  </style>
  <div class="content-wrapper">
    <section class="content-header">
    	<h1>Assessor Registration Form</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> Assessor Registration Form</li>
            <li class="active"><i class="fa fa-envelope-o"></i> Experience As Assessor / Expert of syllabus committee</li>
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
                <h3 class="box-title">Experience As Assessor / Expert of syllabus committee</h3>
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
                    <li><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional<br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/document_upload">Document<br>Upload</a></li>
                    <li><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert<br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/ssc_wbsctvesd_certified">SSC/ WBSCTVESD <br> Certified</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>
				<?php if($app_data[0]['course_flag'] == NULL) { ?>
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> Please submit Course details first.
                    </div>
                <?php } else { ?>
                <div>
					<?php if(count($assessor_experience)){ ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">Sl#</th>
                                        <th>Job Role</th>
                                        <th>NSQF Level</th>
                                        <th>No of Years</th>
                                        <th>No of Months</th>
                                        <th style="width:150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($assessor_experience as $assessor_exp){ ?>
                                        <tr id="assessor_exp_<?php echo md5($assessor_exp['assessor_registration_assessor_expert_map_id_pk']); ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $assessor_exp['course_name']; ?>(<?php echo $assessor_exp['course_code']; ?>)</td>
                                            <td><?php echo $assessor_exp['nsqf_level']; ?></td>
                                            <td><?php echo $assessor_exp['exp_as_assessor_work_years'] ?></td>
                                            <td><?php echo $assessor_exp['exp_as_assessor_work_months'] ?></td>
                                            <td>
                                            <a target="_blank"href="assessor_profile/assessor_registration/download_asse_exp_file/<?php echo $assessor_exp['assessor_registration_assessor_expert_map_id_pk']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                <?php if($app_data[0]['final_flag'] == 'f' || $app_data[0]['final_flag'] == ''){ ?>
                                                	<a href="javascript:void(0)" id="<?php echo md5($assessor_exp['assessor_registration_assessor_expert_map_id_pk']); ?>" class="btn btn-danger btn-xs assessor_exp_remove" data-toggle="modal" data-target="#assessor_expRemove">Remove</a>
												<?php } ?>
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <hr/>


                <?php if($app_data[0]['final_flag'] != 't'){ ?>
                <h4>Experience As Assessor / Expert of syllabus committee</h4><hr>
                <div class="experience_block">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">Job Role</label>
                            <select class="form-control select2 select2-hidden-accessible" name="exp_as_assessor_job_role" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off">
                                <option value="">-- Select Job Role --</option>
                                <?php foreach($assessor_courses as $assessor_course) { ?>
                                <option value="<?php echo $assessor_course["course_id_pk"] ?>" <?php echo set_select("exp_as_assessor_job_role",$assessor_course["course_id_pk"]) ?>><?php echo $assessor_course["course_name"] ?> (<?php echo $assessor_course["course_code"] ?>)</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('exp_as_assessor_job_role'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">NSQF Level</label>
                            <input type="text" value="<?php echo set_value("nsqf_level")  ?>" name="nsqf_level" id="nsqf_level" class="form-control" placeholder="NSQF Level">
                            <?php echo form_error('nsqf_level'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">No of Years</label>
                            <input type="text" value="<?php echo set_value("exp_as_assessor_work_years")  ?>" name="exp_as_assessor_work_years" class="form-control" placeholder="No of Years">
                            <?php echo form_error('exp_as_assessor_work_years'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">No of Months</label>
                            <input type="text" value="<?php echo set_value("exp_as_assessor_work_months")  ?>" name="exp_as_assessor_work_months" id="work_months" class="form-control" placeholder="No of Months">
                            <?php echo form_error('exp_as_assessor_work_months'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Upload doc (.PDF only, 100KB Max)</label>
                            <input type="file" class="form-control" placeholder="Doc" name="exp_as_assessor_doc">
                            <?php echo form_error('exp_as_assessor_doc'); ?>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php }?>
				<?php }?>
            
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/work_experience" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="assessor_profile/assessor_registration/professional_details" class="btn btn-primary btn-space confirm_next">Next > </a>
                </div>
                <?php if($app_data[0]['final_flag'] != 't'){ ?>
                <button type="submit" class="btn btn-primary pull-right">Add & Save</button>
                <?php } ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>

        
	</section>
</div>


<!---------------------------- Modal for Remove Work Exp ----------------------->
<div id="assessor_expRemove" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal_remove_content">

	    </div>
	  </div>
	</div>
    <!---------------------------- Modal for Remove Work Exp ----------------------->
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>


