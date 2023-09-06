
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


  .red-border {
      border: 2px solid #D32F2F;
  }

  .red-border:focus {
      border: 2px solid #D32F2F;
  }

  .green-border {
      border: 1px solid #388E3C;
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

    <!-- Start Academic Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">

      <?php if ($this->session->flashdata('status') !== null) { ?>
      <div class="alert alert-<?= $this->session->flashdata('status') ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?= $this->session->flashdata('alert_msg') ?>
      </div>
    <?php } ?>
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Ongoing Academic Programme </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <?php echo form_open('/admin/polytechnic_affiliation/affiliation/add_academic_details')?>

            <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
            <input type="hidden" name="ins_id" value="<?php echo $affiliation_data['vtc_id_fk'] ?>" />
            <input type="hidden" name="affiliation_type_id" value="<?php echo $affiliation_data['affiliation_type_id_fk'] ?>" />

            <div class="row" style="margin-top:10px">
              <div class="col-md-3">
                <label>Branch / Department *</label>
                <select name="branch" class="form-control required">
                  <option value="">--Select Branch / Department--</option>
                  <?php foreach($branch as $val) { ?>
                  <option value="<?php echo $val['discipline_id_fk'] ?>"><?php echo $val['discipline_name'] ?></option>
                <?php }?>
                </select>
                <?php echo form_error('affiliation_type_id'); ?>
              </div>
              <?php /*<div class="col-md-3">
                <label>Shift *</label>
                <select name="shift" id="shift" class="form-control required">
                  <option value="">--Select Shift--</option>
                  <option value="1">1st Shift</option>
                  <option value="2">2nd Shift</option>
                </select>
                <?php echo form_error('shift'); ?>
              </div>*/?>

              <div class="col-md-2">
                <label>Approved Intake *</label>
                <input type="number" name="intake_no" id="intake_no" placeholder="Intake (2023-2024)" class="form-control required">
                <?php echo form_error('intake_no'); ?>
              </div> 

              <div class="col-md-2">
                <label>No of Regular Faculties *</label>
                <input type="number" name="faculty" id="faculty" placeholder="Enter Regular Faculties" class="form-control required">
                <?php echo form_error('faculty'); ?>
              </div>

              <div class="col-md-2">
                <label>Remarks *</label>
                <select name="remarks" id="remarks" class="form-control required">
                  <option value="">--Select--</option>
                  <option value="New Branch">New Branch</option>
                  <option value="Same as pervious year">Same as pervious year</option>
                  <option value="Increase in Intake">Increase in Intake</option>
                  <option value="Decrease in Intake">Decrease in Intake</option>
                  <option value="Closure">Closure</option>
                </select>
              </div>

              
            </div>
           

            <div class="row">
              <div class="col-md-12" style="padding: 10px;">
                <center><button type="submit" name="" class="btn btn-primary" id="add_affiliation_intake_btn"><i class="fa fa-plus"></i> Add</button></center>
              </div>
            </div>
            <?php echo form_close(); ?>


            <hr>
            <?php if(!empty($intake_data)) {?>
            <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL No.</th>
              <th>Branch / Department</th>
              <!-- <th>Shift</th> -->
              <th>Approved Intake</th>
              <th>No of Regular Faculties</th>
              <th>Remarks</th>
              <th>Action</th>
            </tr>
            <?php $c=1; foreach($intake_data as $row) {?>
            <tr>
            <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <!-- <td><?php if ($row['shift'] == 1){echo '1st Shift';}else{echo '2nd Shift';} ?></td> -->
              <td><?php echo $row['intake_no'] ?></td>
              <td><?php echo $row['faculty'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
              <td><a class="btn btn-danger btn-sm" href="polytechnic_affiliation/affiliation/delete_staff_intake/4/<?php echo md5($affiliation_data['basic_affiliation_id_pk']) ?>/<?php echo md5($row['intake_details_id_pk']) ?>"><i class="fa fa-trash"> Delete</i></a></td>
            </tr>
            <?php }?>
            </table>
          <?php  }?>



          
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
          <?php echo form_open('/admin/polytechnic_affiliation/affiliation/add_teacher_details') ?>

            <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
            <input type="hidden" name="ins_id" value="<?php echo $affiliation_data['vtc_id_fk'] ?>" />
            <input type="hidden" name="affiliation_type_id" value="<?php echo $affiliation_data['affiliation_type_id_fk'] ?>" />

            <div class="row" style="margin-top:10px">
              <div class="col-md-3">
                <label>Branch / Department *</label>
                <select name="branch" class="form-control required">
                  <option value="">--Select Branch / Department--</option>
                  <?php foreach($teacher_branch as $val) { ?>
                    <option value="<?php echo $val['discipline_id_fk'] ?>"><?php echo $val['discipline_name'] ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="col-md-3">
                <label>Name of Teachers *</label>
                <input type="text" name="teacher_name" placeholder="Name of Teachers" class="form-control">
                <?php echo form_error('teacher_name'); ?>
              </div>

              <div class="col-md-3">
                <label>Highest Qualification *</label>
                

                <select name="qualification" class="form-control" >
                  <option value="">-Select-</option>
                  <option value="DIPLOMA">Diploma</option>
                  <option value="Advance Diploma">Advance Diploma</option>
                  <option value="B.TECH">B.TECH</option>
                  <option value="B.E.">B.E.</option>
                  <option value="A.M.I.E.">A.M.I.E.</option>
                  <option value="B.SC">B.Sc</option>
                  <option value="B.SC(Hons)">B.Sc(Hons)</option>
                  <option value="B.Sc(Engg.)">B.Sc (Engg.)</option>
                  <option value="B.PHARM">B.PHARM</option>
                  <option value="B.COM">B.COM</option>
                  <option value="B.COM(Hons)">B.COM(Hons)</option>
                  <option value="B.A.">B.A.</option>
                  <option value="B.A.(Hons)">B.A.(Hons)</option>
                  <option value="B.Arch">B.Arch</option>
                  <option value="BCA">BCA</option>
                  <option value="Higher Secondary">Higher Secondary</option>
				          <option value="ITI">ITI</option>
                  <option value="L.L.B.">L.L.B.</option>
                  <option value="M.TECH">M.TECH</option>
                  <option value="M.PHARM">M.PHARM</option>
                  <option value="M.E.">M.E.</option>
                  <option value="M.SC">M.Sc</option>
                  <option value="M.SC(Engg.)">M.Sc (Engg.)</option>
                  <option value="M.SC(Tech.)">M.Sc (Tech.)</option>
                  <option value="MCA">MCA</option>
                  <option value="M.COM">M.COM</option>
                  <option value="M.A.">M.A.</option>
                  <option value="M.Arch">M.Arch</option>
                  <option value="M.B.A.">M.B.A.</option>
                  <option value="L.L.M.">L.L.M.</option>
                  <option value="MBBS">MBBS</option>
                  <option value="MD">MD</option>
                  <option value="MS">MS</option>
                  <option value="Madhyamik">Madhyamik</option>
                  <option value="MPhil">MPhil</option>
                  <option value="PHD-HUMANITIES">PHD-HUMANITIES</option>
                  <option value="PHD-PHARM">PHD-PHARM</option>
                  <option value="PHD-SCIENCE">PHD-SCIENCE</option>
                  <option value="PHD-ENGINEERING">PHD-ENGINEERING</option>
                </select>
                <?php echo form_error('qualification'); ?>
              </div>

              <div class="col-md-3">
                <label>Faculty Type *</label>
                <select name="engagement_type" id="engagement_type" class="form-control" required="">
                  <option value="">-Select-</option>
                  <option value="Asst Professor">Asst Professor</option>
				          <option value="Associate Professor">Associate Professor</option>
                  <option value="Lecturer (Full-Time)">Lecturer (Full-Time)</option>
                  <option value="Lecturer (Contractual)">Lecturer (Contractual)</option>
                  <option value="Lecturer (Part-Time)">Lecturer (Part-Time)</option>
                  <option value="Instructor">Instructor</option>
                  <option value="Laboratory Assistant">Laboratory Assistant</option>
                  <option value="Other">Other</option>
                </select>
                <?php echo form_error('engagement_type'); ?>
              </div>

              <div class="col-md-3 other_faculty" <?php if(set_value('engagement_type')!= 'Other' || set_value('engagement_type') == NULL)echo 'style="display: none;"'; ?> >
                <label>Other Faculty Type *</label>
                <input type="text" name="other_faculty" placeholder="Other Faculty Type" class="form-control">
                <?php echo form_error('other_faculty'); ?>
              </div>


              <div class="col-md-3">
                <label>Years of Experience (in Teaching/Lecturer) *</label>
                <input type="number" name="year_exp" placeholder="Years of Experience" class="form-control">
                <?php echo form_error('year_exp'); ?>
              </div>

              <div class="col-md-3">
                <label>Date of Joining *</label>
                <input type="date" name="join_date" placeholder="Enter Regular Faculties" class="form-control">
                <?php echo form_error('join_date'); ?>
              </div>

              <div class="col-md-3">
                <label>Mobile No *</label>
              <input type="number" name="teacher_mobile" placeholder="Mobile No" class="form-control">
              <?php echo form_error('teacher_mobile'); ?>
              </div>

              <div class="col-md-3">
                <label>Monthly Salary (Rs.) *</label>
                <input type="number" name="salary" placeholder="Gross Salary" class="form-control">
                <?php echo form_error('salary'); ?>
              </div>


            </div>

            <div class="row">
              <div class="col-md-12" style="padding: 10px;">
                <center><button type="submit" name="teachr_submit" class="btn btn-primary" id="teacher_add_btn"><i class="fa fa-plus"></i> Add</button></center>
              </div>
            </div>
          <?php echo form_close(); ?>

          <hr>
            <?php if(!empty($teacher_data)) {?>
            <table class="table table-bordered">
            <tr class="bg-primary">
            <th>SL No.</th>
              <th>Branch / Department</th>
              <th>Name of Teachers</th>
              <th>Mobile No</th>
              <th>Highest Qualification</th>
              <th>Faculty Type</th>
              <th>Years of Experience</th>
              <th>Date of Joining</th>
              <th>Monthly Salary (Rs.)</th>
              <th>Action</th>
            </tr>
            <?php $c=1; foreach($teacher_data as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['teacher_name'] ?></td>
              <td><?php echo $row['teacher_mobile'] ?></td>
              <td><?php echo $row['qualification'] ?></td>
              <td><?php if ($row['engagement_type'] == 'Other'){ echo $row['engagement_type'] . '('.$row['other_faculty'] . ')';} else{echo $row['engagement_type'] ;}?></td>
              <td><?php echo $row['year_exp'] ?></td>
              <td><?php echo $row['join_date'] ?></td>
              <td><?php echo $row['salary'] ?></td>
              <td><a class="btn btn-danger btn-sm" href="polytechnic_affiliation/affiliation/delete_staff_intake/5/<?php echo md5($affiliation_data['basic_affiliation_id_pk']) ?>/<?php echo md5($row['teacher_id_pk']) ?>"><i class="fa fa-trash"> Delete</i></a></td>
            </tr>
            <?php }?>
            </table>
          <?php  }?>

        </div>
      </div>
    </div>

    <!-- End Academic Programme-->
    
    <hr>

    <?php echo form_open('/admin/polytechnic_affiliation/affiliation/intake_details/'.md5($affiliation_data['basic_affiliation_id_pk']))?>

      <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
      <input type="hidden" name="ins_id" value="<?php echo $affiliation_data['vtc_id_fk'] ?>" />
      <input type="hidden" name="affiliation_type_id" value="<?php echo $affiliation_data['affiliation_type_id_fk'] ?>" />
      <div style="text-align:right;"><button type="submit" name="" class="btn btn-primary"><i class="fa fa-save"></i> Submit & Proceed to Next Step</button></div>
    <?php echo form_close(); ?>
  
  </div>
</div> 
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>