<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Nodal Officer Master</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> Affiliation</li>
            <li><a href="master/affiliation_course"><i class="fa fa-users"></i> Nodal Officer List</a></li>
            <li class="active">Add</li>
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
                <h3 class="box-title">Nodal Officer Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/master/nodal/add') ?>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="district_id">Select District <span class="text-danger">*</span></label>
                                    <select class="form-control" name="district_id" id="district_id">
                                        <option value="" hidden="true">Select District</option>
                                        <?php foreach ($districtList as $district) { ?>
                                            <option value="<?php echo $district['district_id_pk'] ?>" <?php echo set_select('district_id', $district['district_id_pk']) ?>>
                                                <?php echo $district['district_name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('district_id'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="nodal_centre_name">Enter Nodal Centre Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nodal_centre_name" id="nodal_centre_name" placeholder="Enter Nodal Centre Name" value="<?php echo set_value('nodal_centre_name'); ?>">
                                    <?php echo form_error('nodal_centre_name'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="nodal_centre_email">Enter Nodal Center Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nodal_centre_email" id="nodal_centre_email" placeholder="Enter Nodal Center Email" value="<?php echo set_value('nodal_centre_email'); ?>">
                                    <?php echo form_error('nodal_centre_email'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="nodal_officer_mobile">Enter Nodal Officer Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nodal_officer_mobile" id="nodal_officer_mobile" placeholder="Enter Nodal Officer Mobile" value="<?php echo set_value('nodal_officer_mobile'); ?>">
                                    <?php echo form_error('nodal_officer_mobile'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label>&nbsp;</label><br> <button type="submit" class="btn btn-success form-batch-btn">Submit Nodal Officer Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>