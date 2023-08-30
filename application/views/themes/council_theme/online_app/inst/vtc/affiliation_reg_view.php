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
                    <h2 class="breadcrumb-title">Institute LOGIN</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Institute</a></li>
                        <li class="breadcrumb-item active">Affiliation Apply / Renewal</li>
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
            <strong>
                Institute Affiliation / Renewal Portal Registration For
                <span style="color: #fd7e14;">
                    <?php //echo date('Y'); ?><?php //echo date('y', strtotime(date('Y') . "+ 1 year")); ?>
                    <?php echo $this->config->item('current_academic_year'); ?>
                </span>
            </strong>
        </h4>
        <hr>
        <div class="card border-primary mb-3">
            <div class="card-header">Institute Affiliation Apply / Renewal</div>
            <div class="card-body text-dark">
                <?php echo form_open_multipart('online_app/inst/vtc/affiliation/registration') ?>
                <div class="row">


                    <div class="col-md-4"><label for="registration_for">
            
                        <strong>Registration For</strong><span class="text-danger">*</span></label>
                    
                        <select name="registration_for" id="registration_for" class="form-control">
                            <option value="" hidden="true">Select Anyone</option>
                            <option value="1" <?php echo set_select('registration_for', '1'); ?>>VTC/STTC Registration</option>
                            <option value="2" <?php echo set_select('registration_for', '2'); ?>>Polytechnic Registration</option>
                        </select>
                        <?php echo form_error('registration_for'); ?>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtc_type">Select Institute Type <span class="text-danger">*</span></label>
                            <select name="vtc_type" id="vtc_type" class="form-control">
                                <option value="" hidden="true">Select Institute Type</option>
                                <!-- <option value="1" <?php echo set_select('vtc_type', 1); ?>>New VTC Apply Affiliation</option> -->
                                <option value="2" <?php echo set_select('vtc_type', 2); ?>>Existing Institute Renewal Affiliation</option>
                            </select>
                            <?php echo form_error('vtc_type'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 vtcCode-div" <?php if ((set_value('vtc_type') == 1) || (set_value('vtc_type') == NULL)) echo 'style="display: none;"'; ?>>
                        <div class="form-group">
                            <label for="vtcCode">Institute Code <span class="text-danger">*</span></label>
                            <input id="vtcCode" name="vtcCode" class="form-control" type="text" value="<?php echo set_value('vtcCode'); ?>">
                            <?php echo form_error('vtcCode'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcName">Institute Name <span class="text-danger">*</span></label>
                            <input id="vtcName" name="vtcName" class="form-control" type="text" value="<?php echo set_value('vtcName'); ?>" <?php if (set_value('vtc_type') == 2) echo 'readonly="true"'; ?>>
                            <?php echo form_error('vtcName'); ?>
                        </div>
                    </div>


                    <!-- By Moli -->

                    <div class="col-md-4 aishe_code_div" <?php if ((set_value('registration_for') == 1) || (set_value('registration_for') == NULL)) {echo 'style="display: none;"';}else{echo 'style="display: block;"';} ?>>
                        <div class="form-group">
                            <label for="aishe_code">AISHE Code <span class="text-danger">*</span></label>
                            <input id="aishe_code" name="aishe_code" class="form-control" type="text" value="<?php echo set_value('aishe_code'); ?>">
                            <?php echo form_error('aishe_code'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtcEmail">Institute email <span class="text-danger">*</span></label>
                            <small><i>Login credentials will be send to Institute email.</i></small>
                            <input id="vtcEmail" name="vtcEmail" class="form-control" type="text" value="<?php echo set_value('vtcEmail'); ?>">
                            <?php echo form_error('vtcEmail'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hoiName">HOI name <span class="text-danger">*</span></label>
                            <input id="hoiName" name="hoiName" class="form-control" type="text" value="<?php echo set_value('hoiName'); ?>">
                            <?php echo form_error('hoiName'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hoiDesignation">HOI Designation <span class="text-danger">*</span></label>
                            <!-- <input id="hoiDesignation" name="hoiDesignation" class="form-control" type="text" value="<?php echo set_value('hoiDesignation'); ?>"> -->
                            <select name="hoiDesignation" id="hoiDesignation" class="form-control">
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
                            <label for="hoiEmail">HOI email <span class="text-danger">*</span></label>
                            <input id="hoiEmail" name="hoiEmail" class="form-control" type="text" value="<?php echo set_value('hoiEmail'); ?>">
                            <?php echo form_error('hoiEmail'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hoiMobileNo">HOI Mobile No. <span class="text-danger">*</span></label>
                            <small><i>OTP will be send to HOI Mobile No.</i></small>
                            <input type="number" id="hoiMobileNo" name="hoiMobileNo" class="form-control" value="<?php echo set_value('hoiMobileNo'); ?>">
                            <?php echo form_error('hoiMobileNo'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="vtc_type_id">Type <span class="text-danger">*</span></label>
                            <select name="vtc_type_id" id="vtc_type_id" class="form-control">
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
                            <label for="other_type">Enter Type <span class="text-danger">*</span></label>
                            <input id="other_type" name="other_type" class="form-control" type="text" value="<?php echo set_value('other_type'); ?>">
                            <?php echo form_error('other_type'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="medium_of_instruction">Medium of Instruction <span class="text-danger">*</span></label>
                            <select name="medium_of_instruction" id="medium_of_instruction" class="form-control">
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
                            <label for="other_medium">Enter Medium of Instruction <span class="text-danger">*</span></label>
                            <input id="other_medium" name="other_medium" class="form-control" type="text" value="<?php echo set_value('other_medium'); ?>">
                            <?php echo form_error('other_medium'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inst_category">Institute Category <span class="text-danger">*</span></label>
                            <select name="inst_category" id="inst_category" class="form-control">
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
                                        Browse&hellip;<input type="file" style="display: none;" name="category_doc" id="category_doc">
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
                            <label for="spl_category"> Does the institute fall under special category ? <span class="text-danger">*</span></label>
                            <select name="spl_category" id="spl_category" class="form-control">
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
                            <label for="disability">Type of disability <span class="text-danger">*</span></label>
                            <select name="disability" id="disability" class="form-control">
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
                            <label for="disadvantage_group">Type of disadvantage group <span class="text-danger">*</span></label>
                            <select name="disadvantage_group" id="disadvantage_group" class="form-control">
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
                                        Browse&hellip;<input type="file" style="display: none;" name="spl_category_doc" id="spl_category_doc">
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
                            <label for="district">District <span class="text-danger">*</span></label>
                            <select name="district" id="district" class="form-control">
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
                            <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                            <select name="subDivision" id="subDivision" class="form-control">
                                <option value="" hidden="true">Select Sub Division</option>
                                <option value="" disabled="true">Select District first...</option>
                            </select>
                            <?php echo form_error('subDivision'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="municipality">Municipality </label>
                            <select name="municipality" id="municipality" class="form-control">
                                <option value="" hidden="true">Select Municipality</option>
                                <option value="" disabled="true">Select Sub Division first...</option>
                            </select>
                            <?php echo form_error('municipality'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="panchayat">Panchayat</label>
                            <input id="panchayat" name="panchayat" class="form-control" type="text" value="<?php echo set_value('panchayat'); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="policeStation">Police Station <span class="text-danger">*</span></label>
                            <input id="policeStation" name="policeStation" class="form-control" type="text" value="<?php echo set_value('policeStation'); ?>">
                            <?php echo form_error('policeStation'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pinCode">Pin Code <span class="text-danger">*</span></label>
                            <input id="pinCode" name="pinCode" class="form-control" type="text" value="<?php echo set_value('pinCode'); ?>">
                            <?php echo form_error('pinCode'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phoneNo">Inst. Phone no – (Land line)</label>
                            <input id="phoneNo" name="phoneNo" class="form-control" type="number" value="<?php echo set_value('phoneNo'); ?>">
                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label for="nodal_id_fk">Select Nodal <span class="text-danger">*</span></label>
                            <select name="nodal_id_fk" id="nodal_id_fk" class="form-control">
                                <option value="" hidden="true">Select Nodal</option>
                                <option value="" disabled="true">Select District first...</option>
                            </select>
                            <?php echo form_error('nodal_id_fk'); ?>
                        </div>
                    </div> -->
                    

                    
                </div>
                


                <!-- Modify by moli on 13-01-2013 -->
                <div class = "vtcAffiliationDiv" <?php if ((set_value('registration_for') != 1) || (set_value('guardian_relation') == NULL)) echo 'style="display: none;"'; ?>>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group non_private_nodal" <?php if (set_value('inst_category') == 4 || set_value('inst_category') == '') echo 'style="display: none;"'; ?>>
                                <label for="nodal_id_fk">Select Nodal <span class="text-danger">*</span></label>
                                <select name="nodal_id_fk" id="nodal_id_fk" class="form-control">
                                    <option value="" hidden="true">Select Nodal</option>
                                    <option value="" disabled="true">Select District first...</option>
                                </select>
                                <?php echo form_error('nodal_id_fk'); ?>
                            </div>

                            <div class="form-group private_nodal" <?php if (set_value('inst_category') != 4 || set_value('inst_category') == '') echo 'style="display: none;"'; ?>>
                                <label for="private_nodal_id">Select Nodal<span class="text-danger">*</span></label>
                                <select name="private_nodal_id"  class="form-control">
                                    <option value="" hidden="true">Select Nodal</option>
                                    <option value="999" selected="true">WBSCT &amp; VE &amp; SD</option>
                                </select>
                                <?php echo form_error('private_nodal_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <span>
                                Is there any change in name and/or address of school since last renewal of affiliation (yes/no)
                                <span class="text-danger">*</span>
                                <?php echo form_error('changeInNameAddress'); ?>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="changeInNameAddress" value="1" <?php echo set_radio('changeInNameAddress', 1) ?>> Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="changeInNameAddress" value="0" <?php echo set_radio('changeInNameAddress', 0) ?>> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row approvalFromCouncil-div" <?php if (set_value('changeInNameAddress') != 1) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>Has approval been obtained from council( yes/no) <span class="text-danger">*</span></span>
                            <?php echo form_error('approvalFromCouncil'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="approvalFromCouncil" value="1" <?php echo set_radio('approvalFromCouncil', 1) ?>> Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="approvalFromCouncil" value="0" <?php echo set_radio('approvalFromCouncil', 0) ?>> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row councilApprovalLetter-div" <?php if (set_value('approvalFromCouncil') != 1) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>upload council approval letter <span class="text-danger">*</span></span>
                            <?php echo form_error('councilApprovalLetter'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <input type="file" id="councilApprovalLetter" name="councilApprovalLetter" class="form-control">
                                <small>(upload scan copy – pdf 100 KB)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row documentRegardingChangeOfName-div" <?php if (set_value('changeInNameAddress') != 1) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>
                                Upload relevant document regarding change of name. (Council will approve upon receiving hard copy of application)
                                <span class="text-danger">*</span>
                            </span>
                            <?php echo form_error('documentRegardingChangeOfName'); ?>
                        </div>
                        <div class="col-md-4 mb-3 mb-3">
                            <div class="form-group">
                                <input type="file" id="documentRegardingChangeOfName" name="documentRegardingChangeOfName" class="form-control">
                                <small>(upload scan copy – pdf 100 KB)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <span>Does the school have Higher Secondary or equivalent in regular section ( yes/no) <span class="text-danger">*</span></span>
                            <?php echo form_error('schoolHaveHigherSecondaryEquivalent'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolHaveHigherSecondaryEquivalent" value="1" <?php echo set_radio('schoolHaveHigherSecondaryEquivalent', 1) ?>> Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolHaveHigherSecondaryEquivalent" value="0" <?php echo set_radio('schoolHaveHigherSecondaryEquivalent', 0) ?>> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row hse-div" <?php if ((set_value('schoolHaveHigherSecondaryEquivalent') == 0) && (set_value('schoolHaveHigherSecondaryEquivalent') != NULL)) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>Does the school have Higher Secondary Science (Mathematics) in regular section ( yes/no) <span class="text-danger">*</span></span>
                            <?php echo form_error('schoolHaveHigherSecondaryScience'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolHaveHigherSecondaryScience" value="1" <?php echo set_radio('schoolHaveHigherSecondaryScience', 1) ?>> Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolHaveHigherSecondaryScience" value="0" <?php echo set_radio('schoolHaveHigherSecondaryScience', 0) ?>> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row hse-div" <?php if ((set_value('schoolHaveHigherSecondaryEquivalent') == 0) && (set_value('schoolHaveHigherSecondaryEquivalent') != NULL)) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>Does the school have Higher Secondary Science (Biology) in regular section ( yes/no) <span class="text-danger">*</span></span>
                            <?php echo form_error('schoolTeachBiology'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolTeachBiology" value="1" <?php echo set_radio('schoolTeachBiology', 1) ?>> Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolTeachBiology" value="0" <?php echo set_radio('schoolTeachBiology', 0) ?>> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row hse-div" <?php if ((set_value('schoolHaveHigherSecondaryEquivalent') == 0) && (set_value('schoolHaveHigherSecondaryEquivalent') != NULL)) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>Does the school have Higher Secondary Commerce in regular section ( yes/no) <span class="text-danger">*</span></span>
                            <?php echo form_error('schoolTeachCommerce'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolTeachCommerce" value="1" <?php echo set_radio('schoolTeachCommerce', 1) ?>> Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="schoolTeachCommerce" value="0" <?php echo set_radio('schoolTeachCommerce', 0) ?>> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row managingCommitteeResolution-div" <?php if (set_value('vtc_type') != 1) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>
                                Upload managing committee resolution approving start of vocational courses
                                <span class="text-danger">*</span>
                                <?php echo form_error('managingCommitteeResolution'); ?>
                            </span>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <input type="file" id="managingCommitteeResolution" name="managingCommitteeResolution" class="form-control">
                                <small>(upload scan copy – pdf 100 KB)</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <span>Is there any nearby existing VTC within 2 km of your institute ( yes/no) <span class="text-danger">*</span></span>
                            <?php echo form_error('nearbyExistingVtc'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="nearbyExistingVtc" value="1" <?php echo set_radio('nearbyExistingVtc', 1) ?>> Yes
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="nearbyExistingVtc" value="0" <?php echo set_radio('nearbyExistingVtc', 0) ?>> No
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row numberOfExistingVtc-div" <?php if (set_value('nearbyExistingVtc') != 1) echo 'style="display: none;"'; ?>>
                        <div class="col-md-8">
                            <span>Number of nearby existing active VTC within 2 km of your institute <span class="text-danger">*</span></span>
                            <?php echo form_error('numberOfExistingVtc'); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <input id="numberOfExistingVtc" name="numberOfExistingVtc" class="form-control" type="number" value="">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="existing-vtc-block"></div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <label>&nbsp;</label>
                        <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Submit for registration</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>

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

        $(document).on('change', '#vtc_type', function() {
            if ($(this).val() == 1) {
                $('.vtcCode-div').hide();
                $('.managingCommitteeResolution-div').show();
                $("#vtcName").attr("readonly", false).val('');
            } else {
                $('.vtcCode-div').show();
                $('.managingCommitteeResolution-div').hide();
                $('#vtcName').attr('readonly', true);
            }
        });

        $(document).on('blur', '#vtcCode', function() {

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
                                        $('#vtcName').val(res);
                                        Swal.close();
                                    } else {
                                        $('#vtcCode').val('');
                                        $('#vtcName').val('');
                                        Swal.fire('Warning!', 'You are not Affiliated, Please contact Council Administration.', 'warning');
                                    }
                                })
                                .fail(function(res) {
                                    $('#vtcName').val('');
                                    $('#vtcCode').val('');
                                    Swal.fire('Warning!', 'Oops! VTC Code not found.', 'warning');
                                });

                        }, 100);
                    }
                });
            }
        });

        $(document).on('change', '#vtc_type_id', function() {
            if ($(this).val() == 'Other') {
                $('.other-type-div').show();
            } else {
                $('.other-type-div').hide();
            }
        });

        $(document).on('change', '#medium_of_instruction', function() {
            if ($(this).val() == 'Other') {
                $('.other-medium-div').show();
            } else {
                $('.other-medium-div').hide();
            }
        });

        $(document).on('change', '#district', function() {
            var district = $(this).val();

            $.ajax({
                    url: "online_app/inst/vtc/affiliation/getSubDivision/" + district,
                    dataType: "JSON",
                })
                .done(function(res) {
                    $('#subDivision').html(res.subDivisionHtml);
                    $('#nodal_id_fk').html(res.nodalOfficerHtml);
                })
                .fail(function() {
                    console.log('error');
                });
        });

        $(document).on('change', '#subDivision', function() {
            var subDivision = $(this).val();

            $.ajax({
                    url: "online_app/inst/vtc/affiliation/getMunicipality/" + subDivision,
                    dataType: "JSON",
                })
                .done(function(res) {
                    $('#municipality').html(res);
                })
                .fail(function() {
                    console.log('error');
                });
        })

        $(document).on('keyup', '#numberOfExistingVtc', function() {

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

    $(document).on('change', '#inst_category', function(){
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

    $(document).on('change', '#spl_category', function(){
        var spl_category = $(this).val();
        // alert(spl_category);
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

    // Moli on 13-01-2023
    $(document).on('change', '#registration_for', function(){
        
        var registration_for = $(this).val();
        // alert(registration_for);
        //console.log('hii');
        if(registration_for == 1){
            $('.vtcAffiliationDiv').show();
            $('.aishe_code_div').hide();
        }else {
            $('.vtcAffiliationDiv').hide();
            $('.aishe_code_div').show();
        }
               
    });
</script>