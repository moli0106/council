<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
@media print {
  .btn {
    display: none !important;
  }
}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Application Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Application Details</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Application Details</h3>
            </div>
            <div class="box-body print_details">
                
                
                <br>
                <h4>Course Details</h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Domain Qualification</td>
                            <td style="width:30%"><?php echo $assessor[0]['domain_qualification'] ?></td>
                            <td style="width:20%;">Domain Experiance</td>
                            <td style="width:30%"><?php echo $assessor[0]['domain_exp'] ?> year(s)</td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Domain.</td>
                            <td style="width:30%"><?php echo $assessor[0]['domain_name'] ?></td>
                            <td style="width:20%;">Applying for assessor</td>
                            <td style="width:30%"><?php echo $assessor[0]['apply_for_assessor'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Applying for expert</td>
                            <td style="width:30%"><?php echo $assessor[0]['apply_for_expert'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                            <td style="width:20%;">Academic Expert</td>
                            <td style="width:30%"><?php echo $assessor[0]['expart_type_academic'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Industrial expert</td>
                            <td style="width:30%"><?php echo $assessor[0]['expart_type_industrial'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                            <td style="" colspan="2"></td>
                           
                        </tr>
						<td style="width:20%;">Trainer of trainer</td>
							<td style="" colspan=""><?php echo $assessor[0]['apply_for_trainer_of_trainer'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?>
						</td>
                    </tbody>
                </table>

                <?php if(count($jobroles)){ ?>
                    
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Sector</th>
                            <th>Domain Qualification</th>
                            <th>Domain Experience</th>
                            <th>Domain</th>
                            
                            <th>Job role specific qualification</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($jobroles as $jobrole) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $jobrole['course_name']; ?> (<?php echo $jobrole['course_code']; ?>)</td>
                                <td><?php echo $jobrole['sector_name']; ?> (<?php echo $jobrole['sector_code']; ?>)</td>
                                <td><?php echo $jobrole['qualification']; ?></td>
                                <td><?php echo $jobrole['domain_exp']; ?> Years</td>
                                <td><?php echo $jobrole['domain_name']; ?></td>
                                <td><?php echo $jobrole['job_role_sp_quali']; ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    
                <?php } ?>
                <hr>
                <hr>
                <h4>Uploaded Documents</h4>
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
                                <a href="council/other_job_role_app/download_pdf/doc/<?php echo $assessor_registration_application_no ?>/<?php echo md5($doc["council_assessor_registration_document_map_id_pk"]) ?>" class="btn btn-primary btn-xs">Download</a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                <br>
                <h4>Work Experience</h4>
                <?php if(count($get_work_exps)){ ?>
                    <table class="table table-hover">
                        <thead>
                            <th>SL</th>
                            <th>Organisation Name</th>
                            <th>Area of Work </th>
                            <th>No of Years</th>
                            <th>No of Months</th>
                            <th>Document</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($get_work_exps as $get_work_exp) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $get_work_exp['organisation_name']; ?></td>
                                <td><?php echo $get_work_exp['area_of_work']; ?></td>
                                <td><?php echo $get_work_exp['no_of_years']; ?></td>
                                <td><?php echo $get_work_exp['no_of_months']; ?></td>
                                <td><a class="btn btn-primary btn-xs" href="council/other_job_role_app/download_pdf/work_experience/<?php echo $assessor_registration_application_no ?>/<?php echo md5($get_work_exp['assessor_work_experience_id_pk']); ?>">Download</a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>

                <br>
                <h4>Experience As Assessor / Expert of syllabus committee</h4>
                <?php if(count($get_assessor_experts)){ ?>
                    <table class="table table-hover">
                        <thead>
                            <th>SL</th>
                            <th>Job Role</th>
                            <th>NSQF Level</th>
                            <th>No of Years</th>
                            <th>No of Months</th>
                            <th>Document</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($get_assessor_experts as $get_assessor_expert) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $get_assessor_expert['course_name']; ?>(<?php echo $get_assessor_expert['course_code']; ?>)</td>
                                <td><?php echo $get_assessor_expert['nsqf_level']; ?></td>
                                <td><?php echo $get_assessor_expert['exp_as_assessor_work_years']; ?></td>
                                <td><?php echo $get_assessor_expert['exp_as_assessor_work_months']; ?></td>
                                <td><a class="btn btn-primary btn-xs" href="council/other_job_role_app/download_pdf/assessor_exp/<?php echo $assessor_registration_application_no ?>/<?php echo md5($get_assessor_expert['assessor_registration_assessor_expert_map_id_pk']); ?>">Download</a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
               


                <br>
                <h4>SSC/ WBSCTVESD Certified</h4>
                    <table class="table table-bordered table-hover table-sm">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Are you a SSC/ WBSCTVESD certified assessor?</th>
                            <th>Have you attended any TOA ?</th>
                            <th>Certificate validity</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach($ssc_certificates as $certificate) { ?>
                        <tr>
                            <td><?php echo $i ;?></td>
                            <td><?php echo $certificate['course_name']  ?> (<?php echo $certificate['course_code']; ?>)</td>
                            <td><?php echo $certificate['ssc_wbsctvesd_certified'] == 1 ? "Yes" : "No";  ?></td>
                            <td><?php echo $certificate['attended_any_toa'] == 1 ? "Yes" : "No";  ?></td>
                            <td><?php echo $certificate['cf_validity'] ?></td>
                            <td>
                            <?php
                                if($certificate['attended_any_toa'] == 1){
                                    ?><a href="council/other_job_role_app/download_pdf/ssc_certificate/<?php echo $assessor_registration_application_no ?>/<?php echo md5($certificate['council_ssc_wbsctvesd_certified_map_id_pk']); ?>">Download</a><?php 
                                } else {
                                    ?>NA<?php
                                }
                            ?>
                            
                            
                            </td>
                        </tr>
                    <?php $i++; } ?>
                    </tbody>
                </table>

            </div>
            <div class="box-footer">
               
               <button type="button" class="btn btn-primary print">Print</button>
               
            </div>
        </div>
    </section>
        
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>