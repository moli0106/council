<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<!-- Content Wrapper. Contains page content -->
<style>
    .wrapper {
        overflow-x: auto;
        overflow-y: hidden;
    }

    .modal-header {
        background-color: #4ccaca;
    }

    .modal-footer {
        background-color: #4ccaca;
    }

    .btn-space {
        margin-right: 5px;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Student Registration Form
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> Student Registration Form</li>
            <li class="active"><i class="fa fa-envelope-o"></i> Final Submit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Final Submit</h3>
            </div>


            <?php echo form_open('admin/' . uri_string(), array('autocomplete' => 'off')); ?>
            <input type="hidden" name="final_token" value="<?php echo $this->session->final_token; ?>" />
            <div class="box-body box-profile">

                <?php if (isset($update_code)) { ?>
                    <?php if ($update_code == 1) { ?>
                        <div class="alert alert-success text-center">
                            <?php echo $update_success ?>
                        </div>
                    <?php } else if ($update_code == 0) { ?>
                        <div class="alert alert-warning text-center">
                            <?php echo $update_success ?>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php $this->load->view($this->config->item('theme') . 'student_profile/menu_view'); ?>
                <br>

                <div class="clearfix"></div>

                <!--timeline start -->
                <?php
                if ($this->session->flashdata('alert_msg')) {
                ?>
                    <div class="alert alert-warning">
                        <p><?php echo $this->session->flashdata('alert_msg'); ?></p>
                    </div>
                <?php
                }
                ?>
                   

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">
                                Profile Submission Status
                                
                            </span>
                        </li>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->

                        <?php  //  echo '<pre>'; print_r($app_data); die;  ?>

                        <li>
                            <!-- <i class="fa <?php echo $app_data['institute_d_save_status'] == '1' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i> -->
                            <i class="fa fa-check bg-green"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="student_profile/std_registration/index">Institute Details</a></h3>
                            </div>
                        </li>

                        <li>
                            <i class="fa <?php echo $app_data['basic_d_save_status'] == '1' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="student_profile/std_registration/basic_details">Basic Details</a></h3>
                            </div>
                        </li>
                        <li>
                            <i class="fa <?php echo $app_data['photo_sign_save_status'] == '1' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="student_profile/std_registration/photo_signature">Photo Sign Upload</a></h3>
                                <!-- <span class="label label-warning" style="color:#F00; font-size:12px;">(At least one course is mandatory for each Assessor for Final Submit.)</span> -->
                            </div>
                        </li>
                        <li>
                            <i class="fa <?php echo $app_data['qualification_d_save_status'] == '1' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="student_profile/std_registration/edu_qualification">Educational Qualification</a></h3>
                            </div>
                        </li>
						
						<li>
                            <i class="fa <?php echo $reg_fee_status == 1 ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a target="_blank" href="student_profile/student_payment_type">Pay Registration Fee</a></h3>
                            </div>
                        </li>
                       
                       
                        <li>
                            <i class="fa <?php echo $app_data['final_save_status'] == '1' ? 'fa-check bg-green' : 'fa-close bg-red'; ?>"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="student_profile/std_registration/final_submit">Final Submit</a></h3>
								<span class="label label-warning" style="color:#F00; font-size:12px;">(Please Pay Registration Fee Before Final Submit.)</span>
							
                            </div>
                        </li>
                        <!-- END timeline item -->
                    </ul>

                    <!--timeline end -->
                </div>


                <br>



                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">


                    <?php if ($app_data['final_save_status'] == '' || $app_data['final_save_status'] == 0) { ?>
                        <?php if ($app_data['basic_d_save_status'] == 1 && $app_data['photo_sign_save_status'] == 1 && $app_data['qualification_d_save_status'] == 1 && $reg_fee_status == 1) { ?>
                            <a href="javascript:void(0)" id="<?php echo md5($this->session->userdata('stake_details_id_fk')) ?>" rel="<?php echo md5($this->session->userdata('stake_details_id_fk')) ?>" class="btn btn-primary pull-right confirm_final_submit" data-toggle="modal" data-target="#confirmFinalsubmit">Final Submit</a>
                            <a href="student_profile/std_registration/preview_details" class="btn btn-primary pull-right btn-space" target="_blank">Application Preview</a>
                            <!-- <button type="submit" class="btn btn-primary pull-right">Submit</button> -->
                    <?php }
                    } ?>
                    <?php if ($app_data['final_save_status'] == 1) { ?>
                        <a href="student_profile/std_registration/preview_details" class="btn btn-primary pull-right btn-space" target="_blank">Application Preview</a>
                    <?php } ?>






                    <div class="btn-group">
                        <a href="student_profile/std_registration/edu_qualification" class="btn btn-primary confirm_pre">
                            < Previous</a>
                    </div>
                </div>
            </div>

        </div>

</div>

</section>
</div>
<!-- /.content-wrapper -->



<!---------------------------- Modal for Confirm final Submit ----------------------->
<div id="confirmFinalsubmit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content modal_remove_content">

        </div>
    </div>
</div>
<!---------------------------- Modal forConfirm final Submit ------------------------>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>