<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>

<style type="text/css">
  .custom_alert_box {
    text-align: center;
    background: #fff;
    width: 80%;
    margin: 10px auto;
    padding: 30px 0
  }

  .custom_alert_box h2 {
    font-weight: bold;
    font-size: 26px;
  }

  .ylw {
    font-size: 100px;
    color: #ffe082;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard</h1>
    <ol class="breadcrumb">
      <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    <?php
    //print_r($_SESSION);
    $stake_id = $this->session->userdata('stake_id_fk');

    

    // if($stake_id == 1)
    // { 
    // 	$this->load->view($this->config->item('theme_uri').'dashboard/admin_main_view',$data_rec);

    // }
    if ($stake_id == 2) {
      $this->load->view($this->config->item('theme') . 'dashboard/sao_main_view');
    }

    if ($stake_id == 3) {
      $this->load->view($this->config->item('theme') . 'dashboard/assessor_dashboard_view');
    }

    if ($stake_id == 22) {
      $this->load->view($this->config->item('theme') . 'dashboard/cssvse_dashboard_view');
    }

      // Added By Moli on 16-09-2022
      if($stake_id == 15){
        $udise_code_status = $vtcUdiseCode['udise_code_status'];
      }else{
        $udise_code_status = '';
      }

      //added by moli on 29-06-2023
      if($stake_id == 29){
        $counselling_updated_status = $std_status['counselling_updated_status'];
        $final_allotment = $std_status['final_allotment'];
        if($counselling_updated_status != 1){
          //$this->load->view($this->config->item('theme') . 'dashboard/std_profile_view');
        }
      }
    ?>
    <!-- /.row -->
    <div class="row">

    <?php if($udise_code_status != ''){?>
      <?php if($udise_code_status == 0){?>
        <div class="col-md-10 col-md-offset-1">
          <div class="alert alert-warning alert-dismissible">
              <h4></h4>
              You have no UDISE CODE
              
          </div>
        </div>
      <?php }elseif($udise_code_status == 1){?>
        <div class="col-md-10 col-md-offset-1">
          <div class="alert alert-warning alert-dismissible">
              <h4></h4>
              Your UDISE CODE Is : <?php echo $vtcUdiseCode['udise_code'];?>
              
          </div>
        </div>
      <?php }}?>

    <input type="hidden" id="vtcStakeIdForUdise" value="<?php echo $stake_id;?>">
    <input type="hidden" id="vtc_udise_code_status" value="<?php echo $udise_code_status ;?>">

    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

  

</div>
<!-- /.content-wrapper -->



<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>

<div class="modal modal-info fade" id="vtc-udise-modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
                <h4 class="modal-title">Update UDISE Code</h4>
            </div>
            <div class="modal-body" id="custom-scrollbar" style="background-color: #ecf0f5 !important; color: #000 !important; font-size: 13px; max-height: 75vh; overflow-y: scroll;">
            
              <?php echo form_open("admin/dashboard/updateVTCUdiseCode", array("id" => "dashboard_vtc_udise_form")); ?>
              <div class="row">

                <input type="hidden" name="vtc_id_pk" value="<?php echo $this->session->userdata('stake_details_id_fk');?>">
                <div class="col-md-6">
                    <span>
                        Have you UDISE Code? (Y/N)
                        <span class="text-danger">*</span>
                        <?php echo form_error('have_udise'); ?>
                    </span>
                </div>

                <div class="col-md-6">
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="have_udise"  value="1" <?php echo set_radio('have_udise', 1) ?>> Yes
                    </label>
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="have_udise"  value="0" <?php echo set_radio('have_udise', 0) ?>> No
                    </label>
                  </div>
                  
                </div>

              </div> 

              <div class="row entry_udise_div" style="display:none">

                <div class="col-md-10">
                  <div class="form-group">
                    <label class="" for="">UDISE Code : </label>

                    <input type="number" value="<?php echo set_value("udise_code"); ?>" name="udise_code" id="udise_code" class="form-control"  placeholder="UDISE Code">
                  </div>
                 <?php echo form_error('udise_code'); ?>
                </div>
                

              </div> 

              <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <button  type="button" value="submit" class="btn btn-success btn-block upd_udise_btn">Update Udise Code</button>
                </div>
              </div>
                

            </div>
            <?php echo form_close() ?>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>



<script type="text/javascript">
  $(window).on('load', function() {
    var stake_id = $('#vtcStakeIdForUdise').val();
    var udise_code_status = $('#vtc_udise_code_status').val();
    // alert((udise_code_status));
    if(stake_id == '15'  && udise_code_status == '' ){

      $('#vtc-udise-modal').modal('show');
    }else{
      $('#vtc-udise-modal').modal('hide');
    }
  });

  $('input:radio[name="have_udise"]').change(function() {
      if ($(this).val() == 1) {
          $('.entry_udise_div').show();
      } else {
          $('.entry_udise_div').hide();
          $('#udise_code').val('');
      }
  });

  $(document).on('click', '.upd_udise_btn', function(e) {

    var have_udise = $('input[name="have_udise"]:checked').val();
    var udise_code = $('#udise_code').val();
    // alert(typeof(have_udise));
    // alert(udise_code);
    e.preventDefault();
    var error = 0;
    
    if(have_udise == undefined){

      Swal.fire('Please select radio button');
      error = 1;
    }else if(have_udise == 1){
      
      if(udise_code == ''){

        Swal.fire('Please enter udise code');
        error = 2;
      }

    }
    if(error == 0) {

      Swal.fire({
          title: 'Warning!<br>Are you sure? You want to add udise code.',
          text: "You will not able to revert it back.",
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Do it!',
          allowEscapeKey: false,
          allowOutsideClick: false
      }).then((result) => {

          if (result.isConfirmed) {
              $("#dashboard_vtc_udise_form").submit();

          }
      })
    } 

    });
</script>

