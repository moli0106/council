<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<script src="<?php echo $this->config->item('theme_uri');?>md5_js/core.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>md5_js/md5.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <style>
      .course_sector_block, .work_exp_section, .experience_section, .agency_section{
    padding:10px 0px 10px 0px;
    margin-bottom:10px;
    border:2px solid #CCC;
      }
      .btn-space {
    margin-right: 5px;
    }
  </style>
  <!-- For disabled on final submit -->
  <?php if($app_data[0]['final_flag'] == 't'){
        $disabled="disabled";
    }else{
        $disabled=NULL;  
        }
        
    ?>
    <!-- For disabled on final submit -->
  <div class="content-wrapper">
    <section class="content-header">
    	<h1>Assessor Registration Form</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> Assessor Registration Form</li>
            <li class="active"><i class="fa fa-envelope-o"></i> Present Engagement</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/'. uri_string(), array('id'=>'basic_details')); ?>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Present Engagement</h3>
            </div>
            <div class="box-body">

                <?php if(isset($status)){ ?>
                    <div class="alert alert-<?php echo $status == TRUE ? 'success' : 'danger'; ?>">
                        <strong>Success!</strong> <?php echo $message; ?>.
                    </div>
                <?php } ?>

                <?php 
					if($this->session->flashdata('alert_msg'))
					{
				?>
						<div class="alert alert-success"><p><?php echo $this->session->flashdata('alert_msg'); ?></p></div>
				<?php 
					}
				?>
                
                <ul class="nav nav-tabs">
                <li><a href="assessor_profile/assessor_registration/basic">Basic</a></li>
                    <li><a href="assessor_profile/assessor_registration/course">Course</a></li>
                    <li><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert Experience</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/ssc_wbsctvesd_certified">SSC/ WBSCTVESD <br> Certified</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
                </ul>
                <!-- From start -->
                <div class="clearfix"></div>
                <br>
                <div>
					<?php if(count($assessor_working_centre)){ ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:20px;">Sl#</th>
                                        <th>Working</th>
                                        <th>Centre/UDISE Code</th>
                                        <th>Centre Name</th>
                                        <th style="width:150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($assessor_working_centre as $assessor_working){ ?>

                                    <?php 
                                        $working_id=$assessor_working['working_id_fk'];
                                    ?>
                                        <tr id="assessor_exp_<?php echo md5($assessor_working['working_map_id_pk']); ?>">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $assessor_working['working_name']; ?></td>
                                            <td><?php if($assessor_working['centre_code']!=''){ echo $assessor_working['centre_code'];}else{echo 'N/A';} ?></td>
                                            <td><?php if($assessor_working['centre_name']!=''){echo $assessor_working['centre_name'] ;}else{echo 'N/A';}?></td>
                                            
                                            <td>
                                                <?php if($app_data[0]['final_flag'] == 'f' || $app_data[0]['final_flag'] == ''){ ?>
                                                	<a href="javascript:void(0)" id="<?php echo md5($assessor_working['working_map_id_pk']); ?>" class="btn btn-danger btn-xs assessor_professional_remove" data-toggle="modal" data-target="#assessor_expRemove">Remove</a>
												<?php } ?>
                                            </td>
                                        </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <hr/>
                <?php if($app_data[0]['final_flag'] != 't'){ ?>
                <h4>Present Engagement details</h4><hr>
                <div class="experience_block">
            

                <div class="row">
                <div class="col-md-4">
                <div class="form-group">
                        <label for="sel1">Are you working in any<span class="text-danger">*</span></label>
                        <select class="form-control select2 select2-hidden-accessible" id="working_in" name="working_in" style="width: 100%;" tabindex="-1" aria-hidden="true" autocomplete="off" <?php echo $disabled; ?>>
                                <option value="">-- Select --</option>
                                <?php if($working_id==1 || $working_id==2 || $working_id==4){?>
                                <?php foreach($working_with_pbssd_vtc as $pbssd_vtc) { ?>
                                    <option value="<?php echo $pbssd_vtc["working_id_pk"] ?>" <?php echo set_select("working_in",$pbssd_vtc["working_id_pk"]) ?>><?php echo $pbssd_vtc["working_name"] ?> </option>
                                <?php } ?>
                                <?php }elseif($working_id==3){?>
                                    <!-- Nothing -->
                                <?php } else{?>
                                    <?php foreach($working_with_centre as $working_with) { ?>
                                        <option value="<?php echo $working_with["working_id_pk"] ?>" <?php echo set_select("working_in",$working_with["working_id_pk"]) ?>><?php echo $working_with["working_name"] ?> </option>
                                    <?php } ?>
                                    <?php }?>
                                
                                
                        </select>
                        <?php echo form_error('working_in'); ?>
                    </div>
                </div>
                <?php  if($this->input->method(TRUE) == "GET"){ ?>
                <div class="centre_hide_show" style="<?php echo $app_data[0]['working_in'] != '3' ? "" : "display:none" ; ?>">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Centre/UDISE Code<span class="text-danger">*</span></label>
                            
                                <input type="text" value="<?php echo set_value("centre_code"); ?>" name="centre_code" id="centre_code" class="form-control" placeholder="Centre Code">
                                
                            <?php echo form_error('centre_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Centre Name<span class="text-danger">*</span></label>
                            
                                <input type="text" value="<?php echo set_value("centre_name"); ?>" name="centre_name" id="centre_name" class="form-control" placeholder="Centre Name" readonly>
                              
                            <?php echo form_error('centre_name'); ?>
                        </div>
                    </div>
                </div>
                <?php } elseif($this->input->method(TRUE) == "POST"){ ?>
                    <div class="centre_hide_show" style="<?php echo $this->input->post("working_in") != '3' ? "" : "display:none" ; ?>">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Centre Code<span class="text-danger">*</span></label>
                            
                                <input type="text" value="<?php echo set_value("centre_code"); ?>" name="centre_code" id="centre_code" class="form-control" placeholder="Centre Code">
                               
                            <?php echo form_error('centre_code'); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Centre Name<span class="text-danger">*</span></label>
                           
                                <input type="text" value="<?php echo set_value("centre_name"); ?>" name="centre_name" id="centre_name" class="form-control" placeholder="Centre Name" readonly>
                            
                            <?php echo form_error('centre_name'); ?>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            </div>
            <?php }?>
            
                <div class="clearfix"></div>
                <!-- From end -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/assessor_experience" class="btn btn-primary btn-space confirm_pre"> < Previous</a>
                    <a href="assessor_profile/assessor_registration/ssc_wbsctvesd_certified" class="btn btn-primary btn-space confirm_next">Next > </a>
                </div>
                <!-- Added by Waseem on 23-01-2021 -->
                <?php if($app_data[0]['final_flag'] != 't'){ ?>
                <button type="submit" class="btn btn-primary pull-right">Add & Save</button>
                <?php } ?>
            </div>
            <!-- box-footer -->
        </div>
        <?php echo form_close(); ?>

        
	</section>
</div>


<!---------------------------- Modal for Remove Work Exp ----------------------->
<div id="assessor_expRemove" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content modal_remove_content">

	    </div>
	  </div>
	</div>
    <!---------------------------- Modal for Remove Work Exp ----------------------->
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>


