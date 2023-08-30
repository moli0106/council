<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
    <h1>Aassessor Batch</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i>Create Assessor Batch</li>
        </ol>
    </section>

    <section class="content">
        <?php if(isset($status)){ ?>
            <div class="alert alert-<?php echo $status ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>
        <?php } ?>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Create Assessor Batch</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/assessor_ems/assessor_batch/add', array('id' => 'assessor-batch-form')) ?>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Select Batch Type <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" name="batch_type" id="batch_type">
                                    <option value="" hidden="true">Select Batch Type</option>
                                    <!-- <option value="Platform">Platform</option> -->
                                    <!-- <option value="Domain">Domain</option> -->
                                    <?php foreach($batch_type as $key => $value) { ?>
                                        <option value="<?php echo $value['question_type_id_pk']; ?>"><?php echo $value['question_type_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('batch_type'); ?>
                            </div>
                        </div>
                        <div class="col-md-3 sector-div">
                            <div class="form-group">
                                <label class="" for="">Select Sector <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" name="sector_id" id="sector-id">
                                    <option value="" hidden="true">Select Sector</option>
                                    <?php 
                                        if(count($sector_list))
                                        {
                                            foreach($sector_list as $sector){ ?>
                                                
                                                <option value="<?php echo $sector['sector_id_pk'] ?>"
                                                    <?php echo set_select('sector_id',$sector['sector_id_pk']) ?>>
                                                    <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)
                                                </option>
                                            <?php } 
                                        } else { echo'<option value="" disabled="true">No Data Found...</option>'; }
                                    ?>
                                </select>
                                <?php echo form_error('sector_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-3 jobrole-div">
                            <div class="form-group">
                                <label class="" for="">Job Role <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" name="course_id" id="job_role_id">
                                    <option value="" disabled="true">Select Sector First...</option>
                                </select>
                                <?php echo form_error('course_id'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Master Trainer <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" name="trainer_id" id="trainer_id">
                                    <option value="" disabled="true">Select Job Role First...</option>
                                </select>
                                <?php echo form_error('trainer_id'); ?>
                            </div>
                        </div>
                    </div>
                
                    <div class="row assessor-list-row" style="display: none;">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title assessorBoxTitle"></h3>
                                </div>
                                <div class="box-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
												<th>PAN</th>
                                                <th>Assessor Mobile</th>
                                                <th>Assessor Email</th>
												<th>Assessor Sector</th>
                                            </tr>
                                        </thead>
                                        <tbody id="assessor-list-tbody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row schedule-div">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Start Date <span class="text-danger">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="common_input_div">
                                        <input type="text" value="<?php echo set_value("start_date"); ?>" class="form-control pull-right startdate" id="start_date" name="start_date" placeholder="DD/MM/YYYY" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <?php echo form_error('start_date'); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">End Date <span class="text-danger">*</span></label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <div class="common_input_div">
                                        <input type="text" value="<?php echo set_value("end_date"); ?>" class="form-control pull-right enddate" id="end_date" name="end_date" placeholder="DD/MM/YYYY" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <?php echo form_error('end_date'); ?>
                            </div>
                        </div>
                        <div class="col-md-3 bootstrap-timepicker">
                            <label for="timepicker">Start Time (24 Hrs Format)</label>
                            <div class="input-group common_input_div">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" value="<?php echo set_value('start_time'); ?>" class="form-control pull-right timepicker" id="start_time" name="start_time" readonly>
                            </div>
                            <?php echo form_error('start_time'); ?>
                        </div>
                        <div class="col-md-3 bootstrap-timepicker">
                            <label for="timepicker">End Time (24 Hrs Format)</label>
                            <div class="input-group common_input_div">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" value="<?php echo set_value('end_time'); ?>" class="form-control pull-right timepicker" id="end_time" name="end_time" readonly>
                            </div>
                            <?php echo form_error('end_time'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="" for="">Select Assessment Mode <span class="text-danger">*</span></label>
                                <select class="form-control" style="width: 100%;" name="assment_mode" id="assment_mode">
                                    <option value="" hidden="true">Select Assessment Mode</option>
                                    <!-- <option value="Online">Online</option> -->
                                    <!-- <option value="Offline">Offline</option> -->
                                    
                                    <?php foreach($assessment_mode as $key => $value) { ?>
                                        <option value="<?php echo $value['assessment_mode_id_pk']; ?>"><?php echo $value['assessment_mode_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('assment_mode'); ?>
                            </div>
                        </div>
                        <div class="col-md-6 venue-div" style="display: none;">
                            <div class="form-group">
                                <label class="" for="">Select Venue <span class="text-danger">*</span></label>
                                <select class="form-control select2" style="width: 100%;" name="venue" id="venue">
                                    <option value="" hidden="true">Select Venu</option>
                                    <!-- <option value="1">Option 1</option> -->
                                    <!-- <option value="2">Option 2</option> -->
                                    <?php foreach($venue_list as $key => $value) { ?>
                                        <option value="<?php echo $value['venue_id_pk']; ?>"><?php echo $value['institute_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo form_error('venue'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 submitBtn-div">
                            <button type="submit" class="btn btn-info btn-block form-batch-btn">Create Batch</button>
                        </div>
                    </div>

                <?php echo form_close() ?>
            </div>
			<div class="overlay" style="display:none;">
				<div class="sp sp-wave"></div>
			</div>
        </div>
    </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
