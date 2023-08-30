<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Nodal Officer Master</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Master</li>
            <li class="active"><i class="fa fa-user"></i> Nodal Officer Master</li>
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
                <h3 class="box-title">Nodal Officer List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/master/nodal/add') ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Add Nodal Officer
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>District</th>
                            <th>Nodal Centre Name</th>
                            <th>Nodal Centre Email</th>
                            <th>Nodal Officer Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = $offset; ?>
                        <?php if (count($NodalOfficerList) > 0) { ?>
                            <?php foreach ($NodalOfficerList as $key => $value) { ?>
                                <tr id="<?php echo md5($value['nodal_officer_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $value['district_name']; ?></td>
                                    <td><?php echo $value['nodal_centre_name']; ?></td>
                                    <td><?php echo $value['nodal_centre_email']; ?></td>
                                    <td><?php echo $value['nodal_officer_mobile']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/master/nodal/update/' . md5($value['nodal_officer_id_pk'])); ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-folder-open" aria-hidden="true"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm remove-nodal-officer">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
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