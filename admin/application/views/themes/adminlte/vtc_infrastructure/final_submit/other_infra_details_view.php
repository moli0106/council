<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Other Infrastructure Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">

        <div class="row">

            <?php if (!empty($otherData)) { ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="" for="electricity_available">Electricity availability/Solar electricity <span
                                class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">

                            <input class="form-check-input electricity-available" type="radio" name="electricity_available"
                                id="electricity_available_yes" value="1"
                                <?php echo $otherData['available_electricity'] == 1 ? "checked" : ""; ?>>
                            <label class="form-check-label" for="electricity_available_yes">Yes</label>

                            <input class="form-check-input electricity-available" type="radio" name="electricity_available"
                                id="electricity_available_no" value="0"
                                <?php echo $otherData['available_electricity'] == 0 ? "checked" : ""; ?>>
                            <label class="form-check-label" for="electricity_available_no">No</label>

                            
                        </div>
                    </div>
                </div>

                <div class="col-md-3 phase3-supply-div"
                    <?php if($otherData['available_electricity'] != 1){echo 'style="display: none;"';}?>>
                    <div class="form-group">

                        <label class="" for="">Availability of 3 phase supply<span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">

                            <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_yes"
                                value="1" <?php echo $otherData['phase3_supply'] == 1 ? "checked" : ""; ?>>
                            <label class="form-check-label" for="phase3_supply_yes">Yes</label>

                            <input class="form-check-input" type="radio" name="phase3_supply" id="phase3_supply_no"
                                value="0" <?php echo $otherData['phase3_supply'] == 0 ? "checked" : ""; ?>>
                            <label class="form-check-label" for="phase3_supply_no">No</label>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label class="" for="">Internet Connection<span class="text-danger">*</span></label>
                        <div class="form-check form-check-inline">

                            <input class="form-check-input internet-connect" type="radio" name="internet_connect"
                                id="internet_connect_yes" value="1"
                                <?php echo $otherData['internet_connect'] == 1 ? "checked" : ""; ?>>
                            <label class="form-check-label" for="internet_connect_yes">Yes</label>

                            <input class="form-check-input internet-connect" type="radio" name="internet_connect"
                                id="internet_connect_no" value="0"
                                <?php echo $otherData['internet_connect'] == 0 ? "checked" : ""; ?>>
                            <label class="form-check-label" for="internet_connect_no">No</label>

                            
                        </div>
                    </div>
                </div>
                <div class="col-md-3 connection-type-div"
                    <?php if($otherData['internet_connect'] != 1){echo 'style="display: none;"';}?>>
                    <div class="form-group">
                        <label for="connection_type">Type of available connection <span class="text-danger">*</span></label>
                        <select class="form-control" name="connection_type" id="connection_type">
                            <option value="" hidden="true">Select</option>
                        

                            <option value="1" <?php echo $otherData['connection_type_id_fk'] == 1 ? "selected" : ""; ?>>Dial
                                up</option>
                            <option value="2" <?php echo $otherData['connection_type_id_fk'] == 2 ? "selected" : ""; ?>>
                                Broadband</option>
                            <option value="3" <?php echo $otherData['connection_type_id_fk'] == 3 ? "selected" : ""; ?>>both
                            </option>
                        </select>
                        
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                        Your Other Infrastructure Details is not added for academic year <span
                            class="label label-success"></span>
                    </div>
                </div>
            <?php } ?>

          
        </div>
    </div>
</div>