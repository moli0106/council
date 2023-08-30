<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <li class="active"><i class="fa fa-align-center"></i>Other Infrastructure List</li>
            <li class="active"><i class="fa fa-align-center"></i>Add</li>
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
                <h3 class="box-title">Other Infrastructure Details</h3>
            </div>
            <?php if ($vtcDetails['final_submit_status'] == 1) { ?>
            <div class="box-body">
                <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                <?php echo form_open_multipart('admin/vtc_infrastructure/other_infrastructure_details/add') ?>

                <div class="row">
                   
                    <?php //echo $this->input->method(TRUE);?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="electricity_available">Electricity availability/Solar electricity <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <?php if($this->input->method(TRUE) == "POST"){ ?>

                                    <input class="form-check-input electricity-available" type="radio" name="electricity_available" id="electricity_available_yes"
                                        value="1" <?php echo set_radio('electricity_available',1)?>>
                                    <label class="form-check-label" for="electricity_available_yes">Yes</label>
                                
                                    <input class="form-check-input electricity-available" type="radio" name="electricity_available" id="electricity_available_no"
                                        value="0" <?php echo set_radio('electricity_available',0)?>>
                                    <label class="form-check-label" for="electricity_available_no">No</label>

                                <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                    <?php if(!empty($otherData)){?>
                                        <input class="form-check-input electricity-available" type="radio" name="electricity_available" id="electricity_available_yes"
                                            value="1" <?php echo $otherData['available_electricity'] == 1 ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="electricity_available_yes">Yes</label>
                                    
                                        <input class="form-check-input electricity-available" type="radio" name="electricity_available" id="electricity_available_no"
                                            value="0" <?php echo $otherData['available_electricity'] == 0 ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="electricity_available_no">No</label>
                                    <?php }else{?>
                                        <input class="form-check-input electricity-available" type="radio" name="electricity_available" id="electricity_available_yes"
                                        value="1">
                                        <label class="form-check-label" for="electricity_available_yes">Yes</label>
                                    
                                        <input class="form-check-input electricity-available" type="radio" name="electricity_available" id="electricity_available_no"
                                            value="0">
                                        <label class="form-check-label" for="electricity_available_no">No</label>
                                    <?php }?>

                                <?php }?>
                            </div>
                            <?php echo form_error('electricity_available'); ?>
                        </div>
                    </div>

                    <div class="col-md-3 phase3-supply-div" <?php if(set_value('electricity_available') != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            
                            <label class="" for="">Availability of 3 phase supply<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <?php if($this->input->method(TRUE) == "POST"){ ?>
                                    <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_yes"
                                        value="1" <?php echo set_radio('phase3_supply',1)?>>
                                    <label class="form-check-label" for="phase3_supply_yes">Yes</label>
                                
                                    <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_no"
                                        value="0" <?php echo set_radio('phase3_supply',0)?>>
                                    <label class="form-check-label" for="phase3_supply_no">No</label>

                                <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                    <?php if(!empty($otherData)){?>
                                        <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_yes"
                                            value="1" <?php echo $otherData['phase3_supply'] == 1 ? "checked" : ""; ?> >
                                        <label class="form-check-label" for="phase3_supply_yes">Yes</label>
                                    
                                        <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_no"
                                            value="0" <?php echo $otherData['phase3_supply'] == 0 ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="phase3_supply_no">No</label>

                                    <?php }else{?>

                                        <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_yes"
                                            value="1" >
                                        <label class="form-check-label" for="phase3_supply_yes">Yes</label>
                                    
                                        <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_no"
                                            value="0" >
                                        <label class="form-check-label" for="phase3_supply_no">No</label>

                                    <?php }?>
                                <?php } ?>
                            </div>
                            <?php echo form_error('phase3_supply'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="" for="">Internet Connection<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <?php if($this->input->method(TRUE) == "POST"){ ?>
                                    <input class="form-check-input internet-connect" type="radio" name="internet_connect" id="internet_connect_yes"
                                        value="1" <?php echo set_radio('internet_connect',0)?>>
                                    <label class="form-check-label" for="internet_connect_yes">Yes</label>
                                
                                    <input class="form-check-input internet-connect" type="radio" name="internet_connect" id="internet_connect_no"
                                        value="0" <?php echo set_radio('internet_connect',0)?>>
                                    <label class="form-check-label" for="internet_connect_no">No</label>

                                <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                    <?php if(!empty($otherData)){?>
                                        <input class="form-check-input internet-connect" type="radio" name="internet_connect" id="internet_connect_yes"
                                            value="1" <?php echo $otherData['internet_connect'] == 1 ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="internet_connect_yes">Yes</label>
                                    
                                        <input class="form-check-input internet-connect" type="radio" name="internet_connect" id="internet_connect_no"
                                            value="0" <?php echo $otherData['internet_connect'] == 0 ? "checked" : ""; ?>>
                                        <label class="form-check-label" for="internet_connect_no">No</label>

                                    <?php }else{?>

                                        <input class="form-check-input internet-connect" type="radio" name="internet_connect" id="internet_connect_yes"
                                            value="1">
                                        <label class="form-check-label" for="internet_connect_yes">Yes</label>
                                    
                                        <input class="form-check-input internet-connect" type="radio" name="internet_connect" id="internet_connect_no"
                                            value="0">
                                        <label class="form-check-label" for="internet_connect_no">No</label>
                                    <?php }?>

                                <?php } ?>
                            </div>
                            <?php echo form_error('internet_connect'); ?>
                        </div>
                    </div>
                    <div class="col-md-3 connection-type-div" <?php if(set_value('internet_connect') != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="connection_type">Type of available connection <span class="text-danger">*</span></label>
                            <select class="form-control" name="connection_type" id="connection_type">
                                <option value="" hidden="true">Select</option>
                                <?php if($this->input->method(TRUE) == "POST"){ ?>

                                    <option value="1" <?php echo set_select('connection_type', 1); ?>>Dial up</option>
                                    <option value="2" <?php echo set_select('connection_type', 2); ?>>Broadband</option>
                                    <option value="3" <?php echo set_select('connection_type', 3); ?>>Both</option>

                                <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                    <option value="1" <?php echo $otherData['connection_type_id_fk'] == 1 ? "selected" : ""; ?>>Dial up</option>
                                    <option value="2" <?php echo $otherData['connection_type_id_fk'] == 2 ? "selected" : ""; ?>>Broadband</option>
                                    <option value="3" <?php echo $otherData['connection_type_id_fk'] == 3 ? "selected" : ""; ?>>both</option>

                                <?php } ?>
                            </select>
                            <?php echo form_error('connection_type'); ?>
                        </div>
                    </div>

                    <input type="hidden" value="<?php if(!empty($otherData)){ echo $otherData['vtc_other_infrastructure_details_id_pk'];}?>" name="other_details_id">



                <!-- </div>
                <div class="row"> -->


                    <!-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="equipment_doc">
                                Equipment document 
                                <span class="text-danger">*</span>
                                <br>
                                <small>(Upload Highest equipment document pdf 200 KB)</small>
                            </label>
                           
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="equipment_doc" id="equipment_doc">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <?php echo form_error('equipment_doc'); ?>
                        </div>
                    </div> -->

                </div>
                <div class="row">
                    
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <label>&nbsp;</label><br>
                        <?php if(!empty($otherData)){?>
                            <button type="submit" class="btn btn-success btn-block btn-sm">Update Other Infrastructure Details</button>
                        <?php }else{?>
                            <button type="submit" class="btn btn-success btn-block btn-sm">Submit Other Infrastructure Details</button>
                        <?php }?>
                    </div>

                </div>

                <?php echo form_close() ?>
            </div>
            <?php } else { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                Your Affiliation is not completed yet.
            </div>
            <?php } ?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>