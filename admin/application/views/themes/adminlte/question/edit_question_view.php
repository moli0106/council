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
                            <label class="" for="">Sector <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="sector_id" id="sector_id">
                                <option value="">-- Select Sector --</option>
                                <?php foreach($sectors as $sector){ ?>
                                  <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $sector['sector_id_pk']; ?>"  <?php echo $sector['sector_id_pk'] == $questions[0]['sector_id'] ? 'selected':'' ;?>><?php echo $sector['sector_name']; ?>(<?php echo $sector['sector_code'] ?>)</option>
                                    <?php } else {?>
                                      <option value="<?php echo $sector['sector_id_pk'] ?>"
                                    <?php echo set_select('sector_id',$sector['sector_id_pk']) ?>>
                                    <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)</option>
                                    <?php }?>
                                
                                <?php } ?>
                            </select>
                            <?php echo form_error('sector_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Course <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                <option value="">-- Select Course --</option>
                                <?php foreach($courses as $course){ ?>
                                  <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                <option value="<?php echo $course['course_id_pk'] ?>"
                                    <?php echo set_select('course_id',$course['course_id_pk']) ?>>
                                    <?php echo $course['course_name'] ?></option>
                                <?php }else{?>
                                  <option value="<?php echo $course['course_id_pk']; ?>"  <?php echo $course['course_id_pk'] == $questions[0]['course_id'] ? 'selected':'' ;?>><?php echo $course['course_name']; ?></option>
                               <?php }
                               } ?>
                            </select>
                    
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Name of Programme <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="programme_id">
                                <option value="">-- Select Programme --</option>
                                <?php foreach($programmes as $programme){ ?>
                                  <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $programme['programme_id_pk']; ?>"  <?php echo $programme['programme_id_pk'] == $questions[0]['programme_id'] ? 'selected':'' ;?>><?php echo $programme['programme_name']; ?></option>
                                    <?php } else {?>
                                <option value="<?php echo $programme['programme_id_pk'] ?>"
                                    <?php echo set_select('programme_id',$programme['programme_id_pk']) ?>>
                                    <?php echo $programme['programme_name'] ?></option>
                                    <?php }?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('programme_id'); ?>
                        </div>
                    </div>
                    
                    
                </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Question for <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="question_for_id" id="question_for_id">
                                <option value="">-- Select Question for --</option>
                                <?php foreach($questions_for as $question_for){ ?>
                                  <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $question_for['question_for_id_pk']; ?>"  <?php echo $question_for['question_for_id_pk'] == $questions[0]['question_for_id'] ? 'selected':'' ;?>><?php echo $question_for['question_for_name']; ?></option>
                                    <?php } else {?>
                                <option value="<?php echo $question_for['question_for_id_pk'] ?>"
                                    <?php echo set_select('question_for_id',$question_for['question_for_id_pk']) ?>>
                                    <?php echo $question_for['question_for_name'] ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                    
                            <?php echo form_error('question_for_id'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Question Type <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="question_type_id" id="question_type_id">
                                <option value="">-- Select Question Type --</option>
                                <?php  if($this->input->method(TRUE) == "POST"){ ?>
                                <?php if($this->input->post('question_for_id')==2){?>
                                    <?php foreach($questions_type as $question_type){ ?>
                                <option value="<?php echo $question_type['question_type_id_pk'] ?>"
                                    <?php echo set_select('question_type_id',$question_type['question_type_id_pk']) ?>>
                                    <?php echo $question_type['question_type_name'] ?></option>
                                    <?php }?>
                                <?php }else{?>
                                    <?php foreach($questions_type_trainee as $questions_trainee){ ?>
                                <option value="<?php echo $questions_trainee['question_type_id_pk'] ?>"
                                    <?php echo set_select('question_type_id',$questions_trainee['question_type_id_pk']) ?>>
                                    <?php echo $questions_trainee['question_type_name'] ?></option>
                                    <?php }?>

                                <?php }?>
                                <?php }else{?>
                                  <?php if($questions[0]['question_for_id']==2){?>
                                    <?php foreach($questions_type as $question_type){ ?>
                                <option value="<?php echo $question_type['question_type_id_pk'] ?>"
                                <?php echo $question_type['question_type_id_pk'] == $questions[0]['question_type_id'] ? 'selected':'' ;?>>
                                    <?php echo $question_type['question_type_name'] ?></option>
                                    <?php }?>
                                <?php }else{?>
                                    <?php foreach($questions_type_trainee as $questions_trainee){ ?>
                                <option value="<?php echo $questions_trainee['question_type_id_pk'] ?>"
                                <?php echo $questions_trainee['question_type_id_pk'] == $questions[0]['question_type_id'] ? 'selected':'' ;?>>
                                    <?php echo $questions_trainee['question_type_name'] ?></option>
                                    <?php }?>

                                <?php }?>
                                <?php }?>
                                
                            </select>
                            <?php echo form_error('question_type_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-3 module_show_hide" style="<?php echo $questions[0]['question_for_id'] == '2' ? "" : "display:none";?>">
                        <div class="form-group">
                            <label class="" for="">Module <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="module_id">
                                <option value="">-- Select Module --</option>
                                <?php foreach($modules as $module){ ?>
                                  <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $module['module_id_pk']; ?>"  <?php echo $module['module_id_pk'] == $questions[0]['module_id'] ? 'selected':'' ;?>><?php echo $module['module_name']; ?></option>
                                    <?php } else {?>
                                <option value="<?php echo $module['module_id_pk'] ?>"
                                    <?php echo set_select('module_id',$module['module_id_pk']) ?>>
                                    <?php echo $module['module_name'] ?> </option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('module_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-3 nos_show_hide" style="<?php echo $questions[0]['question_for_id'] == '1' ? "" : "display:none";?>">
                        <div class="form-group">
                            <label class="" for="">NoS <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="nos_id" id="nos_id">
                                <option value="">-- Select NoS --</option>
                                <?php foreach($nos_list as $nos){ ?>
                                  <?php if($this->input->method(TRUE) == 'GET'){ ?>
                                    <option value="<?php echo $nos['course_marks_id_pk']; ?>"  <?php echo $nos['course_marks_id_pk'] == $questions[0]['nos_id'] ? 'selected':'' ;?>><?php echo $nos['nos_name']; ?></option>
                                    <?php } else {?>
                                        <option value="<?php echo $nos['course_marks_id_pk'] ?>"<?php echo set_select('nos_id',$nos['course_marks_id_pk']) ?>><?php echo $nos['nos_name'] ?> </option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('nos_id'); ?>
                        </div>
                    </div>

                    

                    <div class="col-md-3">
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
                    <div class="col-md-3">
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
                    autocomplete="off" value=""><?php echo $questions[0]['question'] ?></textarea>
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
                    <div class="col-md-3">
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
                    autocomplete="off" value=""><?php echo $questions[0]['option1'] ?></textarea>
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
                    autocomplete="off" value=""><?php echo $questions[0]['option2'] ?></textarea>
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
                    autocomplete="off" value=""><?php echo $questions[0]['option3'] ?></textarea>
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
                    autocomplete="off" value=""><?php echo $questions[0]['option4'] ?></textarea>
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