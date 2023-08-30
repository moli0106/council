<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Type/Mark</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Question Type/Mark Add</li>
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
                <h3 class="box-title">Question Type/Mark Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/question_type_mark/add') ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Course *</label>
                                <select class="form-control select2" style="width: 100%;" name="course_id">
                                    <option value="">-- Select Course --</option>
                                    <?php foreach($course_list as $course){ ?>
                                    <option value="<?php echo $course['course_id_pk'] ?>"
                                        <?php echo set_select('course_id',$course['course_id_pk']) ?>>
                                        <?php echo $course['course_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('course_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Question Type Name *</label>
                                <input type="text" class="form-control" name="question_type" id="question_type"
                                    value="<?php echo set_value('question_type'); ?>" placeholder="Enter question name">
                                <?php echo form_error('question_type'); ?>
                            </div>
                        </div>
					</div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Question Mark *</label>
                                <input type="text" class="form-control" name="question_mark" id="question_mark"
                                    value="<?php echo set_value('question_mark'); ?>" placeholder="Enter question mark ">
                                <?php echo form_error('question_mark'); ?>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">Minimum Number of Questions to be Entered by Question Creator *</label>
                                <input type="text" class="form-control" name="no_of_question" id="no_of_question"
                                    value="<?php echo set_value('no_of_question'); ?>" placeholder="Enter no of question ">
                                <?php echo form_error('no_of_question'); ?>
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

<script>
    $('.select2').select2();
</script>