<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Empanelled Assessor List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Empanelled Assessor List</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Empanelled Assessor List</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('admin/council/empanelled_assessor_list',array('autocomplete'=> 'off')); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pan_no">PAN No.</label>
                            <input type="text" name="pan_no" id="pan_no" value="<?php echo set_value('pan_no')?>" class="form-control" placeholder="PAN No." style="text-transform: uppercase;">
                            <?php echo form_error('pan_no'); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="inputtp">&nbsp;</label><br>
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>
                    <div class="col-md-4 pull-right">
                        <label for="inputtp">&nbsp;</label><br>
                        <a href="council/empanelled_assessor_list/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a>
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
                            <th>Permanent District</th>
                            <th>Present District</th>
                            <th>Sector</th>
                            <th>Course</th>
							<!--th>whether SSC Certified</th-->
							<th>Empanelment validity</th>
							<th>Empnamelment Status</th>
							<th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($assessors))
                            {?>
                        <?php $i = 1; foreach($assessors as $assessor){ ?>
                        <tr id="<?php echo md5($assessor['assessor_registration_details_pk']); ?>">
                            <td><?php echo $offset + $i; ?></td>
                            <td><?php echo strtoupper($assessor['assessor_name']) ?></td>
                            <td><?php echo $assessor['pan'] ?></td>
                            <td><?php echo $assessor['mobile_no'] ?></td>
                            <td><?php echo $assessor['permanent_district'];?></td>
                            <td><?php echo $assessor['present_district'];?></td>
                            <td><?php echo $assessor['sector_name'] ?></td>
                            <td><?php echo $assessor['course_name'] ?></td>
							<!--td><?php echo $assessor['certified_by_any_assessor'] ?></td-->
							<td><?php echo date("d/m/Y", strtotime($assessor['empanelment_validity'])) ?></td>
                            <!-- <td>
                                <button type="button" class="btn btn-info btn-sm getSectorJobRole" data-toggle="modal" data-target="#myModalList"><i class="fa fa-folder-open" aria-hidden="true"></i>
                                </button>
                            </td> -->
							<td><?php if($assessor['course_grouping_status']==0){echo 'Originally Empnameled';}else{echo 'Empaneled according to Group';} ?></td>
                            <td>
								<?php if($assessor['course_grouping_status']==0){?>
                                <a href="council/empanelled_assessor_list/list_course_map/<?php echo md5($assessor['assessor_registration_details_pk'])?>/<?php echo md5($assessor['emp_course_id']) ?>" target="_blank"  class="btn btn-sm btn-info"><i class="fa fa-plus" aria-hidden="true"> Empanell Course</i></button></a>
								<?php }?>
                            </td>
                        </tr>

                        <?php $i++;  } ?>
                   <?php } else { ?>
                    <tr>
                        <td colspan="7" align="center" class="text-danger">No Data Found...</td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <?php echo $page_links; ?>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div id="myModalList" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close text-danger" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-info">Sector & Job Role List</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sl. No.</th>
                            <th>Sector</th>
                            <th>Job Role</th>
                        </tr>
                    </thead>
                    <tbody id="sectorJobRoleList">
                        <tr>
                            <td colspan="3" align="center">Please wait a moment...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>

    </div>
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>