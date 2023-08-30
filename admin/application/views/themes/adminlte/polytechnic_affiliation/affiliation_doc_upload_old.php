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
    Hotel Management & Catering Technology (HMCT) (Academic Session 2022-2023)</h4>
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
              <label>Upload Approval Letter from All India Council for Technical Education (AICTE) *</label><br>
              <font color="red"><strong>Maximum size : 1 MB (.pdf Only)</strong></font>
            </div>
            <div class="col-md-4">
              <input type="file" name="file1" placeholder="Enter Regular Faculties" class="form-control required" required accept="application/pdf">
            </div>
            <div class="col-md-4">
              <?php if($affiliation_data['aicte_approval_file'] != ''){ ?>
             <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/1/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
             <?php } ?>
            </div>
          </div>

          <div class="row" style="margin-top:10px">
            <div class="col-md-4">
              <label>Upload last Affiliation Letter from WBSCT&VE&SD  *</label><br>
              <font color="red"><strong>Maximum size : 500 KB (.pdf Only)</strong></font>
            </div>
            <div class="col-md-4">
              <input type="file" name="file2" placeholder="Enter Regular Faculties" class="form-control required" required accept="application/pdf">
            </div>
            <div class="col-md-4"> 
              <?php if($affiliation_data['wbsct_affiliation_file'] != ''){ ?>
             <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/2/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
             <?php } ?>
            </div>
          </div>

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
    <div style="text-align:right;">
      <button  name="" class="btn btn-primary">
        <a href="<?php  echo base_url('admin/polytechnic_affiliation/affiliation/affiliation_preview/' . md5($affiliation_data['basic_affiliation_id_pk'])); ?>">

          <i class="fa fa-save"></i> Submit & Proceed to Next Step
        </a>
      </button>
    </div>
    <?php } ?>
  </div>
</div> 
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>