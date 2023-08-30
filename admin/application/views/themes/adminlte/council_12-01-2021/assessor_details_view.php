<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

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
                                <b>Date of birth: </b><?php echo $assessor[0]['dob'] ?><br>
                                <b>Language: </b><?php echo $assessor[0]['language_desc'] ?><br>
                                <b>PAN No.: </b><?php echo $assessor[0]['pan'] ?><br>
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
                            <td style="width:20%;">Applying for expert</td>
                            <td style="width:30%"><?php echo $assessor[0]['apply_for_expert'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                            <td style="width:20%;">Academic Expert</td>
                            <td style="width:30%"><?php echo $assessor[0]['expart_type_academic'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Industrial expert</td>
                            <td style="width:30%"><?php echo $assessor[0]['expart_type_industrial'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                            <td style="width:20%;">Trainer of trainers</td>
                            <td style="width:30%"><?php echo $assessor[0]['apply_for_trainer_of_trainer'] == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true"></i>' ?></td>
                            
                           
                        </tr>
                    </tbody>
                </table>

                <?php if(count($jobroles)){ ?>
                    
                    <table class="table table-hover">
                        <thead>
                            <th>SL</th>
                            <th>Course</th>
                            <th>Sector</th>
                            <th>Domain Qualification</th>
                            <th>Domain Experience</th>
                            <th>Domain</th>
                            
                            <th>Job role specific qualification</th>
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
                                <td><a class="btn btn-primary btn-xs" href="<?php echo $certificate['council_assessor_registration_certified_map_id_pk']; ?>">Download</a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
                <h4>Residential Address & Contact Information</h4>
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
                <h4>Residential Address & Contact Information</h4>
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
                                <td><a class="btn btn-primary btn-xs" href="<?php echo $get_work_exp['assessor_id_fk']; ?>">Download</a></td>
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
                                <td><a class="btn btn-primary btn-xs" href="<?php echo $get_assessor_expert['assessor_registration_assessor_expert_map_id_pk']; ?>">Download</a></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Wrking in</td>
                            <td style="width:30%;"><?php echo $assessor[0]['working_in']; ?></td>
                            <td style="width:20%;">Centre Code</td>
                            <td style="width:30%;"><?php echo $assessor[0]['centre_code']; ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Centre Name</td>
                            <td style="width:30%;"><?php echo $assessor[0]['centre_name']; ?></td>
                            <td style="width:20%;">Download CV</td>
                            <td style="width:30%;"><a class="btn btn-primary btn-xs" href="<?php echo $assessor[0]['assessor_registration_details_pk']; ?>">Download</a></td>
                        </tr>
                    </tbody>
                </table>
                
    
            </div>
            <div class="box-footer">
               
            </div>
        </div>
    </section>
        
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>