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

        <div class="row">
		
			<div class="col-md-6">
				<h3>Assessor / Expert registration form</h3>
			</div>
			<div class="col-md-3" style="padding-top: 20px;">
				<a target="_blank" href="files/public/Eligibility_Criteria_for_Assessors.pdf" class="btn btn-sm btn-primary btn-block">
					<i class="fa fa-download"></i> Eligibility Criteria For Assessor
				</a>
			</div>
			<div class="col-md-3" style="padding-top: 20px;">
				<a target="_blank" href="files/public/Online_Registration_Procedure.pdf" class="btn btn-sm btn-primary btn-block">
					<i class="fa fa-download"></i> Online Registration Procedure
				</a>
			</div>
		</div>
        <hr>
        <?php echo form_open_multipart("assessor/assessor_reg",array("id" => "basic_assessor_reg_form"));?>
            <input type="hidden" name="token" value="<?php echo $captcha['word'] ?>">
            <h4>Basic Information</h4><hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Salutation <span class="text-danger">*</span></label>
                        <select class="form-control" name="salutation" id="salutation">
                            <option value="">-- Salutation --</option>
                            <?php foreach($salutations as $salutation){ ?>
                            <option value="<?php echo $salutation['salutation_id_pk'] ?>" <?php echo set_select("salutation",$salutation['salutation_id_pk']) ?>><?php echo $salutation['salutation_desc'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('salutation'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">First name <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("fname"); ?>" name="fname" id="fname" class="form-control"  placeholder="First name">
                        <?php echo form_error('fname'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Middle name</label>
                        <input type="text" value="<?php echo set_value("mname"); ?>"" name="mname" id="mname" class="form-control"  placeholder="Middle name">
                        <?php echo form_error('mname'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Last name <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("lname"); ?>" name="lname" id="lname" class="form-control"  placeholder="Last name">
                        <?php echo form_error('lname'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Gender <span class="text-danger">*</span></label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">-- Select Gender --</option>
                            <?php foreach($genders as $gender){ ?>
                            <option value="<?php echo $gender['gender_id_pk'] ?>" <?php echo set_select("gender",$gender['gender_id_pk']) ?>><?php echo $gender['gender_description'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('gender'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="datepicker">D.O.B <span class="text-danger">*</span></label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="common_input_div">
                            <input type="text" value="<?php echo set_value("dob"); ?>" class="form-control pull-right datepicker" id="dob" name="dob" placeholder="DD/MM/YYYY" autocomplete="off">
                        </div>
                    </div>
                    <?php echo form_error('dob'); ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">Language <span class="text-danger">*</span></label>
                        <select class="form-control" name="language" id="language">
                            <option value="">-- Select Language --</option>
                            <?php foreach($languages as $language){ ?>
                            <option value="<?php echo $language['language_id_pk'] ?>" <?php echo set_select("language",$language['language_id_pk']) ?>><?php echo $language['language_desc'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('language'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">PAN No. <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("pan"); ?>" name="pan" id="pan" class="form-control"  placeholder="PAN No." style="text-transform: uppercase;">
                        <?php echo form_error('pan'); ?>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">ID Type (Alternate) <span class="text-danger">*</span></label>
                        <select class="form-control" name="id_type_alt" id="id_type_alt">
                            <option value="">-- Select ID Type  --</option>
                            <?php foreach($id_types as $id_type){ ?>
                            <option value="<?php echo $id_type['id_type_id_pk'] ?>" <?php echo set_select("id_type_alt",$id_type['id_type_id_pk']) ?>><?php echo $id_type['id_type_name'] ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('id_type_alt'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="designation">ID No. (Alternate) <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("id_no_alt"); ?>" name="id_no_alt" id="id_no_alt" class="form-control"  placeholder="ID No.">
                        <?php echo form_error('id_no_alt'); ?>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group">
                        <label for="designation">Photo Copy of PAN (.PDF only, Max 100KB) <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" value="" placeholder="Upload PAN" name="panphoto">
                        <?php echo form_error('panphoto')?>
                    </div>
                </div>
                
            </div>

            <br>
           <h4>Contact Information</h4><hr>
           <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mobile_no">Mobile No. <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value("mobile_no") ?>" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No.">
                        <?php echo form_error('mobile_no'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="landline">Landline No</label>
                        <input type="text" value="<?php echo set_value("landline") ?>" name="landline" id="landline" class="form-control" placeholder="Landline No">
                        <?php echo form_error('landline'); ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email_id">Email ID <span class="text-danger">*</span></label>
                        <input type="text" value="<?php echo set_value('email_id'); ?>" name="email_id" id="email_id" class="form-control" placeholder="Email ID">
                        <?php echo form_error('email_id'); ?>
                    </div>
                </div>
           </div>
            <div class="row">
                <div class="col-md-2">
                    <label for="captcha">Captcha</label><br>
                    <?php echo $captcha['image'] ?>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="captcha">Captcha Code <span class="text-danger">*</span></label>
                        <input type="text" value="" name="captcha_code" id="captcha_code" class="form-control" placeholder="Captcha Code">
                        <?php echo form_error('captcha_code'); ?>
                    </div>
                </div>
                <div class="col-md-7">
                <label for="captcha">&nbsp;</label><br>
                    <button type="submit" class="btn btn-warning pull-right">Submit</button>
                </div>
            </div>
            <br>
        <?php echo form_close(); ?>
    </div>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>