<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>TC List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>TC List</li>
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
				
                <h3 class="box-title">TC List</h3><br>
				<h4><span class="text-danger"> </span></h4>
                <div class="box-tools pull-right">

                   
                    <?php if($org_details['tp_code']!='' ||$org_details['tp_code']!=null ){?>

                        <?php if($org_details['self_tc']== 1){ ?>
                            <a href="javascript:void(0)" data-id ="<?php echo $org_details['organization_id_pk'];?>" class="btn btn-warning btn-sm btn-flat self_tc_btn">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> Add Self AS a TC
                            </a>
                        <?php  } ?>
                        <a href="<?php echo base_url('admin/organization/tc_reg/add_tc') ?>" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Add TC
                        </a>
                    <?php  } ?>    
                   
                </div>
            </div>
            <?php if($org_details['tp_code']!='' ||$org_details['tp_code']!=null ){?>
                <div class="box-body">

                    
                    
                    <?php echo form_open('admin/vtc_student/student_reg', array('id' => 'vtc_search_form')) ?>
                    <!-- <div class="row text-center">
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

                    </div> -->
                    
                    <?php echo form_close() ?>
                
                
                    <table class="table table-hover dom-jQuery-events" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TC Name</th>
                                
                                <th>Mobile No</th>
                                <th>Email Id</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($tc_list)) { ?>
                                <?php $i = $offset + 1;
                                    foreach ($tc_list as $val) {
                                        //    echo '<pre>'; print_r($vacent_colleges); die;
                                    ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $val['tc_name'] ?></td>
                                    <td><?php echo $val['mobile'] ?></td>
                                    <td><?php echo $val['email'] ?></td>
                                    <td class="action_buttons">

                                        <a href="<?php  echo base_url('admin/organization/tc_reg/tc_detail/' . md5($val['tc_id_pk'])); ?>"
                                            class="btn btn-sm btn-success" data-toggle="modal" data-target="">View</a>


                                        
                                    </td>
                                </tr>
                                <?php $i++;
                                    } ?>
                            <?php  } else { ?>
                                <tr>
                                <td>
                                        No Data Found...
                                </td> 
                                </tr>

                            <?php  } ?>
                        </tbody>
                    </table>
                    
                </div>
            <?php  } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Basic Details is not completed yet.
                </div>

        <?php  } ?>
           
        </div>

    </section>
</div>


<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

