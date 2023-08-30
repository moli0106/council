<!DOCTYPE html>
<html>
<head>
<base href="<?php echo base_url(); ?>admin/student_login" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Panel</title>
<link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('theme_uri');?>login/fonts/linearicons.css">
<link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>plugins/iCheck/square/blue.css">
<script src="<?php echo $this->config->item('theme_uri');?>sha256.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>assets/js/sweetalert.js"></script>
<script>
	//alert(sha256(''))
		function encription() {
		if (document.login_form.psw.value != '') {
			
			var enc2 = sha256(sha256(document.login_form.psw.value) + '<?php echo $_SESSION['salt']; ?>') ;
			document.login_form.psw.value = enc2;
		}
	}
</script>

  <style>
   
  .login-page, .register-page {
    	background:url(<?php echo $this->config->item('theme_uri');?>custom/website-admin-background.jpg) no-repeat center center fixed;
		background-size:cover;
		width:100%;
		height:auto;
	}
	.login-logo, .register-logo{ margin-bottom:0;}
	.admin-img img{ height:100px;}
	.login-logo a, .register-logo a {
		color: #0576d8;
		font-weight: bold;
	}
	
	.mt10{ margin-top:10px;}
	.login_box .form-control{border: none;border-bottom:#c8c8c8 1px solid;padding-left: 0;}
	.login_btn {text-align: center;}
	.login_btn_main {width: 30%; display: inline-block; margin-left: 5px;}
	.login_btn_main .btn.btn-flat {
		border-radius: 5px;
		padding: 8px 10px;	
	}
	.btn-success{background:#4cae4c; border:0;transition: all 0.4s;}
	.btn-success:hover {background:#379137;}
	.btn-primary{background:#0576d8; border:0;transition: all 0.4s;}
	.btn-primary:hover {background:#0363b6;}
	
	.login_box .form-control:focus {
		border-bottom:1px solid #0576d8;
		-webkit-transition: all 0.4s;
		-o-transition: all 0.4s;
		-moz-transition: all 0.4s;
		transition: all 0.4s;
	}
	.login_box { width:600px; height: 420px; margin:80px auto;box-shadow: 2px 3px 3px rgba(0,0,0,0.4); -webkit-box-shadow: 2px 3px 3px rgba(0,0,0,0.4); -moz-box-shadow: 2px 3px 3px rgba(0,0,0,0.4); -o-box-shadow: 2px 3px 3px rgba(0,0,0,0.4);border-radius:10px;}
	
	.card-heading {
		background:#0576d8;
		width: 50%;
		height:100%;
		float:left;
		padding: 28px 50px;
		border-top-left-radius:10px;
		border-bottom-left-radius:10px;
	}
	.login-body {
		background:#fff;
		width: 50%;
		height:100%;
		float:left;
		padding:41px 12px;
		border-top-right-radius:10px;
		border-bottom-right-radius:10px;
	}
	
	.login-box-msg, .register-box-msg {
		font-size: 20px;
		font-weight: 600;
	}
	.clearfix { clear:both; margin:0; padding:0;}
	.form-control-feedback { color:#c8c8c8;font-size: 18px;}
	.login_btn_main .icon {margin-right:4px;}
	
	@media only screen 
and (min-width: 360px)
and (max-width: 767px) {
	.card-heading {padding: 26px 50px;}
	.card-heading, .login-body {float:none; margin:auto; width:100%;height: auto;border-radius:0;}
	.login_box { width:90%; height: auto;}
}
.captcha-refresh {
    font-size: 20px;
    cursor: pointer;
    margin-top: 10px;
    display: inline-block;
}
  </style>
</head>

<body class="hold-transition login-page">

<div class="login_box">
  <div class="card-heading">
    <div class="login-logo">
    <div class="admin-img">
        <img src="<?php echo $this->config->item('theme_uri');?>custom/council_logo.png"/>
    </div>
	<div style="font-size:20px;color:white;font-weight: bold;">
	West Bengal State Council of Technical and Vocational Education and Skill Development
	</div>
	<!--<div style="font-size:18px;color:#952323;;font-weight: bold;">
	The portal will be under maintenance during the period 15:00 Hrs. - 18:00 Hrs. on 11<sup style="color:#952323;">th</sup> August, 2021.
	</div>-->
    <!-- <a href="<?php echo base_url(); ?>">Online Assessment System v1.0</a> -->
    </div>
  </div>
  <div class="login-body">
  <?php //echo "hii"; echo $stdLoginId;exit; ?>
         <p class="login-box-msg">Login</p>
  <?php echo (isset($error_message)) ? $error_message : "";?>

  <?php if($stdLoginId == ''){?>
    <?php echo form_open('admin/student_login',array('class' => 'login_form','name' => 'login_form', 'id' => 'login_form','autocomplete'=>'off','onsubmit'=>'return encription()')); ?>
      <input type="hidden" name="security_code" value="<?php echo hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key')) ?>">
      	<div class="form-group has-feedback">
			<input type="text" class="form-control" id="std_aadhar_no" name="login_id" value="<?php echo $stdLoginId; ?>" placeholder="aadhar number">
			<span class="fa fa-user form-control-feedback"></span>
			<?php echo form_error('login_id'); ?>
       	</div>

		<?php //if()?>
		<div class="form-group has-feedback">
			<input type="text" class="form-control" id="mob_no" name="mobile_no" value="" placeholder="Mobile No" readonly>
			<span class="fa fa-user form-control-feedback"></span>
			<?php echo form_error('mobile_no'); ?>
       	</div>

		<div class="after_otp_div" style="display:none">
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="psw" value="<?php echo $stdLoginpsw; ?>" placeholder="Password">
				<span class="fa fa-lock form-control-feedback"></span>
				<?php echo form_error('psw'); ?>
			</div>
			<div class="form-group has-feedback">
				<div class="row">
					<div class="col-xs-5 captcha_img">
						<?php echo $cap['image']; ?>
					</div>
			
					<!-- <div class="col-md-1">
						<span class="lnr lnr-sync captcha-refresh" id="loadCaptcha" ></span>
					</div> -->

					<div class="col-xs-5">
						<input type="text" class="form-control" name="captcha" placeholder="Captcha">
						<?php echo form_error('captcha'); ?>
					</div>
				</div>
		
      		</div>
		
      	
			<div class="row">
				<div class="login_btn">
					<div class="login_btn_main">
					</div>
					<div class="login_btn_main">
					<button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-unlock-alt icon" aria-hidden="true"></i>  Login</button>
					</div><br>
				
				</div>
				<!-- /.col -->
			</div>
		</div>

		
    </form>

	<div class="row send_otp_div_class">
		<div class="login_btn">
			
			<div class="login_btn_main">
			<button type="submit" class="btn btn-success btn-block btn-flat send_otp_btn"><i class="fa fa-unlock-alt icon" aria-hidden="true"></i>Send OTP</button>
			</div><br>
		
		</div>
		<!-- /.col -->
	</div>
	<?php }else{?>

		<?php echo form_open('admin/student_login',array('class' => 'login_form','name' => 'login_form', 'id' => 'login_form','autocomplete'=>'off','onsubmit'=>'return encription()')); ?>
			<input type="hidden" name="security_code" value="<?php echo hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key')) ?>">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" id="std_aadhar_no" name="login_id" value="<?php echo $stdLoginId; ?>" placeholder="aadhar number">
				<span class="fa fa-user form-control-feedback"></span>
				<?php echo form_error('login_id'); ?>
			</div>

		
		
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="psw" value="<?php echo $stdLoginpsw; ?>" placeholder="Password">
				<span class="fa fa-lock form-control-feedback"></span>
				<?php echo form_error('psw'); ?>
			</div>
			<div class="form-group has-feedback">
				<div class="row">
					<div class="col-xs-5 captcha_img">
						<?php echo $cap['image']; ?>
					</div>
			
					<!-- <div class="col-md-1">
						<span class="lnr lnr-sync captcha-refresh" id="loadCaptcha" ></span>
					</div> -->

					<div class="col-xs-5">
						<input type="text" class="form-control" name="captcha" placeholder="Captcha">
						<?php echo form_error('captcha'); ?>
					</div>
				</div>
		
      		</div>
		
      	
			<div class="row">
				<div class="login_btn">
					<div class="login_btn_main">
					</div>
					<div class="login_btn_main">
					<button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-unlock-alt icon" aria-hidden="true"></i>  Login</button>
					</div><br>
				
				</div>
				<!-- /.col -->
			</div>

		
    	</form>
	<?php }?>
	<!-- <p>
		<br>
		Forgot your password?
		<a href="<?=base_url('admin/password/forgot_password')?>">click here.</a>
	</p> -->
  </div>
  <div class="clearfix"></div>
</div>

<script>
	$(document).on('blur', '#std_aadhar_no', function() {
		// alert("hii");exit;
		var adharNum = $(this).val();
		
		// alert(adharNum);
		if (adharNum != '') {
			Swal.fire({
				title: 'Please wait a moment!',
				html: 'We\'ll collecting the data.',
				allowEscapeKey: false,
				allowOutsideClick: false,
				didOpen: () => {
					Swal.showLoading();

					setTimeout(function() {

						$.ajax({
								url: "student_login/getDetailsByAdharNum/" + adharNum,
								type: 'GET',
								dataType: "json"
							})
							.done(function(res) {
								if (res != '') {
									$('#mob_no').val(res.mobile_number);
									Swal.close();
								} else {
									
									$('#mob_no').val('');
									
									Swal.fire('Warning!', 'You are not Affiliated, Please contact Council Administration.', 'warning');
								}
							})
							.fail(function(res) {
								
								$('#mob_no').val('');
								Swal.fire('Warning!', 'Data not found', 'warning');
							});

					}, 100);
				}
			});
		}
	});

	$(document).on('click', '.send_otp_btn', function(){
		// alert ('hii');
		$('.send_otp_div_class').hide();
		$('.after_otp_div').css("display", "block");
		var std_aadhar_no = $('#std_aadhar_no').val();
		var mob_no = $('#mob_no').val();
		if(std_aadhar_no == '' && mob_no == ''){
			Swal.fire('Warning!', 'Please fill up all mandatory field.', 'warning');
		}else{

			Swal.fire({
				title: 'Please wait a moment!',
				html: 'We\'ll collecting the data.',
				allowEscapeKey: false,
				allowOutsideClick: false,
				didOpen: () => {
					Swal.showLoading();

					setTimeout(function() {

						$.ajax({
								url: "student_login/setOneTimePassword",
								type: 'GET',
								dataType: "json",
								data: {std_aadhar_no : std_aadhar_no, mob_no:mob_no}
							})
							.done(function(res) {
								if (res == 'done') {
									
									
									Swal.fire('success', 'Your Otp send on this above mobile number', 'success');
								}
							})
							.fail(function(res) {
								
								
								Swal.fire('Warning!', 'Something Went Wrong', 'warning');
							});

					}, 100);
				}
			});

		}
	});
</script>

<script src="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	 
	<script src="<?php echo $this->config->item('theme_uri');?>login/js/main.js"></script>
	<script src="<?php echo $this->config->item('theme_uri');?>login/login.js"></script>
</body>
</html>

