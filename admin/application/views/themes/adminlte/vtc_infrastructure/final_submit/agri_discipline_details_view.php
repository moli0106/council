<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Agriculture Discipline Details</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">

        <?php if($agriDisciplineExist == 'yes'){?>

            <?php if (!empty($agriData)) { ?>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="lab_present">Pond <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input pond-class" type="radio" name="pond" id="pond_yes" value="1"
                                    <?php if ($agriData['pond'] == 1){ echo 'checked';}?>>
                                <label class="form-check-label" for="pond_yes">Yes</label>

                                <input class="form-check-input pond-class" type="radio" name="pond" id="pond_no" value="0"
                                    <?php if ($agriData['pond'] == 0) { echo 'checked';}?>>
                                <label class="form-check-label" for="pond_no">No</label>

                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 fish-culti-div" <?php if($agriData['pond'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="fish_cultivation">Fish Cultivation done<span class="text-danger">*</span></label>

                            <div class="form-check form-check-inline">
                                

                                <input class="form-check-input" type="radio" name="fish_cultivation" id="fish_cultivation_yes"
                                    value="1" <?php if ($agriData['fish_cultivation'] == 1){ echo 'checked';}?>>
                                <label class="form-check-label" for="fish_cultivation_yes">Yes</label>

                                <input class="form-check-input" type="radio" name="fish_cultivation" id="fish_cultivation_no"
                                    value="0" <?php if ($agriData['fish_cultivation'] == 0){ echo 'checked';}?>>
                                <label class="form-check-label" for="fish_cultivation_no">No</label>
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="poultry_shed">POULTRY SHED/FARM <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                

                                <input class="form-check-input poultry-shed" type="radio" name="poultry_shed"
                                    id="poultry_shed_yes" value="1"
                                    <?php if ($agriData['poultry_shed'] == 1){ echo 'checked';}?>>
                                <label class="form-check-label" for="poultry_shed_yes">Yes</label>

                                <input class="form-check-input poultry-shed" type="radio" name="poultry_shed"
                                    id="poultry_shed_no" value="0"
                                    <?php if ($agriData['poultry_shed'] == 0){ echo 'checked';}?>>
                                <label class="form-check-label" for="poultry_shed_no">No</label>
                            </div>
                            <?php echo form_error('poultry_shed'); ?>
                        </div>
                    </div>


                    <div class="col-md-3 poultry-live-div"
                        <?php if($agriData['poultry_shed'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="poultry_live">AVAILABILITY OF LIVE UNITS<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                

                                <input class="form-check-input" type="radio" name="poultry_live" id="poultry_live_yes" value="1"
                                    <?php if($agriData['poultry_live'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="poultry_live_yes">Yes</label>

                                <input class="form-check-input" type="radio" name="poultry_live" id="poultry_live_no" value="0"
                                    <?php if($agriData['poultry_live'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="poultry_live_no">No</label>

                                
                            </div>
                            <?php echo form_error('poultry_live'); ?>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="animal_shed">ANIMAL SHED <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                

                                <input class="form-check-input animal-shed" type="radio" name="animal_shed" id="animal_shed_yes"
                                    value="1" <?php if($agriData['animal_shed'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="animal_shed_yes">Yes</label>

                                <input class="form-check-input animal-shed" type="radio" name="animal_shed" id="animal_shed_no"
                                    value="0" <?php if($agriData['animal_shed'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="animal_shed_no">No</label>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 animal-live-div"
                        <?php if($agriData['animal_shed'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="animal_live">AVAILABILITY OF LIVE UNITS<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="animal_live" id="animal_live_yes" value="1"
                                    <?php if($agriData['animal_live'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="animal_live_yes">Yes</label>

                                <input class="form-check-input" type="radio" name="animal_live" id="animal_live_no" value="0"
                                    <?php if($agriData['animal_live'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="animal_live_no">No</label>

                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="cattle_shed">Cattle Shed <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input cattle-shed" type="radio" name="cattle_shed" id="cattle_shed_yes"
                                    value="1" <?php if($agriData['cattle_shed'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="cattle_shed_yes">Yes</label>

                                <input class="form-check-input cattle-shed" type="radio" name="cattle_shed" id="cattle_shed_no"
                                    value="0" <?php if($agriData['cattle_shed'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="cattle_shed_no">No</label>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 cattle-live-div"
                        <?php if($agriData['cattle_shed'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="cattle_live">AVAILABILITY OF LIVE UNITS</label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="cattle_live" id="cattle_live_yes" value="1"
                                    <?php if($agriData['cattle_live'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="cattle_live_yes">Yes</label>

                                <input class="form-check-input" type="radio" name="cattle_live" id="cattle_live_no" value="0"
                                    <?php if($agriData['cattle_live'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="cattle_live_no">No</label>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="goat_shed">Goat/Pig SHED <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input goat-shed" type="radio" name="goat_shed" id="goat_shed_yes"
                                    value="1" <?php if($agriData['goat_shed'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="goat_shed_yes">Yes</label>

                                <input class="form-check-input goat-shed" type="radio" name="goat_shed" id="goat_shed_no"
                                    value="0" <?php if($agriData['goat_shed'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="goat_shed_no">No</label>

                                
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 goat-live-div" <?php if($agriData['goat_shed'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="goat_live">AVAILABILITY OF LIVE UNITS<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input" type="radio" name="goat_live" id="goat_live_yes" value="1"
                                    <?php if($agriData['goat_live'] == 1){echo "checked";} ?>>

                                <label class="form-check-label" for="goat_live_yes">Yes</label>

                                <input class="form-check-input" type="radio" name="goat_live" id="goat_live_no" value="0"
                                    <?php if($agriData['goat_live'] == 0){echo "checked";} ?>>

                                <label class="form-check-label" for="goat_live_no">No</label>

                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="compost_pit">Compost Pit <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input compost-pit" type="radio" name="compost_pit" id="compost_pit_yes"
                                    value="1" <?php if($agriData['compost_pit'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="compost_pit_yes">Yes</label>

                                <input class="form-check-input compost-pit" type="radio" name="compost_pit" id="compost_pit_no"
                                    value="0" <?php if($agriData['compost_pit'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="compost_pit_no">No</label>


                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 compost-pit-div"
                        <?php if($agriData['compost_pit'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="no_of_pit">No OF Pits<span class="text-danger">*</span></label>

                            <input type="number" class="form-control" name="no_of_pit"
                                value="<?php echo $agriData['no_of_pit']; ?>">

                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="land">Land <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input land-class" type="radio" name="land" id="land_yes" value="1"
                                    <?php if($agriData['land'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="land_yes">Yes</label>

                                <input class="form-check-input land-class" type="radio" name="land" id="land_no" value="0"
                                    <?php if($agriData['land'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="land_no">No</label>


                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 agri-land-div" <?php if($agriData['land'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="agri_land">Whether LAND IS FOR AGRICULTURE?<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <input class="form-check-input agri-land-class" type="radio" name="agri_land" id="agri_land_yes"
                                    value="1" <?php if($agriData['agri_land'] == 1){echo "checked";} ?>>
                                <label class="form-check-label" for="agri_land_yes">Yes</label>

                                <input class="form-check-input agri-land-class" type="radio" name="agri_land" id="agri_land_no"
                                    value="0" <?php if($agriData['agri_land'] == 0){echo "checked";} ?>>
                                <label class="form-check-label" for="agri_land_no">No</label>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 land-size-div" <?php if($agriData['agri_land'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="land_size">Land Size (in cottahs)<span class="text-danger">*</span></label>
                            

                            <input type="number" class="form-control" name="land_size"
                                value="<?php echo $agriData['land_size']?>" step=".01">

                            
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                        Your agriculture discipline details is not added.
                        <!-- for academic year <span
                            class="label label-success"><?php echo $academic_year; ?></span> -->
                    </div>
                </div>
            <?php } ?>
        
        <?php }else{ ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                Agriculture Discipline is not exist. 
            </div>
        <?php }?>
        

    </div>
</div>