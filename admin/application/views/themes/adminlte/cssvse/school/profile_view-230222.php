<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>School Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>School Profile</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-university" aria-hidden="true"></i> School Profile Details</h3>
            </div>
            <div class="box-body">
                <?php echo form_open_multipart('admin/cssvse/school/profile') ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('udiseCode') != '') ? 'has-error' : ''; ?>">
                            <label for="udiseCode">UDISE Code <span class="text-danger">*</span></label>
                            <input id="udiseCode" name="udiseCode" class="form-control" type="text" value="<?php echo $schoolData['udise_code']; ?>" readonly="true">
                            <?php echo form_error('udiseCode'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('schoolName') != '') ? 'has-error' : ''; ?>">
                            <label for="schoolName">Name of School <span class="text-danger">*</span></label>
                            <input id="schoolName" name="schoolName" class="form-control" type="text" value="<?php echo $schoolData['school_name']; ?>" readonly="true">
                            <?php echo form_error('schoolName'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('schoolEmail') != '') ? 'has-error' : ''; ?>">
                            <label for="schoolEmail">School Email <span class="text-danger">*</span></label>
                            <input id="schoolEmail" name="schoolEmail" class="form-control" type="text" value="<?php echo $schoolData['school_email']; ?>" readonly="true">
                            <?php echo form_error('schoolEmail'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('schoolMobileNo') != '') ? 'has-error' : ''; ?>">
                            <label for="schoolMobileNo">School Mobile No. <span class="text-danger">*</span></label>
                            <input type="number" id="schoolMobileNo" name="schoolMobileNo" class="form-control" value="<?php echo $schoolData['school_mobile']; ?>">
                            <?php echo form_error('schoolMobileNo'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('hoiName') != '') ? 'has-error' : ''; ?>">
                            <label for="hoiName">HOI Name <span class="text-danger">*</span></label>
                            <input id="hoiName" name="hoiName" class="form-control" type="text" value="<?php echo $schoolData['hoi_name']; ?>">
                            <?php echo form_error('hoiName'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('hoiMobileNo') != '') ? 'has-error' : ''; ?>">
                            <label for="hoiMobileNo">HOI Mobile No. <span class="text-danger">*</span></label>
                            <input type="number" id="hoiMobileNo" name="hoiMobileNo" class="form-control" value="<?php echo $schoolData['hoi_mobile']; ?>" readonly="true">
                            <?php echo form_error('hoiMobileNo'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('hoiEmail') != '') ? 'has-error' : ''; ?>">
                            <label for="hoiEmail">HOI email <span class="text-danger">*</span></label>
                            <input id="hoiEmail" name="hoiEmail" class="form-control" type="text" value="<?php echo $schoolData['hoi_email']; ?>">
                            <?php echo form_error('hoiEmail'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('state') != '') ? 'has-error' : ''; ?>">
                            <label for="state">State of School <span class="text-danger">*</span></label>
                            <select name="state" id="state" class="form-control">
                                <option value="" hidden="true">Select State</option>
                                <option value="19" selected>West Bengal</option>
                            </select>
                            <?php echo form_error('state'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('district') != '') ? 'has-error' : ''; ?>">
                            <label for="district">District of School <span class="text-danger">*</span></label>
                            <select name="district" id="district" class="form-control">
                                <option value="" hidden="true">Select District</option>
                                <?php foreach ($districtList as $key => $value) { ?>
                                    <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($schoolData['district_id_fk'] == $value['district_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['district_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('district'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('municipality') != '') ? 'has-error' : ''; ?>">
                            <label for="municipality">Block / Municipality of School <span class="text-danger">*</span></label>
                            <select name="municipality" id="municipality" class="form-control">
                                <option value="" hidden="true">Select Block / Municipality</option>
                                <?php if (!empty($municipality)) { ?>
                                    <?php foreach ($municipality as $key => $value) { ?>
                                        <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($schoolData['municipality_id_fk'] == $value['block_municipality_id_pk']) echo 'selected'; ?>>
                                            <?php echo $value['block_municipality_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">Select Sub District first...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('municipality'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo (form_error('pinCode') != '') ? 'has-error' : ''; ?>">
                            <label for="pinCode">School Pin Code <span class="text-danger">*</span></label>
                            <input id="pinCode" name="pinCode" id="pinCode" class="form-control" type="text" value="<?php echo $schoolData['pin_code']; ?>">
                            <?php echo form_error('pinCode'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group <?php echo (form_error('address') != '') ? 'has-error' : ''; ?>">
                            <label for="address">School Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" id="address" rows="3"><?php echo set_value('address'); ?><?php echo $schoolData['school_address']; ?></textarea>
                            <?php echo form_error('address'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <!-- <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Update School Profile</button> -->
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>