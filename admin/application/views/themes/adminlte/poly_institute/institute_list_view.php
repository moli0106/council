<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>Poly Institute</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Poly Institute</li>
            <li class="active"><i class="fa fa-align-center"></i> Institute List</li>
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
                <h3 class="box-title">Poly Institute List [final Submission Completed -- <?php echo $getfinalsubmitStudentCount['count']; ?>]</h3>
                <div class="box-tools pull-right">
                    
                </div>
            </div>
            <div class="box-body">
                
                
            
                <table class="table table-hover dom-jQuery-events" id="editable-sample" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Institute Code</th>
                            <th>Institute Type </th>
                            <th>Institute Name</th>
                            <th>Institute Category</th>
                            <th>Available Student</th>
                            <th style="width: 23em;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php /*<?php $count = $offset; ?>
                        <?php if (count($vtcList) > 0) { ?>
                            <?php foreach ($vtcList as $key => $value) { ?>
                                <tr id="<?php echo md5($value['vtc_details_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['vtc_code']; ?></td>
                                    <td><?php echo substr($value['vtc_name'], 0, 30); ?>...</td>
                                    <td><?php echo $value['vtc_email']; ?></td>
                                    <td><?php echo $value['academic_year']; ?></td>
                                    <td><?php echo ($value['vtc_affiliated_status'] == 1) ? 'Yes' : 'No'; ?></td>
                                    <td><?php echo ($value['vtc_active_status'] == 1) ? 'Yes' : 'No'; ?></td>

                                    <!-- Added by Moli -->
                                    <td>
                                        <?php
                                        if ($value['approve_reject_status'] == 1){

                                            // echo gettype($value['approve_reject_status']);

                                            echo '<small class="label label-success">Approved</small>';
                                        }
                                        elseif($value['approve_reject_status'] == '0'){

                                            //    echo gettype($value['approve_reject_status']);

                                            echo '<small class="label label-danger">Rejected</small>';
                                        }else{
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <!-- Added by Moli -->

                                    <td>
                                        <a href="<?php echo base_url('admin/affiliation/vtc/details/' . md5($value['vtc_details_id_pk'])); ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" id="btnVtcAction" data-id="<?php echo md5($value['vtc_details_id_pk']); ?>">
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                        </button>
										
										<button class="btn btn-sm btn-success send_email_tp_pwd" id="send_password" rel="<?php echo md5($value['vtc_details_id_pk']); ?>"  data-placement="top" title="Click to send email for VTC password"><i class="fa fa-paper-plane" aria-hidden="true"></i> Password</button>

                                        <!-- Added by Moli -->

                                        <a href="<?php echo base_url('admin/affiliation/vtc/download_vtc_pdf/' . md5($value['vtc_details_id_pk'])); ?>" class="btn btn-sm btn-success bg-yellow" target="_blank" title="Download PDF">
                                            <i class="fa fa-download" aria-hidden="true"></i> PDF
                                        </a>


                                        <?php if($value['approve_reject_status'] == '') {?>
										    <button class="btn btn-sm btn-primary approve-reject-modal" data-toggle="modal" data-target="#approve-reject-modal" title="Appprove or Reject"><i class="fa fa-level-up" aria-hidden="true"></i>Approve/Reject</button>
                                        <?php }elseif($value['approve_reject_status'] == 0) {?>

										    <button class="btn btn-sm btn-primary modal-reject-note bg-maroon" data-toggle="modal" data-target="#modal-reject-note" title="View Reject Note"><i class="fa fa-eye" aria-hidden="true"></i>Rejected Note</button>
                                        
                                        <?php } ?>

                                        <!-- Added by Moli -->
                                    
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                            </tr>
                        <?php } ?> */?>
                    </tbody>
                </table>
            </div>
            <!-- <div class="box-footer">
                <?php // echo $page_links; ?>
            </div> -->
        </div>

    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

