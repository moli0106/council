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
                <?php echo form_open('admin/council/assessor_list_iti',array('autocomplete'=> 'off')); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="pan_no">PAN No.</label>
                            <input type="text" name="pan_no" id="pan_no" value="<?php echo set_value('pan_no')?>" class="form-control" placeholder="PAN No." style="text-transform: uppercase;">
                            <?php echo form_error('pan_no'); ?>
                        </div>
                    </div>
					<!-- <div class="col-md-3">
                        <label for="working_id">Working</label>
							<select class="form-control select2" style="width: 100%;" name="working_id">
                                <option value="">-- Select  --</option>
                                <?php foreach($working_master as $working){ ?>
                                <option value="<?php echo $working['working_id_pk'] ?>"
                                    <?php echo set_select('working_id',$working['working_id_pk']) ?>>
                                    <?php echo $working['working_name'] ?></option>
                                <?php } ?>
                            </select>
                    </div> -->
                    
                    <div class="col-md-3">
                        <label for="inputtp">&nbsp;</label><br>
                        <button type="submit" class="btn btn-info">Search</button>
                    </div>

                    <div class="col-md-4 pull-right">
                        <label for="inputtp">&nbsp;</label><br>
                        <a href="council/assessor_list_iti/excel_download"><button type="button" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button></a>
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
                            <!--<th>District</th>-->
                            <!-- <th>Sector</th>
                            <th>Course</th> -->
							<th>Organisation name</th>
							<th>Area of work</th>
                            <!-- <th>Action</th> -->
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
                            <!--<td><?php //echo $assessor['district_name'] ?></td>-->
                            <!-- <td><?php //echo $assessor['sector_name'] ?></td>
                            <td><?php //echo $assessor['course_name'] ?></td> -->
							<td><?php echo $assessor['organisation_name'] ?></td>
							
							<td><?php echo $assessor['area_of_work']?></td>
                            <!-- <td>
                                <button type="button" class="btn btn-info btn-sm getSectorJobRole" data-toggle="modal" data-target="#myModalList"><i class="fa fa-folder-open" aria-hidden="true"></i>
                                </button>
                            </td> -->
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
                <?php //echo $page_links; ?>
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