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

        <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Basic and contact information has been successfully registered. Email verification link has been sent to your email. Kindly check your email.
            </div>
    </div>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>