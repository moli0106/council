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
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <!-- <li class="active"><i class="fa fa-align-center"></i>Computer Lab List</li> -->
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
                <h3 class="box-title">Agriculture Discipline Details</h3>
            </div>
            <?php if($agriDisciplineExist == 'yes'){
                if ($vtcDetails['final_submit_status'] == 1) { ?>
                    <div class="box-body">
                        <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                        <?php echo form_open_multipart('admin/vtc_infrastructure/agriculture_discipline/add') ?>

                            <?php if(!empty($agriData)){?>
                                <input type="hidden" name="agri_discipline_id" value="<?php echo md5($agriData['vtc_agri_discipline_id_pk'])?>">
                            <?php }else{?>
                                <input type="hidden" name="agri_discipline_id" value="">
                            <?php }?>


                        <div class="row">
                        
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="lab_present">Pond <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST"){ ?>

                                            <input class="form-check-input pond-class" type="radio" name="pond" id="pond_yes"
                                                value="1" <?php echo set_radio('pond', 1) ?>>
                                            <label class="form-check-label" for="pond_yes">Yes</label>
                                        
                                            <input class="form-check-input pond-class" type="radio" name="pond" id="pond_no"
                                                value="0"<?php echo set_radio('pond', 0)?>>
                                            <label class="form-check-label" for="pond_no">No</label>

                                        <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                            <input class="form-check-input pond-class" type="radio" name="pond" id="pond_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['pond'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="pond_yes">Yes</label>
                                        
                                            <input class="form-check-input pond-class" type="radio" name="pond" id="pond_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['pond'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="pond_no">No</label>

                                        <?php } ?>
                                    </div>
                                    <?php echo form_error('pond'); ?>
                                </div>
                            </div>

                            <div class="col-md-3 fish-culti-div" <?php if((set_value('pond') != 1)){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="fish_cultivation">Fish Cultivation done<span class="text-danger">*</span></label>

                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input" type="radio" name="fish_cultivation" id="fish_cultivation_yes"
                                                value="1" <?php echo set_radio('fish_cultivation', 1) ?>>
                                            <label class="form-check-label" for="fish_cultivation_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="fish_cultivation" id="fish_cultivation_no"
                                                value="0"<?php echo set_radio('fish_cultivation', 0)?>>
                                            <label class="form-check-label" for="fish_cultivation_no">No</label>

                                        <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                            <input class="form-check-input" type="radio" name="fish_cultivation" id="fish_cultivation_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['fish_cultivation'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="fish_cultivation_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="fish_cultivation" id="fish_cultivation_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['fish_cultivation'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="fish_cultivation_no">No</label>

                                        <?php }?>

                                        <?php echo form_error('fish_cultivation'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="margin-right: 33%;">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="poultry_shed">Poultry Shed/Farm <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>
                                            <input class="form-check-input poultry-shed" type="radio" name="poultry_shed" id="poultry_shed_yes"
                                                value="1" <?php echo set_radio('poultry_shed', 1) ?>>
                                            <label class="form-check-label" for="poultry_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input poultry-shed" type="radio" name="poultry_shed" id="poultry_shed_no"
                                                value="0"<?php echo set_radio('poultry_shed', 0)?>>
                                            <label class="form-check-label" for="poultry_shed_no">No</label>

                                        <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                            <input class="form-check-input poultry-shed" type="radio" name="poultry_shed" id="poultry_shed_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['poultry_shed'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="poultry_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input poultry-shed" type="radio" name="poultry_shed" id="poultry_shed_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['poultry_shed'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="poultry_shed_no">No</label>
                                        <?php }?>
                                    </div>
                                    <?php echo form_error('poultry_shed'); ?>
                                </div>
                            </div>

                            
                            <div class="col-md-3 poultry-live-div" <?php if(set_value('poultry_shed') != 1){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="poultry_live">Availability Of Live Units<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input" type="radio" name="poultry_live" id="poultry_live_yes"
                                                value="1" <?php echo set_radio('poultry_live', 1) ?>>
                                            <label class="form-check-label" for="poultry_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="poultry_live" id="poultry_live_no"
                                                value="0"<?php echo set_radio('poultry_live', 0)?>>
                                            <label class="form-check-label" for="poultry_live_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input" type="radio" name="poultry_live" id="poultry_live_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['poultry_live'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="poultry_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="poultry_live" id="poultry_live_no"
                                                value="0" <?php if (!empty($agriData)){ echo ($agriData['poultry_live'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="poultry_live_no">No</label>

                                        <?php }?>
                                    </div>
                                    <?php echo form_error('poultry_live'); ?>
                                </div>
                            </div>
                    
                        </div>
                        
                        <hr style="margin-right: 33%;">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="animal_shed">Animal Shed <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input animal-shed" type="radio" name="animal_shed" id="animal_shed_yes"
                                                value="1" <?php echo set_radio('animal_shed', 1) ?>>
                                            <label class="form-check-label" for="animal_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input animal-shed" type="radio" name="animal_shed" id="animal_shed_no"
                                                value="0"<?php echo set_radio('animal_shed', 0)?>>
                                            <label class="form-check-label" for="animal_shed_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input animal-shed" type="radio" name="animal_shed" id="animal_shed_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['animal_shed'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="animal_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input animal-shed" type="radio" name="animal_shed" id="animal_shed_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['animal_shed'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="animal_shed_no">No</label>

                                        <?php }?>
                                    
                                    </div>
                                    <?php echo form_error('animal_shed'); ?>
                                </div>
                            </div>

                            
                            <div class="col-md-3 animal-live-div" <?php if(set_value('animal_shed') != 1){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="animal_live">Availability Of Live Units<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input" type="radio" name="animal_live" id="animal_live_yes"
                                                value="1" <?php echo set_radio('animal_live', 1) ?>>
                                            <label class="form-check-label" for="animal_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="animal_live" id="animal_live_no"
                                                value="0"<?php echo set_radio('animal_live', 0)?>>
                                            <label class="form-check-label" for="animal_live_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input" type="radio" name="animal_live" id="animal_live_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['animal_live'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="animal_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="animal_live" id="animal_live_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['animal_live'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="animal_live_no">No</label>

                                        <?php }?>
                                    </div>
                                    <?php echo form_error('animal_live'); ?>
                                </div>
                            </div>

                        </div>

                        <hr style="margin-right: 33%;">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="cattle_shed">Cattle Shed <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input cattle-shed" type="radio" name="cattle_shed" id="cattle_shed_yes"
                                                value="1" <?php echo set_radio('cattle_shed', 1) ?>>
                                            <label class="form-check-label" for="cattle_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input cattle-shed" type="radio" name="cattle_shed" id="cattle_shed_no"
                                                value="0"<?php echo set_radio('cattle_shed', 0)?>>
                                            <label class="form-check-label" for="cattle_shed_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input cattle-shed" type="radio" name="cattle_shed" id="cattle_shed_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['cattle_shed'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="cattle_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input cattle-shed" type="radio" name="cattle_shed" id="cattle_shed_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['cattle_shed'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="cattle_shed_no">No</label>

                                        <?php }?>
                                    </div>
                                    <?php echo form_error('cattle_shed'); ?>
                                </div>
                            </div>

                            
                            <div class="col-md-3 cattle-live-div" <?php if(set_value('cattle_shed') != 1){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="cattle_live">Availability Of Live Units<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input" type="radio" name="cattle_live" id="cattle_live_yes"
                                                value="1" <?php echo set_radio('cattle_live', 1) ?>>
                                            <label class="form-check-label" for="cattle_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="cattle_live" id="cattle_live_no"
                                                value="0"<?php echo set_radio('cattle_live', 0)?>>
                                            <label class="form-check-label" for="cattle_live_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input" type="radio" name="cattle_live" id="cattle_live_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['cattle_live'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="cattle_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="cattle_live" id="cattle_live_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['cattle_live'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="cattle_live_no">No</label>

                                        <?php }?>
                                    </div>
                                    <?php echo form_error('cattle_live'); ?>
                                </div>
                            </div>
                        </div>

                        <hr style="margin-right: 33%;">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="goat_shed">Goat/Pig Shed <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input goat-shed" type="radio" name="goat_shed" id="goat_shed_yes"
                                                value="1" <?php echo set_radio('goat_shed', 1) ?>>
                                            <label class="form-check-label" for="goat_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input goat-shed" type="radio" name="goat_shed" id="goat_shed_no"
                                                value="0"<?php echo set_radio('goat_shed', 0)?>>
                                            <label class="form-check-label" for="goat_shed_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input goat-shed" type="radio" name="goat_shed" id="goat_shed_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['goat_shed'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="goat_shed_yes">Yes</label>
                                        
                                            <input class="form-check-input goat-shed" type="radio" name="goat_shed" id="goat_shed_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['goat_shed'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="goat_shed_no">No</label>

                                        <?php }?>
                                    
                                    </div>
                                    <?php echo form_error('goat_shed'); ?>
                                </div>
                            </div>

                            
                            <div class="col-md-3 goat-live-div" <?php if(set_value('goat_shed') != 1){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="goat_live">Availability Of Live Units<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input" type="radio" name="goat_live" id="goat_live_yes"
                                                value="1" <?php echo set_radio('goat_live', 1) ?>>
                                            <label class="form-check-label" for="goat_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="goat_live" id="goat_live_no"
                                                value="0"<?php echo set_radio('goat_live', 0)?>>
                                            <label class="form-check-label" for="goat_live_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input" type="radio" name="goat_live" id="goat_live_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['goat_live'] == 0)?'checked':'';}?>>

                                            <label class="form-check-label" for="goat_live_yes">Yes</label>
                                        
                                            <input class="form-check-input" type="radio" name="goat_live" id="goat_live_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['goat_live'] == 0)?'checked':'';}?>>

                                            <label class="form-check-label" for="goat_live_no">No</label>

                                        <?php }?>
                                    </div>
                                    <?php echo form_error('goat_live'); ?>
                                </div>
                            </div>
                        </div>

                        <hr style="margin-right: 33%;">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="compost_pit">Compost Pit <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input compost-pit" type="radio" name="compost_pit" id="compost_pit_yes"
                                                value="1" <?php echo set_radio('compost_pit', 1) ?>>
                                            <label class="form-check-label" for="compost_pit_yes">Yes</label>
                                        
                                            <input class="form-check-input compost-pit" type="radio" name="compost_pit" id="compost_pit_no"
                                                value="0"<?php echo set_radio('compost_pit', 0)?>>
                                            <label class="form-check-label" for="compost_pit_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input compost-pit" type="radio" name="compost_pit" id="compost_pit_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['compost_pit'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="compost_pit_yes">Yes</label>
                                        
                                            <input class="form-check-input compost-pit" type="radio" name="compost_pit" id="compost_pit_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['compost_pit'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="compost_pit_no">No</label>

                                        <?php }?>

                                    
                                    </div>
                                    <?php echo form_error('compost_pit'); ?>
                                </div>
                            </div>

                            
                            <div class="col-md-3 compost-pit-div" <?php if(set_value('compost_pit') != 1){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="no_of_pit">No Of Pits<span class="text-danger">*</span></label>

                                    <?php if($this->input->method(TRUE) == "POST") {?>

                                        <input type="number" class="form-control" name="no_of_pit" value="<?php echo set_value('no_of_pit')?>">

                                    <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                        <input type="number" class="form-control" name="no_of_pit" value="<?php if(!empty($agriData)){echo $agriData['no_of_pit'];} ?>">

                                    <?php }?>

                                    <?php echo form_error('no_of_pit'); ?>
                                </div>
                            </div>
                        </div>

                        <hr style="margin-right: 33%;">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="land">Land <span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input land-class" type="radio" name="land" id="land_yes"
                                                value="1" <?php echo set_radio('land', 1) ?>>
                                            <label class="form-check-label" for="land_yes">Yes</label>
                                        
                                            <input class="form-check-input land-class" type="radio" name="land" id="land_no"
                                                value="0"<?php echo set_radio('land', 0)?>>
                                            <label class="form-check-label" for="land_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input land-class" type="radio" name="land" id="land_yes"
                                                value="1" <?php if (!empty($agriData)){ echo ($agriData['land'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="land_yes">Yes</label>
                                        
                                            <input class="form-check-input land-class" type="radio" name="land" id="land_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['land'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="land_no">No</label>

                                        <?php }?>

                                    
                                    </div>
                                    <?php echo form_error('land'); ?>
                                </div>
                            </div>

                            
                            <div class="col-md-3 agri-land-div" <?php if(set_value('land') != 1){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="agri_land">Whether Land Is For Agriculture?<span class="text-danger">*</span></label>
                                    <div class="form-check form-check-inline">

                                        <?php if($this->input->method(TRUE) == "POST") {?>

                                            <input class="form-check-input agri-land-class" type="radio" name="agri_land" id="agri_land_yes"
                                                value="1" <?php echo set_radio('agri_land', 1) ?>>
                                            <label class="form-check-label" for="agri_land_yes">Yes</label>
                                        
                                            <input class="form-check-input agri-land-class" type="radio" name="agri_land" id="agri_land_no"
                                                value="0"<?php echo set_radio('agri_land', 0)?>>
                                            <label class="form-check-label" for="agri_land_no">No</label>

                                        <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                            <input class="form-check-input agri-land-class" type="radio" name="agri_land" id="agri_land_yes"
                                                value="1"<?php if (!empty($agriData)){ echo ($agriData['agri_land'] == 1)?'checked':'';}?>>
                                            <label class="form-check-label" for="agri_land_yes">Yes</label>
                                        
                                            <input class="form-check-input agri-land-class" type="radio" name="agri_land" id="agri_land_no"
                                                value="0"<?php if (!empty($agriData)){ echo ($agriData['agri_land'] == 0)?'checked':'';}?>>
                                            <label class="form-check-label" for="agri_land_no">No</label>

                                        <?php }?>
                                    </div>
                                    <?php echo form_error('agri_land'); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-3 agri-land-div" <?php if(set_value('land') != 1){echo 'style="display: none;"';}?>>
                                <div class="form-group">
                                    <label for="land_size">Land Size (in cottahs)<span class="text-danger">*</span></label>

                                    <?php if($this->input->method(TRUE) == "POST") {?>

                                        <input type="number" class="form-control" name="land_size" value="<?php echo set_value('land_size')?>" step=".01">

                                    <?php }elseif($this->input->method(TRUE) == "GET") {?>

                                        <input type="number" class="form-control" name="land_size" value="<?php if(!empty($agriData)){ echo $agriData['land_size'];}?>" step=".01">

                                    <?php }?>

                                    <?php echo form_error('land_size'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-center">
                                <label>&nbsp;</label><br>
                                <?php if(!empty($agriData)){?>
                                <button type="submit" class="btn btn-success btn-block btn-sm uptd-lab-btn">Update Agriculture Discipline Details</button>
                                <?php }else{?>
                                    <button type="submit" class="btn btn-success btn-block btn-sm">Submit Agriculture Discipline Details</button>
                                <?php }?>
                            </div>

                        </div>

                        <?php echo form_close() ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                        Please complete and submit Affiliation Part I first.
                    </div>
                <?php }
            }else{ ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Not applicable as No Agriculture discipline course is chosen 
                </div>
            <?php }?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>