<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Aassessor EMS</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-users"></i> Assessor Batch List</li>
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
                <h3 class="box-title">Assessor Batch List</h3>
                <div class="box-tools pull-right">
                    <a href="<?php echo base_url('admin/assessor_ems/assessor_batch/add') ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Create Assessor Batch
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>BatchType</th>
                            <th>Trainer</th>
                            <th>Sector</th>
                            <th>Job Role</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>End Date</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($BatchList)) {
                            $i = $offset;
                            foreach ($BatchList as $key => $batch) { ?>

                                <tr id="<?php echo md5($batch['batch_ems_id_pk']); ?>">
                                    <td><?php echo ++$i; ?>.</td>
                                    <td><?php
                                        echo ($batch['batch_type'] == 1) ? 'Domain' : 'Platform';
                                        ?></td>
                                    <td><?php echo $batch['f_name'] . ' ' . $batch['m_name'] . ' ' . $batch['l_name']; ?></td>
                                    <td><?php echo ($batch['sector_name']) ? $batch['sector_name'] : '--'; ?></td>

                                    <td><?php echo ($batch['course_name']) ? substr($batch['course_name'], 0, 25) . '...' : '--'; ?></td>


                                    <td align="center">
                                        <?php echo date("d/m/Y", strtotime($batch['start_date'])); ?>
                                    </td>
                                    <td align="center">
                                        <?php echo date("H:i", strtotime($batch['start_time'])); ?>
                                    </td>
                                    <td align="center">
                                        <?php echo date("d/m/Y", strtotime($batch['end_date'])); ?>
                                    </td>
                                    <td align="center">
                                        <?php echo date("H:i", strtotime($batch['end_time'])); ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($batch['exam_date_time_status'] != 1) { ?>
											<a href="javascript:void(0)" rel="<?php echo md5($batch['batch_ems_id_pk']); ?>" class="btn bg-purple btn-sm set_exam_time_btn" id="set_exam_time_<?php echo md5($batch['batch_ems_id_pk']); ?>"> <i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                        <?php } ?>

                                        <a href="<?php echo base_url('admin/assessor_ems/assessor_batch/details/' . md5($batch['batch_ems_id_pk'])); ?>" class="btn btn-info btn-sm">
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
			<div class="box-footer text-right">
				<?php echo $page_links; ?>
			</div>
        </div>
    </section>
</div>


<!---------------------------- Modal for set Exam time ----------------------->
<div id="mySetexamTime" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content modal_set_exam_content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title modal_title">Set Exam Date & Time</h4>
			</div>
			<div class="modal-body modal_set_exam_body">
			</div>
			<div class="modal-footer">
				<span class="show_set_exam_time_btn_dtls"></span>
				
				<button type="button" class="btn btn-default frwd_btn_no" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
	</div>
<!---------------------------- Modal for set Exam time ----------------------->

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>