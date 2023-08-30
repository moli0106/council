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

    <?php if ($this->session->flashdata('status') !== null) { ?>
      <div class="alert alert-<?= $this->session->flashdata('status') ?>">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?= $this->session->flashdata('alert_msg') ?>
      </div>
    <?php } ?>
    <center>
      <h3><b>Application Form for Affiliation or Renewal</b></h3>
      <font color="#246d8a">
        <h4><b><?php echo $affiliation_data['affiliation_type']; ?> (Academic Session <?php echo $affiliation_year;?>)</b></h4>
      </font>
    </center>

    <!-- Application Form-->

    
    <?php echo form_open_multipart('/admin/polytechnic_affiliation/affiliation') ?>
    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Institute's Basic Details </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <div class="row" style="margin-top:10px">
            <div class="col-md-12">
              
              <table class="table table-borderless text-left">
                <thead>
                  <tr>
                    <th>Name of the Institute</th>
                    <td><?php echo $ins_details['institute_name'] ?></td>
                  </tr>
                  <tr>
                    <th>Institute's Email Id </th>
                    <td><?php echo $ins_details['institute_email'] ?></td>
                  </tr>
                  <tr>
                    <th>Institute's Primary Contact Number </th>
                    <td><?php echo $affiliation_data['mobile_no_1'] ?></td>
                  </tr>
                  <tr>
                    <th>Institute Type </th>
                    <td><?php echo $affiliation_data['category_name'] ?></td>
                  </tr>
                  </tr>
                </thead>
              </table>

            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Close Application Form-->


    <div class="shadow" style="margin-top:10px">
      <div class="card border-primary">
        <div style="font-size: 18px;color:#246d8a;font-weight:bold;"> Submission / Processing Details </div>
        <div class="col-md-12" style="border-bottom:black solid 1px;margin-top: 15px;margin-bottom: 10px;border-style: dotted;"></div>
        <div class="card-body">
          <div class="row" style="margin-top:10px">
            <div class="col-md-12">
              
              <table class="table table-borderless text-left">
                <thead>
                  <tr class="bg-primary">
                    <th>Activity / Status</th>
                    <th>Status Description</th>
                    <!--th>Date</th-->
                    <th>Downloads</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Form Submission Status</td>
                    <td>Form Submitted Successfully</td>
                    <!--td>2023-07-04 12:52:41</td-->
                    <td>
                      <a href="<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_form/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download Application Form</a>
                      &nbsp;<a href="<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/1/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-download"></i> AICTE Approval File</a>
                      &nbsp;<a href="<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/2/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> WBSCT&VE&SD Approval File</a>
					  
					  <?php if($affiliation_data['land_doc_file'] != null || $affiliation_data['land_doc_file'] != ''){?>
						&nbsp;<a href="<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/3/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Land Doc File</a>
					  <?php }?>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td>Inspection Status</td>
                    <td>Approved</td>
                    <td>2023-07-04 12:52:41</td>
                    <td><a href="#" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a></td>
                  </tr>
                  <tr>
                    <td>WBSCT&VE&SD Approval Status</td>
                    <td>Approved</td>
                    <td>2023-07-04 12:52:41</td>
                    <td><a href="#" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Download</a></td>
                  </tr> -->
                </tbody>
              </table>

            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Close Application Form-->


    
    <hr>
    <center><a href="<?php echo base_url('admin/polytechnic_affiliation/affiliation/'); ?>" class="btn btn-primary"><i class="fa fa-reply"></i> Back to Homepage</a></center>
    <?php echo form_close() ?>
  </div>
</div> 
<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>