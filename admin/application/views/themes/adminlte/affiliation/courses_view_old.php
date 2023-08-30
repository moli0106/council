<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i>Course Selection</li>
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
                <h3 class="box-title">Course Selection</h3>
                <div class="box-tools pull-right">
                    <?php if ((!empty($vtcCourseList)) && ($vtcDetails['final_submit_status'] == 0)) { ?>
                        <button class="btn btn-danger btn-sm" id="resetCourseSelection">Reset Course Selection</button>
                    <?php } ?>
                </div>
            </div>
            <?php if (!empty($vtcDetails)) { ?>
                <div class="box-body">
                    <?php echo form_open('admin/affiliation/courses/addCourse', array('id' => 'course-selection-form')) ?>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                <label class="" for="current_year">Current Year <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="current_year" value="<?php echo $academic_year; ?>" readonly="true">
                                <?php echo form_error('current_year'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php //if ($vtcDetails['hs_equivalent'] == 1) { 
                        ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Course Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="hs_equivalent_course_name" id="hs_equivalent_course_name">
                                    <option value="1" selected="true">HS-Voc</option>
                                </select>
                                <?php echo form_error('hs_equivalent_course_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="" for="">Select Discipline for HS-Voc <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="hs_equivalent_discipline[]" id="hs_equivalent_discipline" multiple="multiple">
                                    <?php foreach ($disciplineList as $discipline) { ?>
                                        <?php if (!empty($vtcCourseList)) { ?>
                                            <option value="<?php echo $discipline['discipline_id_pk'] ?>" <?php if (in_array($discipline['discipline_id_pk'], $vtcCourseList['hs_voc_discipline'])) {
                                                                                                                echo 'selected';
                                                                                                            } ?>>
                                                <?php echo $discipline['discipline_name'] ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $discipline['discipline_id_pk'] ?>">
                                                <?php echo $discipline['discipline_name'] ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>

                                <!-- <select class="form-control select2" name="hs_equivalent_discipline[]" id="hs_equivalent_discipline" multiple="multiple">
                                        <option value="4" <?php if (in_array(4, $hs_voc_discipline)) {
                                                                echo 'selected';
                                                            } ?>>Business and Commerce (BC) </option>
                                        <?php if (($vtcDetails['hs_science'] == 1) && ($vtcDetails['hs_biology'] == 1)) { ?>
                                            <option value="2" <?php if (in_array(2, $hs_voc_discipline)) {
                                                                    echo 'selected';
                                                                } ?>>Agriculture (AG) </option>
                                            <option value="3" <?php if (in_array(3, $hs_voc_discipline)) {
                                                                    echo 'selected';
                                                                } ?>>Home Science (HS) </option>
                                        <?php } ?>
                                        <?php if (($vtcDetails['hs_science'] == 1)) { ?>
                                            <option value="1" <?php if (in_array(1, $hs_voc_discipline)) {
                                                                    echo 'selected';
                                                                } ?>>Engineering and Technology (ET) </option>
                                        <?php } ?>

                                        <?php if (($vtcDetails['hs_science'] == 0) && ($vtcDetails['hs_biology'] == 1)) { ?>
                                            <option value="2" <?php if (in_array(2, $hs_voc_discipline)) {
                                                                    echo 'selected';
                                                                } ?>>Agriculture (AG) </option>
                                            <option value="3" <?php if (in_array(3, $hs_voc_discipline)) {
                                                                    echo 'selected';
                                                                } ?>>Home Science (HS) </option>
                                            <option value="1" <?php if (in_array(1, $hs_voc_discipline)) {
                                                                    echo 'selected';
                                                                } ?>>Engineering and Technology (ET) </option>
                                        <?php } ?>

                                        <option value="5" <?php if (in_array(5, $hs_voc_discipline)) {
                                                                echo 'selected';
                                                            } ?>>Paramedical (PM) </option>
                                    </select> -->

                                <?php echo form_error('hs_equivalent_discipline'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="" for="">Select courses for HS-Voc <span class="text-danger">*</span></label>
                                <select class="form-control select2" multiple="multiple" name="hs_voc_courses[]" id="coursesSelectionHsVoc">
                                    <?php if (!empty($vtcCourseList)) { ?>
                                        <?php foreach ($hsCourseList as $courseList) { ?>
                                            <option value="<?php echo $courseList['course_id_pk'] ?>" selected="true">
                                                <?php echo $courseList['group_name'] ?>
                                                [<?php echo $courseList['group_code'] ?>]
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled="true">No data found...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('hs_voc_courses'); ?>
                            </div>
                        </div>
                        <?php //} 
                        ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="">Course Name <span class="text-danger">*</span></label>
                                <select class="form-control" name="stc_course_name" id="stc_course_name">
                                    <option value="4" selected="true">VIII+ STC</option>
                                </select>
                                <?php echo form_error('stc_course_name'); ?>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="" for="">Select Discipline for VII+ STC <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="stc_discipline[]" id="stc_discipline" multiple="multiple">
                                    <?php foreach ($disciplineList as $discipline) { ?>
                                        <?php if (!empty($vtcCourseList)) { ?>
                                            <option value="<?php echo $discipline['discipline_id_pk'] ?>" <?php if (in_array($discipline['discipline_id_pk'], $vtcCourseList['stc_discipline'])) {
                                                                                                                echo 'selected';
                                                                                                            } ?>>
                                                <?php echo $discipline['discipline_name'] ?>
                                            </option>
                                        <?php } else { ?>
                                            <option value="<?php echo $discipline['discipline_id_pk'] ?>">
                                                <?php echo $discipline['discipline_name'] ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('stc_discipline'); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="" for="">Select courses for VIII+NQR or VIII+NSQF <span class="text-danger">*</span></label>
                                <select class="form-control select2" multiple="multiple" name="stc_course[]" id="coursesSelectionStc">
                                    <?php if (!empty($vtcCourseList)) { ?>
                                        <?php foreach ($stcCourseList as $courseList) { ?>
                                            <option value="<?php echo $courseList['course_id_pk'] ?>" selected="true">
                                                <?php echo $courseList['group_name'] ?>
                                                [<?php echo $courseList['group_code'] ?>]
                                            </option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="" disabled="true">No data found...</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('stc_course'); ?>
                            </div>
                        </div>
                    </div>
                    <?php if (empty($vtcCourseList)) { ?>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <label>&nbsp;</label><br>
                                <?php if (empty($vtcCourses)) { ?>
                                    <button type="button" class="btn btn-success btn-block btn-sm" id="course-selection-btn">Submit Course Selection</button>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php echo form_close() ?>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Basic Details is not completed for academic year <span class="label label-success"><?php echo $academic_year; ?></span>
                </div>
            <?php } ?>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>