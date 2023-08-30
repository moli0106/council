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
                    <img class="img-thumbnail" src="<?php echo $this->config->item('theme_uri');?>councils/images/PS.jpg">
					<!-- <img class="img-thumbnail" src="<?php echo $this->config->item('theme_uri');?>councils/images/mic.jpg"> -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="caption mt-3">
                    <h4>Dr. Krishna Gupta, IAS</h4>
                    <span>Principal Secretary</span>
                    <p>Technical Education, Training & Skill Development Department, <br> Govt. of West Bengal</p>
					
					 <span> Ex Officio Vice Chairperson</span>
                    <p>West Bengal State Council of Technical & Vocational Education and Skill Development</p>
                </div>
                <!--<div class="contacts">
                    <span><i class="fa fa-phone"></i> 12456789</span>
                    <span><i class="fa fa-envelope-o"></i> <a href="#">secretary@mail.com</a></span>
                </div>-->
            </div>
        </div>
        <br>
        <div class="text-justify">
            <h4>Principal Secretary’s Desk</h4>
            <p>The West Bengal State Council of Technical and Vocational Education and Skill Development [WBSCTVESD] is a statutory body under the Department of Technical Education, Training & Skill Development[TET&SD]. It undertakes the affiliation, curriculum, design, evaluation and assessment for Diploma Education, Vocational Education and Skill Development in the State. </p>
            <p>WBSCTVESD has been taking many innovative steps to help the TET&SD Department realize the vision of creating a pool of talented, technically sound and employable human resources for the State and beyond.  The Council is also taking various initiatives to make the technical and vocational education system equitably accessible to all section of the Society.</p>
            <p>The Council has got the recognition of the National Council for Vocational Education and Training [NCVET] as awarding body and assessment agency for about 600 job-roles under the National Skill Qualification Framework[NSQF].  The Council in a very short time has created adequate structures and mechanisms to identify the assessors, develop and deploy them for getting the assessment and certification done in a fair and transparent manner.</p>
            <p>The Council is also upgrading the curriculum to meet industry requirements and national standards tying up with industrial bodies/employers for enhancing the job opportunities for the students and creating evidence based technologically enabled, transparent and fair assessment processes.</p>
            <p>I wish the Council and it's functionaries well for the future endeavors up to.</p>
            <h4 class="text-right"><i> (Dr. Krishna Gupta, IAS)</i></h4>
        </div>
    </div>
</section>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>