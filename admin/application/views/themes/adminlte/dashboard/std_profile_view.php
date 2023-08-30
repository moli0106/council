
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
<div class="" style="padding-left: 0px;padding-right: 60px;padding-top: 10px;">
     <div class="border">
       <div class="shadow">
     	 <div style="font-size: 18px;color:#246d8a;font-weight:bold;">
     		Data Available With Council / কাউন্সিলে উপলভ্য তথ্য
     	  </div>
     	  <div class="table-responsive">
	     	<table class="table table-bordered">
	     		<tr>
	     			<td>Mobile No:</td>
	     			<th><?php echo $data[0]['mobile_number'];?></th>
	     			<td>Land Loser:</td>
	     			<th><?php echo strtoupper($data[0]['land_loser']);?></th>
	     		</tr>
	     		<tr>
	     			<td>Gender:</td> 
	     			<th><?php echo strtoupper($data[0]['gender_description']);?></th>
	     			<td>Seeking admition under TFW Scheme:</td>
	     			<th><?php echo strtoupper($data[0]['applied_under_tfw']);?></th>
	     		</tr>
	     		<tr>
	     			<td>Physically Challenged:</td>
	     			<th><?php echo strtoupper($data[0]['physically_challenged']);?></th>
	     			<td>Ward of Ex-serviceman:</td>
	     			<th><?php echo strtoupper($data[0]['wards_of_exserviceman']);?></th>
	     		</tr>
	     		<tr>
	     			<td>Category:</td>
	     			<th><?php echo strtoupper($data[0]['caste_name']);?></th>
	     			<td>Kanyashree Status:</td>
	     			<th><?php echo strtoupper($data[0]['kanyashree']);?></th>
	     		</tr>
	     		<tr>
	     			<td>SC/ST/OBC certificate issued in:</td>
	     			<th><?php echo strtoupper($data[0]['state_name']);?></th>
	     			<td>Kanyashree Unique Id:</td>
	     			<th><?php echo strtoupper($data[0]['kanyashree_unique_id']);?></th>
	     		</tr>
	     	</table>  	     	  	
     	  </div>
     	</div>
     	<hr>
     	<!-- <form method="POST" action="student_profile/std_profile/update_details"> -->
		 <?php echo form_open_multipart("admin/student_profile/std_profile/update_details/" . md5($data[0]['student_details_id_pk'])); ?>
   <div class="shadows">
     	 <div class="row">
     	 	<div class="col-md-6" style="font-size: 15px;color:black;font-weight:bold;">
     	 		Do you have EWS (Economically Weaker Sections) certificate ?
     	 	</div>
     	 	<div class="col-md-6">
     	 		<?php if(strtoupper($data[0]['ews'])=='NO'){?>
     	 		<input type="radio" name="ews" value="no" checked>No 
     	 		&nbsp;<input type="radio" name="ews" value="yes">Yes
     	  	<?php }else{ ?>
     	 		<input type="radio" name="ews" value="yes" checked>Yes
     	 		&nbsp;<input type="radio" name="ews" value="no">No 
     	 	<?php } ?>
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
     	 		<input type="text" name="mobile" class="form-control" placeholder="Enter Mobile No" value="<?php echo $data[0]['mobile_number'];?>">
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Land Loser:</label>
     	 		<select class="form-control" name="lnd_lser">
     	 			<option value="<?php echo $data[0]['land_loser'];?>"><?php echo strtoupper($data[0]['land_loser']);?></option>
     	 			<option value="yes">YES</option>
     	 			<option value="no">NO</option>
     	 		</select>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Gender:</label>
     	 		<select class="form-control" name="gender">
     	 			<option value="<?php echo $data[0]['gender_id_pk'];?>"><?php echo strtoupper($data[0]['gender_description']);?></option>
     	 			<option value="1">MALE</option>
     	 			<option value="2">FEMALE</option>
     	 			<option value="3">TRANSGENDER</option>
     	 		</select>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Seeking admition under TFW Scheme:</label>
     	 		<select class="form-control" name="tfw">
     	 			<option value="<?php echo $data[0]['applied_under_tfw'];?>"><?php echo strtoupper($data[0]['applied_under_tfw']);?></option>
     	 			<option value="yes">YES</option>
     	 			<option value="no">NO</option>
     	 		</select>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Physically Challenged:</label>
     	 		<select class="form-control" name="pc">
     	 			<option value="<?php echo $data[0]['physically_challenged'];?>"><?php echo strtoupper($data[0]['physically_challenged']);?></option>
     	 			<option value="yes">YES</option>
     	 			<option value="no">NO</option>
     	 		</select>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Ward of Ex-serviceman:</label>
     	 		<select class="form-control" name="ex_service">
     	 			<option value="<?php echo $data[0]['wards_of_exserviceman'];?>"><?php echo strtoupper($data[0]['wards_of_exserviceman']);?></option>
     	 			<option value="no">NO</option>
     	 			<option value="yes">YES</option>
     	 		</select>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Category:</label>
     	 		<select class="form-control" name="category">
     	 			<option value="<?php echo $data[0]['caste_id_pk'];?>"><?php echo strtoupper($data[0]['caste_name']);?></option>
     	 			<option value="2">SC</option>
     	 			<option value="3">ST</option>
     	 			<option value="4">OBC-A</option>
     	 			<option value="5">OBC-B</option>
     	 			<option value="1">Genarel</option>
     	 		</select>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Kanyashree Status:</label>
     	 		<select class="form-control" name="kanyashree_status">
     	 			<option value="<?php echo $data[0]['kanyashree'];?>"><?php echo strtoupper($data[0]['kanyashree']);?></option>
     	 			<option value="no">NO</option>
     	 			<option value="yes">YES</option>
     	 		</select>
     	 	</div>

     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>SC/ST/OBC certificate issued in:</label>
     	 		<select class="form-control" name="issue">
     	 			<option value="<?php echo $data[0]['state_id_pk'];?>"><?php echo $data[0]['state_name'];?></option>
     	 			<option value="19">WEST BENGAL</option>
     	 			<option value="0">OTHERS STATE</option>
     	 		</select>
     	 	</div>
     	 	<div class="col-md-6" style="margin-top:10px">
     	 		<label>Father's/Guardian's Name:</label>
     	 		<input type="text" name="guardian_name" class="form-control" placeholder="Enter Father's/Guardian's Name" value="<?php echo strtoupper($data[0]['guardian_name']);?>">
     	 	</div>

     	 	<div class="col-md-12" style="margin-top:10px">
     	 		<label>District of School from where passed/appeared Madhamik or Equivalent Examination:</label>
     	 		<select class="form-control" name="district">
     	 			<option value="<?php echo $data[0]['district_id_pk'];?>"><?php echo strtoupper($data[0]['district_name']);?></option>
     	 			<?php foreach($district as $row) {?>
     	 			<option value="<?php echo $row['district_id_pk'] ?>"><?php echo $row['district_name'] ?></option>
     	 		<?php } ?>
     	 		</select>
     	 	</div>

     	 	<div class="col-md-12" style="margin-top:10px">
     	 	<center><button type="submit" name="btn" class="btn btn-primary btn-sm">UPDATE & SUBMIT FORM</button></center>
     	    </div>
     	 </div>	
		  <?php echo form_close(); ?>
      </div>
</div>
</div>
