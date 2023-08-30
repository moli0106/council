
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




<section class="pt-5 pb-5">
    <div class="container">

        <?php echo form_open_multipart('online_app/inst/vtc/affiliation/registration') ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="vtc_type_1">Select Institute Type <span class="text-danger">*</span></label>
                    <select name="vtc_type" id="vtc_type_1" class="form-control">
                        <option value="" hidden="true">Select Institute Type</option>
                        <!-- <option value="1" <?php echo set_select('vtc_type', 1); ?>>New VTC Apply Affiliation</option> -->
                        <option value="2" <?php echo set_select('vtc_type', 2); ?>>Existing Institute  Renewal Affiliation</option>
                    </select>
                    <?php echo form_error('vtc_type'); ?>
                </div>
            </div>
            <div class="col-md-4 vtcCode-div" <?php if ((set_value('vtc_type') == 1) || (set_value('vtc_type') == NULL)) echo 'style="display: none;"'; ?>>
                <div class="form-group">
                    <label for="vtcCode_1">Institute Code <span class="text-danger">*</span></label>
                    <input id="vtcCode_1" name="vtcCode" class="form-control vtcCode" type="text" value="<?php echo set_value('vtcCode'); ?>">
                    <?php echo form_error('vtcCode'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="vtcName_1">Institute Name <span class="text-danger">*</span></label>
                    <input id="vtcName_1" name="vtcName" class="form-control vtcName" type="text" value="<?php echo set_value('vtcName'); ?>" <?php if (set_value('vtc_type') == 2) echo 'readonly="true"'; ?>>
                    <?php echo form_error('vtcName'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="vtcEmail_1">Institute email <span class="text-danger">*</span></label>
                    <small><i>Login credentials will be send to Institute email.</i></small>
                    <input id="vtcEmail_1" name="vtcEmail" class="form-control" type="text" value="<?php echo set_value('vtcEmail'); ?>">
                    <?php echo form_error('vtcEmail'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="hoiName_1">HOI name <span class="text-danger">*</span></label>
                    <input id="hoiName_1" name="hoiName" class="form-control" type="text" value="<?php echo set_value('hoiName'); ?>">
                    <?php echo form_error('hoiName'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="hoiDesignation_1">HOI Designation <span class="text-danger">*</span></label>
                    <!-- <input id="hoiDesignation" name="hoiDesignation" class="form-control" type="text" value="<?php echo set_value('hoiDesignation'); ?>"> -->
                    <select name="hoiDesignation" id="hoiDesignation_1" class="form-control">
                        <option value="" hidden="true">Select HOI Designation</option>
                        <?php foreach ($hoi_designation as $key => $value) { ?>
                            <option value="<?php echo $value['hoi_designation_id_pk']; ?>" <?php echo set_select('hoiDesignation', $value['hoi_designation_id_pk']); ?>>
                                <?php echo $value['designation_name']; ?>
                            </option>
                        <?php } ?>
                        
                    </select>
                    <?php echo form_error('hoiDesignation'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="hoiEmail_1">HOI email <span class="text-danger">*</span></label>
                    <input id="hoiEmail_1" name="hoiEmail" class="form-control" type="text" value="<?php echo set_value('hoiEmail'); ?>">
                    <?php echo form_error('hoiEmail'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="hoiMobileNo_1">HOI Mobile No. <span class="text-danger">*</span></label>
                    <small><i>OTP will be send to HOI Mobile No.</i></small>
                    <input type="number" id="hoiMobileNo_1" name="hoiMobileNo" class="form-control" value="<?php echo set_value('hoiMobileNo'); ?>">
                    <?php echo form_error('hoiMobileNo'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="vtc_type_id_1">Type <span class="text-danger">*</span></label>
                    <select name="vtc_type_id" id="vtc_type_id_1" class="form-control">
                        <option value="" hidden="true">Select Type</option>
                        <?php foreach ($vtcTypeList as $key => $value) { ?>
                            <option value="<?php echo $value['vtc_type_id_pk']; ?>" <?php echo set_select('vtc_type_id', $value['vtc_type_id_pk']); ?>>
                                <?php echo $value['vtc_type_name']; ?>
                            </option>
                        <?php } ?>
                        <option value="Other" <?php echo set_select('vtc_type_id', 'Other'); ?>>Other</option>
                    </select>
                    <?php echo form_error('vtc_type_id'); ?>
                </div>
            </div>
            <div class="col-md-4 other-type-div" <?php if (set_value('vtc_type_id') != 'Other') echo 'style="display: none;"'; ?>>
                <div class="form-group">
                    <label for="other_type_1">Enter Type <span class="text-danger">*</span></label>
                    <input id="other_type_1" name="other_type" class="form-control" type="text" value="<?php echo set_value('other_type'); ?>">
                    <?php echo form_error('other_type'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="medium_of_instruction_1">Medium of Instruction <span class="text-danger">*</span></label>
                    <select name="medium_of_instruction" id="medium_of_instruction_1" class="form-control">
                        <option value="" hidden="true">Select Medium of Instruction</option>
                        <?php foreach ($mediumList as $key => $value) { ?>
                            <option value="<?php echo $value['medium_of_instruction_id_pk']; ?>" <?php echo set_select('medium_of_instruction', $value['medium_of_instruction_id_pk']); ?>>
                                <?php echo $value['medium_of_instruction']; ?>
                            </option>
                        <?php } ?>
                        <option value="Other" <?php echo set_select('medium_of_instruction', 'Other'); ?>>Other</option>
                    </select>
                    <?php echo form_error('medium_of_instruction'); ?>
                </div>
            </div>
            <div class="col-md-4 other-medium-div" <?php if (set_value('medium_of_instruction') != 'Other') echo 'style="display: none;"'; ?>>
                <div class="form-group">
                    <label for="other_medium_1">Enter Medium of Instruction <span class="text-danger">*</span></label>
                    <input id="other_medium_1" name="other_medium" class="form-control" type="text" value="<?php echo set_value('other_medium'); ?>">
                    <?php echo form_error('other_medium'); ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="inst_category_1">Institute Category <span class="text-danger">*</span></label>
                    <select name="inst_category" id="inst_category_1" class="form-control">
                        <option value="" hidden="true">Select Institute Category</option>
                        <?php foreach ($institute_category as $key => $value) { ?>
                            <option value="<?php echo $value['institute_category_id_pk']; ?>" <?php echo set_select('inst_category', $value['institute_category_id_pk']); ?>>
                                <?php echo $value['category_name']; ?>
                            </option>
                        <?php } ?>
                        
                    </select>
                    <?php echo form_error('inst_category'); ?>
                </div>
            </div>

            <div class="col-md-6">
                                    
                <div class="form-group">
                    <label class="" for="category_doc">
                    Upload Institute Category Document 
                        <span class="text-danger">*</span>
                        <!-- <br> -->
                        <small>(.PDF only, Max 200KB)</small>
                    </label>
                
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-success">
                                Browse&hellip;<input type="file" style="display: none;" name="category_doc" id="category_doc_1">
                            </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <?php echo form_error('category_doc'); ?>
                </div>
            </div>
        </div>

        <!-- Added on 05-12-2022 -->

        <div class="row">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="inst_spl_category_1">Does the institute fall under special category? <span class="text-danger">*</span></label>
                    <select name="inst_spl_category" id="inst_spl_category_1" class="form-control">
                        <option value="" hidden="true">Select Anyone</option>
                        <option value="1" <?php echo set_select('inst_spl_category', 1); ?>>Yes</option>
                        <option value="2" <?php echo set_select('inst_spl_category', 2); ?>>No</option>
                    </select>
                    <?php echo form_error('inst_spl_category'); ?>
                </div>
            </div>
            <div class="col-md-4 spl_category">
                <div class="form-group">
                    <label for="spl_category_1">Types of special category<span class="text-danger">*</span></label>
                    <select name="spl_category" id="spl_category_1" class="form-control">
                        <option value="" hidden="true">Select Anyone</option>
                        
                        <option value="1" <?php echo set_select('spl_category', 1); ?>>Not a special category institute</option>
                        <option value="2" <?php echo set_select('spl_category', 2); ?>>Provide training ONLY to Persons with special needs</option>
                        <option value="3" <?php echo set_select('spl_category', 3); ?>>Provide training ONLY to Persons under disadvantage group</option>
                        <option value="4" <?php echo set_select('spl_category', 4); ?>>Provide training ONLY to Persons residing in Homes</option>
                        <option value="5" <?php echo set_select('spl_category', 5); ?>>Provide training ONLY to Homeless persons staying on streets</option>
                        
                    </select>
                    <?php echo form_error('spl_category'); ?>
                </div>
            </div>

            <div class="col-md-3 disability_div" <?php if (set_value('spl_category') != 2) echo 'style="display: none;"'; ?>>
                <div class="form-group">
                    <label for="disability_1">Type of disability <span class="text-danger">*</span></label>
                    <select name="disability" id="disability_1" class="form-control">
                        <option value="" hidden="true">Select Disability</option>
                        <?php foreach ($disabilityList as $key => $value) { ?>
                            <option value="<?php echo $value['disability_id_pk']; ?>" <?php echo set_select('disability', $value['disability_id_pk']); ?>>
                                <?php echo $value['disability_name']; ?>
                            </option>
                        <?php } ?>
                        
                    </select>
                    <?php echo form_error('disability'); ?>
                </div>
            </div>

            <div class="col-md-3 disadvantageGroupDiv" <?php if (set_value('spl_category') != 3) echo 'style="display: none;"'; ?>>
                <div class="form-group">
                    <label for="disadvantage_group_1">Type of disadvantage group <span class="text-danger">*</span></label>
                    <select name="disadvantage_group" id="disadvantage_group_1" class="form-control">
                        <option value="" hidden="true">Select disadvantage group</option>
                        <?php foreach ($disadvantageGroupList as $key => $value) { ?>
                            <option value="<?php echo $value['disadvantage_group_id_pk']; ?>" <?php echo set_select('disadvantage_group', $value['disadvantage_group_id_pk']); ?>>
                                <?php echo $value['disadvantage_group_name']; ?>
                            </option>
                        <?php } ?>
                        
                    </select>
                    <?php echo form_error('disadvantage_group'); ?>
                </div>
            </div>

            <div class="col-md-6 splCategoryDoc" <?php if ((set_value('spl_category') == 1) || (set_value('spl_category') == NULL)){echo 'style="display: none;"';}  ?>>
                                    
                <div class="form-group">
                    <label class="" for="spl_category_doc">
                    Upload special Category Document 
                        <span class="text-danger">*</span>
                        <!-- <br> -->
                        <small>(.PDF only, Max 200KB)</small>
                    </label>
                
                    <div class="input-group">
                        <label class="input-group-btn">
                            <span class="btn btn-success">
                                Browse&hellip;<input type="file" style="display: none;" name="spl_category_doc" id="spl_category_doc_1">
                            </span>
                        </label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <?php echo form_error('spl_category_doc'); ?>
                </div>
            </div>
        </div>
        <!-- Added on 05-12-2022 -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="address" rows="3"><?php echo set_value('address'); ?></textarea>
                    <?php echo form_error('address'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="district_1">District <span class="text-danger">*</span></label>
                    <select name="district" id="district_1" class="form-control">
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
                    <label for="subDivision_1">Select Sub Division <span class="text-danger">*</span></label>
                    <select name="subDivision" id="subDivision_1" class="form-control subDivision">
                        <option value="" hidden="true">Select Sub Division</option>
                        <option value="" disabled="true">Select District first...</option>
                    </select>
                    <?php echo form_error('subDivision'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="municipality_1">Municipality/Block </label>
                    <select name="municipality" id="municipality_1" class="form-control municipality">
                        <option value="" hidden="true">Select Municipality</option>
                        <option value="" disabled="true">Select Sub Division first...</option>
                    </select>
                    <?php echo form_error('municipality'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="panchayat_1">Panchayat</label>
                    <input id="panchayat_1" name="panchayat" class="form-control" type="text" value="<?php echo set_value('panchayat'); ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="policeStation_1">Police Station <span class="text-danger">*</span></label>
                    <input id="policeStation_1" name="policeStation" class="form-control" type="text" value="<?php echo set_value('policeStation'); ?>">
                    <?php echo form_error('policeStation'); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pinCode_1">Pin Code <span class="text-danger">*</span></label>
                    <input id="pinCode_1" name="pinCode" class="form-control" type="text" value="<?php echo set_value('pinCode'); ?>">
                    <?php echo form_error('pinCode'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phoneNo_1">Inst. Phone no – (Land line)</label>
                    <input id="phoneNo_1" name="phoneNo" class="form-control" type="number" value="<?php echo set_value('phoneNo'); ?>">
                </div>
            </div>
            </div>

            
        <div class="existing-vtc-block"></div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <label>&nbsp;</label>
                <button id="submit_1" type="submit" value="submit" class="btn btn-info btn-block">Submit for registration</button>
            </div>
            <div class="col-md-4"></div>
        </div>
        <?php echo form_close() ?>
    </div>
   
</section>



<script>
    $(document).ready(function() {

        // $('.select2').select2();

        $('input:radio[name="schoolHaveHigherSecondaryEquivalent"]').change(function() {
            if ($(this).val() == 1) {
                $('.hse-div').show();
            } else {
                $('.hse-div').hide();
            }
        });

        $('input:radio[name="changeInNameAddress"]').change(function() {
            if ($(this).val() == 1) {
                $('.approvalFromCouncil-div').show();
                // $('.documentRegardingChangeOfName-div').show();
            } else {
                $('.approvalFromCouncil-div').hide();
                $('.documentRegardingChangeOfName-div').hide();
                $('.councilApprovalLetter-div').hide();
            }
        });

        $('input:radio[name="approvalFromCouncil"]').change(function() {
            if ($(this).val() == 1) {
                $('.councilApprovalLetter-div').show();
                $('.documentRegardingChangeOfName-div').hide();
            } else {
                $('.councilApprovalLetter-div').hide();
                $('.documentRegardingChangeOfName-div').show();
            }
        });

        $('input:radio[name="nearbyExistingVtc"]').change(function() {
            if ($(this).val() == 1) {
                $('.numberOfExistingVtc-div').show();
            } else {
                $('.numberOfExistingVtc-div').hide();
            }
        });

        $(document).on('change', '#vtc_type_1', function() {
            if ($(this).val() == 1) {
                $('.vtcCode-div').hide();
                $('.managingCommitteeResolution-div').show();
                $("#vtcName_1").attr("readonly", false).val('');
            } else {
                $('.vtcCode-div').show();
                $('.managingCommitteeResolution-div').hide();
                $('#vtcName_1').attr('readonly', true);
            }
        });

        $(document).on('blur', '#vtcCode_1', function() {

            var vtcCode = $(this).val();
            if (vtcCode != '') {
                Swal.fire({
                    title: 'Please wait a moment!',
                    html: 'We\'ll collecting the data.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();

                        setTimeout(function() {

                            $.ajax({
                                    url: "online_app/inst/vtc/affiliation/getVtcName/" + vtcCode,
                                    type: 'GET',
                                    dataType: "json",
                                })
                                .done(function(res) {
                                    if (res != '') {
                                        $('#vtcName_1').val(res);
                                        Swal.close();
                                    } else {
                                        $('#vtcCode_1').val('');
                                        $('#vtcName_1').val('');
                                        Swal.fire('Warning!', 'You are not Affiliated, Please contact Council Administration.', 'warning');
                                    }
                                })
                                .fail(function(res) {
                                    $('#vtcName_1').val('');
                                    $('#vtcCode_1').val('');
                                    Swal.fire('Warning!', 'Oops! VTC Code not found.', 'warning');
                                });

                        }, 100);
                    }
                });
            }
        });

        $(document).on('change', '#vtc_type_id_1', function() {
            if ($(this).val() == 'Other') {
                $('.other-type-div').show();
            } else {
                $('.other-type-div').hide();
            }
        });

        $(document).on('change', '#medium_of_instruction_1', function() {
            if ($(this).val() == 'Other') {
                $('.other-medium-div').show();
            } else {
                $('.other-medium-div').hide();
            }
        });

        $(document).on('change', '#district_1', function() {
            var district = $(this).val();

            $.ajax({
                    url: "online_app/inst/vtc/affiliation/getSubDivision/" + district,
                    dataType: "JSON",
                })
                .done(function(res) {
                    $('#subDivision_1').html(res.subDivisionHtml);
                    $('#nodal_id_fk_1').html(res.nodalOfficerHtml);
                })
                .fail(function() {
                    console.log('error');
                });
        });

        $(document).on('change', '#subDivision_1', function() {
            var subDivision = $(this).val();

            $.ajax({
                    url: "online_app/inst/vtc/affiliation/getMunicipality/" + subDivision,
                    dataType: "JSON",
                })
                .done(function(res) {
                    $('#municipality_1').html(res);
                })
                .fail(function() {
                    console.log('error');
                });
        })

        $(document).on('keyup', '#numberOfExistingVtc_1', function() {

            var numberOfVtc = parseInt($(this).val());

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "online_app/inst/vtc/affiliation/getExistingVtcBlock/" + numberOfVtc,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                $('.existing-vtc-block').html(res);
                                $('.select2').select2();
                                Swal.close();
                            })
                            .fail(function(res) {
                                $('.existing-vtc-block').html('');
                                Swal.fire('Warning!', 'Oops! Not able to get VTC data.', 'warning');
                            });

                    }, 100);
                }
            });

        });

        $(document).on('change', '.vocationalCoursesbyExistingActiveVtc', function() {

            var vtcCourse = $(this).val();

            var select = $(this).closest('.row').find('.groupCodebyExistingActiveVtc');

            Swal.fire({
                title: 'Please wait a moment!',
                html: 'We\'ll collecting the data.',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();

                    setTimeout(function() {

                        $.ajax({
                                url: "online_app/inst/vtc/affiliation/getVtcGroupTradeCode/" + vtcCourse,
                                type: 'GET',
                                dataType: "json",
                            })
                            .done(function(res) {
                                select.html(res);
                                // $('.select2').select2();
                                Swal.close();
                            })
                            .fail(function(res) {
                                Swal.fire('Warning!', 'Oops! Not able to get Group/Trade data.', 'warning');
                            });

                    }, 100);
                }
            });

        });
    });

    // Added by Moli
    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });

    $(document).on('change', '#inst_category_1', function(){
        var category = $(this).val();
        // alert(category);
        if(category == 4){
            $('.private_nodal').show();
            $('.non_private_nodal').hide();
        }else{
            $('.private_nodal').hide();
            $('.non_private_nodal').show();
        }

    });
    $('.spl_category').hide();
    $(document).on('change', '#inst_spl_category_1', function(){
       
        var institute_category = $(this).val();
        //alert(institute_category);
        //console.log('hii');
        if(institute_category == 1){
            $('.spl_category').show();
               
        // alert(spl_category);
        $(document).on('change', '#spl_category_1', function(){
            var spl_category = $(this).val();
        if(spl_category == 1){
            $('.splCategoryDoc').hide();
            $('.disability_div').hide();
            $('.disadvantageGroupDiv').hide();
            
        }else if(spl_category == 2){
            $('.disability_div').show();
            $('.splCategoryDoc').show();
            $('.disadvantageGroupDiv').hide();
            
        }else if(spl_category == 3){
            $('.disability_div').hide();
            $('.splCategoryDoc').show();
            $('.disadvantageGroupDiv').show();
        }else{
            $('.splCategoryDoc').show();
            $('.disability_div').hide();
            $('.disadvantageGroupDiv').hide();
        }
    });
}else {
    $('.spl_category').hide();
             $('.disability_div').hide();
            $('.disadvantageGroupDiv').hide();
            $('.splCategoryDoc').hide();
        }

    });
</script>