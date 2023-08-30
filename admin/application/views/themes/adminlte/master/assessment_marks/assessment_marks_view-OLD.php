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
        <h1>Assessment Marks</h1>
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
                <h3 class="box-title">Add Course wise Marks for Assessment</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/assessment_marks') ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Sector : <span class="text-danger">*</span></label>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">Course : <span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Course</option>
                                <?php
                                if (!empty($course_list)) {
                                    foreach ($course_list as $key => $course) { ?>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="theory_marks">Theory Marks : <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter Theory Marks" name="theory_marks" id="theory_marks" value="<?php echo set_value('theory_marks'); ?>">
                            <?php echo form_error('theory_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="practical_marks">Practical Marks : <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter Practical Marks" name="practical_marks" id="practical_marks" value="<?php echo set_value('practical_marks'); ?>">
                            <?php echo form_error('practical_marks'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="total_marks">Total Marks : <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Total Marks" name="total_marks" id="total_marks" readonly="true" value="<?php echo set_value('total_marks'); ?>">
                            <?php echo form_error('total_marks'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="theory_percentage">Theory Pass Percentage : <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter Theory Pass Percentage" step="any" name="theory_percentage" id="theory_percentage" value="<?php echo set_value('theory_percentage'); ?>">
                            <?php echo form_error('theory_percentage'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="practical_percentage">Practical Pass Percentage : <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter Practical Pass Percentage" step="any" name="practical_percentage" id="practical_percentage" value="<?php echo set_value('practical_percentage'); ?>">
                            <?php echo form_error('practical_percentage'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-block btn-info">Submit</button>
                        </div>
                    </div>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Assessment Marks List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <!-- <table class="table table-hover"> -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Details</th>
                            <th>Marks Details</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($marks_list)) {
                            $count = 0;
                            foreach ($marks_list as $key => $marks) { ?>

                                <tr id="<?php echo md5($marks['course_marks_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong>Sector Name : </strong>
                                                <?php echo $marks['sector_name']; ?>
                                                [<?php echo $marks['sector_code']; ?>]
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Course Name : </strong>
                                                <?php echo $marks['course_name']; ?>
                                                [<?php echo $marks['course_code']; ?>]
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Added Date : </strong>
                                                <?php echo date('d-m-Y', strtotime($marks['entry_time'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Total Marks : </strong>
                                                <?php echo $marks['total_marks']; ?>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong>Theory Marks : </strong>
                                                <?php echo $marks['theory_marks']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Practical Marks : </strong>
                                                <?php echo $marks['practical_marks']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Theory Pass Percentage : </strong>
                                                <?php echo $marks['theory_percentage']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Practical Pass Percentage : </strong>
                                                <?php echo $marks['practical_percentage']; ?>
                                            </li>
                                        </ul>
                                    </td>
                                    <!-- <td><?php echo $marks['sector_name'] . ' [' . $marks['sector_code'] . ']'; ?></td>
                                    <td><?php echo $marks['course_name'] . ' [' . $marks['course_code'] . ']'; ?></td>
                                    <td><?php echo $marks['theory_marks']; ?></td>
                                    <td><?php echo $marks['practical_marks']; ?></td>
                                    <td><?php echo $marks['total_marks']; ?></td>
                                    <td><?php echo $marks['theory_percentage']; ?></td>
                                    <td><?php echo $marks['practical_percentage']; ?></td> -->
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