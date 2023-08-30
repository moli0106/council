<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Batch List</li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('status') !== null){ ?>
            <div class="alert alert-<?=$this->session->flashdata('status')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('alert_msg')?>
            </div>
        <?php } ?>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Batch Details</h3>
                <div class="box-tools pull-right">
                    <button id="assignQuestion" data-id="<?php echo $this->uri->segment(4); ?>" class="btn btn-success btn-sm">Assign Question to Batch</button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3"><strong>Batch Type</strong></div>
                    <div class="col-md-3">: 
					<?php
						echo ($batchDetails[0]['batch_type'] == 1)?'Domain':'Platform';
					?>
					</div>
                    <div class="col-md-3"><strong>Assessment Mode</strong></div>
                    <div class="col-md-3">:
					<?php
						echo ($batchDetails[0]['assment_mode'] == 1)?'Online':'Offline';
					?>
					</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Date :</strong></div>
                    <div class="col-md-3">: <?php echo date('d-m-Y',strtotime($batchDetails[0]['start_date'])).' <i>to</i> '.date('d-m-Y',strtotime($batchDetails[0]['end_date'])); ?></div>
                    <div class="col-md-3"><strong>Time :</strong></div>
                    <div class="col-md-3">: <?php echo $batchDetails[0]['start_time'].' <i>to</i> '.$batchDetails[0]['end_time']; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Trainer :</strong></div>
                    <div class="col-md-3">: <?php echo $this->session->userdata['stake_holder_details']; ?></div>
                    <div class="col-md-3"><strong>Sector :</strong></div>
                    <div class="col-md-3"><?php echo ($batchDetails[0]['sector_name'])?$batchDetails[0]['sector_name']:'--'; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Job Role :</strong></div>
                    <div class="col-md-9">: <?php echo ($batchDetails[0]['course_name'])?$batchDetails[0]['course_name']:'--'; ?></div>
                </div>
            </div>
        </div>

        <?php echo form_open('admin/trainer/batch/eligibleForAssessment', array('id' => "eligibleForAssessment")) ?>
        
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Assessor List</h3>
                    <div class="box-tools pull-right">
                        <div class="custom-control custom-checkbox">
                            <label class="custom-control-label" for="check_all">Check All</label>
                            <input type="checkbox" class="custom-control-input" id="check_all">
                            <button type="submit" class="btn btn-info btn-sm">Eligible for Assessment</button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl.No.</th>
                                <th>Assessor</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $count = 0; foreach ($assessorList as $key => $assessor) { ?>

                                <tr id="<?php echo md5($assessor['batch_assessor_map_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $assessor['fname'].' '.$assessor['lname']; ?></td>
                                    <td><?php echo $assessor['mobile_no']; ?></td>
                                    <td><?php echo $assessor['email_id']; ?></td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input assessorCheckbox" name="map_id[]" 
                                                value="<?php echo $assessor['batch_assessor_map_id_pk']; ?>"
                                                <?php echo ($assessor['eligibility']) ? "checked": ""; ?>
                                            >
                                            <label class="custom-control-label" for="customCheck1"></label>
                                        </div>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <input type="hidden" name="batch_id" value="<?php echo $assessor['batch_ems_id_fk']; ?>">
        <?php echo form_close() ?>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>