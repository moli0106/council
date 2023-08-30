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
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Basic Details</h3>

                <div class="box-tools pull-right">
                    <?php if (!empty($formData['hoi_mobile_no'])) { ?>
                        <!-- <button class="btn btn-danger btn-sm changeMobNo"  data-toggle="modal" data-target="#modalChangeMobNo">Change HOI Mobile No</button> -->
                    <?php } ?>
                </div>
            </div>
            
            <div class="box-body">
                <center>

                    <span class="text-danger"><b>*** Please choose institute catagory, update basic detail for 2022-23, AND THEN ONLY try change HOI Mobile no, if needed ***</b></span> <br><br><br>
                </center>
                <?php echo form_open_multipart('admin/affiliation/details') ?>

                <input type="hidden" name="vtc_details_id" id="vtc_details_id" value="<?php echo $formData['vtc_details_id']; ?>">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vtc_code">VTC Code <span class="text-danger">*</span></label>
                            <input name="vtc_code" class="form-control" value="<?php echo $formData['vtc_code']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vtc_name">VTC Name <span class="text-danger">*</span></label>
                            <input name="vtc_name" class="form-control" value="<?php echo $formData['vtc_name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vtc_email">VTC email <span class="text-danger">*</span></label>
                            <input name="vtc_email" id="vtc_email" class="form-control" value="<?php echo $formData['vtc_email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hoi_mobile_no">HOI Mobile No. <span class="text-danger">*</span>
                                <button type="button" id="changeHoiMobileNoBtn" class="btn btn-xs btn-flat bg-maroon pull-right">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> Change Mobile No.
                                </button>
                        
                            </label>
                            <input name="hoi_mobile_no" class="form-control" value="<?php echo $formData['hoi_mobile_no']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hoi_name">HOI name <span class="text-danger">*</span></label>
                            <input id="hoi_name" name="hoi_name" class="form-control" type="text" value="<?php echo $formData['hoi_name']; ?>">
                            <?php echo form_error('hoi_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hoi_designation">HOI Designation <span class="text-danger">*</span></label>
                            <!-- <input id="hoi_designation" name="hoi_designation" class="form-control" type="text" value="<?php echo $formData['hoi_designation']; ?>"> -->
                            <select name="hoi_designation" id="hoiDesignation" class="form-control">
                                <option value="" hidden="true">Select HOI Designation</option>
                                <?php foreach ($hoi_designation as $key => $value) { ?>
                                    <option value="<?php echo $value['hoi_designation_id_pk']; ?>" <?php if($value['hoi_designation_id_pk'] == $formData['hoi_designation']){echo 'selected';} ?>>
                                        <?php echo $value['designation_name']; ?>
                                    </option>
                                <?php } ?>
                                
                            </select>
                            <?php echo form_error('hoi_designation'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hoi_email">HOI email <span class="text-danger">*</span></label>
                            <input id="hoi_email" name="hoi_email" class="form-control" type="text" value="<?php echo $formData['hoi_email']; ?>">
                            <?php echo form_error('hoi_email'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vtc_type_id">Type <span class="text-danger">*</span></label>
                            <select name="vtc_type_id_fk" id="vtc_type_id" class="form-control">
                                <option value="" hidden="true">Select Type</option>
                                <?php foreach ($vtcTypeList as $key => $value) { ?>
                                    <option value="<?php echo $value['vtc_type_id_pk']; ?>" <?php if ($formData['vtc_type_id_fk'] == $value['vtc_type_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['vtc_type_name']; ?>
                                    </option>
                                <?php } ?>
                                <option value="Other" <?php if ($formData['vtc_type_id_fk'] == NULL) echo 'selected'; ?>>Other</option>
                            </select>
                            <?php echo form_error('vtc_type_id_fk'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 other-type-div" <?php if ($formData['vtc_type_id_fk'] != NULL) echo 'style="display: none;"'; ?>>
                        <div class="form-group">
                            <label for="other_type">Enter Type <span class="text-danger">*</span></label>
                            <input id="other_type" name="other_type" class="form-control" type="text" value="<?php echo $formData['other_type']; ?>">
                            <?php echo form_error('other_type'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="medium_of_instruction">Medium of Instruction <span class="text-danger">*</span></label>
                            <select name="medium_id_fk" id="medium_of_instruction" class="form-control">
                                <option value="" hidden="true">Select Medium of Instruction</option>
                                <?php foreach ($mediumList as $key => $value) { ?>
                                    <option value="<?php echo $value['medium_of_instruction_id_pk']; ?>" <?php if ($formData['medium_id_fk'] == $value['medium_of_instruction_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['medium_of_instruction']; ?>
                                    </option>
                                <?php } ?>
                                <option value="Other" <?php if ($formData['medium_id_fk'] == NULL) echo 'selected'; ?>>Other</option>
                            </select>
                            <?php echo form_error('medium_id_fk'); ?>
                        </div>
                    </div>
                    <div class="col-md-3 other-medium-div" <?php if ($formData['medium_id_fk'] != NULL) echo 'style="display: none;"'; ?>>
                        <div class="form-group">
                            <label for="other_medium">Enter Medium of Instruction <span class="text-danger">*</span></label>
                            <input id="other_medium" name="other_medium" class="form-control" type="text" value="<?php echo $formData['other_medium']; ?>">
                            <?php echo form_error('other_medium'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="inst_category">Institute Category <span class="text-danger">*</span></label>
                            <select name="inst_category" id="inst_category" class="form-control">
                                <option value="" hidden="true">Select Institute Category</option>
                                <?php foreach ($institute_category as $key => $value) { ?>
                                    <option value="<?php echo $value['institute_category_id_pk']; ?>" <?php if ($formData['inst_category'] == $value['institute_category_id_pk']) echo 'selected'; ?>>
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
                                <?php if($institute_category_doc !='') {?>
                                        <a href="<?php echo base_url('admin/affiliation/details/showCategoryDoc/' . $formData['vtc_details_id']); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    <?php }?>
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
                                
                                <option value="1" <?php if ($formData['special_category'] == 1) echo 'selected'; ?>>Not a special category institute</option>
                                <option value="2" <?php if ($formData['special_category'] == 2) echo 'selected'; ?>>Provide training ONLY to Persons with special needs</option>
                                <option value="3" <?php if ($formData['special_category'] == 3) echo 'selected'; ?>>Provide training ONLY to Persons under disadvantage group</option>
                                <option value="4" <?php if ($formData['special_category'] == 4) echo 'selected'; ?>>Provide training ONLY to Persons residing in Homes</option>
                                <option value="5" <?php if ($formData['special_category'] == 5) echo 'selected'; ?>>Provide training ONLY to Homeless persons staying on streets</option>
                                
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
                                    <option value="<?php echo $value['disability_id_pk']; ?>" <?php if ($formData['disability_id'] == $value['disability_id_pk']) echo 'selected'; ?>>
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
                                    <option value="<?php echo $value['disadvantage_group_id_pk']; ?>" <?php if ($formData['disadvantage_group'] == $value['disadvantage_group_id_pk']) echo 'selected'; ?>>
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
                            <label for="vtc_address">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="vtc_address" rows="3"><?php echo $formData['vtc_address']; ?></textarea>
                            <?php echo form_error('vtc_address'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="district">District <span class="text-danger">*</span></label>
                            <select name="district_id_fk" id="district" class="form-control">
                                <option value="" hidden="true">Select District</option>
                                <?php foreach ($districtList as $key => $value) { ?>
                                    <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($formData['district_id_fk'] == $value['district_id_pk']) echo 'selected'; ?>>
                                        <?php echo $value['district_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('district_id_fk'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                            <select name="sub_division_id_fk" id="subDivision" class="form-control">
                                <option value="" hidden="true">Select Sub Division</option>
                                <?php if (count($subDivision)) { ?>
                                    <?php foreach ($subDivision as $key => $value) { ?>
                                        <option value="<?php echo $value['subdiv_id_pk']; ?>" <?php if ($formData['sub_division_id_fk'] == $value['subdiv_id_pk']) echo 'selected'; ?>>
                                            <?php echo $value['subdiv_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled>No Data Found...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('sub_division_id_fk'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="municipality">Municipality </label>
                            <select name="municipality_id_fk" id="municipality" class="form-control">
                                <option value="" hidden="true">Select Municipality</option>
                                <?php if (count($municipality)) { ?>
                                    <?php foreach ($municipality as $key => $value) { ?>
                                        <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($formData['municipality_id_fk'] == $value['block_municipality_id_pk']) echo 'selected'; ?>>
                                            <?php echo $value['block_municipality_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled>No Data Found...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('municipality_id_fk'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="panchayat">Panchayat</label>
                            <input id="panchayat" name="panchayat" class="form-control" type="text" value="<?php echo $formData['panchayat']; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="police_station">Police Station <span class="text-danger">*</span></label>
                            <input id="police_station" name="police_station" class="form-control" type="text" value="<?php echo $formData['police_station']; ?>">
                            <?php echo form_error('police_station'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pin_code">Pin Code <span class="text-danger">*</span></label>
                            <input id="pin_code" name="pin_code" class="form-control" type="text" value="<?php echo $formData['pin_code']; ?>">
                            <?php echo form_error('pin_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="phone_no">Inst. Phone no – (Land line)</label>
                            <input id="phone_no" name="phone_no" class="form-control" type="number" value="<?php echo $formData['phone_no']; ?>">
                        </div>
                    </div>
                    <div class="col-md-3 non_private_nodal" <?php if ($formData['inst_category'] == 4 || $formData['inst_category'] == ''){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="nodal_id_fk">Select Nodal <span class="text-danger">*</span></label>
                            <select name="nodal_id_fk" id="nodal_id_fk" class="form-control">
                                <option value="" hidden="true">Select Nodal</option>
                                <?php if (count($nodalOfficer)) { ?>
                                    <?php foreach ($nodalOfficer as $key => $value) { ?>
                                        <option value="<?php echo $value['nodal_officer_id_pk']; ?>" <?php if ($formData['nodal_id_fk'] == $value['nodal_officer_id_pk']) echo 'selected'; ?>>
                                            <?php echo $value['nodal_centre_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled>No Data Found...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('nodal_id_fk'); ?>
                        </div>
                    </div>
                    <div class="col-md-3 private_nodal" <?php if ($formData['inst_category'] != 4 || $formData['inst_category'] == ''){echo 'style="display: none;"';}?>>

                        <div class="form-group">
                            <label for="private_nodal_id">Select Nodal <span class="text-danger">*</span></label>
                            <select name="private_nodal_id" id="private_nodal_id"  class="form-control">
                                <option value="" hidden="true">Select Nodal</option>
                               
                                <option value="999" <?php if ($formData['nodal_id_fk'] == 999) echo 'selected'; ?>>
                                WBSCT &amp; VE &amp; SD
                                </option>
                                    
                            </select>
                            <?php echo form_error('private_nodal_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-8">
                        <span>
                            Does the school have Higher Secondary or equivalent in regular section ( Yes/No)
                            <span class="text-danger">*</span>
                        </span>
                        <?php echo form_error('hs_equivalent'); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_equivalent" value="1" <?php if ($formData['hs_equivalent'] == 1) echo 'checked' ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_equivalent" value="0" <?php if (($formData['hs_equivalent'] == 0)) echo 'checked'; ?>>No
                        </label>
                    </div>
                </div>
                <div class="row hse-div" <?php if ($formData['hs_equivalent'] == 0) echo 'style="margin-top: 15px; display: none;"';
                                            else echo 'style="margin-top: 15px;"'; ?>>
                    <div class="col-md-8">
                        <span>
                            Does the school have Higher Secondary Science (Mathematics) in regular section ( Yes/No)
                            <span class="text-danger">*</span>
                        </span>
                        <?php echo form_error('hs_science'); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_science" value="1" <?php if ($formData['hs_science'] == 1) echo 'checked'; ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_science" value="0" <?php if (($formData['hs_science'] == 0) && ($formData['hs_science'] != NULL)) echo 'checked'; ?>>No
                        </label>
                    </div>
                </div>
                <div class="row hse-div" <?php if ($formData['hs_equivalent'] == 0) echo 'style="margin-top: 15px; display: none;"';
                                            else echo 'style="margin-top: 15px;"'; ?>>
                    <div class="col-md-8">
                        <span>
                            Does the school have Higher Secondary Science (Biology) in regular section ( Yes/No)
                            <span class="text-danger">*</span>
                        </span>
                        <?php echo form_error('hs_biology'); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_biology" value="1" <?php if (($formData['hs_biology'] == 1)) echo 'checked'; ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_biology" value="0" <?php if (($formData['hs_biology'] == 0) && ($formData['hs_biology'] != NULL)) echo 'checked'; ?>>No
                        </label>
                    </div>
                </div>
                <div class="row hse-div" <?php if ($formData['hs_equivalent'] == 0) echo 'style="margin-top: 15px; display: none;"';
                                            else echo 'style="margin-top: 15px;"'; ?>>
                    <div class="col-md-8">
                        <span>
                            Does the school have Higher Secondary Commerce in regular section (Y/N) ( Yes/No)
                            <span class="text-danger">*</span>
                        </span>
                        <?php echo form_error('hs_commerce'); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_commerce" value="1" <?php if ($formData['hs_commerce'] == 1) echo 'checked'; ?>>Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" <?php if (!empty($vtcCourseList)) echo 'disabled="true"'; ?> name="hs_commerce" value="0" <?php if (($formData['hs_commerce'] == 0) && ($formData['hs_commerce'] != NULL)) echo 'checked'; ?>>No
                        </label>
                    </div>
                </div>
                
                <?php if (empty($current_data) || $current_data['final_submit_status'] == 0 ) { ?>
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success btn-sm">Update Basic Details</button>
                        </div>
                    </div>
                <?php } ?>
                <?php echo form_close() ?>
            </div>
        </div>

        <!-- Show nearby VTC List -->
        <?php $this->load->view($this->config->item('theme') . 'affiliation/nearby_vtc_list_view') ?>
        <!-- Show nearby VTC List -->
    </section>


</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>


<div class="modal modal-success fade" id="modalChangeMobNo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Change HOI Mobile No</h4>
            </div>
            <div class="modal-body vtc-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).on('click', '.changeMobNo', function() {

        var id = $('#vtc_details_id').val();
        alert(id);

        var loader = '<div class="overlay"><div class="sp sp-wave"></div></div>';

        $('.vtc-data').html(loader);
        $.ajax({
                url: "affiliation/details/open_modal_for_mob_no/" + id,
                type: 'GET',
                dataType: "json",
            })
            .done(function(res) {
                $('.vtc-data').html(res);
                $('.select2').select2();
            })
            .fail(function(res) {
                $('#modalChangeMobNo').modal('toggle');
                Swal.fire('Warning!', 'Oops! Unable to get VTC details, Please try later.', 'warning');
            });

    });

    $(document).on('click', '#change_vtc_mob_no', function(e){

        var mob_no = $('#mob_no').val();
        if(mob_no ==''){
            Swal.fire('Please Enter Mobile no !')
        }else{

            var action_page = $('#mobile_data').attr('action');

            Swal.fire({
            title: 'Are you sure?',
            text: "You want to change this Mobile No!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: action_page,
                        data: $('#mobile_data').serialize(),
                    })
                    .done(function(response) {
                        
                        if(response == 'done'){

                            $('#modalChangeMobNo').modal('toggle');
                            location.reload(); 
                        }else{
                            Swal.fire('Warning!', response.msg);
                        }

                       
                    })
                    .fail(function(res) {
                        Swal.fire('Warning!', 'Oops! Unable to assigned Subject/Group, Please try again later.', 'warning');
                    });
            }
        })

        }

        
    });


    $(document).on('click', '#changeHoiMobileNoBtn', function () {
        var vtc_email = $('#vtc_email').val();
        alert(vtc_email);
        var hoiMobileNo = mobileOtp = '';

        Swal.fire({
            title: 'Please enter HOI mobile number.',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                placeholder: 'Enter Mobile Number'
            },
            showCancelButton: true,
            confirmButtonText: 'Update Number',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            preConfirm: (hoi_mobile_no) => {
                if (hoi_mobile_no == '') {
                    Swal.showValidationMessage('Request failed: Please enter HOI mobile number.');
                } else {
                    hoiMobileNo = hoi_mobile_no;
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Are you sure? Change HOI mobile No.',
                    text: "OTP will be send on VTC email [" + vtc_email + "] for verification.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: 'Please wait a moment!',
                            html: 'We\'ll updating the information.',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();

                                $.ajax({
                                    url: "affiliation/details/sendOtpForHoiMobileNoVerification",
                                    dataType: "json",
                                    data: { vtc_email: vtc_email, hoi_mobile_no: hoiMobileNo },
                                })
                                    .done(function (res) {
                                        if (res == 'invalid_movile_no') {

                                            Swal.fire('Warning!', 'Oops! Enter valid mobile number.', 'error');
                                        } else {

                                            window.location.replace(res);
                                        }
                                    })
                                    .fail(function (res) {
                                        Swal.fire('Error!', 'Oops! Something went wrong.', 'error');
                                    });
                            }
                        });
                    }
                });

            }
        });

    });

    $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

        var log = numFiles > 1 ? numFiles + ' files selected' : label;
        $(this).parents('.input-group').find(':text').val(log);
    });

    $(document).on('change', '#inst_category', function(){
        swal.fire('You are changing institute category, please upload fresh document in support of new institute category');
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
    
</script>