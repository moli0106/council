<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

<div class="content-wrapper">
    <section class="content-header">
        <h1>Course List</h1>
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
    <input type="hidden" name="assessor_id_hash" value="<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>"/>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor Course List</h3><br>
                Full Name: <b><?php echo $assessor[0]['salutation_desc'] ?> <?php echo $assessor[0]['fname'] ?> <?php echo $assessor[0]['mname'] ?> <?php echo $assessor[0]['lname'] ?></b><br>
            Mobile No: <b><?php echo $assessor[0]['mobile_no'] ?><b><br>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
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
                            <th style="width: 14%;">Action</th>
                            <?php }?>

                       </tr>
                   </thead>
                   <tbody>
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
                            <a alt="<?php //echo $offset ?>" href="<?php echo md5($jobrole['assessor_registration_jobrole_sector_map_id_pk']) ?>" class="btn btn-xs btn-success approve_assessor_course" data-toggle="modal" data-target="#myModal">Accept</a>

                            <a alt="<?php //echo $offset ?>" href="<?php echo md5($jobrole['assessor_registration_jobrole_sector_map_id_pk']) ?>" class="btn btn-danger btn-xs reject_assessor_course" data-toggle="modal" data-target="#myModal">Reject</a>
                            </td>
                            <?php }?>
                        </tr>
                        <?php $i++; } ?>
                   </tbody>
               </table>
            </div>
            <div class="box-body">
                <div class="col-md-5">
                    <h4>Applying for?</h4>
                    <?php if($jobroles[0]["apply_for_approve_reject_status"] != 1) {?>
                    <?php if($jobroles[0]["apply_for_assessor"] == 1){?>
                    <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" <?php echo $jobroles[0]["apply_for_assessor"] == 1 ? "checked" : ""; ?> />  <span>Assessor</span> <br>
                    <?php }else{?>
                    <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" disabled />  <span>Assessor</span> <br>
                    <?php }?>

                    <?php if($jobroles[0]["apply_for_expert"] == 1){?>
                    <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" <?php echo $jobroles[0]["apply_for_expert"] == 1 ? "checked" : ""; ?> />  <span>Expert</span><br>
                    <?php }else{?>
                    <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" disabled/>  <span>Expert</span><br>
                    <?php }?>

                    <?php if($jobroles[0]["apply_for_trainer_of_trainer"] == 1){?>
                        <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" <?php echo $jobroles[0]["apply_for_trainer_of_trainer"] == 1 ? "checked" : ""; ?> />  <span>Trainer of trainers</span><br>
                    <?php }else{?>
                    <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" disabled/>  <span>Trainer of trainers</span><br>
                    <?php }?>
                    <?php } else{?>
                       
                    <input type="checkbox" class="apply_for_assessor" name="apply_for_assessor" value="1" <?php echo $jobroles[0]["apply_for_assessor_status"] == 1 ? "checked" : ""; ?> />  <span>Assessor</span> <br>
                    
                    <input type="checkbox" class="apply_for_expert" name="apply_for_expert" value="1" <?php echo $jobroles[0]["apply_for_expert_status"] == 1 ? "checked" : ""; ?> />  <span>Expert</span><br>

                    <input type="checkbox" class="trainer_of_trainers" name="trainer_of_trainers" value="1" <?php echo $jobroles[0]["apply_for_trainer_of_trainer_status"] == 1 ? "checked" : ""; ?> />  <span>Trainer of trainers</span><br>

                    <?php }?>

                </div>

                <div class="col-md-5">
                    <h4>Expart Type</h4>
                    <?php if($jobroles[0]["apply_for_approve_reject_status"] != 1) {?>
                    
                    <?php if($jobroles[0]["apply_for_trainer_of_trainer"] == 1){?>
                        <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" <?php echo $jobroles[0]["expart_type_academic"] == 1 ? "checked": ""; ?>> Academic Expert<br>
                    <?php }else{?>
                        <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" disabled> Academic Expert<br>
                    <?php }?>

                    <?php if($jobroles[0]["apply_for_trainer_of_trainer"] == 1){?>
                        <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" <?php echo $jobroles[0]["expart_type_industrial"] == 1 ? "checked": ""; ?>> Industrial expert<br>
                    <?php }else{?>
                        <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" disabled> Industrial expert<br>
                    <?php }?>

                    <?php }else{?>

                        <input type="checkbox" class="expart_type_academic" name="expart_type_academic" value="1" <?php echo $jobroles[0]["expart_type_academic_status"] == 1 ? "checked": ""; ?>> Academic Expert<br>
                    
                        <input type="checkbox" class="expart_type_industrial" name="expart_type_industrial" value="1" <?php echo $jobroles[0]["expart_type_industrial_status"] == 1 ? "checked": ""; ?>> Industrial expert<br>
                    
                    <?php }?>
                </div>
                <?php if($jobroles[0]["apply_for_approve_reject_status"] != 1){?>
                <div class="col-md-1">
                <h4>&nbsp;</h4>
                    <!-- <button type="submit" class="btn btn-xs btn-success pull-right">Accept</button> -->
                    <input type="button" name="btn" value="Accept" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-xs btn-success pull-right" />

                </div>
                <?php }?>
            </div>
            <div class="box-footer">
               
               
               
            </div>

        </div>
        <?php echo form_close(); ?>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to submit the following details?

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="submit" class="btn btn-success success remove_btn_no">Submit</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>