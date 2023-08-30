<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="breadcrumb-box">
                    <h2 class="breadcrumb-title">About Us</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Desk</a></li>
                        <li class="breadcrumb-item active">Chairperson</li>
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
                    <img class="img-thumbnail" src="<?php echo $this->config->item('theme_uri');?>councils/images/Purnendu-basu.jpg">
                </div>
            </div>
            <div class="col-md-8">
                <div class="caption mt-3">
                    <h4>Shri Purnendu Basu</h4>
                    <span>Chairperson</span>
                    <p>West Bengal State Council of Technical &amp; Vocational Education and Skill Development</p>
                </div>
                <div class="contacts">
                    <span><i class="fa fa-phone"></i> Contact No: 03323403610</span>
                    <span><i class="fa fa-envelope-o"></i> <a href="#">Email ID: chairperson.wbsctvesd@gmail.com</a></span>
                </div>
            </div>
        </div>
		<br>
		<br>
		 <div class="text-justify">
			<h4>From the Desk of Chairperson</h4>
			<p>It has been over constant endeavor to ensure that our students are provided the best in class training on various aspects
of skill development which are consistent with our industry requirements and can contribute once observed by industry
directly without retraining and thus saving precious recourses in the form of time and money for industry.</p>

	<h4 class="text-right"><i>(Purnendu Basu)</i></h4>

		</div>
    </div>
</section>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>