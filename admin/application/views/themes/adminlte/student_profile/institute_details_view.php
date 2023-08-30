<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<!-- Content Wrapper. Contains page content -->
<style>
.btn-space {
    margin-right: 5px;
}
</style>

<!-- For disabled on final submit -->
<?php if($app_data['final_flag'] == 't'){
        $disabled="disabled";
    }else{
        $disabled=NULL;  
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

                <!-- For Menu -->
                <?php $this->load->view($this->config->item('theme') . 'student_profile/menu_view'); ?>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>


                <h4>Institute Details</h4>
                <hr>
                <div class="row">




                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcName">Institute Name <span class="text-danger">*</span></label>
                            <input id="vtcName" name="vtcName" class="form-control" type="text" value="<?php echo $app_data['vtc_name'];?>" readonly>
                            <!-- <input type='text' id='selectuser_ids' value=""/> -->
                            <?php echo form_error('vtcName'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcCode">Institute Code <span class="text-danger">*</span></label>
                            <input id="instituteCode" name="vtcCode" class="form-control" type="text" value="<?php echo $app_data['vtc_code'];?>" readonly>
                            <?php echo form_error('vtcCode'); ?>
                        </div>
                    </div>
					
					<div class="col-md-4">
                        <div class="form-group">
                            <label for="ins_category">Institute Category <span class="text-danger">*</span></label>
                            <input id="ins_category" name="ins_category" class="form-control" type="text" value="<?php echo $app_data['institute_category'];?>" readonly>
                            <?php echo form_error('ins_category'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="admissionYear">Year of Admission <span class="text-danger">*</span></label>
                            <input id="admissionYear" name="admissionYear" value="<?php echo $app_data['registration_year'];?>" class="form-control" type="text"
                                value="<?php //echo $academic_year; ?>" readonly>
                            <?php echo form_error('admissionYear'); ?>
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="exam_type_id">Select Exam/Application name <span class="text-danger">*</span></label>
                            <select class="form-control" name="exam_type_id" id="exam_type_id">
                                <option value="" hidden="true">---Select Exam/Application name---</option>
                                <?php foreach ($exam_type as $val) { ?>
                                    <?php if ($this->input->method(TRUE) == 'GET') { ?>
                                        <option value="<?php echo $val['exam_type_id_pk']; ?>" <?php echo $val['exam_type_id_pk'] == $app_data['exam_type_id_fk'] ? 'selected' : ''; ?>><?php echo $val['name_for_std_reg']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $val['exam_type_id_pk']; ?>" <?php echo set_select('exam_type_id', $val['exam_type_id_pk']); ?>><?php echo $val['name_for_std_reg']; ?></option>
                                <?php }
                                 } ?>
                             </select>
                            <?php echo form_error('exam_type_id'); ?>
                        </div>
                    </div>

                     <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Select course Name <span class="text-danger">*</span></label>
								<?php //echo $form_data['course_id'];?>
                            <select class="form-control" name="course_id" id="course_id">
                                <option value="" hidden="true">-- Select course Name --</option>
                                <?php foreach ($course as $val) { ?>
								
									<option value="<?php echo $val['discipline_id_pk']; ?>" <?php echo $val['discipline_id_pk'] == $form_data['course_id'] ? 'selected' : ''; ?>><?php echo $val['discipline_name']; ?>[<?php echo $val['discipline_code']; ?>]</option>

                                    <?php 
                                } ?>

                            </select>

                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>


                </div>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="student_profile/std_registration/basic_details" class="btn btn-primary btn-space confirm_next">Next >
                    </a>
                </div>
                <!-- 20-02-2023 -->
                <?php if ($app_data['final_save_status'] != 1) { ?>

                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                <?php }
                ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>


    </section>
    <?php //$this->load->view($this->config->item('theme_uri').'assessor_profile/terms_condition_view'); ?>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>