<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
 <?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?> 
 <style type="text/css">
  input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
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
      <?php echo $affiliation_data['affiliation_type']; ?> (Academic Session <?php echo $affiliation_year;?>)</h4>
   </center>
   <hr>
   <?php $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/common_view')?>

    <?php echo form_open_multipart('admin/' . uri_string(), array('id' => 'basic_details'));  ?>
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
                <input type="number" name="mobile_1" value="<?php echo $formData['mobile_1'];?>" placeholder="Contact Number (Primary)" class="form-control">
                <?php echo form_error('mobile_1'); ?>
              </div>
              <div class="col-md-6">
                <label>Institute Secondary Contact Number </label>
                <input type="number" name="mobile_2" value="<?php echo $formData['mobile_2'];?>" placeholder="Contact Number (Secondary)" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-top:10px">
              <div class="col-md-6">
                <label>Institute Fax Number </label>
                <input type="text" name="fax" value="<?php echo $formData['fax'];?>" placeholder="Fax Number" class="form-control">
              </div>
              <div class="col-md-6">
                <label>Institute Website </label>
                <input type="url" name="web_url" value="<?php echo $formData['web_url'];?>" placeholder="Website (Full URL)" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-top:10px">
              <div class="col-md-12">
                <label>Institute Type *</label>
                <input type="radio" name="ins_type" id="ins_type_1" value="1" <?php if ($formData['ins_type'] == 1) echo 'checked'; ?>>Government(West Bengal) &nbsp 
                <input type="radio" name="ins_type" id="ins_type_5" value="5" <?php if ($formData['ins_type'] == 5) echo 'checked'; ?>>Government(Central) &nbsp 
                <input type="radio" name="ins_type" id="ins_type_2" value="2" <?php if ($formData['ins_type'] == 2) echo 'checked'; ?>>Government Sponsored (West Bengal) &nbsp 
                <input type="radio" name="ins_type" id="ins_type_4" value="4" <?php if ($formData['ins_type'] == 4) echo 'checked'; ?>>Self Financed
                <?php echo form_error('ins_type'); ?>
              </div>
            </div>

            <span class="text-danger eligable_text" style="display: none;">
              <b> *** As Govt. need not to pay fess ***</b>
            </span>
          </div>
        </div>
      </div>
      <!--Address Part-->
      <div class="shadow" style="margin-top:10px">
        <div class="card border-primary">
          <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Complete Postal Address and other Information </div>
          <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
          <div class="card-body">
            <div class="row" style="margin-top:10px">
              <div class="col-md-12">
                <label>Institute Address *</label>
                <textarea class="form-control" name="address" placeholder="Enter Institute Address"><?php echo $formData['address'];?></textarea>
                <?php echo form_error('ins_type'); ?>
              </div>
            </div>
            <div class="row" style="margin-top:10px">
              <div class="col-md-6">
                <label>State *</label>
                <select name="state" id="state" class="form-control">
                  <option value="" hidden="true">--Select State--</option>
                  <?php foreach ($stateList as $key => $value) { ?>
                  <option value="<?php echo $value['state_id_pk']; ?>" <?php if($formData['state_id_fk'] ==$value['state_id_pk'] ){echo 'selected';} ?>>
                  <?php echo $value['state_name']; ?>
                  </option>
                  <?php } ?>
                  </select> 
                <?php echo form_error('state'); ?>
              </div>
              <div class="col-md-6">
                <label>District * </label>
                <select name="district" id="district" class="form-control">


                  <?php if (count($district)) { ?>
                        <?php foreach ($district as $key => $value) { ?>
                            <option value="<?php echo $value['district_id_pk']; ?>" <?php if ($formData['district_id_fk'] == $value['district_id_pk']) echo 'selected'; ?>>
                                <?php echo $value['district_name']; ?>
                            </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="" disabled>No Data Found...</option>
                  <?php } ?>

                  
                  </select>
                <?php echo form_error('district'); ?>
              </div>
            </div>
            <div class="row" style="margin-top:10px">
              <div class="col-md-6">
                <label>Sub Division * </label>
              <select name="subDivision" id="subDivision" class="form-control">

                <?php if (count($subDivision)) { ?>
                    <?php foreach ($subDivision as $key => $value) { ?>
                        <option value="<?php echo $value['subdiv_id_pk']; ?>" <?php if ($formData['sub_division_id_fk'] == $value['subdiv_id_pk']) echo 'selected'; ?>>
                            <?php echo $value['subdiv_name']; ?>
                        </option>
                    <?php } ?>
                <?php } else { ?>
                  <option value="" disabled>No Data Found...</option>
                <?php } ?>

                
                                                      
              </select>
                <?php echo form_error('subDivision'); ?>
              </div>
              <div class="col-md-6">
                <label>PIN Code * </label>
                <input type="number" name="pin_code" value="<?php echo $formData['pin_code'];?>" placeholder="Pincode" class="form-control">
                <?php echo form_error('pin_code'); ?>
              </div>
            </div>
            <div class="row" style="margin-top:10px">
              <div class="col-md-6">
                <label>Nearest Railway Station * </label>
                <input type="text" name="rail_station" value="<?php echo $formData['rail_station'];?>" placeholder="Nearest Railway Station" class="form-control">
                <?php echo form_error('rail_station'); ?>
              </div>
              <div class="col-md-6">
                <label>Distance of Nearest Railway Station (in KM) * </label>
                <input type="number" step="any" name="station_distance" value="<?php echo $formData['station_distance'];?>" placeholder="Nearest Railway Station" class="form-control">
                <?php echo form_error('station_distance'); ?>
              </div>
            </div>
            <div class="row" style="margin-top:10px">
              <div class="col-md-6">
                <label>Nearest Police Station * </label>
                <input type="text" name="police_station" value="<?php echo $formData['police_station'];?>" placeholder="Nearest Police Station" class="form-control">
                <?php echo form_error('police_station'); ?>
              </div>
              <div class="col-md-6">
                <label>Phone Number of Police Station * </label>
                <input type="number" name="ps_phone" value="<?php echo $formData['ps_phone'];?>" placeholder="Phone Number of Police Station" class="form-control">
                <?php echo form_error('ps_phone'); ?>
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
                <input type="text" name="principal_name" value="<?php echo $formData['principal_name'];?>" placeholder="Principal / Officer in Charge" class="form-control">
                <?php echo form_error('principal_name'); ?>
              </div>
              <div class="col-md-6">
                <label>Principal's Personal Mobile Number * </label>
                <input type="number" name="principal_mobile" value="<?php echo $formData['principal_mobile'];?>" placeholder="Personal Mobile Number" class="form-control">
                <?php echo form_error('principal_mobile'); ?>
              </div>
			  
			   <div class="col-md-3">
                <label>Principal's Age * </label>
                <input type="number" name="principal_age" value="<?php echo $formData['principal_age'];?>" placeholder="Age of Principal" class="form-control">
                <?php echo form_error('principal_age'); ?>
              </div>
              <div class="col-md-3">
                <label>Qualification * </label>
                <input type="text" name="qualification" value="<?php echo $formData['qualification'];?>" placeholder="Qualification" class="form-control">
                <?php echo form_error('qualification'); ?>
              </div>
              <div class="col-md-3">
                <label>Year of experience * </label>
                <input type="number" name="year_of_exp" value="<?php echo $formData['year_of_exp'];?>" placeholder="yer of experience" class="form-control">
                <?php echo form_error('year_of_exp'); ?>
              </div>
              <div class="col-md-3">
                <label>Date of Joining *</label>
                <input type="date" name="join_date"  value="<?php echo $formData['join_date']; ?>" placeholder="Date of joining" class="form-control">
                <?php echo form_error('join_date'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Close Priciple in Charge Part-->
      <hr>
      <div style="text-align:right;"><button type="submit" name="" class="btn btn-primary"><i class="fa fa-save"></i> Submit & Proceed to Next Step</button></div>
    <?php echo form_close(); ?>
  
  </div>
</div> 
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>