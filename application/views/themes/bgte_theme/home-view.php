<?php $this->load->view('themes/bgte_theme/layout/header'); ?>

<!--Course Area Start-->
<div class="course-area section-padding">
    <div class="container">
        <div class="row">
		<?php foreach ($product_list as $key => $value) {?>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-item">
                    <div class="single-item-image overlay-effect">
                        <img style="max-height: 300px; max-width: 211px;"  src="data:image/jpeg;base64,<?php echo $value['prd_image'][0]; ?>" alt="">
                    </div>
                    <div class="single-item-text">
                        <h4><a href="javascript:void(0)"><?php echo substr($value['product_name'], 0, 20) . '...'?></a></h4>
                        <div class="single-item-text-info">
                            <span>By: <span><?php echo $value['mentor_name']?></span></span>
                            <!--<span>Date: <span>10-06-2022</span></span>-->
                        </div>
                        <p><?php echo substr($value['product_desc'], 0, 30) . '...'?></p>
                    </div>
                    <div class="button-bottom">
                        <a href="bgte/home/details/<?php echo md5($value['product_id_pk']);?>" class="button-default">View More</a>
                    </div>
                </div>
            </div>
		<?php } ?>
            
        </div>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="pagination-content number">
                    <ul class="pagination">
                        <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li class="current"><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div> -->
    </div>
</div>
<!--End of Course Area-->

<!--Testimonial Area Start-->
<div class="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 offset-lg-0 col-md-12 col-12">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                        <div class="testimonial-image-slider text-center">
                        <?php foreach ($product_list as $key => $value) {?>
                            <div class="sin-testiImage">
                                <img src="data:image/jpeg;base64,<?php echo $value['prd_image'][0]; ?>" alt="testimonial 1" />
                            </div>
                        <?php }?>
                            
                        </div>
                    </div>
                </div>
                <div class="testimonial-text-slider text-center">
                <?php foreach ($product_list as $key => $value) {?>
                    <div class="sin-testiText">
                        <h2><?php echo substr($value['product_name'], 0, 30) . '...'?> </h2>
                    </div>
                <?php }?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Testimonial Area-->

<?php $this->load->view('themes/bgte_theme/layout/footer'); ?>