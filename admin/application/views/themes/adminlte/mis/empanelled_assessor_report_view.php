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
        <h1>Empanelled Assessor Report</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-users"></i> Empanelled Assessor Report</li>
        </ol>
    </section>
    <section class="content">

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Empanelled Assessor Report</h3>
                <div class="box-tools pull-right">
                    <!-- <a href="<?php echo base_url('admin/mis/empanelled_assessor_report/download'); ?>" name="download" value="<?php echo md5(200); ?>" class="btn btn-sm btn-success">
                        <i class="fa fa-download" aria-hidden="true"></i>
                        Download Report
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                    </a> -->
                </div>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/mis/empanelled_assessor_report', array('autocomplete' => 'off')); ?>
                <div class="highlight">
                    <div class="row">
						<div class="col-md-3">
                            <div class="form-group">
                                <label for="pan_no">PAN No.</label>
                                <input type="text" name="pan_no" id="pan_no" value="<?php echo set_value('pan_no')?>" class="form-control" placeholder="PAN No." style="text-transform: uppercase;">
                                <?php echo form_error('pan_no'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="sector_id">Sector</label>
                            <select class="form-control" name="sector_id" id="sector_id">
                                <option value="" hidden="true">Select Sector</option>
                                <?php if (!empty($sectorList)) { ?>
                                    <?php foreach ($sectorList as $key => $value) { ?>
                                        <option value="<?php echo $value['sector_id_pk'] ?>" <?php echo set_select('sector_id', $value['sector_id_pk']) ?>>
                                            <?php echo $value['sector_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">No Data Found</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('sector_id'); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="" for="course_id">Job Roles</label>
                            <select class="form-control" name="course_id" id="course_id">
                                <option value="" hidden="true">Select Job Roles</option>
                                <?php if (!empty($courseList)) { ?>
                                    <?php foreach ($courseList as $key => $value) { ?>
                                        <option value="<?php echo $value['course_id_pk'] ?>" <?php echo set_select('course_id', $value['course_id_pk']) ?>>
                                            <?php echo $value['course_name']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="" disabled="true">Select Sector First</option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('course_id'); ?>
                        </div>
                        <div class="col-md-3">
                            <label class="" for="empanelled">Whether Empanelled</label>
                            <select class="form-control" name="empanelled" id="empanelled">
                                <option value="" hidden="true">Select Whether Empanelled</option>
                                <option value="1" <?php echo set_select('empanelled', 1) ?>>Yes</option>
                                <option value="0" <?php echo set_select('empanelled', 0) ?>>No</option>
                            </select>
                            <?php echo form_error('empanelled'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-md-4">
                            <label class="" for="platform">Platform Training Completed</label>
                            <select class="form-control" name="platform" id="platform">
                                <option value="" hidden="true">Select Platform Training Completed</option>
                                <option value="1" <?php echo set_select('platform', 1) ?>>Yes</option>
                                <option value="0" <?php echo set_select('platform', 0) ?>>No</option>
                            </select>
                            <?php echo form_error('platform'); ?>
                        </div> -->
                        <!-- <div class="col-md-4">
                            <label class="" for="domain">Domain Training Completed</label>
                            <select class="form-control" name="domain" id="domain">
                                <option value="" hidden="true">Select Domain Training Completed</option>
                                <option value="1" <?php echo set_select('domain', '1', FALSE) ?>>Yes</option>
                                <option value="0" <?php echo set_select('domain', 0) ?>>No</option>
                            </select>
                            <?php echo form_error('domain'); ?>
                        </div> -->
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <br>
                            <button type="submit" name="search" value="<?php echo md5(100); ?>" class="btn btn-info btn-sm btn-block">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                            </button>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <a href="mis/empanelled_assessor_report/download_report">
                                <button type="button" name="download" value="<?php echo md5(200); ?>" class="btn btn-success btn-sm btn-block">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    Download Report
                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                </button>
                            </a>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
                <?php echo form_close(); ?>

                <table class="table table-hover">
                    <thead>
                        <tr class="success">
                            <td colspan="8" align="center">
                                <h4><strong>Status of TOA</strong></h4>
                            </td>
                        </tr>
                        <tr class="success">
                            <th>Sl No.</th>
                            <th>Name of Approved Assessor</th>
							<th>PAN</th>
                            <th>Sector</th>
                            <th>Job Roles</th>
                            <th>Whether Platform Training Completed (Yes/No)</th>
                            <th>Whether Domain Training Completed (Yes/No)</th>
                            <th>Whether Empanelled (Yes/No)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($empanelledAssessorList)) { ?>
                            <?php $count = $offset; ?>
                            <?php foreach ($empanelledAssessorList as $key => $assessor) { ?>
                                <tr>
                                    <td><?php echo ++$count; ?>.</td>
                                    <td><?php echo $assessor['assessor_name']; ?></td>
									<td><?php echo $assessor['pan']; ?></td>
                                    <td><?php echo $assessor['sector_name']; ?></td>
                                    <td><?php echo $assessor['course_name']; ?></td>
                                    <td class="text-center">
                                        <?php if ($assessor['empanelled_id_pk'] != NULL) { ?>
                                            <span class="label label-success">
                                                <i class="fa fa-check" aria-hidden="true"></i> Yes
                                            </span>
                                        <?php } elseif ($assessor['platform_training'] == 1) { ?>
                                            <span class="label label-success">
                                                <i class="fa fa-check" aria-hidden="true"></i> Yes
                                            </span>
                                        <?php } else { ?>
                                            <span class="label label-warning">
                                                <i class="fa fa-times" aria-hidden="true"></i> No
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($assessor['empanelled_id_pk'] != NULL) { ?>
                                            <span class="label label-success">
                                                <i class="fa fa-check" aria-hidden="true"></i> Yes
                                            </span>
                                        <?php } elseif ($assessor['domain_training'] == 1) { ?>
                                            <span class="label label-success">
                                                <i class="fa fa-check" aria-hidden="true"></i> Yes
                                            </span>
                                        <?php } else { ?>
                                            <span class="label label-warning">
                                                <i class="fa fa-times" aria-hidden="true"></i> No
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($assessor['empanelled_id_pk'] != NULL) { ?>
                                            <span class="label label-success">
                                                <i class="fa fa-check" aria-hidden="true"></i> Yes
                                            </span>
                                        <?php } else { ?>
                                            <span class="label label-warning">
                                                <i class="fa fa-times" aria-hidden="true"></i> No
                                            </span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr class="danger">
                                <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
    </section>
</div>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<script>
    $(document).ready(function() {
        $(document).on('change', '#sector_id', function() {
            var sector_id = $(this).val();

            $.ajax({
                    type: 'GET',
                    url: 'mis/empanelled_assessor_report/getCourse',
                    dataType: 'json',
                    data: {
                        sector_id: sector_id
                    }
                })
                .done(function(response) {
                    $('#course_id').html(response);
                })
                .fail(function() {
                    console.log('error');
                });
        });
    });
</script>