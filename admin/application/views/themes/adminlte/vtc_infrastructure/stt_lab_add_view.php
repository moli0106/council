<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <li class="active"><i class="fa fa-align-center"></i>Short Term Trade Laboratory List</li>
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
                <h3 class="box-title">Add Short Term Trade</h3>
            </div>
            <?php if ($vtcDetails['final_submit_status'] == 1) { ?>
            <div class="box-body">
                <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                <?php echo form_open_multipart('admin/vtc_infrastructure/stt_laboratory/add') ?>

                <div class="row">

                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Select Trade Name <span class="text-danger">*</span></label>
                            <select class="form-control" name="course_id" id="course_id">
                                <option value="">Select Trade Name</option>
                                <?php foreach ($vtcCourseList as $value) {?>
                                <option value="<?php echo $value['course_id_pk']?>" <?php echo set_select('course_id', $value['course_id_pk']); ?>>
                                    <?php echo $value['group_name']?> [<?php echo $value['group_code']?>]</option>
                                <?php }?>

                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="course_id">Infrastructure item <span
                                    class="text-danger">*</span></label>
                            <select class="form-control" name="item_id" id="item_id">
                                <option value="" hidden="true">Select Infrastructure item</option>


                            </select>
                            <?php echo form_error('item_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="" for="course_id">Applicable No <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input present-aplicable" type="radio" name="aplicable_no" id="aplicable_no_yes"
                                    value="1" <?php echo set_radio('aplicable_no',1)?>>
                                <label class="form-check-label" for="aplicable_no_yes">Yes</label>
                            
                                <input class="form-check-input present-aplicable" type="radio" name="aplicable_no" id="aplicable_no_no"
                                    value="0" <?php echo set_radio('aplicable_no', 0) ?>>
                                <label class="form-check-label" for="aplicable_no_no">No</label>
                            </div>
                            <?php echo form_error('aplicable_no'); ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="" for="">Availability of Equipment<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input available-equipment" type="radio" name="equipment" id="equipment_yes"
                                    value="1" <?php echo set_radio('equipment', 1) ?>>
                                <label class="form-check-label" for="equipment_yes">Yes</label>
                            
                                <input class="form-check-input available-equipment" type="radio" name="equipment" id="equipment_no"
                                    value="0" <?php echo set_radio('equipment', 0) ?>>
                                <label class="form-check-label" for="equipment_no">No</label>
                            </div>
                            <?php echo form_error('equipment'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 lab-size-div" <?php if(set_value('aplicable_no') != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="lab_size">Size of Lab / workplace (sq. ft) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="lab_size" id="lab_size" value="<?php echo set_value('lab_size'); ?>">
                            <?php echo form_error('lab_size'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-4 sufficient-course-div" <?php if(set_value('equipment') != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label class="" for="sufficient_availability">sufficient availability to run the course<span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sufficient_availability" id="sufficient_availability_yes"
                                    value="1" <?php echo set_radio('sufficient_availability' , 1)?>>
                                <label class="form-check-label" for="sufficient_availability_yes">Yes</label>
                            
                                <input class="form-check-input" type="radio" name="sufficient_availability" id="sufficient_availability_no"
                                    value="0" <?php echo set_radio('sufficient_availability' , 0)?>>
                                <label class="form-check-label" for="sufficient_availability_no">No</label>
                            </div>
                            <?php echo form_error('sufficient_availability'); ?>
                        </div>
                    </div>


                    <div class="col-md-4">
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
                    </div>

                </div>
                <div class="row">
                   
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <label>&nbsp;</label><br>
                        <button type="submit" class="btn btn-success btn-block btn-sm">Submit Short Term Trade Laboratory</button>
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