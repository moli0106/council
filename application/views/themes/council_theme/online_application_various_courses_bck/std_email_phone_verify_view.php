<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Online Application</h2>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> Various Courses / Online Application form</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<style>
    .course_sector_block,
    .work_exp_section,
    .experience_section,
    .agency_section {
        padding: 10px 0px 10px 0px;
        margin-bottom: 10px;
        border: 2px solid #CCC;
    }
</style>
<section class="pt-5 pb-5">
    <div class="container">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="row">

            <div class="col-md-12">
                <h3>Various Courses / Online Application form</h3>
            </div>

        </div>
        <hr>
        <?php echo form_open_multipart("online_application_various_courses/registration", array("id" => "std_verification_form")); ?>
        <!-- <input type="hidden" name="token" value="<?php echo $captcha['word'] ?>"> -->

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="designation">Course Applied For <span class="text-danger">*</span></label>
                    <select class="form-control" name="courses" id="courses">
                        <option value="">-- Courses --</option> 
                        <!-- for the db table  of council_spot_course_master -->
                        <!-- <?php // foreach ($courses as $course) { ?>
                            <option value="<?php // echo $course['course_id_pk'] ?>" <?php // echo set_select("courses", $course['course_id_pk']) ?>><?php echo $course['course_name'] ?></option>
                        <?php //} ?> -->
                       <!--course code is replace by  council_exam_type_master -->
                        <?php foreach ($courses as $course) { ?>
                            <option value="<?php echo $course['exam_type_id_pk'] ?>" <?php echo set_select("courses", $course['exam_type_id_pk']) ?>><?php echo $course['exam_type_name'] ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('courses'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="fullname">Name <span class="text-danger">*</span></label>
                    <?php if(isset($api_arr)) { ?>
                       
                        <input type="text" value="<?php echo $api_arr['citizenname']; ?>" name="fullname" id="fullname" class="form-control" placeholder="Name">

                    <?php }else{?>
                        <input type="text" value="<?php echo set_value("fullname"); ?>" name="fullname" id="fullname" class="form-control" placeholder="Name">

                    <?php }?>
                    <?php echo form_error('fullname'); ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="stdEmail">Email <span class="text-danger">*</span></label>
                    <small><i>Verification Link will be send to this email.</i></small>
                    <input id="stdEmail" name="stdEmail" class="form-control" type="email" placeholder="Email" value="<?php echo set_value('stdEmail'); ?>">
                    <?php echo form_error('stdEmail'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="stdMobileNo">Mobile No. <span class="text-danger">*</span></label>
                    <small><i>OTP will be send to Mobile No.</i></small>
                    <?php if(isset($api_arr)) { ?>
                       
                        <input type="number" id="stdMobileNo" name="stdMobileNo" class="form-control" placeholder="Mobile No" value="<?php echo $api_arr['citizenmobile'];?>">

                    <?php }else{?>
                        <input type="number" id="stdMobileNo" name="stdMobileNo" class="form-control" placeholder="Mobile No" value="<?php echo set_value('stdMobileNo');?>">
                        <?php }?>
                    <?php echo form_error('stdMobileNo'); ?>
                </div>
            </div>
            <input type="text" name="bsk_ticket_no" value="<?php echo $api_arr['ticket_no'];?>">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="aadhar_no">Aadhar No <span class="text-danger">*</span></label>
                    <input type="number" value="<?php echo set_value("aadhar_no"); ?>" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Aadhar No." style="text-transform: uppercase;">
                    <?php echo form_error('aadhar_no'); ?>
                </div>
            </div>



        </div>





        <div class="col-md-7">

            <button type="submit" class="btn btn-success pull-right">Submit</button>
        </div>
        <?php echo form_close(); ?>
    </div>
    <br>
</section>

<!-- </div> -->
<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>