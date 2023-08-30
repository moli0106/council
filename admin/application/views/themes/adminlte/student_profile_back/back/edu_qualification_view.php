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
            <li class="active"><i class="fa fa-align-center"></i> Student Details View</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Basic Details</h3>
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


                <h4>Particulars of the last Examination Passed</h4>
                <hr>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fullmark">Full Marks <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="fullmark" name="fullmark" value="<?php echo $app_data['fullmarks']; ?>" placeholder="Full Marks" />
                            <?php } else {?>
                                <input type="number" class="form-control" id="fullmark" name="fullmark" value="<?php echo set_value('fullmark') ?>" placeholder="Full Marks" />
                            <?php }?>

                            

                            <?php echo form_error('fullmark'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="mark_obtain">Marks Obtained <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="marks_obtain" name="marks_obtain" value="<?php echo $app_data['marks_obtain']; ?>" placeholder="Marks Obtain" />
                            <?php } else {?>
                                <input type="number" class="form-control" id="marks_obtain" name="marks_obtain" value="<?php echo set_value('marks_obtain') ?>" placeholder="Marks Obtain" />
                            <?php }?>
                            
                            

                            <?php echo form_error('marks_obtain'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="percentage">Percentage % <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="percentage" name="percentage" value="<?php echo $app_data['percentage']; ?>" placeholder="Percentage" readonly/>
                            <?php } else {?>
                                <input type="number" class="form-control" id="percentage" name="percentage" value="<?php echo set_value('percentage') ?>" placeholder="Percentage" readonly/>
                            <?php }?>

                           

                            <?php echo form_error('percentage'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="c_g_p_a">C.G.P.A <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="c_g_p_a" name="c_g_p_a" value="<?php echo $app_data['c_g_p_a']; ?>" placeholder="C G P A" step=".01" />
                            <?php } else {?>
                                <input type="number" class="form-control" id="c_g_p_a" name="c_g_p_a" value="<?php echo set_value('c_g_p_a') ?>" placeholder="C G P A" step=".01" />
                            <?php }?>

                            

                            <?php echo form_error('c_g_p_a'); ?>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullmark">Percentage of Marks (3rd yr (Diploma) / Physics /
                                Mathematics / English) <span class="text-danger">*</span></label>

                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="p_o_m1" name="p_o_m1" value="<?php echo $app_data['thirdyr_or_physics_or_math_result']; ?>" placeholder="Percentage of marks (3rd yr Diploma / Physics / Mathematics / English)" step=".01"/>
                            <?php } else {?>
                                <input type="number" class="form-control" id="p_o_m1" name="p_o_m1" value="<?php echo set_value('p_o_m1') ?>" placeholder="Percentage of marks (3rd yr Diploma / Physics / Mathematics / English)"  step=".01" />
                            <?php }?>

                            

                            <?php echo form_error('p_o_m1'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fullmark">Percentage of Marks (2nd yr (Diploma) / Chemistry /
                                Physics or Science) <span class="text-danger">*</span></label>

                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="p_o_m2" name="p_o_m2" value="<?php echo $app_data['secondyear_or_chemistry_or_physicalscience_or_science_result']; ?>" placeholder="Percentage of marks (2nd yr / Chemistry / Physics / Science)" step=".01"/>
                            <?php } else {?>
                                <input type="number" class="form-control" id="p_o_m2" name="p_o_m2" value="<?php echo set_value('p_o_m2') ?>" placeholder="Percentage of marks (2nd yr / Chemistry / Physics / Science)"  step=".01" />
                            <?php }?>


                            <?php echo form_error('p_o_m2'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="percentage">Percentage of Marks (1st yr (Diploma) / English(H.S)
                                / Life Science or Biology /
                                Mathematics) <span class="text-danger">*</span></label>

                                <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="p_o_m3" name="p_o_m3" value="<?php echo $app_data['firstyear_or_hs_english_or_lifescience_result']; ?>" placeholder="Percentage of Marks (1st yr / English(H.S) / Life Science or Science / Mathematics)" step=".01"/>
                            <?php } else {?>
                                <input type="number" class="form-control" id="p_o_m3" name="p_o_m3" value="<?php echo set_value('p_o_m3') ?>" placeholder="Percentage of Marks (1st yr / English(H.S) / Life Science or Science / Mathematics)"  step=".01" />
                            <?php }?>

                           

                            <?php echo form_error('p_o_m3'); ?>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="institute_name">Name of the Last Institute <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="institute_name" name="institute_name" value="<?php echo $app_data['institute_name']; ?>" placeholder="Institute Name" step=".01"/>
                            <?php } else {?>
                                <input type="number" class="form-control" id="institute_name" name="institute_name" value="<?php echo set_value('institute_name') ?>" placeholder="Institute Name"  step=".01" />
                            <?php }?>

                            

                            <?php echo form_error('institute_name'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="passing_year">Year of Passing <span class="text-danger">*</span></label>

                            <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                <input type="number" class="form-control" id="passing_year" name="passing_year" value="<?php echo $app_data['year_of_passing']; ?>" placeholder="Passing Year" step=".01"/>
                            <?php } else {?>
                                <input type="number" class="form-control" id="passing_year" name="passing_year" value="<?php echo set_value('passing_year') ?>" placeholder="Passing Year"  step=".01" />
                            <?php }?>

                            

                            <?php echo form_error('passing_year'); ?>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/course" class="btn btn-primary btn-space">Next >
                    </a>
                </div>
                <?php // if($app_data[0]['final_flag'] != 't'){ ?>
                <!-- <button type="submit" class="btn btn-primary pull-right">Save</button> -->
                <?php //} ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>


    </section>
    <?php //$this->load->view($this->config->item('theme_uri').'assessor_profile/terms_condition_view'); ?>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>