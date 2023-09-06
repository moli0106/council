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
    <?php echo $affiliation_data['affiliation_type']; ?> (Academic Session <?php echo $affiliation_year;?>)</h4>
   </center>
   <hr>
   <?php $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/common_view')?>

    <?php if ($this->session->flashdata('status') !== null) { ?>
           <div class="alert alert-<?= $this->session->flashdata('status') ?>" style="margin-top: 10px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= $this->session->flashdata('alert_msg') ?>
            </div>
      <?php } ?>

    <!-- Start Academic Programme-->
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Ongoing Academic Programme </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <?php echo form_open_multipart('/admin/polytechnic_affiliation/affiliation/documents_upload/'.md5($affiliation_data['basic_affiliation_id_pk']))?>
          <div class="row" style="margin-top:10px">
            <div class="col-md-4">
              <label>Upload Approval Letter from (AICTE / PCI / COA) *</label><br>
              <font color="red"><strong>Maximum size : 512 KB (.pdf Only)</strong></font>
            </div>
            <div class="col-md-4">
              <input type="file" id="file1" placeholder="Enter Regular Faculties" class="form-control required" required accept="application/pdf">
              <input type="hidden" id="textArea" name="file1">

            </div>

            <div class="col-md-4">
              <?php if($affiliation_data['aicte_approval_file'] != ''){ ?>
             <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/1/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
             <?php } ?>
            </div>
          </div>
          <?php if($affiliation_data['institute_category_id_fk'] == 4) {?>
            <div class="row" style="margin-top:10px">
              <div class="col-md-4">
                <label>Upload last (Affiliation Letter / NOC) from WBSCT&VE&SD  *</label><br>
                <font color="red"><strong>Maximum size : 512 KB (.pdf Only)</strong></font>
              </div>
              <div class="col-md-4">
                <input type="file" id="file2"  placeholder="Enter Regular Faculties" class="form-control"  accept="application/pdf">
                <input type="hidden" id="textArea2" name="file2">
              </div>
              <div class="col-md-4"> 
                <?php if($affiliation_data['wbsct_affiliation_file'] != ''){ ?>
              <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/2/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
              <?php } ?>
              </div>
            </div>

          
            <div class="row" style="margin-top:10px">
              <div class="col-md-4">
                <label>Area of Campus (in acres)  *</label><br>
              </div>
              <div class="col-md-4">
                <input type="number" step="0.01" name="campus_area"  placeholder="Area of Campus" class="form-control">
                
              </div>
              
            </div>

            <div class="row" style="margin-top:10px">
              <div class="col-md-4">
                <label>Upload Land Document  *</label><br>
                <font color="red"><strong>Maximum size : 200 KB (.pdf Only)</strong></font>
              </div>
              <div class="col-md-4">
                <input type="file" id="file3"  placeholder="Enter Regular Faculties" class="form-control" accept="application/pdf">
                <input type="hidden" id="textArea3" name="file3">
              </div>
              <div class="col-md-4"> 
                <?php if($affiliation_data['land_doc'] != ''){ ?>
              <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/3/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
              <?php } ?>
              </div>
            </div>
          <?php }?>

          <div class="row">
            <div class="col-md-12" style="padding: 10px;">
              <center><button type="submit" id="upload_file_btn" name="" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button></center>
            </div>
          </div>
 
          <?php echo form_close(); ?>

        </div>
      </div>
    </div>

    <!-- End Academic Programme-->
    
    <hr>
     <?php if($affiliation_data['aicte_approval_file'] != NULL && $affiliation_data['wbsct_affiliation_file'] != NULL){ ?>
	 <?php echo form_open_multipart('/admin/polytechnic_affiliation/affiliation/submit_information/'.md5($affiliation_data['basic_affiliation_id_pk']))?>
		<div class="row" style="margin-top:10px">
		  <div class="col-md-12">
			<label>Additional Information</label>
			<textarea class="form-control" name="additional_info" placeholder="Enter Additional Information"><?php echo $affiliation_data['additional_info'];?></textarea>
			
		  </div>
		</div><br>

		<div style="text-align:right;">
		  <button type="submit" name="" class="btn btn-primary"><i class="fa fa-save"></i> Submit & Proceed to Next Step</button>
		</div>
	  <?php echo form_close(); ?>
    
    <?php } ?>
  </div>
</div> 


<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>
