<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li><a href="affiliation/vtc"><i class="fa fa-align-center"></i> Course & Teachers / Instructor List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Details</li>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="discipline_id">Subject Name<span class="text-danger">*</span></label>

                            <input type="hidden"  name="discipline_id" id="discipline_id" value="<?php echo $cmnLabData['discipline_id_fk']?>">
                            <input type="text" class="form-control"  value="<?php echo $cmnLabData['discipline_name']?>" readonly>

                            
                            <?php echo form_error('discipline_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="item_id">Infrastructure item <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control"  value="<?php echo $cmnLabData['item_name']?>" readonly>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Present or number where applicable <span class="text-danger">*</span></label>
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
                                Equipment document 
                                <span class="text-danger">*</span>
                                <br>
                                <small>(Upload Highest equipment document pdf 200 KB)</small>

                                <?php if($cmnLabData['equipment_doc'] !='') {?>
                                    <a href="<?php echo base_url('admin/affiliation/vtc/showCmnLabDoc/' . md5($cmnLabData['vtc_other_common_lab_id_pk'])); ?>" target="_blank" class="btn btn-flat btn-sm btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>
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
                <!-- <div class="row">
                   
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <label>&nbsp;</label><br>
                        <button type="submit" class="btn btn-success btn-block btn-sm">Update Other Common Laboratory</button>
                    </div>

                </div> -->

                <?php echo form_close() ?>
            </div>
            
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>