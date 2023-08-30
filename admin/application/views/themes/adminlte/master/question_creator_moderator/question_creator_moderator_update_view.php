<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    .highlight {
        padding: 9px 14px;
        margin-bottom: 14px;
        background-color: #f7f7f9;
        border: 1px solid #e1e1e8;
        border-radius: 4px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Question Creator/Moderator Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-user"></i> Question Creator/Moderator Update</li>
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
                <h3 class="box-title">Question Creator/Moderator Details</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Trainer Name</label>
                            <input type="text" class="form-control" value="<?php echo $qcm_details['qcm_name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?php echo $qcm_details['email_id']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" class="form-control" value="<?php echo $qcm_details['mobile_no']; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="highlight">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Sector</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            <?php foreach ($sectors as $key => $value) { ?>
                                <tr id="<?php echo md5($value['creator_moderator_sector_map_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['sector_name']; ?></td>
                                    
                                    <td>
                                        <?php if ($value['active_status'] == 1) { ?>
                                            <small class="label label-success">Active</small>
                                        <?php } else { ?>
                                            <small class="label label-danger">Deactive</small>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($value['active_status'] == 1) { ?>
                                            <button class="btn btn-sm btn-danger changeJobRoleStatus" data-name="Deactive">
                                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-success changeJobRoleStatus" data-name="Activate">
                                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php echo form_open('admin/master/question_creator_moderator/update_sector/' . md5($qcm_details['creator_moderator_id_pk'])) ?>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="" for="">Select Sector <span class="text-danger">*</span></label>
                            <select class="form-control select2" style="width: 100%;" name="sector_id">
                                <option value="" hidden="true">Select Sector</option>
                                <?php if (count($sector_list)) { ?>
                                    <?php foreach ($sector_list as $sector) { ?>
                                        <option value="<?php echo $sector['sector_id_pk'] ?>" <?php echo set_select('sector_id', $sector['sector_id_pk']); ?>>
                                            <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">No Data Found...</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('sector_id'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group" style="text-align: center;">
                            <label class="" for="">&nbsp;</label>
                            <button type="submit" class="btn btn-info btn-block">Add Sector</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>