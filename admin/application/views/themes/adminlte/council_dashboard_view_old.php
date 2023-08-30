<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

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
.ylw{
	font-size:100px;
	color:#ffe082;	
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dashboard
        <!-- <small>it all starts here</small>-->
      </h1>
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
	// else if($stake_id == 2)
	// {
	// 	$this->load->view($this->config->item('theme').'dashboard/main_view',$data_rec);
		
	// }
	
	// else if($stake_id == 3)
	// { 
	// 	$this->load->view($this->config->item('theme_uri').'dashboard/teacher_main_view',$data_rec);
		
	// }

	?>
      <!-- /.row -->
      <!-- Info boxes -->
      <div class="row">
      
      </div>
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
