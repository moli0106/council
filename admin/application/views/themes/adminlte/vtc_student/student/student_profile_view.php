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
                        <img width="130" src="data:image/jpeg;charset=utf-8;base64,<?php echo $student_data['image'] ?>" alt=""><br>
                    </center>
                    <img style="width: 130px; border:1px solid;margin: 2px;padding: 2px"
                        src="data:image/jpeg;charset=utf-8;base64,<?php echo $student_data['std_signature'] ?>" alt="">
                </td>
                            <!--td style="text-align:center;width:25%"><img width="130" src="data:image/jpeg;charset=utf-8;base64,<?php echo $app_data['picture'] ?>" alt=""><br>
                            <?php echo $app_data['first_name'] ?> <?php echo $app_data['middle_name'] ?> <?php echo $app_data['last_name'] ?>
                            </td-->
                            <td style="width:75%" colspan="3">

                                <b>Full Name: </b><?php echo $student_data['first_name'] ?> <?php echo $student_data['middle_name'] ?> <?php echo $student_data['last_name'] ?><br>
                                <b>Gender: </b><?php echo $student_data['gender_description'] ?><br>
                                <b>Date of birth: </b><?php echo date("d-m-Y", strtotime($student_data['date_of_birth'])) ?><br>
                                <b>Citizenship.: </b><?php echo $student_data['nationality_name'] ?> <br>
                                <b>Physically Challenged.:</b>
                                <?php if ( $student_data['physically_challenged'] == '1'){?>Yes <?php }else{?> No <?php } ?><br>
                                <b>Caste:</b>  <?php echo $student_data['caste_name'] ?> <br>
                                <b>Religion:</b>  <?php echo $student_data['religion_name'] ?> <br>
                                <b>Marital Status:</b>  <?php if( $student_data['marital_status'] == '1'){?> Married<?php } else{ ?>Unmarried <?php } ?><br>
                                 <b>Aadhar No.: </b><?php echo $student_data['aadhar_no'] ?> <br>
                                <br/>

                                
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>

                <h4><b>VTC Information</b></h4>
                
                <table class="table table-hover">
                    <tbody>

                        <tr>
                            <td style="width:20%;">VTC Name (VTC Code) :</td>
                            <td style="width:30%;"><?php echo $school_data['vtc_name'];?>&nbsp;(<?php echo $school_data['vtc_code']?>)</td>
                            
                            <td style="width:20%;"> Class Name :</td>
                            <td style="width:30%;"><?php if ( $student_data['class_id_fk'] == 4){?>VIII+ STC <?php }else{?> HS-Voc <?php } ?></td>
							
                            
                        </tr>
                        <tr>
                            <td style="width:20%;"> Group/ Trade Name (Group/Trade code) </td>
                            <td style="width:30%;"><?php echo $student_data['group_name'];?>&nbsp;(<?php echo $student_data['group_code']?>)</td>
							
                        </tr>
						<!-- <tr>
							<td style="width:20%;"> Applied For </td>
                            <td style="width:30%;"><?php echo $app_data['name_for_std_reg'];?></td>
							
							<td style="width:20%;"> Year of Admission </td>
                            <td style="width:30%;"><?php echo $app_data['registration_year'];?></td>
						</tr> -->
                       
                    </tbody>
                </table>
                <br/>

                <h4><b>Personal Details</b></h4>
                
                <table class="table table-hover">
                    <tbody>

                          <tr>
                            <td style="width:20%;">Father Name</td>
                            <td style="width:30%;"><?php echo $student_data['father_name'] ?></td>
                            <td style="width:20%;">Mother Name</td>
                            <td style="width:30%;"><?php echo $student_data['mothers_name'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Guardian Name</td>
                            <td style="width:30%;"><?php echo $student_data['guardian_name'] ?></td>
                            <td style="width:20%;">Relationship with Guardian</td>
                            <td style="width:30%;"><?php echo $student_data['relationship_name'] ?></td>
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
                            <td style="width:30%"><?php echo $student_data['mobile'] ?></td>
                            
                        </tr>
                        <tr>
                            <td style="width:20%;">Email ID.</td>
                            <td style="width:30%;"><?php echo $student_data['email'] ?></td>
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
                            <td style="width:20%;">Address Line 1</td>
                            <td style="width:30%;"><?php echo $student_data['address'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Address Line 2</td>
                            <td style="width:30%;"><?php echo $student_data['address_2'] ?></td>
                            <td style="width:20%;">Address Line 3</td>
                            <td style="width:30%;"><?php echo $student_data['address_3'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">State</td>
                            <td style="width:30%;"><?php echo $student_data['state_name'] ?></td>
                            <td style="width:20%;">District</td>
                            <td style="width:30%;"><?php echo $student_data['district_name'] ?></td>
                        </tr>
                        <tr>

                         <td style="width:20%;">Sub Division</td>
                            <td style="width:30%;"><?php echo $student_data['subdiv_name'] ?></td>
                            <td style="width:20%;">Block / Municipality</td>
                            <td style="width:30%;"><?php echo $student_data['block_municipality_name'] ?></td>
                           
                        </tr>

                        <tr>
                            <td style="width:20%;">Pincode.</td>
                            <td style="width:30%;"><?php echo $student_data['pin'] ?></td>
                            <td colspan="2"></td>

                        </tr>
                    </tbody>
                </table>
				
				  <br>
                <h4><b>Particulars of the last Qualifying Examination</b></h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td style="width:20%;">Last Academic exam passed</td>
                            <td style="width:30%;"><?php echo $student_data['exam_name'] ?></td>
                        </tr>
                        <tr>
                            <td style="width:20%;">Have you ever registered under WBSCT&VE&SD for VIII+ STC? (yes/no)</td>
                            <td style="width:30%;"><?php if ( $student_data['council_register'] == 0){?>NO <?php }else{?> Yes <?php } ?></td>
                            
                        </tr>
                        <?php if($student_data['council_register'] == 1){?>
                        <tr>
                            <td style="width:20%;">Registration No</td>
                            <td style="width:30%;"><?php echo $student_data['old_reg_no'] ?></td>
                            <td style="width:20%;">Year of registration</td>
                            <td style="width:30%;"><?php echo $student_data['old_reg_year'] ?></td>
                        </tr>
                       
						<?php }?>

                        
                    </tbody>
                </table><br><br>

                <table align="right">
                    <tr>
                        <td align="center" style="font-size: 12px; width: 40%;" rowspan="3">
                            
                            <hr width="80%" style="margin-top: 2px;">
                            <strong>Student Signature</strong><br>
                            
                        </td>
                    </tr>
                </table>

                
                
    
            </div>
            <div class="box-footer">
               
               <button type="button" class="btn btn-primary print">Print</button>
               
            </div>
        </div>
    </section>
        
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>