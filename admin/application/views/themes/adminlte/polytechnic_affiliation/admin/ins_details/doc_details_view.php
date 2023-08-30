<div class="box box-success" style="padding: 2px 8px 8px 8px;">
    <div class="box-header with-border">
        <h3 class="box-title">Uploaded Documents</h3>
        <div class="box-tools pull-right"></div>
    </div>
    <div class="box-body">
    <div class="row">
        <div class="col-xs-12 table-responsive">
           
            
        <div class="row" style="margin-top:10px">
            <div class="col-md-4">
              <label>Upload Approval Letter from All India Council for Technical Education (AICTE)</label><br>
            </div>
            
            <div class="col-md-4">
              <?php if($affiliation_data['aicte_approval_file'] != ''){ ?>
             <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/1/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
             <?php } ?>
            </div>
          </div>

          <div class="row" style="margin-top:10px">
            <div class="col-md-4">
              <label>Upload last Affiliation Letter from WBSCT&VE&SD </label><br>
              
            </div>
         
            <div class="col-md-4"> 
              <?php if($affiliation_data['wbsct_affiliation_file'] != ''){ ?>
             <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/2/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
             <?php } ?>
            </div>
          </div>
          
          <?php if($affiliation_data['institute_category_id_fk'] == 4) {?>
            <div class="row" style="margin-top:10px">
              <div class="col-md-4">
                <label>Area of Campus (in achor)</label><br>
              </div>
              <div class="col-md-4">
                <input type="number" step="0.01" name="campus_area"  placeholder="Area of Campus" class="form-control">
                
              </div>
              
            </div>

            <div class="row" style="margin-top:10px">
              <div class="col-md-4">
                <label>Upload Land Document</label><br>
                
              </div>
              
              <div class="col-md-4"> 
                <?php if($affiliation_data['land_doc'] != ''){ ?>
              <a href='<?php echo base_url('admin/polytechnic_affiliation/affiliation/download_uploaded_pdf/3/' .md5($affiliation_data['basic_affiliation_id_pk'])); ?>' target="_blank" class="btn btn-info btn-sm"><i class='fa fa-download'></i>Download</a>
              <?php } ?>
              </div>
            </div>
          <?php }?>
                
            
        </div>
    </div>
    </div>
</div>