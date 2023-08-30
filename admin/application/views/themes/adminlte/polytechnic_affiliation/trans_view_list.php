<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>



<div class="content-wrapper">
    <section class="content-header">
        <h1>Affiliation</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Affiliation Type List</li>
            <li class="active"><i class="fa fa-align-center"></i>Transction History</li>
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
                        <h3 class="box-title">Transction History</h3>
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
                                        <th>Merchant Ref Number</th>  
                                        <th>Total Amount</th>               
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php if (count($txnData) > 0) { ?>
                                        <?php foreach ($txnData as $key => $value) { ?>

                                            <tr>
                                               <td><?php echo $count++; ?></td>
                                               <td><?php echo $value['transaction_id']; ?></td>
                                               <td><?php echo $value['posting_amount']; ?></td>
                                               <td><a href="https://www.sbiepay.sbi/secure/transactionTrack" target="_blank" class="btn btn-info"> Check Status</td>
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