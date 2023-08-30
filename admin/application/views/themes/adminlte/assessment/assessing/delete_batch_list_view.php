<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

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
        <h1>Deleted Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Deleted Assessment Batch List</li>
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
                <?php echo form_open('admin/assessment/assessing/delete_batch_list/'); ?>
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
                <br>
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
                <h3 class="box-title">Deleted Assessment Batch List</h3>
                <div class="box-tools pull-right">
                   

                    <!-- <a href="<?php echo $excel_export; ?>" class="btn bg-maroon btn-sm btn-flat">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Assessment Batch List
                    </a> -->
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
                                                <span class="badge bg-red process-name">
                                                    Assessment Batch Deleted
                                                </span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>

                                        <!-- Added by Moli -->
                                            

                                        <button type="button" class="btn btn-xs btn-block btn-warning modal-show-remarks" data-toggle="modal" data-target="#modal-show-remarks">
                                        <i class="fa fa-eye" aria-hidden="true"></i> View Delete Remarks
                                        </button>

                                       
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







<div class="modal modal-info fade" id="modal-show-remarks" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Remarks For Deleted Assessment Batch</h4>
            </div>
            <div class="modal-body delete-remarks-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                <!-- <label for="">Batch Code: </label><span id="batch-code-val"> </span><br><br>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <label class="" for="">Remarks : </label>
                            <span id="delete_remarks_val"></span>

                            
                        </div>
                    </div>
                </div> -->

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>