<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style>
    .card {
        background: #fff;
        border-radius: 2px;
        display: inline-block;
        padding: 1rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .card:hover {
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);
    }
    
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Aassessor Result</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Assessor Result</li>
        </ol>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('status') !== null){ ?>
            <div class="alert alert-<?=$this->session->flashdata('status')?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$this->session->flashdata('alert_msg')?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Batch Details</h3>
                <div class="box-tools pull-right">
                    <!-- Statement -->
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3"><strong>Batch Type:</strong></div>
                    <div class="col-md-3">
					<?php
						echo ($batchDetails[0]['batch_type'] == 1)?'Domain':'Platform';
					?>
					</div>
                    <div class="col-md-3"><strong>Assessment Mode:</strong></div>
                    <div class="col-md-3">
					<?php
						echo ($batchDetails[0]['assment_mode'] == 1)?'Online':'Offline';
					?>
					</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Date :</strong></div>
                    <div class="col-md-3"> <?php echo date('d-m-Y',strtotime($batchDetails[0]['start_date'])).' <i>to</i> '.date('d-m-Y',strtotime($batchDetails[0]['end_date'])); ?></div>
                    <div class="col-md-3"><strong>Time :</strong></div>
                    <div class="col-md-3"> <?php echo $batchDetails[0]['start_time'].' <i>to</i> '.$batchDetails[0]['end_time']; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Trainer :</strong></div>
                    <div class="col-md-3"> <?php echo $batchDetails[0]['f_name'].' '.$batchDetails[0]['l_name']  ?></div>
                    <div class="col-md-3"><strong>Sector :</strong></div>
                    <div class="col-md-3"><?php echo ($batchDetails[0]['sector_name'])?$batchDetails[0]['sector_name']:'--'; ?></div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Job Role :</strong></div>
                    <div class="col-md-9"> <?php echo ($batchDetails[0]['course_name'])?$batchDetails[0]['course_name']:'--'; ?></div>
                </div>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor List</h3>
                <div class="box-tools pull-right">
                    <!-- Statement -->
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Assessor</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Result Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="batchAssessorList">
                                <?php $count = 0; foreach ($assessorList as $key => $assessor) { ?>
                                    <?php if($assessor['exam_status']==2){ 
                                        $exam_status='Appear';
                                    }else if($assessor['exam_status']==1){
                                        $exam_status='Abnormally Exist';
                                    }else{
                                        $exam_status='Not Appear';
                                    }?>
                                    <?php if($assessor['exam_pass_fail_status']==2){ 
                                        $result_status='Rejected';
                                    }else if($assessor['exam_pass_fail_status']==1){
                                        $result_status='Approved';
                                    }else{
                                        $result_status='Not Action Taken';
                                    }?>
                                    <tr id="<?php echo md5($assessor['assessor_id_fk']); ?>" class="<?php echo md5($assessor['batch_ems_id_fk']);?>">
                                        <td><?php echo ++$count; ?>.</td>
                                        <td><?php echo $assessor['fname'].' '.$assessor['lname']; ?></td>
                                        <td><?php echo $assessor['mobile_no']; ?></td>
                                        <td><?php echo $assessor['email_id']; ?></td>
                                        <td><?php echo $exam_status ; ?></td>
                                        <td><?php echo $result_status ; ?></td>
                                        <td>
                                            <?php if($assessor['exam_status']==2){ ?>
                                                <button type="button" class="btn btn-info btn-sm getResult" data-toggle="modal" data-target="#myModalList">View Result</button>
                                            
                                            <?php if($assessor['exam_pass_fail_status']==0){?>
                                            <a alt="<?php echo md5($assessor['batch_ems_id_fk'])?>" href="<?php echo md5($assessor['assessor_id_fk']) ?>" class="btn btn-success btn-sm approve_assessor_result" data-toggle="modal" data-target="#myModal">Accept</a>

                                            <a alt="<?php echo md5($assessor['batch_ems_id_fk'])?>" href="<?php echo md5($assessor['assessor_id_fk']) ?>" class="btn btn-danger btn-sm reject_assessor_result" data-toggle="modal" data-target="#myModal">Revert</a>
                                            <?php }?>
                                            <?php }?>
                                        </td>
                                        
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div id="myModalList" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white;">Result View</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Number of total questions.</th>
                            <th>Number of attempted questions</th>
                            <th>No of correct answer </th>
                            <th>Marks Obtained </th>
                        </tr>
                    </thead>
                    <tbody id="resultDetails">
                        <tr>
                            <td colspan="3" align="center">Please wait a moment...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: white;">Modal Header</h4>
            </div>
            <div class="modal-body result_accept_revert_content">
                <p>Loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>