<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Batch List</li>
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
                <h3 class="box-title">Batch List</h3>
                <div class="box-tools pull-right">
                    <!-- Statement -->
                </div>
            </div>
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>BatchType</th>
                            <th>AssmentMode</th>
                            <th>Sector</th>
                            <th>Job Role</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($batchList))
                            {
                                $i = $offset;
                                foreach ($batchList as $key => $batch) { ?>

                                    <tr id="<?php echo md5($batch['batch_ems_id_pk']); ?>">
                                        <td><?php echo ++$i; ?>.</td>
                                        <td><?php echo ($batch['batch_type'] == 1)?'Domain':'Platform'; ?></td>
                                        <td><?php echo ($batch['assment_mode'] == 1)?'Online':'Offline'; ?></td>
                                        <td><?php echo ($batch['sector_name']) ? $batch['sector_name'] : '--'; ?></td>
                                        <td><?php echo ($batch['course_name']) ? substr($batch['course_name'], 0, 25).'...' : '--'; ?></td>
                                        <td align="center">
                                            <?php echo date("d-m-Y", strtotime($batch['start_date'])); ?>
                                        </td>
                                        <td align="center">
                                            <?php echo date("H:i", strtotime($batch['start_time'])); ?>
                                        </td>
                                        <td align="center">
                                            <a href="<?php echo base_url('admin/trainer/batch/assessor_list/'.md5($batch['batch_ems_id_pk'])); ?>" class="btn btn-info btn-sm">
                                                <i class="fa fa-folder-open" aria-hidden="true"></i>
                                            </a>
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
            <div class="box-footer text-center">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>