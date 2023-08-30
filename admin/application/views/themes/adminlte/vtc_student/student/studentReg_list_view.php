<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Student List</li>
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
				
                <h3 class="box-title">Student List</h3><br>
				<h4><span class="text-danger"><b>*** Only for the batch of Short Term Courses starting from  July 2022 </b> </span></h4>
                <div class="box-tools pull-right">

                    <?php 
					if($school_reg_id_pk == 3964 || $school_reg_id_pk == 136 || $school_reg_id_pk == 1830 || $school_reg_id_pk == 1733 || $school_reg_id_pk == 1754 || $school_reg_id_pk == 1756 || $school_reg_id_pk == 1734 ){
					if($vtcDetails['second_final_submit_status'] == 1){?>
                    <?php //if($vtcDetails['second_final_submit_status'] != 1){?>
                        <a href="<?php echo base_url('admin/vtc_student/student_reg/add_student') ?>" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Add Student
                        </a>
                    <?php }}?>
                    
                    <a href="<?php echo base_url('admin/vtc_student/student_reg/download_consolidated_list') ?>" class="btn btn-warning btn-sm btn-flat">
                            <i class="fa fa-download" aria-hidden="true"></i> Download Consolidated List
                        </a>
                   
                </div>
            </div>
            <div class="box-body">
                
                <?php echo form_open('admin/vtc_student/student_reg', array('id' => 'vtc_search_form')) ?>
                <div class="row text-center">
                    <div class="col-sm-3"></div>

                    <div class="col-sm-3">

                        <label for="academic_year">Select Year:</label>
                        <select class ="" name="academic_year" id="academic_year"  style="width: 12em;height: 2em;">
                            <option value="">-- Select Year --</option>
                            <?php foreach($yearlist as $year){ ?>
                                <option value="<?php echo $year['academic_year'] ?>"
                                    <?php if($year['academic_year'] == $academic_year) echo 'selected'; ?>>
                                    <?php echo $year['academic_year'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" id="selected_year" value ="<?php echo $academic_year;?>">

                    </div>
                    <div class="col-sm-3">

                        <label for="batch_no">Select Batch:</label>
                        <select class ="" name="batch_no" id="batch_no"  style="width: 12em;height: 2em;">
                            <option value="">-- Select Batch No --</option>
                            <option value="1" <?php if($batch_no == 1) echo 'selected'; ?>>Batch 1</option>
                            <option value="2" <?php if($batch_no == 2) echo 'selected'; ?>> Batch 2</option>
                            <option value="3" <?php if($batch_no == 3) echo 'selected'; ?>> Batch 3</option>
                            
                        </select>
                        <input type="hidden" id="batch_no" value ="<?php echo $batch_no;?>">

                    </div>

                </div>
                
                <?php echo form_close() ?>
               
            
                <table class="table table-hover dom-jQuery-events" id="editable-sample" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <!-- <th >Email</th> -->
                            <!-- <th >Aadhar No</th>
                            <th >Mobile No</th> -->
                            <th>Registration Year</th>
                            <!-- <th>Date of Birth</th> -->
                            <th>course name</th>
                            <th>Group/Trade</th>
                            <th>Group/Trade Code</th>
                            <th>Status</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
           
        </div>

    </section>
</div>

<div class="modal modal-info fade" id="approve-reject-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Student Approve / Reject</h4>
            </div>
            <div class="modal-body approve-reject-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-reject-note" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Show Rejected Notes</h4>
            </div>
            <div class="modal-body reject-note-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Payment Modal -->

<div class="modal modal-info fade" id="payment_form_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Payment Details</h4>
            </div>
            <div class="modal-body payment-modal-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

