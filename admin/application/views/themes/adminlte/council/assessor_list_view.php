<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

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
                <?php echo form_open('admin/council/assessor_list',array('autocomplete'=> 'off')); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pan_no">PAN No.</label>
                            <input type="text" name="pan_no" id="pan_no" value="<?php echo set_value('pan_no')?>" class="form-control" placeholder="PAN No." style="text-transform: uppercase;">
                            <?php echo form_error('pan_no'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>SSC/ WBSCTVESD certified assessor ? <span class="text-danger">*</span></label>
                            <select class="form-control select2 select2-hidden-accessible" id="ssc_wbsctvesd_certified" name="ssc_wbsctvesd_certified" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                    <option value="">-- Select --</option>
                                    <option value="1" <?php echo set_select("ssc_wbsctvesd_certified",1) ?>>Yes </option>
                                    <option value="2" <?php echo set_select("ssc_wbsctvesd_certified",2) ?>>No </option>
                            </select>
                            <?php echo form_error('ssc_wbsctvesd_certified'); ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="inputtp">&nbsp;</label><br>
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                </div>
                
                <?php echo form_close(); ?>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Assessor Name</th>
                            <th>PAN No.</th>
                            <th>Mobile No.</th>
                            <th>Assessor Code</th>
                            <!--<th>Status</th>-->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($assessors as $assessor){ ?>
                        <tr>
                            <td><?php echo $offset + $i; ?></td>
                            <td><?php echo strtoupper($assessor['fname']) ?> <?php echo strtoupper($assessor['mname']) ?> <?php echo strtoupper($assessor['lname']) ?></td>
                            <td><?php echo $assessor['pan'] ?></td>
                            <td><?php echo $assessor['mobile_no'] ?></td>
                            <td><?php echo $assessor['assessor_code'] == NULL ? '<span class="label label-danger">Form B not filled</span>' : $assessor['assessor_code']; ?></td>
                            <!--<td><?php //echo $assessor['process_name'] == NULL ? "NA" : $assessor['process_name']; ?></td>-->
                            <td>
                            
                                <a href="council/assessor_list/view_details/<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs">View</a>
								<?php if($this->session->stake_id_fk == 4){?>
									<?php if($assessor['process_status_id_fk'] == 2) { ?>
										<a href="council/assessor_list/view_course_details/<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-success btn-xs">Accept Course</a>
									<?php }?>
								<?php }?>
                                <?php /*if($assessor['process_status_id_fk'] == 3) { ?>
                                    <a href="council/assessor_list/view_course_details/<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs">Accepted Course</a><br>
                                    <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-success btn-xs approve_assessor" data-toggle="modal" data-target="#myModal">Accept</a>
                                    <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-danger btn-xs reject_assessor" data-toggle="modal" data-target="#myModal">Reject</a>
                                <?php }*/?>
								
								<?php if($this->session->stake_id_fk == 2 || $this->session->stake_id_fk == 5) { ?>
                                    <?php if($assessor['process_status_id_fk'] == 3) { ?>
                                        <a href="council/assessor_list/view_course_details/<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs">Accepted Course</a><br>
                                        <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-success btn-xs approve_assessor" data-toggle="modal" data-target="#myModal">Accept</a>
                                        <a alt="<?php echo $offset ?>" href="<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-danger btn-xs reject_assessor" data-toggle="modal" data-target="#myModal">Revert</a>
                                    <?php }?>
                                <?php }else{?>
                                    <?php if($assessor['process_status_id_fk'] == 3) { ?>
                                        <a href="council/assessor_list/view_course_details/<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs">Accepted Course</a><br>
                                    <?php }?>
                                <?php }?>
								
								
								<?php if($assessor['process_status_id_fk'] == 5 || $assessor['process_status_id_fk'] == 6) { ?>
                                    <a href="council/assessor_list/view_course_details/<?php echo md5($assessor['assessor_registration_details_pk']) ?>" class="btn btn-primary btn-xs">Accepted Course</a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php $i++;  } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

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