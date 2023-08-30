<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <li class="active"><i class="fa fa-align-center"></i>Vocational Paper Laboratory List</li>
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
                <h3 class="box-title">Add Vocational Paper Laboratory</h3>
            </div>
           
            <div class="box-body">
               
                <?php echo form_open_multipart('admin/vtc_infrastructure/paper_laboratory/update') ?>
                <input type="hidden" value="<?php echo md5($paperLabData['vtc_vocational_paper_lab_id_pk']); ?>" name="paper_lab_id" id="paper_lab_id">
                <div class="row">
                    <div class="col-md-4">
                          
                        <div class="form-group">
                            <label class="" for="course_id">Course Name <span class="text-danger">*</span></label>
                            <input type="hidden"  name="course_id" id="course_id" value="<?php echo $paperLabData['group_id_fk']?>">
                           <input type="text" class="form-control"  value="<?php echo $paperLabData['group_name']?>" readonly>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Infrastructure item <span
                                    class="text-danger">*</span></label>

                            <input type="hidden"  name="item_id" id="item_id" value="<?php echo $paperLabData['infrastructure_item_id_fk']?>">
                            <input type="text" class="form-control"  value="<?php echo $paperLabData['item_name']?>" readonly>
                            <!-- <select class="form-control select2" name="item_id" id="item_id">
                                <option value="" >Select Infrastructure Item</option>


                            </select> -->
                            <?php echo form_error('item_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Infrastructure item Available <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input present-aplicable" type="radio" name="aplicable_no" id="aplicable_no_yes"
                                    value="1" <?php if ($paperLabData['applicable_present'] == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="aplicable_no_yes">Yes</label>
                            
                                <input class="form-check-input present-aplicable" type="radio" name="aplicable_no" id="aplicable_no_no"
                                    value="0" <?php if ($paperLabData['applicable_present'] == 0) echo 'checked'; ?>>
                                <label class="form-check-label" for="aplicable_no_no">No</label>
                            </div>
                            <?php echo form_error('aplicable_no'); ?>
                        </div>
                    </div>

                    
                </div>
                <div class="row">

                    <div class="col-md-6 lab-size-div" <?php if(set_value('aplicable_no') != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label class="" for="">EXPERIMENTAL SET-UPS / EQUIPMENTS / MACHINERIES ETC. FULLY AVAILABILE FOR THE COURSE AS PER CURRICULUM <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="experimental_setup" id="experimental_setup_yes"
                                    value="1" <?php if ($paperLabData['experimental_setup'] == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="experimental_setup_yes">Yes</label>
                            
                                <input class="form-check-input" type="radio" name="experimental_setup" id="experimental_setup_no"
                                    value="0" <?php if ($paperLabData['experimental_setup'] == 0) echo 'checked'; ?>>
                                <label class="form-check-label" for="experimental_setup_no">No</label>
                            </div>
                            <?php echo form_error('experimental_setup'); ?>
                        </div>
                    </div>
                    
                    


                    <div class="col-md-6 lab-size-div" <?php if(set_value('aplicable_no') != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label class="" for="equipment_doc">
                            Upload single pdf containing list of set-ups/equipment/machineries available  
                                <span class="text-danger">*</span>
                                <br>
                                <small>(Upload Highest pdf 200 KB)</small>

                                <?php if($paperLabData['equipment_doc'] !='') {?>
                                    <a href="<?php echo base_url('admin/vtc_infrastructure/paper_laboratory/showEquipmentDoc/' . md5($paperLabData['vtc_vocational_paper_lab_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
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
                        <button type="submit" class="btn btn-success btn-block btn-sm">Update Vocational Paper Laboratory</button>
                    </div>

                </div>

                <?php echo form_close() ?>
            </div>
               
            
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>