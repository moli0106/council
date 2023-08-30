<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation Subject</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation Subject List</li>
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
                <h3 class="box-title">Add Affiliation Subject</h3>
                <div class="box-tools pull-right">
                    
                </div>
            </div>

            <div class="box-body">
                <?php echo form_open('admin/master/affiliation_subject') ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Subject Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subject_name" id="subject_name" value="<?php echo set_value('subject_name');?>">
                            <?php echo form_error('subject_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Subject Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subject_code" id="subject_code" value="<?php echo set_value('subject_code');?>">
                            <?php echo form_error('subject_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center"><br>
                        <button type="submit" class="btn btn-success">Add Affiliation Subject</button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Affiliation Subject List</h3>
                <div class="box-tools pull-right">
                    <a  class="btn btn-block btn-success createFullSubBtn" data-toggle="modal" data-target="#modal_full_subject_create_form" title="Create Full Subject">
                        <i class="fa fa-book"></i> Create Full Subject
                    </a>
                </div>
            </div>
            <div class="box-body">
                <!-- <table class="table table-hover"> -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject Name</th>
                            <th>Subject Code</th>
                            <th> Subject Type </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($subject)) {
                            $count = 0;
                            foreach ($subject as $key => $val) { ?>

                                <tr id="<?php echo md5($val['subject_name_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td>
                                        <?php echo $val['subject_name']; ?>
                                    </td>
                                    <td>
                                        
                                        <?php echo $val['subject_code']; ?>
                                    </td>

                                    <td>
                                        <?php 
                                            if($val['subject_type_id_fk'] == 2){
                                                $stype = 'Full Subject';
                                            }elseif ($val['subject_type_id_fk'] == 1) {
                                                $stype = 'Part Subject';
                                            }else{
                                                $stype = '';
                                            }
                                        ?>
                                        
                                        <?php echo $stype; ?>
                                    </td>
                                    
                                    <!-- <td>
                                        <a href="<?php echo base_url('admin/master/assessment_marks/nos_details/' . md5($course['course_id_fk'])) ?>" class="btn btn-sm btn-success">View NoS Details</a>
                                    </td> -->
                                    <td>

                                        <a class="btn btn-sm btn-flat btn-info assign-subject-type-btn" data-toggle="modal" data-target="#modal-assign-subject-type-details" title="Subject Type Update">
                                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm deleteAffiSubjectMaster">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>

                            <?php }
                        } else { ?>

                            <tr>
                                <td colspan="3" align="center" class="text-danger">No Data Found...</td>
                            </tr>

                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center"></div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>


<div class="modal modal-success fade" id="modal-assign-subject-type-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Subject Type</h4>

            </div>
            <div class="modal-body affi-subjecttype-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-success fade" id="modal_full_subject_create_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Create Full Subject</h4>

            </div>
            <div class="modal-body form_create_data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>