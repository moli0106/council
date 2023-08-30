<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<style>
.course_sector_block, .work_exp_section, .experience_section, .agency_section{
    padding:10px 0px 10px 0px;
    margin-bottom:10px;
    border:2px solid #CCC;
}
</style>
    <div class="container">
        <h3>Assessor / Expert registration form</h3><hr>
        <?php echo form_open_multipart("assessor/assessor_reg/reg_form/".$assessor_id_hash,array("id" => "assessor_reg_form"));?>
        <input type="hidden" name="token" value="<?php echo $captcha['word'] ?>">
        <input type="hidden" name="assessor_id" value="<?php echo $assessor_id_pk ?>">
           
            <h4>Course Details</h4><hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Domain Qualification <span class="text-danger">*</span></label>
                        <select class="form-control apply_highest_quali" name="apply_highest_quali" id="apply_highest_quali">
                            <option value="">-- Domain Qualification --</option>
                            <?php foreach($qualifications as $qualification){ ?>
                            <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("apply_highest_quali",$qualification['qualification_id_pk']); ?>><?php echo $qualification['qualification'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('apply_highest_quali'); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="designation">Domain Experiance <span class="text-danger">*</span></label>
                        <select class="form-control domain_exp" name="domain_exp">
                            <option value="">-- Experiance --</option>
                            <?php  if(set_value("apply_highest_quali")){ ?>
                                <?php foreach($domain_experiances as $domain_experiance){ ?>
                                    <option value="<?php echo $domain_experiance['domain_specific_working_experience'] ?>" <?php echo set_select("domain_exp",$domain_experiance['domain_specific_working_experience']) ?>><?php echo $domain_experiance['domain_specific_working_experience'] ?></option>
                                <?php } ?>
                            <?php }?>

                        </select>
                        <?php echo form_error('domain_exp'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Domain<span class="text-danger">*</span></label>
                        <select class="form-control domain" name="domain">
                            <option value="">-- Select Domain --</option>
                            <?php foreach($domains as $domain){ ?>
                            <option value="<?php echo $domain['domain_id_pk'] ?>"<?php echo set_select("domain",$domain['domain_id_pk']) ?>><?php echo $domain['domain_name'] ?></option>
                            <?php } ?>                           

                        </select>
                        <?php echo form_error('domain'); ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Applying for? <span class="text-danger">*</span></label><br/>
                        <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" <?php echo set_checkbox('apply_for_assessor', '1'); ?> />  <span>Assessor</span> <br>
                        <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" <?php echo set_checkbox('apply_for_expert', '1'); ?> />  <span>Expert</span>
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
                    <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" disabled> Academic Expert<br>
                    <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" disabled> Industrial expert<br>
                    <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                        <?php if($this->input->post("apply_for_expert") != NULL){ ?>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" <?php echo set_checkbox('expart_type_academic', '1'); ?>> Academic Expert<br>
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
            <!-- Multiple ourse sector area start -->
            <div class="course_sector">
            
            <?php if($this->input->method(TRUE) == "POST"){ ?>
                <input type="hidden" name="course_sector_block_count" id="course_sector_block_count" class="form-control" value="<?php echo set_value("course_sector_block_count"); ?>">
            <?php } else { ?>
                <input type="hidden" name="course_sector_block_count" id="course_sector_block_count" class="form-control" value="1">
            <?php } ?>
            
                <!-- Course sector block  start-->
                <div class="row course_sector_block">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Job Role <span class="text-danger">*</span></label>
                            <select class="form-control job_role" name="job_role[1]">
                                <option value="">-- Select Job Role --</option>
                                    <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                    <?php foreach($courses as $course){ ?>
                                    <option value="<?php echo $course["course_id_pk"] ?>" <?php echo set_select("job_role[1]",$course["course_id_pk"]) ?>><?php echo $course["course_name"] ?> (<?php echo $course["course_code"]  ?>)</option>
                                    <?php } ?>
                                <?php } ?>

                            </select>
                            <?php echo form_error('job_role[1]'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sector <span class="text-danger">*</span></label>
                            <input type="text" class="form-control sector_name" value="<?php echo set_value("sector[1]") ?>" placeholder="Sector name" name="sector[1]" readonly>
                            <?php echo form_error('sector[1]'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="job_role_sp_quali">Job role specific qualification</label>
                            <input type="text" class="form-control job_role_sp_quali"value="<?php echo set_value("job_role_sp_quali[1]") ?>" placeholder="Job role specific qualification" name="job_role_sp_quali[1]" >
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
                        <div class="form-group text_here">
                           
                        </div>
                    </div>
                </div>
                <?php  if($this->input->method(TRUE) == "POST"){ ?>
                    <?php if($this->input->post("apply_highest_quali") != NULL && $this->input->post("domain_exp") != NULL){ ?>
                        <?php foreach($this->input->post("job_role") as $k => $v){ ?>
                            <?php if($k != 1){ ?>
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
                                            <button type="button" class="btn btn-danger course_sector_block_remove"><i class="fa fa-times" aria-hidden="true"></i></button> 
                                        </div>   
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text_here">
                                        
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
            
            <!-- Course sector block end -->
            <!-- Multiple ourse sector area end -->
            <br>
            <h4>Educational Qualification And Industry/Professional Experience</h4><hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you an assessor certified under any assessment body? <span class="text-danger">*</span></label><br/>
                        <input type="radio" class="assessor_certified_status" name="certified" value="1" <?php echo set_radio('certified', '1'); ?> />  <span>Yes</span> &nbsp;
                        <input type="radio" class="assessor_certified_status" name="certified" value="0" <?php echo set_radio('certified', '0', TRUE); ?> />  <span>No</span>
                    </div>
                </div>
            </div>
            <?php if($this->input->method(TRUE) == "POST"){ ?>
                <input type="hidden" name="assessing_body_count" id="assessing_body_count" class="form-control" value="<?php echo set_value("assessing_body_count"); ?>">
            <?php } else { ?>
                <input type="hidden" name="assessing_body_count" id="assessing_body_count" class="form-control" value="1">
            <?php } ?>
            <?php  if($this->input->method(TRUE) == "GET"){ ?>
            <div class="agency_block" style="display:none">
                <div class="row agency_section">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Assessing body <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Assessing body" name="assessing_body[1]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Assessor certificate number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Assessor certificate number" name="certificate_number[1]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">Upload Doc (PDF only, Max 50KB) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" value="" placeholder="Upload Doc" name="certificate_doc_1">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="designation">&nbsp;</label><br>
                            <button type="button" class="btn btn-primary certificate_number_add"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="designation">Upload Doc (PDF only, Max 50KB) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" value="" placeholder="Upload Doc" name="certificate_doc_<?php echo $k ?>">
                                <?php echo form_error('certificate_doc_'.$k); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <select class="form-control" name="highest_quali" id="highest_quali">
                            <option value="">-- Highest Qualification --</option>
                            <?php foreach($qualifications as $qualification){ ?>
                            <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("highest_quali",$qualification['qualification_id_pk']); ?>><?php echo $qualification['qualification'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('highest_quali'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Discipline<span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("discipline") ?>" name="discipline" id="discipline" class="form-control"  placeholder="Discipline">
                        <?php echo form_error('discipline'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Other Qualification</label>
                        <input type="text" value="<?php echo set_value("othert_quali") ?>" name="othert_quali" id="othert_quali" class="form-control"  placeholder="Other Qualification">
                        <?php echo form_error('othert_quali'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Current Employement Status<span class="text-danger">*</span></label>
                        <select class="form-control" name="current_emp_status" id="current_emp_status">
                            <option value="">-- Current Employement Status --</option> 
                            <?php foreach($employments as $employment){ ?>
                            <option value="<?php echo $employment['employment_status_id_pk'] ?>" <?php echo set_select("current_emp_status",$employment['employment_status_id_pk']); ?>><?php echo $employment['employment_status'] ?></option>
                            <?php } ?>

                        </select>
                        <?php echo form_error('current_emp_status'); ?>
                    </div>
                </div>
                
            </div>
            <br>
            <br>
           <h3>Residential Address & Contact Information</h3>
           <hr>
           <h4>Present Address</h4>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">House / Flat / Building / Plot <span class="text-danger">*</span></label>
                        <input type="text" name="house_flat_building" value="<?php echo set_value("house_flat_building")  ?>" id="house_flat_building" class="form-control"  placeholder="House / Flat / Building / Plot">
                        <?php echo form_error('house_flat_building'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Street Name <span class="text-danger">*</span></label>
                        <input type="text" name="street"  value="<?php echo set_value("street")  ?>" id="street" class="form-control"  placeholder="Street Name">
                        <?php echo form_error('street'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Post Office <span class="text-danger">*</span></label>
                        <input type="text" name="post_opffice"  value="<?php echo set_value("post_opffice")  ?>" id="post_opffice" class="form-control"  placeholder="Post Office">
                        <?php echo form_error('post_opffice'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Police Station </label>
                        <input type="text" name="police"  value="<?php echo set_value("police")  ?>" id="police" class="form-control"  placeholder="Police Station">
                        <?php echo form_error('police'); ?>
                        
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">State <span class="text-danger">*</span></label>
                        <select class="form-control" name="state" id="state">
                            <option value="">-- Select State --</option>
                            <?php foreach($states as $state){ ?>
                                <option value="<?php echo $state['state_id_pk']; ?>" <?php echo set_select("state",$state['state_id_pk']); ?>><?php echo $state['state_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('state'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">District <span class="text-danger">*</span></label>
                        <select class="form-control" name="district" id="district">
                            <option value="">-- Select District --</option>
                            <?php foreach($districts as $district){ ?>
                                <option value="<?php echo $district['district_id_pk']; ?>" <?php echo set_select("district",$district['district_id_pk']); ?>><?php echo $district['district_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('district'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Block / Municipality <span class="text-danger">*</span></label>
                        <select class="form-control" name="block" id="block">
                            <option value="">-- Select Block / Municipality --</option>
                            <?php if($this->input->method(TRUE) == "POST"){ ?>
                            <?php foreach($blocks as $block){ ?>
                                <option value="<?php echo $block['block_municipality_id_pk']; ?>" <?php echo set_select("block",$block['block_municipality_id_pk']) ?>><?php echo $block['block_municipality_name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('block'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">PIN Code <span class="text-danger">*</span></label>
                        <input type="text" name="pin" value="<?php echo set_value("pin") ?>" id="pin" class="form-control"  placeholder="PIN">
                        <?php echo form_error('pin'); ?>
                    </div>
                </div>
           </div>
           <h4>Permanent Address</h4>
           <hr>
           <div class="row">
                <div class="col-md-12">
                	<div class="form-group">
                    	<input type="checkbox" value="<?php echo set_value("permanent_same_present_addr") ?>" id="permanent_same_present_addr" name="permanent_same_present_addr"><span>  <b>  Same as Present Address</b></span>
                        <?php echo form_error('permanent_same_present_addr'); ?>
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">House / Flat / Building / Plot <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("permanent_house_flat_building") ?>" name="permanent_house_flat_building" id="permanent_house_flat_building" class="form-control"  placeholder="House / Flat / Building / Plot">
                        <?php echo form_error('permanent_house_flat_building'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Street Name <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("permanent_street") ?>" name="permanent_street" id="permanent_street" class="form-control"  placeholder="Street Name">
                        <?php echo form_error('permanent_street'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Post Office <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("permanent_post_office") ?>" name="permanent_post_office" id="permanent_post_office" class="form-control"  placeholder="Post Office">
                        <?php echo form_error('permanent_post_office'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Police Station</label>
                        <input type="text" value="<?php echo set_value("permanent_police") ?>" name="permanent_police" id="permanent_police" class="form-control"  placeholder="Police Station">
                        <?php echo form_error('permanent_police'); ?>
                    </div>
                </div>
           </div>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">State <span class="text-danger">*</span></label>
                        <select class="form-control" name="permanent_state" id="permanent_state">
                            <option value="">-- Select State --</option>
                            <?php foreach($states as $state){ ?>
                                <option value="<?php echo $state['state_id_pk']; ?>" <?php echo set_select("permanent_state",$state['state_id_pk']); ?>><?php echo $state['state_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('permanent_state'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">District <span class="text-danger">*</span></label>
                        <select class="form-control" name="permanent_district" id="permanent_district">
                            <option value="">-- Select District --</option> 
                            <?php foreach($districts as $district){ ?>
                                <option value="<?php echo $district['district_id_pk']; ?>" <?php echo set_select("permanent_district",$district['district_id_pk']); ?>><?php echo $district['district_name']; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('permanent_district'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Block / Municipality <span class="text-danger">*</span></label>
                        <select class="form-control" name="permanent_block" id="permanent_block">
                            <option value="">-- Select Block / Municipality --</option> 
                            <?php if($this->input->method(TRUE) == "POST"){ ?>
                            <?php foreach($permanent_blocks as $permanent_block){ ?>
                                <option value="<?php echo $permanent_block['block_municipality_id_pk']; ?>" <?php echo set_select("permanent_block",$permanent_block['block_municipality_id_pk']) ?>><?php echo $block['block_municipality_name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                        <?php echo form_error('permanent_block'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">PIN Code <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("permanent_pin") ?>" name="permanent_pin" id="permanent_pin" class="form-control"  placeholder="PIN">
                        <?php echo form_error('permanent_pin'); ?>
                    </div>
                </div>
           </div>

           <br>
           <h3>Work Experience <span class="text-danger">*</span></h3><hr>
           <div class="work_block">
           <?php if($this->input->method(TRUE) == "POST"){ ?>
                <input type="hidden" name="count_work_experience" id="count_work_experience" class="form-control" value="<?php echo set_value("count_work_experience"); ?>">
            <?php } else { ?>
                <input type="hidden" name="count_work_experience" id="count_work_experience" class="form-control" value="1">
            <?php } ?>
           <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="row work_exp_section">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">Organisation Name <span class="text-danger">*</span></label>
                            <input type="text" value="" name="org_name[1]" class="form-control" placeholder="Organisation Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">Area of Work <span class="text-danger">*</span></label>
                            <input type="text" value="" name="work_area[1]" id="" class="form-control" placeholder="Area of Work">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">No of Years <span class="text-danger">*</span></label>
                            <input type="text" value="" name="work_years[1]" class="form-control" placeholder="No of Years">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">No of Months <span class="text-danger">*</span></label>
                            <input type="text" value="" name="work_months[1]" class="form-control" placeholder="No of Months">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Upload doc (100KB Max) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" placeholder="Experience Month" name="experience_1" value="">
                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label><br>
                            <button type="button" class="btn btn-primary add_work_experiance"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                        </div>   
                    </div>
                </div>
           <?php } else { ?>
                <?php foreach($this->input->post("org_name") as $k => $v){ ?>
                    <div class="row work_exp_section">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="landline">Organisation Name <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo set_value("org_name[".$k."]") ?>" name="org_name[<?php echo $k ?>]" class="form-control" placeholder="Organisation Name">
                                        <?php echo form_error('org_name['.$k.']'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="landline">Area of Work <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo set_value("work_area[".$k."]") ?>" name="work_area[<?php echo $k ?>]" id="" class="form-control" placeholder="Area of Work">
                                        <?php echo form_error('work_area['.$k.']'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="landline">No of Years <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo set_value("work_years[".$k."]") ?>" name="work_years[<?php echo $k ?>]" class="form-control" placeholder="No of Years">
                                        <?php echo form_error('work_years['.$k.']'); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="landline">No of Months <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo set_value("work_months[".$k."]") ?>" name="work_months[<?php echo $k ?>]" class="form-control" placeholder="No of Months">
                                        <?php echo form_error('work_months['.$k.']'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Upload doc (100KB Max) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" placeholder="Experience Month" name="experience_<?php echo $k ?>" value="">
                                        <?php echo form_error('experience_'.$k); ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label><br>
                                        <?php if($k == 1){ ?>
                                            <button type="button" class="btn btn-primary add_work_experiance"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-danger work_experiance_remove"><i class="fa fa-times" aria-hidden="true"></i></button> 
                                        <?php } ?>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                <?php } ?>
           <?php } ?>
           </div>

           <br>
           <h3>Experience As Assessor / Expert of syllabus committee</h3><hr>
           <div class="experience_block">
                <?php if($this->input->method(TRUE) == "POST"){ ?>
                    <input type="hidden" name="count_experience_section" id="count_experience_section" class="form-control" value="<?php echo set_value("count_experience_section"); ?>">
                <?php } else { ?>
                    <input type="hidden" name="count_experience_section" id="count_experience_section" class="form-control" value="1">
                <?php } ?>
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="row experience_section">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">Job Role</label>
                            <select class="form-control" name="exp_as_assessor_job_role[1]">
                                <option value="">-- Select Job Role --</option>
                                <?php foreach($assessor_courses as $assessor_course) { ?>
                                <option value="<?php echo $assessor_course["course_id_pk"] ?>" <?php echo set_select("exp_as_assessor_job_role[1]",$assessor_course["course_id_pk"]) ?>><?php echo $assessor_course["course_name"] ?> (<?php echo $assessor_course["course_code"] ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">NSQF Level</label>
                            <input type="text" name="nsqf_level[1]" id="nsqf_level" class="form-control" placeholder="NSQF Level">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">No of Years</label>
                            <input type="text" value="" name="exp_as_assessor_work_years[1]" class="form-control" placeholder="No of Years">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="landline">No of Months</label>
                            <input type="text" value="" name="exp_as_assessor_work_months[1]" id="work_months" class="form-control" placeholder="No of Months">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Upload doc (PDF only, 100KB Max)</label>
                            <input type="file" class="form-control" placeholder="Doc" name="exp_as_assessor_doc_1" ">
                            <?php echo form_error('exp_as_assessor_doc_1'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>&nbsp;</label><br>
                            <button type="button" class="btn btn-primary add_experiance_as_assessor"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                        </div>   
                    </div>
                </div>
                <?php } else { ?>
                    <?php foreach($this->input->post("exp_as_assessor_job_role") as $k => $v){ ?>
                        <div class="row experience_section">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="landline">Job Role</label>
                                            <select class="form-control" name="exp_as_assessor_job_role[<?php echo $k ?>]">
                                                <option value="">-- Select Job Role --</option>
                                                <?php foreach($assessor_courses as $assessor_course) { ?>
                                                <option value="<?php echo $assessor_course["course_id_pk"] ?>" <?php echo set_select("exp_as_assessor_job_role[".$k."]",$assessor_course["course_id_pk"]) ?>><?php echo $assessor_course["course_name"] ?> (<?php echo $assessor_course["course_code"] ?>)</option>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('exp_as_assessor_job_role['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="landline">NSQF Level</label>
                                            <input type="text" value="<?php echo set_value('nsqf_level['.$k.']') ?>" name="nsqf_level[<?php echo $k ?>]" class="form-control" placeholder="NSQF Level">
                                            <?php echo form_error('nsqf_level['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="landline">No of Years</label>
                                            <input type="text" value="<?php echo set_value('exp_as_assessor_work_years['.$k.']') ?>" name="exp_as_assessor_work_years[<?php echo $k ?>]" class="form-control" placeholder="No of Years">
                                            <?php echo form_error('exp_as_assessor_work_years['.$k.']'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="landline">No of Months</label>
                                            <input type="text" value="<?php echo set_value('exp_as_assessor_work_months['.$k.']') ?>" name="exp_as_assessor_work_months[<?php echo $k ?>]" id="work_months" class="form-control" placeholder="No of Months">
                                            <?php echo form_error('exp_as_assessor_work_months['.$k.']'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Upload doc (PDF only, 100KB Max)</label>
                                            <input type="file" class="form-control" placeholder="Doc" name="exp_as_assessor_doc_<?php echo $k ?>">
                                            <?php echo form_error('exp_as_assessor_doc_'.$k); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label><br>
                                            <?php if($k == 1){ ?>
                                                <button type="button" class="btn btn-primary add_experiance_as_assessor"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-danger remove_experiance_as_assessor"><i class="fa fa-times" aria-hidden="true"></i></button> 
                                            <?php } ?>
                                            
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-4">
                <br>
                    <p>Are you working in any <input type="radio" class="working_in" name="working_in" value="vtc" <?php echo set_radio("working_in","vtc") ?> />  <span><b>VTC</b></span> &nbsp; or <input type="radio" class="working_in" name="working_in" value="pbssd" <?php echo set_radio("working_in","pbssd") ?> /> <b> PBSSD</b>? </p>
                    <?php echo form_error('working_in'); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Centre Code</label>
                        <input type="text" value="<?php echo set_value("centre_code"); ?>" name="centre_code" id="centre_code" class="form-control" placeholder="Centre Code">
                        <?php echo form_error('centre_code'); ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label>Centre Name</label>
                        <input type="text" value="" name="centre_name" id="centre_name" class="form-control" placeholder="Centre Name" disabled>
                    </div>
                </div>
            </div>
            <br>
            <h3>Professional details</h3>
            <hr>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Upload CV <span class="text-danger">*</span> (Please provide .pdf within 200KB)</label>
                        <input type="file" class="form-control" placeholder="Experience Month" name="cv" value="<?php echo set_value('cv'); ?>">
                        <?php echo form_error('cv'); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group ">
                        <label>Upload Photo <span class="text-danger">*</span> (JPEG format between 50KB. Dimensions 250x320 pixels preferred)</label>
                        <input type="file" class="form-control" placeholder="Photo" name="photo" value="">
                        <?php echo form_error('photo'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input class="declaration_check" type="checkbox" name="declaration" value="1" id="declaration" <?php echo set_checkbox("declaration",1) ?> />
                    <p class="declaration_text"><b>Declaration</b> : I do hereby declare that the above information is true to my knowledge. I also abide the <a href="#" data-toggle="modal" data-target="#declaration_modal"><u>terms and conditions</u></a> of WBSCTVESD.</p>
                    <?php echo form_error('declaration'); ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-2">
                    <label for="captcha">Captcha</label><br>
                    <?php echo $captcha['image'] ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="captcha">Captcha Code <span class="text-danger">*</span></label>
                        <input type="text" value="" name="captcha_code" id="captcha_code" class="form-control" placeholder="Captcha Code">
                        <?php echo form_error('captcha_code'); ?>
                    </div>
                </div>
                <div class="col-md-7">
                <label for="captcha">&nbsp;</label><br>
                    <button type="submit" class="btn btn-sm btn-primary pull-right">Submit</button>
                </div>
            </div>
            <br>
        <?php echo form_close(); ?>
    </div>
`
<!-- Modal -->
<div id="declaration_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Declaration</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>`
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>