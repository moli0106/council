<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Category/Type & Marks</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Question Category/Type & Marks List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="row">

            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Type/Marks</h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('admin/qbm_master/question_type_mark') ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Question Category/Type Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="question_type" value="<?php echo set_value('question_type'); ?>" placeholder="Enter question name">
                                    <?php echo form_error('question_type'); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Per Question Mark <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="question_mark" value="<?php echo set_value('question_mark'); ?>" placeholder="Enter question mark ">
                                    <?php echo form_error('question_mark'); ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block btn-flat" name="submitQuestionCategory" value="1">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                    Submit Question Category
                                </button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Map Type/Marks with Subject </h3>
                    </div>
                    <div class="box-body">
                        <?php echo form_open('admin/qbm_master/question_type_mark') ?>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="course_id">Course <span class="text-danger">*<span></label>
                                    <select class="form-control" style="width: 100%;" name="course_id" id="course_id">
                                        <option value="" hidden="true">Select Course</option>
                                        <?php foreach ($courseList as $course) { ?>
                                            <option value="<?php echo $course['course_id_pk'] ?>" <?php echo set_select('course_id', $course['course_id_pk']) ?>>
                                                <?php echo $course['course_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('course_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="">Semester/Year <span class="text-danger">*<span></label>
                                    <select class="form-control" style="width: 100%;" name="sem_year_id" id="sem_year_id">
                                        <option value="" hidden="true">Select Semester/Year</option>

                                        <?php if ($this->input->server("REQUEST_METHOD") == "POST") { ?>
                                            <?php foreach ($semester_list as $semester) { ?>
                                                <option value="<?php echo $semester['semester_id_pk']; ?>" <?php echo set_select('sem_year_id', $semester['semester_id_pk']); ?>>
                                                    <?php echo $semester['semester_name']; ?>
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="" disabled="true">Select Course First...</option>
                                        <?php } ?>

                                    </select>
                                    <?php echo form_error('sem_year_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="">Discipline <span class="text-danger">*<span></label>
                                    <select class="form-control select2" style="width: 100%;" name="discipline_id" id="discipline_id">
                                        <option value="">-- Select Discipline --</option>

                                        <?php if ($this->input->server("REQUEST_METHOD") == "POST") { ?>
                                            <?php foreach ($discipline_list as $discipline) { ?>
                                                <option value="<?php echo $discipline['discipline_id_pk']; ?>" <?php echo set_select('discipline_id', $discipline['discipline_id_pk']); ?>>
                                                    <?php echo $discipline['discipline_name']; ?> [<?php echo $discipline['discipline_code']; ?>]
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="" disabled="true">Select Course First...</option>
                                        <?php } ?>

                                    </select>
                                    <?php echo form_error('discipline_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-4 div-group-trade" <?php if ((set_value('course_id') != 1) && (set_value('course_id') != 2)) {
                                                                        echo 'style="display: none;"';
                                                                    } ?>>
                                <div class="form-group">
                                    <label class="" for="">Group/Trade [Code] <span class="text-danger">*<span></label>
                                    <select class="form-control select2" style="width: 100%;" name="group_trade_id" id="group_trade_id">
                                        <option value="">-- Select Group/Trade --</option>

                                        <?php if ($this->input->server("REQUEST_METHOD") == "POST") { ?>
                                            <?php foreach ($group_trade_list as $group_trade) { ?>
                                                <option value="<?php echo $group_trade['group_trade_id_pk']; ?>" <?php echo set_select('group_trade_id', $group_trade['group_trade_id_pk']); ?>>
                                                    <?php echo $group_trade['group_trade_name']; ?> [<?php echo $group_trade['group_trade_code']; ?>]
                                                </option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="" disabled="true">Select Discipline First...</option>
                                        <?php } ?>

                                    </select>
                                    <?php echo form_error('group_trade_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="">Subject <span class="text-danger">*<span></label>
                                    <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject_id">
                                        <option value="">-- Select Subject --</option>
                                        <?php foreach ($subject_list as $subject) { ?>
                                            <?php if ($this->input->method(TRUE) == "POST") { ?>
                                                <option value="<?php echo $subject['subject_id_pk']; ?>" <?php echo set_select('subject_id', $subject['subject_id_pk']); ?>><?php echo $subject['subject_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                    <?php echo form_error('subject_id'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="" for="">Category/Type List <span class="text-danger">*<span></label>
                                <select class="form-control select2" style="width: 100%;" name="questionCategory" id="questionCategory">
                                    <option value="">-- Select Subject --</option>

                                    <?php foreach ($questionCategory as $key => $category) { ?>
                                        <option value="<?php echo $category['question_type_mark_id_pk']; ?>" <?php echo set_select('questionCategory', $category['question_type_mark_id_pk']); ?>>
                                            <?php echo $category['question_type_name']; ?>
                                            [<?php echo $category['question_mark']; ?>]
                                        </option>
                                    <?php } ?>

                                </select>
                                <?php echo form_error('questionCategory'); ?>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="" for="">Min. No. of Question Required <span class="text-danger">*<span></label>
                                    <input type="text" class="form-control" placeholder="Min. No. of Question" name="min_no_of_question" value="<?php echo set_value('min_no_of_question') ?>">
                                    <?php echo form_error('min_no_of_question'); ?>
                                </div>
                            </div>

                            <div class="col-md-4 col-md-offset-4">
                                <label class="" for="">&nbsp;</label>
                                <button type="submit" class="btn btn-warning btn-block btn-flat" name="mapCategoryWithSubject" value="2">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                    Map Category/Type with Subject
                                </button>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Type/Marks List</h3>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Question Category/Type</th>
                                <th>Mark</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            <?php
                            if (count($questionCategory)) {
                                $i = $offset;
                                foreach ($questionCategory as $key => $category) { ?>

                                    <tr id="<?php echo md5($category['question_type_mark_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $category['question_type_name']; ?></td>
                                        <td><?php echo $category['question_mark']; ?></td>
                                        <!-- <td>
                                            <a href="<?php echo base_url('admin/qbm_master/question_type_mark/update/' . md5($category['question_type_mark_id_pk'])); ?>" class="btn btn-sm btn-flat btn-info">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </a>
                                        </td> -->
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php } ?>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Subject map with Type/Marks</h3>
						<div class="pull-right">
							<a href="qbm_master/question_type_mark/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a>
						</div>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Subjest</th>
                                <th>Question Category/Type</th>
                                <th>Mark</th>
                                <th>Min. No. of Question</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            <?php
                            if (count($subjectMapCategoryList)) {
                                $i = $offset;
                                foreach ($subjectMapCategoryList as $key => $subjectMapCategory) { ?>

                                    <tr id="<?php echo md5($subjectMapCategory['subject_question_type_mark_map_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $subjectMapCategory['course_name']; ?></td>
                                        <td><?php echo $subjectMapCategory['subject_name']; ?> [<?php echo $subjectMapCategory['subject_code']; ?>]</td>
                                        <td><?php echo $subjectMapCategory['question_type_name']; ?></td>
                                        <td><?php echo $subjectMapCategory['question_mark']; ?></td>
                                        <td><?php echo $subjectMapCategory['min_no_of_question']; ?></td>
                                        <!-- <td>
                                            <a href="<?php echo base_url('admin/qbm_master/question_type_mark/update/' . md5($category['question_type_mark_id_pk'])); ?>" class="btn btn-sm btn-flat btn-info">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                            </a>
                                        </td> -->
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php } ?>
                        </table>
                    </div>

                    <!-- <div class="box-footer"></div> -->

                </div>
            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>