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
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li class="header pull-left">
                                    <i class="fa fa-university"></i>
                                    <?php echo $schoolDetails['school_name']; ?>
                                </li>
                                <?php if (!empty($vtcCourseList) && !empty($teacherList) && !empty($studentCountDetails)) { ?>
                                    <?php if ($vtcDetails['final_submit_status'] == 0) { ?>
                                        <li><a href="#finalsubmit" data-toggle="tab">Final Submit</a></li>
                                    <?php } ?>
                                <?php } ?>
                                <li><a href="#studentDetails" data-toggle="tab">Student Details</a></li>
                                <li class="active"><a href="#basicDetails" data-toggle="tab">Basic Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="basicDetails">
                                    <?php echo form_open('admin/affiliation/vtc/vtcEmailUpdate', array('id' => 'updateVtcEmail')) ?>
                                    <input type="hidden" name="school_reg_id_hash" value="<?php echo md5($schoolDetails['school_reg_id_pk']); ?>">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <!-- <table class="table table-hover">
                                                <tr>
                                                    <th width="15%">VTC Email:</th>
                                                    <td width="35%"><input type="email" name="vtc_email" class="form-control" value="<?php echo $vtcDetails['vtc_email']; ?>"></td>
                                                    <th width="15%">HOI Name:</th>
                                                    <td width="35%"><?php echo $vtcDetails['hoi_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>HOI Designation:</th>
                                                    <td><?php echo $vtcDetails['hoi_designation']; ?></td>
                                                    <th>HOI email:</th>
                                                    <td><input type="email" name="hoi_email" class="form-control" value="<?php echo $vtcDetails['hoi_email']; ?>"></td>
                                                </tr>
                                                <tr>
                                                    <th>HOI Mobile No.:</th>
                                                    <td><?php echo $vtcDetails['hoi_mobile_no']; ?></td>
                                                    <th>Type:</th>
                                                    <td>
                                                        <?php
                                                        if (!empty($vtcDetails['other_type'])) {
                                                            echo $vtcDetails['other_type'];
                                                        } else {
                                                            echo $vtcDetails['vtc_type_name'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Medium of Instruction:</th>
                                                    <td>
                                                        <?php
                                                        if (!empty($vtcDetails['other_medium'])) {
                                                            echo $vtcDetails['other_medium'];
                                                        } else {
                                                            echo $vtcDetails['medium_of_instruction'];
                                                        }
                                                        ?>
                                                    </td>
                                                    <th>Address:</th>
                                                    <td><?php echo $vtcDetails['vtc_address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>District:</th>
                                                    <td><?php echo $vtcDetails['district_name']; ?></td>
                                                    <th>Sub Division:</th>
                                                    <td><?php echo $vtcDetails['subdiv_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Municipality:</th>
                                                    <td><?php echo $vtcDetails['block_municipality_name']; ?></td>
                                                    <th>Panchayat:</th>
                                                    <td><?php echo $vtcDetails['panchayat']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Police Station:</th>
                                                    <td><?php echo $vtcDetails['police_station']; ?></td>
                                                    <th>Pin Code:</th>
                                                    <td><?php echo $vtcDetails['pin_code']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Inst. Phone No.:</th>
                                                    <td><?php echo $vtcDetails['phone_no']; ?></td>
                                                    <th>Nodal:</th>
                                                    <td><?php echo $vtcDetails['nodal_centre_name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary or equivalent in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_equivalent'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary Science (Mathematics) in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_science'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary Science (Biology) in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_biology'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Does the school have Higher Secondary Commerce in regular section:</th>
                                                    <td><?php echo ($vtcDetails['hs_commerce'] == 1) ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                            </table> -->
                                            <div class="card border-primary mb-3">
           
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
                                                                <input id="schoolName" name="schoolName" class="form-control <?php echo (form_error('schoolName') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('schoolName'); ?>" readonly="true">
                                                                <?php echo form_error('schoolName'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="schoolEmail">School Email <span class="text-danger">*</span></label>
                                                                <small style="font-size: 10px;"><i>Login credentials will be send to School Email.</i></small>
                                                                <input id="schoolEmail" name="schoolEmail" class="form-control <?php echo (form_error('schoolEmail') != '') ? 'is-invalid' : ''; ?>" type="text" value="<?php echo set_value('schoolEmail'); ?>" readonly="true">
                                                                <?php echo form_error('schoolEmail'); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="schoolMobileNo">School Mobile No. <span class="text-danger">*</span></label>
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
                                                                <small style="font-size: 10px;"><i>OTP will be send to HOI Mobile No.</i></small>
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
                                                                <label for="state">State of School <span class="text-danger">*</span></label>
                                                                <select name="state" id="state" class="form-control <?php echo (form_error('state') != '') ? 'is-invalid' : ''; ?>">
                                                                    <option value="" hidden="true">Select State</option>
                                                                    <option value="19" <?php echo set_select('state', 19); ?>>West Bengal</option>
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
                                                                <label for="municipality">Block / Municipality of School <span class="text-danger">*</span></label>
                                                                <select name="municipality" id="municipality" class="form-control <?php echo (form_error('municipality') != '') ? 'is-invalid' : ''; ?>">
                                                                    <option value="" hidden="true">Select Block / Municipality</option>
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
                                                                <label for="pinCode">School Pin Code <span class="text-danger">*</span></label>
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
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-md-offset-4">
                                            <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Update School Details</button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                                
                                <div class="tab-pane" id="studentDetails">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 0; ?>
                                            <?php if (count($studentList) > 0) { ?>
                                                <?php foreach ($studentList as $key => $value) { ?>
                                                    <tr id="<?php echo md5($value['student_id_pk']); ?>">
                                                        <td><?php echo ++$count; ?>.</td>
                                                        <td><?php echo $value['first_name'];?></td>
                                                        <td><?php echo $value['mobile']; ?></td>
                                                        <td><?php echo $value['email']; ?></td>
                                                        <td>
                                                            <?php echo $value['gender_description'];?>
                                                        </td>
                                                        
                                                        <td>
                                                            <a href="<?php echo base_url('admin/cssvse/cssvse_school/students/' . md5($value['student_id_pk'])); ?>" class="btn btn-info btn-sm">
                                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

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
                                $("#schoolEmail").val(res.school_email);
                                $("#schoolMobileNo").val(res.school_mobile);
                                $("#hoiName").val(res.hoi_name);
                                $("#hoiMobileNo").val(res.hoi_mobile);
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