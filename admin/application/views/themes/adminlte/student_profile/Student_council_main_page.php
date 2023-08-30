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
.shadow_new{
	box-shadow: 0 0px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
  padding: 10px;
  
}
</style>
<div class="content-wrapper" style="padding-left: 60px;padding-right: 60px;padding-top: 10px;">
     <div class="border">
     	<div class="row">
     		<div class="col-md-12" style="font-size: 18px;color:#246d8a;font-weight:bold;">
     	 		Personal Details / ব্যক্তিগত বিবরণ
     	 	  </div>
     	  	<div class="col-md-12" style="border-bottom:black solid 4px;margin-top: 15px;margin-bottom: 10px;"></div>
     	</div>

       <div class="shadow">
    
     	  <div class="row">
     	  	<div class="col-md-3 text-center">
     	  		<img src="http://localhost/council_live/admin/themes/adminlte/assets/image/user_img.png" class="shadow" height="200px" style="border: 2px solid black;"><br>
     	  		<img src="http://localhost/council_live/admin/themes/adminlte/assets/image/signkroy.png" height="60px" width="100px">
     	  	</div>
     	  	<div class="col-md-4">
	     	  		<table class="table table-bordered">
		     		<tr>
		     			<td>Application Form No:</td>
		     			<th>999999</th>
		     		</tr>
		     		<tr>
		     			<td>Student Name:</td> 
		     			<th><?php echo $std_data['candidate_name']; ?></th>
		     		</tr>
		     		<tr>
		     			<td>Guardian Name:</td>
		     			<th><?php echo $std_data['guardian_name']; ?></th>
		     		</tr>
		     		<tr>
		     			<td>Physically Challenged:</td>
		     			<th><?php echo strtoupper($std_data['handicapped']); ?></th>
		     		</tr>
		     		<tr>
		     			<td>Land Loser:</td>
		     			<th><?php echo strtoupper($std_data['land_loser']); ?></th>
		     		</tr>
		     		<tr>
		     			<td>Mobile No:</td>
		     			<th><?php echo $std_data['mobile_number']; ?></th>
		     		</tr>
		     		<tr>
		     			<td>Kanyashree Status:</td>
		     			<th><?php echo strtoupper($std_data['kanyashree']); ?></th>
		     		</tr>
		     	</table>  	  
     	  </div>
     	  	<div class="col-md-4">

     	  		<table class="table table-bordered">
	     		<tr>
	     			<td>Category:</td>
	     			<th><?php echo $std_data['caste_name']; ?> [<?php echo $std_data['state_name']; ?>]</th>
	     		</tr>
	     		<tr>
	     			<td>Gender:</td> 
	     			<th><?php echo $std_data['gender_description']; ?></th>
	     		</tr>
	     		<tr>
	     			<td>Date Of Birth:</td>
	     			<th>30 March,1998</th>
	     		</tr>
	     		<tr>
	     			<td>is TFW:</td>
	     			<th><?php echo strtoupper($std_data['applied_under_tfw']); ?></th>
	     		</tr>
	     		<tr>
	     			<td>School District:</td>
	     			<th>MALDA</th>
	     		</tr>
	     		<tr>
	     			<td>Ward of Ex-Serviceman:</td>
	     			<th><?php echo strtoupper($std_data['wards_of_exserviceman']); ?></th>
	     		</tr>
	     		<tr>
	     			<td>Kanyashree Unique Id:</td>
	     			<th></th>
	     		</tr>
	     	</table>  	  

     	  	</div>
     	  </div>
     	 
     	</div>
     	<hr>
     	

     	<div class="row">
     		 <div class="col-md-2 col-6 shadow_new">
        	<div class="card card-outline card-primary text-center" style="padding:20px">
        		<font style="color:#0078B7;font-weight: bold;">General Rank</font>
        		<br><?php if($std_data['general_rank']!=0){echo $std_data['general_rank'];}else{echo '---';} ?>
        	</div>
        </div>
        <div class="col-md-2 col-6 shadow_new">
        	<div class="card card-outline card-primary text-center" style="padding:20px;">
        		<font style="color:#0078B7;font-weight: bold;">PH Rank</font>
        		<br><?php if($std_data['pc_rank']!=0){echo $std_data['pc_rank'];}else{echo '---';} ?>
        	</div>
        </div>
        <div class="col-md-2 col-6 shadow_new">
        	<div class="card card-outline card-primary text-center" style="padding:20px">
        		<font style="color:#0078B7;font-weight: bold;">SC Rank</font>
        		<br><?php if($std_data['sc_rank']!=0){echo $std_data['sc_rank'];}else{echo '---';} ?>
        	</div>
        </div>
        <div class="col-md-2 col-6 shadow_new">
        	<div class="card card-outline card-primary text-center" style="padding:20px">
        		<font style="color:#0078B7;font-weight: bold;">ST Rank</font>
        		<br><?php if($std_data['st_rank']!=0){echo $std_data['st_rank'];}else{echo '---';} ?>
        	</div>
        </div>
        <div class="col-md-2 col-6 shadow_new">
        	<div class="card card-outline card-primary text-center" style="padding:20px">
        		<font style="color:#0078B7;font-weight: bold;">OBC-A Rank</font>
        		<br><?php if($std_data['obc_a']!=0){echo $std_data['obc_a'];}else{echo '---';} ?>
        	</div>
        </div>
        <div class="col-md-2 col-6 shadow_new">
        	<div class="card card-outline card-primary text-center" style="padding:20px">
        		<font style="color:#0078B7;font-weight: bold;">OBC-B Rank</font>
        		<br><?php if($std_data['obc_b']!=0){echo $std_data['obc_b'];}else{echo '---';} ?>
        	</div>
        </div>
    </div>

    <div class="row">
     		<div class="col-md-12" style="font-size: 18px;color:#246d8a;font-weight:bold;margin-top: 10px;">
     	 		Counseling Status / কাউন্সেলিং অবস্থা
     	 	  </div>
     	  	<div class="col-md-12" style="border-bottom:black solid 4px;margin-top: 15px;margin-bottom: 10px;"></div>
     	</div>

     	<div class="row">
     		<div class="col-md-12">
     			<div class="alert alert-success shadow" style="background-color: #d7fada!important;border: 2px solid black;border-style: dotted;">
     				<hr>
            <center> <strong class="text-black">Registration Status / রেজিস্ট্রেশন অবস্থা :  Registered / নিবন্ধভুক্ত</strong></center>
           </div>
     		</div>
     		<div class="col-md-12">
     			<div class="alert alert-success shadow" style="background-color: #fae6d7!important;border: 2px solid black;border-style: dotted;">
     				<hr>
            <center><strong class="text-black">Choice Filling Status / পছন্দের তালিকা পূরণের অবস্থা :  Not Filled / পূরণ করা হয়নি</strong><br><a href="#" class="alert-link">Click here to fill Choices</a></center>
           </div>
     		</div>
     		<div class="col-md-12">
     			<div class="alert alert-success shadow" style="background-color: #fae6d7!important;border: 2px solid black;border-style: dotted;">
     				<hr>
            <center><strong class="text-black">Payment Status / পেমেন্ট অবস্থা :  Not Paid / পেমেন্ট হয়নি</strong><br><a href="#" class="alert-link">Click here to Payment</a></center>
           </div>
     		</div>
     	</div>



   </div>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>