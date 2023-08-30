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
                            <label for="admissionYear">Year of Admission <span class="text-danger">*</span></label>
                            <input id="admissionYear" name="admissionYear" value="<?php echo $app_data['year_of_registration'];?>" class="form-control" type="text"
                                value="<?php //echo $academic_year; ?>" readonly>
                            <?php echo form_error('admissionYear'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="poly_course_id">Select course name <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="poly_course_id" id="poly_course_id">
                                <option value="" hidden="true">Select course name</option>
                                <!-- <option value="1" <?php echo set_select('course_name_id', '1')?>>HS-Voc</option>
<option value="4" <?php echo set_select('course_name_id', '4')?>>VIII+ STC</option> -->

                            </select>
                            <?php echo form_error('poly_course_id'); ?>
                        </div>
                    </div>


                </div>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="student_profile/std_registration/basic_details" class="btn btn-primary btn-space">Next >
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