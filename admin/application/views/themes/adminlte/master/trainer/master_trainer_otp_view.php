<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>admin/" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trainer OTP</title>
        <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('theme_uri');?>login/fonts/linearicons.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>plugins/iCheck/square/blue.css">
        <script src="<?php echo $this->config->item('theme_uri');?>sha256.js"></script>
        <script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
        <script>
            //alert(sha256(''))
            function encription() {
                if (document.login_form.password.value != '') {
                    
                    var enc2 = sha256(sha256(document.login_form.password.value) + '<?php echo $_SESSION['salt']; ?>') ;
                    document.login_form.password.value = enc2;
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
            /* .login_box a{color:#fff; margin-top:30px; display:block;font-size: 29px;} */
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
                    <!-- <a href="<?php echo base_url(); ?>">Online Assessment System v1.0</a> -->
                </div>
            </div>

            <?php if($status) { ?>
                <div class="login-body">
                    <p class="login-box-msg">Email Comfirmed!</p>
                    
                    <?php 
                        if($this->session->flashdata('alert_msg') !== null) 
                            echo '<p class="text-danger text-center">'.$this->session->flashdata('alert_msg').'</p>';
                    ?>
            
                    <p class="text-justify">
                        We have sent you an otp on registered mobile number <i>xxx xxx x<?php echo substr($trainer['mobile'], -3); ?></i>.
                    </p>
            
                    <?php echo form_open('admin/master/verify_trainer/email/'.$id_hash, array('class' => 'login_form')); ?>
                    
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="otp" value="<?php echo set_value('login_id'); ?>" placeholder="Enter OTP">
                            <span class="fa fa-key form-control-feedback"></span>
                            <?php echo form_error('otp'); ?>
                        </div>
                
                        <div class="form-group has-feedback"></div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block">
                                    Confirm OTP
                                </button>
                            </div>
                        </div>
                    </form>
            
                    <p>
                        <br>
                        Resend OTP
                        <a href="<?=base_url('admin/master/verify_trainer/email/'.$this->session->id_hash)?>">Click here</a>
                    </p>
                
                </div>
            <?php } else { ?>
                <div class="login-body">
                    <p class="login-box-msg text-warning"><?php echo $msg; ?>!</p>
                </div>
            <?php } ?>
  
            <div class="clearfix"></div>
        </div>

        <script src="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo $this->config->item('theme_uri');?>login/js/main.js"></script>
        <script src="<?php echo $this->config->item('theme_uri');?>login/login.js"></script>

    </body>
</html>
