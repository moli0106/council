<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
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
    	<h1>Document Upload Form</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> Assessor Registration Form</li>
            <li class="active"><i class="fa fa-envelope-o"></i> Document Upload</li>
        </ol>
    </section>
    <section class="content">
        <?php echo form_open_multipart('admin/'. uri_string(), array('id'=>'edu_quali')); ?>
        
        <?php if(isset($message)){?>
        
        <div class="alert alert-success">
            <?php echo $message; ?>
        </div>
        
        <?php } ?>
        <!-- 21-04-2021 -->
        <input type="hidden" name="application_no" id="application_no" class="form-control" value="<?php echo $application_count[0]['assessor_registration_application_no'] ?>">
        <input type="hidden" name="application_count_id" id="application_count_id" class="form-control" value="<?php echo $application_count[0]['assessor_registration_application_nubmer_id_pk'] ?>">
        <!-- 21-04-2021 --> 

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Document Upload</h3>
            </div>
            <div class="box-body">

            <ul class="nav nav-tabs">
                    <li><a href="assessor_profile/assessor_registration/basic">Basic</a></li>
                    <li><a href="assessor_profile/assessor_registration/course">Course</a></li>
                    <li><a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp">Qualifications & <br>Professional<br>Experience</a></li>
                    <li class="active"><a href="assessor_profile/assessor_registration/document_upload">Document<br>Upload</a></li>
                    <li><a href="assessor_profile/assessor_registration/contact">Contact</a></li>
                    <li><a href="assessor_profile/assessor_registration/work_experience">Work <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/assessor_experience">Assessor or <br>Expert <br>Experience</a></li>
                    <li><a href="assessor_profile/assessor_registration/professional_details">Present <br>Engagement</a></li>
                    <li><a href="assessor_profile/assessor_registration/ssc_wbsctvesd_certified">SSC/ WBSCTVESD <br> Certified</a></li>
                    <li><a href="assessor_profile/assessor_registration/resume_photo">Resume<br>& Photo</a></li>
                    <li><a href="assessor_profile/assessor_registration/final_submit">Final Submit</a></li>
            </ul>
            <!-- From start -->
            <div class="clearfix"></div>
            <br>
                
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Qualification</th>
                            <th>Name of Institute/College/Organization</th>
                            <th>Certificate No/ID</th>
                            <th>Certificate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach($docs as $doc) { ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $doc["qualification"] ?></td>
                            <td><?php echo $doc["institute_name"] ?></td>
                            <td><?php echo $doc["certificate_no"] ?></td>
                            <td>
                                <a href="assessor_profile/assessor_registration/download_doc_file/<?php echo $doc["council_assessor_registration_document_map_id_pk"] ?>" class="btn btn-primary btn-xs">Download</a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                
            <br>
            <?php if($app_data[0]['final_flag'] != 't'){ ?>
            <div class="row">
                <div class="col-md-3">
                    
                    <span class="qualification">Qualification <span class="text-danger">*</span></span>
                    <select name="qualification" id="qualification" class="form-control select2">
                        <option value="">-- Select Qualification --</option>

                        <?php foreach($qualifications as $qualification){ ?>
                        <option value="<?php echo $qualification['qualification_id_pk'] ?>" <?php echo set_select("qualification",$qualification['qualification_id_pk']) ?>><?php echo $qualification['qualification'] ?></option>
                        <?php } ?>
                        
                    </select>
                    <?php echo form_error('qualification'); ?>
                </div>
                <div class="col-md-3">
                    <span class="institute">Name of Institute/College/Organization <span class="text-danger">*</span></span>
                    <input type="text" name="institute" id="institute" class="form-control" placeholder="Institute/College/Organization">
                    <?php echo form_error('institute'); ?>
                </div>
                <div class="col-md-3">
                    <span class="certificate_no">Certificate No/ID <span class="text-danger">*</span></span>
                    <input type="text" name="certificate_no" id="certificate_no" class="form-control" placeholder="Certificate No/ID">
                    <?php echo form_error('certificate_no'); ?>
                </div>
                <div class="col-md-3">
                    <span class="institute">Certificate <span class="text-danger">*</span></span>
                    <input type="file" name="certificate" id="certificate" class="form-control">
                    <?php echo form_error('certificate'); ?>
                </div>
               
            </div>
			<div class="row">
				<div class="col-md-12">
                    <span class="institute">Note: <span style="color:red">Please make relevant documents of specified minimum qualifications in a single pdf and then upload</span></span>
                </div>
			</div>
            <?php } ?>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="assessor_profile/assessor_registration/edu_quali_indus_profe_exp" class="btn btn-primary btn-space confirm_pre">< Previous</a>
                    <a href="assessor_profile/assessor_registration/contact" class="btn btn-primary btn-space confirm_next">Next > </a>
                </div>
                <?php if($app_data[0]['final_flag'] != 't'){ ?>
                <button type="submit" class="btn btn-primary pull-right">Save</button>
                <?php } ?>
            </div>
            <!-- box-footer -->
        <?php echo form_close(); ?>

        
	</section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>