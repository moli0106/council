<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .red-border {
        border: 2px solid #D32F2F;
    }

    .red-border:focus {
        border: 2px solid #D32F2F;
    }

    .green-border {
        border: 1px solid #388E3C;
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

        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-users" aria-hidden="true"></i> Student List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <?php echo form_open('admin/cssvsebatch/batch/addInternalMarks/' . $batch_id_hash, array('id' => 'internal-marks-form')) ?>

                    <input type="hidden" name="batch_id" value="<?php echo $batch_id_hash; ?>">
                    <table class="table table-hover" style="font-size: 13px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Reg. Number</th>
                                <th>Guardian Name</th>
                                <th>Date Of Birth</th>
                                <th>Class</th>
                                <th>Internal Marks</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $count = 0; ?>
                            <?php if (count($stdList) > 0) { ?>
                                <?php foreach ($stdList as $key => $value) { ?>
                                    <tr id="<?php echo md5($value['student_id_pk']); ?>">
                                        <td> <?php echo ++$count; ?>.</td>
                                        <td><?php echo $value['first_name']; ?> <?php echo $value['middle_name']; ?> <?php echo $value['last_name']; ?></td>
                                        <td><?php echo $value['registration_number']; ?></td>
                                        <td><?php echo $value['guardian_name']; ?></td>
                                        <td>
                                            <?php
                                            if ($value['date_of_birth']) {
                                                echo date("d-m-Y", strtotime($value['date_of_birth']));
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $value['class_name']; ?></td>
                                        <td width="200 px">
                                            <input type="number" class="form-control required" name="internal_marks[<?php echo $value['student_id_pk']; ?>]" placeholder="Enter Internal Marks" value="<?php echo $internal_marks[$value['student_id_pk']]; ?>">
                                            <?php echo form_error('internal_marks[' . $value['student_id_pk'] . ']'); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <?php if (empty($studentInternalMarks)) { ?>
                            <button type="button" class="btn btn-block bg-navy btn-flat" id="add-internal-marks-btn">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Add Internal Marks
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn btn-block bg-navy btn-flat" id="add-internal-marks-btn">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> Update Internal Marks
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>