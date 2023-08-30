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
                <?php echo form_open('admin/master/question_creator_moderator_jexpo/add') ?>
                    
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
                                    <option value="10" <?php echo set_select('creator_moderator_type', 10) ?>>Question Creator</option>
                                    <option value="11" <?php echo set_select('creator_moderator_type', 11) ?>>Question Moderator</option>
                                </select>
                                <?php echo form_error('creator_moderator_type'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Select Exam Type *</label>
                                <select class="form-control select2 sector-id" style="width: 100%;" name="exam_type" id="exam_type">
                                    <option value="" hidden="true">Select Exam Type</option>
                                    <?php 
                                        if(count($exam_type_list))
                                        {
                                            foreach($exam_type_list as $exam_type){ ?>
                                                
                                                <option value="<?php echo $exam_type['exam_type_id_pk'] ?>" 
                                                    <?php echo set_select('exam_type', $exam_type['exam_type_id_pk']) ?>>
                                                    <?php echo $exam_type['exam_type_name'] ?>
                                                </option>
                                            <?php } 
                                        } else { echo'<option value="" disabled="true">No Data Found...</option>'; }
                                    ?>
                                </select>
                                <?php echo form_error('exam_type'); ?>
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Select Subject *</label>
                                <select class="form-control select2 sector-id" style="width: 100%;" name="subject_id" id="subject_id">
                                    <option value="" hidden="true">Select Subject</option>
                                    <?php 
                                        if(count($subjects))
                                        {
                                            foreach($subjects as $subject){ ?>
                                                <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                                <option value="<?php echo $subject['subject_id_pk'] ?>" 
                                                    <?php echo set_select('subject_id', $subject['subject_id_pk']) ?>>
                                                    <?php echo $subject['subject_name'] ?>
                                                </option>
                                            <?php } }
                                        } else { echo'<option value="" disabled="true">No Data Found...</option>'; }
                                    ?>
                                </select>
                                <?php echo form_error('subject_id'); ?>
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