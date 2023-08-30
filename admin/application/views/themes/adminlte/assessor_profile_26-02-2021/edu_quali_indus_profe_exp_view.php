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
            <li class="active"><i class="fa fa-envelope-o"></i> Educational Qualification And Industry/Professional Experience</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/'. uri_string(), array('id'=>'edu_quali')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Educational Qualification And Industry/Professional Experience</h3>
            </div>
            <div class="box-body">

                <?php if(isset($status)){ ?>
                    <div class="alert alert-<?php echo $status == TRUE ? 'success' : 'danger'; ?>">
                        <?php echo $message; ?>.
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
                    <li class="active"><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional Experience</a></li>
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
                <div class="col-md-12">
                    <?php if(count($assessor_certificates)){ ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Assessing body</th>
                                <th>Assessor certificate number</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($assessor_certificates as $assessor_certificate){ ?>
                            <tr>
                                <td><?php echo $assessor_certificate['assessing_body'] ?></td>
                                <td><?php echo $assessor_certificate['certificate_number'] ?></td>
                                <td>
                                    <a class="btn btn-primary btn-xs" href="assessor_profile/assessor_registration/download_certificate_pdf/<?php echo $assessor_certificate['council_assessor_registration_certified_map_id_pk'] ?>">Download</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                    
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you an assessor certified under any assessment body? <span class="text-danger">*</span></label><br/>
                        <?php if($this->input->method(TRUE) == "POST"){ ?>
                        <input type="radio" class="assessor_certified_status" name="certified" value="1" <?php echo set_radio('certified', '1'); ?> />  <span>Yes</span> &nbsp;
                        <input type="radio" class="assessor_certified_status" name="certified" value="0" <?php echo set_radio('certified', '0', TRUE); ?> />  <span>No</span>
                        <?php } elseif($this->input->method(TRUE) == "GET") { ?>
                            <?php if($assessor[0]["certified_by_any_assessor"] == 1) { ?>
                            <input type="radio" class="assessor_certified_status" name="certified" value="1" <?php echo $assessor[0]["certified_by_any_assessor"]  == 1 ? "checked" : ""; ?> <?php echo $disabled; ?> />  <span>Yes</span> &nbsp;
                            <input type="radio" class="assessor_certified_status" name="certified" value="0" <?php echo $assessor[0]["certified_by_any_assessor"]  != 1 ? "checked" : ""; ?> <?php echo $disabled; ?> />  <span>No</span>
                            <?php } else { ?>
                                <input type="radio" class="assessor_certified_status" name="certified" value="1" <?php echo $assessor[0]["certified_by_any_assessor"]  == 1 ? "checked" : ""; ?> <?php echo $disabled; ?> />  <span>Yes</span> &nbsp;
                            <input type="radio" class="assessor_certified_status" name="certified" value="0" <?php echo $assessor[0]["certified_by_any_assessor"]  != 1 ? "checked" : ""; ?> <?php echo $disabled; ?> />  <span>No</span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if($this->input->method(TRUE) == "POST"){ ?>
                <input type="hidden" name="assessing_body_count" id="assessing_body_count" class="form-control" value="<?php echo set_value("assessing_body_count"); ?>">
            <?php } else { ?>
                <input type="hidden" name="assessing_body_count" id="assessing_body_count" class="form-control" value="1">
            <?php } ?>
            <?php  if($this->input->method(TRUE) == "GET"){ ?>
            
            <div class="agency_block" style="<?php echo $assessor[0]["certified_by_any_assessor"] == 1 ? "display: block;" : "display: none;" ?> ?>">
                <div class="row agency_section">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Assessing body <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Assessing body" name="assessing_body[1]" <?php echo $disabled; ?>>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Assessor certificate number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Assessor certificate number" name="certificate_number[1]" <?php echo $disabled; ?>>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="designation">Upload Doc (.PDF only, Max 100KB) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" value="" placeholder="Upload Doc" name="certificate_doc_1" <?php echo $disabled; ?>>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="designation">&nbsp;</label><br>
                            <button type="button" class="btn btn-primary certificate_number_add" <?php echo $disabled; ?>><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                <div class="agency_block" style="<?php echo $this->input->post("certified") == 1 ? "" : "display:none" ; ?>">
                <?php foreach($this->input->post("assessing_body") as $k => $v){ ?>
                    <div class="row agency_section">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Assessing body <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?php echo set_value('assessing_body['.$k.']') ?>" placeholder="Assessing body" name="assessing_body[<?php echo $k ?>]">
                                <?php echo form_error('assessing_body['.$k.']'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Assessor certificate number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="<?php echo set_value('certificate_number['.$k.']') ?>" placeholder="Assessor certificate number" name="certificate_number[<?php echo $k ?>]">
                                <?php echo form_error('certificate_number['.$k.']'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="designation">Upload Doc (.PDF only, Max 100KB) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" value="" placeholder="Upload Doc" name="certificate_doc_<?php echo $k ?>">
                                <?php echo form_error('certificate_doc_'.$k); ?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="designation">&nbsp;</label><br>
                                <?php if($k == 1){ ?>
                                <button type="button" class="btn btn-primary certificate_number_add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-danger certificate_number_remove"><i class="fa fa-times" aria-hidden="true"></i></button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Highest Qualification <span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" name="highest_quali" id="highest_quali"  style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>> 
                            <option value="">-- Highest Qualification --</option>
                            <?php if($this->input->method(TRUE) == "POST"){ ?>
                                <?php foreach($qualifications as $qualification){ ?>
                                <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("highest_quali",$qualification['qualification_id_pk']); ?>><?php echo $qualification['qualification'] ?></option>
                                <?php } ?>
                            <?php } elseif($this->input->method(TRUE) == "GET"){ ?>
                                <?php foreach($qualifications as $qualification){ ?>
                                <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo $assessor[0]["highest_qualification_id_pk"] == $qualification['qualification_id_pk'] ? "selected" : ""; ; ?>><?php echo $qualification['qualification'] ?></option>
                                <?php } ?>
                            <?php } ?>

                        </select>
                        <?php echo form_error('highest_quali'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Discipline<span class="text-danger">*</span></label>
                        <?php if($this->input->method(TRUE) == "POST"){ ?>
                            <input type="text" value="<?php echo set_value("discipline") ?>" name="discipline" id="discipline" class="form-control"  placeholder="Discipline">
                        <?php } elseif($this->input->method(TRUE) == "GET"){ ?>
                            <input type="text" value="<?php echo $assessor[0]["discipline"] ?>" name="discipline" id="discipline" class="form-control"  placeholder="Discipline" <?php echo $disabled; ?>>
                        <?php } ?>
                        <?php echo form_error('discipline'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Other Qualification</label>
                        <?php if($this->input->method(TRUE) == "POST"){ ?>
                            <input type="text" value="<?php echo set_value("othert_quali") ?>" name="othert_quali" id="othert_quali" class="form-control"  placeholder="Other Qualification">
                        <?php } elseif($this->input->method(TRUE) == "GET"){ ?>
                            <input type="text" value="<?php echo $assessor[0]["othert_quali"] ?>" name="othert_quali" id="othert_quali" class="form-control"  placeholder="Other Qualification" <?php echo $disabled; ?>>
                        <?php } ?>
                        <?php echo form_error('othert_quali'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Current Employement Status<span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" name="current_emp_status" id="current_emp_status" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                            <option value="">-- Employement Status --</option> 
                            <?php if($this->input->method(TRUE) == "POST"){ ?>
                                <?php foreach($employments as $employment){ ?>
                                <option value="<?php echo $employment['employment_status_id_pk'] ?>" <?php echo set_select("current_emp_status",$employment['employment_status_id_pk']); ?>><?php echo $employment['employment_status'] ?></option>
                                <?php } ?>
                            <?php } elseif($this->input->method(TRUE) == "GET"){ ?>
                                <?php foreach($employments as $employment){ ?>
                                <option value="<?php echo $employment['employment_status_id_pk'] ?>" <?php echo $employment['employment_status_id_pk'] == $assessor[0]["current_emp_status_id_fk"] ? "selected" : ""; ?>><?php echo $employment['employment_status'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('current_emp_status'); ?>
                    </div>
                </div>
                
            </div>
                
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/course" class="btn btn-primary btn-space confirm_pre">< Previous</a>
                    <a href="assessor_profile/assessor_registration/contact" class="btn btn-primary btn-space confirm_next">Next > </a>
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
