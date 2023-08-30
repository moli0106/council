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
            <li class="active"><i class="fa fa-envelope-o"></i> Work Experience</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Work Experience</h3>
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
                    <li class="active"><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present<br> Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/ssc_wbsctvesd_certified">SSC/ WBSCTVESD <br> Certified</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>
                <div>
					<?php if(count($work_experiences)){ ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">Sl#</th>
                                        <th>Organisation</th>
                                        <th>Area of Work</th>
                                        <th>No of Years</th>
                                        <th>No of Months</th>
                                        <th style="width:150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($work_experiences as $work_experience){ ?>
                                        <tr id="work_exp_<?php echo md5($work_experience['assessor_work_experience_id_pk']); ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo ucwords($work_experience['organisation_name']); ?></td>
                                            <td><?php echo $work_experience['area_of_work']; ?></td>
                                            <td><?php echo $work_experience['no_of_years'] ?></td>
                                            <td><?php echo $work_experience['no_of_months'] ?></td>
                                            <td>
                                            <a target="_blank"href="assessor_profile/assessor_registration/download_work_exp_file/<?php echo $work_experience['assessor_work_experience_id_pk']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                <?php if($app_data[0]['final_flag'] == 'f' || $app_data[0]['final_flag'] == ''){ ?>
                                                	<a href="javascript:void(0)" id="<?php echo md5($work_experience['assessor_work_experience_id_pk']); ?>" class="btn btn-danger btn-xs work_exp_remove" data-toggle="modal" data-target="#work_expRemove">Remove</a>
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
                <h4>Work Experience<span style="color:#F00; font-size:14px;">(At least one Work Experience is mandatory for each Assessor.)</span></h4><hr>


                <div class="work_block">
           
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">Organisation Name <span class="text-danger">*</span></label>
                            <input type="text" name="org_name" class="form-control" value="<?php echo set_value("org_name")  ?>" placeholder="Organisation Name">
                            <?php echo form_error('org_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">Area of Work <span class="text-danger">*</span></label>
                            <input type="text" name="work_area" id="" class="form-control" value="<?php echo set_value("work_area")  ?>" placeholder="Area of Work">
                            <?php echo form_error('work_area'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">No of Years <span class="text-danger">*</span></label>
                            <input type="text"  name="work_years" class="form-control" value="<?php echo set_value("work_years")  ?>" placeholder="No of Years">
                            <?php echo form_error('work_years'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="landline">No of Months <span class="text-danger">*</span></label>
                            <input type="text" name="work_months" class="form-control" value="<?php echo set_value("work_months")  ?>" placeholder="No of Months">
                            <?php echo form_error('work_months'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Upload doc (.PDF only, Max 100KB) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" placeholder="Experience Month" name="experience" value="">
                            <?php echo form_error('experience'); ?>
                           
                        </div>
                    </div>
                    
                </div>
           
           </div>
           <?php }?>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/contact" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="assessor_profile/assessor_registration/assessor_experience" class="btn btn-primary btn-space confirm_next">Next > </a>
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
<div id="work_expRemove" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal_remove_content">

	    </div>
	  </div>
	</div>
    <!---------------------------- Modal for Remove Work Exp ----------------------->
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
