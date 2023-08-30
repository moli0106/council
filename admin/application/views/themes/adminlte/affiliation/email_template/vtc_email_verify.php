<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i>Basic Details</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?= $this->session->flashdata('alert_msg') ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row" style="margin: auto;">
            <div class="col-md-4 col-md-offset-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">OTP Verification</h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('admin/affiliation/details/otpVerificationForHoiMobileNo') ?>
                        <div class="form-group">
                            <label for="otp">Enter OTP <span class="text-danger">*</span></label>
                            <input name="otp" class="form-control" placeholder="Enter OTP" value="<?php echo set_value('otp'); ?>">
                            <?php echo form_error('otp'); ?>
                        </div>
                        <button type="submit" , class="btn btn-flat btn-block bg-navy">Confirm OTP!</button>
                        <h3><?= $otp ?></h3>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

</div>

</section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>