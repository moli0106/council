<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>CSS-VSE</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> CSS-VSE</li>
            <li><a href="cssvse/cssvse_school"><i class="fa fa-align-center"></i> School List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Details</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <!-- Left Menu -->
            <?php $this->load->view($this->config->item('theme_uri') . 'cssvse/admin/school/cssvse_left_menu'); ?>
            <!-- Left Menu -->

            <div class="col-md-9">
                <div class="box box-success" style="padding: 2px 8px 8px 8px;">
                    <div class="box-header with-border">
                        <h3 class="box-title">School Details</h3>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('admin/affiliation/vtc/vtcEmailUpdate', array('id' => 'updateVtcEmail')) ?>
                        <input type="hidden" name="school_reg_id_hash" value="<?php echo md5($schoolDetails['school_reg_id_pk']); ?>">
                        <div class="row">
                            <div class="col-xs-12">

                                <div class="card-body text-dark">
                                    <!-- <?php echo form_open_multipart('online_app/inst/cssvse/registration') ?> -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="udiseCode">UDISE Code <span class="text-danger">*</span></label>
                                                <input id="udiseCode" name="udiseCode" class="form-control <?php echo (form_error('udiseCode') != '') ? 'is-invalid' : ''; ?> <?php echo (form_error('udiseCode') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo $schoolDetails['udise_code']; ?>">
                                                <?php echo form_error('udiseCode'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="schoolName">Name of School <span class="text-danger">*</span></label>
                                                <input id="schoolName" name="schoolName" class="form-control <?php echo (form_error('schoolName') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo $schoolDetails['school_name']; ?>" readonly="true">
                                                <?php echo form_error('schoolName'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="schoolEmail">School Email <span class="text-danger">*</span></label>
                                                <input id="schoolEmail" name="schoolEmail" class="form-control <?php echo (form_error('schoolEmail') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo $schoolDetails['school_email']; ?>" readonly="true">
                                                <?php echo form_error('schoolEmail'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="schoolMobileNo">School Mobile No. <span class="text-danger">*</span></label>
                                                <input type="number" id="schoolMobileNo" name="schoolMobileNo" class="form-control <?php echo (form_error('schoolMobileNo') != '') ? 'is-invalid' : ''; ?>" value="<?php echo $schoolDetails['school_mobile']; ?>">
                                                <?php echo form_error('schoolMobileNo'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hoiName">HOI Name <span class="text-danger">*</span></label>
                                                <input id="hoiName" name="hoiName" class="form-control <?php echo (form_error('hoiName') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo $schoolDetails['hoi_name']; ?>">
                                                <?php echo form_error('hoiName'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hoiMobileNo">HOI Mobile No. <span class="text-danger">*</span></label>
                                                <input type="number" id="hoiMobileNo" name="hoiMobileNo" class="form-control <?php echo (form_error('hoiMobileNo') != '') ? 'is-invalid' : ''; ?>" value="<?php echo $schoolDetails['hoi_mobile']; ?>">
                                                <?php echo form_error('hoiMobileNo'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hoiEmail">HOI email <span class="text-danger">*</span></label>
                                                <input id="hoiEmail" name="hoiEmail" class="form-control <?php echo (form_error('hoiEmail') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo $schoolDetails['hoi_email']; ?>">
                                                <?php echo form_error('hoiEmail'); ?>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State of School <span class="text-danger">*</span></label>
                                                <select name="state" id="state" class="form-control <?php echo (form_error('state') != '') ? 'is-invalid' : ''; ?>">
                                                    <option value="" hidden="true">Select State</option>
                                                    <option value="19" <?php if ($schoolDetails['state_id_fk'] == 19) {
                                                                            echo "selected";
                                                                        } ?>>West
                                                        Bengal</option>
                                                </select>
                                                <?php echo form_error('state'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district">District of School <span class="text-danger">*</span></label>
                                                <select name="district" id="district" class="form-control <?php echo (form_error('district') != '') ? 'is-invalid' : ''; ?>">
                                                    <option value="" hidden="true">Select District</option>
                                                    <?php foreach ($districtList as $key => $value) { ?>
                                                        <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($schoolDetails['district_id_fk'] == $value['district_id_pk']) {
                                                                                                                    echo "selected";
                                                                                                                } ?>>
                                                            <?php echo $value['district_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('district'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="municipality">Block / Municipality of School <span class="text-danger">*</span></label>
                                                <select name="municipality" id="municipality" class="form-control <?php echo (form_error('municipality') != '') ? 'is-invalid' : ''; ?>">
                                                    <option value="" hidden="true">Select Block / Municipality</option>
                                                    <?php if (!empty($municipality)) { ?>
                                                        <?php foreach ($municipality as $key => $value) { ?>
                                                            <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($schoolDetails['municipality_id_fk'] == $value['block_municipality_id_pk']) {
                                                                                                                                    echo "selected";
                                                                                                                                } ?>>
                                                                <?php echo $value['block_municipality_name']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <option value="" disabled="true">Select Sub District first...
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('municipality'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="pinCode">School Pin Code <span class="text-danger">*</span></label>
                                                <input id="pinCode" name="pinCode" id="pinCode" class="form-control <?php echo (form_error('pinCode') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo $schoolDetails['pin_code']; ?>">
                                                <?php echo form_error('pinCode'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">School Address <span class="text-danger">*</span></label>
                                                <textarea class="form-control <?php echo (form_error('address') != '') ? 'is-invalid' : ''; ?>" name="address" id="address" rows="3"><?php echo $schoolDetails['school_address']; ?></textarea>
                                                <?php echo form_error('address'); ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>