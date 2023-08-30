<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>Batch Declaration List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Batch Declaration</li>
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
				
                <h3 class="box-title">Batch Declaration List</h3><br>
                <div class="box-tools pull-right">

                    <?php 
					//if($vtcDetails['second_final_submit_status'] == 1){?>
                    <?php if($vtcDetails['second_final_submit_status'] != 1){?>
                        <a href="<?php echo base_url('admin/vtc_student/batch_declaration/add') ?>" class="btn btn-success btn-sm btn-flat">
                            <i class="fa fa-user-plus" aria-hidden="true"></i> Declare New Batch
                        </a>
                    <?php }?>
                    
                    
                   
                </div>
            </div>
            <div class="box-body">
                
                <?php echo form_open('admin/vtc_student/student_reg', array('id' => 'vtc_search_form')) ?>
                <!-- <div class="text-center">

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

                </div> -->
                <?php echo form_close() ?>
               
            
                <table class="table table-hover dom-jQuery-events" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Batch No</th>
                            <th>Group / Trade</th>
                           
                            <th>Group / Trade Code</th>
                            <th>Affiliation Year</th>
                            <th>Batch Start Date</th>
                            <th>Batch End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            if(count($batch))
                            {
                                $i = $offset;
                                foreach ($batch as $key => $val) { ?>

                                    <tr id="<?php echo md5($val['batch_declare_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo $val['batch_no']; ?></td> 
                                        <td><?php echo $val['group_name']; ?> </td>
                                        <td><?php echo $val['group_code']; ?> </td>
                                        <td>
                                            <?php echo $val['academic_year']; ?> 
                                        </td>
                                        <td><?php echo date('d/m/Y', strtotime($val['batch_start_date'])); ?></td>
                                    
                                        <td><?php echo date('d/m/Y', strtotime($val['batch_end_date'])); ?></td> 
                                        
                                        <td>
                                            <!-- <a href="<?php echo base_url('admin/vtc_student/student_reg/add_student/'.$val['group_id_fk'].'/'.$val['class_id_fk']) ?>" class="btn btn-success btn-sm btn-flat">
                                                <i class="fa fa-user-plus" aria-hidden="true"></i> Add Student
                                            </a> -->
                                        </td>
                                    </tr>

                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                                </tr>

                            <?php }
                        ?>
                        
                    </tbody>
                </table>
            </div>
           
        </div>

    </section>
</div>







<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

