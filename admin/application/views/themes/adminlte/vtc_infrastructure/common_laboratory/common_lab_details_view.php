<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <li class="active"><i class="fa fa-align-center"></i>Other Common Laboratory List</li>
            <li class="active"><i class="fa fa-align-center"></i>Edit</li>
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
                <h3 class="box-title">Edit Other Common Laboratory</h3>
            </div>
            
            <div class="box-body">
                <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                <?php echo form_open_multipart('admin/vtc_infrastructure/common_laboratory/update') ?>

                <input type="hidden" value="<?php echo md5($cmnLabData['vtc_other_common_lab_id_pk'])?>" name="cmn_id_hash" id="cmn_id_hash">
                <div class="row">


                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="course_name_id">Select course name <span class="text-danger">*</span></label>
                            <select class="form-control" name="course_name_id" id="course_name_id" disabled>
                                <option value="" >Select course name</option>
                                <option value="1" <?php if($cmnLabData['course_name_id_fk'] == 1){echo 'selected';}?> >HS-Voc</option>
                                <option value="4" <?php if($cmnLabData['course_name_id_fk'] == 4){echo 'selected';}?>>VIII+ STC</option>

                            </select>
                            <?php echo form_error('course_name_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="discipline_id">Discipline Name<span class="text-danger">*</span></label>

                            <input type="hidden"  name="discipline_id" id="discipline_id" value="<?php echo $cmnLabData['discipline_id_fk']?>">
                            <input type="text" class="form-control"  value="<?php echo $cmnLabData['discipline_name']?>" readonly>

                            <!-- <select class="form-control select2" name="discipline_id" id="discipline_id">
                                <option value="" hidden="true">Select Subject Name</option>
                                <?php foreach ($vtcDisciplineList as $value) {?>
                                <option value="<?php echo $value['discipline_id_pk']?>" <?php if($cmnLabData['discipline_id_fk'] == $value['discipline_id_pk']){echo 'selected';} ?> disabled>
                                    <?php echo $value['discipline_name']?></option>
                                <?php }?>

                            </select> -->
                            <?php echo form_error('discipline_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="item_id">Infrastructure item <span
                                    class="text-danger">*</span></label>
                            <input type="hidden"  name="item_id" id="item_id" value="<?php echo $cmnLabData['infrastructure_item_id_fk']?>">
                            <input type="text" class="form-control"  value="<?php echo $cmnLabData['item_name']?>" readonly>
                            <!-- <select class="form-control select2" name="item_id" id="item_id">
                                <option value="" hidden="true">Select Infrastructure item</option>


                            </select> -->
                            <?php echo form_error('item_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Infrastructure Item Available <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input present-aplicable" type="radio" name="aplicable_no" id="aplicable_no_yes"
                                    value="1" <?php if ($cmnLabData['applicable_present'] == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="aplicable_no_yes">Yes</label>
                            
                                <input class="form-check-input present-aplicable" type="radio" name="aplicable_no" id="aplicable_no_no"
                                    value="0" <?php if ($cmnLabData['applicable_present'] == 0) echo 'checked'; ?>>
                                <label class="form-check-label" for="aplicable_no_no">No</label>
                            </div>
                            <?php echo form_error('aplicable_no'); ?>
                        </div>
                    </div>

                   
                </div>
                <div class="row">

                    <div class="col-md-6 lab-size-div" <?php if($cmnLabData['applicable_present'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label class="" for="">EXPERIMENTAL SET-UPS / EQUIPMENTS / MACHINERIES ETC. FULLY AVAILABILE FOR THE COURSE AS PER CURRICULUM <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experimental_setup" id="experimental_setup_yes"
                                    value="1" <?php if ($cmnLabData['experimental_setup'] == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="experimental_setup_yes">Yes</label>
                            
                                <input class="form-check-input" type="radio" name="experimental_setup" id="experimental_setup_no"
                                    value="0" <?php if ($cmnLabData['experimental_setup'] == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="experimental_setup_no">No</label>
                            </div>
                            <?php echo form_error('experimental_setup'); ?>
                        </div>
                    </div>
                   


                    <div class="col-md-4 equipment-doc-div" <?php if($cmnLabData['applicable_present'] != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label class="" for="equipment_doc">
                                Upload single pdf containing list of set-ups/equipment/machineries available 
                                <span class="text-danger">*</span>
                                <br>
                                <small>(Upload Highest pdf 200 KB)</small>
                                
                                <?php if($cmnLabData['equipment_doc'] !='') {?>
                                    <a href="<?php echo base_url('admin/vtc_infrastructure/common_laboratory/showEquipmentDoc/' . md5($cmnLabData['vtc_other_common_lab_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
                                <?php }?>

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
                    </div>

                </div>
                <div class="row">
                   
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <label>&nbsp;</label><br>
                        <?php if ($vtcDetails['second_final_submit_status'] == 0) { ?>
                            <button type="submit" class="btn btn-success btn-block btn-sm">Update Other Common Laboratory</button>
                        <?php } ?>
                    </div>

                </div>

                <?php echo form_close() ?>
            </div>
            
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>