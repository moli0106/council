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
        <h1>Verified Student List</h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><i class="fa fa-align-center"></i> Verified Student List</li>
        </ol>
    </section>

       <div class="row" style="margin-top:10px">

        <div class="col-sm-12"> 
          <table class="table table-striped bg-white mt-2">
            <thead>
              <tr class="bg-info"> 
                <th>SL</th>
                <th>Student Name</th>
                <th>Transfer From (Institute)</th>
                <th>Transfer From (Course)</th>
                <th>Transfer To (Course)</th>
                <th>Admitted Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="sample_table" style="background-color: white;">
              <?php $s=1;foreach($result as $row){ ?>
              <tr>
                <td><?php echo $s++; ?></td>
                <td><?php echo $row['first_name'] ?> <?php echo $row['middle_name'] ?> <?php echo $row['last_name'] ?></td>
                <td><?php echo $row['transfer_from'] ?> [<?php echo $row['vtc_code'] ?>]</td>
                <td><?php echo $row['transfer_from_course'] ?></td>
                <td><?php echo $row['transfer_to_course'] ?></td>
                <td>
                  <?php if( $row['transfer_admitted_status']!= 1){?>
                      <small class="label label-success">Admitted</small>
                  <?php }else{?>
                    
                  <?php }?>
                </td>
                <td>
                <?php if($row['transfer_admitted_status'] != '') {?>

                    <!-- <button class="btn btn-sm btn-danger changeStatus"   data-name="Deactivate">
								<i class="fa fa-power-off" aria-hidden="true"></i>
							</button> -->
                  <button class="btn btn-sm btn-warning std_admit_btn"  data-id="<?php echo md5($row['institute_student_details_id_pk'])?>"  title="Admit"><i class="fa fa-level-up" aria-hidden="true"></i>Admit</button>
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






