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
        <h1>Add Question</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Add Question</li>
        </ol>
    </section>
    <section class="content">
        <?php if(isset($status)){ ?>

        <div class="alert alert-<?php echo $status ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message ?>
        </div>

        <?php } ?>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Question Details Entry</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
                
				<?php echo form_open_multipart("admin/question/add_question_jexpo_voclet",array("id" => "question_entry_form"));?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Exam Type <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="exam_type" id="exam_type">
                                <option value="">-- Select Exam Type --</option>
                                <?php foreach($exam_type_list as $exam_type){ ?>
                                <option value="<?php echo $exam_type['exam_type_id_pk'] ?>"
                                    <?php echo set_select('exam_type',$exam_type['exam_type_id_pk']) ?>>
                                    <?php echo $exam_type['exam_type_name'] ?> </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('exam_type'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Subject <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                <option value="">-- Select Subject --</option>
                                <?php foreach($subjects as $subject){ ?>
                                  <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                <option value="<?php echo $subject['subject_id_pk'] ?>"
                                    <?php echo set_select('subject_id',$subject['subject_id_pk']) ?>>
                                    <?php echo $subject['subject_name'] ?></option>
                                <?php } } ?>
                            </select>
                    
                            <?php echo form_error('subject_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Level <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="level_id">
                                <option value="">-- Select Level --</option>
                                <?php foreach($levels as $level){ ?>
                                <option value="<?php echo $level['level_id_pk'] ?>"
                                    <?php echo set_select('level_id',$level['level_id_pk']) ?>>
                                    <?php echo $level['level_name'] ?> </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('level_id'); ?>
                        </div>
                    </div>
                    
                    
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Question Pattern <span class="text-danger">*<span></label>
							<select class="form-control select2" style="width: 100%;" name="question_pattern" id="question_pattern">
                                <option value="">-- Select Question Pattern --</option>
                                <?php foreach($question_option_patterns as $question_pattern){ ?>
                                <option value="<?php echo $question_pattern['question_pattern_id_pk'] ?>"
                                    <?php echo set_select('question_pattern',$question_pattern['question_pattern_id_pk']) ?>>
                                    <?php echo $question_pattern['question_pattern_name'] ?> </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('question_pattern'); ?>
                        </div>                    
                    </div>
                </div>
                

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="" for="">Question (Text) <span class="text-danger">*<span></label>
							<textarea class="form-control" placeholder="Please Enter question" name="question" id="question"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('question'); ?>
                        </div>                    
                    </div>
					<div class="col-md-4 que_pic_hide_show" style="<?php echo $this->input->post("question_pattern") == '2' ? "" : "display:none";?>">
                      <div class="form-group">
                            <label class="" for="">Question (Pictorial) <span class="text-danger">*<span></label>
							<input type="file" value="" class="form-control-file" name="question_pic">
                            <?php echo form_error('question_pic'); ?>
                      </div>                    
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Option Pattern <span class="text-danger">*<span></label>
							<select class="form-control select2" style="width: 100%;" name="option_pattern" id="option_pattern">
                                <option value="">-- Select Option Pattern --</option>
                                <?php foreach($question_option_patterns as $option_pattern){ ?>
                                <option value="<?php echo $option_pattern['question_pattern_id_pk'] ?>"
                                    <?php echo set_select('option_pattern',$option_pattern['question_pattern_id_pk']) ?>>
                                    <?php echo $option_pattern['question_pattern_name'] ?> </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('option_pattern'); ?>
                        </div>                    
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 option_text_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option A (Text)<span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Option A" name="optionA" id="optionA"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionA'); ?>
                      </div>
                    </div>
					<div class="col-md-4 option_pic_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "" : "display:none";?>">
                      <div class="form-group">
                            <label class="" for="">Option A (Pictorial) <span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionA_pic" name="optionA_pic">
                            <?php echo form_error('optionA_pic'); ?>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 option_text_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option B (Text)<span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Option B" name="optionB" id="optionB"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionB'); ?>
                      </div>
                    </div>
					<div class="col-md-4 option_pic_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "" : "display:none";?>">
                      <div class="form-group">
                            <label class="" for="">Option B  (Pictorial)<span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionB_pic" name="optionB_pic">
                            <?php echo form_error('optionB_pic'); ?>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 option_text_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option C (Text)<span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Option C" name="optionC" id="optionC"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionC'); ?>
                      </div>
					</div>
					<div class="col-md-4 option_pic_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "" : "display:none";?>">
                      <div class="form-group">
                            <label class="" for="">Option C (Pictorial)<span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionC_pic" name="optionC_pic">
                            <?php echo form_error('optionC_pic'); ?>
                      </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-8 option_text_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option D (Text)<span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Option D" name="optionD" id="optionD"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionD'); ?>
                      </div>
					</div>
					<div class="col-md-4 option_pic_hide_show" style="<?php echo $this->input->post("option_pattern") == '2' ? "" : "display:none";?>">
                      <div class="form-group">
                            <label class="" for="">Option D  (Pictorial)<span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionD_pic" name="optionD_pic">
                            <?php echo form_error('optionD_pic'); ?>
                      </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="" for="">Correct Answer <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="correctAns" id="correctAns">
                                <option value="">-- Select Correct Answer --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                            <?php echo form_error('correctAns'); ?>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>