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
      <?php echo $affiliation_data['affiliation_type']; ?> (Academic Session 2022-2023)</h4>
   </center>
   <hr>
   <?php $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/common_view')?>

     <?php if ($this->session->flashdata('status_v4') !== null) { ?>
           <div class="alert alert-<?= $this->session->flashdata('status_v4') ?>" style="margin-top: 10px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
      <?php } ?>

    <!-- Start Class Rooms-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Available Class Rooms </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
           <?php echo form_open('/admin/polytechnic_affiliation/affiliation/add_class_details')?>
           <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
          <div class="row" style="margin-top:10px">
            <div class="col-md-3">
              <label>Branch / Department *</label>
              <select class="form-control required" name="department"> 
                <option value="">--Select Department--</option>
                 <?php if (count($department)) { ?>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?php echo $value['discipline_id_fk']; ?>" <?php echo set_select('department'); ?>>
                                <?php echo $value['discipline_name']; ?>
                            </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="" disabled>No Data Found...</option>
                  <?php } ?>

              </select>
              <?php echo form_error('department'); ?>
            </div>
            <div class="col-md-3">
              <label>Number of Rooms *</label>
              <input type="text" name="room" placeholder="No of Rooms" class="form-control required" onkeypress="return isNumberValid(event)">
              <?php echo form_error('room'); ?> 
            </div>

             <div class="col-md-2">
              <label>Total Seating Capacity *</label>
              <input type="text" name="seat" placeholder="Seat Capacity" class="form-control required" onkeypress="return isNumberValid(event)">
              <?php echo form_error('seat'); ?>
            </div>

             <div class="col-md-2">
              <label>Size (in sq ft)*</label>
              <input type="number" step="0.01" name="size" placeholder="Size" class="form-control required" onkeypress="return isNumberValid(event)">
              <?php echo form_error('size'); ?>
            </div>

             <div class="col-md-2">
              <label>Remarks </label>
              <input type="text" name="remarks" placeholder="Enter Remarks" class="form-control">
              <?php echo form_error('remarks'); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" style="padding: 10px;">
              <center><button type="submit" id="add_class_intake_btn" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button></center>
            </div>
          </div>

          <?php echo form_close(); ?>

          <?php if ($this->session->flashdata('status') !== null) { ?>
           <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
           <?php } ?>

           <hr>
            <?php if(!empty($fetch_room)) {?>
            <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL. No.</th>
              <th>Branch / Department</th>
              <th>No of Rooms</th>
              <th>Seating Capacity</th>
              <th>Size</th>
              <th>Remarks</th>
              <th>Action</th>
            </tr>
            <?php $c=1; foreach($fetch_room as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['total_rooms'] ?></td>
              <td><?php echo $row['seat'] ?></td>
              <td><?php echo $row['size'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
              <td><a class="btn btn-danger btn-sm" href="polytechnic_affiliation/affiliation/delete/1/<?php echo md5($affiliation_data['basic_affiliation_id_pk']) ?>/<?php echo md5($row['class_details_id_pk']) ?>"><i class="fa fa-trash"> Delete</i></a></td>
            </tr>
          <?php } ?>
            
          </table>
          <?php } ?>

        </div>
      </div>
    </div>


    <!-- End Class Rooms Programme-->


      <!-- Start Laboratories-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Available Laboratories </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <?php echo form_open('/admin/polytechnic_affiliation/affiliation/add_lab_details')?>
          <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
          <div class="row" style="margin-top:10px">
           <div class="col-md-3">
              <label>Branch / Department *</label>
              <select class="form-control required" name="department"> 
                <option value="">--Select Department--</option>
                 <?php if (count($department)) { ?>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?php echo $value['discipline_id_fk']; ?>" <?php echo set_select('department'); ?>>
                                <?php echo $value['discipline_name']; ?>
                            </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="" disabled>No Data Found...</option>
                  <?php } ?>

              </select>
              <?php echo form_error('department'); ?>
            </div>
            <div class="col-md-3">
              <label>Number of Laboratories Available *</label>
              <input type="text" name="avail_lab" placeholder="Name of Laboratories" class="form-control required" onkeypress="return isNumberValid(event)">
              <?php echo form_error('avail_lab'); ?>
            </div>

            <div class="col-md-3">
              <label>Available Number of expermental Set-up *</label>
              <input type="text" name="exp_setup" placeholder="Available Number of expermental Set-up" class="form-control required" onkeypress="return isNumberValid(event)">
              <?php echo form_error('exp_setup'); ?>
            </div>

            <div class="col-md-3">
              <label>Remarks </label>
              <input type="text" name="remarks" class="form-control" placeholder="Enter Remarks">
              <?php echo form_error('remarks'); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" style="padding: 10px;">
              <center><button type="submit" name="" id="add_lab_intake_btn" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button></center>
            </div>
          </div>
          <?php echo form_close(); ?>

           <?php if ($this->session->flashdata('status_v2') !== null) { ?>
           <div class="alert alert-<?= $this->session->flashdata('status_v2') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
           <?php } ?>

           <hr>
            <?php if(!empty($fetch_lab)) {?>
            <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL. No.</th>
              <th>Branch / Department</th>
              <th>Laboratories Available</th>
              <th>No. of experimental Set-up</th>
              <th>Remarks</th>
              <th>Action</th>
            </tr>
            <?php $c=1; foreach($fetch_lab as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['available_lab'] ?></td>
              <td><?php echo $row['exp_setup'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
              <td><a class="btn btn-danger btn-sm" href="polytechnic_affiliation/affiliation/delete/2/<?php echo md5($affiliation_data['basic_affiliation_id_pk']) ?>/<?php echo md5($row['lab_details_id_pk']) ?>"><i class="fa fa-trash"> Delete</i></a></td>
            </tr>
          <?php } ?>
            
          </table>
          <?php } ?>


        </div>
      </div>
    </div>

    <!-- End Laboratories-->


     <!-- Start Library Details-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Library Details </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <?php echo form_open('/admin/polytechnic_affiliation/affiliation/add_library_details')?>
           <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
          <div class="row" style="margin-top:10px">
            <div class="col-md-3">
              <label>Branch / Department *</label>
              <select class="form-control required" name="department"> 
                <option value="">--Select Department--</option>
                 <?php if (count($department)) { ?>
                        <?php foreach ($department as $key => $value) { ?>
                            <option value="<?php echo $value['discipline_id_fk']; ?>" <?php echo set_select('department'); ?>>
                                <?php echo $value['discipline_name']; ?>
                            </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option value="" disabled>No Data Found...</option>
                  <?php } ?>

              </select>
              <?php echo form_error('department'); ?>
            </div>
            <div class="col-md-3">
              <label>Total Number of Books available *</label>
              <input type="text" name="books_avail" placeholder="Number of Books available" onkeypress="return isNumberValid(event)" class="form-control required">
              <?php echo form_error('books_avail'); ?>
            </div>

            <div class="col-md-3">
              <label>Books issued per students *</label>
              <input type="text" name="books_issue" placeholder="Books issued per students" onkeypress="return isNumberValid(event)" class="form-control required">
              <?php echo form_error('books_issue'); ?>
            </div>

            <div class="col-md-3">
              <label>Remarks </label>
              <input type="text" class="form-control" name="remarks" placeholder="Enter Remarks">
              <?php echo form_error('remarks'); ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" style="padding: 10px;">
              <center><button type="submit" name="" id="add_library_intake_btn" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button></center>
            </div>
          </div>

          <?php echo form_close(); ?>


          <?php if ($this->session->flashdata('status_v3') !== null) { ?>
           <div class="alert alert-<?= $this->session->flashdata('status_v3') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
           <?php } ?>

           <hr>
            <?php if(!empty($fetch_library)) {?>
            <table class="table table-bordered">
            <tr class="bg-primary">
              <th>SL. No.</th>
              <th>Branch / Department</th>
              <th>Books available</th>
              <th>Books issued per student</th>
              <th>Remarks</th>
              <th>Action</th>
            </tr>
            <?php $c=1; foreach($fetch_library as $row) {?>
            <tr>
              <td><?php echo $c++; ?></td>
              <td><?php echo $row['discipline_name'] ?></td>
              <td><?php echo $row['books_available'] ?></td>
              <td><?php echo $row['books_issue'] ?></td>
              <td><?php echo $row['remarks'] ?></td>
              <td><a class="btn btn-danger btn-sm" href="polytechnic_affiliation/affiliation/delete/3/<?php echo md5($affiliation_data['basic_affiliation_id_pk']) ?>/<?php echo md5($row['library_id_details_pk']) ?>"><i class="fa fa-trash"> Delete</i></a></td>
            </tr>
          <?php } ?>
            
          </table>
          <?php } ?>


        </div>
      </div>
    </div>

    <!-- End Library-->


     <!-- Start Fees received per Individual Student Details-->

    <!--- For Diploma ET--->

    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Fees received per Individual Student</div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <?php if ($this->session->flashdata('status_v5') !== null) { ?>
           <div class="alert alert-<?= $this->session->flashdata('status_v5') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
           <?php } ?>
        <div class="card-body">
          <?php echo form_open('/admin/polytechnic_affiliation/affiliation/add_fees_structure')?>
           <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
          <div class="row container-fluid" style="margin-top:10px">
            <?php if(!empty($fetch_fees_data)) {?>
            <table class="table table-bordered">
              <tr class="bg-primary">
                <th>#</th>
                <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <th>Management Quota *</th>
                <th>JEXPO *</th>
                <th>VOCLET *</th>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>
                <th>Management Quota *</th>
                <th>Entrance Exam Quota *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?>
                <th>First Year *</th>
                <th>Second Year *</th>
                <th>Third Year *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <th>Semester-1 *</th>
                <th>Semester-2 *</th>
                <th>Semester-3 *</th>
                <th>Semester-4 *</th>
                <th>Semester-5 *</th>
                <th>Semester-6 *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <th>Sem–1 / 1st Year *</th>
                <th>Sem–2 / 2nd Year *</th>
                <th>Sem–3 / 3rd Year *</th>
                <th>Sem–4 / 4th Year *</th>
                <th>Semester-5 </th>
                <th>Semester-6 </th>
               <?php } ?>
              </tr>
               <?php foreach($fetch_fees_data as $row){ ?>
               <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-1" name="m_sem[]" value="<?php echo $row['m_sem'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-1" name="j_sem[]" value="<?php echo $row['j_sem'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-1" name="v_sem[]" value="<?php echo $row['v_sem'] ?>"></td>
               </tr>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>

                <tr>
                <td><?php echo $row['semester'] ?><input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-1" name="part_1[]" value="<?php echo $row['part_1'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-2" name="part_2[]" value="<?php echo $row['part_2'] ?>"></td>
               </tr>
              <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–1" name="dvoc_s1[]" value="<?php echo $row['dvoc_s1'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–2" name="dvoc_s2[]"  value="<?php echo $row['dvoc_s2'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–3" name="dvoc_s3[]"  value="<?php echo $row['dvoc_s3'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–4" name="dvoc_s4[]"  value="<?php echo $row['dvoc_s4'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dvoc_s5[]"  value="<?php echo $row['dvoc_s5'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dvoc_s6[]"  value="<?php echo $row['dvoc_s6'] ?>"></td>
               </tr>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?> 

               <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]"  value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="First Year Fees" name="1_year[]" value="<?php echo $row['1_year'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Second Year Fees" name="2_year[]" value="<?php echo $row['2_year'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Third Year Fees" name="3_year[]" value="<?php echo $row['3_year'] ?>"></td>
               </tr>
             <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <tr>
                <td><?php echo $row['semester'] ?> <input type="hidden" required value="<?php echo $row['semester'] ?>" name="semester[]" value="<?php echo $row['semester'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–1 / 1st Year" name="dip_s1[]" value="<?php echo $row['dip_s1'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–2 / 2nd Year" name="dip_s2[]" value="<?php echo $row['dip_s2'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–3 / 3rd Year" name="dip_s3[]" value="<?php echo $row['dip_s3'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–4 / 4th Year" name="dip_s4[]" value="<?php echo $row['dip_s4'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dip_s5[]" value="<?php echo $row['dip_s5'] ?>"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dip_s6[]" value="<?php echo $row['dip_s6'] ?>"></td>
               </tr>
               <?php } ?>
              <?php } ?>
            </table>
          <?php }else{ ?>
             <table class="table table-bordered">
              <tr class="bg-primary">
                <th>#</th>
                <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <th>Management Quota *</th>
                <th>JEXPO Quota *</th>
                <th>VOCLET *</th>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) {?>
                <th>Management Quota *</th>
                <th>Entrance Exam Quota *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?>
                <th>First Year *</th>
                <th>Second Year *</th>
                <th>Third Year *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) { ?>
                <th>Semester-1 *</th>
                <th>Semester-2 *</th>
                <th>Semester-3 *</th>
                <th>Semester-4 *</th>
                <th>Semester-5 *</th>
                <th>Semester-6 *</th>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <th>Sem–1 / 1st Year *</th>
                <th>Sem–2 / 2nd Year *</th>
                <th>Sem–3 / 3rd Year *</th>
                <th>Sem–4 / 4th Year *</th>
                <th>Semester-5 </th>
                <th>Semester-6 </th>
               <?php } ?>
              </tr>
               <?php if($affiliation_data['affiliation_type_id_fk']==5){ ?>
                <tr>
                <td>Semester-1 <input type="hidden" required value="Semester-1" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-1" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-1" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-1" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-2 <input type="hidden" required value="Semester-2" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-2" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-2" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-2" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-3 <input type="hidden" required value="Semester-3" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-3" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-3" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-3" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-4 <input type="hidden" required value="Semester-4" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-4" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-4" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-4" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-5 <input type="hidden" required value="Semester-5" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-5" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-5" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-5" name="v_sem[]"></td>
               </tr>
               <tr>
                <td>Semester-6 <input type="hidden" required value="Semester-6" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Sem-6" name="m_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees JEXPO Sem-6" name="j_sem[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees VOCLET Sem-6" name="v_sem[]"></td>
               </tr>
                <?php }elseif($affiliation_data['affiliation_type_id_fk']==3) {?>

                <tr>
                <td>PART-I <input type="hidden" required value="PART_I" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-1" name="part_1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-2" name="part_2[]"></td>
               </tr>
               <tr>
                <td>PART-II <input type="hidden" required value="PART_II" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-1" name="part_1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Management Part-2" name="part_2[]"></td>
               </tr>

              <?php }elseif($affiliation_data['affiliation_type_id_fk']==2) { ?>
                <tr>
                <td>DVOC <input type="hidden" required value="DVOC" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–1" name="dvoc_s1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–2" name="dvoc_s2[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–3" name="dvoc_s3[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–4" name="dvoc_s4[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dvoc_s5[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dvoc_s6[]"></td>
               </tr>
               <?php }elseif($affiliation_data['affiliation_type_id_fk']==4) { ?> 

               <tr>
                <td>HMCT <input type="hidden" required value="HMCT" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="First Year Fees" name="1_year[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Second Year Fees" name="2_year[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Third Year Fees" name="3_year[]"></td>
               </tr>
             <?php }elseif($affiliation_data['affiliation_type_id_fk']==1) { ?>
                <tr>
                <td>DIPLOMA <input type="hidden" required value="DIPLOMA" name="semester[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–1 / 1st Year" name="dip_s1[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–2 / 2nd Year" name="dip_s2[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–3 / 3rd Year" name="dip_s3[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Sem–4 / 4th Year" name="dip_s4[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–5" name="dip_s5[]"></td>
                <td><input class="form-control" required onkeypress="return isNumberValid(event)" placeholder="Fees Semester–6" name="dip_s6[]"></td>
               </tr>
               <?php } ?>
            </table>
          <?php } ?>



          </div>
          <hr>
         <div style="text-align:center;"><button type="submit" id="add_mand_btn" name="" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button></div>

        <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <!-- End Fees received per Individual Student-->



     <!-- Start Mandatory Requirements Details-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Mandatory Requirements</div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <?php echo form_open('/admin/polytechnic_affiliation/affiliation/add_mand_details')?>
           <input type="hidden" name="basic_id" value="<?php echo $affiliation_data['basic_affiliation_id_pk'] ?>" />
          <div class="row container-fluid" style="margin-top:10px">
            <?php if(!empty($fetch_mandory_data)) {?>
            <table class="table table-bordered">
              <tr class="bg-primary">
                <th>SL. No</th>
                <th>Facilities</th>
                <th>Availability (Yes/No) *</th>
                <th>Size / Number (as applicable)</th>
              </tr>
        
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

            </table>
          <?php }else {?>

            
            <table class="table table-bordered">
              <tr class="bg-primary">
                <th>SL. No</th>
                <th>Facilities</th>
                <th>Availability (Yes/No) *</th>
                <th>Size / Number (as applicable)</th>
              </tr>
        
                <?php $c=1; foreach($mandory_data as $row){ ?>
                <tr>
                <td><?php echo $c++; ?></td>
                <td><?php echo $row['facilities_name']; ?> <input type="hidden" name="mand_req[]" value="<?php echo $row['fc_id_pk']; ?>">
                </td>
                <td>
                  <select name="req_status[]" class="form-control required" required>
                    <option value="">-Select-</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                  </select>
                </td>
                <td>
                  <input type="text" name="req_details[]" class="form-control" value="" placeholder="Size/Number/Details" maxlength="60">
                </td>
              </tr>
              <?php } ?>

            </table>
          <?php } ?>

          </div>

        </div>
      </div>
    </div>

    <!-- End Library-->
    
    <hr>
    <div style="text-align:right;"><button type="submit" id="add_mand_btn" name="" class="btn btn-primary"><i class="fa fa-save"></i> Submit & Proceed to Next Step</button></div>
    <?php echo form_close(); ?>
  </div>
</div> 
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>