<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<!-- Content Wrapper. Contains page content -->
<style>
.btn-space {
    margin-right: 5px;
}

.blink {
    animation: blinker 1s step-start infinite;
}

@keyframes blinker {
    50% {
        opacity: 0;
    }
}

.btn-border {
    border: 1px solid #000;
}
</style>


<!-- For disabled on final submit -->
<?php if ($app_data['final_save_status'] == 1) { 
    $disabled = "disabled";
} else {
    $disabled = NULL;
}
?>
<!-- For disabled on final submit -->

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Registration Form</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Details View</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/' . uri_string(), array('id' => 'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Qualification Details</h3>
            </div>
            <div class="box-body">

                <?php if (isset($status)) { ?>
                <div class="alert alert-<?php echo $status == TRUE ? 'success' : 'danger'; ?>">
                    <strong>Success!</strong> <?php echo $message; ?>.
                </div>
                <?php } ?>

                <?php
                if ($this->session->flashdata('alert_msg')) {
                ?>
                <div class="alert alert-success">
                    <p><?php echo $this->session->flashdata('alert_msg'); ?></p>
                </div>
                <?php
                }
                ?>

                <?php $this->load->view($this->config->item('theme') . 'student_profile/menu_view'); ?>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>

                <?php if($entrance == 0) {?>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="" for="board_id">Choose Eligibility Criteria <span
                                class="text-danger">*</span></label>

                        <?php foreach ($eligible_criteria as $key => $value) {?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="eligible_criteria" id="eligible_criteria_<?php echo $value['eligibility_criteria_id_pk']?>"
                                    value="<?php echo $value['eligibility_criteria_id_pk']?>" <?php echo ($formData['eligible_criteria'] == $value['eligibility_criteria_id_pk']) ?'checked' :'';?>>
                                <label class="form-check-label" for="eligible_criteria_<?php echo $value['eligibility_criteria_id_pk']?>">
                                    <?php echo $value['eligibility_name']; ?>
                                </label>
                            </div>
                        <?php } ?>
                        <?php echo form_error('eligible_criteria'); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="" for="marksheet_doc">
                            Upload Marksheet
                            <span class="text-danger">*</span>
                            <!-- <br> -->
                            <small>(.PDF only, Max 200KB)</small>
                        </label>

                        <?php if($app_data['marksheet_doc'] !='') {?>

                        <small><a target="_blank"href="student_profile/std_registration/download_marksheet_doc/<?php echo md5($app_data['institute_student_details_id_pk']); ?>" class="btn btn-sm btn-primary"><i class="fa fa-download" style="font-size:18px"> </i></a></small>
                        <?php } ?>
                            
                            

                        <!-- <small>(.PDF only, Max 100KB) &nbsp; &nbsp; <i class="fa fa-download" style="font-size:24px"> 
                            </small> -->
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-success">
                                    Browse&hellip;<input type="file" style="display: none;" name="marksheet_doc" id="marksheet_doc">
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <?php echo form_error('marksheet_doc'); ?>
                    </div> 
                </div>

                <?php }else{ ?>
                <!--  <h4>Particulars of the last Examination Passed</h4> -->
                <h5>
                    <?php 
                            if($app_data['exam_type_id_fk'] == 3)
                            {
                               
                                echo'<div class="clearfix"></div>
                                <br>


                                <h4 style="margin-left:30px"> <b>Examination Qualified - Class 12/Higher Secondary </b></h4>
                                <hr>';
                            }
                            elseif($app_data['exam_type_id_fk'] == 1){
                                echo '<h4 style="margin-left:30px"> <b>Examination Qualified - Class 10 / Madhyamik/Equivalent Examination</b></h4>';
                            }elseif($app_data['exam_type_id_fk'] == 2){
                                echo '<h4 style="margin-left:30px"> <b>Examination Qualified - Class 12/Higher Secondary/Higher Secondary (Vocational)/Equivalent Examination/ITI (2 years continuous)</b></h4>';
                            }
                        ?>
                </h5>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="board_id">Select Board name <span class="text-danger">*</span></label>
                            <select class="form-control" name="board_id" id="board_id">
                                <option value="" hidden="true">Select Board name</option>
                                <?php foreach ($board_name as $value) { ?>
                                <option value="<?php echo $value['board_id_pk']?>"
                                    <?php if($formData['board_id'] == $value['board_id_pk']){echo 'selected';}?>>
                                    <?php echo $value['board_name']?></option>
                                <?php }?>



                            </select>
                            <?php echo form_error('board_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="institute_name">Name of the Last Institute <span
                                    class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="text" class="form-control" id="institute_name" name="institute_name"
                                value="<?php echo $app_data['institute_name']; ?>" placeholder="Institute Name"
                                step=".01" />
                            <?php } else { ?>
                            <input type="text" class="form-control" id="institute_name" name="institute_name"
                                value="<?php echo set_value('institute_name') ?>" placeholder="Institute Name"
                                step=".01" />
                            <?php } ?>



                            <?php echo form_error('institute_name'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="passing_year">Year of Passing <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="number" class="form-control" id="passing_year" name="passing_year"
                                value="<?php echo $app_data['year_of_passing']; ?>" placeholder="Passing Year"
                                step=".01" />
                            <?php } else { ?>
                            <input type="number" class="form-control" id="passing_year" name="passing_year"
                                value="<?php echo set_value('passing_year') ?>" placeholder="Passing Year" step=".01" />
                            <?php } ?>



                            <?php echo form_error('passing_year'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <input type="hidden" id="exam_type_id" value="<?php echo $app_data['exam_type_id_fk'];?>">

                    <h5>
                        <?php 
                            if($app_data['exam_type_id_fk'] == 3)
                            {
                               
                                echo'<div class="clearfix"></div>
                                <br>


                                <h4 style="margin-left:30px"> <b>Examination Qualified - Class 12/Higher Secondary in Science Stream</b></h4>
                                <hr>';
                            }
                            elseif($app_data['exam_type_id_fk'] == 1){
                                echo '<h4 style="margin-left:30px"> <b>Examination Qualified - Class 10 / Madhyamik/Equivalent Examination</b></h4>';
                            }elseif($app_data['exam_type_id_fk'] == 2){
                                echo '<h4 style="margin-left:30px"> <b>Examination Qualified - Class 12/Higher Secondary/Higher Secondary (Vocational)/Equivalent Examination/ITI (2 years continuous)</b></h4>';
                            }
                        ?>
                    </h5>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fullmark">Total Aggregate Marks <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="number" class="form-control" id="fullmark" name="fullmark"
                                value="<?php echo $app_data['fullmarks']; ?>" placeholder="Full Marks" />
                            <?php } else { ?>
                            <input type="number" class="form-control" id="fullmark" name="fullmark"
                                value="<?php echo set_value('fullmark') ?>" placeholder="Full Marks" />
                            <?php } ?>



                            <?php echo form_error('fullmark'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mark_obtain">Marks Obtained <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="number" class="form-control" id="marks_obtain" name="marks_obtain"
                                value="<?php echo $app_data['marks_obtain']; ?>" placeholder="Marks Obtain" />
                            <?php } else { ?>
                            <input type="number" class="form-control" id="marks_obtain" name="marks_obtain"
                                value="<?php echo set_value('marks_obtain') ?>" placeholder="Marks Obtain" />
                            <?php } ?>



                            <?php echo form_error('marks_obtain'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="percentage">Percentage % <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="number" class="form-control" id="percentage" name="percentage"
                                value="<?php echo $app_data['percentage']; ?>" placeholder="Percentage" readonly />
                            <?php } else { ?>
                            <input type="number" class="form-control" id="percentage" name="percentage"
                                value="<?php echo set_value('percentage') ?>" placeholder="Percentage" readonly />
                            <?php } ?>
                            <?php echo form_error('percentage'); ?>
                        </div>
                    </div>



                </div>
                <div class="row"
                    <?php if($app_data['exam_type_id_fk'] == 3) {echo 'style="display: block;"';} else{echo 'style="display: none;"';}?>>
                    <!--div class="col-md-3">
                        <div class="form-group">
                            <label for="c_g_p_a">C.G.P.A <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                <input type="number" class="form-control" id="c_g_p_a" name="c_g_p_a" value="<?php echo $app_data['cgpa']; ?>" placeholder="C G P A" step=".01" />
                            <?php } else { ?>
                                <input type="number" class="form-control" id="c_g_p_a" name="c_g_p_a" value="<?php echo set_value('c_g_p_a') ?>" placeholder="C G P A" step=".01" />
                            <?php } ?>

                            <?php echo form_error('c_g_p_a'); ?>
                        </div>
                    </div-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullmark">Marks of Physics<span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="number" class="form-control" id="phy_marks" name="phy_marks"
                                value="<?php echo $app_data['phy_marks']; ?>" placeholder="Marks of Physics"
                                step=".01" />
                            <?php } else { ?>
                            <input type="number" class="form-control" id="phy_marks" name="phy_marks"
                                value="<?php echo set_value('phy_marks') ?>" placeholder="Marks of Physics"
                                step=".01" />
                            <?php } ?>



                            <?php echo form_error('phy_marks'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="chem_marks">Marks of Chemistry <span class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="number" class="form-control" id="chem_marks" name="chem_marks"
                                value="<?php echo $app_data['chem_marks']; ?>" placeholder="Marks of Chemistry"
                                step=".01" />
                            <?php } else { ?>
                            <input type="number" class="form-control" id="chem_marks" name="chem_marks"
                                value="<?php echo set_value('chem_marks') ?>" placeholder="Marks of Chemistry"
                                step=".01" />
                            <?php } ?>


                            <?php echo form_error('chem_marks'); ?>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="math_bio_marks">Marks of Biology /Mathematics <span
                                    class="text-danger">*</span></label>

                            <?php if ($this->input->method(TRUE) == 'GET') { ?>
                            <input type="number" class="form-control" id="math_bio_marks" name="math_bio_marks"
                                value="<?php echo $app_data['math_bio_marks']; ?>"
                                placeholder="Marks of Biology /Mathematics" step=".01" />
                            <?php } else { ?>
                            <input type="number" class="form-control" id="math_bio_marks" name="math_bio_marks"
                                value="<?php echo set_value('math_bio_marks') ?>"
                                placeholder="Marks of or Biology /Mathematics" step=".01" />
                            <?php } ?>



                            <?php echo form_error('math_bio_marks'); ?>
                        </div>
                    </div>

                </div>


                <?php } ?>



                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="student_profile/std_registration/photo_signature"
                        class="btn btn-primary btn-space confirm_pre">
                        < Previous</a>
                            <a href="student_profile/std_registration/final_submit"
                                class="btn btn-primary btn-space confirm_next">Next >
                            </a>
                </div>

                <div class="btn-group blink_text" style="display:none;">
                    <label>&nbsp;</label><br>
                    <?php if($app_data['exam_type_id_fk'] == 1){?>
                    <span class="btn-border pull-right blink text-danger">***candidate is considered to be fail*</span>
                    <?php }else{?>
                    <span class="btn-border pull-right blink text-danger">***candidate is considered to be fail*</span>
                    <?php }?>
                </div>
                <?php if ($app_data['final_save_status'] != 1) { ?>
                <button type="submit" class="btn btn-primary pull-right edu_save_btn">Save</button>
                <?php } 
                ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>


    </section>
    <?php //$this->load->view($this->config->item('theme_uri').'assessor_profile/terms_condition_view'); 
    ?>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>