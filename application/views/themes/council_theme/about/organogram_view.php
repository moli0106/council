<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>
<section class="inner-banner">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="breadcrumb-box">
          <h2 class="breadcrumb-title">&nbp;</h2>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">About</a></li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="pt-5 pb-5">
  <div class="container">
	  <div class="text-center">
		<img width="100" src="<?php echo $this->config->item('theme_uri');?>councils/images/logoBig.png"><br><br>
		<h4>West Bengal State Council of Technical & Vocational Education & Skill Development</h4><br>
	</div>
    <p class="text-justify">The West Bengal State Council of Technical & Vocational Education and Skill Development is a statutory body under the West Bengal Act XXVI of 2013. The Act was enacted by the West Bengal Legislative Assembly for establishment of single State Council of Technical and Vocational Education and Skill Development by amalgamating two Councils, namely, the West Bengal State Council of Technical Education and the West Bengal State Council of Vocational Education and Training in order to establish an integrated, appropriate and unified framework to enable appropriate competencies in the skilling of manpower of the State in terms of different trades or skills, and to take steps to strengthen skill development initiatives in a coordinated manner and to provide for the matters connected therewith or incidental thereto.</p>
  </div>
</section>
<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>