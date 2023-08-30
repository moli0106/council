<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<?php
function response_status_color($id = NULL)
{
    switch ($id) {
        case 1:
            echo "bg-teal";
            break;
        case 2:
            echo "bg-fuchsia";
            break;
        case 3:
            echo "bg-maroon";
            break;
        case 4:
            echo "bg-aqua";
            break;
        case 5:
            echo "bg-navy";
            break;
        case 6:
            echo "bg-yellow";
            break;
        case 7:
            echo "bg-orange";
            break;
        case 8:
            echo "bg-aqua";
            break;
        case 9:
            echo "bg-green";
            break;
        case 10:
            echo "bg-red";
            break;
        case 11:
            echo "bg-olive";
            break;
        case 12:
            echo "bg-teal";
            break;
        default:
            echo NULL;
    }
}
?>
<style>
    .list-group-item {
        padding: 5px 8px !important;
    }

    .modal-lg {
        width: 80% !important;
    }

    .btn-secondary {
        color: #fff;
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        color: #fff;
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Assessment Batch List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Search Assessment Batch</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/assessment/awarding/batch/'); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Enter Batch Code</b></label>
                            <input type="text" class="form-control" name="batch_code" placeholder="Enter Batch Code" value="<?php echo $this->input->post('batch_code'); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Sector Name</b></label>
                            <select name="sector_code" id="sector_code" class="form-control select2">
                                <option value="" hiddden="true">Select Sector</option>
                                <?php foreach ($sector_list as $key => $sector) { ?>
                                    <option value="<?php echo $sector['sector_code']; ?>" <?php echo set_select('sector_code', $sector['sector_code']); ?>>
                                        <?php echo $sector['sector_name']; ?> [<?php echo $sector['sector_code']; ?>]
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Course Name</b></label>
                            <select name="course_code" id="course_code" class="form-control select2">
                                <option value="" hiddden="true">Select Course</option>
                                <?php if ($course_list != NULL) { ?>
                                    <?php foreach ($course_list as $key => $course) { ?>
                                        <option value="<?php echo $course['course_code']; ?>" <?php echo set_select('course_code', $course['course_code']); ?>>
                                            <?php echo $course['course_name']; ?> [<?php echo $course['course_code']; ?>]
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                                <option value="" disabled="true">Select Sector first...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Assessment Status</b></label>
                            <select name="assessment_status" id="assessment_status" class="form-control">
                                <option value="" hiddden="true">Select Assessment Status</option>
                                <option value="9" <?php echo set_select('assessment_status', 9); ?>>Assessor Approved</option>
                                <option value="11" <?php echo set_select('assessment_status', 11); ?>>Biometric Attendance Captured</option>
                                <option value="12" <?php echo set_select('assessment_status', 12); ?>>Trainee Marks Uploaded</option>
                                <option value="13" <?php echo set_select('assessment_status', 13); ?>>Assessment Completed</option>
                                <option value="14" <?php echo set_select('assessment_status', 14); ?>>Marksheet Generated</option>
                                <option value="15" <?php echo set_select('assessment_status', 15); ?>>Certificate Generated</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Proposed Assessment Date <small>(Exam Date)</small></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="common_input_div">
                                    <input type="text" name="proposed_assessment_date" class="form-control date-picker" placeholder="DD-MM-YYYY" readonly="true" value="<?php echo $this->input->post('proposed_assessment_date'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form_group">
                            <label><b>Assessment Scheme Type</b></label>
                            <select name="assessment_scheme" id="assessment_scheme" class="form-control">
                                <option value="" hiddden="true">Assessment Scheme Type</option>
                                <?php foreach ($assessment_scheme as $key => $scheme) { ?>
                                    <option value="<?php echo $scheme['assessment_scheme_id_pk']; ?>" <?php echo set_select('assessment_scheme', $scheme['assessment_scheme_id_pk']); ?>>
                                        <?php echo $scheme['assessment_scheme_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <!-- <label class="" for="">&nbsp;</label><br> -->
                        <button type="submit" class="btn btn-block btn-warning">
                            <i class="fa fa-search" aria-hidden="true"></i> Search Assessment Batch
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Assessment Batch List</h3>
                <div class="box-tools pull-right">
                    <!-- <a href="<?php echo base_url('admin/assessment/awarding/batch/passing_statistics_report') ?>" class="btn bg-maroon btn-sm btn-flat">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Passing Statistics Batch List
                    </a> -->
                    <button type="button" class="btn bg-maroon btn-sm btn-flat" data-toggle="modal" data-target="#modal-passing-statistics">Export Passing Statistics Batch List</button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Batch Basic Details</th>
                            <th>Other Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($batch_list)) {
                            $i = $offset;
                            foreach ($batch_list as $key => $batch) { ?>

                                <tr id="<?php echo md5($batch['assessment_batch_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong>Vertical Code : </strong>
                                                <?php echo $batch['vertical_code']; ?>

                                                <strong class="pull-right">
                                                    <?php echo $batch['assessment_scheme_name']; ?>
                                                </strong>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Batch Code : </strong>
                                                <?php echo $batch['user_batch_id']; ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>TC Name : </strong>
                                                <?php echo $batch['council_tc_name']; ?>
                                                [<?php echo $batch['council_tc_code']; ?>]
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Sector Name : </strong>
                                                <?php echo $batch['sector_name']; ?>
                                                [<?php echo $batch['sector_code']; ?>]
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Course Name : </strong>
                                                <?php echo $batch['course_name']; ?>
                                                [<?php echo $batch['course_code']; ?>]
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Council Assign Date : </strong>
                                                <?php echo date('d-m-Y', strtotime($batch['entry_time'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Tentative Assessment Date : </strong>
                                                <?php echo date('d-m-Y', strtotime($batch['batch_tentative_assessment_date'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Preferred Assessment Date 1 : </strong>
                                                <?php echo date('d-m-Y', strtotime($batch['prefered_assessment_date_1'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Preferred Assessment Date 2 : </strong>
                                                <?php echo date('d-m-Y', strtotime($batch['prefered_assessment_date_2'])); ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Assessment Status : </strong>
                                                <?php if ($batch['flag_finalize_assessment'] == 1) { ?>
                                                    <span class="badge bg-red process-name">&nbsp;</span>
                                                <?php } ?>

                                                <span class="badge <?php echo response_status_color($batch['process_id_fk']); ?> process-name">
                                                    <?php echo $batch['process_name']; ?>
                                                </span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/assessment/awarding/batch/traine_attendance/' . md5($batch['assessment_batch_id_pk'])); ?>" class="btn btn-info btn-xs btn-block">
                                            <i class="fa fa-users" aria-hidden="true"></i> Trainee Attendance
                                        </a>

                                        <?php if ($batch['flag_finalize_assessment'] == 1) { ?>

                                            <a href="<?php echo base_url('admin/assessment/awarding/batch/traine_marks/' . md5($batch['assessment_batch_id_pk'])); ?>" class="btn bg-navy btn-xs btn-block">
                                                <i class="fa fa-list-alt" aria-hidden="true"></i> Trainee Marks
                                            </a>

                                        <?php } elseif ($batch['flag_finalize_assessment'] == 2) { ?>

                                            <a href="<?php echo base_url('admin/assessment/awarding/batch/traine_marks/' . md5($batch['assessment_batch_id_pk'])); ?>" class="btn bg-navy btn-xs btn-block">
                                                <i class="fa fa-list-alt" aria-hidden="true"></i> Trainee Marks
                                            </a>

                                        <?php } ?>

                                        <?php if ($batch['flag_batch_marks_status'] == 1) { ?>

                                            <a href="<?php echo base_url('admin/assessment/awarding/batch/marksheet_certificate/' . md5($batch['assessment_batch_id_pk'])); ?>" class="btn bg-maroon btn-xs btn-block">
                                                <i class="fa fa-address-card-o" aria-hidden="true"></i> Marksheet / Certificate
                                            </a>

                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="4" align="center" class="text-danger">No Data Found...</td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<div class="modal modal-info fade" id="modal-passing-statistics" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Passing Statistics Report</h4>
            </div>

            <div class="modal-body modal-body-batch-confirmation" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="padding-bottom: 10px;">
                        <a href="<?php echo base_url('admin/assessment/awarding/batch/passing_statistics_report/1') ?>" class="btn bg-maroon btn-sm btn-flat btn-block">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Passing Statistics For PBSSD STT
                        </a>
                    </div>
                    <div class="col-md-6 col-md-offset-3" style="padding-bottom: 10px;">
                        <a href="<?php echo base_url('admin/assessment/awarding/batch/passing_statistics_report/2') ?>" class="btn bg-navy btn-sm btn-flat btn-block">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Passing Statistics For PBSSD RPL
                        </a>
                    </div>
                    <div class="col-md-6 col-md-offset-3" style="padding-bottom: 10px;">
                        <a href="<?php echo base_url('admin/assessment/awarding/batch/passing_statistics_report/3') ?>" class="btn bg-orange btn-sm btn-flat btn-block">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Passing Statistics For CSSVSE
                        </a>
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