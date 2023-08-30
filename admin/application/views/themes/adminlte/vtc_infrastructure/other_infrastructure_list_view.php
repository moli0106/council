<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>infrastructure</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Other Infrastructure List</li>
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
                <h3 class="box-title">Class Room List</h3>
                <div class="box-tools pull-right">
                    <?php if($vtcDetails['final_submit_status'] == 1){?>
                        <a href="<?php echo base_url('admin/vtc_infrastructure/other_infrastructure_details/add') ?>" class="btn btn-info btn-sm">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Other Infrastructure Details
                        </a>
                    <?php }?>
                </div>
            </div>

            <?php if(!empty($vtcDetails)) {?>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Electricity availability </th>
                                <th>Internet Connection</th>
                                <th>Connection Type</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($otherData))
                                {
                                    $i = $offset;
                                    foreach ($otherData as $key => $val) { ?>

                                        <tr id="<?php echo md5($val['vtc_other_infrastructure_details_id_pk']); ?>">
                                            <td><?php echo ++$i; ?>.</td>
                                            <td><?php if($val['available_electricity'] == 0){echo 'No';}else{echo 'Yes';} ?>  </td>
                                            <td><?php if($val['internet_connect'] == 0){echo 'No';}else{echo 'Yes';} ?>  </td>
                                            <td><?php echo $val['connection_type_name']; ?> </td>
                                            <!-- <td><?php echo $val['mentor_designation']; ?></td>
                                        
                                            <td>
                                                <?php if ($val['prd_image'] != NULL) { ?>
                                                <img class="profile-user-img img-responsive img-circle" src="data:image/jpeg;base64, <?php echo $product['prd_image'][0]; ?>" alt="Product Image" style="margin:0px;">
                                                <?php } else { ?>
                                                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('admin/themes/adminlte/assets/image/no-product-image.png'); ?>" alt="Product Image" style="margin:0px;">
                                                <?php } ?>  
                                                
                                            </td> -->
                                        </tr>

                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td colspan="6" align="center" class="text-danger">No Data Found...</td>
                                    </tr>

                                <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer" style="text-align: center">
                    <?php //echo $page_links ?>
                </div>
            <?php } else{?>
                <div class="alert alert-warning alert-dismissible">
                    <h4><i class="icon fa fa-warning"></i> Warning !</h4>
                    Your Basic Details is not completed yet.
                </div>
            <?php } ?>
        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>