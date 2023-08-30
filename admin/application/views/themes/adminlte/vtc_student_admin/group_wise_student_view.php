<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<?php
function response_status_color($id = NULL)
{
    
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
        <h1><?php echo $vtcDetails['vtc_name'] ;?></h1><br>
        <h3>GROUP NAME : <b><?php echo $group['group_name'] ?> [<?php echo $group['group_code'] ?>]</b> </h3>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i>Student Registration</li>
            <li class="active"><i class="fa fa-align-center"></i>VTC / STC Student</li>
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
                <h3 class="box-title">VTC / STTC Student List</h3>
                <div class="box-tools pull-right">
                    <!-- <a href="<?php echo base_url('admin/assessment/assessing/batch/printingExpenditureReport') ?>" class="btn bg-orange btn-sm btn-flat">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Printing Expenditure Report
                    </a> -->

                    
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <!-- <th>VTC Code</th>
                            <th>Name</th> -->
                            <!--th>Category</th-->
                            <th>Student Name</th>
                            <th>Registration Number</th>
                            <!-- <th>No of Gen Student</th>
                            <th>No of KS Student</th>
                            <th>Total Student</th>
                            <th>Total Amount Paybale</th>
                            <th>Not Paymented Student</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($std_list)) {
                            $i = $offset;
                            foreach ($std_list as $key => $val) { ?>

                                <tr id="<?php echo md5($vtcDetails['vtc_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td>
                                        <?php echo $val['first_name']; ?>  <?php echo $val['middle_name']; ?>  <?php echo $val['last_name']; ?>
                                    </td>

                                    <td><?php echo $val['registration_number']; ?></td>
                                   
									

                                    <td>
                                    <!-- <a class="btn btn-info btn-xm" title = Details href="<?php  echo base_url('admin/vtc_student_admin/student_reg_admin/group_wise_student_list/'.md5($vtcDetails['vtc_id_pk']) .'/'.$val['course_id_fk']); ?>" > <i class="fa fa-folder-open-o" aria-hidden="true"></i></a> -->
                                    <a class="btn btn-info btn-xm" title = Details href="<?php  echo base_url('admin/vtc_student_admin/student_reg_admin/student_details/'.md5($val['student_id_pk'])); ?>"><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>    
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

<div class="modal modal-warning fade" id="modal-change-assessor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Assessor from Batch</h4>
            </div>
            <div class="modal-body change-assessor-data" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer change-assessor-modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline pull-left" id="submit-change-assessor">Change Assessor</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-assign-assessor" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('admin/assessment/assessing/batch/assignAssessor', array('id' => 'assign-assessor-form')) ?>
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <h4 class="modal-title">Assign Assessor in Batch</h4>
            </div>
            <div class="modal-body assessor-data" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;"></div>
            <div class="modal-footer assign-assessor-modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline pull-left" id="submit-assign-assessor">Assign Assessor</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<div class="modal modal-success fade" id="export-cssvse-student-marks-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Export Course wise CSSVSE student marks</h4>
            </div>
            <div class="modal-body assessment-data" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px;">
                <div class="row text-center">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('AGR/Q0402')); ?>" class="info-box-text bg-teal export-cssvse-student-marks">AGR/Q0402</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('AMH/Q0301')); ?>" class="info-box-text bg-fuchsia export-cssvse-student-marks">AMH/Q0301</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('ASC/Q1401')); ?>" class="info-box-text bg-maroon export-cssvse-student-marks">ASC/Q1401</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('BWS/Q0101')); ?>" class="info-box-text bg-aqua export-cssvse-student-marks">BWS/Q0101</a>
                    </div>

                    <div class=" col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('CON/Q0102')); ?>" class="info-box-text bg-navy export-cssvse-student-marks">CON/Q0102</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('ELE/Q3104')); ?>" class="info-box-text bg-yellow export-cssvse-student-marks">ELE/Q3104</a>
                    </div>
                </div>
                <div style="height: 50px;"></div>
                <div class="row text-center">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('HSS/Q5102')); ?>" class="info-box-text bg-teal export-cssvse-student-marks">HSS/Q5102</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('SSC/Q2212')); ?>" class="info-box-text bg-fuchsia export-cssvse-student-marks">SSC/Q2212</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('PSC/Q0104')); ?>" class="info-box-text bg-maroon export-cssvse-student-marks">PSC/Q0104</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('PSS/Q0107')); ?>" class="info-box-text bg-aqua export-cssvse-student-marks">PSS/Q0107</a>
                    </div>

                    <div class=" col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('RAS/Q0101')); ?>" class="info-box-text bg-navy export-cssvse-student-marks">RAS/Q0101</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('THC/Q0307')); ?>" class="info-box-text bg-orange export-cssvse-student-marks">THC/Q0307</a>
                    </div>
                </div>
                <div style="height: 50px;"></div>
                <div class="row text-center">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('MEP/Q7101')); ?>" class="info-box-text bg-teal export-cssvse-student-marks">MEP/Q7101</a>
                    </div>
                </div>

                <div style="height: 50px;"></div>
                <div class="row text-center">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('ASC/Q1402')); ?>" class="info-box-text bg-teal export-cssvse-student-marks">ASC/Q1402</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('CON/Q0103')); ?>" class="info-box-text bg-fuchsia export-cssvse-student-marks">CON/Q0103</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('ELE/Q4601')); ?>" class="info-box-text bg-maroon export-cssvse-student-marks">ELE/Q4601</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('HSS/Q5101')); ?>" class="info-box-text bg-aqua export-cssvse-student-marks">HSS/Q5101</a>
                    </div>

                    <div class=" col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('SSC/Q0110')); ?>" class="info-box-text bg-navy export-cssvse-student-marks">SSC/Q0110</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('PSC/Q0110')); ?>" class="info-box-text bg-yellow export-cssvse-student-marks">PSC/Q0110</a>
                    </div>
                </div>
                <div style="height: 50px;"></div>
                <div class="row text-center">
                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('RAS/Q0104')); ?>" class="info-box-text bg-teal export-cssvse-student-marks">RAS/Q0104</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('THC/Q4502')); ?>" class="info-box-text bg-fuchsia export-cssvse-student-marks">THC/Q4502</a>
                    </div>

                    <div class="col-md-2">
                        <a href="<?php echo base_url('admin/assessment/assessing/batch/exportCssvseStudentMarksReport/' . md5('SSS/Q0101')); ?>" class="info-box-text bg-maroon export-cssvse-student-marks">SSS/Q0101</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-change-propose-date" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Change Proposed Assessment Date</h4>
            </div>
            <div class="modal-body change-propose-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-delete-assessment-batch" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Delete Assessment Batch</h4>
            </div>
            <div class="modal-body assessment-batch-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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