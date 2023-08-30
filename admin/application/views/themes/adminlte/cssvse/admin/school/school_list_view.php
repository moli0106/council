<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<?php
$label1 = array('label-primary', 'label-danger', 'label-success', 'label-info', 'label-warning');
$label2 = array('label-success', 'label-info', 'label-warning', 'label-primary', 'label-danger');
?>


<div class="content-wrapper">
    <section class="content-header">
        <h1>CSS-VSE</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-align-center"></i> CSS-VSE</li>
            <li class="active"><i class="fa fa-align-center"></i> School List</li>
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
                <h3 class="box-title">School List</h3>
                <div class="box-tools pull-right">
                    <div class="search-container">
                        <?php echo form_open("admin/cssvse/cssvse_school"); ?>
                        <a href="<?php echo base_url('admin/cssvse/cssvse_school/getSchoolReport'); ?>" class="btn bg-navy btn-sm btn-flat">
                            <i class="fa fa-file-excel-o"></i> Get Report
                        </a>
                        <input type="text" placeholder="UDISE Code.." name="udise_code" id="udise_code" class="">
                        <button type="submit" class="btn btn-xs btn-info"><i class="fa fa-search"></i></button>
                        <?php echo form_close(); ?>
                    </div>
                </div>

            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>UDISE Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>HOI Phone No</th>
                            <th>Address</th>
                            <th>Registration Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = $offset; ?>
                        <?php if (count($schoolList) > 0) { ?>
                            <?php foreach ($schoolList as $key => $value) { ?>
                                <tr id="<?php echo md5($value['school_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['udise_code']; ?></td>
                                    <td><?php echo $value['school_name']; ?></td>
                                    <td><?php echo $value['school_email']; ?></td>
                                    <td><?php echo $value['hoi_mobile']; ?></td>
                                    <td><?php echo substr($value['school_address'], 0, 20); ?>...</td>
                                    </td>
                                    <td>
                                        <?php
                                        if ($value['active_status'] == 1)
                                            echo '<small class="label label-success">Active</small>';
                                        else
                                            echo '<small class="label label-danger">Inactive</small>';
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/cssvse/cssvse_school/school_details/' . md5($value['school_id_pk'])); ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-folder-open-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- <button class="btn btn-danger btn-sm" id="btnVtcAction" data-id="<?php echo md5($value['school_id_pk']); ?>">
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                        </button> -->
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8" align="center" class="text-danger">No Data Found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php if (isset($page_links)) echo $page_links; ?>
            </div>
        </div>

    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>