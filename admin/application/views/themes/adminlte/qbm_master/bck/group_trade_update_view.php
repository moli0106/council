<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation Course Master</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li><a href="master/affiliation_course"><i class="fa fa-book"></i> Affiliation Course Master List</a></li>
            <li class="active">Update</li>
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
                <h3 class="box-title">Affiliation Course Master Update</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/affiliation_course/update/' . md5($courseMaster['course_id_pk'])) ?>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="course_name_id">Select Course Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="course_name_id" id="course_name_id">
                                        <option value="" hidden="true">Select Course Name</option>
                                        <?php foreach ($courseNameList as $courseName) { ?>
                                            <option value="<?php echo $courseName['course_name_id_pk'] ?>" <?php if ($formData['course_name_id_fk'] == $courseName['course_name_id_pk']) echo "selected"; ?>>
                                                <?php echo $courseName['course_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('course_name_id'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="group_name">Enter Group/Trade Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="group_name" id="group_name" placeholder="Enter Group/Trade Name" value="<?php echo $formData['group_name']; ?>">
                                    <?php echo form_error('group_name'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="group_code">Enter Group/Trade Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="group_code" id="group_code" placeholder="Enter Group/Trade Code" value="<?php echo $formData['group_code']; ?>">
                                    <?php echo form_error('group_code'); ?>
                                </div>
                            </div>
                            <!-- <div class="col-md-6 streem-name-div" <?php if (set_value('course_name_id') > 1) {
                                                                            echo 'style="display: none;"';
                                                                        } ?>> -->
                            <div class="col-md-6 streem-name-div">
                                <div class="form-group">
                                    <label class="" for="streem_name_id">Select Streem Name <span class="text-danger">*</span></label>
                                    <select class="form-control" name="streem_name_id" id="streem_name_id">
                                        <option value="" hidden="true">Select Course Name</option>
                                        <?php foreach ($streemNameList as $streemName) { ?>
                                            <option value="<?php echo $streemName['streem_name_id_pk'] ?>" <?php if ($formData['streem_name_id_fk'] == $streemName['streem_name_id_pk']) echo "selected"; ?>>
                                                <?php echo $streemName['streem_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('streem_name_id'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <label class="" for="discipline_id">Select Discipline <span class="text-danger">*</span></label>
                                    <select class="form-control" name="discipline_id" id="discipline_id">
                                        <option value="" hidden="true">Select Course Name</option>
                                        <?php foreach ($disciplineList as $discipline) { ?>
                                            <option value="<?php echo $discipline['discipline_id_pk'] ?>" <?php if ($formData['discipline_id'] == $discipline['discipline_id_pk']) echo "selected"; ?>>
                                                <?php echo $discipline['discipline_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('discipline_id'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label>&nbsp;</label><br> <button type="submit" class="btn btn-success form-batch-btn">Update Course Master</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>