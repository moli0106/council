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
                    <h2 class="breadcrumb-title">CSS-VSE</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">CSS-VSE</a></li>
                        <li class="breadcrumb-item active">School Registration</li>
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

        <h4>
            <strong>Registration for CSS-VSE Assessment<span style="color: #fd7e14;"> 2021-22</span></strong>
        </h4>
        <hr>
        <div class="card border-primary mb-3">
            <div class="card-header">Registration for CSS-VSE Assessment 2021-22</div>
            <div class="card-body text-dark">
                <?php echo form_open_multipart('online_app/inst/cssvse/registration') ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="udiseCode">UDISE Code <span class="text-danger">*</span></label>
                            <input id="udiseCode" name="udiseCode" class="form-control <?php echo (form_error('udiseCode') != '') ? 'is-invalid' : ''; ?> <?php echo (form_error('udiseCode') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('udiseCode'); ?>">
                            <?php echo form_error('udiseCode'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="schoolName">Name of School <span class="text-danger">*</span></label>
                            <input id="schoolName" name="schoolName" class="form-control <?php echo (form_error('schoolName') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('schoolName'); ?>" readonly="true">
                            <?php echo form_error('schoolName'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="schoolEmail">School Email <span class="text-danger">*</span></label>
                            <small style="font-size: 10px;" class="text-danger"><i>Login credentials will be send to School Email.</i></small>
                            <input id="schoolEmail" name="schoolEmail" class="form-control <?php echo (form_error('schoolEmail') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('schoolEmail'); ?>">
                            <?php echo form_error('schoolEmail'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="schoolMobileNo">School Contact No. <span class="text-danger">*</span></label>
                            <input type="number" id="schoolMobileNo" name="schoolMobileNo" class="form-control <?php echo (form_error('schoolMobileNo') != '') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('schoolMobileNo'); ?>">
                            <?php echo form_error('schoolMobileNo'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hoiName">HOI Name <span class="text-danger">*</span></label>
                            <input id="hoiName" name="hoiName" class="form-control <?php echo (form_error('hoiName') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('hoiName'); ?>">
                            <?php echo form_error('hoiName'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hoiMobileNo">HOI Mobile No. <span class="text-danger">*</span></label>
                            <small style="font-size: 10px;" class="text-danger"><i>OTP will be send to HOI Mobile No.</i></small>
                            <input type="number" id="hoiMobileNo" name="hoiMobileNo" class="form-control <?php echo (form_error('hoiMobileNo') != '') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('hoiMobileNo'); ?>">
                            <?php echo form_error('hoiMobileNo'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hoiEmail">HOI email <span class="text-danger">*</span></label>
                            <input id="hoiEmail" name="hoiEmail" class="form-control <?php echo (form_error('hoiEmail') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('hoiEmail'); ?>">
                            <?php echo form_error('hoiEmail'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="state">State <span class="text-danger">*</span></label>
                            <select name="state" id="state" class="form-control <?php echo (form_error('state') != '') ? 'is-invalid' : ''; ?>">
                                <option value="" hidden="true">Select State</option>
                                <option value="19" <?php echo set_select('state', 19); ?>>WEST BENGAL</option>
                            </select>
                            <?php echo form_error('state'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="district">District <span class="text-danger">*</span></label>
                            <select name="district" id="district" class="form-control <?php echo (form_error('district') != '') ? 'is-invalid' : ''; ?>">
                                <option value="" hidden="true">Select District</option>
                                <?php foreach ($districtList as $key => $value) { ?>
                                    <option value="<?php echo $value['district_id_pk']; ?>" <?php echo set_select('district', $value['district_id_pk']); ?>>
                                        <?php echo $value['district_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('district'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="municipality">Block / Municipality / Corporation <span class="text-danger">*</span></label>
                            <select name="municipality" id="municipality" class="form-control <?php echo (form_error('municipality') != '') ? 'is-invalid' : ''; ?>">
                                <option value="" hidden="true">Select Block / Municipality / Corporation</option>
                                <?php if (!empty($municipality)) { ?>
                                    <?php foreach ($municipality as $key => $value) { ?>
                                        <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php echo set_select('municipality', $value['block_municipality_id_pk']); ?>>
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
                        <div class="form-group">
                            <label for="pinCode">Pin Code <span class="text-danger">*</span></label>
                            <input id="pinCode" name="pinCode" id="pinCode" class="form-control <?php echo (form_error('pinCode') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('pinCode'); ?>">
                            <?php echo form_error('pinCode'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="address">School Address <span class="text-danger">*</span></label>
                            <textarea class="form-control <?php echo (form_error('address') != '') ? 'is-invalid' : ''; ?>" name="address" id="address" rows="3"><?php echo set_value('address'); ?></textarea>
                            <?php echo form_error('address'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Submit for registration</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>

<script>
    $(document).on('blur', '#udiseCode', function() {

        var udiseCode = $(this).val();
        if (udiseCode != '') {

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    setTimeout(function() {

                        $.ajax({
                                url: "online_app/inst/cssvse/registration/getSchoolDetails/" + udiseCode,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                Swal.close();
                                $("#schoolName").val(res.school_name);
                                // $("#schoolEmail").val(res.school_email);
                                $("#schoolMobileNo").val(res.school_mobile);
                                $("#hoiName").val(res.hoi_name);
                                // $("#hoiMobileNo").val(res.hoi_mobile);
                                $("#hoiEmail").val(res.hoi_email);
                                $("#state").html(res.state_list);
                                $("#district").html(res.district_list);
                                $("#municipality").html(res.block_list);
                                $("#pinCode").val(res.pin_code);
                                $("#address").text(res.school_address);
                            })
                            .fail(function() {
                                Swal.fire('Warning!', 'Oops! UDISE Code not found.', 'warning');
                            });

                    }, 100);
                }
            });
        }
    });

    $(document).on('change', '#district', function() {
        var district = $(this).val();

        $.ajax({
                url: "online_app/inst/cssvse/registration/getMunicipality/" + district,
                dataType: "JSON",
            })
            .done(function(res) {
                $('#municipality').html(res);
            })
            .fail(function() {
                console.log('error');
            });
    })
</script>