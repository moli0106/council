<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
 <?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?> 
 <style type="text/css">
  .border {
    border: 2px solid black;
    border-style: dotted;
    margin: auto;
    padding: 20px;
    background-color: white;
    border-radius: 6px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  .shadow {
/*    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
    border: 3px solid black;
    padding: 10px;
    border-radius: 10px;
  }

  .ckborder {
    border-radius: 0px 30px 30px 0px;
  }
</style>
<div class="content-wrapper">
  <div class="border" style="margin-top:10px;">
    <center>
      <h4 style="color:#246d8a;font-weight:bold;">Application Form for Affiliation or Renewal<br>
      <?php echo $affiliation_data['affiliation_type']; ?> (Academic Session 2023-2024)</h4>
   </center>
   <hr>
   <?php $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/common_view')?>

    <div style="text-align:center;color:black;">
      <h3><b>Your application is ready to submit. Please check the application carefully before final submission</b></h3>
      <h4>Your Application Form No is: <font color="red"><strong><?php echo $affiliation_data['application_number']; ?></strong></font></h4>
      <h5>(Note down the Application Form No for future reference)</h5>
    </div>

     <!-- Start Institute Details-->

    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Institute's Basic Details </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>Name of the Institute *</label>
              <input type="text" name="" value="<?php echo $ins_details['institute_name'];?>" placeholder="Enter Institute's Name" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label>Institute Email Id *</label>
              <input type="email" name="" value="<?php echo $ins_details['institute_email'];?>" placeholder="Enter Institute's Email" class="form-control" readonly>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>Institute's Primary Contact Number *</label>
              <input type="number" name="" value="<?php echo $affiliation_data['mobile_no_1'];?>" placeholder="Contact Number (Primary)" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label>Institute Secondary Contact Number </label>
              <input type="number" name="" value="<?php echo $affiliation_data['mobile_no_2'];?>" placeholder="Contact Number (Secondary)" class="form-control" readonly>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>Institute Fax Number </label>
              <input type="text" name="" value="<?php echo $affiliation_data['fax_no'];?>" placeholder="Fax Number" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label>Institute Website </label>
              <input type="url" name="" value="<?php echo $affiliation_data['web_url'];?>" placeholder="Website (Full URL)" class="form-control" readonly>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-12">
              <label>Institute Type *</label>
              <input type="radio" name="type" value="1" <?php if ($affiliation_data['institute_category_id_fk'] == 1) echo 'checked'; ?>>Government(West Bengal) &nbsp 
              <input type="radio" name="type" value="5" <?php if ($affiliation_data['institute_category_id_fk'] == 5) echo 'checked'; ?>>Government(Central) &nbsp 
              <input type="radio" name="type" value="2" <?php if ($affiliation_data['institute_category_id_fk'] == 2) echo 'checked'; ?>>Government Sponsored (West Bengal) &nbsp 
              <input type="radio" name="type" value="4" <?php if ($affiliation_data['institute_category_id_fk'] == 4) echo 'checked'; ?>>Self Financed
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Close Institute Details-->


     <!--Address Part-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Complete Postal Address and other Information </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <div class="row" style="margin-top:10px">
            <div class="col-md-12">
              <label>Institute Address *</label>
              <textarea class="form-control" placeholder="Enter Institute Address" readonly><?php echo $affiliation_data['address'];?></textarea>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>State *</label>
               <select name="state" id="state" class="form-control" readonly disabled="true">
                <option value="" hidden="true">--Select State--</option>
                <option selected><?php echo $affiliation_data['state_name'];?></option>
<!--                 <?php foreach ($stateList as $key => $value) { ?>
                <option value="<?php echo $value['state_id_pk']; ?>" <?php if($affiliation_data['state_id_fk'] ==$value['state_id_pk'] ){echo 'selected';} ?>>
                <?php echo $value['state_name']; ?>
                </option>
                <?php } ?> -->
                </select> 
              <?php echo form_error('state'); ?>
            </div>
            <div class="col-md-6">
              <label>District * </label>
              <select name="district" id="district" class="form-control"  disabled="true">
                <option selected><?php echo $affiliation_data['district_name'];?></option>

               <!--  <?php if($this->input->method(TRUE) == "POST"){ ?>

                <?php foreach ($district as $value) {?>
                <option value="<?php echo $value['district_id_pk']?>" <?php if($affiliation_data['district_id_fk'] ==$value['district_id_pk'] ){echo 'selected';} ?>>
                <?php echo $value['district_name'];?> </option>
                <?php }?> 
                <?php  }else{?>
                <option value="" hidden="true">Select District</option>
                <?php }  ?>
                 -->
                </select>
              <?php echo form_error('district'); ?>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>Sub Division * </label>
             <select name="subDivision" id="subDivision" class="form-control" readonly disabled="true">
                <option selected><?php echo $affiliation_data['subdiv_name'];?></option>

              <!-- <?php if($this->input->method(TRUE) == "POST"){ ?>

               <?php foreach ($subDivision as $value) {?>
                <option value="<?php echo $value['subdiv_id_pk']?>" <?php if($affiliation_data['sub_divission_id_fk'] ==$value['subdiv_id_pk'] ){echo 'selected';} ?>>
                <?php echo $value['subdiv_name'];?> </option>
                <?php }?> 
                <?php } else{?>
                <option value="" hidden="true">Select Sub Division</option>
                <option value="" disabled="true">Select District first...</option>
                <?php }?> -->
                                                    
                </select>
                <?php echo form_error('subDivision'); ?>
            </div>
            <div class="col-md-6">
              <label>PIN Code * </label>
              <input type="number" name="" value="<?php echo $affiliation_data['pin_code'];?>" placeholder="Pincode" class="form-control" readonly>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>Nearest Railway Station * </label>
              <input type="text" name="" value="<?php echo $affiliation_data['near_rail_station'];?>" placeholder="Nearest Railway Station" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label>Distance of Nearest Railway Station * </label>
              <input type="text" name="" value="<?php echo $affiliation_data['distance_rail_station'];?>" placeholder="Nearest Railway Station" class="form-control" readonly>
            </div>
          </div>
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>Nearest Police Station * </label>
              <input type="text" name="" value="<?php echo $affiliation_data['police_station'];?>" placeholder="Nearest Police Station" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label>Phone Number of Police Station * </label>
              <input type="number" name="" value="<?php echo $affiliation_data['ps_phone_no'];?>" placeholder="Phone Number of Police Station" class="form-control" readonly>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <!-- Close Address Part-->

     <!--Priciple in Charge Part-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Principal's / Officer in Charge's Details </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <div class="row" style="margin-top:10px">
            <div class="col-md-6">
              <label>Name of the Principal / Officer in Charge *</label>
              <input type="text" name="" value="<?php echo $affiliation_data['principal_name'];?>" placeholder="Principal / Officer in Charge" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label>Principal's Personal Mobile Number * </label>
              <input type="number" name="" value="<?php echo $affiliation_data['principal_mobile_no'];?>" placeholder="Personal Mobile Number" class="form-control" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Close Priciple in Charge Part-->

    <!-- Start Academic Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Ongoing Academic Programme </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL No.</th>
              <th>Branch / Department</th>
              <th>Approved Intake</th>
              <th>No of Regular Faculties</th>
              <th>Remarks</th>
            </tr>

            <?php if(!empty($intake_data)) {?>
              <?php $c=1; foreach($intake_data as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['intake_no'] ?></td>
              <td><?php echo $row['faculty'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
            </tr>
            <?php }}else{ ?>

              <?php } ?>
            
          </table>
        </div>
      </div>
    </div>

    <!-- End Academic Programme-->


    <!-- Start Academic Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Teaching Staff Data </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL No.</th>
              <th>Branch / Department</th>
              <th>Name of Teachers</th>
              <th>Mobile No</th>
            </tr>
            <?php if(!empty($teacher_data)) {?>
              <?php $c=1; foreach($teacher_data as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['teacher_name'] ?></td>
              <td><?php echo $row['teacher_mobile'] ?></td>
            </tr>
            <?php }}else{ ?>

              <?php } ?>
            
          </table>
          </div>

        </div>
      </div>

    <!-- End Academic Programme-->

     <!-- Start Available Class Rooms Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Available Class Rooms </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL No.</th>
              <th>Branch / Department</th>
              <th>No of Rooms</th>
              <th>Seating Capacity</th>
              <th>Size</th>
              <th>Remarks</th>
            </tr>
            <?php $c=1; foreach($fetch_room as $row) {?>
              <tr>
                <td><?php echo $c++; ?></td>
                <td><?php echo $row['discipline_name'] ?></td>
                <td><?php echo $row['total_rooms'] ?></td>
                <td><?php echo $row['seat'] ?></td>
                <td><?php echo $row['size'] ?></td>
                <td><?php echo $row['remarks'] ?></td>
              </tr>
            <?php } ?>
            
          </table>
          </div>

        </div>
      </div>

    <!-- End Available Class Rooms Programme-->
    
    <!-- Start Available Laboratories Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Available Laboratories </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL No.</th>
              <th>Branch / Department</th>
              <th>Laboratories Available</th>
              <th>No. of experimental Set-up</th>
              <th>Remarks</th>
            </tr>
            <?php $c=1; foreach($fetch_lab as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['available_lab'] ?></td>
              <td><?php echo $row['exp_setup'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
            </tr>
          <?php } ?>
            
          </table>
          </div>

        </div>
      </div>

    <!-- End Available Class Rooms Programme-->


 <!-- Start Library Details Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Library Details </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL No.</th>
              <th>Branch / Department</th>
              <th>Books available</th>
              <th>Books issued per student</th>
              <th>Remarks</th>
            </tr>
            <?php $c=1; foreach($fetch_library as $row) {?>
              <tr>
                <td><?php echo $c++; ?></td>
                <td><?php echo $row['discipline_name'] ?></td>
                <td><?php echo $row['books_available'] ?></td>
                <td><?php echo $row['books_issue'] ?></td>
                <td><?php echo $row['remarks'] ?></td>
              </tr>
            <?php } ?>
            
          </table>
          </div>

        </div>
      </div>

    <!-- End Available Class Rooms Programme-->


    <!-- Start Mandatory Requirements Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Mandatory Requirements </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr class="bg-primary">
              <th>Sl. No.</th>
              <th>Facilities</th>
              <th>Availability (Yes/No)</th>
              <th>Size/Number (as applicable)</th>
            </tr>
            <tbody>
              <?php $c=1; foreach($fetch_mandory_data as $row){ ?>
                <tr>
                  <td><?php echo $c++; ?></td>
                  <td><?php echo $row['facilities_name']; ?> <input type="hidden" name="mand_req[]" value="<?php echo $row['fc_id_fk']; ?>">
                  </td>
                  <td>
                    <select name="req_status[]" class="form-control required" required>
                      <option value="<?php echo $row['availability']; ?>"><?php echo $row['availability']; ?></option>
                      <option value="">-Select-</option>
                      <option value="YES">YES</option>
                      <option value="NO">NO</option>
                    </select>
                  </td>
                  <td>
                    <input type="text" name="req_details[]" class="form-control" value="<?php echo $row['size']; ?>" placeholder="Size/Number/Details" maxlength="60">
                  </td>
                </tr>
              <?php } ?>    
                                         
            </tbody>
            
          </table>

           <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Additional Information</td>
                            <td><?php echo $affiliation_data['additional_info'];?></td>
                        </tr>               
                    </tbody>
                </table>
          </div>

        </div>
      </div>

    <!-- End Mandatory Requirements Programme-->

    <div class="shadow" style="margin-top:10px">
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
    <hr>

    <!-- Start Fees structure -->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Fees need to deposit to WBSCT&VE&SD </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <?php if($affiliation_data['institute_category_id_fk'] == 4) {?>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Items</th>
                      <th>Fees (In Rupees)</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td>Application Fee (Non - Refundable)</td>
                      <td><?php echo $payment['application_fees'];?></td>
                  </tr>
                  <tr>
                    <td>Inspection Fee (Non-Refundable)</td>
                    <td><?php echo $payment['inspection_fees'];?></td>
                  </tr>
                  
                  <!-- <tr>
                    <?php if($payment['new_or_renewal'] == 1){ ?>
                      <td>Affiliation Fees</td>
                    <?php }else{?>
                      <td>Renewal of Affiliation</td>
                    <?php }?>
                      <td><?php echo $payment['affiliation_fees'];?></td>
                  </tr> -->
                  <?php //if($payment['increse_course_amnt'] != 0) {?>
                  <tr>
                    <td><?php echo $payment['new_or_renewal'] ?> Affiliation Fees</td>
                    <td><?php echo $payment['affiliation_fees'];?></td>
                  </tr>
                  <!-- <tr>
                    <?php if($payment['new_or_renewal'] == 1){ ?>
                      <td>Affiliation Fees</td>
                    <?php }else{?>
                      <td>Renewal of Affiliation</td>
                    <?php }?>
                      <td><?php echo $payment['affiliation_fees'];?></td>
                  </tr> -->
                  <?php if($payment['increse_course_amnt'] != 0) {?>
                    <tr>
                      <td><?php echo $payment['new_or_renewal'] ?> Affiliation Fee  (for Additional Course)</td>
                      <td><?php echo $payment['increse_course_amnt'] ?></td>
                    </tr>
                  <?php }?>
                    
                  <?php if($payment['increase_intake_amount'] != 0) {?>
                    <tr>
                      <td><?php echo $payment['new_or_renewal'] ?> Affiliation Fee for Additional Intake (<?php echo $payment['description'] ?>)</td>
                      <td><?php echo $payment['increase_intake_amount'] ?></td>
                    </tr>
                  <?php }?>
                  
                      
                    <tr>
                      <th>Total Fees need to pay</th>
                      <th><?php echo $payment['total_fees']; ?></th>
                  </tr>
                  
              </tbody>
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

    <!-- End Fees structure -->
    <?php if(($affiliation_data['intake_submited_status'] ==1) && ($affiliation_data['basic_details_submited_status'] ==1) && ($affiliation_data['infrastructure_fees_submited_status'] ==1) && ($affiliation_data['doc_uploaded_status'] ==1)){?>
    <div style="font-weight: bold;">
     <h3><b>Check the form thoroughly. Form once submitted, cannot be edited.</b></h3>
    <p>I hereby declare that the statements made in the application are true, complete and correct to the best of my knowledge and belief. I understood that in the event of any information being found false or incorrect at any stage or not satisfying the eligibility criteria according to the norms of WBSCT&amp;VE&amp;SD, my application is liable to be cancelled.</p>
    <b>I agree : </b> <input type="Checkbox" id="tnc" required>
    
    </div>
    
    <?php if($affiliation_data['institute_category_id_fk'] == 4){?>
      <div class="row">                
        <div class="col-md-2 col-md-offset-1">
          <!-- <img src="https://affiliation.webscte.co.in/assets/captcha/1688632366.5547.jpg"/> -->
        </div>
        <div class="col-md-2">
          <!-- <input type="text" name="captcha_text" class="form-control to-uppercase" required> -->
        </div>
        <?php if($payment_status['response_status'] !=1 ) {?>
          <?php echo form_open_multipart("admin/sbiepay/proceed_to_pay"); ?>
            <input type="hidden" value="<?php echo $affiliation_data['basic_affiliation_id_pk']; ?>" name="basic_affiliation_id">
            
            <input type="hidden" value="9" name="payment_type">
            <div class="col-md-5 pay_btn" style="display:none">
              <button type="submit" class="btn btn-primary btn-block">Submit Application & Pay Fess</button>
              
            </div>
          <?php echo form_close() ?>
          <div class="col-md-2 edit_btn">
            <a href="#" class="btn btn-danger btn-block">Edit Application</a>
          </div> 
        <?php }?>                   
      </div>
    <?php }else{?>
      <div class="row">                
        <div class="col-md-2 col-md-offset-1">
          <!-- <img src="https://affiliation.webscte.co.in/assets/captcha/1688632366.5547.jpg"/> -->
        </div>
        <div class="col-md-2">
          <!-- <input type="text" name="captcha_text" class="form-control to-uppercase" required> -->
        </div>
        
          <?php echo form_open_multipart("admin/polytechnic_affiliation/affiliation/final_submit"); ?>
            <input type="hidden" value="1" name="final_submit">
            <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
            
            <div class="col-md-5 pay_btn" style="display:none">
              <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
              
            </div>
          <?php echo form_close() ?>
          <div class="col-md-2 edit_btn">
            <a href="#" class="btn btn-danger btn-block">Edit Application</a>
          </div>                   
      </div>
  <?php } }else{?>
    <div style="font-weight: bold;">
     <h3 class="danger"><b>Please complete your all steps.</b></h3>
    
    
    </div>
    <?php }?>



  </div>
</div>

    <?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>