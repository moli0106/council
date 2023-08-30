<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessment Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="cssvsebatch/batch"><i class="fa fa-align-center"></i>Batch List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Batch Details</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <!-- Left Menu -->
            <?php $this->load->view($this->config->item('theme_uri') . 'cssvse/cssvsebatch/batch_left_menu'); ?>
            <!-- Left Menu -->

            
            <div class="col-md-9">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Batch Details</h3>
                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                
                            </div>
                        </div>

                    </div>

                    <div class="box-body no-padding">
                        <div class="pull-right">
                        </div>
                    </div>
                    

                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover">
                            <tr>
                                <th width="15%">Vertical Code :</th>
                                <td width="35%"><?php echo $batchDetails['vertical_code']; ?></td>
                                <th width="15%">Batch Code:</th>
                                <td width="35%"><?php echo $batchDetails['user_batch_id']; ?></td>
                            </tr>
                            <tr>
                                <th width="15%">Start Date  :</th>
                                <td width="35%"><?php echo date('d-m-Y', strtotime($batchDetails['batch_start_date'])); ?></td>
                                <th>End Date:</th>
                                <td><?php echo date('d-m-Y', strtotime($batchDetails['batch_end_date'])); ?></td>
                            </tr>
                            <tr>
                                <th width="25%">Prefered Assessment Date1  :</th>
                                <td>
                                    <?php 
                                        if(isset($batchDetails['prefered_assessment_date_1'])){
                                            echo date('d-m-Y', strtotime($batchDetails['prefered_assessment_date_1']));
                                        } else{
                                            echo '';
                                        }
                                    ?>
                                </td>
                                <th width="25%">Prefered Assessment Date2 :</th>
                                <td >
                                    <?php 
                                        if(isset($batchDetails['prefered_assessment_date_2'])){
                                            echo date('d-m-Y', strtotime($batchDetails['prefered_assessment_date_2']));
                                        }else{
                                            echo '';
                                        } 
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Tentative Date :</th>
                                <td><?php echo date('d-m-Y', strtotime($batchDetails['batch_tentative_date'])); ?></td>
                                <th>Sector Name  :</th>
                                <td> 
                                    <?php echo $batchDetails['sector_name']; ?> [<?php echo $batchDetails['sector_code']; ?>]
                                </td>
                            </tr>
                            <tr>
                                
                                <th >Course Name:</th>
                                <td>
                                <?php echo $batchDetails['course_name']; ?> [<?php echo $batchDetails['course_code']; ?>]
                                </td>

                                <th>Batch Status:</th>
                                <td>
                                    <span class="badge <?php echo response_status_color($batchDetails['process_id_fk']); ?> process-name">
                                        <?php echo $batchDetails['process_name']; ?>
                                    </span>
                                </td>
                                
                            </tr>

                            <tr>
                                
                                <th >Assessment Scheme Name:</th>
                                <td>
                                <?php echo $batchDetails['assessment_scheme_name']; ?>
                                </td>

                                <!-- <th>Batch Status:</th>
                                <td>
                                    <span class="badge <?php echo response_status_color($batchDetails['process_id_fk']); ?> process-name">
                                        <?php echo $batchDetails['process_name']; ?>
                                    </span>
                                </td> -->
                                
                            </tr>
                            
                            
                            
                            
                        </table>

                    </div>

                </div>

                <!-- <div class="box-footer no-padding"> -->

            </div>
            
        </div>
    </section>

</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>