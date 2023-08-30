<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
     .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>VTC infrastructure</li>
            <li class="active"><i class="fa fa-align-center"></i>Computer Lab List</li>
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
                <h3 class="box-title">Computer Lab Details</h3>
            </div>
            <?php if ($vtcDetails['final_submit_status'] == 1) { ?>
            <div class="box-body">
                <input type="hidden" value="<?php echo md5($vtc_id); ?>" id="vtc_id">
                <?php echo form_open_multipart('admin/vtc_infrastructure/computer_lab/add',array('id' => 'computer_form')) ?>

                <div class="row">
                   
                    <input type="hidden" name="computer_lab_id" value="<?php if(!empty($computerLabData)){echo ($computerLabData['vtc_computer_lab_id_pk']);} ?>" id="computer_lab_id">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="lab_present">Present Computer Lab <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">

                                <?php if($this->input->method(TRUE) == "POST"){ ?>

                                    <input class="form-check-input lab-present" type="radio" name="lab_present" id="lab_present_yes"
                                        value="1" <?php echo set_radio('lab_present', 1) ?>>
                                    <label class="form-check-label" for="lab_present_yes">Yes</label>
                                
                                    <input class="form-check-input lab-present" type="radio" name="lab_present" id="lab_present_no"
                                        value="0"<?php echo set_radio('lab_present', 0)?>>
                                    <label class="form-check-label" for="lab_present_no">No</label>

                                <?php } elseif($this->input->method(TRUE) == "GET") { ?>

                                    <input class="form-check-input lab-present" type="radio" name="lab_present" id="lab_present_yes"
                                        value="1" <?php if(!empty($computerLabData)){ echo ($computerLabData['lab_present'] == 1) ?'checked' :'';}?>>
                                    <label class="form-check-label" for="lab_present_yes">Yes</label>
                                
                                    <input class="form-check-input lab-present" type="radio" name="lab_present" id="lab_present_no"
                                        value="0"<?php if(!empty($computerLabData)){ echo ($computerLabData['lab_present'] == 0) ?'checked' :'';}?>>
                                    <label class="form-check-label" for="lab_present_no">No</label>

                                <?php } ?>
                            </div>
                            <?php echo form_error('lab_present'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 computer-no-div" <?php if((set_value('lab_present') != 1)){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="no_of_computer">No of Computers<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="no_of_computer" id="no_of_computer" min="1" value="<?php if(!empty($computerLabData)){echo $computerLabData['no_of_computer']; }else{echo set_value('no_of_computer');} ?>">
                            <?php echo form_error('no_of_computer'); ?>
                        </div>
                    </div>

                    
                    <div class="col-md-4 computer-no-div" <?php if(set_value('lab_present') != 1){echo 'style="display: none;"';}?>>
                        <div class="form-group">
                            <label for="working_computer">No of Working Computers<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="working_computer" id="working_computer" min="1" value="<?php if(!empty($computerLabData)){echo $computerLabData['no_of_working_computer']; }else{echo set_value('working_computer');} ?>">
                            <?php echo form_error('working_computer'); ?>
                        </div>
                    </div>
               
                </div>
                <div class="row">
                    
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <label>&nbsp;</label><br>
                        <?php if($vtcDetails['second_final_submit_status']==0){?>
                        <?php if(!empty($computerLabData)){?>
                        <button type="submit" class="btn btn-success btn-block btn-sm uptd-lab-btn">Update Computer Lab Details</button>
                        <?php }else{?>
                            <button type="submit" class="btn btn-success btn-block btn-sm">Submit Computer Lab Details</button>
                        <?php }}?>
                    </div>

                </div>

                <?php echo form_close() ?>
            </div>
            <?php } else { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                Please complete and submit Affiliation Part I first.
            </div>
            <?php } ?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>