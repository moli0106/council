<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
  <style type="text/css">
  .alert {
   		    height: 69px;
		    font-size: 22px;
		    padding: 16px 0px 0px 108px;   
		}
/*****success view*****/
.custom_alert_box {
    text-align: center;
    background: #fff;
    width: 50%;
    margin: 10px auto;
    box-shadow: 0px 2px 2px 0px #ccc;
    padding: 30px 0
}
.custom_alert_box i.fa.fa-check-circle {
    color: #00a65a;
    font-size: 40px;
}
.custom_alert_box i.fa.fa-exclamation-circle {
    color: #d61908;
    font-size: 40px;
}
.custom_alert_box h2 {
    font-weight: bold;
    font-size: 26px;
}
.custom_alert_box h3 {
    font-size: 15px;
    font-weight: bold;
    margin: 5px;
}
.custom_create_batch_btn {
    margin: 25px auto;
    text-align: center;
}
.custom_create_batch_btn a{
	padding: 10px 20px;
    font-size: 18px;
}
.ylw{
	font-size:100px;
	color:#ffe082;	
}
/*****success view*****/
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="custom_alert_box">
        	<i class="fa fa-exclamation-triangle ylw"></i>
        	<h2> <?php echo $message;?></h2>
            <h3><?php echo $message_dtls; ?></h3>
        </div>	
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>