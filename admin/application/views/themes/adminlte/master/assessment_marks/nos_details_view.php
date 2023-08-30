<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .modal-lg {
        width: 80% !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Course NoS Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="master/assessment_marks"><i class="fa fa-align-center"></i>Assessment Marks List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Add Course NoS Marks</li>
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
                <h3 class="box-title">Course Details</h3>
                <div class="box-tools pull-right">
                    <?php echo form_open('admin/master/assessment_marks') ?>
                    <input type="hidden" name="sector_id" value="<?php echo $course_details['sector_id_fk']; ?>">
                    <input type="hidden" name="course_id" value="<?php echo $course_details['course_id_pk']; ?>">
                    <button type="submit" class="btn btn-success">Add NoS to Course</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Sector Name/Code</b>
                                <a class="pull-right">
                                    <?php echo $course_details['sector_name']; ?>
                                    [<?php echo $course_details['sector_code']; ?>]
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Course Name/Code</b>
                                <a class="pull-right">
                                    <?php echo $course_details['course_name']; ?>
                                    [<?php echo $course_details['course_code']; ?>]
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($nos_details)) { ?>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">NoS List Details</h3>
                </div>
                <div class="box-body">
                    <table class="table table-hover table-bordered">
                        <tr style="background-color: #E8F5E9;">
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>#</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>NoS</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>No. of Question</strong></td>
                            <td colspan="4" align="center"><strong>Marks Allocation</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>Total Marks</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>Total Pass Marks</strong></td>
                            <td rowspan="2" style="vertical-align : middle;text-align:center;"><strong>Pass Marks for NoS</strong></td>
                            <td colspan="3" align="center"><strong>Pass Marks(%)</strong></td>
                            <td rowspan="2" align="center" style="vertical-align : middle;text-align:center;"><strong>Action</strong></td>
                        </tr>
                        <tr style="background-color: #E8F5E9;">
                            <td><strong>Theory</strong></td>
                            <td><strong>Practical</strong></td>
                            <td><strong>Viva</strong></td>
                            <td><strong>Total</strong></td>
                            <td><strong>Theory</strong></td>
                            <td><strong>Practical</strong></td>
                            <td><strong>Viva</strong></td>
                        </tr>
                        <?php $count = 0;
                        foreach ($nos_details as $key => $nos) {
                            $totalMarks     = $nos['nos_theory_marks'] + $nos['nos_practical_marks'] + $nos['nos_viva_marks'];
                        ?>

                            <tr id="<?php echo md5($nos['course_marks_id_pk']); ?>">
                                <td><?php echo ++$count; ?>.</td>
                                <td><?php echo $nos['nos_name']; ?>/<?php echo $nos['nos_code']; ?></td>
                                <td><?php echo $nos['nos_wise_no_of_theory_question']; ?></td>

                                <td><?php echo $nos['nos_theory_marks']; ?></td>
                                <td><?php echo $nos['nos_practical_marks']; ?></td>
                                <td><?php echo ($nos['nos_viva_marks'] != NULL) ? $nos['nos_viva_marks'] : 'N/A'; ?></td>
                                <td class="nosTotalMarks"><?php echo $totalMarks; ?></td>

                                <?php if ($count == 1) { ?>
                                    <td id="courseTotalMarks" rowspan="<?php echo count($nos_details); ?>" style="vertical-align : middle;text-align:center;"><?php echo $course_details['total_marks']; ?></td>
                                    <td id="coursePassMarks" rowspan="<?php echo count($nos_details); ?>" style="vertical-align : middle;text-align:center;"><?php echo $course_details['total_pass_marks']; ?></td>
                                <?php } ?>

                                <td><?php echo ($nos['pass_marks_for_each_nos']) ? $nos['pass_marks_for_each_nos'] : 'N/A'; ?></td>

                                <!-- <td><?php echo $nos['theory_pass_marks']; ?></td> -->
                                <!-- <td><?php echo $nos['practical_pass_marks']; ?></td> -->
                                <td><?php echo ($nos['theory_pass_marks']) ? $nos['theory_pass_marks'] : 'N/A'; ?></td>
                                <td><?php echo ($nos['practical_pass_marks']) ? $nos['practical_pass_marks'] : 'N/A'; ?></td>
                                <td><?php echo ($nos['viva_pass_marks']) ? $nos['viva_pass_marks'] : 'N/A'; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-info details-nos" data-toggle="modal" data-target="#modal-update-nos">
                                        <i class="fa fa-folder-open" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger remove-nos" data-toggle="modal" data-target="#modal-remove-nos">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>

                        <?php } ?>
                    </table>
                </div>
            </div>
        <?php }  ?>

    </section>
</div>

<!-- Modal -->
<div class="modal modal-success fade" id="modal-update-nos" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <h4 class="modal-title">Update NoS Details</h4>
            </div>
            <div class="modal-body nos-data" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-success fade" id="modal-remove-nos" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remove NoS from Course</h4>
            </div>
            <div class="modal-body modal-body-batch-confirmation" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;">
                <input type="hidden" class="form-control" id="inputIdHash">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group">
                            <label for="inputCourseTotalMarks">After deleting the NoS Total Marks for Job Role will be</label>
                            <input type="number" class="form-control" id="inputCourseTotalMarks" readonly="true">
                        </div>
                        <div class="form-group">
                            <label for="inputCoursePassMarks">Update Total Pass Marks for Job Role</label>
                            <input type="number" class="form-control" id="inputCoursePassMarks">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <button class="btn btn-sm btn-info btn-block confirmRemove">Confirm</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer batch-confirmation-modal-footer">
                <button type="button" id="modal-batch-confirmation-close" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>