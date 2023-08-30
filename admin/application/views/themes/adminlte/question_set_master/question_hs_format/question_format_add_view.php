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
        /* background-color: #ECEFF1; */
        background-color: #F5F5F5;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
    }

    .question-box:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Questions Format for Polytechnic</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="question_set_master/question_format"><i class="fa fa-align-center"></i> Question Format List</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Add Question Format </li>
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
                    &nbsp; Add Questions Format
                </h3>
                <div class="box-tools pull-right">
                </div>
            </div>

            <div class="box-body">
                <?php echo form_open_multipart("admin/question_set_master/question_hs_format/add", array('id' => 'question_format_form')); ?>

                
                
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="subject_name">No. of Question Category/Type <span class="text-danger">*<span></label>
                            <input id="numberOfQuestionType" name="numberOfQuestionType" class="form-control" type="number" value="">
                            <?php echo form_error('numberOfQuestionType'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="course_id">Select Course <span class="text-danger">*<span></label>
                            <select class="form-control select2" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Course</option>
                                <?php if (!empty($courseList)) { ?>
                                    <?php foreach ($courseList as $course) { ?>
                                        <option value="<?php echo $course['course_id_pk'] ?>" <?php echo set_select('course_id', $course['course_id_pk']); ?>>
                                            <?php echo $course['course_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">No data found...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="sam_year_id">Select Semester/Year <span class="text-danger">*<span></label>
                            <select class="form-control select2 sam_year_discipline" name="sam_year_id" id="sam_year_id">
                                <option value="" hidden="true">Select Semester/Year</option>
                                <?php if (!empty($semesterList)) { ?>
                                    <?php foreach ($semesterList as $semester) { ?>
                                        <option value="<?php echo $semester['semester_id_pk']; ?>" <?php echo set_select('sam_year_id', $semester['semester_id_pk']); ?>>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="subject_id">Select Subject <span class="text-danger">*<span></label>
                            <select class="form-control select2" name="subject_id" id="subject_id">
                                <option value="">Select Subject</option>
                                <?php if (!empty($subjectList)) { ?>
                                    <?php foreach ($subjectList as $subject) { ?>
                                        <option value="<?php echo $subject['subject_id_pk']; ?>" <?php echo set_select('subject_id', $subject['subject_id_pk']); ?>>
                                            <?php echo $subject['subject_name']; ?> [<?php echo $subject['subject_code']; ?>]
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">Select Course First...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('subject_id'); ?>
                        </div>
                    </div>
                    

                    <!-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="discipline_id">Select Discipline <span class="text-danger">*<span></label>
                            <select class="form-control select2 sam_year_discipline" name="discipline_id" id="discipline_id">
                                <option value="">Select Discipline</option>
                                <?php if (!empty($DisciplinetList)) { ?>
                                    <?php foreach ($DisciplinetList as $Discipline) { ?>
                                        <option value="<?php echo $Discipline['discipline_id_pk']; ?>" <?php echo set_select('discipline_id', $Discipline['discipline_id_pk']); ?>>
                                            <?php echo $Discipline['discipline_name']; ?>
                                            [<?php echo $Discipline['discipline_code']; ?>]
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">Select Course First...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('discipline_id'); ?>
                        </div>
                    </div> -->

                    
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="question_code">Question Code <span class="text-danger">*<span></label>
                            <input type="text" class="form-control" placeholder="Question Code" value="<?php echo set_value('question_code'); ?>" name="question_code" id="question_code" readonly="true">
                            <?php echo form_error('question_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="month_and_year">Month & Year <span class="text-danger">*<span></label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input class="form-control" type="text" id="month_and_year" name="month_and_year" value="<?php echo set_value('month_and_year'); ?>" placeholder="mm/yyyy" readonly="true">
                            </div>
                            <?php echo form_error('month_and_year'); ?>
                        </div>
                    </div>

                    <div class=" col-md-3">
                        <div class="form-group">
                            <label for="time_allowed_id">Select Time Allowed <span class="text-danger">*<span></label>
                            <select class="form-control select2" name="time_allowed_id" id="time_allowed_id">
                                <option value="">Select Time Allowed</option>
                                <?php if (!empty($timeAllowedList)) { ?>
                                    <?php foreach ($timeAllowedList as $timeAllowed) { ?>
                                        <option value="<?php echo $timeAllowed['time_allowed_id_pk']; ?>" <?php echo set_select('time_allowed_id', $timeAllowed['time_allowed_id_pk']); ?>>
                                            <?php echo $timeAllowed['time_allowed']; ?> Hours
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('time_allowed_id'); ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="full_marks_id">Select Full Marks <span class="text-danger">*<span></label>
                            <select class="form-control select2" name="full_marks_id" id="full_marks_id">
                                <option value="">Select Full Marks</option>
                                <?php if (!empty($fullMarksList)) { ?>
                                    <?php foreach ($fullMarksList as $fullMarks) { ?>
                                        <option value="<?php echo $fullMarks['full_marks_id_pk']; ?>" <?php echo set_select('full_marks_id', $fullMarks['full_marks_id_pk']); ?>>
                                            <?php echo $fullMarks['full_marks']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <?php echo form_error('full_marks_id'); ?>
                        </div>
                    </div>
                    
                </div>

                <div class="question-set-block"></div>

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="next-question-div">
                            <button type="submit" class="btn btn-success btn-flat btn-sm btn-block">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Question Format
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