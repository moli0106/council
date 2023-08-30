<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
<!-- Content Wrapper. Contains page content -->
<style>
    .btn-space {
        margin-right: 5px;
    }

    .photo-box {
        width: 120px;
        height: 150px;
        overflow: hidden;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
    }
</style>

<!-- For disabled on final submit -->
<?php if ($app_data['final_save_status'] == 1) { 
    $disabled = "disabled";
} else {
    $disabled = NULL;
}
?>
<!-- For disabled on final submit -->

<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Profile</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Details View</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/' . uri_string()); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Photo & Signature</h3>
            </div>
            <div class="box-body">

                <?php if (isset($status)) { ?>
                    <div class="alert alert-<?php echo $status == TRUE ? 'success' : 'danger'; ?>">
                        <strong>Success!</strong> <?php echo $message; ?>.
                    </div>
                <?php } ?>

                <?php
                if ($this->session->flashdata('alert_msg')) {
                ?>
                    <div class="alert alert-success">
                        <p><?php echo $this->session->flashdata('alert_msg'); ?></p>
                    </div>
                <?php
                }
                ?>

                <?php $this->load->view($this->config->item('theme') . 'student_profile/menu_view'); ?>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>




                <h4>Photo & Signature</h4>
                <hr>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group ">
                            <label>Upload Signature <span class="text-danger">*</span> (JPEG format between 100KB. Dimensions 250x320 pixels preferred)</label>
                            <input type="file" class="form-control" placeholder="Signature" name="sign" id="sign" value="" <?php echo $disabled; ?> multiple>
                            <?php echo form_error('sign'); ?>
                        </div>
                    </div>

                    <?php if ($app_data['sign'] != '') { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="photo-box">
                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($app_data['sign']); ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-md-4">
                        <div class="form-group ">
                            <label>Upload Photo <span class="text-danger">*</span> (JPEG format between 100KB. Dimensions 250x320 pixels preferred)</label>
                            <input type="file" class="form-control" placeholder="Photo" name="photo" id="photo" value="" <?php echo $disabled; ?> multiple>
                            <?php echo form_error('photo'); ?>
                        </div>
                    </div>

                    <?php if ($app_data['picture'] != '') { ?>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="photo-box">
                                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo pg_unescape_bytea($app_data['picture']); ?>">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="student_profile/std_registration/basic_details" class="btn btn-primary btn-space confirm_pre">
                        < Previous</a>
                            <a href="student_profile/std_registration/edu_qualification" class="btn btn-primary btn-space confirm_next">Next > </a>
                </div>
                <?php if ($app_data['final_save_status'] != 1) { ?>
                <button type="submit" class="btn btn-primary pull-right">Save</button>
                <?php  } 
                ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>


    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>