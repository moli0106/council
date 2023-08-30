<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Upload HS Question</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Upload HS Question</li>
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
                <h3 class="box-title">Upload HS Question </h3>
            </div>
            <div class="box-body">
                <?php echo form_open_multipart('admin/question_set_master/upload_all_hs_question/add') ?>
                    
             
				
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Academic Year *</label>
                                <select class="form-control select2" style="width: 100%;" name="academic_year" id="academic_year">
                                    <option value="">-- Select Academic Year --</option>
                                    <?php foreach($academic_year as $aca_year){ ?>
                                    <<option value="<?php echo $aca_year['academic_year_id_pk'] ?>"
                                        selected>
                                        <?php echo $aca_year['academic_year'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('academic_year'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Course *</label>
                                <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                    <option value="">-- Select Course --</option>
                                    <?php foreach($course_list as $course){ ?>
                                    <<option value="<?php echo $course['course_id_pk'] ?>"
                                        <?php echo set_select('course_id',$course['course_id_pk']) ?>>
                                        <?php echo $course['course_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('course_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Subject *</label>
                                <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                    <option value="">-- Select Subject --</option>
                                    <?php foreach($subjectList as $subject){ ?>
                                    <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                    <option value="<?php echo $subject['subject_id_pk'] ?>"
                                        <?php echo set_select('subject_id',$subject['subject_id_pk']) ?>>
                                        <?php echo $subject['subject_name'] ?> [<?php echo $subject['subject_code'] ?>]</option>
                                    <?php } }?>
                                </select>
                                <?php echo form_error('subject_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Eaxm Date <span class="text-danger">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="common_input_div">
                                        <input type="text" value="<?php echo set_value("exam_date"); ?>" class="form-control pull-right datepicker" id="exam_date" name="exam_date" placeholder="DD/MM/YYYY" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <?php echo form_error('exam_date'); ?>
                            </div>
                        </div>

                        <div class="col-md-3 bootstrap-timepicker">
                            <label for="timepicker">Exam Start Time (24 Hrs Format)</label>
                            <div class="input-group common_input_div">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" value="<?php echo set_value('start_time'); ?>" class="form-control pull-right timepicker" id="start_time" name="start_time" readonly>
                            </div>
                            <?php echo form_error('start_time'); ?>
                        </div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label for="upload_file">Upload PDF file only (Max size 5MB)<span class="star">*</span></label>
								<div class="input-group">
									<label class="input-group-btn">
										<span class="btn btn-info">
											Browse&hellip;<input type="file" style="display: none;" name="question_file" id="question_file">
										</span>
									</label>
									<input type="text" class="form-control" readonly>
								</div>
								<?php echo form_error('question_file'); ?>
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