<?php $this->load->view($this->config->item('theme').'layout/header_view'); ?>

<section class="inner-banner">
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
        <div class="breadcrumb-box">
        <h2 class="breadcrumb-title">Contact Us</h2>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Contact Us</li>
        </ol>
        </div>
        </div>
    </div>
    </div>
</section>


<section class="pt-5 pb-5">
  <div class="container">
    <div class="row">
     <div class="col-md-12 mb-4">
     <h3 class="page-title">LOCATION</h3>
     </div>
    </div>
    
    <div class="row">
    <div class="col-md-6">
    <div class="location-txt">
    <h3>Head Quarter</h3> 
    <p>of the Council is located at 4th &amp; 5thFloor, Karigari Bhawan, Plot-B/7, Newtown Action Area-III, Kolkata-700160.</p>
    </div>
    <div class="map-img">
    <img class="img-thumbnail" src="<?php echo $this->config->item('theme_uri') ?>councils/images/karigari-bhawan.jpg">
    </div>
    </div>
    <div class="col-md-6">
    <div class="location-txt">
    <h3>Examination Section </h3>
    <p> for JEXPO/VOCLET as well as for Diploma Courses of the Council function from 
    Kolkata Karigari Bhawan,110 S. N. Banerjee Road, Kolkata-700013.</p>
    </div>
    <div class="map-img">
    <img class="img-thumbnail" src="<?php echo $this->config->item('theme_uri') ?>councils/images/s-n-banerjee-road.jpg">
    </div>
    </div>
    </div>
    
  </div>
</section>

<?php $this->load->view($this->config->item('theme').'layout/footer_view'); ?>