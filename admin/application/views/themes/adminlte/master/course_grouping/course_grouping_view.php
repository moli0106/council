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
        <h1>Assessment Course Grouping</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Master</li>
            <li class="active"><i class="fa fa-align-center"></i>Map Course List</li>
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
                <h3 class="box-title">Add Map Course</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/course_grouping') ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Select Course <span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Course</option>
                                <?php foreach ($course_list as $key => $course) { ?>
                                    <option value="<?php echo $course['course_id_pk']; ?>" <?php echo set_select('course_id', $course['course_id_pk']) ?>>
                                        <?php echo $course['course_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Select Map Course <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="course_map_id" id="course_map_id">
                                <option value="" disabled="true">Please select first Course</option>
                            </select>
                            <?php echo form_error('course_map_id'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-3 text-center">
                        <div class="form-group">
                            <label class="" for="">&nbsp;</label><br>
                            <button type="submit" class="btn btn-info">Submit Map Course</button>
                        </div>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Map Course List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course</th>
                            <th>Map Course</th>
                            
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($mapped_course_list)) {
                            $i = $offset;
                            foreach ($mapped_course_list as $key => $course) { ?>

                                <tr id="<?php echo md5($course['course_grouping_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td><?php echo $course['course_name_main']; ?></td>
                                    <td><?php echo $course['course_name']; ?></td>
                                    
                                </tr>

                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="3" align="center" class="text-danger">No Data Found...</td>
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