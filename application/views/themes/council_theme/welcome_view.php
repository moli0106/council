<?php $this->load->view($this->config->item('theme') . 'layout/header_view'); ?>

<section class="bannertop">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img class="d-block w-100" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/jexpo_banner.jpg">
            </div>
			<div class="carousel-item">
                <a href="https://sctvesd.wb.gov.in/bgte" target="_blank"><img class="d-block w-100" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/banner-3.jpg"></a>
            </div>
            <div class="carousel-item">
                <a href="https://webscte.co.in/" target="_blank"><img class="d-block w-100" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/banner-1.jpg"></a>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/banner-2.jpg">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<section style="margin-top: 19px;">
   <center> <a href="https://sctvesd.wb.gov.in/welcome/entrepreneurship" target="_blank"><button class="btn btn-primary">ENTREPRENEURSHIP</button></a></center> 
</section>


<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="countbox">
                    <img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/enrolled-icon.png">
                    <h3 class="counter greentxt">2838</h3>
                    <p>VTC</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="countbox">
                    <img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/trades-icon.png">
                    <h3 class="counter orangetxt">154</h3>
                    <p>Polytechnics</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="countbox">
                    <img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/engaged-icon.png">
                    <h3 class="counter bluetxt">102</h3>
                    <p>STVT Centers</p>
                </div>
            </div>
            <!-- <div class="col-md-3">
                    <div class="countbox">
                        <img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/engaged-icon.png">
                        <h3 class="counter purpletxt">312</h3>
                        <p>Assessor Engaged</p>
                    </div>
                </div> -->
            <div class="col-md-3">
                <div class="countbox">
                    <img src="<?php echo $this->config->item('theme_uri'); ?>councils/images/student-icon.png">
                    <h3 class="counter bluetxt">237000</h3>
                    <p>Student Intake</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5 graybg">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="map-box">
                    <h4>Institute Locator</h4>
                    <!--<img class="img-fluid" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/map.jpg" alt="Institute Locator">-->
                    <ul id="m-home">
                        <li id="dar"><a href="district/institute_locator/dist/1" title="Darjeeling">Darjeeling</a></li>
                        <li id="kal"><a href="district/institute_locator/dist/23" title="Kalimpong">Kalimpong</a></li>
                        <li id="jal"><a href="district/institute_locator/dist/2" title="Jalpaiguri">Jalpaiguri</a></li>
                        <li id="ali"><a href="district/institute_locator/dist/21" title="Alipurduar">Alipurduar</a></li>
                        <li id="coch"><a href="district/institute_locator/dist/3" title="Coochbehar">Coochbehar</a></li>
                        <li id="udin"><a href="district/institute_locator/dist/4" title="Uttar Dinajpur">Uttar Dinajpur</a></li>
                        <li id="ddin"><a href="district/institute_locator/dist/5" title="Dakshin Dinajpur">Dakshin Dinajpur</a></li>
                        <li id="mal"><a href="district/institute_locator/dist/6" title="Maldah">Maldah</a></li>
                        <li id="mur"><a href="district/institute_locator/dist/7" title="Murshidabad">Murshidabad</a></li>
                        <li id="bir"><a href="district/institute_locator/dist/8" title="Birbhum">Birbhum</a></li>
                        <li id="hoo"><a href="district/institute_locator/dist/12" title="Hooghli">Hooghli</a></li>
                        <li id="barw"><a href="district/institute_locator/dist/24" title="Barddhaman West">Barddhaman West</a></li>
                        <li id="bar"><a href="district/institute_locator/dist/9" title="Barddhaman East">Barddhaman East</a></li>
                        <li id="ban"><a href="district/institute_locator/dist/13" title="Bankura">Bankura</a></li>
                        <li id="pur"><a href="district/institute_locator/dist/14" title="Purulia">Purulia</a></li>
                        <li id="nad"><a href="district/institute_locator/dist/10" title="Nadia">Nadia</a></li>
                        <li id="how"><a href="district/institute_locator/dist/15" title="Howrah">Howrah</a></li>
                        <li id="n24"><a href="district/institute_locator/dist/11" title="North 24 Parganas">North 24 Parganas</a></li>
                        <li id="s24"><a href="district/institute_locator/dist/17" title="South 24 Parganas">South 24 Parganas</a></li>
                        <li id="mede"><a href="district/institute_locator/dist/18" title="Purba Medinipur">Purba Medinipur</a></li>
                        <li id="medw"><a href="district/institute_locator/dist/19" title="Paschim Medinipur">Paschim Medinipur</a></li>
                        <li id="jhar"><a href="district/institute_locator/dist/25" title="Jhargram">Jhargram</a></li>
                        <li id="kol"><a href="district/institute_locator/dist/16" title="Kolkata">Kolkata</a></li>
                    </ul>

                    <div class="mapicon">
                        <ul>
                            <li><i class="fa fa-map-marker iconred"></i> VTC</li>
                            <li><i class="fa fa-map-marker icongren"></i> Polytechnic</li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>

            <div class="col-md-7">
                <div class="tab-box">
                    <nav class="tab-nav">
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-notices" role="tab" aria-controls="nav-profile" aria-selected="false">Notices & Circulars</a>
                            <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-events" role="tab" aria-controls="nav-home" aria-selected="true">Events</a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-tender" role="tab" aria-controls="nav-contact" aria-selected="false">Tender</a>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">


                        <div class="tab-pane fade show active" id="nav-notices" role="tabpanel">
                            <ul class="content-list">
                                <?php foreach ($notice as $key => $value) { ?>
                                    <li>
                                        <a target="_blank" href="<?php echo base_url('welcome/download/' . md5($value['publication_id_pk'])); ?>">
                                            <?php echo $value['publication_description']; ?>
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                            <!-- <div class="pt-4"> -->
                            <a href="<?php echo base_url('notices_and_circulars'); ?>" class="btn btn-primary more-btn">Read More</a>
                            <!-- </div> -->
                        </div>
                        <div class="tab-pane fade" id="nav-events" role="tabpanel">
                            Coming Soon
                        </div>

                        <div class="tab-pane fade" id="nav-tender" role="tabpanel">
                            Coming Soon
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <h2 class="carousel-title">BGTE - 2022</h2>
                <div class="owl-carousel">
                <?php foreach ($product_list as $key => $value) {?>
                    <div class="item item-image-size">
                        <a href="bgte/home/details/<?php echo md5($value['product_id_pk']);?>" target="_blank"><img src="data:image/jpeg;base64,<?php echo $value['prd_image'][0]; ?>" alt="testimonial 1" /></a>
                    </div>
                <?php }?>
                </div>
            </div>
        </div>
    </div>
</section> -->

<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-9">
                        <div class="thumb">
                            <div class="gallery-heading">
                                <div class="title float-left">
                                    <h4>Photo Gallery</h4>
                                </div>
                                <div class="titlebtn float-left">
                                    <a href="coming_soon">View All</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <img class="img-fluid" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/1.jpg">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="sidet-thumb">
                            <img class="img-fluid" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/2.jpg">
                            <img class="img-fluid" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/3.jpg">
                            <img class="img-fluid" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/4.jpg">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="thumb-video">
                    <div class="gallery-heading">
                        <div class="title float-left">
                            <h4>Video Gallery</h4>
                        </div>
                        <div class="titlebtn float-left">
                            <a href="coming_soon">View All</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <img class="img-video" src="<?php echo $this->config->item('theme_uri'); ?>councils/images/video-img.jpg">
                </div>
            </div>

        </div>
    </div>
</section>

<?php $this->load->view($this->config->item('theme') . 'layout/footer_view'); ?>

<script>
// <!--carousel-->
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:15,
	autoplay:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
			nav: true
        },
        1000:{
            items:5,
			nav: true
        }
    }
})
</script>