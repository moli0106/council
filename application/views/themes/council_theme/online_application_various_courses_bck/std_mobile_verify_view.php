<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .card {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }
</style>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">ONLINE APPLICATION</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Online Application</a></li>
                        <li class="breadcrumb-item active">Student Mobile Verification</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5">
    <div class="container">

        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <hr>
        <h5 class="text-center">
            <strong>Student Mobile Verification</strong>
        </h5>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card border-secondary mb-3">
                    <div class="card-header">One Time Passcode (OTP)</div>
                    <div class="card-body text-dark">
                        <?php echo form_open_multipart('online_application_various_courses/registration/mobile_verify/' . $id) ?>
                        <h4>Verify One Time Passcode</h4>
                        <hr>
                        <p>
                            For security reasons we have generated a one time passcode (OTP) for your phone (SMS) at the following number
                            <i><?php echo $mobile; ?>.</i>
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="otp">Enter OTP <span class="text-danger">*</span></label>
                                    <input id="otp" name="otp" class="form-control" type="number" value="<?php echo set_value('otp'); ?>">
                                    <?php echo form_error('otp'); ?>
                                </div>
                                <?php echo $otp;?>
                            </div>
                            <!-- <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-info btn-sm btn-block">Verify Mobile</button>
                            </div> -->
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-info btn-block">Verify Mobile</button>
                            </div>
                            <div class="col-md-6 offset-md-3 text-center">
                                <p class="mt-4">
                                    <span style="color: #BDBDBD;">Don't receive the code?</span>
                                    <br>
                                    <a href="<?php echo base_url('online_application_various_courses/registration/resend_otp/' . $id); ?>">
                                        <strong style="color: #D32F2F;">Resend OTP</strong>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>