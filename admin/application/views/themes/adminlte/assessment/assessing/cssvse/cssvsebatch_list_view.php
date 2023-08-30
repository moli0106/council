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
        <h1>CSSVSE Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>CSSVSE Assessment Batch List</li>
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
                <h3 class="box-title">CSSVSE Assessment Batch List</h3>
                <div class="box-tools pull-right">
                    <?php echo form_open('admin/assessment/assessing/cssvsebatch'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form_group">
                                <input type="text" class="form-control" name="search_batch_code" placeholder="Enter Batch Code">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-info btn-sm btn-flat">
                                <i class="fa fa-search" aria-hidden="true"></i> Search Batch
                            </button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
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
                                                <span class="badge <?php echo response_status_color($batch['process_id_fk']); ?> process-name">
                                                    <?php echo $batch['process_name']; ?>
                                                </span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/assessment/assessing/cssvsebatch/details/' . md5($batch['assessment_batch_id_pk'])); ?>" class="btn btn-success btn-xs btn-block">
                                            <i class="fa fa-folder-open" aria-hidden="true"></i> Batch Details
                                        </a>
                                        <a href="<?php echo base_url('admin/assessment/assessing/cssvsebatch/add_student/' . md5($batch['assessment_batch_id_pk'])); ?>" class="btn bg-navy btn-xs btn-block">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i> Add Student
                                        </a>
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

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>