<div class="row" style="margin-left:5px;">
    <div class="col-md-2 btn btn-<?php if($active_class == 'basicDetails'){echo 'success';}else{echo 'warning';} ?> ckborder">
        <a  style="color:#fff;!important" href="<?php  echo base_url('admin/polytechnic_affiliation/affiliation/basic_details/' . md5($affiliation_data['basic_affiliation_id_pk'])); ?>">
            <i class="fa fa-university"></i> Institute Basic Details
        </a>
    </div>

    <div class="col-md-2 btn btn-<?php if($active_class1 == 'intakeStaff'){echo 'success';}else{echo 'warning';} ?> ckborder">
        <?php if($active_class == 'basicDetails') {?>
            <a style="color:#fff;!important"  href="<?php  echo base_url('admin/polytechnic_affiliation/affiliation/intake_details/' . md5($affiliation_data['basic_affiliation_id_pk'])); ?>">
                <i class="fa fa-users"></i> Intake & Faculty Details  
            </a>
        <?php }else{?>
            <i class="fa fa-users"></i> Intake & Faculty Details
        <?php }?> 
    </div>

    <div class="col-md-2 btn btn-<?php if($active_class2 == 'infra_fees'){echo 'success';}else{echo 'warning';} ?> ckborder">

        <?php if($active_class1 == 'intakeStaff') {?>
            <a style="color:#fff;!important"  href="<?php  echo base_url('admin/polytechnic_affiliation/affiliation/infrastructure_fees/' . md5($affiliation_data['basic_affiliation_id_pk'])); ?>">
            <i class="fa fa-bars"></i> Infrastructure & Fees  
            </a>
        <?php }else{?>
            <i class="fa fa-bars"></i> Infrastructure & Fees 
        <?php }?>
        
    </div>


    <div class="col-md-2 btn btn-<?php if($active_class3 == 'doc_upload'){echo 'success';}else{echo 'warning';} ?> ckborder">

        <?php if($active_class2 == 'infra_fees') {?>
            <a style="color:#fff;!important"  href="<?php  echo base_url('admin/polytechnic_affiliation/affiliation/documents_upload/' . md5($affiliation_data['basic_affiliation_id_pk'])); ?>">
            <i class="fa fa-upload"></i> Upload Documents  
            </a>
        <?php }else{?>
            <i class="fa fa-upload"></i> Upload Documents 
        <?php }?>
         
    </div>
    <div class="col-md-2 btn btn-warning ckborder">
        <?php if($active_class3 == 'doc_upload') {?>
            <a style="color:#fff;!important"  href="<?php  echo base_url('admin/polytechnic_affiliation/affiliation/affiliation_preview/' . md5($affiliation_data['basic_affiliation_id_pk'])); ?>">
            <i class="fa fa-eye"></i> Preview Application  
            </a>
        <?php }else{?>
            <i class="fa fa-eye"></i> Preview Application 
        <?php }?>
         
    </div>
</div>