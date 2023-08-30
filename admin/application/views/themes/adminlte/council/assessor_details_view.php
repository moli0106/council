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
        <h1>Assessor Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Assessor Details</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Assessor Details</h3>
            </div>
            <div class="box-body">
                
                <h4>Basic Info</h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="text-align:center;width:25%"><img width="130" src="data:image/jpeg;charset=utf-8;base64,<?php echo $assessor[0]['photo'] ?>" alt=""><br>
                            <?php echo $assessor[0]['fname'] ?> <?php echo $assessor[0]['mname'] ?> <?php echo $assessor[0]['lname'] ?>
                            </td>
                            <td style="width:75%" colspan="3">

                                <b>Full Name: </b><?php echo $assessor[0]['salutation_desc'] ?> <?php echo $assessor[0]['fname'] ?> <?php echo $assessor[0]['mname'] ?> <?php echo $assessor[0]['lname'] ?><br>
                                <b>Gender: </b><?php echo $assessor[0]['gender_description'] ?><br>
                                <b>Date of birth: </b><?php echo date("d-m-Y", strtotime($assessor[0]['dob'])) ?><br>
                                <b>Language: </b><?php echo $assessor[0]['language_desc'] ?><br>
                                <b>PAN No.: </b><?php echo $assessor[0]['pan'] ?> <a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/pan/<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>">Download</a><br>
                                <b><?php echo $assessor[0]['id_type_name'] ?>: </b><?php echo $assessor[0]['id_no_alt'] ?><br>
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <h4>Contact Info</h4>
                
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Mobile No.</td>
                            <td style="width:30%"><?php echo $assessor[0]['mobile_no'] ?></td>
                            <td style="width:20%;">Landline No.</td>
                            <td style="width:30%"><?php echo $assessor[0]['landline_no'] == NULL ? "Not provided" : $assessor[0]['landline_no']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Email ID.</td>
                            <td style="width:30%;"><?php echo $assessor[0]['email_id'] ?></td>
                            <td colspan="2"></td>

                        </tr>
                    </tbody>
                </table>
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
                <h4>Educational Qualification And Industry/Professional Experience</h4>
                
                
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Highest Qualification</td>
                            <td style="width:30%;"><?php echo $assessor[0]['highest_qualification']; ?></td>
                            <td style="width:20%;">Discipline</td>
                            <td style="width:30%;"><?php echo $assessor[0]['discipline']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Other Qualification</td>
                            <td style="width:30%;"><?php echo $assessor[0]['othert_quali']; ?></td>
                            <td style="width:20%;">Current Employement Status</td>
                            <td style="width:30%;"><?php echo $assessor[0]['employment_status']; ?></td>
                        </tr>
                    </tbody>
                </table>
                

                <?php if(count($certificates)){ ?>
                    <table class="table table-hover">
                        <thead>
                            <th>SL</th>
                            <th>Assessing body</th>
                            <th>Assessor certificate number</th>
                            <th>Document</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($certificates as $certificate) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $certificate['assessing_body']; ?></td>
                                <td><?php echo $certificate['certificate_number']; ?></td>
                                <td><a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/ascer/<?php echo md5($certificate['council_assessor_registration_certified_map_id_pk']); ?>">Download</a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
				
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
                                <a href="council/assessor_list/download_doc_file/<?php echo $doc["council_assessor_registration_document_map_id_pk"] ?>" class="btn btn-primary btn-xs">Download</a>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                

                <br>
				
				
                <h4>Present Address & Contact Information</h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">House / Flat / Building / Plot</td>
                            <td style="width:30%;"><?php echo $assessor[0]['house_flat_building']; ?></td>
                            <td style="width:20%;">Street Name</td>
                            <td style="width:30%;"><?php echo $assessor[0]['street']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Post Office</td>
                            <td style="width:30%;"><?php echo $assessor[0]['post_opffice']; ?></td>
                            <td style="width:20%;">Police Station</td>
                            <td style="width:30%;"><?php echo $assessor[0]['police']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">State</td>
                            <td style="width:30%;"><?php echo $assessor[0]['state_name']; ?></td>
                            <td style="width:20%;">District</td>
                            <td style="width:30%;"><?php echo $assessor[0]['district_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Block / Municipality</td>
                            <td style="width:30%;"><?php echo $assessor[0]['block_municipality_name']; ?></td>
                            <td style="width:20%;">PIN Code</td>
                            <td style="width:30%;"><?php echo $assessor[0]['pin']; ?></td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <h4>Permanent Address & Contact Information</h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">House / Flat / Building / Plot</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_house_flat_building']; ?></td>
                            <td style="width:20%;">Street Name</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_street']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Post Office</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_post_office']; ?></td>
                            <td style="width:20%;">Police Station</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_police']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">State</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_state_name']; ?></td>
                            <td style="width:20%;">District</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_district_name']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Block / Municipality</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_block_municipality_name']; ?></td>
                            <td style="width:20%;">PIN Code</td>
                            <td style="width:30%;"><?php echo $assessor[0]['permanent_pin']; ?></td>
                        </tr>
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
                                <td><a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/wex/<?php echo md5($get_work_exp['assessor_work_experience_id_pk']); ?>">Download</a></td>
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
                                <td><a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/eaaesc/<?php echo md5($get_assessor_expert['assessor_registration_assessor_expert_map_id_pk']); ?>">Download</a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
                <h4>Present Engagement</h4>
                <?php $i=1; if(count($vtc_pbssd)){ ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Centre Type</th>
                                <th>Centre Code</th>
                                <th>Centre Name</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php foreach($vtc_pbssd as $type){ ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $type['working_name']; ?></td>
                                <td><?php echo $type['centre_code']; ?></td>
                                <td><?php echo $type['centre_name']; ?></td>
                            </tr>
                        <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
                <h4>SSC/ WBSCTVESD Certified</h4>
                
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Are you a SSC/ WBSCTVESD certified assessor ?</th>
                                <th>Have you attended any TOA ?</th>
                                <th>TOA certificate</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td><?php echo $assessor[0]['ssc_wbsctvesd_certified'] == '1' ? "Yes" : "No";?></td>
                                <td><?php echo $assessor[0]['attended_any_toa'] == '1' ? "Yes" : "No";?></td>
                                <?php if($assessor[0]['toa_certificate']!=''){?>
                                <td><a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/ssc_wbsctvesd_certified/<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>">Download</a></td>
                                <?php }else{?>
                                    <td>N/A</td>
                                    <?php }?>
                            </tr>
                        </tbody>
                    </table>

                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Download CV</td>
                            <td style="width:30%;"><a class="btn btn-primary btn-xs" href="council/assessor_list/download_pdf/cv/<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>">Download</a></td>
                        </tr>
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