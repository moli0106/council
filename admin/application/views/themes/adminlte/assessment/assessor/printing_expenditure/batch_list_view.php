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
        <h1>Printing Expenditure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Printing Expenditure</li>
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
                <h3 class="box-title">Printing Expenditure List</h3>
                <div class="box-tools pull-right"></div>
            </div>
            <div class="box-body">
                <div class="table-responsive" style="font-size: 11px;">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">#</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Batch Code</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Assessment Date</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Sector</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Job Role</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Batch Size</th>
                                <th colspan="3" style="vertical-align : middle;text-align:center;">No. of Pages Photocopied(including printing)</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Total No. of Pages</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Amount Claimed</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Scanned Copy of Bill(to be uploaded)</th>
                                <th rowspan="2" style="vertical-align : middle;text-align:center;">Action</th>
                            </tr>
                            <tr>
                                <th>Marks Foil</th>
                                <th>Attendance Sheet</th>
                                <th>Question Paper</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($batch_list)) {
                                $i = 0;
                                foreach ($batch_list as $key => $batch) { ?>

                                    <tr id="<?php echo md5($batch['assessment_batch_assessor_map_id_pk']); ?>">
                                        <td><?php echo ++$i; ?></td>
                                        <td><?php echo $batch['user_batch_id']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($batch['purpose_date'])); ?></td>
                                        <td>
                                            <?php echo $batch['sector_name']; ?>
                                            [<?php echo $batch['sector_code']; ?>]
                                        </td>
                                        <td>
                                            <?php echo $batch['course_name']; ?>
                                            [<?php echo $batch['course_code']; ?>]
                                        </td>
                                        <td><?php echo $batch['batch_size']; ?></td>
                                        <td><?php echo $batch['marks_foil']; ?></td>
                                        <td><?php echo $batch['attendance_sheet']; ?></td>
                                        <td><?php echo $batch['question_paper']; ?></td>
                                        <td><?php echo $batch['total_no_of_pages']; ?></td>
                                        <td><?php echo $batch['amount_claimed']; ?></td>
                                        <td align="center">
                                            <?php if (!empty($batch['amount_claimed'])) { ?>
                                                <a href="<?php echo base_url('admin/assessment/assessor/batch/downloadPrintingExpenditureDoc/' . md5($batch['printing_expenditure_id_pk'])); ?>" class="btn btn-xs btn-info btn-flat"><i class="fa fa-download"></i></a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($batch['amount_claimed'])) { ?>
                                                <span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Submited</span>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-xs btn-info btn-flat btn-block add-printing-expenditure" data-toggle="modal" data-target="#modal-add-printing-expenditure">Add</button>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                <?php }
                            } else { ?>

                                <tr>
                                    <td colspan="13" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer" style="text-align: center"></div>
        </div>
    </section>
</div>

<div class="modal modal-info fade" id="modal-update-printing-expenditure" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Printing Expenditure Bill</h4>
            </div>

            <div class="modal-body modal-body-batch-confirmation" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;">
                <?php echo form_open_multipart("admin/assessment/assessor/batch/updatePrintingExpenditure", array("id" => "update-printing-expenditure-form")); ?>
                <input type="hidden" name="id_hash" id="input-id-hash" class="form-control">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="stdLastName">Scanned Copy of Bill <small>(Upload PDF of 100 kb)</small><span class="text-danger">*</span></label>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="scanned_copy_of_bill" id="scanned_copy_of_bill">
                                    </span>
                                </label>
                                <input type="text" class="form-control required" readonly>
                            </div>
                            <?php echo form_error('scanned_copy_of_bill'); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-block btn-info btn-flat" id="btn-update-printing-expenditure">Update Bill</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer batch-confirmation-modal-footer">
                <button type="button" id="modal-batch-confirmation-close" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-add-printing-expenditure" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Enter Printing Expenditure</h4>
            </div>

            <div class="modal-body modal-body-batch-confirmation" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;">
                <?php echo form_open_multipart("admin/assessment/assessor/batch/printingExpenditure", array("id" => "printing-expenditure-form")); ?>
                <input type="hidden" name="map_batch_id" id="input-map-batch-id" class="form-control">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Marks Foil (<i><small>No. of Pages Photocopied</small></i>)<span class="text-danger">*</span></label>
                            <input type="number" name="marks_foil" id="input-marks-foil" class="form-control no-of-pages required" value="<?php echo set_value('marks_foil'); ?>">
                            <?php echo form_error('marks_foil'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Attendance Sheet (<i><small>No. of Pages Photocopied</small></i>)<span class="text-danger">*</span></label>
                            <input type="number" name="attendance_sheet" id="input-attendance-sheet" class="form-control no-of-pages required" value="<?php echo set_value('attendance_sheet'); ?>">
                            <?php echo form_error('attendance_sheet'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Question Paper (<i><small>No. of Pages Photocopied</small></i>)<span class="text-danger">*</span></label>
                            <input type="number" name="question_paper" id="input-question-paper" class="form-control no-of-pages required" value="<?php echo set_value('question_paper'); ?>">
                            <?php echo form_error('question_paper'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Total No. of Pages <span class="text-danger">*</span></label>
                            <input type="number" name="total_no_of_pages" id="total-no-of-pages" class="form-control required" value="<?php echo set_value('total_no_of_pages'); ?>" readonly>
                            <?php echo form_error('total_no_of_pages'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Amount Claimed <span class="text-danger">*</span></label>
                            <input type="number" name="amount_claimed" id="input-amount-claimed" class="form-control required" value="<?php echo set_value('amount_claimed'); ?>">
                            <?php echo form_error('amount_claimed'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stdLastName">Scanned Copy of Bill <small>(Upload PDF of 100 kb)</small><span class="text-danger">*</span></label>
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-success">
                                        Browse&hellip;<input type="file" style="display: none;" name="scanned_copy_of_bill" id="scanned_copy_of_bill">
                                    </span>
                                </label>
                                <input type="text" class="form-control required" readonly>
                            </div>
                            <?php echo form_error('scanned_copy_of_bill'); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-block btn-info btn-flat" id="btn-printing-expenditure">Submit</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer batch-confirmation-modal-footer">
                <button type="button" id="modal-batch-confirmation-close" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>