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
            echo "bg-purple";
            break;
        case 8:
            echo "bg-orange";
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

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Assessment Batch List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/assessment/assessor/batch/printingExpenditure'); ?>" class="btn btn-flat btn-sm bg-maroon">
                        <i class="fa fa-print" aria-hidden="true"></i> Enter Printing Expenditure
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
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

                                    <tr id="<?php echo md5($batch['assessment_batch_assessor_map_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td>
                                            <ul class="list-group" style="font-size: 12px;">
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
                                                    <strong>Sector Code : </strong>
                                                    <?php echo $batch['sector_code']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Sector Name : </strong>
                                                    <?php echo $batch['sector_name']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Course Code : </strong>
                                                    <?php echo $batch['course_code']; ?>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul class="list-group" style="font-size: 12px;">
                                                <li class="list-group-item">
                                                    <strong>Course Name : </strong>
                                                    <?php echo $batch['course_name']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>TC Name : </strong>
                                                    <?php echo $batch['user_tc_name']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>TC Code : </strong>
                                                    <?php echo $batch['user_tc_code']; ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong><i class="fa fa-calendar" aria-hidden="true"></i> Proposed Assessment Date : </strong>
                                                    <?php echo date('d-m-Y', strtotime($batch['purpose_date'])); ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Assessment Status : </strong>
                                                    <?php if ($batch['flag_finalize_assessment'] == 1) { ?>
                                                        <span class="badge bg-red process-name">&nbsp;</span>
                                                    <?php } ?>

                                                    <span class="badge <?php echo response_status_color($batch['process_id_fk']); ?>">
                                                        <?php echo $batch['process_name']; ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-xs btn-block get-batch-details" data-toggle="modal" data-target="#modal-batch-details">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i> Batch Details
                                            </button>

                                            <?php if ($batch['process_id_fk'] == 8) { ?>
                                                <button type="button" class="btn btn-info btn-xs btn-block batch-confirmation" data-toggle="modal" data-target="#modal-batch-confirmation" data-id="<?php echo md5($batch['assessment_batch_id_pk']); ?>">
                                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                                    Approve / Inability
                                                </button>
                                            <?php } ?>

                                            <?php if ($batch['process_id_fk'] == 9 || $batch['process_id_fk'] == 11 || $batch['process_id_fk'] == 12 || $batch['process_id_fk'] == 13) { ?>

                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/downloadTraineeAttendenceList/' . md5($batch['assessment_batch_assessor_map_id_pk'])); ?>" class="btn btn-warning btn-xs btn-block">
                                                    <i class="fa fa-download" aria-hidden="true"></i> Attendence Sheet
                                                </a>

                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/downloadTraineeMarksList/' . md5($batch['assessment_batch_assessor_map_id_pk'])); ?>" class="btn bg-navy btn-xs btn-block">
                                                    <i class="fa fa-download" aria-hidden="true"></i> Marks Entery Sheet
                                                </a>

                                                <?php if ((date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day')) == $batch['purpose_date']) || (date('Y-m-d') == $batch['purpose_date'])) { ?>
                                                    <!-- <a href="<?php echo base_url('admin/assessment/assessor/batch/question_list_download/' . md5($batch['assessment_batch_assessor_map_id_pk'])); ?>" class="btn bg-purple btn-xs btn-block">
                                                        <i class="fa fa-download" aria-hidden="true"></i> Question Paper
                                                    </a> -->
                                                <?php } ?>
                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/question_list_download/' . md5($batch['assessment_batch_assessor_map_id_pk'])); ?>" class="btn bg-purple btn-xs btn-block">
                                                    <i class="fa fa-download" aria-hidden="true"></i> Question Paper
                                                </a>

                                                <?php if ($batch['assessment_scheme_name'] == 'CSSVSE') { ?>
                                                    <?php if (($batch['process_id_fk'] < 13) && ($batch['process_id_fk'] != 12)) { ?>
                                                        <button type="button" class="btn bg-maroon btn-xs btn-block complete-assessment" data-id="<?php echo md5($batch['assessment_batch_id_pk']); ?>">
                                                            <i class="fa fa-check" aria-hidden="true"></i></i> Assessment Completed
                                                        </button>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if (($batch['process_id_fk'] == 11) || (strpos($batch['user_batch_id'], 'ORG') !== FALSE)) { ?>
                                                        <button type="button" class="btn bg-navy btn-xs btn-block complete-assessment" data-id="<?php echo md5($batch['assessment_batch_id_pk']); ?>">
                                                            <i class="fa fa-check" aria-hidden="true"></i></i> Assessment Completed
                                                        </button>
                                                    <?php } ?>
                                                <?php } ?>


                                                <!-- <a href="<?php echo base_url('admin/assessment/assessor/batch/trainee_list/' . md5($batch['assessment_batch_assessor_map_id_pk'])); ?>" class="btn btn-info btn-xs btn-block">
                                                    <i class="fa fa-upload" aria-hidden="true"></i> Upload Marks
                                                </a> -->


                                                <?php if (($batch['process_id_fk'] == 13) || ($batch['flag_finalize_assessment'] == 1)) { ?>
                                                    <a href="<?php echo base_url('admin/assessment/assessor/batch/trainee_list/' . md5($batch['assessment_batch_assessor_map_id_pk'])); ?>" class="btn btn-info btn-xs btn-block">
                                                        <i class="fa fa-upload" aria-hidden="true"></i> Upload Marks
                                                    </a>
                                                <?php } ?>

                                                <?php if ($batch['process_id_fk'] == 9) { ?>
                                                    <!-- <button class="btn bg-maroon btn-xs btn-block approved-batch-inability">
                                                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                                        Batch Inability
                                                    </button> -->
                                                <?php } ?>

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
            </div>
            <div class="box-footer" style="text-align: center">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<div class="modal modal-success fade" id="modal-batch-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Assessment Batch Information</h4>
            </div>
            <div class="modal-body assessment-data" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-batch-confirmation" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <h4 class="modal-title">Batch Confirmation</h4>
            </div>
            <div class="modal-body modal-body-batch-confirmation" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;">
                <div class="overlay">
                    <div class="sp sp-wave"></div>
                </div>
            </div>
            <div class="modal-footer batch-confirmation-modal-footer">
                <button type="button" id="modal-batch-confirmation-close" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>