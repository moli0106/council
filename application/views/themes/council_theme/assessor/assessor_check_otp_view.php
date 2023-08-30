<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">Online Application</h2>
                    <ol class="breadcrumb">
                       
                        <li class="breadcrumb-item active">Assessor / Expert registration form</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<style>
.course_sector_block, .work_exp_section, .experience_section, .agency_section{
    padding:10px 0px 10px 0px;
    margin-bottom:10px;
    border:2px solid #CCC;
}
</style>
    <div class="container">

        <h3>OTP Verification</h3><hr>

        <?php if(isset($success)) { ?>
            
            <div class="alert alert-<?php echo $success ?>">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo $message ?>
            </div>
            
        <?php } else { ?>
        <form action="" method="POST" class="" role="form">
        <?php echo form_open_multipart("assessor/assessor_reg",array("id" => "basic_assessor_reg_form"));?>
        <input type="hidden" name="token" value="<?php echo $captcha['word'] ?>">
        <input type="hidden" name="full_name" value="<?php echo $assessor[0]['salutation_desc'] ?> <?php echo $assessor[0]['fname'] ?> <?php echo $assessor[0]['mname'] ?> <?php echo $assessor[0]['lname'] ?>">

        
            <br>
            <h4>Basic Information</h4><hr>
           <table class="table table-hover">

               <tbody>
                    <tr>
                       <th>Full Name</th>
                       <td><?php echo $assessor[0]["salutation_desc"] ?> <?php echo $assessor[0]["fname"] ?> <?php echo $assessor[0]["mname"] ?> <?php echo $assessor[0]["lname"] ?></td>
                       <th>Gender</th>
                       <td><?php echo $assessor[0]["gender_description"] ?></td>

                   </tr>
                   <tr>
                       <th>D.O.B</th>
                       <td><?php echo $assessor[0]["dob"] ?></td>
                       <th><?php echo $assessor[0]["id_type_name"] ?></th>
                       <td><?php echo $assessor[0]["id_no_alt"] ?></td>
   
                   </tr>
                   <tr>
                       <th>Landline No</th>
                       <td><?php echo $assessor[0]["landline_no"] == NULL ? "N/A" : $assessor[0]["landline_no"]?></td>
                       <th>Mobile No.</th>
                       <td><?php echo $assessor[0]["mobile_no"] ?></td>
                   </tr>
                   <tr>
                       <th>Email ID</th>
                       <td><?php echo $assessor[0]["email_id"] ?></td>
                       <th>PAN</th>
                       <td><?php echo $assessor[0]["pan"] ?></td>
                     
                   </tr>
               </tbody>
           </table>
		   <?php if(isset($duplicate_status)){ //22-02-2021 ?>
		   
			<div class="alert alert-danger">
				<span class=""><?php echo isset($duplicate_result["pan"]) == 1 ? "PAN no <b>".$duplicate_result["pan"]."</b> is already registered. " : ""; ?></span>
				<span class=""><?php echo isset($duplicate_result["email_id"]) == 1 ? "Email ID <b>".$duplicate_result["email_id"]."</b> is already registered. " : ""; ?></span>
				<span class=""><?php echo isset($duplicate_result["mobile_no"]) == 1 ? "Mobile no <b>".$duplicate_result["mobile_no"]."</b> is already registered. " : ""; ?></span>
            </div>
		   
		   <?php } else { ?>
           <div class="row">
            <div class="col-md-12">
                <?php if($otp_life_time > 600) { ?>
                
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span class="sms_alert">OTP Expired. Please send OTP again</span>
                </div>
                
                <?php } else { ?>
                    <div class="alert alert-warning sms_time_block">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span class="sms_time"><?php echo (600 - $otp_life_time) ?></span> <span class="sms_remaining">Seconds remaining.</span>
                    </div>
                <?php } ?>
                
                <?php if(isset($wrong_otp_message)){ ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $wrong_otp_message; ?>
                </div>
                <?php } ?>
                
            </div>
           </div>
            <div class="row">
                <div class="col-md-3 col-md-offset-4"">
                <label for="captcha">Mobile OTP</label>
                <?php if((600 - $otp_life_time) <= 0){ ?>
                <div class="input-group">
                    <input type="text" class="form-control input-md" placeholder="OTP" name="mobile_otp" disabled>
                        <div class="input-group-btn">
                            <button class="btn btn-primary input-md send_otp_button" name="submit" value="resend_otp" type="submit">Re-send OTP</button>
                        </div>
                    </div>
                    <?php echo form_error('mobile_otp'); ?>
                </div>
                
                <?php } else { ?>
                <div class="input-group">
                    <input type="text" class="form-control input-md send_otp_text" value="<?php echo set_value("mobile_otp"); ?>" placeholder="OTP" name="mobile_otp">
                        <div class="input-group-btn">
                            <button class="btn btn-primary input-md send_otp_button" name="submit" value="resend_otp" type="submit" disabled>Re-send OTP</button>
                        </div>
                    </div>
                    <?php echo form_error('mobile_otp'); ?>
                </div>
                
                <?php } ?>
               
            
            
            <div class="row">
                <div class="col-md-4">
                    <label for="captcha">Captcha</label><br>
                    <?php echo $captcha['image'] ?>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="captcha">Captcha Code <span class="text-danger">*</span></label>
                        <input type="text" value="" name="captcha_code" id="captcha_code" class="form-control" placeholder="Captcha Code">
                        <?php echo form_error('captcha_code'); ?>
                    </div>
                </div>
                <div class="col-md-4">
                <?php if((120 - $otp_life_time) > 0){ ?>
                <label for="captcha">&nbsp;</label><br>
                    <button type="submit" name="submit"  value="otp_submit" class="btn btn-sm btn-primary pull-right submit_oto_button">Submit</button>
                </div>
                <?php } ?>
            </div>
			<?php } ?>
            
            <br>
        <?php echo form_close(); ?>
        <?php } ?>
    </div>
    <?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>