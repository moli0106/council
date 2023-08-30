<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Payment</h1>
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
                <h3 class="box-title">Payment Type List</h3>
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
                                <th>Payment Type Name</th>
                                <th>Status</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php $i = $offset + 1;
                            foreach ($payment_types as $val) {
                                //    echo '<pre>'; print_r($vacent_colleges); die;
                            ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $val['type_name'];?></td>
                            <td><?php echo $val['payment_status'];?></td>

                            <!-- Added by moli on 25-03-2023 -->
                            <?php if($val['payment_type_id_pk'] == 4){?>
                                <?php if($val['eligible_status'] =='' ){?>
                                    <td class="action_buttons" style="width : 14em;">
                                <?php if($val['payment_status'] == 'Not Done') {?>
                                    <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
                                                
                                        <input type="hidden" value="<?php echo $std_id; ?>" name="insStdId">
                                        <input type="hidden" value="<?php echo $val['payment_type_id_pk'];?>" name="payment_type">
                                        <br><button type="submit"  class="btn btn-info btn-sm">Proceed To Pay</button>
                                    <?php echo form_close() ?>
                                <?php }else{?>
                                    <a href=<?php echo base_url('admin/sbiepay/proceed_to_pay/download_payment_receipt/' . $val['transaction_id']); ?>  class="block btn btn-sm btn-success bg-yellow" target="_blank" title="Download Receipt">Download Receipt</a>
                                <?php }?>
                            </td>
                            <?php }}else{?><!-- Added by moli on 25-03-2023 -->
                            
                                <td class="action_buttons" style="width : 14em;">
                                    <?php if($val['payment_status'] == 'Not Done') {?>
                                        <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
                                                    
                                            <input type="hidden" value="<?php echo $std_id; ?>" name="insStdId">
                                            <input type="hidden" value="<?php echo $val['payment_type_id_pk'];?>" name="payment_type">
                                            <br><button type="submit"  class="btn btn-info btn-sm">Proceed To Pay</button>
                                        <?php echo form_close() ?>
                                    <?php }else{?>
                                        <a href=<?php echo base_url('admin/sbiepay/proceed_to_pay/download_payment_receipt/' . $val['transaction_id']); ?>  class="block btn btn-sm btn-success bg-yellow" target="_blank" title="Download Receipt">Download Receipt</a>
                                    <?php }?>
                                </td>
                            <?php }?>
                        </tr>
                        <?php $i++;
                            } ?>
                            

                                    
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