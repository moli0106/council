<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Publication</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-file-text"></i> Publication</li>
            <li class="active"><i class="fa fa-bars"></i> List</li>
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
                <h3 class="box-title">List of Publication</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/notice_and_circular_management/notice_and_circular/add'); ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-file-text"></i> Add Publication
                    </a>
                </div>
            </div>

            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Publication Type</th>
                            <!-- <th>Title</th> -->
                            <th>Date of Issue</th>
                            <!-- <th>Duration</th> -->
                            <th>Subject / Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($publicationList) > 0) {
                            $count = 0; ?>
                            <?php foreach ($publicationList as $key => $publication) { ?>

                                <tr id="<?php echo md5($publication['publication_id_pk']); ?>">
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $publication['publication_type']; ?></td>
                                    <!-- <td><?php echo $publication['publication_title']; ?></td> -->
                                    <td>
                                        <?php
                                        if ($publication['published_date'] != NULL) {

                                            echo date('d/m/Y', strtotime($publication['published_date']));
                                        } else {
                                            echo '--';
                                        }
                                        ?>
                                    </td>
                                    <!-- <td>
                                        <?php
                                        if ($publication['start_date'] != NULL) {

                                            echo date('d/m/Y', strtotime($publication['start_date']));
                                        }

                                        if ($publication['end_date'] != NULL) {

                                            echo 'to';
                                            echo date('d/m/Y', strtotime($publication['end_date']));
                                        }
                                        ?>
                                    </td> -->
                                    <!-- <td><?php echo substr($publication['publication_description'], 0, 50); ?>...</td> -->
                                    <td width="600px"><?php echo $publication['publication_description']; ?></td>
                                    <td>
                                        <?php
                                        if ($publication['approve_status'] == 1) {
                                            echo '<span class="label label-success">Approved</span>';
                                        } else {
                                            echo '<span class="label label-warning">Pending</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- <div class="btn-group-vertical"> -->
                                        <a href="<?php echo base_url('admin/notice_and_circular_management/notice_and_circular/details/' . md5($publication['publication_id_pk'])); ?>" class="btn btn-xs bg-navy btn-block">
                                            <i class="fa fa-folder-open-o" aria-hidden="true"></i> View Details
                                        </a>



                                        <button class="btn btn-info btn-xs publication-status btn-block" data-status="<?php echo $publication['approve_status']; ?>">
                                            <i class="fa fa-stop-circle-o" aria-hidden="true"></i> Change Status
                                        </button>
                                        <!-- </div> -->
                                    </td>
                                </tr>

                            <?php } ?>
                        <?php } else { ?>
                            <tr class="text-center text-danger">
                                <td colspan="6">Data Not Found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer" style="text-align: center">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>


<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>