<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>HS Question Code</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>HS Question Code</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
            <?php echo $this->session->flashdata('validation_errors_list') ?>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">HS Question Code Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/question_set_master/question_hs_code') ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Course *</label>
                            <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                <option value="">-- Select Course --</option>
                                <?php foreach ($course_list as $course) { ?>
                                    <option value="<?php echo $course['course_id_pk'] ?>" <?php echo set_select('course_id', $course['course_id_pk']) ?>>
                                        <?php echo $course['course_name'] ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>
                    <!--<div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Discipline *</label>
                            <select class="form-control select2" style="width: 100%;" name="discipline_id" id="discipline_id">
                                <option value="">-- Select Discipline --</option>
                                <?php foreach ($disciplineList as $discipline) { ?>
                                    <?php if ($this->input->method(TRUE) == "POST") { ?>
                                        <option value="<?php echo $discipline['discipline_id_pk'] ?>" <?php echo set_select('discipline_id', $discipline['discipline_id_pk']) ?>>
                                            <?php echo $discipline['discipline_name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <?php echo form_error('discipline_id'); ?>
                        </div>
                    </div>-->
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Subject *</label>
                            <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                <option value="">-- Select Subject --</option>
                                <?php foreach ($subjectList as $subject) { ?>
                                    <?php if ($this->input->method(TRUE) == "POST") { ?>
                                        <option value="<?php echo $subject['subject_id_pk'] ?>" <?php echo set_select('subject_id', $subject['subject_id_pk']) ?>>
                                            <?php echo $subject['subject_name'] ?> [<?php echo $subject['subject_code'] ?>]</option>
                                <?php }
                                } ?>
                            </select>
                            <?php echo form_error('subject_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Question Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="question_code" value="<?php echo (set_value('question_code')) ? set_value('question_code') : $this->session->flashdata('question_code') ?>" placeholder="Enter question code">
                            <?php echo form_error('question_code'); ?>
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

        <div class="box box-info">
            

            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Couse</th>
                            <!--<th>Discipline</th>
                            <th>Semester</th> -->
                            <th>Subject</th>
                            <th>Question Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($question_code_list)) {
                            $i = $offset;
                            foreach ($question_code_list as $key => $question_code) { ?>

                                <tr id="<?php echo md5($question_code['question_code_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td><?php echo $question_code['course_name']; ?></td>
                                    <td><?php echo $question_code['subject_name']; ?> [<?php echo $question_code['subject_code']; ?>]</td>
                                    <td><?php echo $question_code['question_code']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-question-code"><i class="fa fa-times" aria-hidden="true"></i></button>
                                        <!-- <a href="#" id="<?php echo md5($question_code['question_code_id_pk']); ?>" class="btn btn-sm btn-primary get-hs-question_code" data-toggle="modal" data-target="#modal-student-details">Edit</a> -->
                                    </td>
                                </tr>

                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="6" align="center" class="text-danger">No Data Found...</td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center">
                <?php echo $page_links ?>
            </div>
        </div>
    </section>
</div>

<div class="modal modal-success fade" id="modal-student-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">HS Question Code Details</h4>
            </div>
            <div class="modal-body student-data-div" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer change-assessor-modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>