<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Course NoS Master</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Assessment Marks List</li>
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
                <h3 class="box-title">Add Course NoS Marks</h3>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                <?php echo form_open('admin/master/assessment_marks') ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Sector<span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="sector_id" id="sector_id">
                                <option value="" hidden="true">Select Sector</option>
                                <?php foreach ($sector_list as $key => $sector) { ?>
                                    <option value="<?php echo $sector['sector_id_pk']; ?>" <?php echo set_select('sector_id', $sector['sector_id_pk']) ?>>
                                        <?php echo $sector['sector_name']; ?>
                                        [<?php echo $sector['sector_code']; ?>]
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('sector_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Job Role<span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Job Role</option>
                                <?php
                                if (!empty($course_list)) {
                                    foreach ($form_course_list as $key => $course) { ?>
                                        <option value="<?php echo $course['course_id_pk']; ?>" <?php echo set_select('course_id', $course['course_id_pk']) ?>>
                                            <?php echo $course['course_name']; ?>
                                            [<?php echo $course['course_code']; ?>]
                                        </option>
                                <?php }
                                } else echo '<option value="" disabled="true">Select Sector First...</option>'; ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center"><br>
                        <button type="submit" class="btn btn-success">Add NoS to Course</button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Assessment Course Marks List</h3>
                <div class="box-tools pull-right">
                    <!-- <a href="<?php echo base_url('admin/master/assessment_marks/add_assessment_marks'); ?>" class="btn btn-block btn-info">
                        <i class="fa fa-book"></i> Add Assessment Marks
                    </a> -->
                </div>
            </div>
            <div class="box-body">
                <!-- <table class="table table-hover"> -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sector</th>
                            <th>Job Role</th>
                            <th>Total NoS</th>
                            <th>Total Marks</th>
                            <th>Total Pass Marks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($course_list)) {
                            $count = 0;
                            foreach ($course_list as $key => $course) { ?>

                                <tr>
                                    <td><?php echo ++$count; ?>.</td>
                                    <td>
                                        <?php echo $course['sector_name']; ?>
                                        [<?php echo $course['sector_code']; ?>]
                                    </td>
                                    <td>
                                        <?php echo $course['course_name']; ?>
                                        [<?php echo $course['course_code']; ?>]
                                    </td>
                                    <td><?php echo count($course['nos_list']); ?></td>
                                    <td><?php echo $course['total_marks']; ?></td>
                                    <td><?php echo $course['total_pass_marks']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/master/assessment_marks/nos_details/' . md5($course['course_id_fk'])) ?>" class="btn btn-sm btn-success">View NoS Details</a>
                                    </td>
                                </tr>

                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center"></div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>