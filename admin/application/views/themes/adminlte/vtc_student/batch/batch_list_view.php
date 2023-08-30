<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
function response_status_color($id = NULL)
{
    switch ($id) {
        case 1:
            echo "bg-orange";
            break;
        case 2:
            echo "bg-teal";
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
            echo "bg-fuchsia";
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
    .modal-lg {
        width: 80% !important;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Batch List</li>
        </ol>
    </section>

    <section class="content">

        <?php if ($this->session->flashdata('api_status') !== null) { ?>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4>
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            Batch Push Error Message
                            <small class="badge" style="color: #fff;">
                                <?= $this->session->flashdata('api_batch_code') ?>
                            </small>
                        </h4>
                        <div style="height: 230px; overflow-y: scroll; border: 1px solid #FFCC80; box-shadow: inset 0px 15px 8px -10px #CCC, inset 0px -15px 8px -10px #CCC;" id="custom-scrollbar">
                            <ol><?php echo $this->session->flashdata('api_error_msg') ?></ol>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Batch List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/vtc_student_batch/batch/jobrolelist') ?>" class="btn btn-success btn-sm btn-flat">
                        <i class="fa fa-users" aria-hidden="true"></i> Create Batch
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Batch Details</th>
                                <th>Other Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($batchList)) { ?>
                                <?php $count = 0; ?>
                                <?php foreach ($batchList as $key => $batch) { ?>

                                    <tr id="<?php echo md5($batch['batch_id_pk']); ?>">
                                        <td><?php echo ++$count; ?>.</td>
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
                                                    <strong><i class="fa fa-calendar" aria-hidden="true"></i> Start Date : </strong>
                                                    <?php echo date('d-m-Y', strtotime($batch['batch_start_date'])); ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong><i class="fa fa-calendar" aria-hidden="true"></i> End Date : </strong>
                                                    <?php echo date('d-m-Y', strtotime($batch['batch_end_date'])); ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong><i class="fa fa-calendar" aria-hidden="true"></i> Tentative Date : </strong>
                                                    <?php echo date('d-m-Y', strtotime($batch['batch_tentative_date'])); ?>
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Batch Status : </strong>
                                                    <span class="badge <?php echo response_status_color($batch['process_id_fk']); ?> process-name">
                                                        <?php echo $batch['process_name']; ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('admin/vtc_student_batch/batch/details/' . md5($batch['batch_id_pk'])) ?>" class="btn bg-navy btn-block btn-xs btn-flat">
                                                <i class="fa fa-folder-open-o" aria-hidden="true"></i> Batch Details
                                            </a>
                                            <!-- <a href="<?php echo base_url('admin/vtc_student_batch/batch/addInternalMarks/' . md5($batch['batch_id_pk'])) ?>" class="btn bg-blue btn-block btn-xs btn-flat">
                                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Internals Marks
                                            </a> -->
                                            <?php if ($batch['process_id_fk'] == 1) { ?>
                                                <button class="btn btn-danger btn-block btn-xs btn-flat get-batch-puch-details" data-toggle="modal" data-target="#modal-batch-details">
                                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> Batch Push
                                                </button>
                                            <?php } ?>
                                            <!-- added by atreyee 27-01-2023 -->
                                            <?php if ($batch['process_id_fk'] == 15) { ?>
                                                <a href="<?php echo base_url('admin/vtc_student_batch/batch/marksheet_certificate/' . md5($batch['user_batch_id'])); ?>" class="btn bg-maroon btn-xs btn-block">
                                                <i class="fa fa-address-card-o" aria-hidden="true"></i> Certificate
                                            </a>
                                            <?php } ?>

                                        </td>
                                    </tr>

                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8" class="text-center text-danger">No Data Found...</td>
                                <?php } ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
            </div>
    </section>
</div>

<div class="modal modal-danger fade" id="modal-batch-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" style="color: #fff;">Assessment Batch Information</h4>
            </div>
            <div class="modal-body assessment-data" style="background-color: #FFCDD2 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>