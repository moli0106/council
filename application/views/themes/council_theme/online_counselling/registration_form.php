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
                    <h2 class="breadcrumb-title">Online Counselling</h2>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> Online Counselling / Registration form</li>
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
                <h3>Online Counselling / Registration form</h3>
            </div>

        </div>
        <hr>
        <?php echo form_open_multipart("online_counselling/registration", array("id" => "std_verification_form")); ?>
        <!-- <input type="hidden" name="token" value="<?php echo $captcha['word'] ?>"> -->

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="designation">Counselling For <span class="text-danger">*</span></label>
                    <select class="form-control" name="courses" id="courses">
                        <option value="">-- Counselling For --</option> 
                       
                        <option value="1" <?php echo set_select("courses", 1) ?>>1st year of Diploma Course (Jexpo)</option>
                        <option value="2" <?php echo set_select("courses", 2) ?>>2nd year of Diploma Course (Voclet)</option>
                        
                    </select>
                    <?php echo form_error('courses'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="index_number">Index Number <span class="text-danger">*</span></label>
					
                    <input type="text" value="<?php echo set_value("index_number"); ?>" name="index_number" id="index_number" class="form-control" placeholder="Index Number">
                    
                    <?php echo form_error('index_number'); ?>
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