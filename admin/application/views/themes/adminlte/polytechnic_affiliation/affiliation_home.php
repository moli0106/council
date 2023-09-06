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
	<?php if(!empty($affiliation_data)){?>
	  <div class="border" style="margin:10px 5px 0px 5px;">
		<div class="form-box-header">
		  <h3>Submitted Applications Details</h3>
		</div>
		<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Application No</th>
					<th>Applied for</th>
					<th>Session</th>
					<th>Status of Application</th>                   
					<th>Action to be taken</th>
				</tr>
			</thead>
			<tbody>

			  <?php foreach($affiliation_data as $val) {?>
			  <tr>
				<td><span class="btn btn-warning btn-block btn-xs" style="background-color: #ab0000;"><?php echo $val['application_number'] ;?></span></td>
				<td><?php echo $val['affiliation_type'] ;?></td>
				<td><?php echo $val['affiliation_year'] ;?></td>
				<td>

				  <?php if($val['basic_details_submited_status'] == 1 &&  $val['intake_submited_status'] !=1 &&  $val['infrastructure_fees_submited_status'] !=1 &&  $val['doc_uploaded_status'] !=1 ) {?>
					You are in Step 2: Intake Details
					
					<?php $link_part = "affiliation/intake_details/"; 
				  }elseif ($val['basic_details_submited_status'] == 1 &&  $val['intake_submited_status'] ==1 &&  $val['infrastructure_fees_submited_status'] !=1 &&  $val['doc_uploaded_status'] !=1 ) { ?>
					  You are in Step 3: Infrastructure And Fees 
					<?php $link_part = "affiliation/infrastructure_fees/";
				  }elseif ($val['basic_details_submited_status'] == 1 &&  $val['intake_submited_status'] ==1 &&  $val['infrastructure_fees_submited_status'] ==1 &&  $val['doc_uploaded_status'] !=1 ) { ?>
					You are in Step 4: Documents Upload 
				  <?php  $link_part = "affiliation/documents_upload/";
				 }elseif($val['basic_details_submited_status'] == 1 &&  $val['intake_submited_status'] ==1 &&  $val['infrastructure_fees_submited_status'] ==1 &&  $val['doc_uploaded_status'] ==1 && $val['final_submit_status'] !=1){?> 
					<!-- Form Submission Successful and pending for Inspection & WBSCT&VE&SD Approval -->
          Form filled up is successful and is pending for Affiliation Payment


				  <?php $link_part = "affiliation/affiliation_preview/";
        }elseif($val['basic_details_submited_status'] == 1 &&  $val['intake_submited_status'] ==1 &&  $val['infrastructure_fees_submited_status'] ==1 &&  $val['doc_uploaded_status'] ==1 && $val['final_submit_status'] ==1){?>
          Form Submission Successful
        <?php $link_part = "affiliation/view_all_details/";
      } else{?> 
        You are in Step 1: Basic Details
        <?php  $link_part = "affiliation/basic_details/";
      }?>                
				</td>
				<td colspan="2">
          <?php if($link_part == "affiliation/view_all_details/"){ ?>
            <a href="<?php  echo base_url('admin/polytechnic_affiliation/'.$link_part . md5($val['basic_affiliation_id_pk'])); ?>" class="btn btn-success btn-xs btn-block">View Details
          <?php }else{?>
            <a href="<?php  echo base_url('admin/polytechnic_affiliation/'.$link_part . md5($val['basic_affiliation_id_pk'])); ?>" class="btn btn-warning btn-xs btn-block">Edit
          <?php }?>

          <?php if($val['institute_category_id_fk'] == 4){?>
						<a href="<?php  echo base_url('admin/polytechnic_affiliation/affiliation/view_transaction/'. md5($val['basic_affiliation_id_pk'])); ?>" class="btn btn-warning btn-xs btn-block">Check Transaction Status
				  <?php }?>
				</td>
			  </tr>
			  <?php }?>
			
						
			</tbody>
		</table> 
		</div>
		<table class="table table-bordered">.
			<tr><td><h5 style="font-size: 18px; font-weight: bold; color: #ca0000;">NOTE 1: Send the complete Application Form (in PDF)  to Mail ID- affiliation@wbscte.ac.in for further processing.</h5></td></tr>
			<tr><td><h5 style="font-size: 18px; font-weight: bold; color: #ca0000;">NOTE 2: After payment of requisite fee, applicant has to take printout of the Application Form and has to preserve the same till affiliation process is completed.</h5></td></tr>

		</table>
	  </div>
	<?php }?>

  
	<?php //if($ins_details_id == 4307 || $ins_details_id == 4308 || $ins_details_id == 4309) {?>
  <div class="border" style="margin:10px 5px 0px 5px;">

    <?php if ($this->session->flashdata('status') !== null) { ?>
      <div class="alert alert-<?= $this->session->flashdata('status') ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?= $this->session->flashdata('alert_msg') ?>
      </div>
    <?php } ?>
    <center><h3><b>Application Form for Affiliation or Renewal</b></h3>
    <font color="red"><b>Select a Form for apply (You can fill up multiple Applications from one user account)</b></font></center>

    <!-- Application Form-->

    
    <?php echo form_open_multipart('/admin/polytechnic_affiliation/affiliation') ?>
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Application Form for Affiliation or Renewal </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <div class="row" style="margin-top:10px">
			<div class="col-md-4">
              <label>Select Affiliation New or Renewal *</label>
              <select class="form-control" name="new_renewal" id="new_renewal">
                <option value="">--Select Affiliation New or Renewal--</option> 
                <option value="1">New</option>
                <option value="2">Renewal</option>
             </select>
             <?php echo form_error('new_renewal'); ?>
            </div>
            <div class="col-md-4">
              <label>Select Academic Session *</label>
              <select class="form-control" name="affiliation_year" id="affiliation_year">
                <option value="">--Select Academic Session--</option> 
                <option value="<?php echo $affiliation_year;?>"><?php echo $affiliation_year;?></option>
             </select>
             <?php echo form_error('affiliation_year'); ?>
            </div>


            <div class="col-md-4">
              <label>Select Affiliation Type *</label>
              

              <select name="affiliation_type" class="form-control input-md" id="affiliation_type">
                <option value="">-- Select Affiliation Type --</option>
                <?php foreach($affiliation_type as $val) {?>
                  <option value="<?php echo $val['affiliation_type_id_pk']?>"><?php echo $val['affiliation_type'];?></option>
                <?php }?>
              </select>
              <?php echo form_error('affiliation_type'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Close Application Form-->


    
    <hr>
    <center><button type="submit" name="" class="btn btn-primary"><i class="fa fa-save"></i> Submit & Proceed to Next Step</button></center>
    <?php echo form_close() ?>
  </div>
<?php //}?>
  
</div> 
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>