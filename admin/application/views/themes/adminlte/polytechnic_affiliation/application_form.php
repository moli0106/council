<html>
<style>
    .ins_name {
        font-size: 14.5px;
    }

    #table tr td {
        border-radius: 10px !important;
    }


    .my-section {
        margin-top: 6px;
        border: 2px solid;
        border-radius: 10px;
        height: 40px;
    }

    .my-section-2 {
        margin-top: 6px;
        border: 2px solid;
        border-radius: 10px;
    }

    * {
        box-sizing: border-box;
    }

    .row {
        margin-left: -5px;
        margin-right: -5px;
    }

    .column {
        float: left;
        width: 50%;
        padding: 5px;
    }


    .row::after {
        content: "";
        clear: both;
        display: table;
    }

    #table2 tr {
        margin: 15px;
    }

    th {
        text-align: left;
    }

    #background {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        left: 140px;
        top: 150px;
    }
    .font_size{
        font-size: 11.6px;
    }
</style>

<body>

     <div width="100%" style="border: 3px solid;border-radius:20px!important;margin-top:2px;">
        <table cellspacing="0">
       <tr>
        <td style="padding:10px;">
        <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/' . 'admin/themes/adminlte/assets/image/certificate/logo.png'; ?>" alt="" width="10%" height="10%" class="logo">
        </td>
        <td style="font-family:Arial; font-size:15px;line-height:0px;">
        <b>WEST BENGAL STATE COUNCIL OF TECHNICAL AND VOCATIONAL EDUCATION  SKILL DEVELOPMENT</b>
        <p style="font-family:arial; font-size:11px;margin-top:15px!important;">[A Statutory Body under Government of West Bengal Act XXVI of 2013]<br/>
       
        <p style="font-size:9px;margin-top:15px!important;">"Karigori Bhavan", 5th Floor, Plot No. B/7, Action Area-III, New Town, Rajarhat, Kolkata-700160</p>
      </td>
       </tr>
   </table>
    </div>

    <div class="my-section">
        <div class="admin-title" style="text-align: center;">
            <div style="margin-top: 4px;font-size:11.5px;">
                <strong>Application Form for Affiliation or Renewal
            </div>

        </div>
        <div style="text-align:center ;margin-top: -10px; margin-bottom: -5px;">
            <p style="font-size:12.5px;"> <b><?php echo $affiliation_data['affiliation_type']; ?> (Academic Session <?php echo $affiliation_year;?>)</b></p>
        </div>
    </div>

    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Besic Details of Institute</b></font></center>
                <table id="table23" border="0">
                    <tr>
                        <td width="25%" class="font_size">Application Form No</td>
                        <th class="font_size" colspan="3">:
                           <?php echo $affiliation_data['application_number']; ?>
                        </th>
                    </tr>
                    <tr>
                        <td width="25%" class="font_size">Name of the Institute</td>
                        <th class="font_size" colspan="3">:
                          <?php echo $ins_details['institute_name'];?>
                        </th>
                    </tr>
                    <tr>
                        <td width="25%" class="font_size">Contact Number</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['mobile_no_1'];?>
                        </th>
                        <td width="20%" class="font_size">Email ID </td>
                        <th class="font_size">:
                          <?php echo $ins_details['institute_email'];?>
                        </th>
                    </tr>

                    <tr>
                        <td width="25%" class="font_size">Secondary Contact Number</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['mobile_no_2'];?>
                        </th>
                        <td width="20%" class="font_size">Fax Number</td>
                        <th class="font_size">:
                        
                        </th>
                    </tr>

                    <tr>
                        <td width="25%" class="font_size">Institute's Website</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['web_url'];?>
                        </th>
                        <td width="20%" class="font_size">Institute Type</td>
                        <th class="font_size">:
                        <?php if ($affiliation_data['institute_category_id_fk'] == 1){
                            ?>
                          Government(West Bengal)
                         <?php } elseif ($affiliation_data['institute_category_id_fk'] == 2){  
                            ?>
                            Government Sponsored (West Bengal)
                          <?php } elseif ($affiliation_data['institute_category_id_fk'] == 4){ 
                          ?>
                          Self Financed
                          <?php } elseif ($affiliation_data['institute_category_id_fk'] == 5){ 
                          ?>
                          Government(Central)
                          <?php } ?>
                        </th>
                    </tr>

                    <!-- <tr>
                        <td width="55%" class="font_size" colspan="1">Name of the Organisation/Trust/Society</td>
                        <th class="font_size" colspan="3">:
                          GOPSAI AVINANDAN SANGHA
                        </th>
                    </tr>

                    <tr>
                        <td width="25%" class="font_size">Address of the Organisation/Trust/Society</td>
                        <th class="font_size" colspan="3">:
                         <?php echo $affiliation_data['address'];?>
                        </th>
                    </tr> -->
                    
                    
                </table>
            </div>

        </div>
    </div>


     <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Complete Postal Address and other information</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <td width="25%" class="font_size">Address</td>
                        <th class="font_size" colspan="3">:
                           <?php echo $affiliation_data['address'];?>
                        </th>
                    </tr>
                    <tr>
                        <td width="25%" class="font_size">Sub-Division</td>
                        <th class="font_size">:
                        <?php echo $affiliation_data['subdiv_name'];?>
                        </th>
                        <td width="20%" class="font_size">District </td>
                        <th class="font_size">:
                         <?php echo $affiliation_data['district_name'];?>
                        </th>
                    </tr>

                    <tr>
                        <td width="25%" class="font_size">State</td>
                        <th class="font_size">:
                          WEST BENGAL
                        </th>
                        <td width="20%" class="font_size">PIN Code</td>
                        <th class="font_size">:
                        <?php echo $affiliation_data['pin_code'];?>
                        </th>
                    </tr>

                    <tr>
                        <td width="25%" class="font_size">Nearest Railway Station</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['near_rail_station'];?>
                        </th>
                        <td width="20%" class="font_size">Distance of Nearest Railway Station</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['distance_rail_station'];?>
                        </th>
                    </tr>

                     <tr>
                        <td width="25%" class="font_size">Nearest Police Station</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['police_station'];?> 
                        </th>
                        <td width="20%" class="font_size">Phone Number of Police Station</td>
                        <th class="font_size">:
                           <?php echo $affiliation_data['ps_phone_no'];?>
                        </th>
                    </tr>
                    
                    
                </table>
            </div>

        </div>
    </div>


    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Principal’s / Officer in Charge's Details</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <td width="25%" class="font_size">Name of the Principal/OIC</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['principal_name'];?>
                        </th>
                        <td width="20%" class="font_size">Mobile Number </td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['principal_mobile_no'];?>
                        </th>
                    </tr>

                    <tr>
                        <td width="25%" class="font_size">Academic Qualification</td>
                        <th class="font_size">:
                         <?php echo $affiliation_data['principal_qualification'];?>
                        </th>
                        <td width="20%" class="font_size">Age</td>
                        <th class="font_size">:
                        <?php echo $affiliation_data['principal_age'];?>
                        </th>
                    </tr>

                    <tr>
                        <td width="25%" class="font_size">Years of Experience</td>
                        <th class="font_size">:
                          <?php echo $affiliation_data['year_of_exp'];?>
                        </th>
                        <td width="20%" class="font_size">Appointed on</td>
                        <th class="font_size">:
                        <?php echo $affiliation_data['principal_join_date'];?>
                        </th>
                    </tr>                    
                    
                </table>
            </div>

        </div>
    </div>

     <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Approved intake Details as per AICTE in 2023-2024</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <th width="30%" class="font_size">Branch / Department</th>
                        <th width="20%" class="font_size">Approved Intake </th>
                        <th width="20%" class="font_size">No of Faculties </th>
                        <th width="15%" class="font_size">Remarks</th>
                    </tr>   
                    <?php if(!empty($intake_data)) {?>
                      <?php foreach($intake_data as $row) {?>
                    <tr>
                      <td class="font_size"><?php echo $row['discipline_name'] ?></td>
                      
                      <td class="font_size"><?php echo $row['intake_no'] ?></td>
                      <td class="font_size"><?php echo $row['faculty'] ?></td>
                      <td class="font_size"><?php echo $row['remarks'] ?></td>
                    </tr>
                    <?php }}else{ ?>

                      <?php } ?>                     
                    
                </table>
            </div>

        </div>
    </div>

     <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Faculty Details</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <th width="15%" class="font_size">Branch / Department</th>
                        <th width="20%" class="font_size">Name of Teachers  </th>
                        <th width="10%" class="font_size">Highest Qualification </th>
                        <th class="font_size">Faculty Type </th>
                        <th class="font_size">Years of Experience</th>
                        <th class="font_size">Date of Joining</th>
                        <th class="font_size">Mobile No</th>
                        <th width="10%" class="font_size">Monthly Salary(Rs.)</th>
                    </tr>   
                    <?php if(!empty($teacher_data)) {?>
                  <?php foreach($teacher_data as $row) {?>
                    <tr class="font_size">
                      <td><?php echo $row['discipline_name'] ?></td>
                      <td><?php echo $row['teacher_name'] ?></td>
                      <td><?php echo $row['qualification'] ?></td>
                      <td><?php echo $row['engagement_type'] ?></td>
                      <td><?php echo $row['year_exp'] ?></td>
                      <td><?php echo $row['join_date'] ?></td>
                      <td><?php echo $row['teacher_mobile'] ?></td>
                      <td><?php echo $row['salary'] ?></td>
                    </tr>
                    <?php }}else{ ?>

                      <?php } ?>               
                    
                </table>
            </div>

        </div>
    </div>


    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Available Class Rooms</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <th width="30%" class="font_size">Branch / Department</th>
                        <th width="20%" class="font_size">No of Rooms </th>
                        <th width="20%" class="font_size">Seating Capacity </th>
                        <th width="20%" class="font_size">Size </th>
                        <th width="10%" class="font_size">Remarks</th>
                    </tr>   
                    <?php foreach($fetch_room as $row) {?>
                      <tr class="font_size">
                        <td class="font_size"><?php echo $row['discipline_name'] ?></td>
                        <td class="font_size"><?php echo $row['total_rooms'] ?></td>
                        <td class="font_size"><?php echo $row['seat'] ?></td>
                        <td class="font_size"><?php echo $row['size'] ?></td>
                        <td class="font_size"><?php echo $row['remarks'] ?></td>
                      </tr>
                    <?php } ?>                      
                    
                </table>
            </div>

        </div>
    </div>

    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Available Laboratories</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <th width="30%" class="font_size">Branch / Department</th>
                        <th width="20%" class="font_size">Laboratories Available </th>
                        <th width="25%" class="font_size">No. of experimental Set-up </th>
                        <th width="20%" class="font_size">Remarks </th>
                    </tr>   
                    <?php foreach($fetch_lab as $row) {?>
                    <tr>
                      <td class="font_size"><?php echo $row['discipline_name'] ?></td>
                      <td class="font_size"><?php echo $row['available_lab'] ?></td>
                      <td class="font_size"><?php echo $row['exp_setup'] ?></td>
                      <td class="font_size"><?php echo $row['remarks'] ?></td>
                    </tr>
                  <?php } ?>                      
                    
                </table>
            </div>

        </div>
    </div>


    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Library Details</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <th width="30%" class="font_size">Branch / Department</th>
                        <th width="20%" class="font_size">Books available </th>
                        <th width="25%" class="font_size">Books issued per student </th>
                        <th width="20%" class="font_size">Remarks </th>
                    </tr>   
                    <?php foreach($fetch_library as $row) {?>
                      <tr>
                        <td class="font_size"><?php echo $row['discipline_name'] ?></td>
                        <td class="font_size"><?php echo $row['books_available'] ?></td>
                        <td class="font_size"><?php echo $row['books_issue'] ?></td>
                        <td class="font_size"><?php echo $row['remarks'] ?></td>
                      </tr>
                    <?php } ?>                      
                    
                </table>
            </div>

        </div>
    </div>

    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Requirements</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                    <tr>
                        <th width="10%" class="font_size">Sl. No.</th>
                        <th width="25%" class="font_size">Facilities </th>
                        <th width="10%" class="font_size">Availability </th>
                        <th width="20%" class="font_size">Details (as applicable) </th>
                    </tr>   
                    <?php $c=1; foreach($fetch_mandory_data as $row){ ?>
                    <tr>
                        <td class="font_size"><?php echo $c++; ?></td>
                        <td class="font_size"><?php echo $row['facilities_name']; ?> </td>
                        <td class="font_size"><?php echo $row['availability']; ?></td>
                        <td class="font_size"><?php echo $row['size']; ?></td>
                    </tr> 
                    <?php } ?>                  
                    
                </table>
            </div>

        </div>
    </div>


    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Fees received per Individual Student</b></font></center>
                <table id="table23" border="0" style="margin-top:5px">
                <tr>
                <th width="10%" class="font_size">#</th>
                <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <th width="10%" class="font_size">Management Quota *</th>
                <th width="10%" class="font_size">JEXPO *</th>
                <th width="10%" class="font_size">VOCLET *</th>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>
                <th width="10%" class="font_size">Management Quota *</th>
                <th width="10%" class="font_size">Entrance Exam Quota *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?>
                <th width="10%" class="font_size">First Year *</th>
                <th width="10%" class="font_size">Second Year *</th>
                <th width="10%" class="font_size">Third Year *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <th width="10%" class="font_size">Semester-1 *</th>
                <th width="10%" class="font_size">Semester-2 *</th>
                <th width="10%" class="font_size">Semester-3 *</th>
                <th width="10%" class="font_size">Semester-4 *</th>
                <th width="10%" class="font_size">Semester-5 *</th>
                <th width="10%" class="font_size">Semester-6 *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <th width="10%" class="font_size">Sem–1 / 1st Year *</th>
                <th width="10%" class="font_size">Sem–2 / 2nd Year *</th>
                <th width="10%" class="font_size">Sem–3 / 3rd Year *</th>
                <th width="10%" class="font_size">Sem–4 / 4th Year *</th>
                <th width="10%" class="font_size">Semester-5 </th>
                <th width="10%" class="font_size">Semester-6 </th>
               <?php } ?>
              </tr>    
                <?php foreach($fetch_fees_data as $row){ ?>
               <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <tr>
                <td class="font_size"><?php echo $row['semester'] ?></td>
                <td class="font_size"><?php echo $row['m_sem'] ?></td>
                <td class="font_size"><?php echo $row['j_sem'] ?></td>
                <td class="font_size"><?php echo $row['v_sem'] ?></td>
               </tr>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>

                <tr>
                <td class="font_size"><?php echo $row['semester'] ?></td>
                <td class="font_size"><?php echo $row['part_1'] ?></td>
                <td class="font_size"><?php echo $row['part_2'] ?></td>
               </tr>
              <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <tr>
                <td class="font_size"><?php echo $row['semester'] ?></td>
                <td class="font_size"><?php echo $row['dvoc_s1'] ?></td>
                <td class="font_size"><?php echo $row['dvoc_s2'] ?></td>
                <td class="font_size"><?php echo $row['dvoc_s3'] ?></td>
                <td class="font_size"><?php echo $row['dvoc_s4'] ?></td>
                <td class="font_size"><?php echo $row['dvoc_s5'] ?></td>
                <td class="font_size"><?php echo $row['dvoc_s6'] ?></td>
               </tr>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?> 

               <tr>
                <td class="font_size"><?php echo $row['semester'] ?></td>
                <td class="font_size"><?php echo $row['1_year'] ?></td>
                <td class="font_size"><?php echo $row['2_year'] ?></td>
                <td class="font_size"><?php echo $row['3_year'] ?></td>
               </tr>
             <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <tr>
                <td class="font_size"><?php echo $row['semester'] ?></td>
                <td class="font_size"><?php echo $row['dip_s1'] ?></td>
                <td class="font_size"><?php echo $row['dip_s2'] ?></td>
                <td class="font_size"><?php echo $row['dip_s3'] ?></td>
                <td class="font_size"><?php echo $row['dip_s4'] ?></td>
                <td class="font_size"><?php echo $row['dip_s5'] ?></td>
                <td class="font_size"><?php echo $row['dip_s6'] ?></td>
               </tr>
               <?php } ?>     
               <?php } ?>                 
                    
                </table>
            </div>

        </div>
    </div>

    <div class="my-section-2">
        <div class="row">
            <div class="columns" style="margin-left: 10px;">
                <center><font><b>Affiliation Fees Payment Details</b></font></center>
                <?php if($affiliation_data['institute_category_id_fk'] == 4) {?>
                    <table id="table23" border="0" style="margin-top:5px" width="100%">
                        <tr>
                            <td class="font_size">Application Fee (Non - Refundable):</td>
                            <th class="font_size" ><?php echo $payment['application_fees'];?></th>
                        </tr>
                        <tr>
                            <td class="font_size">Inspection Fee (Non-Refundable):</td>
                            <th class="font_size"><?php echo $payment['inspection_fees'];?></th>
                        </tr>
                        <?php if($payment['increse_course_amnt'] != 0) {?>
                            <tr>
                                <td class="font_size"><?php echo $payment['new_or_renewal'] ?> Affiliation Fee  (for Additional Course):</td>
                                <th class="font_size"><?php echo $payment['increse_course_amnt'] ?></th>
                            </tr>
                        <?php }?>

                        <?php if($payment['increase_intake_amount'] != 0) {?>
                            <tr>
                                <td><?php echo $payment['new_or_renewal'] ?> Affiliation Fee for Additional Intake ()</td>
                                <td><?php echo $payment['increase_intake_amount'] ?></td>
                            </tr>
                        <?php }?>
                        <tr>
                            <td class="font_size">Total Fees:</td>
                            <th class="font_size"><?php echo $payment['total_fees']; ?></th>
                        </tr>
                        <tr>
                            <td class="font_size">Payment Status:</td>
                            <th class="font_size">Successful</th>
                        </tr>
                        <tr>
                            <td class="font_size">Transaction ID:</td>
                            <th class="font_size"><?php echo $payment_status['transaction_id']; ?></th>
                        </tr>
                        <tr>
                            <td class="font_size">Transaction Date & Time:</td>
                            <th class="font_size"><?php echo $payment_status['sending_time']; ?></th>
                        </tr>  
                        <tr>
                            <td class="font_size">Transaction Amount:</td>
                            <th class="font_size"><?php echo $payment_status['posting_amount']; ?></th>
                        </tr>                       
                        <!-- <tr>
                            <td class="font_size">Payment Mode:</td>
                            <th class="font_size">NET_BANKING</th>
                        </tr>                        -->
                        
                    </table>
                <?php }else{?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Total Amount Need to be Paid :</th>
                                <th colspan="5">0 [As it is <?php echo $affiliation_data['category_name']; ?> Institute]</th>
                            </tr>
                        </thead>
                    </table>
                <?php }?>
            </div>

        </div>
    </div>

</body>

</html>