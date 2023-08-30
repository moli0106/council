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

        <?php if (empty($vtcDetails)) { ?>

            <?php if (empty($vtcCourseList) ) { ?>
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
                                        <th>Paymented Student</th>
                                        <th>New Student Count</th>

                                        <th>Eligible For Exam</th>
                                        
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
                                                <td><?php echo $value['payment_count'];?></td>
                                                <td><?php echo $value['new_addmition']; ?></td>

                                                <td><?php echo $value['eligible_count']; ?></td>
                                                
                                                <?php  $total_std_count = $value['payment_count'] + $value['new_addmition'];?>
                                                
                                                <td style="width : 14em;">
                                                    <!-- <a href="<?php echo base_url('admin/affiliation/teachers/detail/' . md5($value['teacher_id_pk'])); ?>" title="View" class="btn btn-info btn-sm">
                                                        <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                                    </a> -->



                                                    <?php if ($total_std_count < 36){
                                                        $std_count = ($total_std_count -36) - $value['approved_student'];
                                                        ?>

                                                        
                                                        <input type="hidden" class="totalStdCnt" value="<?php echo $std_count;?>">
                                                        <?php if(($total_std_count -36) > ($value['approved_student'])){?>
                                                        <?php //if((36 -$total_std_count) > ($value['approved_student'])){?>
                                                        
                                                        <button type="button" class="btn btn-warning btn-sm requeststudentbtn">
                                                            Request
                                                        </button>
                                                    <?php }}?>
                                                    
                                                    <?php if($value['pay_button'] == 'enable') {?>

                                                        <!-- <button type="button" class="btn btn-warning btn-sm stdPayment">
                                                            Pay
                                                        </button> -->

                                                        <!-- <a href="<?php echo base_url('admin/vtc_student/student_payment/temp_pay'); ?>" title="View" class="btn btn-info btn-sm">
                                                            Proceed To Pay
                                                        </a> -->
                                                        <!-- Modify by moli on 16-05-2023 -->
                                                        <?php if($value['payment_count'] == 0){?> 
                                                        <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
                                                            <input type="hidden" value="<?php echo $value['group_id_fk']; ?>" name="group_id">
                                                            <input type="hidden" value="<?php echo $value['new_addmition']; ?>" name="std_no">
                                                            <input type="hidden" value="1" name="payment_type">
                                                            <br><button type="submit"  class="btn btn-info btn-sm">Proceed To Pay</button>
                                                        <?php echo form_close() ?>
                                                       
                                                    <?php }
                                                }?>
                                                   
                                                    <!-- checking purpose -->
                                                        <br>
                                                        <!-- <a  class="btn btn-warning btn-sm" href="<?php echo base_url('admin/vtc_student/student_payment/group_wise_student_list/' . $value['group_id_fk']); ?>">
                                                            Pay Exam Fee
                                                        </a> -->
                                                    <!-- checking purpose -->

                                                    <!-- Added By Moli on 11-04-2023 -->

                                                    <?php if($value['eligible_count'] !=0) {?>

                                                        <!-- <button type="button" class="btn btn-warning btn-sm stdPayment">
                                                            Pay
                                                        </button> -->

                                                        <!-- <a href="<?php echo base_url('admin/vtc_student/student_payment/temp_pay'); ?>" title="View" class="btn btn-info btn-sm">
                                                            Proceed To Pay
                                                        </a> -->
                                                        <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
                                                            <input type="hidden" value="<?php echo $value['group_id_fk']; ?>" name="group_id">
                                                            <input type="hidden" value="<?php echo $value['new_addmition']; ?>" name="eligible_std_no">
                                                            <input type="hidden" value="5" name="payment_type">
                                                            <br><button type="submit"  class="btn btn-info btn-sm">Pay Exam Fee</button>
                                                        <?php echo form_close() ?>

                                                    <?php }?>

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
            <?php } else { ?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Courses is not added for academic year <span class="label label-success"><?php echo $academic_year; ?></span>
                </div>
            <?php } ?>

        <?php } else { ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                Your Basic Details is not completed for academic year <span
                    class="label label-success"><?php echo $academic_year; ?></span>
            </div>
        <?php } ?>

    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>