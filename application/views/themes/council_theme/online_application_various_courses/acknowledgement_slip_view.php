<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

    .datepicker {
        background-color: white;
    }
</style>

<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Online Application</h2>
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item active"> Acknowledgement / Payment</li>
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
<div class="container">
    <?php if ($this->session->flashdata('status') !== null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('alert_msg') ?>
        </div>
    <?php } ?>

    <div class="row">

        <div class="col-md-12">
            <h3>Acknowledgement / Payment</h3>
        </div>
        <?php echo form_open_multipart("online_application_various_courses/registration/acknowledgement_slip" )?>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="designation">Aadhar No : <span class="text-danger"></span></label>
                <input type="text" value="<?php echo set_value("applicationNo"); ?>" name="applicationNo" id="applicationNo" class="form-control" placeholder="Enter Aadhar No." >
                <?php echo form_error('applicationNo'); ?>
            </div>
        </div>
        <div class="col-md-2">
            <label for="captcha">&nbsp;</label><br>
            <button type="submit" class="btn btn-warning pull-right">Submit</button>
        </div>
    </div>
    <br>
    <?php echo form_close(); ?>
</div>
    <br><br><br><br>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>