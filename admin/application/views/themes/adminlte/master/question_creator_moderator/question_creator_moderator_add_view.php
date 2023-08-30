<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Creator/Moderator</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Question Creator/Moderator Add</li>
        </ol>
    </section>

    <section class="content">
        <?php if(isset($status)){ ?>
            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Question Creator/Moderator Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/question_creator_moderator/add') ?>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="f_name" value="<?php echo (set_value('f_name')) ? set_value('f_name') : $this->session->flashdata('f_name') ?>" placeholder="Enter first name">
                                <?php echo form_error('f_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Middle Name</label>
                                <input type="text" class="form-control" name="m_name" value="<?php echo (set_value('m_name')) ? set_value('m_name') : $this->session->flashdata('m_name') ?>" placeholder="Enter Middle Name">
                                <?php echo form_error('m_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="l_name" value="<?php echo (set_value('l_name')) ? set_value('l_name') : $this->session->flashdata('l_name') ?>" placeholder="Enter Last Name">
                                <?php echo form_error('l_name'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" value="<?php echo (set_value('email')) ? set_value('email') : $this->session->flashdata('email') ?>" placeholder="Enter Email">
                                <?php echo form_error('email'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mobile" value="<?php echo (set_value('mobile')) ? set_value('mobile') : $this->session->flashdata('mobile') ?>" placeholder="Enter Mobile Number">
                                <?php echo form_error('mobile'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Designation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="designation" value="<?php echo (set_value('designation')) ? set_value('designation') : $this->session->flashdata('designation') ?>" placeholder="Enter Designation">
                                <?php echo form_error('designation'); ?>
                            </div>
                        </div>
                        
                    </div>
				
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Select Question Creator/Moderator *</label>
                                <select class="form-control select2 sector-id" style="width: 100%;" name="creator_moderator_type">
                                    <option value="" hidden="true">Select Question Creator/Moderator</option>
                                    <option value="6" <?php echo set_select('creator_moderator_type', 6) ?>>Question Creator</option>
                                    <option value="7" <?php echo set_select('creator_moderator_type', 7) ?>>Question Moderator</option>
                                </select>
                                <?php echo form_error('creator_moderator_type'); ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="" for="">Select Sector *</label>
                                <select class="form-control select2 sector-id" style="width: 100%;" name="sector_id[]" multiple="multiple">
                                    <option value="" hidden="true">Select Sector</option>
                                    <?php 
                                        if(count($sector_list))
                                        {
                                            foreach($sector_list as $sector){ ?>
                                                
                                                <option value="<?php echo $sector['sector_id_pk'] ?>" 
                                                    <?php echo set_select('sector_id[]', $sector['sector_id_pk']) ?>>
                                                    <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)
                                                </option>
                                            <?php } 
                                        } else { echo'<option value="" disabled="true">No Data Found...</option>'; }
                                    ?>
                                </select>
                                <?php echo form_error('sector_id[]'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-block">Submit</button>
                        </div>
                    </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>