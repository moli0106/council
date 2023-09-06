<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style type="text/css">
    input{
       background: rgba(255,255,255,0.4)!important;
       border: none!important;
       box-shadow: none!important;
    }
    .bg-white{
        background-color:white;
    }
    .ov{
        height: 500px;
        overflow: scroll;
    }
    .margin-top{
        margin-top:15px;
    }
  </style>
<div class="container-fluid">
 <div class="content-wrapper">
    <section class="content-header">
        <h1>Student Transfer List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Student Transfer List</li>
        </ol>
    </section>

       <div class="row" style="margin-top:10px">

        <div class="col-sm-12"> 
          <table class="table table-striped bg-white mt-2">
            <thead>
              <tr class="bg-info"> 
                <th>SL</th>
                <th>Student Name</th>
                <th>Transfer Course</th>
                <th>Transfer Institute Name</th>
                <th>Transfer Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="sample_table" style="background-color: white;">
              <?php $s=1;foreach($result as $row){ ?>
              <tr>
                <td><?php echo $s++; ?></td>
                <td><?php echo $row['first_name'] ?> <?php echo $row['middle_name'] ?> <?php echo $row['last_name'] ?></td>
                <td><?php echo $row['course_name'] ?></td>
                <td><?php echo $row['institute_name'] ?></td>
                <td>
                  <?php if( $row['transfer_verify_status']== 1){?>
                      <small class="label label-success">Verified</small>
                  <?php }elseif($row['transfer_verify_status'] == 0) {?>
                    <small class="label label-danger">Rejected</small>
                  <?php }?>
                </td>
                <td>
                <?php if($row['transfer_verify_status'] == '') {?>
                  <button class="btn btn-sm btn-warning approve-reject-modal"  data-id="<?php echo md5($row['institute_student_details_id_fk'])?>" data-toggle="modal" data-target="#approve-reject-modal" title="Appprove or Reject"><i class="fa fa-level-up" aria-hidden="true"></i>Verify/Reject</button>
                <?php }elseif($row['transfer_verify_status'] == 0) {?>
                  <button class="btn btn-sm btn-primary modal-reject-note bg-maroon" data-id="<?php echo md5($row['institute_student_details_id_pk'])?>" data-toggle="modal" data-target="#modal-reject-note" title="View Reject Note"><i class="fa fa-eye" aria-hidden="true"></i>Rejected Note</button>
                <?php }?>
              </tr>
              <?php } ?>
            </tbody>
          </table>
    </div>
           
       </div> 

</div>
</div>



<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<div class="modal modal-info" id="approve-reject-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Student Verify / Reject</h4>
            </div>
            <div class="modal-body approve-reject-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-info fade" id="modal-reject-note" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Show Rejected Notes</h4>
            </div>
            <div class="modal-body reject-note-data" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
                

            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


