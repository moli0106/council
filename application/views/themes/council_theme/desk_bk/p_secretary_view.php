<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">About Us</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Desk</a></li>
                        <li class="breadcrumb-item active">Pr. Secretary</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="thumbnail">
                    <img class="img-thumbnail" src="<?php echo $this->config->item('theme_uri');?>councils/images/anoop-kumar-agrawal.jpg">
                </div>
            </div>
            <div class="col-md-8">
                <div class="caption mt-3">
                    <h4>Anoop Kumar Agrawal, IAS</h4>
                    <span>Principal Secretary</span>
                    <p>Technical Education, Training & Skill Development Department, <br> Govt. of West Bengal</p>
                </div>
                <div class="contacts">
                    <span><i class="fa fa-phone"></i> 12456789</span>
                    <span><i class="fa fa-envelope-o"></i> <a href="#">secretary@mail.com</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>