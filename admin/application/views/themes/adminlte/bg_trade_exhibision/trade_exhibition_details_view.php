<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>BGTE Product</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="dashboard"><i class="fa fa-align-center"></i>Product List</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Product Details</li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('status') !== null) { ?>
            <div class="alert alert-<?= $this->session->flashdata('status') ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-md-12">
                <ul class="timeline">

                    <li class="time-label">
                        <span class="bg-aqua">Product Details</span>
                    </li>

                    <li>
                        <i class="fa fa-bookmark bg-aqua" aria-hidden="true"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="javascript:void(0)">Product Details</a></h3>
                            <div class="timeline-body">
                                <h4><strong>Product Name : </strong><small><?php echo $product_details['product'][0]['product_name']; ?></small></h4>
                                <hr>
                                <h4>
                                    <strong>Product Description/Write up : </strong>
                                    <small><?php echo $product_details['product'][0]['product_desc']; ?></small>
                                </h4>
                            </div>
                        </div>
                    </li>


                    <li>
                        <i class="fa fa-picture-o bg-aqua" aria-hidden="true"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="javascript:void(0)">Product Image</a></h3>
                            <div class="timeline-body">
                                <?php foreach ($product_details['image'] as $key => $image) { ?>

                                    <img class="img-responsive margin" src="data:image/jpeg;base64, <?php echo $image['product_image']; ?>" alt="Product Image" style="width: 350px;">

                                <?php } ?>
                            </div>
                        </div>
                    </li>

                    <li>
                        <i class="fa fa-video-camera bg-aqua" aria-hidden="true"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="javascript:void(0)">Product Video</a></h3>
                            <div class="timeline-body">
                                <video width="100%" height="720" controls>
                                    <source type="video/mp4" src="data:video/mp4;base64,<?php echo pg_unescape_bytea($product_details['product'][0]['product_video']); ?>">
                                </video>
                            </div>
                        </div>
                    </li>

                    <li class="time-label">
                        <span class="bg-green">Created By</span>
                    </li>

                    <?php foreach ($product_details['student'] as $key => $student) { ?>

                        <li>
                            <i class="fa fa-user bg-green" aria-hidden="true"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="javascript:void(0)"><?php echo $student['student_name']; ?></a></h3>
                                <div class="timeline-body">
                                    <div class="row">
                                        <div class=" col-md-4">
                                            <h4><strong>Institute Name : </strong><small><?php echo $student['student_instute']; ?></small></h4>
                                        </div>
                                        <div class=" col-md-4">
                                            <h4><strong>Discipline/Trade : </strong><small><?php echo $student['student_discipline']; ?></small></h4>
                                        </div>
                                        <div class=" col-md-4">
                                            <img class="img-responsive margin" src="data:image/jpeg;base64, <?php echo $student['student_photo']; ?>" alt="Product Image" style="width: 350px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                    <?php } ?>

                    <li class="time-label">
                        <span class="bg-navy">Mentor By</span>
                    </li>

                    <li>
                        <i class="fa fa-user bg-navy" aria-hidden="true"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="javascript:void(0)"><?php echo $product_details['product'][0]['mentor_name']; ?></a></h3>
                            <div class="timeline-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4><strong>Mentor Email : </strong><small><?php echo $product_details['product'][0]['mentor_email']; ?></small></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4><strong>Mentor Mobile No. : </strong><small><?php echo $product_details['product'][0]['mentor_mobile']; ?></small></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4><strong>Mentor Designation : </strong><small><?php echo $product_details['product'][0]['mentor_designation']; ?></small></h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h4><strong>Institute Name : </strong><small><?php echo $product_details['product'][0]['mentor_instute_name']; ?></small></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 col-md-offset-4 text-center">
                                        <img class="img-responsive margin" src="data:image/jpeg;base64, <?php echo $product_details['product'][0]['mentor_photo']; ?>" alt="Product Image" style="width: 350px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                </ul>
            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>