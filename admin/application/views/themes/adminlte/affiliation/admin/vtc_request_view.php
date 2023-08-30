<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>




<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li class="active"><i class="fa fa-align-center"></i> List Of Request Student List</li>
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
                <h3 class="box-title">Requested List</h3>
                <div class="box-tools pull-right">
                    
                </div>
            </div>
            <div class="box-body">
                
                <?php echo form_open('admin/affiliation/vtc', array('id' => 'vtc_search_form')) ?>
                <div class="text-center">

                    
                   

                </div>
                <?php echo form_close() ?>
               
            
                <table class="table table-hover dom-jQuery-events" id="editable-sample" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th style="width: 1px;">Name</th>
                            <!-- <th style="width: 2em;">Email</th> -->
                            <th>Academic Year</th>
                            <th>Group Name</th>
                            <th>No of Student</th>
                            <th>Approve Status</th>
                            
                            <th style="width: 23em;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $count = $offset; ?>
                        <?php if (count($requested_list) > 0) { ?>
                            <?php foreach ($requested_list as $key => $value) { ?>
                                <tr id="<?php echo md5($value['requested_student_details_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['vtc_code']; ?></td>
                                    <td><?php echo substr($value['vtc_name'], 0, 30); ?>...</td>
                                    <!-- <td><?php echo $value['vtc_email']; ?></td> -->
                                    <td><?php echo $value['academic_year']; ?></td>
                                    <td><?php echo $value['group_name']; ?> [<?php echo $value['group_code']; ?>]</td>
                                    <td><?php echo $value['no_of_student'];?></td>

                                    <!-- Added by Moli -->
                                    <td>
                                        <?php
                                        if ($value['approve_status'] == 1){

                                            // echo gettype($value['approve_reject_status']);

                                            echo '<small class="label label-success">Yes</small>';
                                        }
                                        elseif($value['approve_status'] == '0'){
                                            echo '<small class="label label-danger">NO</small>';
                                        }else{
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <!-- Added by Moli -->

                                    <td>

                                        <?php if($value['approve_status'] == 0) {?>

										    <button class="btn btn-sm btn-primary vtc_rquest_approve bg-success" title="Approve"><i class="fa fa-eye" aria-hidden="true"></i>Approve</button>
                                        
                                        <?php } ?>

                                        <!-- Added by Moli -->
                                    
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                            </tr>
                        <?php } ?> 
                    </tbody>
                </table>
            </div>
            <!-- <div class="box-footer">
                <?php echo $page_links; ?>
            </div> -->
        </div>

    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

