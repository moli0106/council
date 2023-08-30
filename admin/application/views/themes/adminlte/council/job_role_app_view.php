<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    .star {
        color: red;
        font-size: 14px;
    }

    .mtop20 {
        margin-top: 20px;
    }

    .mbottom20 {
        margin-bottom: 20px;
    }

    .mright20 {
        margin-right: 20px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Assessor List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Assessor List</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor List</h3>
                
            </div>
            <div class="box-body">
            <?php echo form_open("admin/council/job_role_app",array('id'=>"search")); ?>
                <div class="row">
                    <div class="col-md-2">
                        <label for="pan">PAN</label>
                        <input type="text" name="pan" id="pan" class="form-control" placeholder="PAN">
                        
                    </div>
                    <!-- <div class="col-md-2">
                        <label for="assessor_code">Assessor code</label>
                        <input type="text" name="assessor_code" id="assessor_code" class="form-control" placeholder="Assessor Code">
                    </div> -->
                    <div class="col-md-3">
                        
                        <label for="certified">Certified under any assessment body?</label>
                        <select name="certified" id="certified" class="form-control select2">
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                            
                        </select>
                    </div>
					<div class="col-md-3">
                        
                        <label for="sector_id">Sector</label>
							<select class="form-control select2" style="width: 100%;" name="sector_id">
                                <option value="">-- Select Sector --</option>
                                <?php foreach($sectors as $sector){ ?>
                                <option value="<?php echo $sector['sector_id_pk'] ?>"
                                    <?php echo set_select('sector_id',$sector['sector_id_pk']) ?>>
                                    <?php echo $sector['sector_name'] ?> (<?php echo $sector['sector_code'] ?>)</option>
                                <?php } ?>
                            </select>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="pan_no">Submission Date</label>
                            <input type="text" name="submit_date" id="submit_date" value="<?php echo set_value('submit_date')?>" class="form-control" placeholder="dd-mm-yyyy" readonly>
                            <?php echo form_error('submit_date'); ?>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <span for="">&nbsp;</span><br>
                        <button type="submit" class="btn btn-primary">Search</button>
                        
                    </div>
                    <div class="col-md-3"></div>
                </div>
            <?php echo form_close(); ?>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>PAN</th>
                            <th>Assessor Code</th>
                            <th>Submission Date</th>
							<th>Sector</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($apps as $app){ ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo strtoupper($app['fname']); ?> <?php echo strtoupper($app['mname']); ?> <?php echo strtoupper($app['lname']); ?></td>
                            <td><?php echo $app['pan']; ?></td>
                            <td><?php echo $app['assessor_code']; ?></td>
                            <td><?php echo date("d-m-Y", strtotime($app['final_submission_time'])); ?></td>
							<td><?php echo $app['sector_name']; ?></td>
                            <td><?php echo $app['process_name'] != NULL ? $app['process_name'] : "NA" ?></td>
                            <td>
                            <a href="council/assessor_list/view_details/<?php echo md5($app['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs">View</a>
                            <?php if($this->session->stake_id_fk == 4) { ?>
                                <?php if($app['process_id_pk'] == 2){ ?>
                                <a href="council/job_role_app/accept_course/<?php echo $app['assessor_registration_application_nubmer_id_pk']?>/<?php echo md5($app['assessor_registration_details_pk'])?>/<?php echo $app['assessor_registration_application_no'] ?>" class="btn btn-primary btn-xs">Accept Course</a>
                                <?php } ?>
                            <?php } elseif($this->session->stake_id_fk == 5 || $this->session->stake_id_fk == 2){ ?>
                                <?php if($app['process_id_pk'] == 3 || $app['process_id_pk'] == 4){ ?>
                                <a href="council/job_role_app/accept_course/<?php echo $app['assessor_registration_application_nubmer_id_pk']?>/<?php echo md5($app['assessor_registration_details_pk'])?>/<?php echo $app['assessor_registration_application_no'] ?>" class="btn btn-primary btn-xs">Accept Course</a>
                               
                                <?php } ?>
                            <?php } ?>

                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                

            </div>



            <div class="box-footer">
                <?php //echo $page_links ?>
            </div>
        </div>
        
    </section>
     <!-- Modal -->
     <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script>
    $('#submit_date').datepicker({
		startDate: '',
        endDate:'0d',
		autoclose: true,
		format: 'dd-mm-yyyy',
	});
    </script>