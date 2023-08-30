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
                <?php echo form_open('admin/question/add_question',array("id"=> "question_entry_form")) ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Sector <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="sector_id" id="sector_id">
                                <option value="">-- Select Sector --</option>
                                <?php foreach($sectors as $sector){ ?>
                                <option value="<?php echo $sector['sector_id_pk'] ?>"
                                    <?php echo set_select('sector_id',$sector['sector_id_pk']) ?>>
                                    <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)</option>
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
                                <?php } } ?>
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
                                <option value="<?php echo $programme['programme_id_pk'] ?>"
                                    <?php echo set_select('programme_id',$programme['programme_id_pk']) ?>>
                                    <?php echo $programme['programme_name'] ?></option>
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
                                <option value="<?php echo $question_for['question_for_id_pk'] ?>"
                                    <?php echo set_select('question_for_id',$question_for['question_for_id_pk']) ?>>
                                    <?php echo $question_for['question_for_name'] ?></option>
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
                                <?php }?>
                                
                            </select>
                            <?php echo form_error('question_type_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Module <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="module_id">
                                <option value="">-- Select Module --</option>
                                <?php foreach($modules as $module){ ?>
                                <option value="<?php echo $module['module_id_pk'] ?>"
                                    <?php echo set_select('module_id',$module['module_id_pk']) ?>>
                                    <?php echo $module['module_name'] ?> </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('module_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
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
                    <div class="col-md-12">
                      <div class="form-group">
                            <label class="" for="">Question <span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Question" name="question" id="question"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('question'); ?>
                      </div>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                            <label class="" for="">Option A <span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Option A" name="optionA" id="optionA"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionA'); ?>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                            <label class="" for="">Option B <span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Option B" name="optionB" id="optionB"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionB'); ?>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                            <label class="" for="">Option C <span class="text-danger">*<span></label>
                            <textarea class="form-control" placeholder="Please Enter Option C" name="optionC" id="optionC"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionC'); ?>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                            <label class="" for="">Option D</label>
                            <textarea class="form-control" placeholder="Please Enter Option D" name="optionD" id="optionD"
                    autocomplete="off" value=""></textarea>
                            <?php echo form_error('optionD'); ?>
                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
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