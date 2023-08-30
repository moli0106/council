<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Group/Trade Master</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Master</li>
            <li class="active"><i class="fa fa-book"></i> Group/Trade Master</li>
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
                <h3 class="box-title">Group/Trade Master Add</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/qbm_master/group_trade') ?>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="group_name">Enter Group/Trade Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="group_name" id="group_name" placeholder="Enter Group/Trade Name" value="<?php echo set_value('group_name'); ?>">
                                    <?php echo form_error('group_name'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="" for="group_code">Enter Group/Trade Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="group_code" id="group_code" placeholder="Enter Group/Trade Code" value="<?php echo set_value('group_code'); ?>">
                                    <?php echo form_error('group_code'); ?>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label>&nbsp;</label><br> <button type="submit" class="btn btn-success form-batch-btn">Submit Group/Trade</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Group/Trade Master List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/qbm_master/group_trade/course_disc_group_trade_map') ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Map Group/Trade
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Group/Trade Name</th>
                            <th>Group/Trade Code</th>
                            <!-- <th>Course Name</th>
                            <th>Discipline</th> -->
                            
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = $offset; ?>
                        <?php if (count($groupList) > 0) { ?>
                            <?php foreach ($groupList as $key => $value) { ?>
                                <tr id="<?php echo md5($value['group_trade_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['group_trade_name']; ?></td>
                                    <td><?php echo $value['group_trade_code']; ?></td>
                                    <!-- <td><?php echo $value['course_name']; ?></td>
                                    <td><?php echo $value['discipline_name']; ?></td> -->
                                    <!-- <td>
                                        <a href="<?php echo base_url('admin/master/affiliation_course/update/' . md5($value['course_id_pk'])); ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-folder-open" aria-hidden="true"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm remove-course-master">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" align="center" class="text-danger">No Data Found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>