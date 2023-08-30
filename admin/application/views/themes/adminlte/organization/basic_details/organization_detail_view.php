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

    .content-block {
        border: 4px solid #43A047;
        border-radius: 10px;
        border-top: none;
        border-bottom: none;
        padding: 5px 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        background-color: #ECEFF1;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Organization Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="cssvse/student"><i class="fa fa-list"></i> Details</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Organization Profile</li>
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
                <h3 class="box-title"><i class="fa fa-user-plus" aria-hidden="true"></i> Organization Profile</h3><br>
				<h4><span class="text-danger"></span></h4>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                <?php echo form_open_multipart("admin/organization/organization_details",array('onsubmit' => "$('#loading').show();")); ?>
                    <div id="loading" style="display:none">Uploading...</div>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vtcCode">Organaization Name <span class="text-danger">*</span></label>
                                <input id="vtcCode" name="vtcCode" class="form-control" type="text" value="<?php echo $org_details['organization_name']; ?>" readonly>
                                <?php echo form_error('vtcCode'); ?>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="vtcName">Othorize Person <span class="text-danger">*</span></label>
                                <input id="vtcName" name="vtcName" class="form-control" type="text" value="<?php echo $school_data['vtc_name']; ?>" readonly>
                                <?php echo form_error('vtcName'); ?>
                            </div>
                        </div> -->
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Organaization Email <span class="text-danger">*</span></label>
                                <input id="email" name="email" class="form-control" type="email" value="<?php echo $org_details['email']; ?>" readonly>
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile_no">Organaization Mobile <span class="text-danger">*</span></label>
                                <input id="mobile_no" name="mobile_no" class="form-control" type="number" value="<?php echo $org_details['mobile_no']; ?>" readonly>
                                <?php echo form_error('mobile_no'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile_no">Vertical Code <span class="text-danger">*</span></label>
                                <input id="mobile_no" name="mobile_no" class="form-control" type="text" value="<?php echo $org_details['vertical_code']; ?>" readonly>
                                <?php echo form_error('mobile_no'); ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="oth_person">Othorize Person <span class="text-danger">*</span></label>
                                <input id="oth_person" name="oth_person" class="form-control" type="text" value="<?php echo $form_data['oath_name']; ?>">
                                <?php echo form_error('oth_person'); ?>
                            </div>
                        </div>
                        
                        
                    </div>


                    <h4><i class="fa fa-circle-o text-orange"></i> <strong>Contact Details:</strong></h4>
                    <div class="content-block">
                        <div class="row">
                            

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="house_no">House/Premise No <span class="text-danger">*</span></label>
                                    <input type="text" value="<?php echo $form_data['house_no']; ?>" name="house_no" id="house_no" class="form-control"  placeholder="House/Premise No">
                                    <?php echo form_error('house_no'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="designation">Street/Village/Town <span class="text-danger">*</span></label>
                                    <input type="text" value="<?php echo $form_data['street_vill_town']; ?>" name="street_vill_town" id="street_vill_town" class="form-control"  placeholder="Street/Village/Town">
                                    <?php echo form_error('street_vill_town'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="designation">Post Office <span class="text-danger">*</span></label>
                                    <input type="text" value="<?php echo $form_data['post_office']; ?>" name="po" id="po" class="form-control"  placeholder="Post Office">
                                    <?php echo form_error('po'); ?>
                                </div>
                            </div>

                    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="police_station">Police Station <span class="text-danger">*</span></label>
                                    <input type="text" value="<?php echo $form_data['police_station']; ?>" name="police_station" id="police_station" class="form-control"  placeholder="Police Station">
                                    <?php echo form_error('police_station'); ?>
                                </div>
                            </div>
                        

                        
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state">State <span class="text-danger">*</span></label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="" hidden="true">Select state</option>
                                        <?php foreach ($stateList as $key => $value) { ?>
                                            <option value="<?php echo $value['state_id_pk']; ?>" <?php if ($form_data['state'] == $value['state_id_pk']) echo 'selected'; ?>>
                                                <?php echo $value['state_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('state'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="district">District <span class="text-danger">*</span></label>
                                    <select name="district" id="district" class="form-control">
                                        <?php if (count($district)) { ?>
                                            <?php foreach ($district as $key => $value) { ?>
                                                <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($form_data['district'] == $value['district_id_pk']) echo 'selected'; ?>>
                                                    <?php echo $value['district_name']; ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="" disabled>No Data Found...</option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('district'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 other_state_div" <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                                

                                <div class="form-group ">
                                    <label for="subDivision">Select Sub Division <span class="text-danger">*</span></label>
                                    <select name="subDivision" id="subDivision" class="form-control">
                                        <option value="" hidden="true">Select Sub Division</option>
                                        <?php if (count($subDivision)) { ?>
                                            <?php foreach ($subDivision as $key => $value) { ?>
                                                <option value="<?php echo $value['subdiv_id_pk']; ?>" <?php if ($form_data['sub_division_id_fk'] == $value['subdiv_id_pk']) echo 'selected'; ?>>
                                                    <?php echo $value['subdiv_name']; ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="" disabled>No Data Found...</option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('subDivision'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 other_state_div" <?php if ((set_value('state') != 19)) echo 'style="display: none;"'; ?>>
                                

                                <div class="form-group">
                                    <label for="municipality">Municipality / Block </label>
                                    <select name="municipality" id="municipality" class="form-control">
                                        <option value="" hidden="true">Select Municipality / Block</option>
                                        <?php if (count($municipality)) { ?>
                                            <?php foreach ($municipality as $key => $value) { ?>
                                                <option value="<?php echo $value['block_municipality_id_pk']; ?>" <?php if ($form_data['municipality_id_fk'] == $value['block_municipality_id_pk']) echo 'selected'; ?>>
                                                    <?php echo $value['block_municipality_name']; ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="" disabled>No Data Found...</option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('municipality'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pinCode">Pin Code <span class="text-danger">*</span></label>
                                    <input id="pinCode" name="pinCode" class="form-control" type="text" value="<?php echo $form_data['pin_code']; ?>">
                                    <?php echo form_error('pinCode'); ?>
                                </div>
                            </div>
                        

                        
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="landline_no">Landline No</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                        </div>
                                        <input class="form-control pull-left"  type="number" value="<?php echo $form_data['landline_no']; ?>" name="landline_no" id="landline_no" placeholder="Landline No">
                                    </div>
                                    <?php echo form_error('landline_no'); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="mobile">Mobile No <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-mobile"></i>
                                        </div>
                                        <input class="form-control pull-left"  type="number" value="<?php echo $form_data['mobile']; ?>" name="mobile" id="mobile" placeholder="Mobile No">
                                    </div>
                                    <?php echo form_error('mobile'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fax_no">Fax no </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-fax"></i>
                                        </div>
                                        <input class="form-control pull-left"  type="text" value="<?php echo $form_data['fax_no']; ?>" name="fax_no" id="fax_no" placeholder="Fax No">
                                    </div>
                                    <?php echo form_error('fax_no'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="email_id">Email ID <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope icon"></i>
                                        </div>
                                        <input class="form-control pull-left"  type="email" value="<?php echo $form_data['email']; ?>" name="email_id" id="email_id" placeholder="Email ID">
                                    </div>
                                    <?php echo form_error('email_id'); ?>
                                </div>
                            </div>
                        
                        
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="url">Website URL</label>
                                    <input id="url" name="url" class="form-control" type="text" value="<?php echo $form_data['web_url']; ?>" placeholder="Website URL">
                                    <?php echo form_error('url'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lat">Latitutde <span class="text-danger">*</span></label>
                                    <input id="lat" name="lat" class="form-control" type="number" value="<?php echo $form_data['latitude']; ?>" placeholder="Latitutde">
                                    <?php echo form_error('lat'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="long">Longitude <span class="text-danger">*</span></label>
                                    <input id="long" name="long" class="form-control" type="number" value="<?php echo $form_data['longititude']; ?>" placeholder="Longitude">
                                    <?php echo form_error('long'); ?>
                                </div>
                            </div>

                        </div>
                        
                    
                    </div>

                    <hr>
                    <h4><i class="fa fa-circle-o text-orange"></i> <strong>SPOC Details:</strong></h4>
                    <div class="content-block">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="spoc_name">SPOC Name <span class="text-danger">*</span></label>
                                    <input id="spoc_name" name="spoc_name" class="form-control" type="text" placeholder="SPOC Name" value="<?php echo $form_data['spoc_name']; ?>" placeholder="SPOC Name">
                                    <?php echo form_error('spoc_name'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="spoc_mobile">SPOC Mobile No <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-mobile"></i>
                                        </div>
                                        <input class="form-control pull-left"  type="number" value="<?php echo $form_data['spoc_mobile']; ?>" name="spoc_mobile" id="spoc_mobile" placeholder="SPOC Mobile No">
                                    </div>
                                    <?php echo form_error('spoc_mobile'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="spoc_email">SPOC Email ID <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope icon"></i>
                                        </div>
                                        <input class="form-control pull-left"  type="email" value="<?php echo $form_data['spoc_email']; ?>" name="spoc_email" id="spoc_email" placeholder="SPOC Email ID">
                                    </div>
                                    <?php echo form_error('spoc_email'); ?>
                                </div>
                            </div>
                        </div>

                    
                    </div>
                    

                    
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <button id="submit" type="submit" value="submit" class="btn btn-info btn-block">Update Details</button>
                            
                        </div>
                    </div>
                <?php echo form_close() ?>
                
            </div>

        </div>
    </section>
</div>


<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>