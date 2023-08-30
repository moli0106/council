<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Product List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Product List</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Product List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/bg_trade_exhibition/trade_exhibition/add') ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Product
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Product Name</th>
                            <th>Mentor Name</th>
                            <th>Mentor Designation</th>
                            <!--<th>Product Image</th>
                            <th>Product Video</th>-->
                            <th>Actions</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($product_list)) {
                            $i = $offset;
                            foreach ($product_list as $key => $product) { ?>

                                <tr id="<?php echo md5($product['product_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td><?php echo $product['product_name']; ?> </td>
                                    <td><?php echo $product['mentor_name']; ?> </td>
                                    <td><?php echo $product['mentor_designation']; ?></td>

                                    <!--<td>
                                        <?php if ($product['prd_image'] != NULL) { ?>
                                            <img class="profile-user-img img-responsive" src="data:image/jpeg;base64, <?php echo $product['prd_image'][0]; ?>" alt="Product Image" style="margin:0px;">
                                        <?php } else { ?>
                                            <img class="profile-user-img img-responsive" src="<?php echo base_url('admin/themes/adminlte/assets/image/no-product-image.png'); ?>" alt="Product Image" style="margin:0px;">
                                        <?php } ?>

                                    </td>

                                    <td>
                                        <video width="200" height="100" controls>
                                            <source type="video/mp4" src="data:video/mp4;base64,<?php echo pg_unescape_bytea($product['product_video']); ?>">
                                        </video>
                                    </td>-->

                                    <td>
                                        <a href="<?php echo base_url('admin/bg_trade_exhibition/trade_exhibition/details/' . md5($product['product_id_pk'])); ?>" class="btn btn-flat btn-info btn-block btn-sm">View Deatils</a>
                                    </td>
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
                <?php echo $page_links ?>
            </div>
        </div>
    </section>
</div>



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>