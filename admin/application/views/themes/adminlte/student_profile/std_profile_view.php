<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style type="text/css">
	.border{
  border: 2px solid black;
  border-style: dotted;
  margin: auto;  
  padding: 20px;
  background-color: white;
  border-radius: 6px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.shadow{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  padding: 10px;
} 
</style>
<div class="content-wrapper" style="padding-left: 60px;padding-right: 60px;padding-top: 10px;">
<?php if ($this->session->flashdata('status') !== null) { ?>
        <div class="alert alert-<?= $this->session->flashdata('status') ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $this->session->flashdata('alert_msg') ?>
        </div>
    <?php } ?>
     <div class="border">
       <div class="shadow">
     	 <div style="font-size: 18px;color:#246d8a;font-weight:bold;">
     		Data Available With Council / কাউন্সিলে উপলভ্য তথ্য
     	  </div>
     	  <div class="table-responsive">
	     	<table class="table table-bordered">
	     		<tr>
	     			<td>Mobile No:</td>
	     			<th><?php echo $formdata['mobile'];?></th>
	     			<td>Land Loser:</td>
	     			<th><?php echo strtoupper($formdata['land_loser']);?></th>
	     		</tr>
	     		<tr>
	     			<td>Gender:</td> 
	     			<th><?php echo strtoupper($std_data[0]['gender_description']);?></th>
	     			<td>Seeking admition under TFW Scheme:</td>
	     			<th><?php echo strtoupper($formdata['applied_under_tfw']);?></th>
	     		</tr>
	     		<tr>
	     			<td>Physically Challenged:</td>
	     			<th><?php echo strtoupper($formdata['handicapped']);?></th>
	     			<td>Ward of Ex-serviceman:</td>
	     			<th><?php echo strtoupper($formdata['wards_of_exserviceman']);?></th>
	     		</tr>
	     		<tr>
	     			<td>Category:</td>
	     			<th><?php echo strtoupper($std_data[0]['caste_name']);?></th>
	     			<td>Kanyashree Status:</td>
	     			<th><?php echo strtoupper($formdata['kanyashree']);?></th>
	     		</tr>
	     		<tr>
	     			<td>SC/ST/OBC certificate issued in:</td>
	     			<th><?php echo strtoupper($std_data[0]['state_name']);?></th>
	     			<td>Kanyashree Unique Id:</td>
	     			<th><?php echo strtoupper($std_data[0]['kanyashree_unique_id']);?></th>
	     		</tr>
	     	</table>  	     	  	
     	  </div>
     	</div>
     	<hr>
     	<!-- <form method="POST" action="student_profile/std_profile/".<?php echo md5($std_data[0]['student_details_id_pk'])?>> -->
		 <?php echo form_open_multipart("admin/student_profile/std_profile/update_details/" . md5($std_data[0]['student_details_id_pk'])); ?>

     		<!-- <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>"> -->
      <div class="shadows">
     	 <div class="row">
     	 	<div class="col-md-6" style="font-size: 15px;color:black;font-weight:bold;">
     	 		Do you have EWS (Economically Weaker Sections) certificate ?
     	 	</div>
     	 	<div class="col-md-6">
     	 		<?php if(strtoupper($formdata['ews'])=='NO'){?>
     	 		<input type="radio" name="ews" value="no" checked>No 
					&nbsp;<input type="radio" name="ews" value="yes">Yes
				<?php }else{ ?>
     	 		<input type="radio" name="ews" value="yes" checked>Yes
     	 		&nbsp;<input type="radio" name="ews" value="no">No 
     	 		<?php } ?>
			  <?php echo form_error('ews'); ?>
     	 	</div>
     	 	<div class="col-md-12" style="color:red;font-weight:bold;text-align: center;margin-top: 10px;">
     	 		* The seats under EWS (Economically Weaker Sections) category is only available at Ghani Khan Chowdhury Institute of Engineering & Technology, Malda (GKCIET).Details regarding EWS category will be available in the website of GKCIET at www.gkciet.ac.in
     	 	</div>

     	 	<div class="col-sm-12" style="border-bottom:black solid 2px;margin-top: 20px;margin-bottom: 20px;">
     	 		
     	 	</div>

     	 	<div class="col-md-12" style="font-size: 18px;color:#246d8a;font-weight:bold;">
     	 		Edit Details / তথ্য ঠিক করার একমাত্র সুযোগ <font color="red">(One Time Edit)</font>
     	 	</div>

     	  	<div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
  

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Mobile No:</label>
     	 		<input type="text" name="mobile" class="form-control" placeholder="Enter Mobile No" value="<?php echo $formdata['mobile'];?>">
				<?php echo form_error('mobile'); ?>
			</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Land Loser:</label>
     	 		<select class="form-control" name="lnd_lser">
     	 			
     	 			<option value="yes" <?php if($formdata['land_loser'] == 'yes'){echo 'selected';} ?>>YES</option>
     	 			<option value="no" <?php if($formdata['land_loser'] == 'no'){echo 'selected';} ?>>NO</option>
     	 		</select>
				<?php echo form_error('lnd_lser'); ?>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Gender:</label>
     	 		<select class="form-control" name="gender">
     	 			
     	 			<option value="1" <?php if($formdata['gender_id_fk'] == 1){echo 'selected';}?>>MALE</option>
     	 			<option value="2" <?php if($formdata['gender_id_fk'] == 2){echo 'selected';}?>>FEMALE</option>
     	 			<option value="3" <?php if($formdata['gender_id_fk'] == 3){echo 'selected';}?>>TRANSGENDER</option>
     	 		</select>
				<?php echo form_error('gender'); ?>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Seeking admition under TFW Scheme:</label>
     	 		<select class="form-control" name="tfw">
     	 			<option value="<?php echo $data[0]['applied_under_tfw'];?>"><?php echo strtoupper($data[0]['applied_under_tfw']);?></option>
     	 			<option value="yes" <?php if($formdata['applied_under_tfw'] == 'yes'){echo 'selected';}?>>YES</option>
     	 			<option value="no" <?php if($formdata['applied_under_tfw'] == 'no'){echo 'selected';}?>>NO</option>
     	 		</select>
				  <?php echo form_error('tfw'); ?>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Physically Challenged:</label>
     	 		<select class="form-control" name="handicapped">
     	 			<!-- <option value="<?php echo $data[0]['handicapped'];?>"><?php echo strtoupper($data[0]['handicapped']);?></option> -->
     	 			<option value="yes" <?php if($formdata['handicapped'] == 'yes'){echo 'selected';}?>>YES</option>
     	 			<option value="no" <?php if($formdata['handicapped'] == 'no'){echo 'selected';}?>>NO</option>
     	 		</select>
				  <?php echo form_error('handicapped'); ?>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Ward of Ex-serviceman:</label>
     	 		<select class="form-control" name="ex_service">
     	 			<!-- <option value="<?php echo $data[0]['wards_of_exserviceman'];?>"><?php echo strtoupper($data[0]['wards_of_exserviceman']);?></option> -->
     	 			<option value="no" <?php if($formdata['wards_of_exserviceman'] == 'no'){echo 'selected';}?>>NO</option>
     	 			<option value="yes" <?php if($formdata['wards_of_exserviceman'] == 'yes'){echo 'selected';}?>>YES</option>
     	 		</select>
				<?php echo form_error('ex_service'); ?>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Category:</label>
     	 		<select class="form-control" name="category">
				  <option value="">-- Select Category --</option>
                    <?php foreach ($castes as $caste) { ?>
                        <option value="<?php echo $caste['caste_id_pk'] ?>" <?php  if($caste['caste_id_pk'] == $formdata['caste_id_fk']){ echo 'Selected'; } ?>><?php echo $caste['caste_name'] ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('category'); ?>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Kanyashree Status:</label>
     	 		<select class="form-control" name="kanyashree_status">
				  <option value="">-- Select Kanyashree Status --</option>
     	 			<!-- <option value="<?php echo $data[0]['kanyashree'];?>"><?php echo strtoupper($data[0]['kanyashree']);?></option> -->
     	 			<option value="no" <?php if($formdata['kanyashree'] == 'no'){echo 'selected';}?>>NO</option>
     	 			<option value="yes" <?php if($formdata['kanyashree'] == 'yes'){echo 'selected';}?>>YES</option>
     	 		</select>
				  <?php echo form_error('kanyashree_status'); ?>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>SC/ST/OBC certificate issued in:</label>
     	 		<select class="form-control" name="caste_issue_in">
				  <option value="">-- Select Any one --</option>
     	 			<option value="19" <?php if($formdata['caste_issue_in'] == '19' ){echo 'selected';}?>>WEST BENGAL</option>
     	 			<option value="0" <?php if($formdata['caste_issue_in'] == '0' ){echo 'selected';}?>>OTHERS STATE</option>
     	 		</select>
				 <?php echo form_error('caste_issue_in'); ?>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Father's/Guardian's Name:</label>
     	 		<input type="text" name="guardian_name" class="form-control" placeholder="Enter Father's/Guardian's Name" value="<?php echo strtoupper($formdata['guardian_name']);?>">
				<?php echo form_error('guardian_name'); ?>
			</div>

     	 	<div class="col-md-12" style="margin-top:10px">
     	 		<label>District of School from where passed/appeared Madhamik or Equivalent Examination:</label>
     	 		<select class="form-control" name="school_district">
				  <option value="">-- Select Any one --</option>
     	 			<?php foreach($district as $row) {?>
     	 			<option value="<?php echo $row['district_id_pk'] ?>" <?php if($formdata['school_district'] == $row['district_id_pk'] ){echo 'selected';}?>><?php echo $row['district_name'] ?></option>
     	 		<?php } ?>
     	 		</select>
				  <?php echo form_error('school_district'); ?>
     	 	</div>

     	 	<div class="col-md-12" style="margin-top:10px">
     	 	<center><button type="submit" name="btn" class="btn btn-primary btn-sm">UPDATE & SUBMIT FORM</button></center>
     	    </div>
     	 </div>	
		  <?php echo form_close(); ?>
      </div>
</div>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>