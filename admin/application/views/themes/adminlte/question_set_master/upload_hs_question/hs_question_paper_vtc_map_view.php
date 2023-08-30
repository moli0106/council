<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .highlight {
        padding: 9px 14px;
        margin-bottom: 14px;
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
        border-radius: 4px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>HS Question Paper Map with VTC Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-user"></i> HS Question Paper Map with VTC</li>
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
                <h3 class="box-title">HS Question Paper Map with VTC Details</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Course Name</label>
                            <input type="text" class="form-control" value="<?php echo $hs_question_details['course_name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" value="<?php echo $hs_question_details['subject_name'].' ['.$hs_question_details['subject_code'].']'; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Question Paper</label> <br>
                            <a href="<?php echo base_url('admin/question_set_master/upload_hs_question/download_uploaded_pdf/' . md5($hs_question_details['hs_question_id_pk'])); ?>" class="btn btn-sm btn-info"><i class="fa fa-download" aria-hidden="true"></i> PDF File</a>
                        </div>
                    </div>
                </div>

                <div class="highlight">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>VTC</th>
                                <!-- <th>Status</th>
                                <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($vtc_map_details))
                            {
                            $count = 0; ?>
                            <?php foreach ($vtc_map_details as $key => $value) { ?>
                                <tr id="<?php echo md5($value['hs_question_vtc_map_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['vtc_name']; ?>  <b>[<?php echo $value['vtc_code']?>]</b></td>
                                    
                                    <!-- <td>
                                        <?php if ($value['active_status'] == 1) { ?>
                                            <small class="label label-success">Active</small>
                                        <?php } else { ?>
                                            <small class="label label-danger">Deactive</small>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($value['active_status'] == 1) { ?>
                                            <button class="btn btn-sm btn-danger changeJobRoleStatus" data-name="Deactive">
                                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-success changeJobRoleStatus" data-name="Activate">
                                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                            </button>
                                        <?php } ?>
                                    </td> -->
                                </tr>
                            <?php } 
                        } else { ?>

                            <tr>
                                <td colspan="2" align="center" class="text-danger">No Data Found...</td>
                            </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                

                <?php echo form_open('admin/question_set_master/upload_hs_question/send_question_paper/' . md5($hs_question_details['hs_question_id_pk'])) ?>
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="">VTC *</label>
                                <select class="form-control select2" style="width: 100%;" name="vtc_id[]" id="vtc_id" multiple="multiple">
                                    <option value="">-- Select VTC --</option>
                                    <?php foreach($vtc_list as $vtc){ ?>
                                    <<option value="<?php echo $vtc['vtc_id_fk'] ?>"
                                        <?php echo set_select('vtc_id',$vtc['vtc_id_fk']) ?>>
                                        <?php echo $vtc['vtc_name'] ?> [<?php echo $vtc['vtc_code']?>]</option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('vtc_id[]'); ?>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-md-2 pull-right">
                        <div class="form-group" style="text-align: center;">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-block">Map Question</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>