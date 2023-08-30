<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }

    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
    }

    .question-box {
        border: 4px solid #43A047;
        border-radius: 10px;
        border-top: none;
        border-bottom: none;
        padding: 5px 10px;
        margin-top: 15px;
        margin-bottom: 15px;
        background-color: #ECEFF1;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions Bank Module</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="qbm/questions/subjects"><i class="fa fa-list"></i> Subjest List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Add Question</li>
        </ol>
    </section>
    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    &nbsp; Add Questions
                </h3>
                <div class="box-tools pull-right">
                </div>
            </div>

            <div class="box-body">
                <?php echo form_open_multipart("admin/qbm/questions/create"); ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Course <span class="text-danger">*<span></label>
                            <select class="form-control" style="width: 100%;" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Course</option>
                                <?php if (!empty($courseList)) { ?>
                                    <?php foreach ($courseList as $course) { ?>
                                        <option value="<?php echo $course['course_id_pk'] ?>" <?php if ($formData['course_id'] == $course['course_id_pk']) echo 'selected'; ?>>
                                            <?php echo $course['course_name']; ?></option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">No data found...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Semester/Year <span class="text-danger">*<span></label>
                            <select class="form-control" style="width: 100%;" name="sam_year_id" id="sam_year_id">
                                <option value="" hidden="true">Select Semester/Year</option>
                                <?php if (!empty($semesterList)) { ?>
                                    <?php foreach ($semesterList as $semester) { ?>
                                        <option value="<?php echo $semester['semester_id_pk']; ?>" <?php if ($formData['sam_year_id'] == $semester['semester_id_pk']) echo 'selected'; ?>>
                                            <?php echo $semester['semester_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">Select Course First...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('sam_year_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Subject <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                <option value="">-- Select Subject --</option>
                                <?php if (!empty($subjectList)) { ?>
                                    <?php foreach ($subjectList as $subject) { ?>
                                        <option value="<?php echo $subject['subject_id_pk']; ?>" <?php if ($formData['subject_id'] == $subject['subject_id_pk']) echo 'selected'; ?>>
                                            <?php echo $subject['subject_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('subject_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Topic/Chapter <span class="text-danger">*<span></label>
                            <select class="form-control select2" style="width: 100%;" name="subject_topics_id" id="subject_topics_id">
                                <option value="">-- Select Topic/Chapter --</option>
                                <?php if (!empty($topicList)) { ?>
                                    <?php foreach ($topicList as $topic) { ?>
                                        <option value="<?php echo $topic['subject_topics_map_id_pk']; ?>" <?php if ($formData['subject_topics_id'] == $topic['subject_topics_map_id_pk']) echo 'selected'; ?>>
                                            <?php echo $topic['topics_chapter_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('subject_topics_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Question Category/Type [Marks] <span class="text-danger">*<span></label>
                            <select class="form-control" style="width: 100%;" name="question_type_marks" id="question_type_marks">
                                <option value="" hidden="true">Select Question Category/Type</option>
                                <?php if (!empty($questionTypeMarkList)) { ?>
                                    <?php foreach ($questionTypeMarkList as $typeMarks) { ?>
                                        <option value="<?php echo $typeMarks['question_type_mark_id_pk']; ?>" <?php if ($formData['question_type_marks'] == $typeMarks['question_type_mark_id_pk']) echo 'selected'; ?> data-marks="<?php echo $typeMarks['question_mark']; ?>">
                                            <?php echo $typeMarks['question_type_name']; ?>
                                            [<?php echo $typeMarks['question_mark']; ?>]
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">No data found...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('question_type_marks'); ?>
                        </div>
                    </div>
                </div>

                <?php if (!empty($question)) { ?>
                    <?php foreach ($question as $key => $value) { ?>
                        <div class="question-box">
                            <div class="row question-box-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">Enter Question (Text) <span class="text-danger">*<span></label>
                                        <textarea rows="5" style="width: 100%;" name="question[]" class="required"><?php echo $value; ?></textarea>
                                        <?php echo form_error('question'); ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="">Enter Clue/Answer (Text) <span class="text-danger">*<span></label>
                                        <textarea rows="2" style="width: 100%;" name="question_clue[]" class="required"><?php echo $question_clue[$key]; ?></textarea>
                                        <?php echo form_error('question_clue'); ?>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="upload_file">Upload Question Image <small>(Max size 100 KB)</small><span class="star">*</span></label>
                                        <div class="input-group">
                                            <input type="file" name="question_pic[]" class="form-control">
                                            <?php echo form_error('question_pic'); ?>
                                        </div>
                                    </div>
                                </div>
								
								<div class="col-md-3">
                                <div class="form-group">
                                    <label for="upload_file">Upload Answer/Clue Image <small>(Max size 100 KB)</small><span class="star">*</span></label>
                                    <div class="input-group">
                                        <input type="file" name="answer_pic[]" class="form-control">
                                        <?php echo form_error('answer_pic'); ?>
                                    </div>
                                </div>
                            </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="" for="">Question Marks <span class="text-danger">*<span></label>
                                        <input type="number" class="form-control per-question-marks required" name="per_question_marks[]" value="<?php echo $per_question_marks[$key]; ?>">
                                        <?php echo form_error('per_question_marks'); ?>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="" for="">QuestionType <span class="text-danger">*<span></label>
                                        <select class="form-control required" name="q_type[]">
                                            <option value="" hidden="true">Select Type</option>
                                            <option value="1">Analyze</option>
                                            <option value="2">Apply</option>
                                            <option value="3">Remember</option>
                                            <option value="4">Understand</option>
                                        </select>
                                        <?php echo form_error('q_type'); ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="question-box">
                        <div class="row question-box-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Enter Question (Text) <span class="text-danger">*<span></label>
                                    <textarea rows="5" style="width: 100%;" name="question[]" class="required"></textarea>
                                    <?php echo form_error('question'); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Enter Clue/Answer (Text) <span class="text-danger">*<span></label>
                                    <textarea rows="2" style="width: 100%;" name="question_clue[]" class="required"></textarea>
                                    <?php echo form_error('question_clue'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="upload_file">Upload Question Image <small>(Max size 100 KB)</small><span class="star">*</span></label>
                                    <div class="input-group">
                                        <input type="file" name="question_pic[]" class="form-control">
                                        <?php echo form_error('question_pic'); ?>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-3">
                                <div class="form-group">
                                    <label for="upload_file">Upload Answer/Clue Image <small>(Max size 100 KB)</small><span class="star">*</span></label>
                                    <div class="input-group">
                                        <input type="file" name="answer_pic[]" class="form-control">
                                        <?php echo form_error('answer_pic'); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="">Question Marks <span class="text-danger">*<span></label>
                                    <input type="number" class="form-control per-question-marks required" min="1" name="per_question_marks[]" value="">
                                    <?php echo form_error('per_question_marks'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="" for="">QuestionType <span class="text-danger">*<span></label>
                                    <select class="form-control required" name="q_type[]">
                                        <option value="" hidden="true">Select Type</option>
                                        <option value="1">Analyze</option>
                                        <option value="2">Apply</option>
                                        <option value="3">Remember</option>
                                        <option value="4">Understand</option>
                                    </select>
                                    <?php echo form_error('q_type'); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="next-question-div">
                            <button type="button" class="btn btn-warning btn-flat btn-sm btn-next">
                                <i class="fa fa-forward" aria-hidden="true"></i> Next
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class=" text-right save-question-div" style="display: none;">
                            <button type="submit" class="btn btn-success btn-flat btn-sm pull-right">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Question
                            </button>
                        </div>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>

        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>