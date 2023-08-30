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
        <h1>Student Details</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Details</li>
        </ol>
    </section>
    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Student Details</h3>
            </div>
            <div class="box-body print_details">
			
			
				<div>
					<table class="table table-hover">
						<tr>
							<td valign="middle" align="middle" width="20%" style="padding:10px;">
							     <img width="70" height="70"
									src="<?php echo base_url('admin/themes/adminlte/custom/council_logo.png'); ?>"> 
									<!--img width="250" height="80" src="<?php echo $this->config->item('theme_uri'); ?>admin/themes/adminlte/custom/council_logo.png"-->
								<!-- <img width="90" height="90" src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>"> -->
							</td>
						</tr>
						<tr>
							
							<td align="middle" style="font-family:arial; font-size:16px;line-height:0px;">
								<strong>WEST BENGAL STATE COUNCIL OF TECHNICAL & VOCATIONAL EDUCATION
									& SKILL DEVELOPMENT</strong> <br>


								<p valign="top" align="center"
									style="font-family:arial; font-size:13px;line-height:25px;padding-bottom:0px; border-bottom:0px solid #000;">
									<br>Karigari Bhavan, 4th & 5th Floor, Plot No. B/7,
									Action Area-III, Newtown, Rajarhat, Kolkata–700160</p>
								<!--p style="font-family:arial; font-size:13px;padding-bottom:10px;"><strong>FINAL ALLOTMENT LETTER –
										COUNSELING <?php echo $user_details['course_name']; ?></strong></p-->
							</td>
						</tr>
					</table>
				</div>
                
                <h4><b>Basic Info</b></h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
						
							 <td rowspan="7" align="middle">
                    <center>
                        <img width="130" src="data:image/jpeg;charset=utf-8;base64,<?php echo $app_data['picture'] ?>" alt=""><br>
                    </center>
                    <img style="width: 130px; border:1px solid;margin: 2px;padding: 2px"
                        src="data:image/jpeg;charset=utf-8;base64,<?php echo $app_data['sign'] ?>" alt="">
                </td>
                            <!--td style="text-align:center;width:25%"><img width="130" src="data:image/jpeg;charset=utf-8;base64,<?php echo $app_data['picture'] ?>" alt=""><br>
                            <?php echo $app_data['first_name'] ?> <?php echo $app_data['middle_name'] ?> <?php echo $app_data['last_name'] ?>
                            </td-->
                            <td style="width:75%" colspan="3">

                                <b>Full Name: </b><?php echo $app_data['salutation_desc'] ?> <?php echo $app_data['first_name'] ?> <?php echo $app_data['middle_name'] ?> <?php echo $app_data['last_name'] ?><br>
                                <b>Gender: </b><?php echo $app_data['gender_description'] ?><br>
                                <b>Date of birth: </b><?php echo date("d-m-Y", strtotime($app_data['date_of_birth'])) ?><br>
                                <b>Citizenship.: </b><?php echo $app_data['nationality_name'] ?> <br>
                                <b>Physically Challenged.:</b>
                                <?php if ( $app_data['handicapped'] == '1'){?>Yes <?php }else{?> No <?php } ?><br>
                                <b>Caste:</b>  <?php echo $app_data['caste_name'] ?> <br>
                                <b>Religion:</b>  <?php echo $app_data['religion_name'] ?> <br>
                                <b>Marital Status:</b>  <?php if( $app_data['marital_status'] == '1'){?> Married<?php } else{ ?>Unmarried <?php } ?><br>
                                 <b>Aadhar No.: </b><?php echo $app_data['aadhar_no'] ?> <a class="btn btn-primary btn-xs" href="student_profile/std_registration/download_aadhaar_doc/<?php echo md5($app_data['institute_student_details_id_pk']); ?>">Download</a><br>
                                <br/>

                                
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>

                <h4><b>Institute Information</b></h4>
                
                <table class="table table-hover">
                    <tbody>

                          <tr>
                            <td style="width:20%;">Institute Name (Institute Code)</td>
                            <td style="width:30%;"><?php echo $app_data['vtc_name'];?>&nbsp;(<?php echo $app_data['vtc_code']?>)</td>
                            <td style="width:20%;"> Course Name (Course code) </td>
                            <td style="width:30%;"><?php echo $app_data['discipline_name'];?>&nbsp;(<?php echo $app_data['discipline_code']?>)</td>
							
                        </tr>
						<tr>
							<td style="width:20%;"> Applied For </td>
                            <td style="width:30%;"><?php echo $app_data['name_for_std_reg'];?></td>
							
							<td style="width:20%;"> Year of Admission </td>
                            <td style="width:30%;"><?php echo $app_data['registration_year'];?></td>
						</tr>
                       
                    </tbody>
                </table>
                <br/>

                <h4><b>Personal Details</b></h4>
                
                <table class="table table-hover">
                    <tbody>

                          <tr>
                            <td style="width:20%;">Father Name</td>
                            <td style="width:30%;"><?php echo $app_data['father_name'] ?></td>
                            <td style="width:20%;">Mother Name</td>
                            <td style="width:30%;"><?php echo $app_data['mothers_name'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Guardian Name</td>
                            <td style="width:30%;"><?php echo $app_data['guardian_name'] ?></td>
                            <td style="width:20%;">Relationship with Guardian</td>
                            <td style="width:30%;"><?php echo $app_data['guardian_relationship'] ?></td>
                        </tr>
                        <!-- <tr>
                            <td style="width:20%;">Email ID.</td>
                            <td style="width:30%;"><?php echo $app_data['email'] ?></td>
                            <td colspan="2"></td>

                        </tr> -->
                    </tbody>
                </table>
                <br/>
                <h4><b>Contact Info</b></h4>
                
                <table class="table table-hover">
                    <tbody>

                        <tr>
                            <td style="width:20%;">Mobile No.</td>
                            <td style="width:30%"><?php echo $app_data['mobile_number'] ?></td>
                            
                        </tr>
                        <tr>
                            <td style="width:20%;">Email ID.</td>
                            <td style="width:30%;"><?php echo $app_data['email'] ?></td>
                            <td colspan="2"></td>

                        </tr>
                    </tbody>
                </table>
                <br>
                

                
                <hr>
               
                
                <br>
                <h4><b>Present Address & Others Information</b></h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Address</td>
                            <td style="width:30%;"><?php echo $app_data['address'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Address 2</td>
                            <td style="width:30%;"><?php echo $app_data['address_2'] ?></td>
                            <td style="width:20%;">Address 3</td>
                            <td style="width:30%;"><?php echo $app_data['address_3'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">State</td>
                            <td style="width:30%;"><?php echo $app_data['state_name'] ?></td>
                            <td style="width:20%;">District</td>
                            <td style="width:30%;"><?php echo $app_data['district_name'] ?></td>
                        </tr>
                        <tr>

                         <td style="width:20%;">Sub Division</td>
                            <td style="width:30%;"><?php echo $app_data['subdiv_name'] ?></td>
                            <td style="width:20%;">Block / Municipality</td>
                            <td style="width:30%;"><?php echo $app_data['block_municipality_name'] ?></td>
                           
                        </tr>

                        <tr>
                            <td style="width:20%;">Pincode.</td>
                            <td style="width:30%;"><?php echo $app_data['pincode'] ?></td>
                            <td colspan="2"></td>

                        </tr>
                    </tbody>
                </table>
				
				  <br>
                <h4><b>Educational Qualification Information</b></h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Board Name</td>
                            <td style="width:30%;"><?php echo $app_data['board_name'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Institute Name</td>
                            <td style="width:30%;"><?php echo $app_data['institute_name'] ?></td>
                            <td style="width:20%;">Passing Year</td>
                            <td style="width:30%;"><?php echo $app_data['year_of_passing'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Full Marks</td>
                            <td style="width:30%;"><?php echo $app_data['fullmarks'] ?></td>
                            <td style="width:20%;">Marks Obtained</td>
                            <td style="width:30%;"><?php echo $app_data['marks_obtain'] ?></td>
                        </tr>
                        <tr>

                         <td style="width:20%;">Percentage %</td>
                            <td style="width:30%;"><?php echo $app_data['percentage'] ?></td>
							
							<?php if($app_data['exam_id_fk'] == 3){?>
                            <td style="width:20%;">Marks of Physics</td>
                            <td style="width:30%;"><?php echo $app_data['phy_marks'] ?></td>
							<?php }?>
                        </tr>
						
						<?php if($app_data['exam_id_fk'] == 3){?>
                        <tr>

                         <td style="width:20%;">Marks of Chemistry</td>
                            <td style="width:30%;"><?php echo $app_data['chem_marks'] ?></td>
                            <td style="width:20%;">Marks of Biology /Mathematics</td>
                            <td style="width:30%;"><?php echo $app_data['math_bio_marks'] ?></td>
                           
                        </tr>
						<?php }?>

                        
                    </tbody>
                </table>

                

                

                
                
                    

                <!-- <br>
                <br>
                <br>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Download CV</td>
                            <td style="width:30%;"><a class="btn btn-primary btn-xs" href="assessor_profile/assessor_registration/download_pdf/cv/<?php echo md5($assessor[0]['assessor_registration_details_pk']); ?>">Download</a></td>
                        </tr>
                    </tbody>
                </table> -->
                
    
            </div>
            <div class="box-footer">
               
               <button type="button" class="btn btn-primary print">Print</button>
               
            </div>
        </div>
    </section>
        
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>