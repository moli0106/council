<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    .star {
        color: red;
        font-size: 14px;
    }

    .mtop20 {
        margin-top: 20px;
    }

    .mbottom20 {
        margin-bottom: 20px;
    }

    .mright20 {
        margin-right: 20px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Bulk SMS</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-key"></i>Send SMS</li>
        </ol>
    </section>
    <section class="content">
        <?php if($this->session->flashdata('status') !== null){ ?>
            <div class="alert alert-<?=$this->session->flashdata('status')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('alert_msg')?>
            </div>
        <?php } ?>
        <div class="box box-info">
            <div class="box-header with-border box-info">
                <h3 class="box-title"><i class="fa fa-file-text-o text-info" aria-hidden="true"></i> Send Bulk SMS</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/bulksms/sendsms', array("id"=> "send_bulk_sms")) ?>
             
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="" for="">Approved SMS Template ID *</label>
                                <input type="text" class="form-control" name="template_id" id="template_id" value="<?php echo set_value('template_id'); ?><?=$this->session->flashdata('template_id')?>" placeholder="Enter Template id">
                                <?php echo form_error('template_id'); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="" for="">Approved SMS Content *</label>
                                <textarea class="form-control" name="sms_content" id="sms_content" placeholder="Approved SMS Content"><?php echo set_value('sms_content'); ?><?=$this->session->flashdata('sms_content')?></textarea>
                                <?php echo form_error('sms_content'); ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="" for="">Mobile Numbers * <small class="text-danger">Enter max 50 mobile numbers.</small></label>
                                <textarea class="form-control" name="mobile_num" id="mobile_num" placeholder="Enter max 50 mobile nos. With comma seperated eg: 980xxxxxxx,896xxxxxxx,729xxxxxxx,..."><?php echo set_value('mobile_num'); ?><?=$this->session->flashdata('mobile_num')?></textarea>
                                <?php echo form_error('mobile_num'); ?>
                            </div>
                        </div>

                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-info btn-block">
                                Send SMS <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </div>

                    </div>
                
                <?php echo form_close() ?>
            </div>
        </div>

    </section>
    
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>