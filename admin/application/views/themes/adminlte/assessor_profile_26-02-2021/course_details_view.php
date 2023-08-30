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
            <li class="active"><i class="fa fa-envelope-o"></i> Course Details</li>
        </ol>
    </section>
    <section class="content">
        <?php if(isset($success)){ ?>
            
            <div class="alert alert-<?php echo $success ?>">
                <?php echo $message; ?>
            </div>
            
        <?php } ?>
        <?php echo form_open('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Course Details</h3>
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
                    <li class="active"><a href="assessor_profile/assessor_registration/course">Course</a></li>
                    <li><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>
                
				<div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="designation">Minimum Domain Qualification <span class="text-danger">*</span></label>
                        <select class="form-control apply_highest_quali select2 select2-hidden-accessible" name="apply_highest_quali" id="apply_highest_quali" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled;?>>
                            <option value="">-- Domain Qualification --</option>
                            <?php if($this->input->method(TRUE) == "POST"){ ?>
                                <?php foreach($qualifications as $qualification){ ?>
                                <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("apply_highest_quali",$qualification['qualification_id_pk']); ?>><?php echo $qualification['qualification'] ?></option>
                                <?php } ?>
                            <?php } else { ?>
                                <?php foreach($qualifications as $qualification){ ?>
                                <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo $assessor[0]["apply_highest_quali"] == $qualification['qualification_id_pk'] ? "selected" : ""; ?>><?php echo $qualification['qualification'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('apply_highest_quali'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation"> Minimum Domain Experience <span class="text-danger">*</span></label>
                        <select class="form-control domain_exp select2 select2-hidden-accessible" name="domain_exp" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled;?>>
                            <option value="">-- Experiance --</option>
                            <?php if($this->input->method(TRUE) == "POST"){ ?>
                                <?php  if(set_value("apply_highest_quali")){ ?>
                                    <?php foreach($domain_experiances as $domain_experiance){ ?>
                                        <option value="<?php echo $domain_experiance['domain_specific_working_experience'] ?>" <?php echo set_select("domain_exp",$domain_experiance['domain_specific_working_experience']) ?>><?php echo $domain_experiance['domain_specific_working_experience'] ?></option>
                                    <?php } ?>
                                <?php }?>
                            <?php } else { ?>
                                <?php  if($assessor[0]["apply_highest_quali"] != NULL){ ?>
                                    <?php foreach($domain_experiances as $domain_experiance){ ?>
                                        <option value="<?php echo $domain_experiance['domain_specific_working_experience'] ?>" <?php echo $assessor[0]["domain_exp"] == $domain_experiance['domain_specific_working_experience'] ? "selected" : ""; ?>><?php echo $domain_experiance['domain_specific_working_experience'] ?></option>
                                    <?php } ?>
                                <?php }?>
                            <?php } ?>

                        </select>
                        <?php echo form_error('domain_exp'); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="designation">Domain<span class="text-danger">*</span></label>
                        <select class="form-control domain select2 select2-hidden-accessible" name="domain" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled;?>>
                            <option value="">-- Select Domain --</option>
                            <?php if($this->input->method(TRUE) == "POST"){ ?>
                                <?php foreach($domains as $domain){ ?>
                                <option value="<?php echo $domain['domain_id_pk'] ?>"<?php echo set_select("domain",$domain['domain_id_pk']) ?>><?php echo $domain['domain_name'] ?></option>
                                <?php } ?>
                            <?php } else { ?>
                                <?php foreach($domains as $domain){ ?>
                                <option value="<?php echo $domain['domain_id_pk'] ?>" <?php echo $assessor[0]["domain_id_fk"] == $domain['domain_id_pk'] ? "selected" : ""; ?>><?php echo $domain['domain_name'] ?></option>
                                <?php } ?>
                            <?php } ?>

                        </select>
                        <?php echo form_error('domain'); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Applying for? <span class="text-danger">*</span></label><br/>
                        <?php if($this->input->method(TRUE) == "POST"){ ?>

                        <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" <?php echo set_checkbox('apply_for_assessor', '1'); ?> />  <span>Assessor</span> <br><br>
                        <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" <?php echo set_checkbox('apply_for_expert', '1'); ?> />  <span>Expert</span><br>
                        <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" <?php echo set_checkbox('trainer_of_trainers', '1'); ?> />  <span>Trainer of trainers</span><br>

                        <?php } else { ?>

                            <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" <?php echo $assessor[0]["apply_for_assessor"] == 1 ? "checked" : ""; ?> <?php echo $disabled;?> />  <span>Assessor</span> <br>
                            <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" <?php echo $assessor[0]["apply_for_expert"] == 1 ? "checked" : ""; ?> <?php echo $disabled;?> />  <span>Expert</span><br>
                            <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" <?php echo $assessor[0]["apply_for_trainer_of_trainer"] == 1 ? "checked" : ""; ?> <?php echo $disabled;?> />  <span>Trainer of trainers</span><br>

                        <?php } ?>
                        <?php echo form_error('apply_for_assessor'); ?>
                        <?php echo form_error('apply_for_expert'); ?>
                        <?php if(isset($apply_for)){ ?>
                            <div class="text-danger"><?php echo $apply_for; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <label>Expart Type <span class="text-danger">*</span></label><br/>

                    <?php if($this->input->method(TRUE) == "GET"){ ?>
                        <?php if($assessor[0]["apply_for_expert"] != NULL){ ?>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" <?php echo $assessor[0]["expart_type_academic"] == 1 ? "checked": ""; ?> <?php echo $disabled;?>> Academic Expert<br>
                            <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" <?php echo $assessor[0]["expart_type_industrial"] == 1 ? "checked": ""; ?> <?php echo $disabled;?>> Industrial expert<br>
                        <?php } else { ?>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" disabled> Academic Expert<br>
                            <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" disabled> Industrial expert<br>
                        <?php } ?>
                    <?php } elseif($this->input->method(TRUE) == "POST"){ ?>

                        <?php if($this->input->post("apply_for_expert") != NULL){ ?>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" <?php echo set_checkbox('expart_type_academic', '1'); ?> > Academic Expert<br>
                            <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" <?php echo set_checkbox('expart_type_industrial', '1'); ?>> Industrial expert<br>
                        <?php } else {?>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" disabled> Academic Expert<br>
                            <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" disabled> Industrial expert<br>
                        <?php } ?>

                    <?php } ?>
                   <?php if(isset($academic_expert)){ ?>
                        <div class="text-danger"><?php echo $academic_expert; ?></div>
                    <?php } ?>

                </div>
            </div>
            <!-- Multiple course sector area start -->
            <div class="course_sector">
            
            <?php if($this->input->method(TRUE) == "POST"){ ?>
                <input type="hidden" name="course_sector_block_count" id="course_sector_block_count" class="form-control" value="<?php echo set_value("course_sector_block_count"); ?>">
            <?php } else { ?>
                <?php $total_job = count($jobroles); ?>
                <input type="hidden" name="course_sector_block_count" id="course_sector_block_count" class="form-control" value="<?php echo ($total_job + 1) ?>">
            <?php } ?>
            
                <!-- Course sector block  start-->
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <?php if(!count($jobroles)) { ?>
                <div class="row course_sector_block">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Job Role <span class="text-danger">*</span></label>
                            <select class="form-control job_role select2 select2-hidden-accessible" name="job_role[1]" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off">
                                <option value="">-- Select Job Role --</option>
                                    <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                    <?php foreach($courses as $course){ ?>
                                    <option value="<?php echo $course["course_id_pk"] ?>" <?php echo set_select("job_role[1]",$course["course_id_pk"]) ?>><?php echo $course["course_name"] ?> (<?php echo $course["course_code"]  ?>)</option>
                                    <?php } ?>
                                <?php } elseif ($this->input->method(TRUE) == "GET"){ ?>
                                    <?php foreach($courses as $course){ ?>
                                    <?php if(count($jobroles)){ ?>
                                    <option value="<?php echo $course["course_id_pk"] ?>" <?php echo $course["course_id_pk"] == $jobroles[0]["course_id_fk"] ? "selected" : ""; ?>><?php echo $course["course_name"] ?> (<?php echo $course["course_code"]  ?>)</option>
                                    <?php } else { ?>
                                    <option value="<?php echo $course["course_id_pk"] ?>" <?php echo set_select("job_role[1]",$course["course_id_pk"]) ?>><?php echo $course["course_name"] ?> (<?php echo $course["course_code"]  ?>)</option>
                                    <?php }} ?>
                                <?php } ?>

                            </select>
                            <?php echo form_error('job_role[1]'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sector <span class="text-danger">*</span></label>
                            <?php if(count($jobroles)){ ?>
                            <input type="text" class="form-control sector_name" value="<?php echo $jobroles[0]["sector_name"] ?>" placeholder="Sector name" name="sector[1]" readonly>
                            <?php } else { ?>
                            <input type="text" class="form-control sector_name" value="<?php echo set_value("sector[1]") ?>" placeholder="Sector name" name="sector[1]" readonly>

                            <?php } ?>
                            <?php echo form_error('sector[1]'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="job_role_sp_quali">Job role specific qualification</label>
                            <?php if(count($jobroles)){ ?>
                            <input type="text" class="form-control job_role_sp_quali"value="<?php echo $jobroles[0]["job_role_sp_quali"] ?>" placeholder="Job role specific qualification" name="job_role_sp_quali[1]" >
                            <?php } else { ?>

                            <input type="text" class="form-control job_role_sp_quali"value="<?php echo set_value("job_role_sp_quali[1]") ?>" placeholder="Job role specific qualification" name="job_role_sp_quali[1]" >
                            <?php } ?>
                            <?php echo form_error('job_role_sp_quali[1]'); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>&nbsp;</label><br>
                            <button type="button" class="btn btn-primary course_sector_block_add"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                        </div>   
                    </div>
                    <div class="col-md-12">
                        <!--<div class="form-group text_here">
                           
                        </div>-->
                    </div>
                </div>
                <?php } } ?>
                <?php  if($this->input->method(TRUE) == "POST"){ ?>
                    <?php if($this->input->post("apply_highest_quali") != NULL && $this->input->post("domain_exp") != NULL){ ?>
                        <?php foreach($this->input->post("job_role") as $k => $v){ ?>
                            <?php //if($k != 1){ ?>
                                <div class="row course_sector_block">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Job Role <span class="text-danger">*</span></label>
                                            <select class="form-control job_role" name="job_role[<?php echo $k ?>]">
                                                <option value="">-- Select Job Role --</option>
                                                <?php foreach($courses as $course){ ?>
                                                <option value="<?php echo $course["course_id_pk"] ?>" <?php echo set_select("job_role[".$k."]",$course["course_id_pk"]) ?>><?php echo $course["course_name"] ?> (<?php echo $course["course_code"]  ?>)</option>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('job_role['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sector <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control sector_name" value="<?php echo set_value("sector[".$k."]") ?>" placeholder="Sector name" name="sector[<?php echo $k ?>]" readonly>
                                            <?php echo form_error('sector['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="job_role_sp_quali">Job role specific qualification</label>
                                            <input type="text" class="form-control job_role_sp_quali" value="<?php echo set_value("job_role_sp_quali[".$k."]") ?>" placeholder="Job role specific qualification" name="job_role_sp_quali[<?php echo $k ?>]" >
                                            </select>
                                            <?php echo form_error('job_role_sp_quali['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>&nbsp;</label><br>
                                        
                                            <?php if($k == 0){  ?>
                                            <button type="button" class="btn btn-primary course_sector_block_add"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                                            <?php } else { ?>
                                            <button type="button" class="btn btn-danger course_sector_block_remove"><i class="fa fa-times" aria-hidden="true"></i></button> 
                                            <?php } ?>
                                        </div>   
                                    </div>
                                    <div class="col-md-12">
                                        <!--<div class="form-group text_here">
                                        
                                        </div>-->
                                    </div>
                                </div>
                            <?php //} ?>
                        <?php } ?>
                    <?php } ?>
                <?php } elseif($this->input->method(TRUE) == "GET"){ ?>

                    
                    <?php // if($this->input->post("apply_highest_quali") != NULL && $this->input->post("domain_exp") != NULL){ ?>
                        <?php foreach($jobroles as $k => $v){ ?>
                            <?php //if($k != 0){ ?>
                                <div class="row course_sector_block">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Job Role <span class="text-danger">*</span></label>
                                            <select class="form-control job_role" name="job_role[<?php echo $k ?>]" <?php echo $disabled;?>>
                                                <option value="">-- Select Job Role --</option>
                                                <?php foreach($courses as $course){ ?>
                                                <option value="<?php echo $course["course_id_pk"] ?>" <?php echo $course["course_id_pk"] == $v['course_id_fk'] ? "selected" : ""; ?> ><?php echo $course["course_name"] ?> (<?php echo $course["course_code"]  ?>)</option>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('job_role['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sector <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control sector_name" value="<?php print_r($v['sector_name']); ?>" placeholder="Sector name" name="sector[<?php echo $k ?>]" readonly>
                                            <?php echo form_error('sector['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="job_role_sp_quali">Job role specific qualification</label>
                                            <input type="text" class="form-control job_role_sp_quali" value="<?php print_r($v['job_role_sp_quali']); ?>" placeholder="Job role specific qualification" name="job_role_sp_quali[<?php echo $k ?>]" <?php echo $disabled;?>>
                                            </select>
                                            <?php echo form_error('job_role_sp_quali['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>&nbsp;</label><br>
                                            <?php if($k == 0){  ?>
                                            <button type="button" class="btn btn-primary course_sector_block_add" <?php echo $disabled;?>><i class="fa fa-plus" aria-hidden="true"></i></button> 
                                            <?php } else { ?>
                                            <button type="button" class="btn btn-danger course_sector_block_remove" <?php echo $disabled;?>><i class="fa fa-times" aria-hidden="true"></i></button> 
                                            <?php } ?>
                                        </div>   
                                    </div>
                                    <div class="col-md-12">
                                        <!--<div class="form-group text_here">
                                        
                                        </div>-->
                                    </div>
                                </div>
                            <?php //} ?>
                        <?php } ?>
                    <?php //} ?>
                <?php } ?>
            </div>


    
                
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/basic" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp" class="btn btn-primary btn-space confirm_next">Next > </a>
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
