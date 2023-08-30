<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>New Student List</li>
            <li class="active"><i class="fa fa-align-center"></i>Student Payment</li>
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
                        <h3 class="box-title">Group Wise Payment</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    
                                    <div class="">
                                        
                                        <div class="">
                                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Group Name (Group Code)</th>
                                        <!-- <th>Paymented Student</th>
                                        <th>New Student Count</th>

                                        <th>Eligible For Exam</th> -->
                                        
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 0; ?>
                                    <?php if (count($stdByGroup) > 0) { ?>
                                        <?php foreach ($stdByGroup as $key => $value) { ?>

                                            <tr id="<?php echo $value['group_id_fk']; ?>">
                                                <td>
                                                    <?php echo ++$count; ?>.
                                                </td>
                                                <td><?php echo $value['group_name']; ?> (<?php echo $value['group_code']; ?>)</td>
                                                <!-- <td><?php echo $value['payment_count'];?></td>
                                                <td><?php echo $value['new_addmition']; ?></td>

                                                <td><?php echo $value['eligible_count']; ?></td>
                                                
                                                <?php  $total_std_count = $value['payment_count'] + $value['new_addmition'];?>
                                                 -->
                                                <td style="width : 14em;">
                                                    
                                                   
                                                    <!-- checking purpose -->
                                                        <br>
                                                        <a  class="btn bg-navy btn-xs btn-block" href="<?php echo base_url('admin/vtc_student/register_student/group_wise_student_list/' . $value['group_id_fk'].'/1'); ?>">
                                                            Mark Eligible For Batch1 Exam
                                                        </a>
                                                    <!-- checking purpose -->
                                                    <br>
                                                    <!-- Added By Moli on 06-06-2023 -->
                                                    <a  class="btn btn-info btn-xs btn-block" href="<?php echo base_url('admin/vtc_student/register_student/group_wise_student_list/' . $value['group_id_fk'].'/2'); ?>">
                                                            Mark Eligible For Batch2 Exam
                                                    </a>
                                                    <br>
                                                    <a  class="btn btn-warning btn-xs btn-block" href="<?php echo base_url('admin/vtc_student/register_student/group_wise_student_list/' . $value['group_id_fk'].'/3'); ?>">
                                                            Mark Eligible For Batch3 Exam
                                                    </a>

                                             

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr>
                                            <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
           

    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>