<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="vtc_student_batch/batch"><i class="fa fa-align-center"></i> Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Jobrole List</li>
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
                <h3 class="box-title"><i class="fa fa-th-list" aria-hidden="true"></i> Jobrole List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Sector</th>
                                <th>Job Role</th>
                                <th>Total Student</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($jobroleList)) { ?>
                                <?php $count = 0; ?>
                                <?php foreach ($jobroleList as $key => $jobrole) { ?>
                                    <tr>
                                        <td><?php echo ++$count; ?>.</td>
                                        <td>
                                            <?php echo $jobrole['jobroleDetails']['sector_name']; ?>&nbsp;
                                            <strong>[<?php echo $jobrole['jobroleDetails']['sector_code']; ?>]</strong>
                                        </td>
                                        <td>
                                            <?php echo $jobrole['jobroleDetails']['course_name']; ?>&nbsp;
                                            <strong>[<?php echo $jobrole['jobroleDetails']['course_code']; ?>]</strong>
                                        </td>
                                        <td><?php echo $jobrole['count']; ?></td>
                                        <td>
                                            <?php if ($jobrole['count'] > 0) { ?>
                                                <a href="<?php echo base_url('admin/vtc_student_batch/batch/create?sid=' . md5($jobrole['jobroleDetails']['sector_id_pk']) . '&cid=' . md5($jobrole['jobroleDetails']['course_id_pk'])) ?>" class="btn btn-success btn-xs btn-flat">
                                                    Create Batch
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No Data Found...</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
            </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>