<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessor Course List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Assessor Course List</li>
        </ol>
    </section>

    <section class="content">
        
        <?php if(isset($success)){ ?>
            <div class="alert alert-<?php echo $success ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <?php echo form_open('admin/'. uri_string(), array('id'=>'assessor_course_details')); ?>
            <input type="hidden" id="assessor_id_hash" value="<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>"/>
            
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
                                <?php if($jobroles[0]['process_status_id_fk'] == NULL){?>
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
                                    <td><?php echo $jobrole['job_role_sp_quali'] == NULL ? "Not provided" : $jobrole['job_role_sp_quali']; ?></td>
                                    <td><?php echo $jobrole['process_status_id_fk'] == NULL ? "NA" : $jobrole['process_name']; ?></td>
                                    <?php if($jobrole['process_status_id_fk'] == NULL){?>
                                        <td>
                                            <!-- <a href="<?php echo md5($jobrole['assessor_registration_jobrole_sector_map_id_pk']) ?>" class="btn btn-xs btn-success approve_assessor_course" data-toggle="modal" data-target="#myModal">Accept</a> -->

                                            <!-- <a href="<?php echo md5($jobrole['assessor_registration_jobrole_sector_map_id_pk']) ?>" class="btn btn-danger btn-xs reject_assessor_course" data-toggle="modal" data-target="#myModal">Reject</a> -->

                                            <div class="radio text-success">
                                                <input id="radio1-<?php echo $i; ?>" name="radio[<?php echo md5($jobrole['assessor_registration_jobrole_sector_map_id_pk']); ?>]" type="radio" value="5">
                                                <label for="radio1-<?php echo $i; ?>" class="radio-label">Accept</label>
                                            </div>

                                            <div class="radio text-danger">
                                                <input id="radio2-<?php echo $i; ?>" name="radio[<?php echo md5($jobrole['assessor_registration_jobrole_sector_map_id_pk']); ?>]" type="radio" value="6">
                                                <label  for="radio2-<?php echo $i; ?>" class="radio-label">Reject</label>
                                            </div>

                                        </td>
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
                                        <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" <?php echo $jobroles[0]["apply_for_assessor"] == 1 ? "checked" : ""; ?> />  <span>Assessor</span>
                                    <?php }else{?>
                                        <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" disabled />  <span>Assessor</span>
                                    <?php }?>
                                </td>

                                <td>
                                    <?php if($jobroles[0]["apply_for_expert"] == 1){?>
                                        <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" <?php echo $jobroles[0]["apply_for_expert"] == 1 ? "checked" : ""; ?> />  <span>Expert</span>
                                    <?php }else{?>
                                        <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" disabled/>  <span>Expert</span>
                                    <?php }?>
                                </td>

                                <td>
                                    <?php if($jobroles[0]["apply_for_trainer_of_trainer"] == 1){?>
                                        <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" <?php echo $jobroles[0]["apply_for_trainer_of_trainer"] == 1 ? "checked" : ""; ?> />  <span>Trainer of trainers</span>
                                    <?php }else{?>
                                        <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" disabled/>  <span>Trainer of trainers</span>
                                    <?php }?>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" <?php echo $jobroles[0]["apply_for_assessor_status"] == 1 ? "checked" : ""; ?> />  <span>Assessor</span>
                                </td>
                
                                <td>
                                    <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" <?php echo $jobroles[0]["apply_for_expert_status"] == 1 ? "checked" : ""; ?> />  <span>Expert</span>
                                </td>

                                <td>
                                    <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" <?php echo $jobroles[0]["apply_for_trainer_of_trainer_status"] == 1 ? "checked" : ""; ?> />  <span>Trainer of trainers</span>
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
                                        <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" <?php echo $jobroles[0]["expart_type_academic"] == 1 ? "checked": ""; ?>> Academic Expert
                                    <?php }else{?>
                                        <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" disabled> Academic Expert<br>
                                    <?php }?>
                                </td>

                                <td>
                                    <?php if($jobroles[0]["apply_for_expert"] == 1){?>
                                        <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" <?php echo $jobroles[0]["expart_type_industrial"] == 1 ? "checked": ""; ?>> Industrial expert
                                    <?php }else{?>
                                        <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" disabled> Industrial expert
                                    <?php }?>
                                </td>

                                <td></td>

                            <?php } else { ?>
                                <td>
                                    <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" <?php echo $jobroles[0]["expart_type_academic_status"] == 1 ? "checked": ""; ?>> Academic Expert
                                </td>
                
                                <td>
                                    <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" <?php echo $jobroles[0]["expart_type_industrial_status"] == 1 ? "checked": ""; ?>> Industrial expert
                                </td>
    
                            <?php } ?>
                        </tr>
                    </table>
                    
                </div>
            </div>

            <?php if($assessor[0]['ssc_wbsctvesd_certified'] == 1) { ?>
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
                                        if($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == ''){
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

                                    <?php if($ssc_wbsctvesd[0]['ssc_wbsctvesd_status'] == ''){ ?>
                                        <td>
                                            <div class="radio text-success">
                                                <input id="radio1-<?php echo ++$i; ?>" name="ssc_wbsctvesd_status" type="radio" value="1">
                                                <label for="radio1-<?php echo $i; ?>" class="radio-label">Accept</label>
                                            </div>

                                            <div class="radio text-danger">
                                                <input id="radio2-<?php echo ++$i; ?>" name="ssc_wbsctvesd_status" type="radio" value="0">
                                                <label  for="radio2-<?php echo $i; ?>" class="radio-label">Reject</label>
                                            </div>
                                        </td>
                                    <?php } ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } else{ echo '<input id="ssc-404" type="hidden" value="404">';} ?>

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php if($assessor[0]['process_status_id_fk'] == 2) { ?>
                        <button type="button" class="btn btn-info btn-block update-Information">Submit</button>
                    <?php }?>
                </div>
            </div>

        <?php echo form_close(); ?>
        
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>