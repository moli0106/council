<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    .mbotm20 {margin-bottom:20px;}
    .imgcard {width:200px; height: 100px; overflow: hidden;}
    .imgcard_option {width:200px; height: 200px; overflow: hidden;}
    .imgcard img {width: 100%; height: 100%;}
    .imgcard_option img {width: 100%; height: 100%;}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Question</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Edit Question</li>
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
                <h3 class="box-title">Question Details Update</h3>
                <!-- <div class="box-tools pull-right">
                    <span class="label label-primary">Label</span>
                </div> -->
            </div>
            <div class="box-body">
            <?php echo form_open_multipart(base_url('admin/'.uri_string()),array('autocomplete'=> 'off'));?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Exam Type <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="exam_type" id="exam_type">
                                <option value="">-- Select Exam Type --</option>
                                <?php foreach($exam_type_list as $exam_type){ ?>
                                  <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $exam_type['exam_type_id_pk']; ?>"  <?php echo $exam_type['exam_type_id_pk'] == $questions[0]['exam_type_id_fk'] ? 'selected':'' ;?>><?php echo $exam_type['exam_type_name']; ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $exam_type['exam_type_id_pk'] ?>"
                                    <?php echo set_select('exam_type',$exam_type['exam_type_id_pk']) ?>>
                                    <?php echo $exam_type['exam_type_name'] ?> </option>
                                    <?php }?>
                                
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
                                <?php }else{?>
                                  <option value="<?php echo $subject['subject_id_pk']; ?>"  <?php echo $subject['subject_id_pk'] == $questions[0]['subject_id_fk'] ? 'selected':'' ;?>><?php echo $subject['subject_name']; ?></option>
                               <?php }
                               } ?>
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
                                  <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $level['level_id_pk']; ?>"  <?php echo $level['level_id_pk'] == $questions[0]['level_id'] ? 'selected':'' ;?>><?php echo $level['level_name']; ?></option>
                                    <?php } else {?>
                                <option value="<?php echo $level['level_id_pk'] ?>"
                                    <?php echo set_select('level_id',$level['level_id_pk']) ?>>
                                    <?php echo $level['level_name'] ?> </option>
                                <?php } ?>
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
                                    <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $question_pattern['question_pattern_id_pk']; ?>"  <?php echo $question_pattern['question_pattern_id_pk'] == $questions[0]['question_pattern'] ? 'selected':'' ;?>><?php echo $question_pattern['question_pattern_name']; ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $question_pattern['question_pattern_id_pk'] ?>"
                                    <?php echo set_select('question_pattern',$question_pattern['question_pattern_id_pk']) ?>>
                                    <?php echo $question_pattern['question_pattern_name'] ?> </option>
                                    <?php }?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('question_pattern'); ?>
                        </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                            <label class="" for="">Question <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET') {?>
                            <textarea class="form-control" placeholder="Please Enter Question" name="question" id="question"
                    autocomplete="off" value=""><?php echo openssl_decrypt($questions[0]['question'], $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'))?></textarea>
                    <?php } else{?>
                        <textarea class="form-control" placeholder="Please Enter Question" name="question" id="question"
                    autocomplete="off" value=""><?php echo set_value('question'); ?></textarea>
                    <?php }?>
                            <?php echo form_error('question'); ?>
                      </div>                    
                    </div>
                    <?php if($this->input->method(TRUE) == 'GET') {?>
                    <div class="col-md-3 que_pic_hide_show" style="<?php echo $questions[0]['question_pattern'] == '2' ? "" : "display:none";?>">
                      <div class="form-group">
                            <label class="" for="">Question (Pictorial) <span class="text-danger">*<span></label>
							<input type="file" value="" class="form-control-file" name="question_pic">
                            <?php echo form_error('question_pic'); ?>
                      </div>  
                    </div>
                    <div class="col-md-3 que_pic_hide_show" style="<?php echo $questions[0]['question_pattern'] == '2' ? "" : "display:none";?>">
                        <div class="imgcard">
                            <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($questions[0]['question_pic']); ?>"> 
                        </div>
                    </div>
                    <?php } else{?>
                    <div class="col-md-3 que_pic_hide_show" style="<?php echo $this->input->post("question_pattern") == '2' ? "" : "display:none";?>">
                      <div class="form-group">
                            <label class="" for="">Question (Pictorial) <span class="text-danger">*<span></label>
							<input type="file" value="" class="form-control-file" name="question_pic">
                            <?php echo form_error('question_pic'); ?>
                      </div>                    
                    </div>
                    <?php }?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Option Pattern <span class="text-danger">*<span></label>
							<select class="form-control select2" style="width: 100%;" name="option_pattern" id="option_pattern">
                                <option value="">-- Select Question Pattern --</option>
                                <?php foreach($question_option_patterns as $option_pattern){ ?>
                                    <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                        <option value="<?php echo $option_pattern['question_pattern_id_pk']; ?>"  <?php echo $option_pattern['question_pattern_id_pk'] == $questions[0]['option_pattern'] ? 'selected':'' ;?>><?php echo $option_pattern['question_pattern_name']; ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $option_pattern['question_pattern_id_pk'] ?>"
                                    <?php echo set_select('option_pattern',$option_pattern['question_pattern_id_pk']) ?>>
                                    <?php echo $option_pattern['question_pattern_name'] ?> </option>
                                    <?php }?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('option_pattern'); ?>
                        </div>                    
                    </div>
                </div>

                <?php if($this->input->method(TRUE) == 'GET') {
                    $option_pattern = $questions[0]['option_pattern'];
                    }else{
                    $option_pattern = $this->input->post("option_pattern");
                }?>

                <div class="row">
                    <div class="col-md-6 option_text_hide_show" style="<?php echo $option_pattern == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option A <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET') {?>
                            <textarea class="form-control" placeholder="Please Enter Option A" name="optionA" id="optionA"
                    autocomplete="off" value=""><?php echo openssl_decrypt($questions[0]['option1'], $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'))?></textarea>
                    <?php } else{?>
                        <textarea class="form-control" placeholder="Please Enter Option A" name="optionA" id="optionA"
                    autocomplete="off" value=""><?php echo set_value('optionA'); ?></textarea>
                    <?php }?>
                            <?php echo form_error('optionA'); ?>
                      </div>
                    </div>
                    <div class="col-md-3 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="form-group">
                            <label class="" for="">Option A (Pictorial) <span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionA_pic" name="optionA_pic">
                            <?php echo form_error('optionA_pic'); ?>
                        </div>
                    </div>

                    <div class="col-md-4 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="imgcard_option mbotm20">
                            <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($questions[0]['option1_pic']); ?>"> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 option_text_hide_show" style="<?php echo $option_pattern == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option B <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET') {?>
                            <textarea class="form-control" placeholder="Please Enter Option B" name="optionB" id="optionB"
                    autocomplete="off" value=""><?php echo openssl_decrypt($questions[0]['option2'], $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'))?></textarea>
                    <?php }else{?>
                        <textarea class="form-control" placeholder="Please Enter Option B" name="optionB" id="optionB"
                    autocomplete="off" value=""><?php echo set_value('optionB'); ?></textarea>
                    <?php }?>
                            <?php echo form_error('optionB'); ?>
                      </div>
                    </div>
                    <div class="col-md-3 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="form-group">
                            <label class="" for="">Option B  (Pictorial)<span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionB_pic" name="optionB_pic">
                            <?php echo form_error('optionB_pic'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="imgcard_option">
                            <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($questions[0]['option2_pic']); ?>"> 
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6 option_text_hide_show" style="<?php echo $option_pattern == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option C <span class="text-danger">*<span></label>
                            <?php if($this->input->method(TRUE) == 'GET') {?>
                            <textarea class="form-control" placeholder="Please Enter Option C" name="optionC" id="optionC"
                    autocomplete="off" value=""><?php echo openssl_decrypt($questions[0]['option3'], $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'))?></textarea>
                    <?php }else{?>
                        <textarea class="form-control" placeholder="Please Enter Option C" name="optionC" id="optionC"
                    autocomplete="off" value=""><?php echo set_value('optionC'); ?></textarea>
                    <?php }?>
                            <?php echo form_error('optionC'); ?>
                      </div>
                    </div>
                    
                    <div class="col-md-3 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="form-group">
                            <label class="" for="">Option C (Pictorial)<span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionC_pic" name="optionC_pic">
                            <?php echo form_error('optionC_pic'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="imgcard_option mbotm20">
                            <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($questions[0]['option3_pic']); ?>"> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 option_text_hide_show" style="<?php echo $option_pattern == '2' ? "display:none" : "display:block";?>">
                      <div class="form-group">
                            <label class="" for="">Option D</label>
                            <?php if($this->input->method(TRUE) == 'GET') {?>
                            <textarea class="form-control" placeholder="Please Enter Option D" name="optionD" id="optionD"
                    autocomplete="off" value=""><?php echo openssl_decrypt($questions[0]['option4'], $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'))?></textarea>
                        <?php }else{?>
                            <textarea class="form-control" placeholder="Please Enter Option D" name="optionD" id="optionD"
                    autocomplete="off" value=""><?php echo set_value('optionD'); ?></textarea>
                    <?php }?>
                            <?php echo form_error('optionD'); ?>
                      </div>
                    </div>
                    
                    <div class="col-md-3 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="form-group">
                            <label class="" for="">Option D  (Pictorial)<span class="text-danger">*<span></label>
                            <input type="file" class="form-control-file" id="optionD_pic" name="optionD_pic">
                            <?php echo form_error('optionD_pic'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 option_pic_hide_show" style="<?php echo $option_pattern == '2' ? "" : "display:none";?>">
                        <div class="imgcard_option mbotm20">
                            <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($questions[0]['option4_pic']); ?>"> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Correct Answer <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="correctAns" id="correctAns">
                                <option value="">-- Select Correct Answer --</option>
                                <?php if($this->input->method(TRUE) == 'POST'){?>
                                <option value="A" <?php echo set_select('correctAns','A') ?>>A</option>
                                <option value="B" <?php echo set_select('correctAns','B') ?>>B</option>
                                <option value="C" <?php echo set_select('correctAns','C') ?>>C</option>
                                <option value="D" <?php echo set_select('correctAns','D') ?>>D</option>
                                <?php }else{?>
                                  <option value="A" <?php echo ('A' == $questions[0]['right_answer']  ? "selected" : "");?>>A</option>
                                  <option value="B" <?php echo ('B' == $questions[0]['right_answer']  ? "selected" : "");?>>B</option>
                                  <option value="C" <?php echo ('C' == $questions[0]['right_answer']  ? "selected" : "");?>>C</option>
                                  <option value="D" <?php echo ('D' == $questions[0]['right_answer']  ? "selected" : "");?>>D</option>
                                <?php }?>
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