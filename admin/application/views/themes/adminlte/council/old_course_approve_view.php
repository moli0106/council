<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    .star {
        color: red;
        font-size: 14px;
    }

    .mtop20 {
        margin-top: 20px;
    }

    .mbottom20 {
        margin-bottom: 20px;
    }

    .mright20 {
        margin-right: 20px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>New job role approve/reject</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> New job role approve/reject</li>
            
            <input type="hidden" name="application_nubmer_id" id="input_application_nubmer_id" class="form-control" value="<?php echo $application_nubmer_id ?>">
            <input type="hidden" name="application_no" id="input_application_no" class="form-control" value="<?php echo $application_no ?>">

            
        </ol>
    </section>
    <section class="content">
        <?php echo form_open('admin/'. uri_string(), array('id'=>'assessor_course_details')); ?>

        <?php if(isset($message)){ ?>
            
            <div class="alert alert-success">
                <?php echo $message; ?>
            </div>
            
        <?php } ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">New job role approve/reject</h3>

            </div>
            <div class="box-body">

                <input type="hidden" id="assessor_id_hash"
                    value="<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>" />

                <div class="box box-success">
                    <div class="box-header with-border" style="text-align: center;">
                        <h4 class="text-bold">
                            <?php echo $assessor[0]['salutation_desc'] ?>
                            <?php echo $assessor[0]['fname'] ?>
                            <?php echo $assessor[0]['mname'] ?>
                            <?php echo $assessor[0]['lname'] ?>
                        </h4>
                        <i>
                            [ <b><?php echo $assessor[0]['mobile_no'] ?></b> ]
                        </i>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <?php //echo $page_links ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title text-bold">Course List</h4>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Sector</th>
                            <th>Domain Qualification</th>
                            <th>Domain Experience</th>
                            <th>Domain</th>
                            <th>Job role specific qualification</th>
                            <th>Status</th>
                            <?php if(($jobroles[0]['process_status_id_fk'] == NULL) || (in_array($this->session->stake_id_fk, array(2, 5)))){?>
                            <th>Action</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody id="courseListRow">
                        <?php $i = 1; foreach($jobroles as $jobrole) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $jobrole['course_name']; ?> (<?php echo $jobrole['course_code']; ?>)</td>
                            <td><?php echo $jobrole['sector_name']; ?> (<?php echo $jobrole['sector_code']; ?>)</td>
                            <td><?php echo $jobrole['qualification']; ?></td>
                            <td><?php echo $jobrole['domain_exp']; ?> Years</td>
                            <td><?php echo $jobrole['domain_name']; ?></td>
                            <td><?php echo $jobrole['job_role_sp_quali'] == NULL ? "Not provided" : $jobrole['job_role_sp_quali']; ?>
                            </td>
                            <td><?php echo $jobrole['process_status_id_fk'] == NULL ? "NA" : $jobrole['process_name']; ?>
                            </td>
                            <?php //echo validation_errors(); ?>

                            <?php if(($jobrole['process_status_id_fk'] == NULL) || ($jobrole['process_status_id_fk'] == 0) || (in_array($this->session->stake_id_fk, array(2, 5)))){?>
                            <?php if($this->input->method(TRUE) == "GET"){ ?>
                            <td style="padding-left: 20px;;">
                                <div class="radio text-success">
                                    <input id="radio1-<?php echo $i; ?>"
                                        name="radio[<?php echo $jobrole['assessor_registration_jobrole_sector_map_id_pk']; ?>]"
                                        type="radio" value="5"
                                        <?php echo ($jobrole['process_status_id_fk'] == 5) ? 'checked' : ''; ?>>
                                    <label for="radio1-<?php echo $i; ?>" class="radio-label">Accept</label>
                                </div>

                                <div class="radio text-danger">
                                    <input id="radio2-<?php echo $i; ?>"
                                        name="radio[<?php echo $jobrole['assessor_registration_jobrole_sector_map_id_pk']; ?>]"
                                        type="radio" value="6"
                                        <?php echo ($jobrole['process_status_id_fk'] == 6) ? 'checked' : ''; ?>>
                                    <label for="radio2-<?php echo $i; ?>" class="radio-label">Reject</label>
                                </div>
                                <?php echo form_error('radio['.$jobrole['assessor_registration_jobrole_sector_map_id_pk'].']'); ?>
                            </td>
                            <?php } else { ?>
                                <td style="padding-left: 20px;;">
                                <div class="radio text-success">
                                    <input id="radio1-<?php echo $i; ?>"
                                        name="radio[<?php echo $jobrole['assessor_registration_jobrole_sector_map_id_pk']; ?>]"
                                        type="radio" value="5"
                                        <?php echo set_radio("radio[".$jobrole['assessor_registration_jobrole_sector_map_id_pk']."]",5); ?>>
                                    <label for="radio1-<?php echo $i; ?>" class="radio-label">Accept</label>
                                </div>

                                <div class="radio text-danger">
                                    <input id="radio2-<?php echo $i; ?>"
                                        name="radio[<?php echo $jobrole['assessor_registration_jobrole_sector_map_id_pk']; ?>]"
                                        type="radio" value="6"
                                        <?php echo set_radio("radio[".$jobrole['assessor_registration_jobrole_sector_map_id_pk']."]",6); ?>>
                                    <label for="radio2-<?php echo $i; ?>" class="radio-label">Reject</label>
                                </div>
                                <?php echo form_error('radio['.$jobrole['assessor_registration_jobrole_sector_map_id_pk'].']'); ?>
                            </td>
                            
                            <?php }?>
                            
                            <?php }?>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title text-bold">Application Type</h4>
            </div>
            <div class="box-body">
                <table class="table table-hover" id="applicationType">
                    <tr>
                        <th colspan="3">Applying For ?</th>
                    </tr>
                    <tr>
                        <?php if($jobroles[0]["apply_for_approve_reject_status"] != 1) {?>
                        <td>
                            <?php if($jobroles[0]["apply_for_assessor"] == 1){?>
                            <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1"
                                <?php echo $jobroles[0]["apply_for_assessor"] == 1 ? "checked" : ""; ?> />
                            <span>Assessor</span>
                            <?php }else{?>
                            <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1"
                                disabled /> <span>Assessor</span>
                            <?php }?>
                        </td>

                        <td>
                            <?php if($jobroles[0]["apply_for_expert"] == 1){?>
                            <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1"
                                <?php echo $jobroles[0]["apply_for_expert"] == 1 ? "checked" : ""; ?> />
                            <span>Expert</span>
                            <?php }else{?>
                            <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1"
                                disabled /> <span>Expert</span>
                            <?php }?>
                        </td>

                        <td>
                            <?php if($jobroles[0]["apply_for_trainer_of_trainer"] == 1){?>
                            <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1"
                                <?php echo $jobroles[0]["apply_for_trainer_of_trainer"] == 1 ? "checked" : ""; ?> />
                            <span>Trainer of trainers</span>
                            <?php }else{?>
                            <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1"
                                 /> <span>Trainer of trainers</span>
                            <?php }?>
                        </td>
                        <?php } else { ?>
                        <td>
                            <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1"
                                <?php echo $jobroles[0]["apply_for_assessor_status"] == 1 ? "checked" : ""; ?> />
                            <span>Assessor</span>
                        </td>

                        <td>
                            <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1"
                                <?php echo $jobroles[0]["apply_for_expert_status"] == 1 ? "checked" : ""; ?> />
                            <span>Expert</span>
                        </td>

                        <td>
                            <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1"
                                <?php echo $jobroles[0]["apply_for_trainer_of_trainer_status"] == 1 ? "checked" : ""; ?> />
                            <span>Trainer of trainers</span>
                        </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th colspan="3">Expart Type</th>
                    </tr>
                    <tr>
                        <?php if($jobroles[0]["apply_for_approve_reject_status"] != 1) {?>
                        <td>
                            <?php if($jobroles[0]["apply_for_expert"] == 1){?>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1"
                                <?php echo $jobroles[0]["expart_type_academic"] == 1 ? "checked": ""; ?>> Academic
                            Expert
                            <?php }else{?>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1"
                                disabled> Academic Expert<br>
                            <?php }?>
                        </td>

                        <td>
                            <?php if($jobroles[0]["apply_for_expert"] == 1){?>
                            <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial"
                                value="1" <?php echo $jobroles[0]["expart_type_industrial"] == 1 ? "checked": ""; ?>>
                            Industrial expert
                            <?php }else{?>
                            <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial"
                                value="1" disabled> Industrial expert
                            <?php }?>
                        </td>

                        <td></td>

                        <?php } else { ?>
                        <td>
                            <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1"
                                <?php echo $jobroles[0]["expart_type_academic_status"] == 1 ? "checked": ""; ?>>
                            Academic Expert
                        </td>

                        <td>
                            <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial"
                                value="1"
                                <?php echo $jobroles[0]["expart_type_industrial_status"] == 1 ? "checked": ""; ?>>
                            Industrial expert
                        </td>

                        <?php } ?>
                    </tr>
                </table>

            </div>
        </div>
        <?php if(!count($ssc_certificates)){  ?>
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title text-bold">SSC/ WBSCTVESD Certified</h4>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SSC/ WBSCTVESD certified assessor ?</th>
                            <th>Attended any TOA ?</th>
                            <th>TOA certificate</th>
                            <th>Status</th>
                            <?php 
                                if(($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == '') || (in_array($this->session->stake_id_fk, array(2, 5)))){
                                    echo'<th>Action</th>';
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="certifiedStatusRow">
                            <td><?php echo $ssc_wbsctvesd[0]['ssc_wbsctvesd_certified'] == '1' ? "Yes" : "No";?></td>
                            <td><?php echo $ssc_wbsctvesd[0]['attended_any_toa'] == '1' ? "Yes" : "No";?></td>
                            <td>
                                <?php if($ssc_wbsctvesd[0]['toa_certificate']!=''){?>
                                    <a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/ssc_wbsctvesd_certified/<?php echo md5($ssc_wbsctvesd[0]['assessor_registration_details_pk']); ?>">Download</a>
                                <?php } else { echo 'N/A'; } ?>
                            </td>

                            <td>
                                <?php 
                                    if($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == '') echo'N/A'; 
                                    elseif($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == 0) echo'Rejected';
                                    else echo'Accepted';
                                ?>
                            </td>

                            <?php if(($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == '') || (in_array($this->session->stake_id_fk, array(2, 5)))){ ?>
                                <td>
                                    <div class="radio text-success">
                                        <input id="radio1-<?php echo ++$i; ?>" name="ssc_wbsctvesd_status" type="radio" value="1" <?php echo ($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == 1) ? 'checked' : ''; ?>>
                                        <label for="radio1-<?php echo $i; ?>" class="radio-label">Accept</label>
                                    </div>

                                    <div class="radio text-danger">
                                        <input id="radio2-<?php echo ++$i; ?>" name="ssc_wbsctvesd_status" type="radio" value="0" <?php if($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == 0 && $ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] != '') echo'checked';?>>
                                        <label  for="radio2-<?php echo $i; ?>" class="radio-label">Reject</label>
                                    </div>
                                    <?php echo form_error('ssc_wbsctvesd_status'); ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?> 

        <?php if(count($ssc_certificates)){  ?>
        <h4></h4>
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title text-bold">SSC/ WBSCTVESD Certified</h4>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Are you a SSC/ WBSCTVESD certified assessor?</th>
                            <th>Have you attended any TOA ?</th>
                            <th>Certificate validity</th>
                            <th>Download</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; foreach($ssc_certificates as $certificate) { ?>
                        <tr>
                            <td><?php echo $i ;?></td>
                            <td><?php echo $certificate['course_name']  ?> (<?php echo $certificate['course_code']; ?>)
                            </td>
                            <td><?php echo $certificate['ssc_wbsctvesd_certified'] == 1 ? "Yes" : "No";  ?></td>
                            <td><?php echo $certificate['attended_any_toa'] == 1 ? "Yes" : "No";  ?></td>
                            <td><?php echo $certificate['cf_validity'] ?></td>
                            <td>
                                <?php
                                if($certificate['attended_any_toa'] == 1){
                                    ?><a
                                    href="council/job_role_app/download_ssc_cf_pdf/<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>">Download</a><?php 
                                } else {
                                    ?>NA<?php
                                }
                            ?>


                            </td>
                            <?php if($this->session->stake_id_fk == 4){  ?>
                            <?php if($jobroles[0]["apply_for_approve_reject_status"] != 1) {?>
                            <td>
                                <input
                                    name="cf[<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>]"
                                    type="radio" value="5" <?php echo set_radio("cf[".$certificate['council_ssc_wbsctvesd_certified_map_id_pk']."]",5) ?>>
                                <label class="radio-label">Accept</label>
                                <br>
                                <input
                                    name="cf[<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>]"
                                    type="radio" value="6" <?php echo set_radio("cf[".$certificate['council_ssc_wbsctvesd_certified_map_id_pk']."]",6) ?>>
                                <label class="radio-label">Reject</label>
                                <?php echo form_error('cf['.$certificate['council_ssc_wbsctvesd_certified_map_id_pk'].']'); ?>
                            </td>
                            
                            <?php } else { ?>
                                <td>
                                    <?php echo $certificate["process_status_id_fk"] == 5 ? "Approved" : "Rejected"; ?>
                                </td>
                            <?php } ?>
                            <?php } elseif($this->session->stake_id_fk == 5 || $this->session->stake_id_fk == 2) { ?>
                                <?php if($this->input->method(TRUE) == "POST"){ ?>
                                    <?php if($jobroles[0]["apply_for_approve_reject_status"] == 1) {?>
                                    <td>
                                        <input
                                            name="cf[<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>]"
                                            type="radio" value="5" <?php echo set_radio("cf[".$certificate['council_ssc_wbsctvesd_certified_map_id_pk']."]",5) ?>>
                                        <label class="radio-label">Accept</label>
                                        <br>
                                        <input
                                            name="cf[<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>]"
                                            type="radio" value="6" <?php echo set_radio("cf[".$certificate['council_ssc_wbsctvesd_certified_map_id_pk']."]",6) ?>>
                                        <label class="radio-label">Reject</label>
                                        <?php echo form_error('cf['.$certificate['council_ssc_wbsctvesd_certified_map_id_pk'].']'); ?>
                                    </td>
                                    
                                    <?php } else { ?>
                                        <td>
                                            <?php echo $certificate["process_status_id_fk"] == 5 ? "Approved" : "Rejected"; ?>
                                        </td>
                                    <?php } ?>
                                <?php } else { ?>

                                    <?php if($jobroles[0]["apply_for_approve_reject_status"] == 1) {?>
                                    <td>
                                        <input
                                            name="cf[<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>]"
                                            type="radio" value="5" <?php echo $certificate['process_status_id_fk'] == 5 ? "checked" : ""; ?>>
                                        <label class="radio-label">Accept</label>
                                        <br>
                                        <input
                                            name="cf[<?php echo $certificate['council_ssc_wbsctvesd_certified_map_id_pk']; ?>]"
                                            type="radio" value="6" <?php echo $certificate['process_status_id_fk'] == 6 ? "checked" : ""; ?>>
                                        <label class="radio-label">Reject</label>
                                        <?php echo form_error('cf['.$certificate['council_ssc_wbsctvesd_certified_map_id_pk'].']'); ?>
                                    </td>
                                    
                                    <?php } else { ?>
                                        <td>
                                            <?php echo $certificate["process_status_id_fk"] == 5 ? "Approved" : "Rejected"; ?>
                                        </td>
                                    <?php } ?>
                                <?php } ?>

                            <?php } ?>


                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>
        <?php if($this->session->stake_id_fk == 5 || $this->session->stake_id_fk == 2){  ?>
        <div class="box box-danger">
            <div class="box-header with-border">
                <h4 class="box-title text-bold">Accept or Reject this application</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="app_approve_reject">Accept/Reject</label>
                        <select name="app_approve_reject" id="app_approve_reject"  class="form-control">
                            <option value="">-- Select Approve / Reject --</option>
                            <option value="5" <?php echo set_select("app_approve_reject",5) ?>>Approve</option>
                            <option value="6" <?php echo set_select("app_approve_reject",6) ?>>Reject</option>
                        </select>
                        <?php echo form_error('app_approve_reject'); ?>
                    </div> 
                    <?php if($this->input->method(TRUE) == "POST"){ ?>
                        <?php if($this->input->post("app_approve_reject") == 5){ ?>
                        <div class="col-md-8 reject_area" style="display:none">
                        <label for="reject_reqason">Reject reason</label>
                            <input type="text" name="reject_reqason" id="reject_reqason" class="form-control" placeholder="Reject reason" >
                            <?php echo form_error('reject_reqason'); ?>
                            
                        </div>
                        <?php } else { ?>
                            <div class="col-md-8 reject_area" style="display:block">
                            <label for="reject_reqason">Reject reason</label>
                                <input type="text" name="reject_reqason" id="reject_reqason" class="form-control" placeholder="Reject reason" >
                                <?php echo form_error('reject_reqason'); ?>
                                
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="col-md-8 reject_area" style="display:none">
                        <label for="reject_reqason">Reject reason</label>
                            <input type="text" name="reject_reqason" id="reject_reqason" class="form-control" placeholder="Reject reason" >
                            <?php echo form_error('reject_reqason'); ?>
                            
                        </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
        <?php } ?>
        <?php if($this->session->stake_id_fk == 4) {?>
        <?php if($jobroles[0]["apply_for_approve_reject_status"] != 1) {?>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
        <?php } ?>
        <?php } ?>

        <?php if($this->session->stake_id_fk == 5 || $this->session->stake_id_fk == 2) {?>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
        <?php } ?>


        <br>
        <br>
        <br>
        <br>

        </form>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>