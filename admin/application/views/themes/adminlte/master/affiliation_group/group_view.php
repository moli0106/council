<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation Group</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation Group List</li>
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
                <h3 class="box-title">Add Affiliation Group</h3>
                <div class="box-tools pull-right"></div>
            </div>

            <div class="box-body">
                <?php echo form_open('admin/master/affiliation_group') ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Group Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="group_name" id="group_name" value="<?php echo set_value('group_name');?>">
                            <?php echo form_error('group_name'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="" for="">Group Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="group_code" id="group_code" value="<?php echo set_value('group_code');?>">
                            <?php echo form_error('group_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-4 text-center"><br>
                        <button type="submit" class="btn btn-success">Add Affiliation Group</button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Affiliation Group List</h3>
                <div class="box-tools pull-right">
                   

                    <a href="<?php echo base_url('admin/master/affiliation_group/downloadExcelForGroupList') ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Download Affiliation Group Master
                    </a>
                </div>
            </div>
            <div class="box-body">
                <!-- <table class="table table-hover"> -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Group Name</th>
                            <th>Group Code</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 13px;">
                        <?php
                        if (count($groupList)) {
                            $count = 0;
                            foreach ($groupList as $key => $val) { ?>

                                <tr id="<?php echo md5($val['group_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td>
                                        <?php echo $val['group_name']; ?>
                                    </td>
                                    <td>
                                        
                                        <?php echo $val['group_code']; ?>
                                    </td>

                                    <td>
                                        <?php 
                                            if($val['duration'] == 600){
                                                $duration = '600 hrs';
                                            }elseif ($val['duration'] == 1200) {
                                                $duration = '1200 hrs';
                                            }else{
                                                $duration = '';
                                            }
                                        ?>
                                        
                                        <?php echo $duration; ?>
                                    </td>
                                    
                                    
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm deleteAffiGroupMaster">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>

                                        <a  class="btn btn-sm btn-flat btn-info affiliation-group-details-btn"  data-toggle="modal" data-target="#modal-affiliation-group-details">
                                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        </a>
										
										  <a href="<?php echo base_url('admin/master/affiliation_group/assessment_course_select/' . md5($val['group_id_pk'])) ?>" target='_blank' class="btn btn-sm btn-success">Select Course</a>
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

<div class="modal modal-success fade" id="modal-affiliation-group-details" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Affiliation Group</h4>
            </div>
            <div class="modal-body affi-group-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>