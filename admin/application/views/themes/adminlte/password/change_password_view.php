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
        <h1>Change Password</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-key"></i>Change Password</li>
        </ol>
    </section>
    <section class="content">
        <?php if($this->session->flashdata('status') !== null){ ?>
            <div class="alert alert-<?=$this->session->flashdata('status')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('alert_msg')?>
            </div>
        <?php } ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Change Your Password</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/password/change_password',array("id"=> "change_password")) ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Old Password *</label>
                                    <input type="password" class="form-control" name="old_password" id="old_password" value="<?php echo set_value('old_password'); ?>" placeholder="Enter Old Password">
                                    <?php echo form_error('old_password'); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">New Password *</label>
                                    <input type="password" class="form-control" name="new_password" id="new_password" value="<?php echo set_value('new_password'); ?>" placeholder="Enter New Password">
                                    <?php echo form_error('new_password'); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Confirm Password *</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>" placeholder="Confirm Your Password">
                                    <?php echo form_error('confirm_password'); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">Update Password</button>
                            </div>

                        </div>
                    </div>
                    
                </div>
                <?php echo form_close() ?>
            </div>
        </div>

    </section>
    
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>